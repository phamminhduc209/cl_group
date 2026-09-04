<?php
/**
 * simple_form - shared multi-step form handler (input -> confirm -> send).
 * Works in WordPress and plain PHP.
 *
 * new simple_form($formKey = 'contact')   session key per form, avoids collisions
 *
 * Input step:
 * $sf->save($post, $fieldTypes)    sanitize + store to session, returns data
 * $sf->requireCheck($require)      ['field' => 'label'] -> ['empty_flag','errm']
 * $sf->old($field)                 repopulate escaped value from session
 *
 * Confirm step:
 * $sf->hasData() / $sf->data() / $sf->clear()
 * $sf->sendAdminMail($data, $config, $labels)
 * $sf->sendUserMail($data, $config, $labels)
 *   $config: to_address, from_address, from_name, subject, template, use_smtp
 *   template: .txt file with {{field}} / {{contact_details}} placeholders
 *
 * reCAPTCHA v3 (optional, skipped if not configured):
 * $sf->verifyRecaptcha($token, $recaptchaConfig)
 *   $recaptchaConfig: enabled, site_key, secret_key, threshold, action
 *
 * New form: new simple_form('other_key'), no changes needed here.
 *
 * Shared PHPMailer across multiple plain-PHP projects on the same server:
 * define('PHPMAILER_SHARED_PATH', '/path/to/shared/phpmailer/src');
 * before require-ing this file. Not needed in WordPress (core already has it).
 */

if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
    require_once __DIR__ . '/Exception.php';
    require_once __DIR__ . '/PHPMailer.php';
    require_once __DIR__ . '/SMTP.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class simple_form {

    private $sessionKey;

    public function __construct($formKey = 'contact') {
        $this->sessionKey = $formKey;
    }

    public function key() {
        return $this->sessionKey;
    }

    public function save($post, $fieldTypes = []) {
        unset($_SESSION[$this->sessionKey]);

        foreach ($post as $key => $value) {
            if (is_array($value)) {
                $_SESSION[$this->sessionKey][$key] = $value;
            } else {
                $type = $fieldTypes[$key] ?? null;
                $_SESSION[$this->sessionKey][$key] = $this->filter($value, $type);
            }
        }

        return $_SESSION[$this->sessionKey];
    }

    public function data() {
        return $_SESSION[$this->sessionKey] ?? [];
    }

    public function hasData() {
        return !empty($_SESSION[$this->sessionKey]);
    }

    public function clear() {
        unset($_SESSION[$this->sessionKey]);
    }

    public function old($key, $default = '') {
        $value = $_SESSION[$this->sessionKey][$key] ?? $default;

        if (is_array($value)) {
            return $value;
        }

        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function verifyRecaptcha($token, $config = []) {
        if (empty($config['enabled']) || empty($config['secret_key'])) {
            return true;
        }

        if (empty($token)) {
            return false;
        }

        $response = $this->postRecaptcha($token, $config['secret_key']);

        if (empty($response['success'])) {
            return false;
        }

        $threshold = $config['threshold'] ?? 0.5;

        if (isset($response['score']) && $response['score'] < $threshold) {
            return false;
        }

        if (!empty($config['action']) && isset($response['action']) && $response['action'] !== $config['action']) {
            return false;
        }

        return true;
    }

    private function postRecaptcha($token, $secretKey) {
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $params = ['secret' => $secretKey, 'response' => $token];

        if (function_exists('curl_init')) {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $options = [
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/x-www-form-urlencoded',
                    'content' => http_build_query($params),
                    'timeout' => 5
                ]
            ];
            $result = @file_get_contents($url, false, stream_context_create($options));
        }

        if (!$result) {
            return null;
        }

        return json_decode($result, true);
    }

    public function filter($value, $type = null) {
        $value = trim($value);
        $value = stripslashes($value);

        switch ($type) {
            case 'email':
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                $value = filter_var($value, FILTER_SANITIZE_EMAIL);
                break;
            case 'textarea':
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                break;
            default:
                $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
                break;
        }

        return $value;
    }

    public function requireCheck($require) {
        $empty_flag = false;
        $errm = '';

        foreach ($require as $key => $label) {
            if ($key === 'policy') {
                if (empty($_POST[$key])) {
                    $empty_flag = true;
                    $errm .= '<p class="error_messe">【' . $label . '】に同意してください</p>';
                }
                continue;
            }

            $value = $_POST[$key] ?? '';

            if (is_array($value)) {
                if (empty($value)) {
                    $empty_flag = true;
                    $errm .= '<p class="error_messe">【' . $label . '】は必須項目です</p>';
                }
                continue;
            }

            if (trim($value) === '') {
                $empty_flag = true;
                $errm .= '<p class="error_messe">【' . $label . '】は必須項目です</p>';
            }
        }

        return ['empty_flag' => $empty_flag, 'errm' => $errm];
    }

    private function createMailer($useSmtp = false, $smtpConfig = []) {
        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        if ($useSmtp) {
            $mail->isSMTP();
            $mail->Host = $smtpConfig['host'] ?? '';
            $mail->SMTPAuth = true;
            $mail->Username = $smtpConfig['username'] ?? '';
            $mail->Password = $smtpConfig['password'] ?? '';
            $mail->SMTPSecure = $smtpConfig['secure'] ?? PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = $smtpConfig['port'] ?? 465;
        } else {
            $mail->isMail();
        }

        return $mail;
    }

    private function buildDetailsText($data, $labels) {
        $lines = [];

        foreach ($labels as $key => $label) {
            if (!isset($data[$key]) || $data[$key] === '') {
                continue;
            }

            $value = is_array($data[$key]) ? implode('、', $data[$key]) : $data[$key];
            $lines[] = "{$label}：{$value}";
        }

        return implode("\n", $lines);
    }

    private function renderTemplate($templatePath, array $vars) {
        if (!file_exists($templatePath)) {
            throw new Exception("Mail template not found: {$templatePath}");
        }

        $content = file_get_contents($templatePath);

        foreach ($vars as $key => $value) {
            $content = str_replace('{{' . $key . '}}', $value, $content);
        }

        return $content;
    }

    public function sendAdminMail($data, $config, $labels) {
        $mail = $this->createMailer($config['use_smtp'] ?? false, $config['smtp'] ?? []);
        $mail->setFrom($config['from_address'], $config['from_name']);
        foreach (array_map('trim', explode(',', $config['to_address'])) as $addr) {
            if ($addr !== '') $mail->addAddress($addr);
        }
        $mail->Sender = $config['sender'] ?? $config['from_address'];

        if (!empty($data[$config['reply_field'] ?? 'email'])) {
            $mail->addReplyTo($data[$config['reply_field'] ?? 'email']);
        }

        if (!empty($config['bcc'])) {
            foreach (array_map('trim', explode(',', $config['bcc'])) as $addr) {
                if ($addr !== '') $mail->addBCC($addr);
            }
        }

        $vars = $data;
        $vars['contact_details'] = $this->buildDetailsText($data, $labels);
        $vars['site_name'] = $config['site_name'] ?? '';

        $mail->isHTML(false);
        $mail->Subject = $config['subject'];
        $mail->Body = $this->renderTemplate($config['template'], $vars);

        return $mail->send();
    }

    public function sendUserMail($data, $config, $labels) {
        $toField = $config['to_field'] ?? 'email';

        if (empty($data[$toField])) {
            return false;
        }

        $mail = $this->createMailer($config['use_smtp'] ?? false, $config['smtp'] ?? []);
        $mail->setFrom($config['from_address'], $config['from_name']);
        $mail->addAddress($data[$toField], $data[$config['name_field'] ?? ''] ?? '');
        $mail->Sender = $config['sender'] ?? $config['from_address'];

        $vars = $data;
        $vars['contact_details'] = $this->buildDetailsText($data, $labels);

        $mail->isHTML(false);
        $mail->Subject = $config['subject'];
        $mail->Body = $this->renderTemplate($config['template'], $vars);

        return $mail->send();
    }
}
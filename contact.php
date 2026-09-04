<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);

require_once __DIR__ . '/phpmailer/mail.php';

$sf = new simple_form('quote');
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
    && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

$respond = function ($success, $extra = []) use ($isAjax) {
    if ($isAjax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => $success] + $extra, JSON_UNESCAPED_UNICODE);
        exit;
    }
};

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_POST['form_submit'])) {
    http_response_code(403);
    exit('Forbidden');
}

if (empty($_POST['form_nonce']) || empty($_SESSION['csrf_token'])
    || !hash_equals($_SESSION['csrf_token'], (string) $_POST['form_nonce'])) {
    $respond(false, ['error' => 'Phiên gửi biểu mẫu đã hết hạn. Vui lòng tải lại trang và thử lại.']);
    http_response_code(403);
    exit('Phiên gửi biểu mẫu đã hết hạn. Vui lòng tải lại trang và thử lại.');
}

$now = time();
if (isset($_SESSION['last_submit']) && ($now - $_SESSION['last_submit']) < 10) {
    $respond(false, ['error' => 'Vui lòng chờ một chút trước khi gửi lại biểu mẫu.']);
    http_response_code(429);
    exit('Vui lòng chờ một chút trước khi gửi lại biểu mẫu.');
}
$_SESSION['last_submit'] = $now;

$fieldTypes = [
    'frm_mail' => 'email',
    'frm_mess' => 'textarea'
];

$_POST = $sf->save($_POST, $fieldTypes);

$required = [
    'frm_name' => 'Họ và tên',
    'frm_company' => 'Công ty',
    'frm_phone' => 'Số điện thoại',
    'frm_mail' => 'Email',
    'frm_lvc' => 'Dịch vụ vận chuyển',
    'frm_pol' => 'POL',
    'frm_pod' => 'POD',
    'frm_lmh' => 'Loại hàng',
    'frm_quantity' => 'Số lượng',
    'frm_container' => 'Loại container',
    'frm_weight' => 'Trọng lượng',
    'frm_pickup_time' => 'Thời gian lấy hàng'
];

$requireResult = $sf->requireCheck($required);
$error = $requireResult['errm'];

if (!$requireResult['empty_flag'] && !filter_var($_POST['frm_mail'], FILTER_VALIDATE_EMAIL)) {
    $error = 'Email không hợp lệ.';
}

if ($error !== '') {
    $respond(false, ['error' => $error]);
    http_response_code(400);
    exit($error);
}

$labels = [
    'frm_name' => 'Họ và tên / Name',
    'frm_company' => 'Công ty / Company',
    'frm_phone' => 'Số điện thoại / Phone',
    'frm_mail' => 'Email',
    'frm_lvc' => 'Dịch vụ vận chuyển / Shipping method',
    'frm_pol' => 'POL',
    'frm_pod' => 'POD',
    'frm_lmh' => 'Loại hàng / Commodity',
    'frm_quantity' => 'Số lượng / Quantity',
    'frm_container' => 'Loại container / Container type',
    'frm_weight' => 'Trọng lượng / Weight',
    'frm_pickup_time' => 'Thời gian lấy hàng / Cargo ready date',
    'frm_bhhh' => 'Bảo hiểm hàng hóa / Cargo insurance',
    'frm_kbhq' => 'Khai báo hải quan / Customs declaration',
    'frm_mess' => 'Ghi chú / Notes'
];

$smtpHost = getenv('QUOTE_SMTP_HOST') ?: '';
$useSmtp = $smtpHost !== '';
$smtpConfig = [
    'host' => $smtpHost,
    'username' => getenv('QUOTE_SMTP_USERNAME') ?: '',
    'password' => getenv('QUOTE_SMTP_PASSWORD') ?: '',
    'secure' => getenv('QUOTE_SMTP_SECURE') ?: 'tls',
    'port' => (int) (getenv('QUOTE_SMTP_PORT') ?: 587)
];
$fromAddress = getenv('QUOTE_MAIL_FROM') ?: 'minhducpham.it@gmail.com';
$adminAddress = getenv('QUOTE_MAIL_TO') ?: 'minhducpham.it@gmail.com';

$adminConfig = [
    'to_address' => $adminAddress,
    'from_address' => $fromAddress,
    'sender' => $fromAddress,
    'from_name' => 'CL Group - Bao gia',
    'subject' => 'Yeu cau bao gia moi tu website CL Group',
    'template' => __DIR__ . '/mail-templates/admin.txt',
    'reply_field' => 'frm_mail',
    'use_smtp' => $useSmtp,
    'smtp' => $smtpConfig
];

$userConfig = [
    'to_field' => 'frm_mail',
    'name_field' => 'frm_name',
    'from_address' => $fromAddress,
    'sender' => $fromAddress,
    'from_name' => 'CL Group',
    'subject' => 'CL Group da nhan yeu cau bao gia cua ban',
    'template' => __DIR__ . '/mail-templates/user.txt',
    'use_smtp' => $useSmtp,
    'smtp' => $smtpConfig
];

try {
    if (!$sf->sendAdminMail($sf->data(), $adminConfig, $labels)) {
        throw new Exception('Admin email was not sent.');
    }

    $sf->sendUserMail($sf->data(), $userConfig, $labels);
    $returnUrl = $_POST['return_url'] ?? '/cl_group/bao-gia/';
    if (strpos($returnUrl, '/cl_group/') !== 0) {
        $returnUrl = '/cl_group/bao-gia/';
    }

    $sf->clear();
    unset($_SESSION['csrf_token']);

    if ($isAjax) {
        $respond(true);
    }

    header('Location: ' . $returnUrl . '?sent=1');
    exit;
} catch (Exception $e) {
    error_log('Quote mail error: ' . $e->getMessage());
    $respond(false, ['error' => 'Không thể gửi email lúc này. Vui lòng thử lại sau.']);
    http_response_code(500);
    exit('Không thể gửi email lúc này. Vui lòng thử lại sau.');
}

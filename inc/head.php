<?php
    define('url_home', '/cl_group/');
    define('url_path', '/cl_group/');

    function asset(string $path): string {
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($path, '/');
        return $path . '?v=' . filemtime($fullPath);
    }
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset(url_path.'assets/css/index-office-v2.css') ?>">
<link rel="stylesheet" href="<?= asset(url_path.'assets/css/style.css') ?>">
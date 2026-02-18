<?php
require_once __DIR__ . '/bootstrap.php';

if (is_logged_in()) {
    return;
}

if (empty($_SESSION['auth']['post_login_redirect'])) {
    $requestUri = $_SERVER['REQUEST_URI'] ?? '/index.php';
    $_SESSION['auth']['post_login_redirect'] = $requestUri;
}

header('Location: /auth/login.php');
exit;

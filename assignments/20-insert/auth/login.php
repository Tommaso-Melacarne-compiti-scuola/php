<?php
require_once __DIR__ . '/bootstrap.php';

if (is_logged_in()) {
    $redirect = $_SESSION['auth']['post_login_redirect'] ?? '/index.php';
    unset($_SESSION['auth']['post_login_redirect']);
    header('Location: ' . $redirect);
    exit;
}

$config = oauth_config();
if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect_uri'])) {
    http_response_code(500);
    echo 'Configurazione OAuth mancante. Controlla il file .env.';
    exit;
}

$client = oauth_client();
header('Location: ' . $client->createAuthUrl());
exit;

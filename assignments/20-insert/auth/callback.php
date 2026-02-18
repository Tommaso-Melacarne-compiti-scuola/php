<?php
require_once __DIR__ . '/bootstrap.php';

$config = oauth_config();
if (empty($config['client_id']) || empty($config['client_secret']) || empty($config['redirect_uri'])) {
    http_response_code(500);
    echo 'Configurazione OAuth mancante. Controlla il file .env.';
    exit;
}

$code = isset($_GET['code']) ? trim($_GET['code']) : '';
if ($code === '') {
    http_response_code(400);
    echo 'Codice OAuth mancante.';
    exit;
}

$client = oauth_client();
$tokenResult = $client->fetchAccessTokenWithAuthCode($code);
if (!is_array($tokenResult) || isset($tokenResult['error'])) {
    http_response_code(401);
    echo 'Errore durante la richiesta del token.';
    exit;
}

$client->setAccessToken($tokenResult);
$oauthService = new Google_Service_Oauth2($client);
$user = $oauthService->userinfo->get();
$user = json_decode(json_encode($user), true);
$email = $user['email'] ?? '';
if ($email === '' || !enforce_allowed_email($email)) {
    $_SESSION['auth'] = [];
    http_response_code(403);
    echo 'Account non autorizzato.';
    exit;
}

$redirect = $_SESSION['auth']['post_login_redirect'] ?? '/index.php';

$_SESSION['auth'] = [
    'logged_in' => true,
    'user' => [
        'email' => $email,
        'name' => $user['name'] ?? $email,
        'picture' => $user['picture'] ?? null
    ],
    'login_at' => date('c')
];
unset($_SESSION['auth']['post_login_redirect']);
header('Location: ' . $redirect);
exit;

<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function oauth_config() {
    return [
        'client_id' => $_ENV['GOOGLE_CLIENT_ID'] ?? '',
        'client_secret' => $_ENV['GOOGLE_CLIENT_SECRET'] ?? '',
        'redirect_uri' => $_ENV['GOOGLE_REDIRECT_URI'] ?? '',
        'allowed_email' => $_ENV['GOOGLE_ALLOWED_EMAIL'] ?? ''
    ];
}

function is_logged_in() {
    return !empty($_SESSION['auth']['logged_in']);
}

function current_user() {
    return $_SESSION['auth']['user'] ?? null;
}

function oauth_client() {
    $config = oauth_config();
    $client = new Google_Client();
    $client->setClientId($config['client_id']);
    $client->setClientSecret($config['client_secret']);
    $client->setRedirectUri($config['redirect_uri']);
    $client->setAccessType('online');
    $client->setPrompt('select_account');
    $client->setIncludeGrantedScopes(true);
    $client->addScope('email');
    $client->addScope('profile');

    return $client;
}

function enforce_allowed_email($email) {
    $config = oauth_config();
    $allowed = $config['allowed_email'] ?? '';
    if ($allowed === '') {
        return true;
    }

    return strtolower(trim($email)) === strtolower(trim($allowed));
}

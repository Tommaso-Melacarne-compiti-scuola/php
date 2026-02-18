<?php
require_once __DIR__ . '/bootstrap.php';

$_SESSION['auth'] = [];

if (session_status() === PHP_SESSION_ACTIVE) {
    session_regenerate_id(true);
}

header('Location: /index.php');
exit;

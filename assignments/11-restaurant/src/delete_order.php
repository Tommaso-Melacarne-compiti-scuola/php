<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

$uid = $_POST["uid"] ?? "";

if (empty($uid)) {
    die("Invalid input");
}

if (!isset($_SESSION["orders"])) {
    die("No orders to delete from");
}

$_SESSION["orders"] = array_filter(
    $_SESSION["orders"],
    fn($order) => $order["uid"] !== $uid,
);

header("Location: /");
http_response_code(302);
exit();

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

$table = $_POST["table"] ?? "";
$plate = $_POST["plate"] ?? "";

function validate_input($table, $plate)
{
    include "static_data.php";

    if (!is_numeric($table) || !is_numeric($plate)) {
        return false;
    }

    $table = (int) $table;
    $plate = (int) $plate;

    if ($table < 0 || $table >= tablesNumber) {
        return false;
    }

    if (!array_key_exists($plate, products)) {
        return false;
    }

    return true;
}

if (!validate_input($table, $plate)) {
    die("Invalid input");
}

$_SESSION["orders"][] = [
    "table" => (int) $table,
    "plate" => (int) $plate,
];

header("Location: /");
http_response_code(302);
exit();

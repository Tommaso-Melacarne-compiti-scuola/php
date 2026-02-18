<?php
require_once __DIR__ . '/../auth/require_login.php';

include_once __DIR__ . '/../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$customerInput = isset($_POST['customer']) ? trim($_POST['customer']) : '';
$productInput = isset($_POST['product']) ? trim($_POST['product']) : '';
$quantity = isset($_POST['quantity']) ? (int) $_POST['quantity'] : 0;
$orderDate = isset($_POST['orderDate']) ? trim($_POST['orderDate']) : '';
$requiredDate = isset($_POST['requiredDate']) ? trim($_POST['requiredDate']) : '';
$comments = isset($_POST['comments']) ? trim($_POST['comments']) : '';

if ($customerInput === '' || $productInput === '' || $quantity <= 0 || $orderDate === '' || $requiredDate === '') {
    header("Location: ../index.php?order=error&message=" . urlencode("Compila tutti i campi obbligatori."));
    exit;
}

$customerParts = explode(' - ', $customerInput, 2);
$customerNumber = (int) trim($customerParts[0]);

$productParts = explode(' - ', $productInput, 2);
$productCode = trim($productParts[0]);

if ($customerNumber <= 0 || $productCode === '') {
    header("Location: ../index.php?order=error&message=" . urlencode("Cliente o prodotto non valido."));
    exit;
}

$productStmt = $conn->prepare("SELECT productCode, MSRP FROM products WHERE productCode = ?");
$productStmt->bind_param("s", $productCode);
$productStmt->execute();
$productResult = $productStmt->get_result();

if ($productResult->num_rows === 0) {
    $productStmt->close();
    header("Location: ../index.php?order=error&message=" . urlencode("Prodotto non trovato."));
    exit;
}

$productRow = $productResult->fetch_assoc();
$productStmt->close();

$priceEach = (float) $productRow['MSRP'];

$customerStmt = $conn->prepare("SELECT customerNumber FROM customers WHERE customerNumber = ?");
$customerStmt->bind_param("i", $customerNumber);
$customerStmt->execute();
$customerResult = $customerStmt->get_result();

if ($customerResult->num_rows === 0) {
    $customerStmt->close();
    header("Location: ../index.php?order=error&message=" . urlencode("Cliente non trovato."));
    exit;
}

$customerStmt->close();

$conn->begin_transaction();

try {
    $maxOrderResult = $conn->query("SELECT MAX(orderNumber) AS maxOrderNumber FROM orders");
    $maxOrderRow = $maxOrderResult->fetch_assoc();
    $orderNumber = (int) $maxOrderRow['maxOrderNumber'] + 1;

    $status = 'In Process';
    $shippedDate = null;

    $orderStmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, shippedDate, status, comments, customerNumber)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $orderStmt->bind_param("isssssi", $orderNumber, $orderDate, $requiredDate, $shippedDate, $status, $comments, $customerNumber);
    $orderStmt->execute();
    $orderStmt->close();

    $orderLineNumber = 1;
    $orderDetailsStmt = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber)
        VALUES (?, ?, ?, ?, ?)");
    $orderDetailsStmt->bind_param("isidi", $orderNumber, $productCode, $quantity, $priceEach, $orderLineNumber);
    $orderDetailsStmt->execute();
    $orderDetailsStmt->close();

    $conn->commit();

    header("Location: ../index.php?order=success&orderNumber=" . urlencode((string) $orderNumber));
    exit;
} catch (Exception $e) {
    $conn->rollback();
    header("Location: ../index.php?order=error&message=" . urlencode("Errore durante la creazione dell'ordine."));
    exit;
}

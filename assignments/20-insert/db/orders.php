<?php
include_once __DIR__ . '/../lib/connection.php';

function getOrders() {
    global $conn;
    $ordersSql = "SELECT
        o.orderNumber,
        o.orderDate,
        o.requiredDate,
        o.shippedDate,
        o.status,
        o.customerNumber,
        c.customerName
        FROM
        orders o
        LEFT JOIN customers c ON c.customerNumber = o.customerNumber
        ORDER BY
        o.orderDate DESC";

    $ordersResult = $conn->query($ordersSql);
    $orders = [];

    if ($ordersResult && $ordersResult->num_rows > 0) {
        while ($row = $ordersResult->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    return $orders;
}

function getOrdersByCustomer($customerNumber) {
    global $conn;
    $ordersSql = "SELECT
        o.orderNumber,
        o.orderDate,
        o.requiredDate,
        o.shippedDate,
        o.status,
        o.customerNumber,
        c.customerName
        FROM
        orders o
        LEFT JOIN customers c ON c.customerNumber = o.customerNumber
        WHERE
        o.customerNumber = ?
        ORDER BY
        o.orderDate DESC";

    $stmt = $conn->prepare($ordersSql);
    if (!$stmt) {
        return [];
    }

    $stmt->bind_param('i', $customerNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $orders = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    }

    $stmt->close();

    return $orders;
}
?>
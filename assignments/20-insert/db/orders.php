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
?>
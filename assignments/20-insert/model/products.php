<?php
include_once __DIR__ . '/../db/connection.php';

function getProducts() {
    global $conn;
    $productsSql = "SELECT
        productCode,
        productName
        FROM
        products
        ORDER BY
        productName ASC";

    $productsResult = $conn->query($productsSql);
    $products = [];

    if ($productsResult && $productsResult->num_rows > 0) {
        while ($row = $productsResult->fetch_assoc()) {
            $products[] = $row;
        }
    }

    return $products;
}
?>
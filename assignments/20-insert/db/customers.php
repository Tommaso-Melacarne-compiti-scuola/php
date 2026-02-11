<?php
include_once __DIR__ . '/../lib/connection.php';

function getCustomers() {
    global $conn;
    $customersSql = "SELECT
        customerNumber,
        customerName, 
        contactLastName,
        contactFirstName,
        phone,
        addressLine1,
        addressLine2,
        city,
        `state`,
        postalCode,
        country
        FROM 
        customers
        ORDER BY
        customerNumber ASC";

    $customersResult = $conn->query($customersSql);

    $customers = [];
    while ($row = $customersResult->fetch_assoc()) {
        $customers[] = $row;
    }

    return $customers;
}
?>
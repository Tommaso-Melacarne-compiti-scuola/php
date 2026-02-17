<?php
include_once __DIR__ . '/../db/connection.php';

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

function getCustomerByNumber($customerNumber) {
    global $conn;
    $customerSql = "SELECT
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
        WHERE
        customerNumber = ?";

    $stmt = $conn->prepare($customerSql);
    if (!$stmt) {
        return null;
    }

    $stmt->bind_param('i', $customerNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $customer = $result ? $result->fetch_assoc() : null;
    $stmt->close();

    return $customer ?: null;
}
?>
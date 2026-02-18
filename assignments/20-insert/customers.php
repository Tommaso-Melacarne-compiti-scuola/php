<?php
require_once __DIR__ . '/auth/require_login.php';

include_once 'db/connection.php';

include_once 'model/customers.php';

$customers = getCustomers();

if (empty($customers)) {
    echo "Nessun risultato trovato.";
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Lista Clienti</title>
</head>

<body data-bs-theme="dark">
    <?php include_once __DIR__ . '/components/navbar.php'; ?>
    <div class="container">
        <h1 class="text-center my-4">Lista dei Clienti</h1>
    </div>
    <table class="table table-striped w-75 mx-auto">
        <tr class="text-center">
            <th>Customer Number</th>
            <th>Customer Name</th>
            <th>Contact Last Name</th>
            <th>Contact First Name</th>
            <th>Phone</th>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
            <th>Country</th>
        </tr>
        <?php
        foreach ($customers as $row) {
            $customerNumber = (int) $row['customerNumber'];
            $ordersLink = 'view_customer.php?' . http_build_query([
                'customerNumber' => $customerNumber,
                'back' => 'customers.php'
            ]);

            echo "<tr>";
            echo "<td>" . $customerNumber . "</td>";
            echo "<td><a class=\"link-light link-offset-1\" href=\"" . htmlspecialchars($ordersLink) . "\">" . $row['customerName'] . "</a></td>";
            echo "<td>" . $row['contactLastName'] . "</td>";
            echo "<td>" . $row['contactFirstName'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row["addressLine1"] . "</td>";
            echo "<td>" . $row["addressLine2"] . "</td>";
            echo "<td>" . $row["city"] . "</td>";
            echo "<td>" . $row["state"] . "</td>";
            echo "<td>" . $row["postalCode"] . "</td>";
            echo "<td>" . $row["country"] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>
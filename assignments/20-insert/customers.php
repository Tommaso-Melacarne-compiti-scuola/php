<?php
include_once 'lib/connection.php';

include_once 'db/customers.php';

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
    <div class="container">
        <div class="row align-items-center my-4">
            <div class="col-2">
                <a class="btn btn-outline-light d-inline-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;" href="index.php" aria-label="Torna indietro">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="col-8 text-center">
                <h1 class="m-0">Lista dei Clienti</h1>
            </div>
            <div class="col-2"></div>
        </div>
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
            echo "<tr>";
            echo "<td>" . $row['customerNumber'] . "</td>";
            echo "<td>" . $row['customerName'] . "</td>";
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
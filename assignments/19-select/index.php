<?php
include_once 'connection.php';

$sql = "SELECT
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

$result = $conn->query($sql);

if ($result->num_rows == 0) {
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
    <title>Lista Clienti</title>
</head>

<body data-bs-theme="dark">
    <h1 class="text-center my-4">Lista dei Clienti</h1>
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
        while ($row = $result->fetch_assoc()) {
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
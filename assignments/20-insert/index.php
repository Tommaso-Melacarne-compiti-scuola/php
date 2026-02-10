<?php
include_once 'connection.php';

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

if ($customersResult->num_rows == 0) {
    echo "Nessun risultato trovato.";
    die();
}

$customers = [];
while ($row = $customersResult->fetch_assoc()) {
    $customers[] = $row;
}

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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Nuovo Ordine</title>
</head>

<body data-bs-theme="dark">
    <h1 class="text-center my-4">Nuovo Ordine</h1>
    <?php
    if (isset($_GET['order']) && $_GET['order'] === 'success') {
        $orderNumber = isset($_GET['orderNumber']) ? htmlspecialchars($_GET['orderNumber']) : '';
        echo "<div class=\"container\"><div class=\"alert alert-success\" role=\"alert\">Ordine creato con successo. Numero ordine: " . $orderNumber . "</div></div>";
    }

    if (isset($_GET['order']) && $_GET['order'] === 'error') {
        $errorMessage = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'Errore durante la creazione dell\'ordine.';
        echo "<div class=\"container\"><div class=\"alert alert-danger\" role=\"alert\">" . $errorMessage . "</div></div>";
    }
    ?>
    <div class="container mb-5">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form class="row g-3" method="post" action="create_order.php">
                    <div class="col-md-6">
                        <label for="customerInput" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="customerInput" name="customer" list="customerList"
                            placeholder="Digita nome o numero cliente" required>
                        <datalist id="customerList">
                            <?php
                            foreach ($customers as $customer) {
                                echo "<option value=\"" . $customer['customerNumber'] . " - " . $customer['customerName'] . "\"></option>";
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-md-6">
                        <label for="productInput" class="form-label">Prodotto</label>
                        <input type="text" class="form-control" id="productInput" name="product" list="productList"
                            placeholder="Digita nome o codice prodotto" required>
                        <datalist id="productList">
                            <?php
                            foreach ($products as $product) {
                                echo "<option value=\"" . $product['productCode'] . " - " . $product['productName'] . "\"></option>";
                            }
                            ?>
                        </datalist>
                    </div>
                    <div class="col-md-4">
                        <label for="quantityInput" class="form-label">Quantità</label>
                        <input type="number" class="form-control" id="quantityInput" name="quantity" min="1" value="1"
                            required>
                    </div>
                    <div class="col-md-4">
                        <label for="orderDate" class="form-label">Data ordine</label>
                        <input type="date" class="form-control" id="orderDate" name="orderDate" required>
                    </div>
                    <div class="col-md-4">
                        <label for="requiredDate" class="form-label">Data richiesta</label>
                        <input type="date" class="form-control" id="requiredDate" name="requiredDate" required>
                    </div>
                    <div class="col-12">
                        <label for="comments" class="form-label">Note</label>
                        <textarea class="form-control" id="comments" name="comments" rows="3"
                            placeholder="Inserisci eventuali note"></textarea>
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <a class="btn btn-outline-light" href="customers.php">Lista clienti</a>
                        <button type="submit" class="btn btn-primary">Aggiungi ordine</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <h2 class="text-center my-4">Lista ordini</h2>
    <table class="table table-striped w-75 mx-auto">
        <tr class="text-center">
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Required Date</th>
            <th>Shipped Date</th>
            <th>Status</th>
            <th>Customer</th>
        </tr>
        <?php
        if (count($orders) == 0) {
            echo "<tr><td class=\"text-center\" colspan=\"6\">Nessun ordine trovato.</td></tr>";
        }

        foreach ($orders as $row) {
            echo "<tr>";
            echo "<td>" . $row['orderNumber'] . "</td>";
            echo "<td>" . $row['orderDate'] . "</td>";
            echo "<td>" . $row['requiredDate'] . "</td>";
            echo "<td>" . ($row['shippedDate'] ?? '-') . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>" . $row['customerNumber'] . " - " . $row['customerName'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>
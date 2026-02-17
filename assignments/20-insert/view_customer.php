<?php
include_once 'db/connection.php';

include_once 'model/customers.php';
include_once 'model/orders.php';

$customerNumberParam = $_GET['customerNumber'] ?? '';
$customerNumber = filter_var($customerNumberParam, FILTER_VALIDATE_INT);

if ($customerNumber === false) {
    $customerNumber = null;
}

$customer = $customerNumber ? getCustomerByNumber($customerNumber) : null;
$orders = $customer ? getOrdersByCustomer($customerNumber) : [];

$backParam = isset($_GET['back']) ? trim($_GET['back']) : '';
$allowedBackTargets = ['index.php', 'customers.php'];
$backUrl = in_array($backParam, $allowedBackTargets, true) ? $backParam : 'index.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Ordini Cliente</title>
</head>

<body data-bs-theme="dark">
    <div class="container">
        <div class="row align-items-center my-4">
            <div class="col-2">
                <a class="btn btn-outline-light d-inline-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;" href="<?php echo htmlspecialchars($backUrl); ?>" aria-label="Torna indietro">
                    <i class="bi bi-arrow-left"></i>
                </a>
            </div>
            <div class="col-8 text-center">
                <h1 class="m-0">Ordini Cliente</h1>
            </div>
            <div class="col-2"></div>
        </div>
    </div>

    <div class="container mb-4">
        <?php if (!$customer) { ?>
            <div class="alert alert-warning" role="alert">Cliente non trovato.</div>
        <?php } else { ?>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h2 class="h5 mb-2">
                        <?php echo htmlspecialchars($customer['customerName']); ?>
                    </h2>
                    <div class="text-muted">Numero cliente: <?php echo htmlspecialchars($customer['customerNumber']); ?></div>
                </div>
            </div>
        <?php } ?>
    </div>

    <h2 class="text-center my-4">Lista ordini</h2>
    <table class="table table-striped w-75 mx-auto">
        <tr class="text-center">
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Required Date</th>
            <th>Shipped Date</th>
            <th>Status</th>
        </tr>
        <?php
        if (!$customer) {
            echo "<tr><td class=\"text-center\" colspan=\"5\">Nessun ordine trovato.</td></tr>";
        } elseif (count($orders) === 0) {
            echo "<tr><td class=\"text-center\" colspan=\"5\">Nessun ordine trovato.</td></tr>";
        } else {
            foreach ($orders as $row) {
                echo "<tr>";
                echo "<td>" . $row['orderNumber'] . "</td>";
                echo "<td>" . $row['orderDate'] . "</td>";
                echo "<td>" . $row['requiredDate'] . "</td>";
                echo "<td>" . ($row['shippedDate'] ?? '-') . "</td>";
                echo "<td>" . $row['status'] . "</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</body>

</html>

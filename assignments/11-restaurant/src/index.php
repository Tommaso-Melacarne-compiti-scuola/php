<?php
session_start();

include "static_data.php";

if (!isset($_SESSION["username"])) {
    // Redirect to login if not logged in
    header("Location: /login.php");
    exit();
}

// orders grouped by table number
$orders_by_table = [];

if (isset($_SESSION["orders"])) {
    foreach ($_SESSION["orders"] as $order) {
        $table = $order["table"];

        if (!isset($orders_by_table[$table])) {
            $orders_by_table[$table] = [];
        }

        $orders_by_table[$table][] = [
            "uid" => $order["uid"],
            "plate" => $order["plate"],
        ];
    }
}

ksort($orders_by_table);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Home</title>
<body data-bs-theme="dark">
    <a href="/logout.php" class="btn btn-danger ms-3 mt-3">Logout</a>

    <h1 class="text-center mt-5">
        Welcome,
        <span class="fw-bold"><?= $_SESSION["username"] ?></span>!
    </h1>

    <form action="/add_order.php" method="POST">
        <div class="container w-50 mt-5 gap-3">
            <div class="row">
                <select name="table" id="table-select" class="form-select" required>
                <option value="">--Tavolo--</option>
                <?php for ($i = 0; $i < tablesNumber; $i++): ?>
                    <option>
                        <?= $i ?>
                    </option>
                <?php endfor; ?>
                </select>
            </div>

            <div class="row mt-3">
                <select name="plate" id="plate-select" class="form-select" required>
                <option value="">--Piatto--</option>
                <?php foreach (products as $id => $product): ?>
                    <option value="<?= $id ?>">
                        <?= $product["name"] ?> - €<?= $product["price"] ?>
                    </option>
                <?php endforeach; ?>
                </select>
            </div>

            <div class="row mt-3">
                <button class="btn btn-primary w-100" type="submit">
                    Add order
                </button>
            </div>
        </div>
    </form>


    <h1 class="text-center mt-5">
        Your orders
    </h1>

    <div class="container mt-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($orders_by_table as $table => $orders): ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">
                            Table <?= $table ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            $total = 0;
                            foreach ($orders as $plates):

                                $product = products[$plates["plate"]];
                                $total += $product["price"];
                                ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= $product["name"] ?>
                                    <span class="d-flex align-items-center">
                                        <span class="badge bg-secondary rounded-pill">
                                            €<?= number_format(
                                                $product["price"],
                                                2,
                                            ) ?>
                                        </span>
                                        <form method="POST" action="/delete_order.php" class="ms-2">
                                            <input type="hidden" name="uid" value="<?= $plates[
                                                "uid"
                                            ] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </span>
                                </li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                        <div class="card-footer">
                            <strong>Total: €<?= number_format(
                                $total,
                                2,
                            ) ?></strong>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

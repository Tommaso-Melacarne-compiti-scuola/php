<?php
session_start();

$allProducts = [
    [
        "id" => 1,
        "name" => "Laptop",
        "price" => 999.99,
    ],
    [
        "id" => 2,
        "name" => "Smartphone",
        "price" => 699.99,
    ],
    [
        "id" => 3,
        "name" => "Headphones",
        "price" => 199.99,
    ],
    [
        "id" => 4,
        "name" => "Smartwatch",
        "price" => 249.99,
    ],
];

// is a cart if query param "cart" is set to 1
$isCart = isset($_GET["cart"]) && $_GET["cart"] == "1";

$cart_ids_qty = $_SESSION["cart"] ?? [];

$cart_ids = array_keys($cart_ids_qty);
$cartProducts = array_filter(
    $allProducts,
    fn($product) => in_array($product["id"], $cart_ids),
);

$products = $isCart ? $cartProducts : $allProducts;
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Shop</title>
<body>
    <?php if ($isCart): ?>
        <a href="/" class="btn btn-secondary m-3">Back to Products</a>
        <h1 class="text-center">Your Cart</h1>
    <?php else: ?>
        <a href="/?cart=1" class="btn btn-secondary m-3">
            View Cart (<?= count($cart_ids) ?>)
        </a>
        <h1 class="text-center">Products</h1>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body d-flex flex-column">
                            <?= "<img src=\"https://picsum.photos/200.webp?{$product["id"]}\" class=\"card-img-top\" alt=\"...\">" ?>
                            <h5 class="card-title mt-3"><?= htmlspecialchars(
                                $product["name"],
                            ) ?></h5>
                            <p class="card-text">
                                <?= number_format($product["price"], 2) ?> €
                            </p>
                            <?php if ($isCart): ?>
                            <form method="POST" action="add_to_cart.php">
                                <input type="hidden" name="product_id" value="<?= $product[
                                    "id"
                                ] ?>">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary form-control" type="submit" formaction="decrease_from_cart.php">
                                        -
                                    </button>
                                    <input type="text" disabled class="text-center form-control" value="<?= $cart_ids_qty[
                                        $product["id"]
                                    ] ?> ">
                                    <button class="btn btn-outline-secondary form-control" type="submit" formaction="add_to_cart.php">
                                        +
                                    </button>
                                </div>
                            </form>
                            <?php else: ?>
                                <form method="POST" action="add_to_cart.php" class="mt-auto">
                                    <input type="hidden" name="product_id" value="<?= $product[
                                        "id"
                                    ] ?>">
                                    <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($isCart && count($cartProducts) > 0): ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center mt-5">
                        Total:
                        <?= number_format(
                            array_reduce(
                                $cartProducts,
                                fn($sum, $product) => $sum + $product["price"],
                                0,
                            ),
                            2,
                        ) ?> €
                    </h3>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>

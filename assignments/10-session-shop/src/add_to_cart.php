<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

// if the request method is POST, add the item to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    if (!in_array($product_id, $cart)) {
        $cart[] = $product_id;
    }

    $_SESSION['cart'] = $cart;
    header('Location: /');
    exit();
}

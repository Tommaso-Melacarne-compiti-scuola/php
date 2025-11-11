<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

// if the request method is POST, add the item to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    if (isset($cart[$product_id])) {
        $cart[$product_id]--;
        if ($cart[$product_id] <= 0) {
            unset($cart[$product_id]);
        }
    }

    $_SESSION['cart'] = $cart;
    header('Location: /?cart=1');
    exit();
}

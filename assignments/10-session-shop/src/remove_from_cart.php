<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

// if the request method is POST, add the item to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    if (($key = array_search($product_id, $cart)) !== false) {
        unset($cart[$key]);
    }

    $_SESSION['cart'] = array_values($cart);
    header('Location: /?cart=1');
    exit();
}

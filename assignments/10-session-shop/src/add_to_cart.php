<?php
session_start();
$cart = $_SESSION['cart'] ?? [];

// if the request method is POST, add the item to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_id'])) {

        // TODO fix the array to make it associative
        $product_id = $_POST['product_id'];
        if (array_key_exists($product_id, $cart)) {
            $cart[$product_id] += 1;
        } else {
            $cart[$product_id] = 1;
        }


        $_SESSION['cart'] = $cart;
        header('Location: /?cart=1');
        exit();
    }
}

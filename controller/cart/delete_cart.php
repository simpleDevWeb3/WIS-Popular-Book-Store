<?php
require_once __DIR__ . '/../../function.php';
require_once __DIR__ . '/../../Database.php';
$db = new Database();

if (is_post()) {
    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        die("Invalid user.");
    }

    // get cart_id
    $stm = $db->conn->prepare("SELECT cart_id FROM cart WHERE user_id = :user_id");
    $stm->execute(['user_id' => $user_id]);
    $cart = $stm->fetch();

    if (!$cart) {
        die("Cart not found.");
    }

    $cart_id = $cart['cart_id'];


    // delete all product inside cartDetails under cart_id
    $stm = $db->conn->prepare("DELETE FROM cartDetails WHERE cart_id = :cart_id");
    $stm->execute(['cart_id' => $cart_id]);



    header("Location: cart.php");
    exit;
}
?>
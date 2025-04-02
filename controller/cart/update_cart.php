<?php
require_once __DIR__ . '/../../function.php';
require_once __DIR__ . '/../../Database.php';
$db = new Database();


if (is_post()) {
    $cart_id = $_POST['cart_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $action = $_POST['action'] ?? null;
    $stock = $_POST['stock'] ?? null;

    if (!$cart_id || !$product_id) {
        die("Invalid cart item.");
    }

    // get current quantity
    $stm = $db->conn->prepare("SELECT quantity FROM cartDetails WHERE cart_id = :cart_id AND product_id = :product_id");
    $stm->execute(['cart_id' => $cart_id, 'product_id' => $product_id]);
    $row = $stm->fetch();

    if (!$row) {
        die("Product not found in cart.");
    }

    $quantity = $row['quantity'];

    // adjust quantity
    if ($action === 'increase') {
        $quantity++;
    } elseif ($action === 'decrease' && $quantity > 1) {
        $quantity--;
    } else {
        // if qty become 0 -> delete
        $stm = $db->conn->prepare("DELETE FROM cartDetails WHERE cart_id = :cart_id AND product_id = :product_id");
        $stm->execute(['cart_id' => $cart_id, 'product_id' => $product_id]);
        header("Location: cart.php");
        exit;
    }

    if (!is_numeric($quantity) || $quantity < 1 || $quantity > $stock) {
        die("Quantity not valid！");
    }

    // update database
    $stmt = $db->prepare("UPDATE cartDetails SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id");
    $stmt->execute(['quantity' => $quantity, 'cart_id' => $cart_id, 'product_id' => $product_id]);

    
    header("Location: cart.php");
    exit;
}
?>
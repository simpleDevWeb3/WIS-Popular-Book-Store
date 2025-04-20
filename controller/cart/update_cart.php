<?php
require_once __DIR__ . '/../../function.php';
require_once __DIR__ . '/../../Database.php';
$db = new Database();


if (is_post()) {
    $cart_id = $_POST['cart_id'] ?? null;
    $product_id = $_POST['product_id'] ?? null;
    $action = $_POST['action'] ?? null;
    $input_quantity = $_POST['quantity'] ?? null;
    $stock = $_POST['stock'] ?? null;

    if (!$cart_id || !$product_id) {
        die("Invalid cart item.");
    }

    // get current quantity
    $stm = $db->query("SELECT quantity FROM cartDetails WHERE cart_id = :cart_id AND product_id = :product_id", [
        'cart_id' => $cart_id,
        'product_id' => $product_id
    ]);
    $row = $stm->fetch();

    if (!$row) {
        die("Product not found in cart.");
    }

    $current_quantity =  (int) $row['quantity'];

    //process input quantity
    if ($action === 'increase') {
        $final_quantity = $current_quantity + 1;
    } elseif ($action === 'decrease') {
        $final_quantity = $current_quantity - 1;
    } elseif (isset($input_quantity) && is_numeric($input_quantity) && $input_quantity > 0) {
        $final_quantity = (int) $input_quantity;
    } 

    
    if ($final_quantity < 1) {
        $db->query("DELETE FROM cartDetails WHERE cart_id = :cart_id AND product_id = :product_id", [
            'cart_id' => $cart_id,
            'product_id' => $product_id
        ]);
        header("Location: /cart");
        exit;
    }

    
    

    if (!is_numeric($final_quantity)) {
        die("Quantity not valid！");
    }



    // check stock
    $stockQuery = $db->query("SELECT stock FROM product_details WHERE product_id = :product_id", [
        'product_id' => $product_id
    ]);
    $stock = $stockQuery->fetchColumn();


    // update database
    $db->query("UPDATE cartDetails SET quantity = :quantity WHERE cart_id = :cart_id AND product_id = :product_id", [
        'quantity' => $final_quantity,
        'cart_id' => $cart_id,
        'product_id' => $product_id
    ]);
    
    header("Location: /cart");
    exit;
}
?>
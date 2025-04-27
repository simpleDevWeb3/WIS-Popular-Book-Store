<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

require_once __DIR__ . '/../function.php';
require_once __DIR__ . '/../Database.php';

$db = new Database();
$_user = $_SESSION['user'];
$user_id = $_user['user_id'];
$payment_method = $_POST['payment_method'] ?? 'Unknown';



try {
    $db->conn->beginTransaction();

    // get user cart_id
    $cartData = $db->query("SELECT cart_id FROM cart WHERE user_id = :user_id", [
        'user_id' => $user_id
    ])->fetch();

    if (!$cartData) {
        throw new Exception("Cart not found.");
    }
    $cart_id = $cartData['cart_id'];

    //get all product in cart
    $cartItems = $db->query("SELECT product_id, quantity, price FROM cartDetails WHERE cart_id = :cart_id", [
        'cart_id' => $cart_id
    ])->fetchAll();

    // calculate total price
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $tax = $subtotal * 0.06;
    $total_price = $subtotal + $tax;

    foreach ($cartItems as $item) {
        $db->query("
            UPDATE product_details 
            SET stock = stock - :quantity 
            WHERE product_id = :product_id
        ", [
            'quantity' => $item['quantity'],
            'product_id' => $item['product_id']
        ]);
    }

    //get user address
    $addressData = $db->query("
    SELECT a.street, a.postal_code, c.city_name, s.state_name
    FROM addresses a
    JOIN cities c ON a.city_id = c.city_id
    JOIN states s ON a.state_id = s.state_id
    WHERE a.user_id = :user_id
    LIMIT 1
    ", [
        'user_id' => $user_id
    ])->fetch();

    if (!$addressData) {
        throw new Exception("Address not found.");
    }

    $fullAddress = $addressData['street'] . ', ' . 
               $addressData['postal_code'] . ' ' . 
               $addressData['city_name'] . ', ' . 
               $addressData['state_name'];

    //get new order id
    $order_id = 'ORD_' . date('YmdHis') . substr(uniqid(), -5);
    $order_date = date('Y-m-d H:i:s');
    $shipping_date = date('Y-m-d H:i:s', strtotime('+7 days'));
    

    //transfer to order table
    $db->query("INSERT INTO `order` (order_id, user_id, total_price, status, order_date, Payment_method, shipping_date, address)
                VALUES (:order_id, :user_id, :total_price, :status, :order_date, :payment_method, :shipping_date, :address)", [
        'order_id'   => $order_id,
        'user_id'    => $user_id,
        'total_price'=> $total_price,
        'status'     => 'pending',
        'order_date' => $order_date,
        'payment_method' => $payment_method,
        'shipping_date'  => $shipping_date,
        'address'    => $fullAddress
    ]);



    //product in cartDetails table transfer to orderDetails table
    foreach ($cartItems as $item) {
        //get product name and image
        $productData = $db->query("SELECT name, image FROM products WHERE product_id = :product_id", [
            'product_id' => $item['product_id']
        ])->fetch();
    
        if (!$productData) {
            throw new Exception("Product not found for product_id: " . $item['product_id']);
        }

        $db->query("INSERT INTO orderDetails (order_id, product_id, quantity, price, product_name, product_image)
                    VALUES (:order_id, :product_id, :quantity, :price, :product_name, :product_image)", [
            'order_id'   => $order_id,
            'product_id' => $item['product_id'],
            'quantity'   => $item['quantity'],
            'price'      => $item['price'],
            'product_name'  => $productData['name'],
            'product_image' => $productData['image']
        ]);
    }

    //after transfer delete all in cart
    $db->query("DELETE FROM cartDetails WHERE cart_id = :cart_id", [
        'cart_id' => $cart_id
    ]);

    $db->conn->commit();

    $_SESSION['order_success'] = true;
    header("Location: /checkOut?success=1");
    exit;

} catch (Exception $e) {
    // roll one more time，ensure data consistence
    $db->conn->rollBack();
    echo("Order processing failed: " . $e->getMessage());
}

?>
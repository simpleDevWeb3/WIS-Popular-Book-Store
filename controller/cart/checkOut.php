<?php
require_once __DIR__ . '/../../function.php';
require_once __DIR__ .'/../../Database.php';

$db = new Database();
$carts = [];
$subtotal = 0;
$_user = $_SESSION['user'];
$user_id = $_user['user_id'];


if (is_post() && isset($_POST['add_quantity'], $_POST['product_id'])) {
    addToCart($db);
    dd('success!');
  }
  
  
  if ($user_id) {
      $cart_id = $db->query("SELECT cart_id FROM cart WHERE user_id = :user_id", [
        'user_id' => $user_id
    ])->fetch();




 $stm = $db->query("
    SELECT c.cart_id, c.user_id, cd.price, cd.quantity, p.product_id, p.name, p.image
    FROM `cart` c
    JOIN `cartDetails` cd ON c.cart_id = cd.cart_id
    JOIN `products` p ON cd.product_id = p.product_id
    WHERE c.user_id = :user_id
", ['user_id' => $user_id])->fetchAll();



$carts = $stm;

foreach ($carts as $c) {
    $subtotal += $c['price'] * $c['quantity'];
    //count subtotal
  }

}


$tax = $subtotal * 0.06;
$total = $subtotal + $tax;

$_title = 'Check Out';
require __DIR__ . '/../../view/checkOut.view.php';
?>
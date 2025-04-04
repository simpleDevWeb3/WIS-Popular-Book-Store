<?php
require_once __DIR__ . '/../../function.php';
require_once __DIR__ .'/../../Database.php';

$db = new Database();
$carts = [];
$subtotal = 0;
$user_id = $_SESSION['user_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_quantity'], $_POST['product_id'])) {
    addToCart($db);
    dd('success!');
  }
  
  
  if ($_SESSION['user_id']) {
      $user_id = $_SESSION['user_id'];
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

$tax = 0;
$total = $subtotal + $tax;

$_title = 'Check Out';
require __DIR__ . '/../../view/checkOut.view.php';
?>
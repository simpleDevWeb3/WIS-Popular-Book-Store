<?php 
require_once __DIR__ . '/../../function.php';
require_once __DIR__ .'/../../Database.php';
require_once __DIR__ .'/../../Login.php';

 (auth('Member'));

$db = new Database();
$carts = [];
$subtotal = 0;
$_user = $_SESSION['user'] ?? null;



if (is_post() && isset($_POST['add_quantity'], $_POST['product_id'])) {
  addToCart($db);
  dd('success!');
}


if ($_user) {

    $cart_id = $db->query("SELECT cart_id FROM cart WHERE user_id = :user_id", [
      'user_id' => $_user ['user_id']
  ])->fetch();

 




  $carts = $db->query("
    SELECT c.cart_id, c.user_id, cd.price, cd.quantity, p.product_id, p.name, p.image, pd.stock
    FROM `cart` c
    JOIN `cartDetails` cd ON c.cart_id = cd.cart_id
    JOIN `products` p ON cd.product_id = p.product_id
    JOIN `product_details` pd ON p.product_id = pd.product_id
    WHERE c.user_id = :user_id
", ['user_id' =>  $_user ['user_id']])->fetchAll();


//count subtotal
foreach ($carts as $c) {
  $subtotal += $c['price'] * $c['quantity'];
}

}


$tax = 0;
$grand_total = $subtotal + $tax;


$_title = 'Cart';
require __DIR__ . '/../../view/cart.view.php';
?>
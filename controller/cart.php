
<?php 

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
    SELECT c.user_id, cd.price, cd.quantity, p.name, p.image
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
$grand_total = $subtotal + $tax;

$_title = 'Cart';
require 'view/cart.view.php';
?>
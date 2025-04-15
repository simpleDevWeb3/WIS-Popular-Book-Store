<?php
require_once __DIR__ . '/../function.php';
require_once __DIR__ .'/../Database.php';

$db = new Database();
$orders = [];
$_user = $_SESSION['user'];
$user_id = $_user ['user_id'];

if ($user_id) {

    $order_id = $db->query("SELECT order_id FROM `order` WHERE user_id = :user_id", [
      'user_id' => $user_id
  ])->fetch();


    $orders = $db->query("
        SELECT o.user_id, o.order_id, o.order_date, o.total_price, o.status, od.price, od.quantity, p.name, p.image
        FROM  `order` o
        JOIN  orderDetails od ON o.order_id = od.order_id
        JOIN  products p ON od.product_id = p.product_id
        WHERE o.user_id = :user_id
        ORDER BY o.order_date DESC
    ", ['user_id' => $user_id])->fetchAll();

}



$_title = 'Order History';
require __DIR__ . '/../view/orderHistory.view.php';
?>
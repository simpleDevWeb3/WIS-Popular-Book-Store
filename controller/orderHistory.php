<?php
require_once __DIR__ . '/../function.php';
require_once __DIR__ .'/../Database.php';


$db = new Database();
$orders = [];
$_user = $_SESSION['user'];
$user_id = $_user ['user_id'];
$name = trim(req('name'));
$params = ['user_id' => $user_id];


if ($user_id) {
    $db->query("UPDATE `order` 
    SET status = 'completed' 
    WHERE status = 'pending' AND shipping_date <=  NOW()");

    $order_id = $db->query("SELECT order_id FROM `order` WHERE user_id = :user_id", [
      'user_id' => $user_id
  ])->fetch();


$sql = "
  SELECT o.user_id, o.order_id, o.order_date, o.total_price, o.status, o.Payment_method, o.shipping_date, od.price, od.quantity, od.product_id, od.product_name, od.product_image
  FROM `order` o
  JOIN orderDetails od ON o.order_id = od.order_id
  WHERE o.user_id = :user_id
  
";

if ($name !== '') {
  $sql .= " AND (p.name LIKE :name OR od.product_id LIKE :name)";
  $params['name'] = "%{$name}%";
}

$sql .= " ORDER BY o.order_date DESC";

$orders = $db->query($sql, $params)->fetchAll();

}

function getProductCategoryId($db, $product_id) {
    $result = $db->query("SELECT category_id FROM product_details WHERE product_id = :product_id", [
        'product_id' => $product_id
    ])->fetch();
    return $result ? $result['category_id'] : 0;
}


  




$_title = 'Order History';
require __DIR__ . '/../view/orderHistory.view.php';
?>
<?php 

$_user = $_SESSION['user'] ?? null;
$db = new Database();
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;

if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["comment"],$_POST["product_id"])){
  $comment = trim($_POST["comment"]);
 
  $product_id = $_POST["product_id"];
  $user_id = $_user['user_id'];
  $profile_image = $_user['profile_image'] ?? "img/user/default.jpg";

  if(!$user_id){
    echo json_encode(["error" => "User not logged In"]);
    exit;
  }
 
  $query ="INSERT INTO comments(user_id,product_id,comment,created_at) VALUES(?,?,?,NOW())";
  $stmt = $db->query($query,[$user_id, $product_id, $comment]);
  exit();


} 

if($_user){
  $orders = $db->query(
    "SELECT * FROM `order` WHERE user_id = :user_id",
    ['user_id' => $_user['user_id']]
  )->fetchAll();
  
  $orderIds = array_column($orders, 'order_id');
  
  $placeholders = implode(', ', array_fill(0, count($orderIds), '?'));
  
  $order_details = $db->query("SELECT * FROM orderdetails WHERE order_id IN ($placeholders)",$orderIds)->fetchAll();
}


function isBuy($product_id,$order_details){

  foreach($order_details as $order){
    if($product_id == $order['product_id']){
      return true;
    }
  }
 
 return false;
}


//Join user table with comment
$comment_query = "SELECT c.comment_id, c.*, u.username, u.profile_image
                  FROM comments c 
                  JOIN users u ON c.user_id = u.user_id 
                  WHERE c.product_id = :product_id
                  ORDER BY c.created_at DESC";




$p = new Paging($db,$comment_query, ['product_id' => $product_id], 10, $page, $db);

$comments = $p->result;

require "view/comment.view.php"


?>

<script>

const comments = <?php echo json_encode($comments); ?>;
let comments_id = []
console.log(comments);
comments.forEach(comment => {
  comments_id.push(comment.comment_id); 

});


</script>

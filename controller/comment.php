<?php 


if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$db = new Database();

if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["comment"],$_POST["product_id"])){
  $comment = trim($_POST["comment"]);
 
  $product_id = $_POST["product_id"];
  $user_id = $_SESSION['user_id'];
  $profile_image = $_SESSION['profile_image'] ?? "img/user/default.jpg";

  if(!$user_id){
    echo json_encode(["error" => "User not logged In"]);
    exit;
  }
 
  $query ="INSERT INTO comments(user_id,product_id,comment,created_at) VALUES(?,?,?,NOW())";
  $stmt = $db->query($query,[$user_id, $product_id, $comment]);
  exit();


} 

//Join user table with comment
$comment_query = "SELECT c.*, u.username, u.profile_image
                  FROM comments c 
                  JOIN users u ON c.user_id = u.user_id 
                  WHERE c.product_id = :product_id";
$comments = $db->query($comment_query, ['product_id' => $product_id])->fetchAll();


require "view/comment.view.php"


?>

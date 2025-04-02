<?php

//front door

require 'Database.php';
require 'function.php';//base where session start

$db = new Database();
$_SESSION['user_id'] = "3d4f93c4-025f-11f0-9";
if (!isset($_SESSION['user_id'])) {
  echo "User not logged in.";
  die();
}

  if (isset($_SESSION['user_id'])) {
    $query = "SELECT * FROM users WHERE user_id = :user_id";
    $imgQuery = "SELECT profile_image FROM users WHERE user_id = :user_id";
    $user = $db->query($query, ['user_id' => $_SESSION['user_id']])->fetch();
  
  
    if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['profile_image'] = $user['profile_image'] ?? 'img/user/default.jpg';
        
    }else {
      echo "User not found in database.";
      die();
  }
}

require 'Paging.php';
require 'router.php';







?>
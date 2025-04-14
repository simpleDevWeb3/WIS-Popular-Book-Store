<?php 
//Variable store email password
$new_username = $_POST['username'] ?? 'Not logged in';
$new_email =$_POST['create-email'] ?? 'Not logged in';
$new_password =$_POST['confirm-password'] ?? 'Not logged in';


/*
$db = new Database();
$user = $db->query('SELECT * FROM user WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();
*/       


require 'view/login.view.php';

?>
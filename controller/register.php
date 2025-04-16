<?php 
//Variable store email password
$new_username = $_POST['new-username'] ?? 'Not logged in';
$new_email =$_POST['new-email'] ?? 'Not logged in';
$new_password =$_POST['confirm-password'] ?? 'Not logged in';


/*
$db = new Database();
$user = $db->query('SELECT * FROM user WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();
*/       


require 'view/register.view.php';



?>
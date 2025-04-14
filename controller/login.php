<?php 



     

require 'view/login.view.php';

$db = new Database();

//Variable store email password
$email =$_POST['email'] ?? 'Not logged in';
$password =$_POST['password'] ?? 'Not logged in';

$_err = null;

if(!$_err){

  $user = $db->query('SELECT * FROM users WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();

  if($user){
    //dd($user);
    login($user);
  }
  else{
    $_err['password'] = 'Not matched';
  
  }

}

?>
<?php 


require 'view/login.view.php';

$db = new Database();





if (isset($_POST['email']) && isset($_POST['password'])) {
    
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  // Fetch the user by email
  $user = $db->query('SELECT * FROM users WHERE email = ?', [$email])->fetch();

  if (!$user) {
      $_SESSION['error'] = 'Invalid email or password';
     
  } else {
      // Check password
      if ($user['password'] === sha1($password)) {
           $user = $db->query('SELECT * FROM users WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();
          login($user); // your custom login function
      } else {
        $_SESSION['error'] = 'Invalid email or password';
      }
  }
}



 
 



?>
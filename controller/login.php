<?php 



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

             // Fetch address for this user
             $address = $db->query('SELECT * FROM addresses WHERE user_id = ?', [$user['user_id']])->fetch();

             // Merge user and address data
             if ($address) {
                 $user = array_merge($user, $address);
             }
      
            login($user); 
      
          
  
       
      } else {
        $_SESSION['error'] = 'Invalid email or password';
      }
  }
}



require 'view/login.view.php';
 
 



?>
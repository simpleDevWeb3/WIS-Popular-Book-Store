<?php 
$db = new Database();
$_err = [];


(auth('Member','Admin')); 

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $current_password = $_POST['password'] ?? '';


            


        if ($_user['password'] === sha1($current_password)) {
          if ($new_password === $confirm_password) {

              if (isValidPassword($new_password)) {
                  // Proceed with password update 
                  $stmt =$db->query(
                    'UPDATE users SET password  = ?  WHERE user_id = ?',
                    [sha1($new_password) , $_user['user_id']]
                  );
                  
                 if ($stmt->rowCount() > 0) {
                  redirect('/login');
                 }

              } else {
                  // Invalid new password format
                  $_err['password_format'] = "must be at least 8 characters, include a letter and a number.";
              }
          } else {
              // Password confirmation does not match
              $_err['confirm_password'] = "Password is not match with new password";
          }
      } else {
          // Current password is incorrect
          $_err['password'] = "Password is not matching";
         
      }
  

  }

?>
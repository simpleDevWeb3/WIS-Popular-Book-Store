<?php 

$db = new Database();
$err_email = "";
$err_name = "";
$err_acc = "";
$err_password = "";
$err_password_match = "";
$complete = "";
$isValid = true;




if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $newUserName = $_POST['new-username'] ?? '';
  $newUserEmail = $_POST['new-user-email'] ?? '';
  $newUserPassword= $_POST['new-user-password'] ?? '';
  $confirmPassword = $_POST['confirm-user-password'] ?? '';

  
  
//email and username


  if(isDuplicateName($db,$newUserName))
  {
    $err_name = "Username already taken!";
    $isValid = false;
  }

  if(!isValidUserName($newUserName)){
  
    $err_name ="Username must be 3–20 characters and contain only letters, numbers, or underscores.";

    $isValid = false;
  }
  
  if(isDuplicateEmail($db,$newUserEmail))
  {
    $err_email = "Email already exist!";
    $isValid = false;

    }
 
  if(!isValidEmail($newUserEmail)){
    $err_email = "Invalid Email Format!";
    $isValid = false;
  }

//password

if(!isValidPassword($newUserPassword)){
  $err_password = "Password must be at least 8 characters, include a letter and a number.";
 
  $isValid = false;

}else{
  if(!isMatchPassword($newUserPassword,$confirmPassword)){
    
    $err_password_match = "Password is not match";

    $isValid = false;

  }
}

 


if ($isValid) {
    $_SESSION['new_user'] = [
        'username' => $newUserName,
        'email' => $newUserEmail,
        'password' => sha1($newUserPassword), // Using sha1 instead of password_hash
    ];
    redirect("/register-address");
}

  




//Debug

 /*
  $all = "$newUserName\n$newUserEmail\n$newUserPassword\n$confirmPassword\n$err_email\n$err_name\n$err_acc\n$complete
          \n$err_password \n$err_password_match";
  dd($all);
*/
}

?>
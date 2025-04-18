<?php 

$db = new Database();
$err_email = "";
$err_name = "";
$err_acc = "";
$err_password = "";
$err_password_match = "";
$complete = "";
$isValid = true;

function isDuplicateAcc($db, $email, $username){
  $query = "SELECT * FROM users WHERE email = :email AND username = :username";
  $stmt = $db->query($query, ['email' => $email, 'username' => $username]);
  return $stmt->rowCount() > 0;
}

function isDuplicateEmail($db, $email){
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $db->query($query, ['email' => $email]);
  return $stmt->rowCount() > 0;
}

function isDuplicateName($db, $username){
  $query = "SELECT * FROM users WHERE username = :username";
  $stmt = $db->query($query, ['username' => $username]);
  return $stmt->rowCount() > 0;
}

function isValidUserName($username){
    if (!preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username)) {
    return false;
      
  }

  return true;
}

function isMatchPassword($password, $confirm) {
  return $password === $confirm;
}


function isValidPassword($password) {
  if (strlen($password) < 8) {
      return false;
  }

  if (!preg_match('/[A-Za-z]/', $password)) {
      return false;
  }

  if (!preg_match('/[0-9]/', $password)) {
      return false;
  }

  return true;
}

function isValidEmail($email) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    if (strlen($email) > 100) {
        return false;
    }

    $parts = explode('@', $email);
    if (strlen($parts[0]) > 64) {
        return false; 

   
  }

  return true;
}


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
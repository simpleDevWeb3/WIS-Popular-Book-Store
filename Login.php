<?php


$db = new Database();
$_user = $_SESSION['user'] ?? null;





function redirect($url = null) {
    $url ??= $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
  }



function login($user, $url = '/'){
    $_SESSION['user'] = $user;
    redirect($url);
}

function logout($url = '/'){
    unset($_SESSION['user']);
    redirect($url);
}
function auth(...$roles) {
  global $_user;

  if (isset($_user['role']) && in_array($_user['role'], $roles)) {
    return true; 
  } 
  else{
    redirect('/');
  }
}



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



//Variable store email password
function isValidName($name) {
  // Trim whitespace
  $name = trim($name);

  // Check if empty or length out of bounds
  if (empty($name) || strlen($name) < 2 || strlen($name) > 50) {
      return false;
  }

  // Regex: only letters, apostrophes, hyphens, and spaces
  if (!preg_match("/^[A-Za-z]+([-' ][A-Za-z]+)*$/", $name)) {
      return false;
  }

  return true;
}

function isDuplicatePhone($db, $phone){
  $query = "SELECT * FROM users WHERE phone_number = :phone_number";
  $stmt = $db->query($query, ['phone_number' => $phone]);
  return $stmt->rowCount() > 0;
}

function isUnderAge($dob){
  $dobTimeStamp = strtotime($dob);
  $eighteenYearsAgo = strtotime('-18 years');

  return $dobTimeStamp <= $eighteenYearsAgo;
}


function isValidPhone($phone){
  if(!preg_match("/^\d{3}-\d{3}-\d{4}$/",$phone)){
    return false;
  }

  return true;
}

?>


<?php 



$isValid = true;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $firstName = $_POST['first-name'] ?? '';
  $lastName = $_POST['last-name'] ?? '';
  $gender = $_POST['gender'] ?? '';
  $dob = $_POST['dob'] ?? '';
  $phone = $_POST['phone'] ?? '';

   if (!isValidName($firstName) || !isValidName($lastName)) {
       $error = "Please enter valid first and last names.";
       $isValid = false;
   } 
   if(!isUnderAge($dob)){
       $errAge = "Must be atleast 18 years old";
       $isValid = false;
   }
   if(!isValidPhone($phone)){
      $errPhone = "invalid phone number must be e.g. 123-456-7890 format";
      $isValid = false;
   }

   if($isValid) {

    redirect("/register-account");
    
  }
}

/*
$db = new Database();
$user = $db->query('SELECT * FROM user WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();
*/       




?>
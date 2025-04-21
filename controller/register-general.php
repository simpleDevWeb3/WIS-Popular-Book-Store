<?php 

$db = new Database();

$isValid = true;


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
   if(isDuplicatePhone($db, $phone)){
    $errPhone = "Phone number already exist";
    $isValid = false;
   }
   if($isValid) {
      $_SESSION['general'] = [
        'firstName' => $firstName,
        'lastName'  => $lastName,
        'gender'    =>  $gender, // Using sha1 instead of password_hash
        'dob'       =>  $dob,
        'phone'     =>  $phone,
    ];
    redirect("/register-account");
    
  }
}

/*
$db = new Database();
$user = $db->query('SELECT * FROM user WHERE email = ? AND password = SHA1(?)',[$email,$password])->fetch();
*/       




?>
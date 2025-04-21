<?php 


$db = new Database();
$_err = [];
$isValid = true;

(auth('Member','Admin')); 
    




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email       = $_POST['email'] ?? '';
  $_username   = $_POST['username']?? '';
  $first_name  = $_POST['first_name']?? '';
  $last_name   = $_POST['last_name']?? '';
  $phone       = $_POST['phone_number']?? '';



  // Validate: email
  if ($email === '') {
    $_err['email'] = 'Required';
    $isValid = false;
   
  }
  else if(!isValidEmail($email)) {
    $_err['email'] = "Invalid Email Format!";
    $isValid = false;
  }

  if ($email !== $_user['email'] && isDuplicateEmail($db, $email)) {
    $_err['email'] = "Email already exists!";
    $isValid = false;
  }

 
  if($first_name === '' || $last_name === ''){
    $_err['name'] = "Required";
    $isValid = false;
  }

  if (!isValidName($first_name) || !isValidName($last_name)) {
    $_err['name'] = "Please enter valid first and last names.";
    $isValid = false;
  }

  if ($_username === ''){
    $_err['username'] = "Required";
    $isValid = false;
  } 
  
  if ($_username !== $_user['username'] && isDuplicateName($db, $_username)) {
    $_err['username'] = "Username already taken!";
    $isValid = false;
  }

  if (!isValidPhone($phone)) {
    $_err['phone'] = "Invalid phone number format.";
    $isValid = false;
  }

  if ($phone !== $_user['phone_number'] && isDuplicatePhone($db, $phone)) {
    $_err['phone'] = "Phone number already exists";
    $isValid = false;
  }

  
  if ($isValid) {
   
  
    var_dump($email, $_username, $first_name, $last_name, $phone);

    $stmt =$db->query(
      'UPDATE users SET email = ?, username = ?, first_name = ?, last_name = ?, phone_number = ? WHERE user_id = ?',
      [$email, $_username, $first_name, $last_name, $phone, $_user['user_id']]
    );
   
 

    if ($stmt->rowCount() > 0) {

      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['username'] = $_username;
      $_SESSION['user']['first_name'] = $first_name;
      $_SESSION['user']['last_name'] = $last_name;
      $_SESSION['user']['phone_number'] = $phone;
    
      redirect('/profile-view');
      echo "Profile updated successfully!";
    } else {
      echo "No changes made.";
    }
    
  }
}










?>
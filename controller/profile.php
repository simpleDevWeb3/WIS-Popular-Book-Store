<?php 


$db = new Database();
$_err = [];
$isValid = true;

(auth('Member','Admin')); 
    
$image = $_user['profile_image'] ?? "img/user/default.jpg";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email       = $_POST['email'] ?? '';
  $_username   = $_POST['username']?? '';
  $first_name  = $_POST['first_name']?? '';
  $last_name   = $_POST['last_name']?? '';
  $phone       = $_POST['phone_number']?? '';
 

  
  $f = get_file('image');


  if ($f) {

    $allowedTypes = ['image/jpeg', 'image/png'];

    if (!str_starts_with($f->type, 'image/')) {
        $_err['image'] = 'Only image files allowed';
        $isValid = false;
    }
    else if (!in_array($f->type, $allowedTypes)) {
        $_err['image'] = 'Only JPG images are allowed';
        $isValid = false;
    }
    elseif ($f->size > 1 * 1024 * 1024) {
        $_err['image'] = 'Maximum image size is 1MB';
            $isValid = false;
    } else {
     
        $image = save_photo($f, 'Img/','user/');
       
       
        $_SESSION['image'] = $image; 
        
    }
}
 
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
  

        if ($f) {
          unlink("$image");
          $image = save_photo($f,'Img/','user/');
      }

    $stmt =$db->query(
      'UPDATE users SET email = ?, username = ?, first_name = ?, last_name = ?, phone_number = ? ,profile_image = ? WHERE user_id = ?',
      [$email, $_username, $first_name, $last_name, $phone,$image, $_user['user_id']]
    );
   
 

    if ($stmt->rowCount() > 0) {

      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['username'] = $_username;
      $_SESSION['user']['first_name'] = $first_name;
      $_SESSION['user']['last_name'] = $last_name;
      $_SESSION['user']['phone_number'] = $phone;
      $_SESSION['user']['profile_image'] = $image;
    
      redirect('/profile-view');
      echo "Profile updated successfully!";
    } else {
      echo "No changes made.";
    }
    
  }
}










?>
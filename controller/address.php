<?php 
$db = new Database();
$isValid = true;
$_err = [];

(auth('Member','Admin')); 
// Fetch all states for dropdown options
$states = $db->query("SELECT * FROM States")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
      $streetAddress = trim($_POST['street'] ?? '');
      $stateId = $_POST['states'] ?? '';
      $cityId = $_POST['cities'] ?? '';
      $postalCode = $_POST['postal-code'] ?? '';
      $all = $streetAddress . " " . $stateId . " " . $cityId . " " . $postalCode;

      if (empty($streetAddress)) {
          $isValid = false;
          $_err['street'] = "Street address is required.";
  
       } elseif (!preg_match('/^[0-9]{1,5}[\s,.-]+[a-zA-Z\s]+(?:[.,\-]?[a-zA-Z\s]*)*$/', $streetAddress)) {
          $isValid = false;
          $_err['street'] = "Street address must start with a number followed by the street name.";
      }

      if ($stateId === 'select states') {
        $isValid = false;
        $_err['state'] = "Please select a valid state.";
    }

    if ($cityId === 'select city' ) {
        $isValid = false;
        $_err['city'] = "Please select a valid city.";
    }

    if ($postalCode === 'select postal') {
        $isValid = false;
        $_err['postal'] = "Please enter a valid postal code.";
       
    }

  
    if ($isValid && empty($_err)) {
      
      $stmt = $db->query(
        'UPDATE addresses SET street = ?, postal_code = ?, city_id = ?, state_id = ? WHERE user_id = ?',
        [ $streetAddress, $postalCode, $cityId, $stateId, $_user['user_id'] ]
    );

     
   
  
        if ($stmt->rowCount() > 0) {
       // reassign current user to updated user 

        $updatedUser = $db->query("SELECT * FROM users WHERE user_id = ?", [$_user['user_id']])->fetch();
        $_SESSION['user'] = $updatedUser;
        $_user = $updatedUser;
        
    } else {
        echo "Address is already up-to-date. No changes were made.";
    }


      
    } 

}  

?>
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
  
      if (empty($streetAddress)) {
          $isValid = false;
          $_err['street'] = "Street address is required.";
  
       } elseif (!preg_match('/^[0-9]{1,5}[\s,.-]+[a-zA-Z\s]+(?:[.,\-]?[a-zA-Z\s]*)*$/', $streetAddress)) {
          $isValid = false;
          $_err['street'] = "Street address must start with a number followed by the street name.";
      }

      if ($stateId == 'select states') {
        $isValid = false;
        $_err['state'] = "Please select a valid state.";
    }

    if ($cityId == 'select city' ) {
        $isValid = false;
        $_err['city'] = "Please select a valid city.";
    }

    if ($postalCode == 'select postal') {
        $isValid = false;
        $_err['postal'] = "Please enter a valid postal code.";
       
    }

  
    if ($isValid && empty($_err)) {
      
      $stmt =$db->query(
        'UPDATE addresses SET  street  = ?, postal_code = ?, city_id = ?, state_id = ? WHERE user_id = ?',
        [ $streetAddress,  $postalCode,  $cityId, $stateId, $_user['user_id']]
      );
     
   
  
      if ($stmt->rowCount() > 0) {
  
        
        $_SESSION['user']['street_address'] =  $streetAddress;
        $_SESSION['user']['states']=   $stateId; 
        $_SESSION['user']['cities'] =  $cityId; 
        $_SESSION['user']['postal-code'] =  $postalCode;
      
 
    
        echo "Profile updated successfully!";
      } else {
        echo "No changes made.";
      }

      
    } 

}  

?>
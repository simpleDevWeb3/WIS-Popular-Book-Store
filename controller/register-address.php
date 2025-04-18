<?php
$db = new Database();
$isValid = true;
$errors = [];

// Fetch all states for dropdown options
$states = $db->query("SELECT * FROM States")->fetchAll();

// Get all session data
$general_info = $_SESSION['general'] ?? null;
$new_user = $_SESSION['new_user'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
;
   
    $streetAddress = trim($_POST['street_address'] ?? '');
    $stateId = $_POST['states'] ?? '';
    $cityId = $_POST['cities'] ?? '';
    $postalCode = $_POST['postal-code'] ?? '';

    if (empty($streetAddress)) {
        $isValid = false;
        $errors['street'] = "Street address is required.";

          } elseif (!preg_match('/^[0-9]{1,5}[\s,.-]+[a-zA-Z\s]+(?:[.,\-]?[a-zA-Z\s]*)*$/', $streetAddress)) {
        $isValid = false;
        $errors['street'] = "Street address must start with a number followed by the street name.";
    }

    if ($stateId == 'select states') {
        $isValid = false;
        $errors['state'] = "Please select a valid state.";
    }

    if ($cityId == 'select city' ) {
        $isValid = false;
        $errors['city'] = "Please select a valid city.";
    }

    if ($postalCode == 'select postal') {
        $isValid = false;
        $errors['postal'] = "Please enter a valid postal code.";
       
    }

  
    if ($isValid && empty($errors)) {
        $_SESSION['user_address'] = [
            'street'      => $streetAddress,
            'state_id'    => $stateId,
            'city_id'     => $cityId,
            'postal_code' => $postalCode
        ];

       require 'controller/registerProcess.php';
    } 
}
?>

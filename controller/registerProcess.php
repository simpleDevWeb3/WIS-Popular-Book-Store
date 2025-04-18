<?php


$general_info = $_SESSION['general'] ?? null;
$new_user = $_SESSION['new_user'] ?? null;
$new_address = $_SESSION['user_address'] ?? null;

$errors = '';

// Check if user submitted the final form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_registration'])) {

 
    if (!$new_user || !$general_info || !$new_address) {
        $errors = "Missing required user information.";
    }

  
    if (empty($errors)) {
        try {
            $db->conn->beginTransaction();

            $role = 'Member';

            // Insert into Users table
            $db->query("INSERT INTO Users(username, email, password, role, phone_number, first_name, last_name, dob, gender)
                        VALUES (:username, :email, :password, :role, :phone_number, :first_name, :last_name, :dob, :gender)",
                      [
                        'username' => $new_user['username'],
                        'email' => $new_user['email'],
                        'password' => $new_user['password'],  
                        'role' => $role,
                        'phone_number' => $general_info['phone'],
                        'first_name' => $general_info['firstName'],
                        'last_name' => $general_info['lastName'],
                        'dob' => $general_info['dob'],
                        'gender' => $general_info['gender']
                      ]);

            $user_id = $db->conn->lastInsertId();

            // Insert address if available
            if ($new_address) {
                $db->query("INSERT INTO addresses(user_id, street, postal_code, city_id, state_id)
                            VALUES (:user_id, :street, :postal_code, :city_id, :state_id)",
                          [
                            'user_id' => $user_id,
                            'street' => $new_address['street'],
                            'postal_code' => $new_address['postal_code'],
                            'city_id' => $new_address['city_id'],
                            'state_id' => $new_address['state_id']
                          ]);

               $db->query("INSERT INTO cart (user_id) VALUES ($user_id)");

            }

            $db->conn->commit();

            echo "Registration successful!";
            
            header("Location: /login");
            unset($_SESSION['general'], $_SESSION['new_user'], $_SESSION['user_address']);

        } catch (Exception $e) {
            $db->conn->rollBack();
            echo " Registration failed: " . $e->getMessage();
        }
    } 
}
?>

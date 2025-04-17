<?php 
$city_id = $_POST['city_id'];

$db = new Database();

$postal = $db->query('SELECT  postal_code FROM Cities WHERE city_id = :city_id',['city_id'=>$city_id])->fetch();

echo '<option>select postal</option>';
if ($postal) {
  // If the city was found and postal_code is available
  echo "<option value='" . $postal['postal_code'] . "'>" . $postal['postal_code'] . "</option>";
} else {
  // If no city was found for the given city_id
  echo "<option>No postal code available</option>";
}



?>
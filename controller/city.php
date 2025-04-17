<?php 




$state_id = $_POST['state_id'];

$db = new Database();

$cities = $db->query("SELECT * FROM Cities WHERE state_id = :state_id",['state_id'=>$state_id])->fetchAll();

echo '<option>select city</option>';
foreach($cities as $c){
  echo "<option value='" . $c['city_id'] . "'>" . $c['name'] . "</option>";

}


?>
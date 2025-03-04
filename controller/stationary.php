<?php




$db = new Database();

//Fetch only fetch single record
//Fetch all it select whole table
$products = $db ->query("SELECT * FROM products WHERE category_id = '2' ")->fetchAll();



require 'view/stationary.view.php';


?>

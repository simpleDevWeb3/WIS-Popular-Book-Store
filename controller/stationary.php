<?php




$db = new Database();



$products = getAllProductsByCategory($db, 'STAT-MAIN-002');


$all_sub_category = getAllSubCategory($db,'STAT-MAIN-002');


require 'view/stationary.view.php';


?>

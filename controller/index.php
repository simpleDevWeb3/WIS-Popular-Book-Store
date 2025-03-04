<?php 



  $db = new Database();

  //Fetch only fetch single record
  //Fetch all it select whole table
  $products = $db ->query("SELECT * FROM products")->fetchAll();



 require	'view/index.view.php';





?>
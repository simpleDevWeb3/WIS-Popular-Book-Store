<?php 



  $db = new Database();
  $orderBy =  getSortOptions();

  //Fetch only fetch single record
  //Fetch all it select whole table
  $products = $db ->query("SELECT * FROM products ORDER BY $orderBy")->fetchAll();



 require	'view/index.view.php';





?>

<script src="/js/sort.js"></script>
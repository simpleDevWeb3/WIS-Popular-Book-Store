<?php 






$db = new Database();

// Get the search query from URL
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $searchResult = $_GET['keyword'];

 
    $products = $db->query("SELECT * FROM products WHERE name LIKE ?", ["%$searchResult%"])->fetchAll();


} else {
    $products = [];
    abort();
   
} 



 require 'view/search.view.php';

?>
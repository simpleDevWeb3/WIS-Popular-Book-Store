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
 

$max_price = isset($_SESSION['filtered_price']) ? $_SESSION['filtered_price'] : null;

if ($max_price !== null) {
    $products = $db->query("SELECT * FROM products WHERE name LIKE ? AND price <= ?", ["%$searchResult%", $max_price])->fetchAll();
}

 require 'view/search.view.php';

?>


<script src="/js/filter.js" ></script>
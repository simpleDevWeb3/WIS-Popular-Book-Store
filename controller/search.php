<?php


$db = new Database();
$products = [];
$orderBy =  getSortOptions();

$page = isset($_GET['page']) && ctype_digit($_GET['page']) ?(int) $_GET['page'] : 1;




// Search by keyword and category with max_price
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $searchResult = $_GET['keyword'];
    $max_price = isset($_SESSION['filtered_price']) ? $_SESSION['filtered_price'] : 100;
  

 
   $p = searchProducts($db, $searchResult, $max_price,$orderBy,$page);//return $p
   
   $products =  $p->result;
  

  
  
}



// Get subcategories
$Stats_sub_category = getAllSubCategory($db, 'STAT-MAIN-002');

$Book_sub_category = getAllSubCategory($db, 'BOOK-MAIN-001');

// Load the view
require 'view/search.view.php';
?>

<script src="/js/filter.js"></script>
<script src="/js/sort.js"></script>
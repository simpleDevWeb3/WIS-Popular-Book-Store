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

$subcategories = $db->query(
    "SELECT * FROM categories WHERE parent_id IN (:parent1, :parent2)",
    [
        'parent1' => 'STAT-MAIN-002',
        'parent2' => 'BOOK-MAIN-001'
    ]
)->fetchAll();

$parentIds = array_column($subcategories  , 'category_id');

// Create a comma-separated list of placeholders based on the number of IDs
$placeholders = implode(',', array_fill(0, count($subcategories), '?'));

// Prepare the query with the IN clause
$query = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";

$stmt = $db->query($query,$parentIds);

$subSubCategories = $stmt->fetchAll();


// Load the view
require 'view/search.view.php';
?>

<script src="/js/filter.js"></script>
<script src="/js/sort.js"></script>
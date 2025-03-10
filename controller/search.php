<?php


$db = new Database();
$products = [];


// Search by keyword and category with max_price
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $searchResult = $_GET['keyword'];
    $max_price = isset($_SESSION['filtered_price']) ? $_SESSION['filtered_price'] : 100;
    $products = searchProducts($db, $searchResult, $max_price);
}

// Get subcategories
$Stats_sub_category = getAllSubCategory($db, 'STAT-MAIN-002');

$Book_sub_category = getAllSubCategory($db, 'BOOK-MAIN-001');

// Load the view
require 'view/search.view.php';
?>

<script src="/js/filter.js"></script>
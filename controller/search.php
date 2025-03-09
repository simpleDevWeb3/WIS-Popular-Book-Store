<?php 






$db = new Database();
$products = [];
// Get the search query from URL
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $searchResult = $_GET['keyword'];
    $searchTerm = "%$searchResult%";
    $max_price = isset($_SESSION['filtered_price']) ? $_SESSION['filtered_price'] : null;


    $products = $db->query("SELECT p.*
                            FROM products p
                            JOIN categories c ON p.category_id = c.category_id
                            LEFT JOIN categories c_parent ON c.parent_id = c_parent.category_id
                            LEFT JOIN categories c_grandparent ON c_parent.parent_id = c_grandparent.category_id
                            WHERE (p.name LIKE ?
                            OR c.category_name LIKE ?
                            OR c_parent.category_name LIKE ?
                            OR c_grandparent.category_name LIKE ?) AND price < ?", [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $max_price])->fetchAll();

  

   

 


} else {
    $products = [];
    abort();
   
} 






$Stats_sub_category = getAllSubCategory($db,'STAT-MAIN-002');

$Book_sub_category = getAllSubCategory($db,'BOOK-MAIN-001');



 require 'view/search.view.php';

?>


<script src="/js/filter.js" ></script>
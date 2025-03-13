<?php


      
      

$db = new Database();

$page = isset($_GET['page']) && ctype_digit($_GET['page']) ?(int) $_GET['page'] : 1;

// Get sorting option
$orderBy = getSortOptions();


$p =  getAllProductsByCategory($db,'BOOK-MAIN-001',$page,$orderBy);

$products = $p->result;

$all_sub_category = getAllSubCategory($db,'BOOK-MAIN-001');

//TODO 
// add paging 

require 'view/books.view.php'
?>
<script src="/js/sort.js"></script>
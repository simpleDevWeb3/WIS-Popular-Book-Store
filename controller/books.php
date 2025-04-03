<?php


      
      

$db = new Database();

$page = isset($_GET['page']) && ctype_digit($_GET['page']) ?(int) $_GET['page'] : 1;

// Get sorting option
$orderBy = getSortOptions();


$p =  getAllProductsByCategory($db,'BOOK-MAIN-001',$page,$orderBy);

$products = $p->result;


$all_sub_category = getAllSubCategory($db,'BOOK-MAIN-001');

$parentIds = array_column($all_sub_category , 'category_id');

// Create a comma-separated list of placeholders based on the number of IDs
$placeholders = implode(',', array_fill(0, count($parentIds), '?'));

// Prepare the query with the IN clause
$query = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";

$stmt = $db->query($query,$parentIds);

$subSubCategories = $stmt->fetchAll();




//$category_names = array_column($all_sub_category, 'category_name');//extract category name
//$category_id = array_column($all_sub_category, 'category_id'); // extarct category id
//$category_map = array_combine($category_id, $category_names);// creata a map for category_id direct to name

//$sub_SubCategory = $db->query('Select * fro')

//dd($products);
//dd($p_catId);




//dd($category_names);
//dd($category_map);
//dd($category_id);
//dd($all_sub_category);

//TODO 
// add paging 

require 'view/books.view.php'
?>
<script src="/js/sort.js"></script>
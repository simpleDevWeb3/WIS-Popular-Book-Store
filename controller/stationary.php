<?php




$db = new Database();
$orderBy = getSortOptions();
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ?(int) $_GET['page'] : 1;

$p =  getAllProductsByCategory($db, 'STAT-MAIN-002',$page,$orderBy);

$products = $p->result;

$all_sub_category = getAllSubCategory($db,'STAT-MAIN-002');



$parentIds = array_column($all_sub_category , 'category_id');

// Create a comma-separated list of placeholders based on the number of IDs
$placeholders = implode(',', array_fill(0, count($parentIds), '?'));

// Prepare the query with the IN clause
$query = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";

$stmt = $db->query($query,$parentIds);

$subSubCategories = $stmt->fetchAll();


require 'view/stationary.view.php';


?>
<script src="/js/sort.js"></script>
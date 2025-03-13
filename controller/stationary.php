<?php




$db = new Database();
$orderBy = getSortOptions();
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ?(int) $_GET['page'] : 1;

$p =  getAllProductsByCategory($db, 'STAT-MAIN-002',$page,$orderBy);

$products = $p->result;

$all_sub_category = getAllSubCategory($db,'STAT-MAIN-002');

//TODO 
// add paging 


require 'view/stationary.view.php';


?>
<script src="/js/sort.js"></script>
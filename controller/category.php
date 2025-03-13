<?php
$db = new Database();
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;
//Fetch only fetch single record
//Fetch all it select whole table


// Get sorting option
$orderBy = getSortOptions();

$subParent_id =  $_GET['parent_id'];//parent_id=BOOK-MANGA-002


$all_sub_Subcategory = getAllSubCategory($db,$subParent_id);// categroy_id, category_name, parent_key

                            
$subParent_Cat =$db->query("SELECT * FROM categories WHERE category_id = :category_id",[
  'category_id' => $subParent_id
]) -> fetch() ;



//level 3 category
$sub_SubCategory = $db->query("SELECT * FROM categories WHERE parent_id = :parent_id", [
  'parent_id' => $subParent_id
]) -> fetchAll();


$categoryIds = array_column($sub_SubCategory, 'category_id');


                                                           //implode(',', array_fill(0, count($categoryIds) -> shein_1 , shojo_1 , shounen_1 
$query = "SELECT * FROM products WHERE category_id IN (" . implode(',', array_fill(0, count($categoryIds), '?')) . ") ORDER BY " . $orderBy;
$p = new Paging($db, $query, $categoryIds, 10, $page);

$products = $p->result;



//}


require	'view/category.view.php';
?>

<script src="/js/sort.js"></script>
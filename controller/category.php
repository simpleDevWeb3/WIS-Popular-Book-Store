<?php
$db = new Database();

//Fetch only fetch single record
//Fetch all it select whole table


$subParent_id =  $_GET['parent_id'];


$all_sub_Subcategory = getAllSubCategory($db,$subParent_id);

$subParent_Cat =$db->query("SELECT * FROM categories WHERE category_id = :category_id",[
  'category_id' => $subParent_id
]) -> fetch() ;

$sub_SubCategory = $db->query("SELECT * FROM categories WHERE parent_id = :parent_id", [
  'parent_id' => $subParent_id
]) -> fetchAll();

$products = [];

foreach($sub_SubCategory as $categoryIds){
  $product = $db->query("SELECT * FROM products WHERE category_id = :category_id",[
    'category_id' =>$categoryIds['category_id']
  ]) -> fetchAll();


  if (!empty($product)) {
    $products = array_merge($products, $product);
  }
}



require	'view/category.view.php';
?>
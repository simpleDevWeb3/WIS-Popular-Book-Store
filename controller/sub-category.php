<?php 
$db = new Database();

$sub_SubParent_id =  $_GET['parent_id'];



$products = $db->query("SELECT * FROM products WHERE category_id = :category_id",[
  'category_id' => $sub_SubParent_id
])->fetchAll(); 

$sub_SubCat = $db->query("SELECT * FROM categories WHERE category_id = :category_id",[
  'category_id' => $sub_SubParent_id
])->fetch(); 


$sub_SubCat = array_merge($sub_SubCat, $sub_SubCat);

require 'view/sub-category.view.php'

?>
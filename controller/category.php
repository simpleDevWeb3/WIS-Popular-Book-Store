<?php
$db = new Database();

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




$products = [];



foreach($sub_SubCategory as $categoryIds){
  $product = $db->query("SELECT * FROM products WHERE category_id = :category_id ORDER BY " . $orderBy,[
    'category_id' =>$categoryIds['category_id']
  ]) -> fetchAll();

 

  if (!empty($product)) {
    $products = array_merge($products, $product);
  }
// array_merge  cause sorting lose so need to rearange

//take $a <=> $b #comparision   use-> orderBy
  usort($products, function ($a, $b) use ($orderBy) {
    //strpost  check  sorting option  exist price 
    if (strpos($orderBy, 'price') !== false) {

        return (strpos($orderBy, 'ASC') !== false) ? $a['price'] <=> $b['price'] : $b['price'] <=> $a['price'];
    }
        //strpost  check  sorting option  exist -> (A-Z / Z-A)
    return (strpos($orderBy, 'ASC') !== false) ? $a['name'] <=> $b['name'] : $b['name'] <=> $a['name'];//(A → Z) (Z -> A)
});

}



require	'view/category.view.php';
?>

<script src="/js/sort.js"></script>
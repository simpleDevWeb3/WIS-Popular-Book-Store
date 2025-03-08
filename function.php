<?php
   session_start();
   processCartRequest();

   // code to ensure when page refresh cart quantity will not become 0
   function processCartRequest(){

    if(!isset($_SESSION['cart_count'])){
        $_SESSION['cart_count']=0; //
        
     
    }

    if(isset($_POST['add_quantity'])){
      $quantity = intval($_POST['add_quantity']);
      $_SESSION['cart_count']+= $quantity;

      return $_SESSION['cart_count'];
    

    
    
    }



 

   }
    //code for debugging eg.checking uri
    function dd($value){

      echo "<pre>";  
        var_dump($value) ;
      echo "</pre>";
    
      die();
    }

    //$value =REQUESTED_URI
    //return boolean after compaer $value with request_uri

    //used in navbar.php
    function urlIs($value){
      return $_SERVER['REQUEST_URI'] === $value;
    }


 
function getParentCategory($db, $category_id) {
  // Get parent_id of the given category_id
  $category = $db->query("SELECT parent_id FROM categories WHERE category_id = :category_id", [
      'category_id' => $category_id
  ])->fetch();

  // If no parent_id (NULL), this is the top category, return it
  if (!$category || !$category['parent_id']) {
      return $category_id; // This is the main category
  }

  // Recursively find the top-level parent category
  return getParentCategory($db, $category['parent_id']);
}

function getSubCategory($db, $category_id){
   $category = $db->query("SELECT parent_id FROM categories WHERE category_id = :category_id", [
      'category_id' => $category_id
  ])->fetch();

  // If no parent_id (Main-category)return it
  if ($category['parent_id'] === 'STAT-MAIN-002'||$category['parent_id'] === 'BOOK-MAIN-001') {
      return $category_id; // This is the main category
  }

  // Recursively find the top-level parent category
  return getSubCategory($db, $category['parent_id']);
}

function getAllSubCategory($db,$parent_id){
      $categories = $db->query("SELECT * FROM categories WHERE parent_id = :parent_id",[
        'parent_id'=>$parent_id
      ])->fetchAll();

       forEach($categories as $category_id){
        $allCategories[] = $category_id;
      }    
      
      return $allCategories;


}










 ?>
<?php 





$db = new Database();



// Check if 'id' is set in the URL eg./product?id=null or /product?id=1
if (!isset($_GET['product_id']) || !is_string($_GET['product_id'])) {
  die("
    <main>
       <br>
       <h1>Invalid product ID. </h1>
    </main>
    ");
}

// fetch product data
$product_id =  $_GET['product_id']; // Convert to integer
$product = $db->query("SELECT * FROM products WHERE product_id = :product_id", ['product_id' => $product_id])->fetch();//GET THE PRODUCT DATA
$product_details = $db->query("SELECT * FROM product_details WHERE product_id = :product_id", ['product_id' => $product_id])->fetch(); //GET THE PRODUCT DETAILS

$currentStock = $product_details['stock'];



if (!$product) {
  die("
    <main>
    <br>
      <h1>Product not found.</h1>
    </main>
  ");
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

$sub_SubCategory =  $product_details['category_id'];
$sub_category = getSubCategory($db, $product_details['category_id']);
$parent_category = getParentCategory($db, $product_details['category_id']);



require 'view/product.view.php';




?>


<script>
//get the data from php da

// const product_details = {"stock":10,"product_id":5};

const product_details = <?php echo json_encode($product_details ); ?>;

 let stock = product_details.stock; 
 let product_id = product_details.product_id;
 console.log(stock);


</script>

<script src="/js/cart.js" ></script>
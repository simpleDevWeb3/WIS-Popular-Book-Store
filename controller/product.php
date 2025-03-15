<?php 





$db = new Database();



// Check if 'id' is set in the URL eg./product?id=null or /product?id=1
if (!isset($_GET['product_id']) || !is_string($_GET['product_id']) || !isset($_GET['category_id']) || !is_string($_GET['category_id'])) {
  die("
    <main>
       <br>
       <h1>Invalid product ID. </h1>
    </main>
    ");
}




// fetch product data
$category_id = $_GET['category_id'];
$product_id =  $_GET['product_id']; 
$product = $db->query("SELECT * FROM products WHERE product_id = :product_id", ['product_id' => $product_id])->fetch();//GET THE PRODUCT DATA
$product_details = $db->query("SELECT * FROM product_details WHERE product_id = :product_id", ['product_id' => $product_id])->fetch(); //GET THE PRODUCT DETAILS

$currentStock = $product_details['stock'];

$related_product = $db->query("SELECT * FROM products WHERE category_id = :category_id AND product_id != :product_id",
['category_id' => $category_id, 'product_id' => $product_id])->fetchAll() ;// fetch product that in same sub_Subcategory 


if (!$product) {
  die("
    <main>
    <br>
      <h1>Product not found.</h1>
    </main>
  ");
}





$sub_SubCategory =  $product_details['category_id'];
$sub_category = getSubCategory($db, $product_details['category_id']);
$parent_category = getParentCategory($db, $product_details['category_id']);

//Join user table with comment
$comment_query = "SELECT c.*, u.username, u.profile_image
                  FROM comments c 
                  JOIN users u ON c.user_id = u.user_id 
                  WHERE c.product_id = :product_id";
$comments = $db->query($comment_query, ['product_id' => $product_id])->fetchAll();



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
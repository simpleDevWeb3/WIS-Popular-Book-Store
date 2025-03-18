<?php 





$db = new Database();







// fetch product data
$category_id = $_GET['category_id'];
$product_id =  $_GET['product_id']; 
$query_product = "SELECT p.*, pd.stock 
                 FROM products p
                 LEFT JOIN product_details pd ON p.product_id = pd.product_id
                 WHERE p.product_id = :product_id";

$product = $db->query($query_product, ['product_id' => $product_id])->fetch();//GET THE PRODUCT DATA
$product_details = $db->query("SELECT * FROM product_details WHERE product_id = :product_id", ['product_id' => $product_id])->fetch(); //GET THE PRODUCT DETAILS

$currentStock = $product_details['stock'];
$query = "SELECT p.*, pd.stock 
          FROM products p
          LEFT JOIN product_details pd ON p.product_id = pd.product_id
          WHERE p.category_id = :category_id 
          AND p.product_id != :product_id";

$related_product = $db->query($query,
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





require 'view/product.view.php';




?>


<script>
//get the data from php da

// const product_details = {"stock":10,"product_id":5};

const product_details = <?php echo json_encode($product_details ); ?>;

 let stock = product_details.stock; //product_details['stock'] but in js
 let product_id = product_details.product_id;
 console.log(stock);


</script>
<script src="/js/comment.js" ></script>
<script src="/js/cart.js" ></script>
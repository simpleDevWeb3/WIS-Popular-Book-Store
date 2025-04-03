<?php 





$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  addToCart($db); // Run only when an AJAX request is made
}





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





$sub_SubCategoryId =  $product_details['category_id'];

$sub_categoryId = getSubCategory($db, $product_details['category_id']);

$subCategory = $db->query("SELECT category_name FROM categories WHERE category_id = :category_id",['category_id' => $sub_categoryId])->fetch(); 

$subSubCategory = $db->query("SELECT category_name FROM categories WHERE category_id = :category_id",['category_id' => $sub_SubCategoryId])->fetch(); 

$parent_category = getParentCategory($db, $product_details['category_id']);



$user_id = $_SESSION['user_id'];

$cart_product = $db->query("SELECT c.user_id, cd.price, cd.quantity, p.stock 
FROM `cart` c
JOIN `cartDetails` cd ON c.cart_id = cd.cart_id
JOIN `product_details` p ON cd.product_id = p.product_id
WHERE c.user_id = :user_id AND cd.product_id = :product_id",[  'user_id' => $user_id, 'product_id' => $product_id])->fetch();


require 'view/product.view.php';




?>


<script>
//get the data from php da

// const product_details = {"stock":10,"product_id":5};

const product_details = <?php echo json_encode($product_details ); ?>;
const product_cart = <?php echo json_encode($cart_product);?>

 let stock = product_details.stock; //product_details['stock'] but in js
 let cart_product = product_cart.quantity;
 let product_id = product_details.product_id;
 console.log(stock);
console.log(cart_product);

</script>
<script src="/js/comment.js" ></script>
<script src="/js/cart.js" ></script>
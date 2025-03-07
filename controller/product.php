<?php 





$db = new Database();


// Check if 'id' is set in the URL eg./product?id=null or /product?id=1
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die("
    <main>
       <br>
       <h1>Invalid product ID. </h1>
    </main>
    ");
}

// fetch product data
$id = (int) $_GET['id']; // Convert to integer
$product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->fetch();//GET THE PRODUCT DATA
$product_details = $db->query("SELECT * FROM product_details WHERE product_id = :id", ['id' => $id])->fetch(); //GET THE PRODUCT DETAILS

$currentStock = $product_details['stock'];




if (!$product) {
  die("
    <main>
    <br>
      <h1>Product not found.</h1>
    </main>
  ");
}



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
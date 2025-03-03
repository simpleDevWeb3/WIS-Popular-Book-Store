
<?=require 'partials/head.php' ?>
<?=require 'partials/header.php' ?>



<?php 

$config = require('config.php');

$db = new Database($config['database']);


// Check if 'id' is set in the URL
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
$product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->fetch();
$product_details = $db->query("SELECT * FROM product_details WHERE product_id = :id", ['id' => $id])->fetch();

if (!$product) {
  die("
    <main>
    <br>
      <h1>Product not found.</h1>
    </main>
  ");
}



?>
  <main>
    <div class="view-product">
      <div class="product-detail-view">
        <section class="product-thumbnail">
            <div class="product-thumbnail-container">
              <img src="<?=$product['image']?>" >
      
              <section class="view-item">
               
              </section>
            </div>
        
        </section>
        
        <section class="product-detail">
          <!--header-->
          <div>
            <h1 class="product-name"><?=$product['name']?></h1>
            <div class="status">
              <span class="rate"><?= number_format($product['rating'], 1)?></span>

              <?php
                    // Convert rating (e.g., 4.5) to rating image (e.g., rating-45.png)
                  $ratingImg = $product['rating'] * 10;  
              ?>
              <img src="/Img/Ratings/rating-<?=$ratingImg?>.png">
              <span class="total-solded">100 Solded </span>
              <span class="item-stats">Available</span>
            </div>
      
            <hr>
            
         
          </div>
      
      
         
          <!--Bottom-->
          <div>
            <h2 class="item-price">RM<?=$product['price']?></h2>
            <p style=
            "color:gray; font-weight: 600;">Quantity</p><br>
      
            <div class="quantity-control">
              <button class="decrease">-</button>
              <input class="quantity-input" type="number" value="1" >
              <button class="increase">+</button>
            </div>
           
            <br>
            <button class="add-to-cart-button">
              Add To Cart
            </button>
      
            <button class="order-now-button">
             Order Now
            </button>
          </div>
      
        </section>
      
       
      </div>
    
      <br>
      <section class="product-desc">
       
        <h1>Product Detail</h1>
        <hr style="border-style: dotted;  border-color: rgb(242, 8, 8);">
        <table>
          <tr>
            <td><strong>Name</strong></td>
            <td><?=$product['name']?></td>
          </tr>
        
          <tr>
            <td><strong>Author</strong></td>
            <td><?=$product_details['author']?>n</td>
          </tr>
        
          <tr>
            <td><strong>Publisher</strong></td>
            <td><?=$product_details['publisher']?></td>
          </tr>
    
          <tr>
            <td><strong>Publish Date</strong></td>
            <td><?=$product_details['publish_date']?></td>
          </tr>
    
          <tr>
            <td><strong>Stock</strong></td>
            <td><?=$product_details['stock']?></td>
          </tr>
        
          <tr>
            <td><strong>Category</strong></td>
            <td><?=implode(", ", json_decode($product_details['genre'], true)) ?></td>
          </tr>
        
          <tr>
            <td><strong>Genre</strong></td>
            <td><?=implode(", ", json_decode($product_details['keywords'], true)) ?></td>
          </tr>
        </table>
        
        
      </section>
    
      <br>
    
       <h1> For You</h1>
       <section class="product-grid">
      
        <div class="product-details">
          <a href="Product_Detail.html">
            <img  src="Img/Product/Example1.jpg">
      
            <a class="title">OSHI NO KO 我推的孩子S2 V1-13 E(DVD9)</a>
      
            <div class="rating">
              <span>5.0</span>
              <img src="Img/Ratings/rating-45.png">
            </div>
            <div class="price">RM40.00</div> 
          </a>
         
        </div>

        
      
        

      
      </section> 
    
    
      
    
    
      
     
    </div>
  </main>
<?=require 'partials/footer.php' ?>
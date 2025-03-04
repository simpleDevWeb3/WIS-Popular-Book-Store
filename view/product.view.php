
<?=require 'partials/head.php' ?>
<?=require 'partials/header.php' ?>



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
              <button id="decrease" class="decrease"">-</button>
              <input id="quantity" class="quantity-input" type="number" value="1" >
              <button id="increase" class="increase">+</button>
              <span style="color:gray; font-size:15px;">&nbsp;&nbsp;<?=$product_details['stock']?> Available</span>
            </div>
          
           
            <br>
           
            <button id="add-to-cart-btn" class="add-to-cart-button ">
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
        <?php if($product_details['category_id'] == 1): ?>
          
            <hr style="border-style: dotted;  border-color: rgb(242, 8, 8);">
            <table>
              <tr>
                <td><strong>Name</strong></td>
                <td><?=$product['name']?></td>
              </tr>
            
              <tr>
                <td><strong>Author</strong></td>
                <td><?=$product_details['author']?></td>
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
        <?php endif ?>

        <?php if($product_details['category_id'] == 2): ?>
          
          <hr style="border-style: dotted;  border-color: rgb(242, 8, 8);">
          <table>
            <tr>
              <td><strong>Name</strong></td>
              <td><?=$product['name']?></td>
            </tr>
          
            <tr>
              <td><strong>Brand</strong></td>
              <td><?=$product_details['brand']?></td>
            </tr>
          
            <tr>
              <td><strong>Material</strong></td>
              <td><?=$product_details['material']?></td>
            </tr>
      
         
      
            <tr>
              <td><strong>Stock</strong></td>
              <td><?=$product_details['stock']?></td>
            </tr>
          
           
            <tr>
              <td><strong>Category</strong></td>
              <td><?=implode(", ", json_decode($product_details['keywords'], true)) ?></td>
            </tr>
          </table>
          
          
        </section>
      <?php endif ?>
       
      <br>
    
    </div>


  </main>
<?=require 'partials/footer.php' ?>
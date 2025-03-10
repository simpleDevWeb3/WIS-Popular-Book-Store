
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'partials/navbar.php';?>

 
  <main>

  <div style="
  text-align: center;
   padding:50px 50px 50px 50px;
   background-color:lightcoral;
   ">
     
       <h1>Welcome To the Popular Book Store</h1>
       <br>
       <h3>Malaysian's Favourite Book and Stationary Store!</h3>
    </div>  
      
        <br>
   <section class="product-grid">
          <?php foreach($products as $product ):?>            
            <div class="product-details">
              <a href="/product?product_id=<?=$product['product_id']?>">
                <img src="<?=$product['image']?>">
                <a class="title"><?=$product['name']?></a>
                <div class="rating">
                  <span><?= number_format($product['rating'], 1) ?></span>

                  <?php
                       // Convert rating (e.g., 4.5) to rating image (e.g., rating-45.png)
                      $ratingImg = $product['rating'] * 10;  
                   ?>
                  <img src="/Img/Ratings/rating-<?=$ratingImg?>.png">
                </div>
                <div class="price">RM<?=$product['price']?></div> 
              </a>
            </div>
          <?php endforeach;?>
    </section> 
  </main>

  

 <?php require 'partials/footer.php';?>
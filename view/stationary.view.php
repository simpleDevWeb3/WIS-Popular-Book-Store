
<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>


<main>
  <h2 style=
  "text-align: center;
 ">
   Stationary
  </h2>  
  <hr>
  <section class="category">

  <?php foreach($all_sub_category as $category): ?>
        
        <a href="/category?parent_id=<?=$category['category_id']?>">
            <div> 
                <div class="circle">
                <img src="<?=$category['category_picture']?>">
                </div>
                <h3><?=$category['category_name']?></h3>
            </div>
        </a>
    <?php endforeach ?>
  </section>
 
  <hr>

  
  <section class="product-grid">
      <?php foreach($products as $product): ?>            
          <div class="product-details">
              <a href="/product?product_id=<?=$product['product_id']?>">
                  <!-- Ensure correct image path -->
                  <img src="<?=$product['image']?>">

                  <a class="title"><?=$product['name']?></a>

                  <div class="rating">
                      <span><?= number_format($product['rating'], 1) ?></span>
                      
                      <?php
                          // Convert rating (e.g., 4.5) to rating image (e.g., rating-45.png)
                          $ratingImg = $product['rating'] * 10;  
                      ?>
                      
                      <img src="Img/Ratings/rating-<?=$ratingImg?>.png">
                  </div>
                  
                  <div class="price">RM<?=$product['price']?></div> 
              </a>
          </div>
      <?php endforeach; ?>
</section>        
</main>
<?php require 'partials/footer.php' ?>
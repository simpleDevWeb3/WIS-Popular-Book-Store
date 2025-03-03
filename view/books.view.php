
<?=require 'partials/head.php';?>
<?=require 'partials/header.php';?>
<?=require 'partials/navbar.php';?>


 <?php
      
      $config = require('config.php');

      $db = new Database($config['database']);

      //Fetch only fetch single record
      //Fetch all it select whole table
      $products = $db ->query("SELECT * FROM products WHERE category_id = '1'")->fetchAll();
      
  ?>

  <main>
        <h2 style=
        "text-align: center;">
        Books
        </h2>  
      
        <hr>
  
      
        <section class="product-grid">
          <?php foreach($products as $product): ?>            
              <div class="product-details">
                  <a href="/product?id=<?=$product['id']?>">
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

 <?= require 'partials/footer.php';?>
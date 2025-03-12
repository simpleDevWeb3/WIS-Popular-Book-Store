
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
   <span>
    <?= $p->count ?> of <?= $p->item_count ?> product(s) |
   Page <?= $p->page ?> of <?= $p->page_count ?></span>
 
    <select id="sortOptions">
        <option value="name_asc">Sort A-Z</option>
        <option value="name_desc">Sort Z-A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
   </select>
      
        <br>
   <section class="product-grid">
          <?php foreach($products as $product ):?>            
            <div class="product-details">
             <a href="/product?product_id=<?=$product['product_id']?>&category_id=<?=$product['category_id']?>">
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
    <?php $p-> html($orderBy, $attr = '')?> 

  </main>

  

 <?php require 'partials/footer.php';?>
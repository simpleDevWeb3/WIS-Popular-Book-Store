<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>





  <main style="max-width: 1300px;"> 
        <section class="search-page">
            <aside>
                <div class=search-filter>
                 
                  <h1>Search Filter</h1>
                  <hr>
                
                  <div class="price-filter">
                    <label>Price</label>   
                    <span>RM1 - RM<span id="price"><?=$max_price??100?></span></span>
                    <br>
                    <input type="range" id="price-range" style="scroll-behavior:smooth; " min="1" max="100" step="1" value="<?=$max_price ?? 50?>">
                    <br>
                    <button class="apply-button" id="apply">
                      Apply
                      </button>
                  </div>                  
              
                </div>
              
                <br>
        
                <div class="rating-filter">
                  <h4>Ratings</h4>
                  <?php for ( $i =5 ; $i>0 ; $i--){ ?>
                      <div class="filter-rating-grid">
                        <div> 
                          <img src="Img/Ratings/rating-<?=$i?>0.png">
                        </div>           
                      </div>
                    </div>
                <?php } ?>
            </aside>

            <div class="search-page-grid">
                <h1 style="margin-left: 30px; margin-top: 20px;">Search Result(<?=count($products)?>) "<?=$searchResult?>"</h1>
                      
                    <section class="product-grid" style="grid-template-columns: 1fr 1fr 1fr; ">
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
            </div>

      </section>
  </main>

  <br><br>


  <?php require 'partials/footer.php' ?>

  
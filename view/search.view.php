<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>





  <main style="max-width: 1800px; min-height:1000px"> 
    <section class="search-page">

        <aside>
          <div class=search-filter>
            <h1>Search Filter</h1>
            <br>
          
            <div class="price-filter">
              <label>Price</label> 
              <span>RM1 - RM<span id="price"><?=$max_price??50?></span></span>
              <br>
              <input type="range" id="price-range" min="0" max="100" step="5" value="<?=$max_price??50?>">
              <br>
              <button class="apply-button" id="apply">
                Apply
                </button>
            </div>
            
        
          
        
          </div>

            <br>
          <div class="book-filter">
              <h4>Books</h4>
          
              <input type="checkbox" id="filter-Novel">
              <label for="filter-Novel">Novel</label>
                <br>
              <input type="checkbox" id="filter-Revision">
              <label for="filter-Revision">Revison</label>
                <br>
              <input type="checkbox" id="filter-Self-Help">
              <label for="filter-Self-Help">Self Help</label>
          </div>
            <br>
          <div class="stationary-filter">
            <h4 >Stationary</h4>
        
            <input type="checkbox" id="filter-paper-product">
            <label for="filter-paper-product">Paper Product</label>
            <br>
            <input type="checkbox" id="filter-office-suplies">
            <label for="filter-office-suplies">Office Suplies</label>
            <br>
            <input type="checkbox" id="filter-writting-instrument">
            <label for="filter-writting-instrument">Writting Instrument</label>
          </div>
            <br>
          <div class="rating-filter">
            <h4>Ratings</h4>
            
            <div class="filter-rating-grid">
              <div> 
                <img src="Img/Ratings/rating-50.png">
              </div>
              <div>
                <img src="Img/Ratings/rating-40.png">
              
              </div>
              <div>
                <img src="Img/Ratings/rating-30.png">
                
              </div>
              <div>
                <img src="Img/Ratings/rating-20.png">
              
              </div>
              <div>
                <img src="Img/Ratings/rating-10.png">
              
              </div>
            
              

            </div>
          </div>
       
      </aside>

      <div class="search-page-grid">
            <h1 style="margin-left: 30px; margin-top: 20px;">Search Result(<?=count($products)?>) "<?=$searchResult?>"</h1>
            <br><br>
           
        <section class="product-grid" style="grid-template-columns: 1fr 1fr 1fr 1fr;">
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

  
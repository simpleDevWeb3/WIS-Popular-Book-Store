<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>





  <main style="max-width: 1300px; min-height:1500px;"> 
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

                                                                    <h3>Sort By</h3>
                                                                     <br>
                <select id="sortOptions" style="float: left;">
                            <option value="name_asc"> A-Z</option>
                            <option value="name_desc"> Z-A</option>
                            <option value="price_asc">Price Low to High</option>
                            <option value="price_desc">Price High to Low</option>
                  </select>
        <!---
                <div class="rating-filter">
                  <h4>Ratings</h4>
                  <//?php for ( $i =5 ; $i>0 ; $i--){ ?>
                      <div class="filter-rating-grid">
                        <div> 
                          <img src="Img/Ratings/rating-<//?=$i?>0.png">
                        </div>           
                      </div>
                    </div>
                <//?php } ?>
             !--->
                
            </aside>

            <div class="search-page-grid">
                <h1 style="margin-left: 30px; margin-top: 20px;">Search Result(<?=$p->item_count?>) "<?=$searchResult?>"</h1>
                <span style="margin-left: 30px;"><?= $p->count ?> of <?= $p->item_count ?> products <span style="margin-left:650px">Page <?= $p->page ?> of <?= $p->page_count ?></span></span>
                

                    <section class="product-grid" style="grid-template-columns: 1fr 1fr 1fr; ">
                      <?php foreach($products as $product): ?>            
                        <div class="product-details">
                          <a href="/product?product_id=<?=$product['product_id']?>&category_id=<?=$product['category_id']?>">
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

      <?php 
       $keyword = $_GET['keyword']?? '';
      $sortKey = $_GET['sort'] ?? 'name_asc'; // Get sorting option from URL
     
      // Remove any existing "page" parameter to avoid duplication
      $queryParams = $_GET;
      unset($queryParams['page']); 


      // Rebuild the query string with correct "sort" and current "page"
      $queryString = http_build_query(array_merge($queryParams, ['sort' => $sortKey, 'keyword'=>$keyword]));

      // Generate pagination with cleaned query string
      $p->html($queryString, '');
    ?>
  </main>

  <br><br>


  <?php require 'partials/footer.php' ?>

  
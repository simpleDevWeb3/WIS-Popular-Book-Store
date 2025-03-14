
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'partials/navbar.php';?>

 
  <main>

 

      <div class="banner">
            <img src="/Img/Category/Popular.jpg"" style="width: 100%; height: 100%; object-fit: cover;">
            <h1 class="banner-title">
              Popular Book Store
            </h1>  
      </div>
      
    
 
   <br>

 <div style="display: flex; justify-content:space-between ; align-items:center;">
 <label style="margin-left:80px ;"><?=$p->item_count?> products</label>
    
    <select id="sortOptions">
        <option value="name_asc">Sort A-Z</option>
        <option value="name_desc">Sort Z-A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
   </select>
 </div>
 
      
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
    <?php 
    $sortKey = $_GET['sort'] ?? 'name_asc'; // Get sorting option from URL

    // Remove any existing "page" parameter to avoid duplication
    $queryParams = $_GET;
    unset($queryParams['page']); 

    // Rebuild the query string with correct "sort" and current "page"
    $queryString = http_build_query(array_merge($queryParams, ['sort' => $sortKey]));

    // Generate pagination with cleaned query string
    $p->html($queryString, '');
    ?>


 

  </main>

  

 <?php require 'partials/footer.php';?>
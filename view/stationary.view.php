
<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>


<main>
<div class="banner">
         <img src="/Img/Category/Stationary_banner.jpg" style="width: 100%; height: 100%; object-fit: cover;">
            <h1 class="banner-title">
           Stationary
            </h1>  
    </div>
       <section class="category">
        <?php foreach($all_sub_category as $category): ?> 
            <a href="/category?parent_id=<?=$category['category_id']?>">
                <div> 
                    <div class="circle">
                    <img src="<?=$category['category_picture']?>">
                    </div>
                    
                    <span class="cat-name"><?=$category['category_name']?></span>
                </div>
            </a>
        <?php endforeach ?>
        </section>
  

   
 
  
 <div style="display: flex; justify-content:space-between ; align-items:center;">
 <label style="margin-left:80px ;"><?=$p->item_count?> products</label>
    
    <select id="sortOptions">
        <option value="name_asc">Sort A-Z</option>
        <option value="name_desc">Sort Z-A</option>
        <option value="price_asc">Price: Low to High</option>
        <option value="price_desc">Price: High to Low</option>
   </select>
 </div>

  <section class="product-grid">
      <?php foreach($products as $product): ?>            
          <div class="product-details">
            <a href="/product?product_id=<?=$product['product_id']?>&category_id=<?=$product['category_id']?>">
                  <!-- Ensure correct image path -->
                  <img src="<?=$product['image']?>">

                  <a class="title"><?=$product['name']?></a>

                  <div class="rating">
                  <div>
                        
                        <?php foreach($subSubCategories  as $subSubcategory): ?>    
                                <?php if($product['category_id'] ==  $subSubcategory['category_id']): ?>
                                    <?php foreach($all_sub_category as $subCategory): ?>
                                        <?php if($subSubcategory['parent_id'] == $subCategory['category_id']): ?>
                                            <label style="color:gray;" ><?=$subCategory['category_name']?> </label>
                                             <?php break;?>
                                        <?php endif?>
                                    <?php endforeach?>   
                                    <?php break;?>
                              <?php endif ?>
                        <?php endforeach ?>
                     
                   
                     
                
              
                         
                        <?php foreach($subSubCategories  as $category): ?>    
                                <?php if($product['category_id'] == $category['category_id']): ?>
                                    <label style="color:gray;" ><?=$category['category_name']?>  </label>
                                    <?php break;?>
                              <?php endif ?>
                        <?php endforeach ?>
                     
                    </div>
                        <?php  
                            if ($product["stock"] > 0) {
                                echo '<span class="sale-tags">For Sale</span>';
                            } else {
                            echo '<span class="out-of-tags">Out of Stock</span>';
                            }
                        ?>
                     
                  </div>
                  
                  <div class="price">RM<?=$product['price']?></div> 
              </a>
          </div>
      <?php endforeach; ?>
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
<?php require 'partials/footer.php' ?>
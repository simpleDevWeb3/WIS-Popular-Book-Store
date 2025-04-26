
<?php $_title = $product['name'] ?>
<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>

<?php  require 'partials/navbar.php'; ?>




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
            <label style="color: red; "><?=$subSubCategory['category_name'];?></label>
            <label style="color: red;"><?=$subCategory['category_name'];?></label>
            <br>
            <h1 class="product-name"><?=$product['name']?></h1>
            <div class="status">
 
            
      
             <!-- <span class="total-solded">100 Solded </span>
              <span class="item-stats">Available</span>!-->
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
              <input id="quantity" class="quantity-input" type="number" value="1" min="1" max ="<?=$product_details['stock']?> " require >
              <button id="increase" class="increase">+</button>
              <span style="color:gray; font-size:15px;">&nbsp;&nbsp;<?=$product_details['stock']?> Available</span>
            </div>
          
           
            <br>
            <div style="display: flex; flex-direction:column">
           
                    
             <?php  
              
                if ($product["stock"] > 0) {
                    echo '<button id="add-to-cart-btn" class="add-to-cart-button" data-product-id="'.$product['product_id'].'">Add To Cart</button>';
                } 
                else {
                    echo '<span class="add-to-cart-button-no-stock" >Out of Stock</span>';
                }
              ?>
        
            </div>
           
          </div>
      
        </section>
      
       
      </div>
    
      <section class="product-desc">
      <h1>Product Detail</h1>
        <?php if($parent_category === 'BOOK-MAIN-001'): ?>
            
            <hr style="border: solid 1px;  border-color: rgb(172, 172, 172);">
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
                <td><?=$product_details['genre'] ?></td>
              </tr>
            
              <tr>
                <td><strong>Genre</strong></td>
                <td><?=$product_details['keywords']?></td>
              </tr>
            </table>
            
            
          </section>
        <?php endif ?>

        <?php if($parent_category === 'STAT-MAIN-002'): ?>
          
          <hr style="border: solid 1px;  border-color: rgb(172, 172, 172);">
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
              <td><?=$product_details['keywords']?></td>
            </tr>
          </table>
          
          
        </section>
      <?php endif ?>
       
      <br>
    
    </div>


    <br>
    <?php if($related_product):?>
      <h1 style="margin-left: 40px;"> You might also love</h1>
      <section class="product-grid">
            <?php foreach($related_product as $product ):?>            
              <div class="product-details">
              <a href="/product?product_id=<?=$product['product_id']?>&category_id=<?=$product['category_id']?>">
                  <img src="<?=$product['image']?>">
                  <a class="title"><?=$product['name']?></a>
                  <div class="rating">
                    <label style="color:gray; margin-right:5px; "><?=$subSubCategory['category_name'];?></label>
                    <label style="color:gray;"><?=$subCategory['category_name'];?></label>
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
            <?php endforeach;?>
      </section> 
    <?php endif; ?>


      <?php require 'controller/comment.php' ?>
    
  <?php 
    $product_id = $_GET['product_id'] ?? '';
    $category_id = $_GET['category_id'] ?? ''; 

    // Initialize $queryParams with existing GET parameters
    $queryParams = $_GET;  

    // Remove any existing "page" parameter to avoid duplication
    unset($queryParams['page']);  

    // ensure product_id and category_id stay in the URL
    $queryParams['product_id'] = $product_id;
    $queryParams['category_id'] = $category_id;

    // Build query string
    $queryString = http_build_query($queryParams);

    // Generate pagination with query string
    $p->html($queryString, '');
?>

    
  </main>
<?php require 'partials/footer.php' ?>
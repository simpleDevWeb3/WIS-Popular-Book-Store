<?php
auth('Admin');
require 'controller/_updateValidation.php';




$_title = "Product - Update";
include 'view/partials/head.php';
include 'view/partials/header.php';
?>

<!-- HTML START -->
<main style="padding-top: 120px;">
    <a href="/product_list">
        <button class="back"><img src="/Img/Icon/arrow.png" class="back-img"></button>
    </a>

    <div class="admin_crud_page_container">
        <div class="admin_crud_form_container">
              
       <form class="update-form" method="POST" enctype="multipart/form-data" >
            <p class="input-row">
                <label class="admin_crud_label" for="product_id">Product ID</label>
                <?php html_input('text',$product_detail['product_id'],'product_id')?>
               
           </p>


           <p class="input-row">

            <label class="admin_crud_label" for="product_name">Product Name</label>
            <?php html_input('text', $product_detail['name'],'product_name')?>   
            <span style="color:red"><?=$_err["product_name"] ??""?></span>
      
          

            </p>



            <p class="input-row">

            <label class="admin_crud_label" for="product_price">Price</label>
            <?php 
                html_input('number', $product_detail['price'],'product_price' ,'min="0.5" max="9999.99", step="0.01"');   
            ?>
              <span style="color:red"><?=$_err["product_price"] ??""?></span>
            </p>


            <p class="input-row">
                <label class="admin_crud_label" for="category_id">Category</label>
                <?php html_select(
                $catValue, $catName,$product_detail['category_id'])?>
                 <span style="color:red"><?=$_err["product_category"] ??""?></span>
            </p>

      <?php if($category_id === 'BOOK-MAIN-001'):?>
        <p class="input-row"">
                <label class="admin_crud_label" for="genre">Genre</label>
                <?php html_input(
                'text', $product_detail['genre'],'genre')?>

                
                <span style="color:red"><?=$_err["product_genre"] ??""?></span>
                
            </p>


            <p class="input-row">
                <label class="admin_crud_label" for="publisher">Publisher</label>
                <?php html_input(
                'text', $product_detail['publisher'],'publisher')?>
                 <span style="color:red"><?=$_err["product_publisher"] ??""?></span>
            </p>


            <p class="input-row">
                <label class="admin_crud_label" for="publish_date">Publish Date</label>
                <?php html_input(
                'date', $product_detail['publish_date'],'publish_date')?>

                <span style="color:red"><?=$_err["publish_date"] ??""?></span>

            </p>

            <p class="input-row">
                <label class="admin_crud_label" for="author">Author</label>
                <?php html_input(
                'text', $product_detail['author'],'author')?>

                <span style="color:red"><?=$_err["product_author"] ??""?></span>
            </p>


      

            <?php elseif($category_id === 'STAT-MAIN-002'): ?>

                <p class="input-row">          
                    <label class="admin_crud_label" for="brand">Brand</label>
                    <?php html_input('text', $product_detail['brand'] ?? '','brand') ?>   
                    
                    <span style="color:red"><?=$_err["brand"] ??""?></span>
                </p>


                <p class="input-row">

                  <label class="admin_crud_label" for="material">Material</label>

                  <?php html_input('text', $product_detail['material'] ?? '','material')?>


                  
                  <span style="color:red"><?=$_err["material"] ??""?></span>
                
                </p>




        <?php endif?>


        <p class="input-row">
                <label class="admin_crud_label" for="keyword">Keyword</label>
                <?php html_input(
                'text', $product_detail['keywords'] ,'keywords')?>

                <span style="color:red"><?=$_err["product_keywords"] ??""?></span>
         </p>

           <p class="input-row">
                <label class="admin_crud_label" for="stock">Stock</label>
                <?php html_input(
                'number', $product_detail['stock'],'stock','min=1','max=9999','step=1')?>
                  <span style="color:red"><?=$_err["stock"] ??""?></span>
            </p>

            <p class="input-row">
                <label class="admin_crud_label" for="image">Product Picture</label>

               <?php html_file('image', 'image/*', 'data-target="preview_img"')?>
               <span style="color:red"><?=$_err["image"] ??""?></span>
            </p>

       

           
            <section style="margin-top:20px;" class="admin_crud_form_section">
                <button data-get="/product_detail?id=<?= $product_detail['product_id']?>" class="admin_crud_close_btn">Cancel</button>
                <button type="submit" class="admin_crud_submit_btn">Submit</button>
            </section>

       
         </form>

              <div class="admin_crud_product_img_container">
                        <img src="<?= $image ?>" data-id="preview_img">
                </div>
        </div>
   
    </div>

</main>

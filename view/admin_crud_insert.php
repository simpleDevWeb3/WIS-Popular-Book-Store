<?php
auth('Admin');
$_db = new Database();

require 'controller/_insertValidation.php';
require '_form.php';





$_title = "Product - Insert";
include 'view/partials/head.php';
include 'view/partials/header.php';
?>


<!----------------------------------------------------------HTML------------------------------------------------------------------------------>

    <!-------------------------------------------------------------------------------------------------------------------form insert product-->
  <main style="padding-top: 120px;">



        <a href="/product_list">
            <button class="back">
                <img src="/Img/Icon/arrow.png" class="back-img">
            </button>
        </a>


          
        
            <div class="admin_crud_page_container">


                <div class="book-stat">
                       <a href="?BS=Book" class="book-stat-stat" style="<?= urlIs('/insert?BS=Book')|| urlIs('/insert')? '':'background-color:rgb(237, 232, 233); color:black; box-shadow: 0px  5px  10px rgba(0,0,0,0.1);'?>">
                            <div>Book</div>
                        </a>
                        <a href="?BS=STAT" class="book-stat-stat" style="<?= urlIs('/insert?BS=STAT') ? '':'background-color:rgb(237, 232, 233); color:black; box-shadow: 0px  5px  10px rgba(0,0,0,0.1);'?>">
                            <div>Stationary</div>
                        </a>
                </div>
                <div class="admin_crud_form_container"  
                style="box-shadow: 0px 1px 10px rgba(0,0,0,0.1);
                     padding-top:25px; padding-bottom:25px;">
                    
            <form class="update-form" method="POST" enctype="multipart/form-data" >
                    <p class="input-row">
                        <label class="admin_crud_label" for="product_id">Product ID</label>
                        <?php html_input('text',$p_id ??  '','product_id','placeholder="eg.PROD-XXXX"')?>
                    
                        <span style="color:red"><?=$_err['product_id']??""?></span>
                        </p>
                </p>


                <p class="input-row">

                    <label class="admin_crud_label" for="product_name">Product Name</label>
                    <?php html_input('text',$p_name ??  '','product_name','placeholder="eg.I reincarnated as Ayaka Dogs "' )?>   
                    <span style="color:red"><?=$_err["product_name"] ??""?></span>
            
                

                    </p>



                    <p class="input-row">

                    <label class="admin_crud_label" for="product_price">Price</label>
                    <?php 
                        html_input('number',$p_price ??  "",'product_price' ,'min="0.5" max="9999.99" step="0.01" placeholder="eg.10.50"');   
                    ?>
                    <span style="color:red"><?=$_err["product_price"] ??""?></span>
                    </p>


                    <p class="input-row">
                        <label class="admin_crud_label" for="category_id">Category</label>
                        <?php html_select(
                        $catValue, $catName,$p_category ??  '')?>
                        <span style="color:red"><?=$_err["product_category"] ??""?></span>
                    </p>

            <?php if($category_id === 'BOOK-MAIN-001'):?>
                <p class="input-row"">
                        <label class="admin_crud_label" for="genre">Genre</label>
                        <?php html_input(
                        'text',$p_genre  ?? "",'genre','placeholder="eg.Horror,Mystery"')?>

                        
                        <span style="color:red"><?=$_err["product_genre"] ??""?></span>
                        
                    </p>


                    <p class="input-row">
                        <label class="admin_crud_label" for="publisher">Publisher</label>
                        <?php html_input(
                        'text', $p_publisher ?? "",'publisher','placeholder="eg.Dongli Publish"')?>
                        <span style="color:red"><?=$_err["product_publisher"] ??""?></span>
                    </p>


                    <p class="input-row">
                        <label class="admin_crud_label" for="publish_date">Publish Date</label>
                        <?php html_input(
                        'date', $p_publish_date ?? "",'publish_date')?>

                        <span style="color:red"><?=$_err["publish_date"] ??""?></span>

                    </p>

                    <p class="input-row">
                        <label class="admin_crud_label" for="author">Author</label>
                        <?php html_input(
                        'text', $p_author ?? "",'author','placeholder="eg.Ayaka San"')?>

                        <span style="color:red"><?=$_err["product_author"] ??""?></span>
                    </p>



                    <?php elseif($category_id === 'STAT-MAIN-002'): ?>

                        <p class="input-row">          
                            <label class="admin_crud_label" for="brand">Brand</label>
                            <?php html_input('text', $brand ?? "",'brand','placeholder="eg.Faber Castell"') ?>   
                            
                            <span style="color:red"><?=$_err["brand"] ??""?></span>
                        </p>


                        <p class="input-row">

                        <label class="admin_crud_label" for="material">Material</label>

                        <?php html_input('text', $material ?? '','material','placeholder="eg.Paper"')?>


                        
                        <span style="color:red"><?=$_err["material"] ??""?></span>
                        
                        </p>




                <?php endif?>


                
                <p class="input-row">
                        <label class="admin_crud_label" for="keyword">Keyword</label>
                        <?php html_input(
                        'text', $p_keywords ?? "",'keywords','placeholder="eg.Genshin,Ayaka,Adventure"')?>

                        <span style="color:red"><?=$_err["product_keywords"] ??""?></span>
                </p>

                <p class="input-row">
                        <label class="admin_crud_label" for="stock">Stock</label>
                        <?php html_input(
                        'number', $p_stock ?? "",'stock','min=1 max=9999 step=1 placeholder="eg.100"')?>
                        <span style="color:red"><?=$_err["stock"] ??""?></span>
                    </p>

                    <p class="input-row">
                        <label class="admin_crud_label" for="image">Product Picture</label>

                    <?php html_file('image', 'image/*', 'data-target="preview_img"')?>
                    <span style="color:red"><?=$_err["image"] ??""?></span>
                    </p>

            

                
                    <section style="margin-top:20px;" class="admin_crud_form_section">
                        <button  type="reset" class="admin_crud_close_btn">Reset</button>
                        <button type="submit" class="admin_crud_submit_btn">Submit</button>
                    </section>

            
                </form>

                    <div class="admin_crud_product_img_container">
                                <img src="<?= $image ?? 'img/Icon/photo.jpg'  ?>" data-id="preview_img">
                    </div>
         </div>
    
        
</main>



<?php require 'view/partials/footer.php' ?>
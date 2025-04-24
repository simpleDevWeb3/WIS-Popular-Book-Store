<?php
$_db = new Database();

auth('Admin');

//accept parameters from product.php (detail button)\
$page = req('page');

$id = req('id');


$stm = $_db->query('SELECT * FROM product_details 
                      INNER JOIN products ON product_details.product_id = products.product_id 
                      INNER JOIN categories ON categories.category_id = products.category_id
                      WHERE products.product_id = ?',[$id]);

$product_detail = $stm->fetch();

$_title = "Product - Details";

include 'view/partials/head.php';
include 'view/partials/header.php';

?>
<!--------------------------------------------------------------------------->
<main style="padding-top:120px;">
<a href="/product_list">
    <button class="back">
        <img src="/Img/Icon/arrow.png" class="back-img">
    </button>
</a>

<div class="admin_crud_page_container">
    <div class="admin_crud_product_detail-information">
        <div style="display: flex; flex-direction:column;justify-content:top; align-items:center;">
            <div class="admin_crud_product_img_container" style="padding-left:0;">  
                <img src="<?= $product_detail['image'] ?>" class="admin_crud_product_img">
            </div>


            <div class="admin_crud_detail_button">
                <button data-get="/product_list" class="admin_crud_detail_back_button" >Back</button>
                <button data-get="/update?id=<?= $product_detail['product_id'] ?>" class="admin_crud_detail_edit_button">Edit</button>
                <button data-confirm="Delete this record?" data-post="/controller/_delete.php?id=<?= $product_detail['product_id'] ?>" class="admin_crud_detail_delete_button">Delete</button>
            </div>
        </div>
        <div class="admin_crud_product_information">
            <div>
                <div class="admin_crud_product_information_header">
                    <div>Product ID</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail['product_id'] ?>
                </div>
            </div>
            <div>
                <div class="admin_crud_product_information_header">
                    <div>Product Name</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail['name'] ?>
                </div>
            </div>

            <?php if (str_starts_with($product_detail['category_id'], "BOOK")): ?>
                <div>
                    <div class="admin_crud_product_information_header">
                        <div>Author</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['author'] ?>
                    </div>
                </div>
                <div>
                    <div class="admin_crud_product_information_header">
                        <div>Publisher</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['publisher'] ?>
                    </div>
                </div> 
                <div>            
                    <div class="admin_crud_product_information_header">
                        <div>Publish Date</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['publish_date'] ?> 
                    </div>
                </div>
                <div>         
                    <div class="admin_crud_product_information_header">
                        <div>Genre</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['genre'] ?>
                    </div>
                </div>   
            <?php endif ?>

            <?php if (str_starts_with($product_detail['category_id'], "STAT")): ?>
                <div>
                    <div class="admin_crud_product_information_header">
                        <div>Brand</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['brand'] ?>
                    </div>             
                </div>
                <div>
                    <div class="admin_crud_product_information_header">
                        <div>Materials</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail['material'] ?>
                    </div>             
                </div>
            <?php endif ?>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Category ID</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail['category_id'] ?>
                </div>  
            </div>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Category Name</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail['category_name'] ?>
                </div>  
            </div>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Keywords</div>
                    <div>:</div>
                </div>
                <div>                     
                    <?= $product_detail['keywords'] ?>
                </div>
            </div>
            <div>
                <div class="admin_crud_product_information_header">
                    <div>Stock</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail['stock'] ?>
                </div>   
            </div>   
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>Price</div>
                    <div>:</div>
                </div>
                <div>
                    <?= "RM ".$product_detail['price']  ?>
                </div>
            </div>             
        </div>
    </div>


   

</div>
</main>
<?php require 'view/partials/footer.php' ?>
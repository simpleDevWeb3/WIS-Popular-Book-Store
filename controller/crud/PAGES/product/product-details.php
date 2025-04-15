<?php
require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';

//accept parameters from product.php (detail button)\
$page = req('page');

$id = req('id');

$stm = $_db->prepare('SELECT * FROM product_details 
                      INNER JOIN products ON product_details.product_id = products.product_id 
                      INNER JOIN categories ON categories.category_id = products.category_id
                      WHERE products.product_id = ?');
$stm->execute([$id]);
$product_detail = $stm->fetch();

$_title = "Product - Details";
include $_SERVER['DOCUMENT_ROOT'] . '/_head.php';
?>
<!--------------------------------------------------------------------------->
<a href="product.php">
    <button class="back">
        <img src="/IMG/icons/arrow.png" class="back-img">
    </button>
</a>

<div class="page-container">
    <div class="product-detail-information">
        <div class="img-container">  
            <!--<button class="previous-button"><</button>     -->        
            <img src="/IMG/<?= $product_detail->image ?>" class="product-img">
            <!--<button class="next-button">></button>   --->  
        </div>

        <div class="product-information">
            <div>
                <div class="header">
                    <div>Product ID</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail->product_id ?>
                </div>
            </div>
            <div>
                <div class="header">
                    <div>Product Name</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail->name ?>
                </div>
            </div>

            <?php if (str_starts_with($product_detail->category_id, "BOOK")): ?>
                <div>
                    <div class="header">
                        <div>Author</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->author ?>
                    </div>
                </div>
                <div>
                    <div class="header">
                        <div>Publisher</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->publisher ?>
                    </div>
                </div> 
                <div>            
                    <div class="header">
                        <div>Publish Date</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->publish_date ?> 
                    </div>
                </div>
                <div>         
                    <div class="header">
                        <div>Genre</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->genre ?>
                    </div>
                </div>   
            <?php endif ?>

            <?php if (str_starts_with($product_detail->category_id, "STAT")): ?>
                <div>
                    <div class="header">
                        <div>Brand</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->brand ?>
                    </div>             
                </div>
                <div>
                    <div class="header">
                        <div>Materials</div>
                        <div>:</div>
                    </div>
                    <div>
                        <?= $product_detail->material ?>
                    </div>             
                </div>
            <?php endif ?>

            <div>
                <div class="header">
                    <div>Category ID</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail->category_id ?>
                </div>  
            </div>

            <div>
                <div class="header">
                    <div>Category Name</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail->category_name ?>
                </div>  
            </div>

            <div>
                <div class="header">
                    <div>Keywords</div>
                    <div>:</div>
                </div>
                <div>                     
                    <?= $product_detail->keywords ?>
                </div>
            </div>
            <div>
                <div class="header">
                    <div>Stock</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $product_detail->stock ?>
                </div>   
            </div>   
            <div>       
                <div class="header">
                    <div>Price</div>
                    <div>:</div>
                </div>
                <div>
                    <?= "RM ".$product_detail->price ?>
                </div>
            </div>             
        </div>
    </div>


    <div class="product-detail-button">
        <button data-get="product.php" class="product-detail-back-button" >Back</button>
        <button data-get="product-update.php?id=<?= $product_detail->product_id ?>" class="product-detail-edit-button">Edit</button>
        <button data-confirm="Delete this record?" data-post="_delete.php?id=<?= $product_detail->product_id ?>" class="product-detail-delete-button">Delete</button>
    </div>

</div>
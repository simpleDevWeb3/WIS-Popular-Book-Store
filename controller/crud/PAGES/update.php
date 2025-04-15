<div class="product-details">
    <li>
        <div class="">Product ID :</div>
        <div>
            <?= $product_detail->product_id ?>
        </div>
    </li>
    <li>
        <div>Product Name :</div>
        <div>
            <?= $product_detail->name ?>
        </div>
    </li>
    <?php if ($product_detail->category_id === 1): ?>
        <li>
            <div>Publisher :</div>
            <div>
                <?= $product_detail->publisher ?>
            </div>
        </li> 
        <li>            
            <div>Publish Date :</div>
            <div>
                <?= $product_detail->publish_date ?> 
            </div>
        </li>
        <li>         
            <div>Genre :</div>
            <div>
                <?= $product_detail->genre ?>
            </div>
        </li>   

        <?php endif ?>

            <?php if ($product_detail->category_id === 2): ?>
                <li>
                    <div>Brand :</div>
                    <div>
                        <?= $product_detail->brand ?>
                    </div>             
            </li>
            <li>
                <div>Materials :</div>
                <div>
                    <?= $product_detail->material ?>
                </div>             
            </li>
            <?php endif ?>

            <li>
                <div>Category :</div>
                <div>
                    <?= $product_detail->category_id ?>
                </div>  
            </li>
            <li>
                <div>Stock :</div>
                <div>
                    <?= $product_detail->stock ?>
                </div>   
            </li>          
                <div>Price :</div>
                <div>
                    <?= "RM ".$product_detail->price ?>
                </div>
            </li>             
</div>

    <?php
    auth('Admin');
    //************************************************************************ */ Searching
    $search = isset($_REQUEST['search']) ? $_REQUEST['search'] : temp('search');
    temp('search', $search);

    //************************************************************************ */ Sorting
    $fields = [
        'p.product_id'  => 'Product ID.',
        'p.name'        => 'Product Name',
        'p.category_id' => 'Category',
        'pd.stock'      => 'Stock',
      
        'p.price'       => 'Price(RM)',
    ];

    $sort = req('sort');
    key_exists($sort, $fields) || $sort = 'p.product_id';

    $dir = req('dir');
    in_array($dir, ['asc', 'desc']) || $dir = 'asc';

    //************************************************************************* */ Paging
    $page = req('page') ?? temp('page') ?? 1;
    temp('page', $page);

    //require_once $_SERVER['DOCUMENT_ROOT'] . '/SimplePager.php';
    $p = new SimplePager("SELECT * FROM products p
                            INNER JOIN product_details pd
                            ON p.product_id = pd.product_id
                            WHERE p.name LIKE ?
                            ORDER BY $sort $dir",
                            ["%$search%"], 10, $page);
    $arr = $p->result;


    $_title = "Product";
    include 'view/partials/head.php';
    include 'view/partials/header.php';

    $index = 1;
    ?>
<div style="display: flex; justify-content:center; align-items:center; margin:auto; gap:10px;">
    <div style=" margin-bottom:400px; margin-left:0px;">
        <?php include 'view/partials/admin_crud_navBar.php'; ?>
    </div>
    <main style="padding-top:50x; margin-top:100px; height:700px ">
    <div style="display:flex; justify-content:center; gap:20px; ">
    
    

        <div>
            <!-----------------------------------------------------------------------------------------HTML-->
            

            <div class="admin_crud_page_container">
                <div class="product-content">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-right:40px; ">
                        <p>
                            <?= $p->count ?> of <?= $p->item_count ?> record(s) |
                            Page <?= $p->page ?> of <?= $p->page_count ?>
                        </p>



                        <div class="admin_crud_searching-and-filtering" ">
                            <form>
                                <?= html_search('search', 'placeholder="Search something..."') ?>  
                            </form>
                        </div>

                    </div>
                  
                    <!-- table -->
                    <div class="product-content-table">
                        <!--display total products-->
                        <table class="admin_crud_table">
                            <tr>
                                <th>No.</th>        
                                <?= table_headers($fields, $sort, $dir, "page=$page") ?>   
                                <th></th>     <!--empty th for buttons-->           
                            </tr>

                            <!-- display products from database -->
                            <?php foreach ($arr as $prod): ?>
                                <tr>   
                                    
                                    <td><?= $index++ ?></td>
                                    <td><?= $prod['product_id']?></td>
                                    <td><?= $prod['name'] ?></td>
                                    <td><?= $prod['category_id'] ?></td>
                                    <td><?= $prod['stock'] ?></td>
                                    <td><?= $prod['price'] ?></td>

                                    <td>
                                        <button class="admin_crud_detail-btn" data-get="/product_detail?id=<?= $prod['product_id'] ?>&page='<?= $page ?>'">Detail</button>
                                        <button class="admin_crud_update-btn" data-get="/update?id=<?= $prod['product_id'] ?>&page='<?= $page ?>'">Update</button>
                                        <button class="admin_crud_delete-btn" data-confirm="Delete this record?" data-post="/delete?id=<?= $prod['product_id'] ?>" >Delete</button>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </table>

                    </div>
                </div>

                <br>
                <?= $p->html("sort=$sort&dir=$dir&search=$search") ?>
            </div>
        </div>
    </div>
    </main>
</div>
<?php require 'view/partials/footer.php' ?>
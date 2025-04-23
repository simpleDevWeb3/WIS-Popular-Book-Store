<?php
auth('Admin');
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
//************************************************************************ */ Searching
$search = isset($_REQUEST['search']) ? $_REQUEST['search'] : temp('search');
temp('search', $search);

//************************************************************************ */ Sorting
$fields = [
    'order_Id'      => 'Order ID',
    'user_id'       => 'User ID',
    'order_date'    => 'Date',
    'status'        => 'Status',
    'total_price'   => 'Total amount(RM)',
];

$sort = req('sort');
key_exists($sort, $fields) || $sort = 'order_id';

$dir = req('dir');
in_array($dir, ['asc', 'desc']) || $dir = 'asc';

//************************************************************************* */ Paging
$page = req('page') ?? temp('page') ?? 1;
temp('page', $page);

//                                         got error, comment first, dont delete
//require_once $_SERVER['DOCUMENT_ROOT'] . '/LIB/SimplePager.php';
$p = new SimplePager("SELECT * FROM `order`
                        WHERE order_id LIKE ?
                        ORDER BY $sort $dir",
                        ["%$search%"], 10, $page);
$arr = $p->result;


$_title = "Sales";
include 'view/partials/head.php';
include 'view/partials/header.php';

$index = 1;
?>
<!-----------------------------------------------------------------------------------------HTML-->
<div style="display: flex; justify-content:center; align-items:center; margin:auto; gap:10px;">
    <div style=" margin-bottom:400px; margin-left:0px;">
        <?php include 'view/partials/admin_crud_navBar.php'; ?>
    </div>
    <main style="padding-top:50x; margin-top:100px; height:700px ">
    <div style="display:flex; justify-content:center; gap:20px; ">
            
            <div>
               

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
                                <?php foreach ($arr as $sale): ?>
                                <tr>
                            
                                    <td><?= $index++ ?></td>
                                    <td><?= $sale['order_id'] ?></d>
                                    <td><?= $sale['user_id'] ?></d>
                                    <td><?= $sale['order_date'] ?></d>
                                    <td><?= $sale['status']  ?><d>
                                    <td><?= $sale['total_price'] ?></d>
                                    <td>
                                        <button class="detail-btn" data-get="sales_detail?id=<?= $sale['order_id'] ?>&page='<?= $page ?>'">Detail</button>
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
    </main>
 </div>
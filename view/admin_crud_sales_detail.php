<?php
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
auth('Admin');
$_db = new Database();
//accept parameters from product.php (detail button)\
$page = req('page');

$id = req('id');


$stm = $_db->query('SELECT * FROM `order` o
                      INNER JOIN orderdetails od ON o.order_id = od.order_id 
                      INNER JOIN products p ON p.product_id = od.product_id
                      WHERE o.order_id = ?',[$id]);

$sales_detail = $stm->fetchAll();

$stm = $_db->query('SELECT * FROM `order` o
                      INNER JOIN users u ON o.user_id = u.user_id 
                      WHERE o.order_id = ?',[$id]);

$sales = $stm->fetch();
/*
$stm = $_db->prepare('SELECT * FROM `order` o
                      INNER JOIN orderdetails od ON o.order_id = od.order_id 
                      INNER JOIN products p ON p.product_id = od.product_id
                      INNER JOIN users u ON o.user_id = u.user_id 
                      WHERE o.order_id = ?');
$stm->execute([$id]);
$sales_detail = $stm->fetch();
*/

$_title = "Sales - Details";
$index = 1;
include 'view/partials/head.php';
include 'view/partials/header.php';

?>
<!--------------------------------------------------------------------------->
<main style="padding-top:120px;">

        <a href="/sales_list">
            <button class="back">
                <img src="/Img/Icon/arrow.png" class="back-img">
            </button>
        </a>

        <div class="admin_crud_page_container">
            <div class="sales-detail-information-1">
                <div  class="detail-left-section">              
                    <table class="sales-table-left">
                        <tr>
                            <th>Order ID:</th>
                            <td><?= $sales['order_id'] ?></td>             
                        </tr>
                        <tr>
                            <th>Member ID:</th>
                            <td><?= $sales['user_id'] ?></td>             
                        </tr>
                        <tr>
                            <th>Order Date:</th>
                            <td><?= $sales['order_date']  ?></td>             
                        </tr>
                        <tr>
                            <th>Delivery Method:</th>
                            <td>404 ERROR</td>             
                        </tr>
                    </table>
                </div>

                <div  class="detail-right-section">
                    <table class="sales-table-right">
                        <tr>
                            <th>Email:</th>
                            <td><?= $sales['email'] ?></td>             
                        </tr>
                        <tr>
                            <th>Tel. No.:</th>
                            <td><?= $sales['phone_number'] ?></td>             
                        </tr>
                        <tr>
                            <th>Member Name:</th>
                            <td><?= $sales['username'] ?></td>             
                        </tr>
                    </table>
                </div>
            </div>

            <div class="sales-detail-information-2">

                <p>Order Details:</p>

                <table class="detail-information-2">
                    <tr>
                        <th>No.</th>
                        <th>Product ID.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total</th>                      
                    </tr>

                    <?php foreach ($sales_detail as $arr): ?>
                        <tr>
                            <td><?= $index++ ?></td>
                            <td><?= $arr['product_id'] ?></td>
                            <td><?= $arr['name'] ?></td>
                            <td><?= $arr['quantity'] ?></td>
                            <td><?= $arr['quantity'] * $arr['price'] ?><td>

                        </tr> 
                    <?php endforeach ?>
                </table>

                <p class="total"><?= $sales['total_price'] ?></p>
            </div>
        </div>
        </div>
 
</main>
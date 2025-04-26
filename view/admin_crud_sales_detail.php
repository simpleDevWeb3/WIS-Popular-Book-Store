<?php
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
auth('Admin');
$_db = new Database();
//accept parameters from product.php (detail button)\
$page = req('page');
// order_id
$id = req('id');

/*
$stm = $_db->query('SELECT * FROM `order` o
                      INNER JOIN orderdetails od ON o.order_id = od.order_id 
                      INNER JOIN products p ON p.product_id = od.product_id
                      WHERE o.order_id = ?',[$id]);

$sales_detail = $stm->fetchAll();*/

//fetch order join user 
$stm = $_db->query('SELECT * FROM `order` o
                      INNER JOIN users u ON o.user_id = u.user_id 
                      INNER JOIN addresses a ON a.user_id = u.user_id 
                      INNER JOIN states s ON s.state_id = a.state_id 
                      INNER JOIN cities c ON c.city_id = a.city_id
                      WHERE o.order_id = ?',[$id]);

$sales = $stm->fetch();




//fetch order_item  from order detail table
$query = "
    SELECT od.*, p.name 
    FROM orderdetails od
    JOIN products p ON od.product_id = p.product_id
    WHERE od.order_id = :order_id
";

$order_items = $_db->query($query, ["order_id" => $id])->fetchAll();


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
<main style="padding-top: 120px;">
    <!--------------------------------------------------------------------------->
   

    <div class="admin_crud_page_container">
        <div style="background-color: purple; padding:20px; font-size:20px; color:white; font-weight:bold; display:flex; align-items:center;">
           
                <form   action="/sales_list" >
                    <button style="background-color: purple; border:none;" class="back" type="submit">
                            <i style="font-size: 25px;" class="ri-arrow-left-line"></i>
                    </button>
                </form>
                Invoice
        </div>
        <div class="sales-detail-information-1">
            <div style="padding: 20px;     background-color: white;" class="detail-left-section">              
                <table class="sales-table-left">
                    <tr>
                        <th>Order ID:</th>
                        <td style="padding: 6px;"><?= $sales['order_id'] ?></td>             
                    </tr>
                    <tr>
                        <th>Member ID:</th>
                        <td style="padding: 6px;"><?= $sales['user_id'] ?></td>             
                    </tr>
                    <tr>
                        <th>Order Date:</th>
                        <td style="padding: 6px;"><?= $sales['order_date']  ?></td>             
                    </tr>

                    <tr>
                        <th>Shipping Date:</th>
                        <td style="padding: 6px;"><?= $sales['shipping_date']  ?></td>             
                    </tr>
                </table>
            </div>

            <div  style="padding: 20px; background-color: white;""   class="detail-right-section">
                <table  class="sales-table-right">
                    <tr  >
                        <th>Email:</th>
                        <td style="padding: 6px;"><?= $sales['email'] ?></td>             
                    </tr>
                    <tr>
                        <th>Tel. No.:</th>
                        <td style="padding: 6px;"><?= $sales['phone_number'] ?></td>             
                    </tr>
                    <tr>
                        <th>Member Name:</th>
                        <td style="padding: 6px;"><?= $sales['first_name']." ".$sales['last_name']  ?></td>             
                    </tr>
                    <tr>
                        <th>Address:</th>
                        <td style="padding: 6px;"><?= $sales['address']?></td>             
                    </tr>
                </table>
            </div>
        </div>

        <div  style="padding: 20px; background-color: white; " class="sales-detail-information-2">

            <p>Order Details:</p>

            <table class="detail-information-2">
                <tr>
                    <th>No.</th>
                    <th>Product ID.</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total</th>                      
                </tr>
                <?php $_sum = 0;?>
                <?php foreach ($order_items  as $arr): ?>
                    <tr>
                        <td style="padding: 10px;"><?= $index++ ?></td>
                        <td><?= $arr['product_id'] ?></td>
                        <td><?= $arr['name'] ?></td>
                        <td><?= $arr['quantity'] ?></td>
                        <td><?=number_format( $arr['quantity'] * $arr['price'],2) ?><td>
                        <?php $_sum += $arr['quantity'] * $arr['price'] ?>
                    </tr> 
                <?php endforeach ?>
            </table>
  
           
        </div>

        <div style=" font-size:20px; padding:20px;" >
            <div style="display:flex; justify-content:space-between;">
                
                <p style="font-weight: bold;">Total </p>
                <p style="font-weight: bold;" class="total"><?=   number_format($_sum,2) ?></p>
            </div>

              <div style="display:flex; justify-content:space-between;">
                <p style="font-weight: bold;">Tax(6%) </p>
                <p style="font-weight: bold;" class="total"><?=number_format($_sum  * 0.06,2) ?></p>
            </div>
       </div>

        <div style="background-color:rgb(234, 229, 229); font-size:20px; padding:20px;" >
           

            <div style="display:flex; justify-content:space-between;">

                <p style="font-weight: bold;">Total Sum </p>
                <p style="font-weight: bold;" class="total"><?= $sales['total_price'] ?></p>
            </div>
    
        </div>

    </div>
    </div>
 </main>
 <?php include 'view/partials/footer.php'; ?>

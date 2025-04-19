<?php
require '../_base.php';

$_title = "Sales-details";
include $_SERVER['DOCUMENT_ROOT'] . '/admin_crud_navBar.php';
?>

<button class="back">
    <img src="/IMG/icons/arrow.png" class="back-img">
</button>

<div class="admin_crud_page_container">
    <div class="sales-detail-information-1">
        <div  class="detail-left-section">              
            <table class="sales-table-left">
                <tr>
                    <th>Order ID:</th>
                    <td>123456789</td>             
                </tr>
                <tr>
                    <th>Member ID:</th>
                    <td>123456789</td>             
                </tr>
                <tr>
                    <th>Order Date:</th>
                    <td>Date</td>             
                </tr>
                <tr>
                    <th>Delivery Method:</th>
                    <td>Method</td>             
                </tr>
            </table>
        </div>

        <div  class="detail-right-section">
            <table class="sales-table-right">
                <tr>
                    <th>Email:</th>
                    <td>email</td>             
                </tr>
                <tr>
                    <th>Tel. No.:</th>
                    <td>123456789</td>             
                </tr>
                <tr>
                    <th>Member Name:</th>
                    <td>name</td>             
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

            <tr>
                <td>1.</td>
                <td>ABC12345</td>
                <td>ProductName 1</td>
                <td>12345</td>
                <td>123.45</td>
            </tr>

            <tr>
                <td>1.</td>
                <td>ABC12345</td>
                <td>ProductName 1</td>
                <td>123</td>
                <td>00.00</td>
            </tr>
        </table>

        <p class="total">123.45</p>
    </div>
</div>

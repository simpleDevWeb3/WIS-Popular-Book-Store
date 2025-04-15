<?php
require '../_base.php';

$_title = "Report";
include '../_head.php';
?>

<div class="input-date">
    <div class="from-date-section">
        <p>From</p>
        <input type="date" class="from-date">
    </div>

    <div class="to-date-section">
        <p>To</p>
        <input type="date" class="to-date">
    </div>        
</div>

<table class="table">
    <tr>
        <th>No.</th>
        <th>Product ID.</th>
        <th>Product Name</th>
        <th>Quantity Sold</th>
        <th>Total Sales</th>                   
    </tr>

    <tr>
        <td>1.</td>
        <td>ABC12345</td>
        <td>ProductName 1</td>
        <td>12345</td>
        <td>12345</td>
    </tr>

    <tr>
        <td>1.</td>
        <td>ABC12345</td>
        <td>ProductName 1</td>
        <td>12345</td>
        <td>12345</td>
    </tr>

</table>
<?php
require '../_base.php';

$_title = "Sales";
include '../_head.php';
?>
    
<div class="function-toolsbar">    
    <div class="searching-and-filtering">
        <form>
            <?= html_search('search', 'placeholder="Search something..."') ?>
            <button class="search-button">
                <img src="/IMG/icons/search.png" class="search-img">
            </button>
        </form>
    </div>
</div>

<table class="table">
    <tr>
        <th>No.</th>
        <th>Order ID.</th>
        <th>Member ID</th>
        <th>Delivery Method</th>
        <th>Total Prices</th>
    </tr>

    <tr>
        <td>1.</td>
        <td>ABC12345</td>
        <td>123456789</td>
        <td>method</td>
        <td>12345</td>
    </tr>    

    <tr>
        <td>1.</td>
        <td>ABC12345</td>
        <td>123456789</td>
        <td>method</td>
        <td>12345</td>
    </tr>

</table>
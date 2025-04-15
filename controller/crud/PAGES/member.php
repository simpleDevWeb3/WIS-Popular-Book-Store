<?php
require '../_base.php';

$_title = 'Member';
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

<div class="page-container">
    <table class="table">
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Member ID</th>
            <th>Email</th>
            <th>Tel. No.</th>
            <th>Dob</th>
        </tr>

        <tr>
            <td>1.</td>
            <td>AAA</td>
            <td>123456789</td>
            <td>abc@gmail.com</td>
            <td>0123456789</td>
            <td>date</td>
        </tr>

        <tr>
            <td>1.</td>
            <td>AAA</td>
            <td>123456789</td>
            <td>abc@gmail.com</td>
            <td>0123456789</td>
            <td>date</td>
        </tr>

    </table>
</div>
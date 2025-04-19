<?php
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
auth('Admin');
$_title = 'Member';
include 'view/partials/head.php';
include 'view/partials/header.php';
?>
<main style="padding-top:120px;">
    <div style="display:flex; justify-content:center; gap:20px; ">
        <div>
            <?php include 'view/partials/admin_crud_navBar.php'; ?>
        </div>
    <div>
        <div class="admin_crud_function-toolsbar">
            <div class="admin_crud_searching-and-filtering">
                <form>
                    <?= html_search('search', 'placeholder="Search something..."') ?>
                    <button class="admin_crud_search-button">
                        <img src="/Img/Icon/search.png" class="admin_crud_search-img">
                    </button>
                </form>
            </div>
        </div>



        <div class="admin_crud_page_container">
            <table class="admin_crud_table">
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
    </div>
</main>
<?php require 'view/partials/footer.php' ?>
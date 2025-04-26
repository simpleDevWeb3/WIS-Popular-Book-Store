<?php
//require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';
auth('Admin');
$_title = 'Member';
include 'view/partials/head.php';
include 'view/partials/header.php';
?>
<?php
$_db = new Database();

$page = req('page');

$id = req('id');


$stm = $_db->query('SELECT * FROM users u
                    INNER JOIN addresses a ON a.user_id = u.user_id 
                    INNER JOIN states s ON s.state_id = a.state_id 
                    INNER JOIN cities c ON c.city_id = a.city_id
                    WHERE u.user_id = ?',[$id]);
$user_details = $stm->fetch();

$_title = "Member - Details";

include 'view/partials/head.php';
?>
<!--------------------------------------------------------------------------->
<main style="padding-top:120px;">
<a href="/member_list">
    <button class="back">
        <img src="/Img/Icon/arrow.png" class="back-img">
    </button>
</a>
<div class="admin_crud_page_container">
    <div class="admin_crud_product_detail-information">
        <div class="admin_crud_product_information">
            <div>
                <div class="admin_crud_product_information_header">
                    <div>User ID</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['user_id'] ?>
                </div>
            </div>
            <div>
                <div class="admin_crud_product_information_header">
                    <div>Username</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['username'] ?>
                </div>
            </div>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Name</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['first_name']." ".$user_details['last_name'] ?>
                </div>  
            </div>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Date of Birth</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['dob'] ?>
                </div>  
            </div>

            <div>
                <div class="admin_crud_product_information_header">
                    <div>Gender</div>
                    <div>:</div>
                </div>
                <div>                     
                    <?= $user_details['gender'] ?>
                </div>
            </div>
            <div>
                <div class="admin_crud_product_information_header">
                    <div>Phone no.</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['phone_number'] ?>
                </div>   
            </div>   
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>Email</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['email']  ?>
                </div>
            </div>
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>Address</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['street'].", ".$user_details['city_name'] ?>
                </div>
            </div>
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>Postal code</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['postal_code']?>
                </div>
            </div>
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>State</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['state_name'] ?>
                </div>
            </div>
            <div>       
                <div class="admin_crud_product_information_header">
                    <div>Date created</div>
                    <div>:</div>
                </div>
                <div>
                    <?= $user_details['created_at']  ?>
                </div>
            </div>               
        </div>



        <div class="admin_crud_product_img_container">  
            <img src="<?= $user_details['profile_image'] ?>" class="admin_crud_product_img">
        </div>
    </div>


</div>

</main>
<?php require 'view/partials/footer.php' ?>

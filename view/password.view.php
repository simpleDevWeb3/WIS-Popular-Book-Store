 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<?php
    (auth('Member','Admin')); 
    if (isset($_POST['reset-password'])) {
        header('Location: /password');
    }

    if (isset($_POST['user-details'])) {
        header('Location: /profile');
    }

    if (isset($_POST['manage-addrs'])) {
        header('Location: /address');
    }

    if (isset($_POST['logout'])) {
        logout($url = '/');
    }
  ?>
<div style=" display:flex; justify-content: left;padding-left: 100px;">
    <?php require 'view/partials/sidebar.php' ?>
 <div class="user-profile">
 <div class="profile-main" style="margin-top: 105px; height:auto; display:flex; align-items:top; ">

        <h1 style=" margin-bottom:20px; margin-left:10px">My Password</h1>


        
                    

                <form method="post" class="user-details">
                

                    <div class="detail-row">
                        <label>
                            <strong>Password</strong>
                            <br>
                            <input style=" width: 600px;" type="password" name="password"  required />
                        </label>
                    </div>

                    <div class="detail-row">
                        <label>
                            <strong>New Password</strong>
                            <br>
                            <input style=" width: 600px;" type="password" name="new_password" required />
                        </label>
                    </div>

                    <div class="detail-row">
                        <label>
                            <strong>Confirm Password</strong>
                            <br>
                            <input style=" width: 600px;" type="password" name="confirm_password"  />
                        </label>
                    </div>

                    <button class="update-btn" type="submit">Update Password</button>

                    <button class="update-reset-btn" >Reset</button>
                </form>

        
        
        </div>
    </div>
</div>
<?php require "view/partials/footer.php" ?>  
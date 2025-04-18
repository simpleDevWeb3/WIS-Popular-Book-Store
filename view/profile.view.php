 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<?php

    (auth('Member')); 
    
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
<div style=" display:flex; justify-content: left;padding-left: 100px; ">

    <?php require 'view/partials/sidebar.php' ?>

        <div class="user-profile">
       
            <div class="profile-main" style="margin-top: 105px; height:auto; display:flex; align-items:top; ">

           
                   <div> 
                    <h1 style=" margin-bottom:20px; margin-left:10px;  margin: 0px;" >Edit Profile </h1>
                    <br>
                    
                    <div id="profile-img" style="position: relative;" >
                        <img  class="user-profile-img" height="160px" width="160px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" />

                        <button class="edit-img" ><i class="ri-edit-2-fill"></i></button>

                        <div id="overlay" class="overlay">
                            <div id="edit-img-js"  class="edit-img-window">
                                <i id="close-window" class="ri-close-circle-fill"></i>
                            </div>
                        </div>
                    </div>
                    </div>
                  
                        
                   
            
                    <form method="post" class="user-details">
                    <h2 style="margin-bottom: 20px;">User Details</h2>
                       
                        <div class="detail-row">
                            <label>
                                <strong>First Name</strong>
                                <br>
                                <input type="text" name="first_name" value="<?=htmlspecialchars($_user['first_name'])?>" required />
                            </label>
                            <label>
                                <strong>Last Name</strong>
                                <br>
                                <input  type="text" name="last_name" value="<?=htmlspecialchars($_user['last_name'])?>" required />
                            </label>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Username</strong>
                                <br>
                                <input style=" width: 600px;" type="text" name="username" value="<?=htmlspecialchars($_user['username'])?>" required />
                            </label>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Email</strong>
                                <br>
                                <input style=" width: 600px;" type="email" name="email" value="<?=htmlspecialchars($_user['email'])?>" required />
                            </label>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Phone</strong>
                                <br>
                                <input style=" width: 600px;" type="text" name="phone_number" value="<?=htmlspecialchars($_user['phone_number'] ?? '')?>" />
                            </label>
                        </div>

                        <button class="update-btn" type="submit">Update Details</button>

                        <button class="update-reset-btn" >Reset</button>
                    </form>

                </div>

                    
                


            
            </main>
        </div>
</div>
<?php require "view/partials/footer.php" ?>  
<script>
$('#profile-img').on('click', function (e) {
    e.stopPropagation(); 
    $('#edit-img-js').addClass('show');
    $('#overlay').addClass('show');
  });

  // Close the popup
  $('#close-window').on('click', function (e) {
    e.stopPropagation(); 
    $('#edit-img-js').removeClass('show');
    $('#overlay').removeClass('show');
  });
</script>

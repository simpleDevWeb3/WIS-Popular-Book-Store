 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'controller/profile.php';?>

<style>

.img-file{

    display: none;
}

</style>
  

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

                            <div id="overlay" class="overlay" >
                                <div id="edit-img-js"  class="edit-img-window">
                                    <i id="close-window" class="ri-close-circle-fill"></i>

                                    <form method="POST" enctype="multipart/form-data">
                                        <div style=" display: flex; flex-direction: column; justify-content:center; align-items:center; gap:20px;">
                                            <label style="margin-top: 20px;" for="profile_pic">Upload Profile Photo</label>
                                            
                                            <div>
                                                <img width="220px;" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?> ">
                                            </div>

                                           
                                     
                                            <input id="img-file" class="img-file" type="file" name="profile_pic"  accept="image/*" required>
                                            <div  style="display: flex; gap:10px;">
                                                <button id="select-img" style="padding: 10px 20px; border:none; ">
                                                    Select Image
                                                </button>

                                                <button style="border: none;" type="submit"> 
                                                    <i style="font-size: 35px;" class="ri-save-3-fill"></i>
                                               </button>
                                            </div>
                                           

                                        </div>
                                         
                                    </form>

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
                                <input type="text" name="first_name" value="<?=htmlspecialchars($_user['first_name'])?>"/>
                             
                            </label>
                            <label>
                                <strong>Last Name</strong>
                                <br>
                                <input  type="text" name="last_name" value="<?=htmlspecialchars($_user['last_name'])?>"/>
                            </label>

                            <div  id="error-msg"  style="position: absolute; top:220px;  color:#db1f1f; font-weight:bolder; right:50px; ">
                                    <?php if(!empty($_err['name'])): ?>
                                    <span><?php echo $_err['name'] ?></span>
                                    <?php endif ?>
                             </div>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Username</strong>
                                <br>
                                <input style=" width: 600px;" type="text" name="username" value="<?=htmlspecialchars($_user['username'])?>"  />

                                <div id="error-msg"  style="position: absolute; top:275px; right:120px; color:#db1f1f; font-weight:bolder; ">
                                    <?php if(!empty($_err['username'])): ?>
                                    <span><?php echo $_err['username'] ?></span>
                                    <?php endif ?>
                                </div>
                              

                            </label>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Email</strong>
                                <br>
                                <input style=" width: 600px;" type="email" name="email" value="<?=htmlspecialchars($_user['email'])?>"  />

                                <div  id="error-msg"  style="position: absolute; top:365px; right:120px; color:#db1f1f; font-weight:bolder; ">
                                    <?php if(!empty($_err['email'])): ?>
                                    <span><?php echo $_err['email'] ?></span>
                                    <?php endif ?>
                                </div>
                            </label>
                        </div>

                        <div class="detail-row">
                            <label>
                                <strong>Phone</strong>
                                <br>
                                <input style=" width: 600px;" type="text" name="phone_number" value="<?=htmlspecialchars($_user['phone_number'] ?? '')?>" />
                            </label>

                            <div  id="error-msg"  style="position: absolute; top:455px; right:120px; color:#db1f1f; font-weight:bolder; ">
                                    <?php if(!empty($_err['phone'])): ?>
                                    <span><?php echo $_err['phone'] ?></span>
                                    <?php endif ?>
                                </div>
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

  $('.detail-row input').on('click', function () {
  $(this).closest('.detail-row').find('#error-msg').html('');
});

$('#select-img').on('click',function(){
    $('#img-file').click();
})

</script>

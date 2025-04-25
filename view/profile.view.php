 
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

           
             <form method="post" class="user-details" enctype="multipart/form-data" style="display: flex; gap:20px;">
                   <div> 
                        <h1 style=" margin-bottom:20px; margin-left:10px;  margin: 0px;" >Edit Profile </h1>
                        <br>
                        
                        <label for="image" id="profile-img" style="position: relative; width:200px;" >
                            <img data-id = 'preview_img' class="user-profile-img" height="160px" width="160px" src="/<?=$image ?>">

                            <button class="edit-img" ><i class="ri-edit-2-fill"></i></button>
                            
                            <input type="file" id="image" name='image' accept="image/*" data-target="preview_img" style="display: none;">              
                          
                        </label>
                        <br><br><br><br><br><br><br>

                        <?php if(!empty($_err['image'])): ?>
                                 <div style="color:#db1f1f; margin-left: 20px;  width: 120px; text-align: center;; font-weight:bold;"><?php echo $_err['image'] ?></div>
                         <?php else: ?>  
                                <div style="color:gray; margin-left: 20px;  width: 120px; text-align: center;; font-weight:bold;">File size: maximum 1 MB<p style="margin-top: 10px;">
                                File extension: .JPEG, .PNG</p></div>
                         <?php endif ?>   
                    </div>
                 <br><br><br><br><br><br>
                         
                   
                            <div>
                                
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
                            </div>
                    </form>

                </div>

                    
                


            
            </main>
        </div>
</div>
<?php require "view/partials/footer.php" ?>  
<script>




  $('.detail-row input').on('click', function () {
  $(this).closest('.detail-row').find('#error-msg').html('');
});


$('input[type=file]').on('change', e => {
        const f = e.target.files[0];
        //const img = $(e.target).siblings('img')[0];

        // Get the unique identifier from the file input
        const targetId = $(e.target).data('target');

        // Find the corresponding image using the unique identifier
        const img = $(`[data-id="${targetId}"]`)[0];

        if (!img) return;

        img.dataset.src ??= img.src;

        if (f?.type.startsWith('image/')) {
            img.src = URL.createObjectURL(f);
        }
        else {
            img.src = img.dataset.src;
            e.target.value = '';
        }
    });


</script>

 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<<?php require 'controller/password.php';?>

<div style=" display:flex; justify-content: left;padding-left: 100px;">
    <?php require 'view/partials/sidebar.php' ?>
 <div class="user-profile">
 <div class="profile-main" style="margin-top: 105px; height:auto; display:flex; align-items:top;">
    <div style="display: flex; flex-direction:column; align-items:center;  ">
        <h1 style=" margin-bottom:20px; margin-left:10px">My Password</h1>

        <i  style="font-size: 180px;"  class="ri-lock-2-fill"></i>       
    </div>              

                <form method="post" class="user-details">
                

                    <div class="detail-row">
                        <label>
                            <strong>Password</strong>
                            <br>
                            <input  id="view-password"  style=" width: 600px;" type="password" name="password"
                            value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>"  required />
                        </label>
                        <i data-target='#view-password' style="position:absolute; top:115px; right:100px; cursor:pointer"  class="ri-eye-line toggle-password"></i>

                        <div  id="error-msg"  style="position: absolute; top:155px;  color:#db1f1f; font-weight:bolder; left:330px; ">
                                    <?php if(!empty($_err['password'])): ?>
                                          <span><?php echo $_err['password'] ?></span>
                                    <?php endif ?>
                         </div>
                    </div>

                    <div style="margin-top: 30px;" class="detail-row">
                        <label>
                            <strong>New Password</strong>
                            <br>
                            <input id="view-new-password"  style=" width: 600px;" type="password" name="new_password" required />
                        </label>
                        <i data-target='#view-new-password'  style="position:absolute; top:225px; right:100px; cursor:pointer "  class="ri-eye-line toggle-password"></i>

                        <div  id="error-msg"  style="position: absolute; top:265px; left:340px; color:#db1f1f; font-weight:bolder; right:100px; ">
                                    <?php if(!empty($_err['password_format'])): ?>
                                          <span><?php echo $_err['password_format'] ?></span>
                                    <?php endif ?>
                         </div>
                    </div>

                    <div style="margin-top: 35px;" class="detail-row">
                        <label>
                            <strong>Confirm Password</strong>
                            <br>
                            <input id="view-confirm-password" style=" width: 600px;" type="password" name="confirm_password" />
                        </label>
                        <i data-target='#view-confirm-password'  style="position:absolute; top:340px; cursor:pointer; right:100px;"  class="ri-eye-line toggle-password"></i>

                        <div  id="error-msg"  style="position: absolute; top:296px;  left:340px;  color:#db1f1f; font-weight:bolder; right:100px; ">
                                    <?php if(!empty($_err['confirm_password'])): ?>
                                          <span><?php echo $_err['confirm_password'] ?></span>
                                    <?php endif ?>
                         </div>
                    </div>

                    <button class="update-btn" type="submit">Update Password</button>

                    <button class="update-reset-btn" >Reset</button>
                </form>

        
        
        </div>
    </div>
</div>
<?php require "view/partials/footer.php" ?>  


<script>

    $('.toggle-password').click(function() {
        const input =$($(this).data('target'));
        const currentType = input.attr('type');
        input.attr('type', currentType === 'password' ? 'text' : 'password');

        $(this).toggleClass('ri-eye-line ri-eye-off-line');
    });

    $('.detail-row input').on('click', function () {
        $(this).closest('.detail-row').find('#error-msg').html('');
    });
</script>
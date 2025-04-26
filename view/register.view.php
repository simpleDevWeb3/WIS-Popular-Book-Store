
<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>

  
<?php require 'partials/head.php';?>

<?php require 'controller/register.php';?>

   <div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

   <br>
   <form style=" align-items: center;"  method="post" class="form-login" >

      
   <?php require 'partials/tracking.php';?>

      <div class="register-input">
        <label for="new-username">Username</label>
        <input type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">

        <div id="username-dup" style="position: absolute; bottom: 410px; width:400px; ">
          <?php if (!empty($err_name)): ?>
              <p  style="color:red; font-weight:bold;"><?php echo $err_name; ?></p>
          <?php endif; ?>

        </div>
        <br>

        <label for="new-user-email">Email</label>
        <input type="email" name="new-user-email" id="new-user-email" value="<?php echo htmlspecialchars($_POST['new-user-email'] ?? '') ?>" required placeholder="Enter your email">

        <div id="email-dup" style="position: absolute; bottom: 308px; ">
          <?php if (!empty($err_email)): ?>
              <p style="color:red; font-weight:bold;"><?php echo $err_email; ?></p>
          <?php endif; ?>
        </div>
            <br>
        

       <!-- Create New Password -->
<div style="margin-bottom: 40px; position: relative;">
    <label for="new-user-password">Create New Password</label>
    
    <div style="position: relative; display: flex; align-items: center;">
        <input 
            style="flex: 1; padding-right: 40px;" 
            type="password" 
            name="new-user-password" 
            id="new-user-password" 
            value="<?php echo htmlspecialchars($_POST['new-user-password'] ?? '') ?>" 
            required 
            placeholder="Enter your password"
        >

        <i 
            data-target="#new-user-password" 
            style="position: absolute; right: 10px; font-size: 20px; cursor: pointer;" 
            class="ri-eye-line toggle-password"
        ></i>
    </div>

    <div id="error-password" style="margin-top: 5px;">
        <?php if (!empty($err_password)): ?>
            <p style="color:red; font-weight:bold;"><?php echo $err_password; ?></p>
        <?php endif; ?>
    </div>
</div>

  <!-- Confirm Password -->
  <div style="margin-bottom: 40px; position: relative;">
      <label for="confirm-user-password">Confirm Password</label>
      
      <div style="position: relative; display: flex; align-items: center;">
          <input 
              style="flex: 1; padding-right: 40px;" 
              type="password" 
              name="confirm-user-password" 
              id="confirm-user-password" 
              value="<?php echo htmlspecialchars($_POST['confirm-user-password'] ?? '') ?>" 
              required 
              placeholder="Enter the password again"
          >

          <i 
              data-target="#confirm-user-password" 
              style="position: absolute; right: 10px; font-size: 20px; cursor: pointer;" 
              class="ri-eye-line toggle-password"
          ></i>
      </div>

      <div id="error-confirm-password" style="margin-top: 5px;">
          <?php if (!empty($err_password_match)): ?>
              <p style="color:red; font-weight:bold;"><?php echo $err_password_match; ?></p>
          <?php endif; ?>
      </div>
  </div>


        <section style="display: flex; flex-direction:column; margin-top: 20px; ">

            <button class="register-btn" type="submit">Next Step</button>
            <br>
    
        </section>
      </div>
       <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
       
   </form>
 </div>

 <script>
   
  $('#new-username').click(() => {
    $('#username-dup').html('');

  });

  $('#new-user-email').click(() => {
    $('#email-dup').html('');
  });

  $('#new-user-password').click(() => {
    $('#error-password').html('');
  });

  $('#confirm-user-password').click(() => {
    $('#error-confirm-password').html('');
  });

  $('#phone').click(() => {
    $('#phone-error').html('');
  });

  $('.toggle-password').click(function(){
        const input =$($(this).data('target'));
        const currentType = input.attr('type');
        input.attr('type', currentType === 'password' ? 'text' : 'password');

       $(this).toggleClass('ri-eye-line ri-eye-off-line');
  })


</script>

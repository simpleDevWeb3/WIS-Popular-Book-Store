
<?php require 'partials/head.php';?>

<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>
  
<?php if(urlIs('/login')): ?>
 

  <div style="display: flex; height:700px; margin-top:50px; justify-content:center; border-radius:8px;">
    <div style="box-shadow: 0px 4px 10px rgba(0,0,0,0.5);">

    <img src="/Img/Category/login.jpg" style="width: 500px; height:700px; object-fit: cover;">
    </div>
 
      <form  method="post" class="form-login" style="box-shadow: 0px 4px 10px rgba(0,0,0,0.5);">
     

        <div style="display: flex; align-items:center; margin-top:-120px; margin-bottom:25px;">
          <img class="popular-logo " src="/Img/Logo/Popular app.png" style="width: 130px;">
          
          <div style="font-size: 20px;">
            <h1 style="color: red;">Popular</h1>
            <h1 style="font-weight: 400;">BookStore</h1>
          </div>
         
        </div>
        
          <label style=" margin-bottom: 10px;"   for="email">Email</label>
          <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" required placeholder="Enter your email">
         
          <div style="display: flex; flex-direction: column; position: relative;">
            <label style="margin-top: 20px; margin-bottom: 10px;" for="password">Password</label>

            <div style="position: relative; display: flex; align-items: center;">
                <input 
                    style="flex: 1; padding-right: 40px; margin-bottom: 20px;" 
                    type="password" 
                    name="password" 
                    id="password" 
                    value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>" 
                    required 
                    placeholder="Enter your password"
                >

                <i 
                    data-target="#password" 
                    style="position: absolute;top:13px; right: 13px; font-size: 20px; cursor: pointer;"
                    class="ri-eye-line toggle-password"
                ></i>
            </div>
        </div>


       

            <?php if(isset($_POST['email']) && isset($_POST['password'])): ?>
              <span id="error" style="color: red; position:absolute; top:420px;  z-index: 1000;">
                <?php if (isset($_SESSION['error'])): ?>
                  <?=$_SESSION['error']?>
                <?php endif ?>
              </span>
            <?php endif?>
            
          <section style="margin-bottom: 50px; margin-top:20px;">
              <button class="login-btn" type="submit">Login</button>
              <button class="resert-btn">Reset</button>
          </section>
          <p style="margin-left: 10px; font-size:17px;">Don't have  an account?<a href="/register-general" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Register as user</a></p>
      </form>

   
    </div>
    <?php endif?>
    

   
<script>
  $('.resert-btn').click(() => {
    $('#email').val('');
    $('#password').val('');
    $('#username').val('');
    $('#confirm-password').val('');
    $('#error').html('');
  });

  $('#email').click(() => {
    $('#error').html('');

  });

  $('#password').click(() => {
    $('#error').html('');

  });

  $('.toggle-password').click(function(){
        const input =$($(this).data('target'));
        const currentType = input.attr('type');
        input.attr('type', currentType === 'password' ? 'text' : 'password');

       $(this).toggleClass('ri-eye-line ri-eye-off-line');
  })

</script>


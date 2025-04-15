
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
     
          <label for="email">Email</label>
          <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" required placeholder="Enter your email">
         

          <label for="password">Password</label>
          <input  type="password" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>"required placeholder="Enter your password">

            <?php if(isset($_POST['email']) && isset($_POST['password'])): ?>
              <span id="error" style="color: red; position:absolute; top:430px;  z-index: 1000;">
                <?php if (isset($_SESSION['error'])): ?>
                  <?=$_SESSION['error']?>
                <?php endif ?>
              </span>
            <?php endif?>
            
          <section style="margin-bottom: 50px;">
              <button class="login-btn" type="submit">Login</button>
              <button class="resert-btn">Reset</button>
          </section>
          <p style="margin-left: 10px; font-size:17px;">Don't have  an account?<a href="/register" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Register as user</a></p>
      </form>

   
    </div>
    <?php endif?>
    <?php if(urlIs('/register')): ?>
   
      <div style="display: flex; height:600px; margin-top:50px; justify-content:center;">
      <form  method="post" class="form-login">

      <a href="/" style="text-decoration: none; margin-top: 25px; " onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Back to Home</a>

         <h1 style="margin-bottom: 25px; margin-top: 10px;">Registration</h1>
         <label for="username">Username</label>
         <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? '') ?>"  required placeholder="Enter your username">

         <label for="email">Email</label>
          <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? '') ?>" required placeholder="Enter your email">
         

          <label for="password">Create new Password</label>
          <input  type="password" name="password" id="password" value="<?php echo htmlspecialchars($_POST['password'] ?? '') ?>"required placeholder="Enter your password">


          <label for="confirm-password">Confirm Password</label>
          <input type="password" name="confirm-password" id="confirm-password" value="<?php echo htmlspecialchars($_POST['confirm-password'] ?? '') ?>"  required placeholder="Enter the password before">

          <section>
              <button class="register-btn" type="submit">Register</button>
              <button class="resert-btn"  >Reset</button>
          </section>

          <p style="margin-left: 10px; margin-bottom: 25px; font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
          
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

</script>


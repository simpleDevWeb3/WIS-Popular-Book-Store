
<?php require 'partials/head.php';?>


  
<?php if(urlIs('/login')): ?>
  <div style="display: flex; height:700px; margin-top:50px; justify-content:center;">
    <div>

    <img src="/Img/Category/login.jpg" style="width: 500px; height:700px; object-fit: cover;">
    </div>
   
      <form  method="post" class="form-login">
       <a href="/" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Back to Home</a>
         <h1 style="margin-bottom: 25px;">Login</h1>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>

          <section>
              <button class="login-btn" type="submit">Login</button>
              <button class="resert-btn" type="reset" >Reset</button>
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
         <input type="text" name="username" id="username" required>

          <label for="create-email">Email</label>
          <input type="email" name="create-email" id="create-email" required>

          <label for="new-password">Create a New Password</label>
          <input type="password" name="new-password" id="new-password" required>

          <label for="confirm-password">Confirm Password</label>
          <input type="password" name="confirm-password" id="confirm-password" required>

          <section>
              <button class="register-btn" type="submit">Register</button>
              <button class="resert-btn" type="reset" >Reset</button>
          </section>
          <p style="margin-left: 10px; margin-bottom: 25px; font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
      </form>
    </div>
  
    <?php endif?>

   



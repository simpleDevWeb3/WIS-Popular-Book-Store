
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'partials/navbar.php';?>

<main  style="display: flex;" >
  
<?php if(urlIs('/login')): ?>
  <div style="display: flex; height:500px; margin-top:50px;">
    <div>

    <img src="/Img/Category/login.jpg" style="width: 500px; height:500px; object-fit: cover;">
    </div>
   
      <form  method="post" class="form-login">
         
         <h1 style="margin-bottom: 25px;">Login</h1>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>

          <section>
              <button class="login-btn" type="submit">Login</button>
              <button class="resert-btn" type="reset" >Resert</button>
          </section>
          <p style="margin-left: 10px; font-size:17px;">Don't have  an account?<a href="/register" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Register as user</a></p>
      </form>

   
    </div>
    <?php endif?>
    <?php if(urlIs('/register')): ?>
   
  
      <form  method="post" class="form-login">
         
         <h1 style="margin-bottom: 25px; margin-top: 25px;">Registration</h1>
         <label for="username">Username</label>
         <input type="email" name="email" id="email" required>
          <label for="email">Email</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Password</label>
          <input type="password" name="password" id="password" required>

          <label for="password">Confirm Password</label>
          <input type="password" name="password" id="password" required>

          <section>
              <button class="register-btn" type="submit">Register</button>
              <button class="resert-btn" type="reset" >Resert</button>
          </section>
          <p style="margin-left: 10px; margin-bottom: 25px; font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
      </form>
   
  
    <?php endif?>
</main>


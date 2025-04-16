
<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>

  
<?php require 'partials/head.php';?>

 
   <div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

   <br>
   <form style=" align-items: center;"  method="post" class="form-login" action="/register-address">

   
      
   <?php require 'partials/tracking.php';?>

      <div class="register-input">
        <label for="new-username">Username</label>
        <input type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">

        <label for="new-email">Email</label>
        <input type="new-email" name="new-email" id="new-email" value="<?php echo htmlspecialchars($_POST['new-email'] ?? '') ?>" required placeholder="Enter your email">
        

        <label for="new-password">Create new Password</label>
        <input  type="password" name="new-password" id="new-password" value="<?php echo htmlspecialchars($_POST['new-password'] ?? '') ?>"required placeholder="Enter your password">


        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="confirm-password" id="confirm-password" value="<?php echo htmlspecialchars($_POST['confirm-password'] ?? '') ?>"  required placeholder="Enter the password before">

        <section style="display: flex; flex-direction:column; margin-top: 20px; ">
            <button class="register-btn" type="submit">Next Step</button>
            <br>
            <button style="margin-top: 0px; margin-bottom:35px;" class="resert-btn"  >Reset</button>
        </section>
      </div>
       <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
       
   </form>
 </div>
   

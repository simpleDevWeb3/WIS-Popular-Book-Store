
<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>

<?php require 'partials/head.php';?>


<div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

<br>
<form  style=" align-items: center;"   method="post" class="form-login" action="/">

<?php require 'partials/tracking.php';?>

    <div class="register-input">

    
    <label for="new-password">Street Address</label>
     <input  type="password" name="new-password" id="new-password" value="<?php echo htmlspecialchars($_POST['new-password'] ?? '') ?>"required placeholder="Enter your password">

      <div style="display: flex; column-gap:10px;">
        <div>
          <label for="new-username">City</label>
          <br>
          <input style="width:300px;" type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">
        </div>
        
        <div>
          <label for="new-username">State / Province</label>
          <br>
          <input style="width:300px;" type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">
        </div>

        

      </div>
     
     



     <label for="confirm-password">Postal Code</label>
     <input type="password" name="confirm-password" id="confirm-password" value="<?php echo htmlspecialchars($_POST['confirm-password'] ?? '') ?>"  required placeholder="Enter the password before">

     <section style="display: flex; flex-direction:column; margin-top: 20px; ">
         <button class="register-btn" type="submit">Finish</button>
         <br>
         <button style="margin-top: 0px; margin-bottom:35px;" class="back-btn">Back</button>
     </section>
   </div>
    <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
    
</form>

<script>
  $('.back-btn').on('click', function() {
    window.history.back();
  });
</script>
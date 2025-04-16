
<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>

  
<?php require 'partials/head.php';?>

 
   <div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

   <br>
   <form style=" align-items: center;"  method="post" class="form-login" action="/register-account">

   
      
   <?php require 'partials/tracking.php';?>

      <div class="register-input">

        <div style="display: flex; column-gap:10px;">
          <div>
            <label for="new-username">First Name</label>
            <br>
            <input style="width: 300px;" type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">
        </div>

        <div>
            <label for="new-username">Last Name</label>
            <br>
            <input style="width: 300px;" type="text" name="new-username" id="new-username" value="<?php echo htmlspecialchars($_POST['new-username'] ?? '') ?>"  required placeholder="Enter your username">
        </div>
        </div>
        <br>
        <label>Gender</label>
        <div style="display: flex; column-gap:10px;">

          <input style="width: 50px;" type="radio" id="male" name="gender" value="Male">
          <label for="male">Male</label><br>

          <input style="width: 50px;" type="radio" id="female" name="gender" value="Female">
          <label for="female">Female</label><br>

        </div>
        <br>
        <div style="display: flex; gap:10px; flex-direction:column">
          <label for="dob">Date of Birth:</label>
          <input style="width:200px;" type="date" id="dob" name="dob">
        </div>
       

        <section style="display: flex; flex-direction:column; margin-top: 20px; ">
            <button class="register-btn" type="submit">Next Step</button>
            <br>
            <button style="margin-top: 0px; margin-bottom:35px;" class="resert-btn"  >Reset</button>
        </section>

      </div>
      


       <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
       
   </form>
 </div>
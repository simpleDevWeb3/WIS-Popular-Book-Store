
<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>


<?php require 'partials/head.php';?>
<?php require 'controller/register-general.php';?>


   <div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

   <br>
   <form style=" align-items: center;"  method="post" class="form-login" action=" " >

   
   <?php require 'partials/tracking.php';?>

      <div class="register-input">

        <div style="display: flex; column-gap:10px;">
          <div>
            <label  for="first-name">First Name</label>
            <br>
            <input style="width: 300px;  margin-top:10px;" type="text" name="first-name" id="first-name" value="<?php echo htmlspecialchars($_POST['first-name'] ?? '') ?>"  required placeholder="eg.John">
        </div>

        <div>
            <label  for="last-name">Last Name</label>
            <br>
            <input style="width: 300px;  margin-top:10px;" type="text" name="last-name" id="last-name" value="<?php echo htmlspecialchars($_POST['last-name'] ?? '') ?>"  required placeholder="eg.Doe">
        </div>
      
       

        </div>
       
        <div id="name-error" style="position: absolute; bottom: 418px;">
          <?php if (!empty($error)): ?>
              <p style="color:red; font-weight:bold;"><?php echo $error; ?></p>
          <?php endif; ?>
        </div>

        <br>
        <label>Gender</label>
        <div style="display: flex; column-gap:10px;">

        <input style="width: 50px;" type="radio" id="male" name="gender" value="Male"
           <?php echo (!isset($_POST['gender']) || $_POST['gender'] == 'Male') ? 'checked' : ''; ?>>
        <label for="male">Male</label><br>

        <input style="width: 50px;" type="radio" id="female" name="gender" value="Female"
            <?php echo (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'checked' : ''; ?>>
        <label for="female">Female</label><br>

        </div>
       

        <div id="age-error" style="position: absolute; bottom: 208px;">
          <?php if (!empty($errAge)): ?>
              <p style="color:red; font-weight:bold;"><?php echo $errAge; ?></p>
          <?php endif; ?>
        </div>

        <br>
        <div style="display: flex; gap:10px; flex-direction:column">
          <label for="dob">Date of Birth</label>
          <input style="width:200px;" type="date" id="dob" name="dob" value="<?php echo htmlspecialchars($_POST['dob'] ?? '') ?>" required>
        </div>
        <br>
       <div style="display: flex; gap:10px; flex-direction:column; margin-top:10px;">
       <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="e.g. 123-456-7890" required value="<?php echo htmlspecialchars($_POST['phone'] ?? '') ?>">
       </div>

       <div id="phone-error" style="position: absolute; bottom: 80px; ">
          <?php if (!empty($errPhone)): ?>
              <p style="color:red; font-weight:bold;"><?php echo $errPhone; ?></p>
          <?php endif; ?>
        </div>

        <section style="display: flex; flex-direction:column; margin-top: 50px; ">
            <button style="margin-top: 0px; margin-bottom:35px;" class="register-btn" type="submit">Next Step</button>
           
        </section>

      </div>
      


       <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
       
   </form>
 </div>

 <script>
 
  $('#first-name').click(() => {
    $('#name-error').html('');

  });

  $('#last-name').click(() => {
    $('#name-error').html('');
  });

  $('#dob').click(() => {
    $('#age-error').html('');
  });

  $('#phone').click(() => {
    $('#phone-error').html('');
  });

</script>

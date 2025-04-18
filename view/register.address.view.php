
<?php require "controller/register-address.php"?>

<style>
  body{
    background-color: #c9d6ff; /* Fallback color */
    background: linear-gradient(to right, #e2e2e2,rgb(232, 201, 255));
  }
</style>

<?php require 'partials/head.php';?>


<div style="display: flex; flex-direction:row;  margin-top:20px; justify-content:center;">

<br>
<form  style=" align-items: center;"   method="post" class="form-login" action=" ">

<?php require 'partials/tracking.php';?>

    <div class="register-input">

    <label for="street-address">Street Address</label>
    <input style="width: 430px;" type="text" name="street_address" id="street-address" 
       value="<?= htmlspecialchars($_POST['street_address'] ?? '') ?>" 
     placeholder="Enter your street address">

    <div id="street-error" style="position: absolute; bottom: 420px; ">
            <?php if (!empty($errors['street'])): ?>
                <span style="color:red; font-weight:bold;"><?php echo $errors['street']; ?></span>   
            <?php endif; ?>
      </div>
     
    
      <br>

      <div style="display: flex; column-gap:30px;">
        <div>
          <label for="states">State / Province</label>
          <br>
          <select style="width:200px; margin-top:10px;"  name="states" id="states">
            <option >select states</option>
            <?php foreach($states as $s): ?>
              <option value="<?= $s['state_id'] ?>" 
                  <?= (isset($_POST['states']) && $_POST['states'] == $s['state_id']) ? 'selected' : '' ?>>
                  <?= ($s['state_name']) ?>
             </option>
             <?php endforeach?>
            </select>  
        </div>
         
        <div>
          <label for="cities">City</label>
          <br>
          <select style="width:200px; margin-top:10px;"  name="cities" id="cities" >
            <option >select city</option>
          </select>
        </div>

        <div id="state-error" style="position: absolute; bottom: 310px; ">
        <?php if (!empty($errors['state']) && !empty($errors['city'])): ?>
            <span style="color:red; font-weight:bold;"><?php echo $errors['state']; ?></span>   
            <span style="color:red; font-weight:bold; position:absolute; right:-220px;"><?php echo $errors['city']; ?></span>

        <?php elseif (!empty($errors['city'])): ?>
            <span style="color:red; font-weight:bold; position:absolute; top:-10px; right:-420px;"><?php echo $errors['city']; ?></span>

        <?php elseif (!empty($errors['state'])): ?>
            <span style="color:red; font-weight:bold;"><?php echo $errors['state']; ?></span>

        <?php endif; ?>
       
      </div>
      


      </div>
     
     

      <br>

      <div> 
        <label for="postal-code">Postal Code</label>
        <br>
        <select style="width:200px; margin-top:10px;"  name="postal-code" id="postal-code" >
             <option>select postal</option>
        </select>
     </div>

     <div id="postal-error" style="position: absolute; bottom: 190px; ">
          <?php if (!empty($errors['postal'])): ?>
              <span style="color:red; font-weight:bold;"><?php echo $errors['postal']; ?></span>   
          <?php endif; ?>
     </div>

     <section style="display: flex; flex-direction:column; margin-top: 20px; ">
         <button class="register-btn"name="submit_registration" type="submit">Finish</button>
         <br>
       
     </section>
   </div>
    
    <p style="margin-left: 10px;  font-size:17px;"> Have  an account?<a href="/login" style="text-decoration: none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'"> Login</a></p>
    
</form>



<script>
  $('#street-address').click(()=>{
    $('#street-error').html('');
 
  })


  $('#postal-code').click(()=>{
    $('#postal-error').html('');
 
  })

  $('#states').click(()=>{
    $('#state-error').html('');
    
  })

  //States-Cities
  $('#states').on('change', function() {
  let state_id = this.value;

  console.log(state_id);

  $.ajax({
    url: '/city',
    type: 'POST',
    data: {
      state_id: state_id
    },
    success: function(result) {
      console.log(result);
      $('#cities').html(result);

    }
  });
});

$('#cities').on('change',function(){
  let city_id = this.value;
  console.log(city_id);
  $.ajax({
    url : '/postal',
    type: 'POST',
    data: {
      city_id : city_id
    },
    success: function(result){
      console.log(result);
      $('#postal-code').html(result);
      
    }
  })

})

</script>
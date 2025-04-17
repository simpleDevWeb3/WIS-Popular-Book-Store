
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
<form  style=" align-items: center;"   method="post" class="form-login" action="/login">

<?php require 'partials/tracking.php';?>

    <div class="register-input">

    
    <label for="new-password">Street Address</label>
     <input style="width: 430px;"  type="password" name="new-password" id="new-password" value="<?php echo htmlspecialchars($_POST['new-password'] ?? '') ?>"required placeholder="Enter your password">
      <br>
      <div style="display: flex; column-gap:30px;">
        <div>
          <label for="states">State / Province</label>
          <br>
          <select style="width:200px; margin-top:10px;"  name="states" id="states">
            <option >select states</option>
            <?php foreach($states as $s): ?>
              	 <option value="<?=$s['state_id']?>"><?=$s['name']?></option>
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
        
      


      </div>
     
     

      <br>

      <div> 
        <label for="postal-code">Postal Code</label>
        <br>
        <select style="width:200px; margin-top:10px;"  name="postal-code" id="postal-code" >
             <option >select-postal-code</option>
        </select>
     </div>
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
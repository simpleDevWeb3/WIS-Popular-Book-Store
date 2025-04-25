 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'controller/address.php';?>

<?php


    $db = new Database();

    $user_address =  $db->query(
      'SELECT * FROM addresses WHERE user_id = :user_id',
      ['user_id' => $_user['user_id']]
  )->fetch();



    $city = $db->query(
        'SELECT city_name FROM Cities WHERE city_id = :city_id',
        ['city_id' => $user_address['city_id']]
    )->fetch();

    $postal = $db->query(
        'SELECT postal_code FROM Cities WHERE city_id = :city_id',
        ['city_id' =>$user_address['city_id']]
    )->fetch();
    
    
   
  ?>
<div style=" display:flex; justify-content: left; padding-left: 100px;">
<?php require 'view/partials/sidebar.php' ?>
    <div class="user-profile">
    <div class="profile-main" style="margin-top: 105px; height:auto; display:flex; align-items:top; ">
            <h1 style=" margin-bottom:20px; margin-left:10px">My Address</h1>
            
                
        
                <form method="post" class="user-details">
                    <div class="detail-row">
                        <label>
                            <strong>Street Address</strong><br>
                            <input style="width: 600px;" type="text" name="street" value="<?=htmlspecialchars(    $user_address['street'])?>" required />
                        </label>
                    </div>
                    

                    <div class="detail-row">

                    <label style="margin: right 10px;">
                            <strong>State / Province</strong><br>

                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"   name="states" id="states" >
                                <option disabled selected>Select a state</option>
                                <?php foreach($states as $s): ?>
                                  <option value="<?= $s['state_id'] ?>"
                                    <?= ($_POST['states'] ?? $user_address['state_id']) == $s['state_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['state_name']) ?>
                                  </option>
                                <?php endforeach; ?>
                
                            </select>  
                            <span style="color:red"><?=$_err["stock"] ??""?></span>
                        </label>

                        <label>
                            <strong style="margin-left:10px;">City</strong><br>
                      
                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"  name="cities" id="cities"  >
                              
                                <option value =<?=$user_address['city_id']?> ><?=$city['city_name']?></option>
                            </select>

                        </label>

                      

                     
                    </div>

                    

                    <div class="detail-row">
                        <label>
                            <strong>Postal Code</strong><br>
                          
                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"  name="postal-code" id="postal-code" >
                                <option><?= $user_address['postal_code']?></option>
                            </select>
                        </label>
                    </div>

                    <button class="update-btn" type="submit" name="update_address">Update Address</button>
                    <button class="update-reset-btn" type="reset">Reset</button>
                </form>
            
        </div>
    </div>
</div>
<?php require "view/partials/footer.php" ?>  

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
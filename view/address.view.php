 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>
<?php require 'controller/address.php';?>

<?php


    $db = new Database();

    $state = $db->query(
        'SELECT state_name FROM States WHERE state_id = :state_id',
        ['state_id' => $_user['state_id']]
    )->fetch();


    $city = $db->query(
        'SELECT city_name FROM Cities WHERE city_id = :city_id',
        ['city_id' => $_user['city_id']]
    )->fetch();

    $postal = $db->query(
        'SELECT postal_code FROM Cities WHERE city_id = :city_id',
        ['city_id' => $_user['city_id']]
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
                            <input style="width: 600px;" type="text" name="street" value="<?=htmlspecialchars($_user['street'])?>" required />
                        </label>
                    </div>
                    

                    <div class="detail-row">

                    <label style="margin: right 10px;">
                            <strong>State / Province</strong><br>

                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"   name="states" id="states">
                                <option ><?=$state['state_name']?></option>
                                <?php foreach($states as $s): ?>
                                <option value="<?= $s['state_id'] ?>" 
                                    <?= (isset($_POST['states']) && $_POST['states'] == $s['state_id']) ? 'selected' : '' ?>>
                                    <?= ($s['state_name']) ?>
                                </option>
                                <?php endforeach?>
                            </select>  
                                
                        </label>

                        <label>
                            <strong style="margin-left:10px;">City</strong><br>
                      
                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"  name="cities" id="cities" >
                                <option ><?=$city['city_name']?></option>
                            </select>

                        </label>

                      

                     
                    </div>

                    

                    <div class="detail-row">
                        <label>
                            <strong>Postal Code</strong><br>
                          
                            <select style="width:200px; margin:10px; padding:10px 20px; font-size: 20px;"  name="postal-code" id="postal-code" >
                                <option><?=$postal['postal_code']?></option>
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
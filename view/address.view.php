 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<?php
    if (isset($_POST['reset-password'])) {
        header('Location: /password');
    }

    if (isset($_POST['user-details'])) {
        header('Location: /profile');
    }

    if (isset($_POST['manage-addrs'])) {
        header('Location: /address');
    }

    if (isset($_POST['logout'])) {
        logout($url = '/');
    }

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
                        <label>
                            <strong>City</strong><br>
                            <input style="width: 300px;" type="text" name="city" value="<?=$city['city_name']?>" required />
                        </label>
                        <label>
                            <strong>State / Province</strong><br>
                            <input style="width: 300px;" type="text" name="state" value="<?=$state['state_name']?>" required />
                        </label>
                    </div>

                    

                    <div class="detail-row">
                        <label>
                            <strong>Postal Code</strong><br>
                            <input style="width: 300px;" type="text" name="postal_code" value="<?=$postal['postal_code']?>" required />
                        </label>
                    </div>

                    <button class="update-btn" type="submit" name="update_address">Update Address</button>
                    <button class="update-reset-btn" type="reset">Reset</button>
                </form>
            
        </div>
    </div>
</div>
<?php require "view/partials/footer.php" ?>  
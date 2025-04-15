 
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<main>

<h1 style="margin-top: 50px; margin-bottom:20px; margin-left:10px">My Account</h1>
    <div style=" display:flex;">

          
            <div class="side-bar-setting">
               
                    <button class="user-details-btn">User Details</button>
                
                
              
                    <button class="user-reset-btn" >Reset Password</button>
               
                
         
                    <button class="user-manage-btn" >Manage Address</button>
          
                
               
                    <button class="user-logout-btn" >Log Out</button>
              
             </div>
    

      <div class="user-profile">
       

          <div>
            <img height="160px" width="160px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" />
          </div>

          <h2>User Details</h2>

           <form method="post" class="user-details">
              <div class="detail-row">
                  <label>
                      <strong>First Name</strong>
                      <br>
                      <input type="text" name="first_name" value="<?=htmlspecialchars($_user['first_name'])?>" required />
                  </label>
                  <label>
                      <strong>Last Name</strong>
                      <br>
                      <input  type="text" name="last_name" value="<?=htmlspecialchars($_user['last_name'])?>" required />
                  </label>
              </div>

              <div class="detail-row">
                  <label>
                    <strong>Username</strong>
                    <br>
                      <input style=" width: 600px;" type="text" name="username" value="<?=htmlspecialchars($_user['username'])?>" required />
                  </label>
              </div>

              <div class="detail-row">
                  <label>
                      <strong>Email</strong>
                      <br>
                      <input style=" width: 600px;" type="email" name="email" value="<?=htmlspecialchars($_user['email'])?>" required />
                  </label>
              </div>

              <div class="detail-row">
                  <label>
                    <strong>Phone</strong>
                     <br>
                      <input style=" width: 600px;" type="text" name="phone_number" value="<?=htmlspecialchars($_user['phone_number'] ?? '')?>" />
                  </label>
              </div>

              <button class="update-btn" type="submit">Update Details</button>
          </form>

      </div>

        
    

    </div>

    


  
</main>


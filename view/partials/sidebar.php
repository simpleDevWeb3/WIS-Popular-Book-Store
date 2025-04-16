<form method="post"  class="side-bar-setting" style="margin-top:95px;">
  <div>
    <div style="display: flex; gap:10px; align-items:center; border:none; box-shadow:0px 1px 10px rgba(0,0,0,0.3); border-radius:45px;">
      <img style="border-radius: 50%;"  height="90px" width="90px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" />
      <div>
        <p style="font-size: 18px; font-weight:600px;">Welcome,</p>
        <p style="font-size: 21px; font-weight:bold;"><?=$_user['username']?></p>
      </div>
    </div>
   
  </div>



               <button type="submit" name="user-details"  style="<?= urlIs('/profile') ? 'background-color: #e9ede8; 
                box-shadow: 0px  5px  10px rgba(0,0,0,0.1);' : '' ?>"   class="user-details-btn">User Details</button>
           
           
         
               <button  type="submit" name="reset-password"  style="<?= urlIs('/password') ? 'background-color:#e9ede8 ;
                box-shadow: 0px  5px  10px rgba(0,0,0,0.1);' : '' ?>"     class="user-reset-btn" >Reset Password</button>
          
           
    
               <button type="submit" name="manage-addrs"  style="<?= urlIs('/address') ? 'background-color:#e9ede8;
                box-shadow: 0px  5px  10px rgba(0,0,0,0.1);' : '' ?>"   class="user-manage-btn" >Manage Address</button>
     
           
              
               <button type="submit" name="logout"  class="user-logout-btn" >Log Out</button>      
 </form>
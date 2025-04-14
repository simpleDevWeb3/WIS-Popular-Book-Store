<header>

<?php
                  
   $_user = $_SESSION['user'] ?? null;
   if (!$_user){
    $margin = 320;
   }
  ?>
  <div class="popular-left-head">
      <a href="/">  
         <img class="popular-logo" src="/Img/Logo/Popular logo.png">
      </a>
      </div>
      
      <div class="popular-center-head" style="margin-right:<?php echo $margin ?? 0 ?>px; ">
          <input id="search-bar" class="search-bar" type="text" placeholder="Search Popular" > 
          <span id="search"><img class="search-icon"  width="20px" height="20px" src="/Img/Icon/search-icon.png"></span>
      </div>

     
      <div class="popular-right-head">
      <?php if ($_user): ?>
        <span class="order-text"><a href="/orderHistory">Order & Return</span>
      <?php endif; ?>
        <a href="/cart" style="opacity: 1;">
          <span class="cart">
              <div class="cart-container">  
             
                <?php
              
                  $db = new Database();
                   $user_id = $_user['user_id'] ?? null;
                  if($user_id){
                    $cQuantity = $db->query("SELECT SUM(cd.quantity) AS total_items FROM cartdetails cd JOIN cart c ON cd.cart_id = c.cart_id WHERE  c.user_id = ?",[$user_id])->fetch();

                    $cartCount =  $cQuantity['total_items']??0;
                  }else{
                    $Log_In = 'Log In';
                  }
             
                 
                ?>
                  <?php if ($_user): ?>
                      <?php if ($_user['user_id']): ?>
                          <div id="cart-count" class="cart-quantity"><?= $cartCount; ?></div>
                          <img src="/Img/Icon/Icon.svg">
                      <?php endif; ?>
                  <?php else: ?>
                   
                      <a id="cart-count" class="cart-quantity" style=" font-size:20px; left: -150px;"< href="/login">
                        <?= $Log_In;?>
                      </a>
                    
                  <?php endif; ?>


            </div>   
          </span>
        </a>
        <?php if ($_user): ?>
          <div style="display: flex;  justify-content:right; align-items:center ;" id="user-profile-js"> 
           <span class="user-profile" >
            <img height="60px" width="60px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" />
           
          </span> 
           
           <form method="post" class="dropdown" id ="dropdown-js">
            <div style="display: flex; align-items:center ; margin-bottom: 15px;">
            <img style="margin-left: 15px; margin-right: 15px; " height="60px" width="60px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" />

            <div>
              <span style="font-size: 18px;"><?=$_user['username']?></span>
              <span style="color:gray"><?=$_user['email']?></span>
            </div>
        
            </div>
            <a class="setting" href="/setting">Profile Settigns</a>
  
             <button type="submit" name="logout" class="logout">Log out</button>
             
           </form> 

           <script>
             $('#user-profile-js').click(()=>{
               $('#dropdown-js').toggleClass('show');
             })
           </script>

          <?php
              if (isset($_POST['logout'])) {
                logout($url = '/');
              }
          ?>
            
               
          </div>
        <?php endif; ?>
      </div>

      
</header>
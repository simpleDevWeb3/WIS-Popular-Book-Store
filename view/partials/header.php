<header>

<?php
                  
   $_user = $_SESSION['user'] ?? null;
  ?>
  <div class="popular-left-head">
      <a href="/">  
         <img class="popular-logo" src="/Img/Logo/Popular logo.png">
      </a>
      </div>

      <div class="popular-center-head">
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
                    $cartCount = 'Log In';
                  }
             
                 
                ?>
                  <?php if ($_user): ?>
                      <?php if ($_user['user_id']): ?>
                          <div id="cart-count" class="cart-quantity"><?= $cartCount; ?></div>
                          <img src="/Img/Icon/Icon.svg">
                      <?php endif; ?>
                  <?php else: ?>
                   
                      <a id="cart-count" class="cart-quantity" style="margin-right:20px; font-size:20px; width:1500px; margin-right:100px;"< href="/login"><?= $cartCount;?></a>
                    
                  <?php endif; ?>


            </div>   
          </span>
        </a>
        <?php if ($_user): ?>
           <span class="user-profile"><img height="60px" width="60px" src="/<?=$_user['profile_image'] ?? "img/user/default.jpg"?>" /></span>  
        <?php endif; ?>
      </div>

      
</header>
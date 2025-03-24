<header>
  <div class="popular-left-head">
      <a href="/">  
         <img class="popular-logo" src="Img/Logo/Popular logo.png">
      </a>
      </div>

      <div class="popular-center-head">
          <input id="search-bar" class="search-bar" type="text" placeholder="Search Popular" > 
          <span id="search"><img class="search-icon"  width="20px" height="20px" src="Img/Icon/search-icon.png"></span>
      </div>

      <div class="popular-right-head">
        <span class="order-text">Order & Return</span>
        <a href="/cart" style="opacity: 1;">
          <span class="cart">
              <div class="cart-container">  
                <?php
                
                  $cartCount = $_SESSION['cart_count']??0;
                ?>
                <div id="cart-count" class="cart-quantity"><?=$cartCount;?></div>
                <img src="Img/Icon/Icon.svg">
                </svg>
        
            </div>   
          </span>
        </a>
        <span class="user-profile"><img height="60px" width="60px" src="<?=$_SESSION['profile_image'] ?? "img/user/default.jpg"?>" /></span>  
      </div>
</header>
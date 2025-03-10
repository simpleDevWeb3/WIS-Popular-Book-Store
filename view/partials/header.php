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
        <span class="user-profile"><img height="60px" width="60px" src="https://avatar.iran.liara.run/public" /></span>  
      </div>
</header>
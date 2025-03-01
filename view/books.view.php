
<?=require 'partials/head.php';?>
<?=require 'partials/header.php';?>
<?=require 'partials/navbar.php';?>



  <main>
        <h2 style=
        "text-align: center;">
        Books
        </h2>  
      
        <hr>
      
      
      <section class="category">
        <a href="https:/example.com">
          <div> 
            <div class="circle">
              <img src="Img/Category/Novel.jpg">
            </div>
            <h3>Novel</h3>
          </div>
        </a>
          
        <a href="https:/example.com">
          <div> 
            <div class="circle">
            <img src="Img/Category/Revision.jpg">
            </div>
            <h3>Revision</h3>
          </div>
        </a>
        
        <a href="https:/example.com"">
          <div> 
            <div class="circle">
              <img src="Img/Category/Self_Help.jpg" alt="">
            </div>
            <h3>Self Help</h3>
          </div>
        </a>
          
      </section>
      
        <hr>
      
        <h2 style
        ="text-align: center;">
        Top Selling
        </h2>  
      
      
      <section class="product-grid">
        
        <div class="product-details">
          <a href="/product">
            <img  src="Img/Product/Example1.jpg">
      
            <a class="title">OSHI NO KO 我推的孩子S2 V1-13 E(DVD9)</a>
      
            <div class="rating">
              <span>5.0</span>
              <img src="Img/Ratings/rating-45.png">
            </div>
            <div class="price">RM40.00</div> 
          </a>
          
        </div>
      
      
      </section> 
     
  </main>

 <?= require 'partials/footer.php';?>
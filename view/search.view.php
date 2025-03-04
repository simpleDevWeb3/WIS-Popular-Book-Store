<?= require 'partials/head.php' ?>
<?= require 'partials/header.php' ?>
<?= require 'partials/navbar.php' ?>


<?php



$db = new Database();

// Get the search query from URL
if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $searchResult = $_GET['keyword'];

 
    $products = $db->query("SELECT * FROM products WHERE name LIKE ?", ["%$searchResult%"])->fetchAll();


} else {
    $products = [];
 
   
} 
?>


  <main> 

    <section class="search-page">

      <aside>
        <div class=search-filter>
          <h1>Search Filter</h1>
          <hr>
        
          <div class="price-filter">
            <label>Price</label> 
            <span>RM0 - RM100</span>
             <br>
             <input type="range">
             <br>
             <button class="apply-button">
              Apply
              </ button>
          </div>
          
      
         
       
        </div>

           <br>
        <div class="book-filter">
            <h4>Books</h4>
        
            <input type="checkbox" id="filter-Novel">
            <label for="filter-Novel">Novel</label>
              <br>
            <input type="checkbox" id="filter-Revision">
            <label for="filter-Revision">Revison</label>
              <br>
            <input type="checkbox" id="filter-Self-Help">
            <label for="filter-Self-Help">Self Help</label>
        </div>
           <br>
        <div class="stationary-filter">
          <h4 >Stationary</h4>
       
          <input type="checkbox" id="filter-paper-product">
          <label for="filter-paper-product">Paper Product</label>
          <br>
          <input type="checkbox" id="filter-office-suplies">
          <label for="filter-office-suplies">Office Suplies</label>
          <br>
          <input type="checkbox" id="filter-writting-instrument">
          <label for="filter-writting-instrument">Writting Instrument</label>
        </div>
          <br>
        <div class="rating-filter">
          <h4>Ratings</h4>
          
          <div class="filter-rating-grid">
            <div> 
              <img src="Img/Ratings/rating-50.png">
            </div>
            <div>
              <img src="Img/Ratings/rating-40.png">
             
            </div>
            <div>
              <img src="Img/Ratings/rating-30.png">
              
            </div>
            <div>
              <img src="Img/Ratings/rating-20.png">
             
            </div>
            <div>
              <img src="Img/Ratings/rating-10.png">
            
            </div>
           
            

          </div>
        </div>
       
      </aside>

      <div class="search-page-grid">
        <h1 style="margin-left: 30px; margin-top: 20px;">Search Result(<?=count($products)?>) ><?=$searchResult?></h1>

        <?php foreach($products as $product): ?>
          <a class="product-details-row" style="opacity:1;" href="/product?id=<?=$product['id']?>" style="text-decoration: none; color: inherit;">
            <img src="<?=$product['image']?>" alt="<?=$product['name']?>">
            <div class="product-details-container">
              <span class="title" style="font-size: 18px;"><?=$product['name']?></span>
              <div class="rating">
                <span><?= number_format($product['rating'], 1) ?></span>
                <?php $ratingImg = $product['rating'] * 10; ?>
                <img src="Img/Ratings/rating-<?=$ratingImg?>.png" alt="Rating">
              </div>
              <div class="price">RM<?=$product['price']?></div>
            </div>  
          </a>
       <?php endforeach; ?>


     


   
    </section>

  </main>

  <br><br>


  <?= require 'partials/footer.php' ?>

  
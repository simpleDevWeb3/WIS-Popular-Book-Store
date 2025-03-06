<?php require 'partials/head.php' ?>
<?php require 'partials/header.php' ?>
<?php require 'partials/navbar.php' ?>





  <main> 


      <div class="search-page-grid">
        <h1 style="margin-left: 30px; margin-top: 20px;">Search Result(<?=count($products)?>) "<?=$searchResult?>"</h1>
         <br><br>
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


  <?php require 'partials/footer.php' ?>

  
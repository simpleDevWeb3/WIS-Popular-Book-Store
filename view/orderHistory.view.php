<?php require __DIR__ . '/partials/head.php';?>
<?php require 'partials/header.php';?>
<?php  require 'partials/navbar.php'; ?>
<?php $current_order_id = null; ?>


 <?php auth('Member'); ?>


  <main>
  <div class="order-history" >

      <div style="display: flex; ">
      <h1>Your Orders</h1>
        <form method="get" class="search-bar" style="justify-content: right;    margin-right: 0px;">
          <?php html_search('name',  "placeholder='Search product name or item number...'"); ?>                     
        </form>
          <button id="openFilterBtn" class="filter-btn" style="margin-right: 25px; border:none; background-color:#f5f5f5; border-radius:8px; padding:10px 20px; box-shadow:0px 1px 10px rgba(0,0,0,0.2);">
              <i class="ri-filter-line"></i>  
              Filter
        </button>
      </div>
    
    
      
          
      <div id="filterModal" class="modal">
        <div class="modal-content">
          <a href="#" class="modal-close" id="closeFilterBtn">&times;</a>
          <h2>Filter Options</h2>
          <form id="filterForm">
            <div class="filter-options">
              <label><input type="radio" name="timeRange" value="7" /> Last 1 week</label>
              <label><input type="radio" name="timeRange" value="30" /> Last 1 month</label>
              <label><input type="radio" name="timeRange" value="90" /> Last 3 months</label>
              <label><input type="radio" name="timeRange" value="180" /> Last 6 months</label>
              <label><input type="radio" name="timeRange" value="365" /> Last 1 year</label>
              <label><input type="radio" name="timeRange" value="all" checked /> All</label>
            </div>
            <button type="submit">Apply Filters</button>
          </form>
        </div>
      </div>
          
      <?php if (!empty($orders)): ?>
      <?php foreach ($orders as $o):  ?> 
        <?php if ($current_order_id !== $o['order_id']): ?>
            <?php if ($current_order_id !== null): ?>
              </section>
              <?php endif ?>
              <section class="order" data-order-date="<?= $o['order_date'] ?>">
              <div class="order-header"> 
                  <span>Order No: <?= $o['order_id'] ?></span>
                  <span>Order Date: <?= $o['order_date'] ?></span>
                  <span>Shipping Date: <?= $o['shipping_date'] ?></span>
                  <span class="status <?= strtolower($o['status']); ?>"><?= ucfirst(strtolower($o['status'])) ?></span>
              </div>

              <div class="payment-method">
                <strong>Payment Method: </strong><?= $o['Payment_method'] ?>
              </div>

              <?php $current_order_id = $o['order_id']; ?>
              <?php endif ?> 
            

              <div class="order-details">
                  <a href="/product?product_id=<?= $o['product_id'] ?>&category_id=<?= getProductCategoryId($db, $o['product_id']) ?>"  style="all: unset; display: inline-block;">
                  <img src="/<?=$o['image']?>" alt="Book Cover">
                  </a>
                  <div class="info">
                      <h2><?= $o['name'] ?></h2>
                      <p><br>Price: RM <?= sprintf("%.2f", $o['price']) ?></p>
                      <p>QTY: <?= $o['quantity'] ?></p>
                      <div style="text-align: right;  margin-bottom:20px;"  >
                        <a style="opacity: 1; padding:10px 20px;" href="/product?product_id=<?= $o['product_id'] ?>&category_id=<?= getProductCategoryId($db, $o['product_id']) ?>" class="order-again">Comment</a>
                      </div>
                  </div>
              </div>

          
          <?php endforeach ?>
        </section>
          <?php else: ?>
            <p>No orders found.</p>
          <?php endif ?>


     </div >

    </main>
    <?php require 'partials/footer.php';?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
      const openBtn = document.getElementById('openFilterBtn');
      const closeBtn = document.getElementById('closeFilterBtn');
      const modal   = document.getElementById('filterModal');
      const form    = document.getElementById('filterForm');
      const orders  = document.querySelectorAll('section.order');

      // open filter
      openBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = 'flex';
      });

      // close filter
      closeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = 'none';
      });

      //close
      modal.addEventListener('click', function(e) {
        if (e.target === modal) {
          modal.style.display = 'none';
        }
      });

      // submit filter form
      form.addEventListener('submit', function(e) {
        e.preventDefault();
        const selected = form.elements['timeRange'].value;
        const now = new Date();

        orders.forEach(section => {
          const dateStr = section.getAttribute('data-order-date'); 
          if (!dateStr) {
            section.style.display = '';
            return;
          }
          const orderDate = new Date(dateStr);
          const diffDays = (now - orderDate) / (1000 * 60 * 60 * 24);

          // if All
          if (selected === 'all' || diffDays <= parseInt(selected, 10)) {
            section.style.display = '';
          } else {
            section.style.display = 'none';
          }
        });

        // close
        modal.style.display = 'none';
      });
    });
    </script>
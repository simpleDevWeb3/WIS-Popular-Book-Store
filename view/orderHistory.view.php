<?php require __DIR__ . '/partials/head.php';?>

<?php $current_order_id = null; ?>


<body class="order-history">
<header>
        <button class="back-btn" onclick="goBack()">&#x2190;</button>
        <h1>Order history</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search product name or item number...">
            <a class="filter-btn" href="#filterModal">&#x1F50D; Filter</a>
        </div>
</header>

    <script>
        function goBack() {
        window.history.back(); // go back last page
        }
    </script>

    <div id="filterModal" class="modal">
    <div class="modal-content">
      <!-- Close modal link -->
      <a href="#" class="modal-close">&times;</a>
      <h2>Filter Options</h2>
      <form>
        <div class="filter-options">
          <label>
            <input type="checkbox" name="Option 1" /> Last 1 week
          </label>
          <label>
            <input type="checkbox" name="Option 2" /> Last 1 month
          </label>
          <label>
            <input type="checkbox" name="Option 3" /> Last 3 month
          </label>
          <label>
            <input type="checkbox" name="Option 4" /> Last 6 month
          </label>
          <label>
            <input type="checkbox" name="Option 5" /> Last 1 year
          </label>
        </div>
        <button type="submit">Apply Filters</button>
      </form>
    </div>
  </div>
  

    <main>
    
    <?php if (!empty($orders)): ?>
    <?php foreach ($orders as $o):  ?> 
      <?php if ($current_order_id !== $o['order_id']): ?>
          <?php if ($current_order_id !== null): ?>
            </section>
            <?php endif ?>
        <section class="order">
            <div class="order-header">
                <span>Order No: <?= $o['order_id'] ?></span>
                <span>Date: <?= $o['order_date'] ?></span>
                <span class="status completed"><?= ucfirst(strtolower($o['status'])) ?></span>
            </div>
            <?php $current_order_id = $o['order_id']; ?>
            <?php endif ?> 
          

            <div class="order-details">
                <img src="/<?=$o['image']?>" alt="Book Cover">
                <div class="info">
                    <h2><?= $o['name'] ?></h2>
                    <p>Price: RM <?= number_format($o['price'], 2) ?></p>
                    <p>QTY: <?= $o['quantity'] ?></p>
                    <div style="text-align: right;">
                      <button class="order-again">Order again</button>
                    </div>
                </div>
            </div>

        
        <?php endforeach ?>
      </section>
        <?php else: ?>
          <p>No orders found.</p>
        <?php endif ?>
    </main>

    <?php require 'partials/footer.php';?>
<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>

<main>
  <div class="cart" style="margin-top: 30px;">
      <div class="cart-container">
  
            <h2>Your Cart (<?= count($carts) ?> item(s))
             <button class="delete-btn" title="Delete all items">
              <img src="/Img/Icon/garbageCan.jpg" alt="Book Cover"  width="40" height="40">
            </button>
           </h2>
  

          <?php if (!empty($carts)): ?>
          <table class="cart-table">
              <tr>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
              </tr>
              <?php foreach ($carts as $c):  ?>
              <tr>
                  <td> <img src="<?=$c['image']?>" alt="Book Cover"  width="70" height="100"> <?= $c['name'] ?></td>
                  <td><?= $c['price'] ?></td>
                  <td class="quantity-selector">
                      <button>-</button>
                      <input type="text" value=<?= $c['quantity'] ?>>
                      <button>+</button>
                  </td>
                  <td>RM <?= number_format($c['price'] * $c['quantity'], 2) ?></td>
                  
              </tr>
              <?php endforeach ?>

              <?php else: ?>
              <p>No items found in your cart.</p>
          <?php endif ?>  
          </table>

          <div class="checkout-summary">
              <p>Subtotal: RM <?= number_format($subtotal,2) ?></p>
              <p>Tax: RM <?= number_format($tax, 2) ?></p>
              <p>Grand Total: <strong>RM <?= number_format($grand_total, 2) ?></strong></p>
              <a href="/page/checkOut.php" class="checkout-btn">Check out</a>
          </div>
      </div>
</main>

   <?php require 'partials/footer.php';?>
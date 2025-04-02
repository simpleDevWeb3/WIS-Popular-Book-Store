<?php require __DIR__ . '/partials/head.php';?>
<?php require __DIR__ . '/partials/header.php';?>

<main>
  <div class="cart"  style="margin-top: 30px;">
      <div class="cart-container">
        <div class="header">
            <h2>Your Cart (<?= count($carts) ?> item(s))
                <form method="post" action="/controller/cart/delete_cart.php" style="display:inline;">
                    <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
                    <button type="submit" class="delete-btn" title="Delete all items">
                        <img src="/Img/Icon/garbageCan.jpg" alt="Delete All" width="40" height="40">
                    </button>
                </form> 
           </h2>
</div>

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
                  <td> <img src="/<?=$c['image']?>" alt="Book Cover"  width="70" height="100"> <?= $c['name'] ?></td>
                  <td><?= $c['price'] ?></td>
                  <td class="quantity-selector">

                  <form method="post" action="/controller/cart/update_cart.php" onsubmit="return confirmDecrease(<?= $c['quantity'] ?>)">
                    <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $c['product_id'] ?>">

                    <button  type="submit" name="action" value="decrease">-</button>
                      <input type="text" value="<?= $c['quantity'] ?>">
                    <button type="submit" name="action" value="increase">+</button>
                  </form>
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
              <a href="/controller/cart/checkOut.php" class="checkout-btn">Check out</a>
          </div>
      </div>
</main>

   <?php require 'partials/footer.php';?>
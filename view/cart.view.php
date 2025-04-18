<?php require __DIR__ . '/partials/head.php';?>
<?php require __DIR__ .'/partials/header.php';?>

<?php (auth('Member'));?>

<main>
  <div class="cart"  style="margin-top: 30px;">
      <div class="cart-container">
      <div class="search-bar">
            <input type="text" placeholder="Search product in cart">
        </div>
        <div class="header">
            <h2>Your Cart (<?= count($carts) ?> item(s))
                <form method="post" action="/controller/cart/delete_cart.php" style="display:inline;"  onsubmit="return confirmDelete();">
                    <input type="hidden" name="user_id" value="<?= $_user['user_id'] ?? '' ?>">
                    <button type="submit" class="delete-btn" title="Delete all items">
                        <img src="/Img/Icon/garbageCan.jpg" alt="Delete All" width="40" height="40">
                    </button>
                </form>
                
                <script>
                    function confirmDelete() {
                    return confirm("Are you sure you want to delete all items in your cart?");
                    }
                </script>

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
                  <td> <img src="/<?=$c['image']?>" alt="Book Cover"  width="110" height="100"> <?= $c['name'] ?></td>
                  <td><?= $c['price'] ?></td>
                  <td class="quantity-selector">

                  <form method="post" action="/controller/cart/update_cart.php" >
                    <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $c['product_id'] ?>">

                    <button  type="submit" name="action" value="decrease" onclick="return confirmDecrease(this.form)">-</button>
                      <input type="text" class="quantityInput" name="quantity" value="<?= $c['quantity'] ?>" placeholder="QTY" onkeypress="submitOnEnter(event, this.form)" oninput="return confirmDecrease1(this.form)">
                    <button type="submit" name="action" value="increase">+</button>
                  </form>
                  </td>

                  <script>
                    //press enter submit quantity
                    function submitOnEnter(event, form) {
                    if (event.key === "Enter") {
                        event.preventDefault();
                        form.submit();
                    }
                        }
                </script>

                  <script>
                    // + - button
                    function confirmDecrease(form) {
                     // get quantity in <input>
                    var quantityInput = form.querySelector('input[name="quantity"]');
                    var quantity = parseInt(quantityInput.value, 10);
                    
                    //when quantity = 1
                    if (quantity == 1) {
                        if (confirm("The quantity is 0 or 1. Decreasing will remove this product from your cart. Are you sure you want to delete it?")) {
                            form.submit();
                            return true;    // confirm delete
                        } else {
                            return false;  // cancel delete
                        }
                    }
                        return true;
                    }
                    
                    // input
                    function confirmDecrease1(form) {
                     // get quantity in <input>
                    var quantityInput = form.querySelector('input[name="quantity"]');
                    var quantity = parseInt(quantityInput.value, 10);
                    
                    // when qty less than 1
                    if (quantity < 1) {
                        if (confirm("The quantity is 0 or 1. Decreasing will remove this product from your cart. Are you sure you want to delete it?")) {
                            form.submit();
                            return true;    // confirm delete
                        } else {
                            return false;  // cancel delete
                        }
                    }
                        return true;
                    }
                    </script>


                  <script>
                   document.querySelectorAll('.quantityInput').forEach(function(input) {
                    input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    });
                    });
                </script>

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
              <a href="/checkOut" class="checkout-btn">Check out</a>
          </div>
      </div>
</main>

   <?php require 'partials/footer.php';?>
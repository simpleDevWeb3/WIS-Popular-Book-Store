<?php require __DIR__ . '/partials/head.php';?>
<?php require __DIR__ .'/partials/header.php';?>
<?php  require 'partials/navbar.php'; ?>

<?php (auth('Member'));?>

<main>
<div class="cart"  style="margin-left:40px; margin-top: 30px; display:flex; gap:20px">
      
<div style="width: 800px">
 <?php if (!empty($carts)): ?>
   
          <table class="cart-table">
 
              <tr>

              
                  <th style="padding-left:35px">Item</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th style="display:flex; justify-content:center; align-items:center;">
                         Total
                    <form method="post" action="/controller/cart/delete_cart.php" style="display:inline;"  onsubmit="return confirmDelete();">
                            <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?? '' ?>">
                            <button type="submit" class="delete-btn" title="Delete all items">
                            <i style="margin-left: 10px;" class="ri-delete-bin-6-line"></i>
                            </button>
                     </form>
                  
   
                 </th>
              </tr>
              <?php foreach ($carts as $c):  ?>
              <tr>
              <td style="display: flex;text-align: center;align-items: center;">
                 <a href="/product?product_id=<?= urlencode($c['product_id']) ?>&category_id=<?= urlencode($c['category_id']) ?>"  style="all: unset; display: inline-block;">
                        <img src="/<?= $c['image'] ?>" alt="<?= $c['name'] ?>" width="110" height="100">
                 </a>
                  <?= $c['name'] ?>
                </td>
                  
                <td><?= $c['price'] ?></td>

               <td class="quantity-selector">

                  <form method="post" action="/controller/cart/update_cart.php">
                    <input type="hidden" name="cart_id" value="<?= $c['cart_id'] ?>">
                    <input type="hidden" name="product_id" value="<?= $c['product_id'] ?>">
                    <input type="hidden" name="stock" value="<?= $c['stock'] ?>">

                    <button  type="submit" name="action" value="decrease" onclick="return confirmDecrease(this.form)">-</button>
                      <input type="text" class="quantityInput" name="quantity" value="<?= $c['quantity'] ?>" placeholder="QTY"  data-original="<?= $c['quantity'] ?>" oninput="return confirmDecrease1(this.form)">
                    <button type="submit" name="action" value="increase" onclick="return InvalidIncrease(this.form)">+</button>
                  </form>
                  </td>

                 
                  <script>

                    // + button
                    function InvalidIncrease(form) {
                     // get quantity in <input>
                    var quantityInput = form.querySelector('input[name="quantity"]');
                    var quantity = parseInt(quantityInput.value, 10);
                    const stock = parseInt(form.querySelector('input[name="stock"]').value, 10);
                    
                    const originalQuantity = quantityInput.getAttribute('data-original');

                    //prevent quantity exceeds stock
                    if (quantity === stock) {
                        alert("The quantity exceeds the available stock.");
                        quantityInput.value = originalQuantity;
                    return false;
                    }
                        return true;
                    }



                    //- button
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
                    const stock = parseInt(form.querySelector('input[name="stock"]').value, 10);
                    
                    const originalQuantity = quantityInput.getAttribute('data-original');

                    // when qty less than 1
                    if (quantity < 1) {
                        if (confirm("The quantity is 0 or 1. Decreasing will remove this product from your cart. Are you sure you want to delete it?")) {
                            form.submit();
                            return true;    // confirm delete
                        } else {
                            return false;  // cancel delete
                        }

                        
                    }else if (quantity > stock) {
                        alert("The quantity exceeds the available stock.");
                        quantityInput.value = originalQuantity;
                    return false;
                    }
                    
                    
                        return true;
                    }
                    </script>


                  <script>
                   document.querySelectorAll('.quantityInput').forEach(function(input) {
                    input.addEventListener('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    });

                    input.addEventListener('keydown', function(event) {
                        if (event.key === "Enter") {
                            event.preventDefault();
                            this.form.submit();
                        }
                    });
                    });

                </script>

                  <td>RM <?= sprintf("%.2f", $c['price'] * $c['quantity']) ?></td>
                  
              </tr>
              <?php endforeach ?>

              <?php else: ?>
              <p style="margin-top: 40px;">No items found in your cart.</p>
          <?php endif ?>  
          </table>
   

     </div>

          <div class="cart-container" style="display: flex; ">
                <div class="header" style="display:flex;  padding-top:20px;     height: 300px;  ">
                    <div style="display: flex; flex-direction:column; align-items: center;">
                    
                        <form method="get" class="search-bar">
                            <?php html_search('name', "placeholder='Search product in cart'"); ?>
                        
                        </form>


                        

                        <div class="checkout-summary">
                    <p>Subtotal: RM <?= sprintf("%.2f", $subtotal) ?></p>
                    <p>Tax: RM <?= sprintf("%.2f", $tax) ?></p>
                    <p>Grand Total: <strong>RM <?= sprintf("%.2f", $grand_total) ?></strong></p>
                    <?php if (!empty($carts)): ?>
                        <a href="/checkOut" class="checkout-btn">Check out</a>
                    <?php else: ?>
                        <button class="checkout-btn" onclick="alert('Your cart is empty. Please add items to your cart before checking out.')">Check out</button>
                    <?php endif; ?>
                </div>
            </div>
               
                
                <script>
                    function confirmDelete() {
                    return confirm("Are you sure you want to delete all items in your cart?");
                    }
                </script>

           </h2>
 </div>

         
      </div>


      
</main>

   <?php require 'partials/footer.php';?>
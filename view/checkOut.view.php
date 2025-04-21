<?php require 'partials/head.php';?>
<?php require 'partials/header.php';?>


<?php auth('Member'); ?>

    <script>
        function goBack() {
        window.history.back(); // go back last page
        }
    </script>
    
    <main style="background-color: white; display:flex; padding-top:100px;" >

    <div class="checkout">
        <div class="totalItem">
            <h2> Total Items: <?= count($carts) ?></h2>
            <div class="delivery-date"><strong>Delivery Date</strong>: <?= $delivery_date ?></div>
        </div>

        <div style="display: flex;">

            <div>
                

                 <div style="width: 800px; margin-left:50px;">
                    <?php foreach ($carts as $c):  ?>
                        <section class="cart1">
                    
                            <div class="cart-item">
                            <img src="/<?=$c['image']?>" alt="Book Cover">
                                <div class="item-details">
                                    <h3><?= $c['name'] ?></h3>
                                    <p>RM <?= $c['price'] ?></p>
                                    <p>QTY: <?= $c['quantity'] ?></p>
                                </div>
                            </div>
                        </section>
                    <?php endforeach ?>

                 </div>
             
                </div>
          
            
            <div style="display: flex; height:230px; padding-top:10px; width:300px; flex-direction:column; gap:10px;" class="summary">
                    <h2>Order Summary<br></h2>
                    <p>Subtotal: RM <?= sprintf("%.2f", $subtotal) ?></p>
                    <p>Tax: RM <?= sprintf("%.2f", $tax) ?></p>
                    <h3>Total: <span class="total">RM <?= sprintf("%.2f", $total) ?></span></h3>
                    <button class="place-order">Place Order</button>
            </div>
        </div>


       

        <div id="paymentModal" class="modal hidden">
        <div class="modal-content">
            <h2>Select Payment Method</h2>
            <button class="payment-option" data-method="Credit Card">💳 Credit Card</button>
            <button class="payment-option" data-method="E-Wallet">📱 E-Wallet</button>
            <button class="payment-option" data-method="Bank Transfer">🏦 Bank Transfer</button>
            <button class="modal-close">&times; Cancel</button>
        </div>
        </div>

            <form id="orderProcessForm" action="/controller/orderProcess.php" method="post" class="hidden">
                <input type="hidden" name="payment_status" value="Completed">
                <input type="hidden" name="total_price" value="<?= $total ?>">
                <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
                <input type="hidden" name="payment_method" id="payment_method" value="">
            </form>

        
        <div class="order-success hidden" >Payment Successfully!</div>
    </main>
    
        <script>
        document.querySelector('.place-order').addEventListener('click', function() {
            document.querySelector('#paymentModal').classList.remove('hidden');
        });

        document.querySelectorAll('.payment-option').forEach(button => {
            button.addEventListener('click', function() {
                let method = this.dataset.method;
                alert("You have selected: " + method);

                document.querySelector('#payment_method').value = method;
                
                // close modal
                document.querySelector('#paymentModal').classList.add('hidden');

                // Submit the form after selecting payment method
                document.querySelector('#orderProcessForm').submit();
            });
        });

    document.querySelector('.modal-close').addEventListener('click', function() {
        document.querySelector('#paymentModal').classList.add('hidden');
    });

                <?php if (isset($_SESSION['order_success']) && $_SESSION['order_success']):?>
                // display success message
                document.querySelector('.order-success').classList.remove('hidden');
                
                setTimeout(() => {
                    document.querySelector('.order-success').classList.add('hidden');
                    window.location.href = "/"; // back to main page
                }, 2500);
                <?php unset($_SESSION['order_success']); ?> <!-- Clear the success flag -->
                <?php endif; ?>
            
    </script>

<?php require 'partials/footer.php';?>
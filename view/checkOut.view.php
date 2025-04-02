<?php require __DIR__ . '/partials/head.php';?>

<body class="checkout">
<header class="checkout-header">
        <button class="back-btn">&#x2190;</button>
        <h1>Check Out</h1>
    </header>
    
    <main>
        <div class="totalItem">
            <h3> Total Items: <?= count($carts) ?></h3>
        </div>
        <?php foreach ($carts as $c):  ?>
        <section class="cart">
            
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
              
    </main>

    <div class="summary">
            <h2>Order Summary</h2>
            <p>Subtotal: RM <?= number_format($subtotal,2) ?></p>
            <p>Tax: RM <?= number_format($tax, 2) ?></p>
            <h3>Total: <span class="total">RM <?= number_format($total, 2) ?></span></h3>
            <button class="place-order">Place Order</button>
    </div>
    
    <div class="order-success hidden">Order successfully placed!</div>
    
    <script>
        document.querySelector('.place-order').addEventListener('click', function() {
            document.querySelector('.order-success').classList.remove('hidden');
            setTimeout(() => {
                document.querySelector('.order-success').classList.add('hidden');
            }, 2000);
        });
    </script>

<?php require 'partials/footer.php';?>
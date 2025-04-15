<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_title ?></title>
    <link rel= "stylesheet" href="/CSS/_head.css">
    <link rel= "stylesheet" href="/CSS/form.css">
    <link rel= "stylesheet" href="/CSS/product.css">
    <link rel= "stylesheet" href="/CSS/product-details.css">
    <link rel= "stylesheet" href="/CSS/sales-details.css">
    <link rel= "stylesheet" href="/CSS/report.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="/JS/_home.js"></script>

</head>

<!---filename: crud_navbar.php--->
<body>
    <!-- Flash message -->
    <div id="info"><?= temp('info') ?></div>

    <header>
        <h1><?= $_title ?? "LOGO and NAME"?></h1>
    </header>
    <div class="toolsbar">

    <a href="/" class="home-toolsbar-button">
        <button class="toolsbar-button">
            <img class="home-icon-image" src="/IMG/icons/home.png">
            <p>Home</p>
        </button>    
    </a>

    <a href="/PAGES/product/product.php" class="home-toolsbar-button">
        <button class="toolsbar-button">
            <img class="home-icon-image" src="/IMG/icons/boxes.png">
            <p>Product</p>
        </button>
    </a>

    <a href="/PAGES/member.php" class="home-toolsbar-button">
        <button class="toolsbar-button">
            <img class="home-icon-image" src="/IMG/icons/user.png">
            <p>Member</p>
        </button>
    </a>

    <a href="/PAGES/sales.php" class="home-toolsbar-button">
        <button class="toolsbar-button">
            <img class="home-icon-image" src="/IMG/icons/book-alt.png">
            <p>Sales</p>
        </button>
    </a>



    <a class="home-toolsbar-button">
        <button class="toolsbar-button">
            <img class="home-icon-image" src="/IMG/icons/user.png">
            <p>profile</p>
        </button>
    </a>
    </div>


   
    <!--------------------------------------------------------->

<main>

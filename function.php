<?php
  

  session_start();

   processCartRequest();
   post_Price_range();


   // code to ensure when page refresh cart quantity will not become 0
   function processCartRequest(){

      if(!isset($_SESSION['cart_count'])){
          $_SESSION['cart_count']=0; //
          
      
      }

      if(isset($_POST['add_quantity'])){
        $quantity = intval($_POST['add_quantity']);
        $_SESSION['cart_count']+= $quantity;
       
        return $_SESSION['cart_count'];
      

      
      
      }


   }

   function addToCart($db) {
    $_user = $_SESSION['user'];
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['add_quantity']) || !isset($_POST['product_id'])) {

        echo json_encode(["status" => "error", "message" => "Invalid request"]);
        exit;
    }

    $quantity = intval($_POST['add_quantity']);
    $product_id = $_POST['product_id'];

   
    $product = $db->query("SELECT price FROM products WHERE product_id = :product_id", [
        'product_id' => $product_id
    ])->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo json_encode(["status" => "error", "message" => "Product not found"]);
        exit;
    }

    $price = $product['price'];

    if (!isset($_user)) {
        echo json_encode(["status" => "error", "message" => "User not logged in"]);
        exit;
    }

    $user_id = $_user['user_id'];

   
    $cart = $db->query("SELECT cart_id FROM cart WHERE user_id = :user_id", ['user_id' => $user_id])->fetch();

    if (!$cart) {
        echo json_encode(["status" => "error", "message" => "Cart not found"]);
        exit;
    }

    $cart_id = $cart['cart_id'];

    $existing = $db->query("SELECT quantity FROM cartDetails WHERE cart_id = :cart_id AND product_id = :product_id", [
        'cart_id' => $cart_id,
        'product_id' => $product_id
    ])->fetch();

    if ($existing) {
   
        $new_quantity = $existing['quantity'] + $quantity;
        $db->query("UPDATE cartDetails SET quantity = :quantity, price = :price WHERE cart_id = :cart_id AND product_id = :product_id", [
            'quantity' => $new_quantity,
            'price' => $price, // 
            'cart_id' => $cart_id,
            'product_id' => $product_id
        ]);
    } else {
      
        $db->query("INSERT INTO cartDetails (cart_id, product_id, quantity, price) VALUES (:cart_id, :product_id, :quantity, :price)", [
            'cart_id' => $cart_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price 
        ]);
    }

    echo json_encode(["status" => "success", "message" => "Item added to cart"]);
    exit;
}

  







   function post_Price_range() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["price"])) {
        $price = intval($_POST["price"]); 
        $_SESSION["filtered_price"] = $price; // Store in session
       
      
        exit;
    }
}

    //code for debugging eg.checking uri
    function dd($value){

      echo "<pre>";  
        var_dump($value) ;
      echo "</pre>";
    
      die();
    }

    //$value =REQUESTED_URI
    //return boolean after compaer $value with request_uri

    //used in navbar.php
    function urlIs($value){
      return $_SERVER['REQUEST_URI'] === $value;
    }


 
    function getParentCategory($db, $category_id) {
      // Get parent_id of the given category_id
      $category = $db->query("SELECT parent_id FROM categories WHERE category_id = :category_id", [
          'category_id' => $category_id
      ])->fetch();

      // If no parent_id (NULL), this is the top category, return it
      if (!$category || !$category['parent_id']) {
          return $category_id; // This is the main category
      }

      // Recursively find the top-level parent category  lv1 -> lv2 ->
      return getParentCategory($db, $category['parent_id']);
    }

    function getSubCategory($db, $category_id){
      $category = $db->query("SELECT parent_id FROM categories WHERE category_id = :category_id",
                            [ 'category_id' => $category_id])->fetch();

      // If no parent_id (Main-category)return it
      if ($category['parent_id'] === 'STAT-MAIN-002'||$category['parent_id'] === 'BOOK-MAIN-001') { return $category_id;}

      // Recursively find the top-level parent category
      return getSubCategory($db, $category['parent_id']);
    }


    //get All subCategory
    function getAllSubCategory($db,$parent_id){                                 
          $categories = $db->query("SELECT * FROM categories WHERE parent_id = :parent_id",[
            'parent_id'=>$parent_id  //BOOK-MANGA-002
          ])->fetchAll();

          forEach($categories as $category_id){
            $allCategories[] = $category_id;
          }    
          
          return $allCategories;


    }




    
// Function to search products by keyword and category
  function searchProducts($db, $keyword, $max_price,$orderBy = "name ASC",$page) {
    // get page url 
  
    

    $searchTerm = "%$keyword%";
    $query = "SELECT p.*, pd.stock
              FROM products p
              JOIN categories c ON p.category_id = c.category_id
              LEFT JOIN categories c_parent ON c.parent_id = c_parent.category_id
              LEFT JOIN categories c_grandparent ON c_parent.parent_id = c_grandparent.category_id
              LEFT JOIN product_details pd ON p.product_id = pd.product_id
              WHERE (p.name LIKE ?
              OR c.category_name LIKE ?
              OR c_parent.category_name LIKE ?
              OR c_grandparent.category_name LIKE ?)
              AND p.price <= ? 
              ORDER BY $orderBy";


    $p = new Paging($db,$query,[$searchTerm, $searchTerm, $searchTerm, $searchTerm, $max_price], 9, $page);

    return $p;
   
   
  }


  function getAllProductsByCategory($db, $cat_id,$page,$orderBy) {
    // Use prepared statements to prevent SQL injection
    $query = "SELECT p.*, pd.stock
              FROM products p
              JOIN categories c1 ON p.category_id = c1.category_id   
              LEFT JOIN categories c2 ON c1.parent_id = c2.category_id
              LEFT JOIN categories c3 ON c2.parent_id = c3.category_id
              LEFT JOIN product_details pd ON p.product_id = pd.product_id  -- Join product_details
              WHERE c1.category_id = :cat_id
              OR c1.parent_id = :cat_id
              OR c2.parent_id = :cat_id
              OR c3.parent_id = :cat_id  
              ORDER BY $orderBy";



   $p = new Paging($db,$query,  ['cat_id' => $cat_id], 12, $page, $db);

    // Execute the query with the provided category ID
    return $p;


     
   // return $db->query($query, [$searchTerm, $searchTerm, $searchTerm, $searchTerm, $max_price])->fetchAll();
    

        /*
    // Get current page from query string, default to 1
    $page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;

    $query = "SELECT * FROM products ORDER BY $orderBy";
    // Initialize Pagination (Assuming Paging accepts query, params, limit, page)

    $p = new Paging($db,$query, [], 10, $page, $db);

    // Get paginated results from Paging class
    $products = $p->result;

    */
  }
  



function getSortOptions() {
    $sortOptions = [
        'name_asc' => 'name ASC',
        'name_desc' => 'name DESC',
        'price_asc' => 'price ASC',
        'price_desc' => 'price DESC'
    ];

    return isset($_GET['sort']) && isset($sortOptions[$_GET['sort']]) 
        ? $sortOptions[$_GET['sort']] 
        : 'name ASC';
}

function formatDate($format,$date){
  $date = date($format, strtotime($date));
  return $date;
}


function is_get() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Is POST request?
function is_post() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Obtain GET parameter
function get($key, $value = null) {
  $value = $_GET[$key] ?? $value;
  return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Obtain POST parameter
function post($key, $value = null) {
  $value = $_POST[$key] ?? $value;
  return is_array($value) ? array_map('trim', $value) : trim($value);
}


function mexicoWall($url) {
  if(urlIs($url))
  if (!isset($_SESSION['general'])) {
    redirect('/register'); 
    exit; 
  }

  if (!isset($_SESSION['general'], $_SESSION['new_user'])) {
    redirect('/register'); 
    exit; 
  }

  if (!isset($_SESSION['general'], $_SESSION['new_user'], $_SESSION['user_address'])) {
    redirect('/register'); 
    exit; 
  }



 
}


 ?>
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
  
   function post_Price_range() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["price"])) {
        $price = intval($_POST["price"]); 
        $_SESSION["filtered_price"] = $price; // Store in session
       
        echo json_encode(["status" => "success", "price" => $price]); //  Send response
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
 
    $query = "SELECT p.*
              FROM products p
              JOIN categories c ON p.category_id = c.category_id
              LEFT JOIN categories c_parent ON c.parent_id = c_parent.category_id
              LEFT JOIN categories c_grandparent ON c_parent.parent_id = c_grandparent.category_id
              WHERE (p.name LIKE ?
              OR c.category_name LIKE ?
              OR c_parent.category_name LIKE ?
              OR c_grandparent.category_name LIKE ?)
              AND price <= ? ORDER BY $orderBy";

    $p = new Paging($db,$query,[$searchTerm, $searchTerm, $searchTerm, $searchTerm, $max_price], 10, $page);

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


  function getAllProductsByCategory($db, $cat_id) {
    // Use prepared statements to prevent SQL injection
    $query = "SELECT p.*
              FROM products p 
              JOIN categories c1 ON p.category_id = c1.category_id   
              LEFT JOIN categories c2 ON c1.parent_id = c2.category_id
              LEFT JOIN categories c3 ON c2.parent_id = c3.category_id
              WHERE c1.category_id = :cat_id
              OR c1.parent_id = :cat_id
              OR c2.parent_id = :cat_id
              OR c3.parent_id = :cat_id";
  
    // Execute the query with the provided category ID
    return $db->query($query, ['cat_id' => $cat_id])->fetchAll();
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










 ?>
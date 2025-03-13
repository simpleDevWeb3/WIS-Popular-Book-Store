<?php 
$db = new Database();
 // Get current page from query string, default to 1
 $page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;

$sub_SubParent_id =  $_GET['parent_id'];

// Get sorting option
$orderBy = getSortOptions();
$query = "SELECT * FROM products WHERE category_id = :category_id ORDER BY " . $orderBy;
$p = new Paging($db,$query,['category_id' => $sub_SubParent_id], 10, $page, $db);

$products = $p->result;

$sub_SubCat = $db->query("SELECT * FROM categories WHERE category_id = :category_id ",[
  'category_id' => $sub_SubParent_id
])->fetch(); 

  /*
    // Get current page from query string, default to 1
    $page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;


    // Initialize Pagination (Assuming Paging accepts query, params, limit, page)

    
    // Get paginated results from Paging class
    $products = $p->result;

    */


require 'view/sub-category.view.php'

?>


<script src="/js/sort.js"></script>
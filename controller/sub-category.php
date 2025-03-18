<?php 
$db = new Database();
 // Get current page from query string, default to 1
 $page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;

$sub_SubParent_id =  $_GET['parent_id'];

// Get sorting option
$orderBy = getSortOptions();
$query = "SELECT p.*, pd.stock 
          FROM products p
          LEFT JOIN product_details pd ON p.product_id = pd.product_id  -- Merge product_details
          WHERE p.category_id = :category_id 
          ORDER BY " . $orderBy;

$p = new Paging($db,$query,['category_id' => $sub_SubParent_id], 13, $page, $db);

$products = $p->result;

$sub_SubCat = $db->query("SELECT * FROM categories WHERE category_id = :category_id ",[
  'category_id' => $sub_SubParent_id
])->fetch(); 



require 'view/sub-category.view.php'

?>


<script src="/js/sort.js"></script>
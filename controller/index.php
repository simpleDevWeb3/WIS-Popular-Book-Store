<?php 

$db = new Database();

// Get sorting option
$orderBy = getSortOptions();
$product_details = $db->query("SELECT * FROM product_details")->fetchAll(); //GET THE PRODUCT DETAILS
$stock = [];
$p_id = [];
foreach ($product_details as $product) {
  $p_id[] = $product["product_id"];
  $stock[]= $product["stock"];// Debugging each row
}


// Get current page from query string, default to 1
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;
$query = "SELECT p.*, pd.stock 
          FROM products p
          LEFT JOIN product_details pd ON p.product_id = pd.product_id
          ORDER BY $orderBy";

// Initialize Pagination (Assuming Paging accepts query, params, limit, page)
$p = new Paging($db,$query, [], 12, $page, $db);

// Get paginated results from Paging class
$products = $p->result;


// Load View
require 'view/index.view.php';
?>

<script src="/js/sort.js"></script>

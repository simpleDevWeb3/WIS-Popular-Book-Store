<?php 

$db = new Database();

// Get sorting option
$orderBy = getSortOptions();

// Get current page from query string, default to 1
$page = isset($_GET['page']) && ctype_digit($_GET['page']) ? $_GET['page'] : 1;
$query = "SELECT * FROM products ORDER BY $orderBy";
// Initialize Pagination (Assuming Paging accepts query, params, limit, page)
$p = new Paging($db,$query, [], 12, $page, $db);

// Get paginated results from Paging class
$products = $p->result;

// Load View
require 'view/index.view.php';
?>

<script src="/js/sort.js"></script>

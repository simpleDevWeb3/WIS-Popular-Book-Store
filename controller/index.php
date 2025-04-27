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

// Initialize Pagination ( Paging accepts query, params, limit, page)
$p = new Paging($db,$query, [], 12, $page, $db);

// Get paginated results from Paging class
$products = $p->result;
// Fetch category IDs where parent_id IS NULL
$categories_ids_raw = $db->query("SELECT category_id FROM categories WHERE parent_id IS NULL")->fetchAll();

// Extract only the category_id values as a flat array
$categories_ids = array_column($categories_ids_raw, 'category_id');


//dd($categories_ids);

// Create a comma-separated list of placeholders based on the number of IDs
$placeholders = implode(',', array_fill(0, count($categories_ids), '?'));

// Prepare the query with the IN clause
$query = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";

$stmt = $db->query($query,$categories_ids);

$subCategories_raw = $stmt->fetchAll();

$subCategories_ids = array_column($subCategories_raw, 'category_id');


// Create a comma-separated list of placeholders based on the number of IDs
$placeholders = implode(',', array_fill(0, count($subCategories_ids), '?'));

// Prepare the query with the IN clause
$query = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";

$stmt = $db->query($query,$subCategories_ids);

$subSubCategories_raw = $stmt->fetchAll();


// Load View
require 'view/index.view.php';
?>

<script src="/js/sort.js"></script>

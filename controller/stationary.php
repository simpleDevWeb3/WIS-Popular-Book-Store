<?php




$db = new Database();

//Fetch only fetch single record
//Fetch all it select whole table

$products = $db ->query("SELECT p.*
                        FROM products p
                        JOIN categories c1 ON p.category_id = c1.category_id
                        LEFT JOIN categories c2 ON c1.parent_id = c2.category_id
                        LEFT JOIN categories c3 ON c2.parent_id = c3.category_id
                        WHERE c1.parent_id = 'STAT-MAIN-002' OR c2.parent_id = 'STAT-MAIN-002' OR c3.parent_id = 'STAT-MAIN-002';")->fetchAll();


$all_sub_category = getAllSubCategory($db,'STAT-MAIN-002');


require 'view/stationary.view.php';


?>

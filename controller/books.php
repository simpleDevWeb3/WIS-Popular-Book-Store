<?php


      
      

$db = new Database();

//Fetch only fetch single record
//Fetch all it select whole table
$products = $db ->query("SELECT p.*
                        FROM products p
                        JOIN categories c1 ON p.category_id = c1.category_id
                        LEFT JOIN categories c2 ON c1.parent_id = c2.category_id
                        LEFT JOIN categories c3 ON c2.parent_id = c3.category_id
                        WHERE c1.parent_id ='BOOK-MAIN-001' OR c2.parent_id = 'BOOK-MAIN-001' OR c3.parent_id ='BOOK-MAIN-001';")->fetchAll();

$all_sub_category = getAllSubCategory($db,'BOOK-MAIN-001');

require 'view/books.view.php'
?>
<?php


      
      

$db = new Database();

//Fetch only fetch single record
//Fetch all it select whole table
$products =getAllProductsByCategory($db, 'BOOK-MAIN-001');

$all_sub_category = getAllSubCategory($db,'BOOK-MAIN-001');

require 'view/books.view.php'
?>
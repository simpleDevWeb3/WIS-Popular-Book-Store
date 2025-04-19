<?php
$_db = new Database(); 

if (is_post()) {
    $id = req('id');

    $stm1 = $_db->query('DELETE FROM product_details WHERE product_id = ?',[$id]);
    $stm2 = $_db->query('DELETE FROM products WHERE product_id = ?',[$id]);
   
    temp('info', 'Record deleted');
}

redirect('/product_list');

?>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/_base.php';

if (is_post()) {
    $id = req('id');

    $stm1 = $_db->prepare('DELETE FROM product_details WHERE product_id = ?');
    $stm2 = $_db->prepare('DELETE FROM products WHERE product_id = ?');
    $stm1->execute([$id]);
    $stm2->execute([$id]);
    temp('info', 'Record deleted');
}

redirect('product.php');

?>
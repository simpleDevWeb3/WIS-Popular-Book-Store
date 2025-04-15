<?php
if (is_post()) {
    // Input
    $BS = req('BS');
    if ($BS == 'BOOK' || $BS == null) {
        $input = [
            'product_id'      =>  $product_id         = req('product_id'),
            'name'            =>  $name               = req('name'),
            'price'           =>  $price              = req('price'),
            'category_id'     =>  $category_id        = req('category_id'),
            'genre'           =>  $genre              = req('genre'),
            'publisher'       =>  $publisher          = req('publisher'),
            'publish_date'    =>  $publish_date       = req('publish_date'),
            'author'          =>  $author             = req('author'),
            'keywords'        =>  $keywords           = req('keywords'),
            'stock'           =>  $stock              = req('stock'),
            'image'           =>  $image              = req('image')
        ];    
    } else {
        $input = [
            'product_id'      =>  $product_id         = req('product_id'),
            'name'            =>  $name               = req('name'),
            'price'           =>  $price              = req('price'),
            'category_id'     =>  $category_id        = req('category_id'),
            'genre'           =>  $genre              = req('genre'),
            'brand'           =>  $brand              = req('brand'),
            'material'        =>  $material           = req('material'),
            'keywords'        =>  $keywords           = req('keywords'),
            'stock'           =>  $stock              = req('stock'),
            'image'           =>  $image              = req('image')
        ];    
    }

    /*
    var_dump($name);
    die();
    */

    foreach  ($input as $arrKey => $value) {
        if ($value == '') 
            $_err[$arrKey] = 'Required';
            
    }

   if (strlen($name) > 51) {
        $_err['name'] = 'Maximum length 50';
    }
}

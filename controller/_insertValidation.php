<?php
if (is_post()) {

    $BS = req('BS') ?: 'BOOK';
    $input = [
        'product_id'  => $product_id    = req('product_id'),
        'name'        => $name          = req('name'),
        'price'       => $price         = req('price'),
        'category_id' => $category_id   = req('category_id'),
        'genre'       => $genre         = req('genre'),
        'keywords'    => $keywords      = req('keywords'),
        'stock'       => $stock         = req('stock'),
        'image'        => $f            = get_file('image'),
    ];
    //temp_image('image', );
    //$image         = temp_image('image');


    if ($BS == 'BOOK') {
        $input = array_merge($input, [
            'publisher'    => $publisher    = req('publisher'),
            'publish_date' => $publish_date = req('publish_date'),
            'author'       => $author       = req('author'),
        ]);
    } else {
        $input = array_merge($input, [
            'brand'    => $brand    = req('brand'),
            'material' => $material = req('material'),
        ]);
    }
    
    //--------------------------------------------------general empty check
    foreach  ($input as $arrKey => $value) {
        if ($value == '') 
            $_err[$arrKey] = 'Required';
    } 

    //--------------------------------------------------product id
    if ($product_id != '') {
        if (!preg_match('/^PROD-\d{4}$/', $product_id)) {
            $_err['product_id'] = 'Invalid format. Example: PROD-0000';
        } else if (!is_unique($product_id, 'products', 'product_id')) {
            $_err['product_id'] = 'Product ID already exists';
        }
    }

    //--------------------------------------------------product name
    if ($name != '') {
        if (strlen($name) > 51) {
            $_err['name'] = 'Maximum length 50';
        }    
    }

    //--------------------------------------------------price
    if ($price != '') {
        $intPrice = (int)$price;
        if (!preg_match('/^\d+(\.\d{1,2})?$/', $price)) {
            $_err['price'] = 'Invalid format. Only 2 decimal places is allowed. Must be positif number.';
        } else if ($intPrice > 9999.99 || $intPrice <= 0.05) {
            $_err['price'] = 'Out of Range. Min = 0.05, Max = 9,999.99';
        }    
    }
    
    if ($stock != ''){
        $intStock = (int)$stock;
        if (!preg_match('/^\d+$/', $stock)) {
            $_err['stock'] = 'Invalid format. No decimal point is allowed';
        } else if ($intStock > 999999 || $intStock <= 0) {
            $_err['stock'] = 'Invalid input. Min = 1, Max = 999,999';
        }    
    }

    if ($category_id != '') {
        if (!array_key_exists($category_id, $_categories)) {
            $_err['category_id'] = 'Invalid value';
        }    
    }

    if ($f) {
        if (!str_starts_with($f->type, 'image/')) {
            $_err['image'] = 'Must be image';
        }
        else if ($f->size > 1 * 1024 * 1024) {
            $_err['image'] = 'Maximum 1MB';
        } /*else {
            $_SESSION['image'] = $f->name;    //store inside temp session
        }*/
    }

}

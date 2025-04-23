<?php


$_db = new Database();

//fetch product
    $id = req('id');
    $stm = $_db->query('SELECT * FROM products p
                            INNER JOIN product_details pd
                            ON p.product_id = pd.product_id
                            WHERE p.product_id = ?',[$id]);

    $product_detail = $stm->fetch();

    if (!$product_detail) {
      dd($product_detail);
    }

    $category_id = getParentCategory($_db, $product_detail['category_id']);




    $image = $product_detail['image'];
  

    $BS = statOrBook($category_id);



$category_prepare =  getAllSubCategory($_db, $category_id);

//get category_parentid
$subcategory_key = [];

foreach($category_prepare as $s){
    $subcategory_key[] = $s['category_id'];
}
//

//binding the category id into placeholeder
$placeholders = implode(',', array_fill(0, count($subcategory_key), '?'));

//fetch subsubcategory data
$sql = "SELECT * FROM categories WHERE parent_id IN ($placeholders)";
$stm = $_db->query($sql, $subcategory_key);

$sub_subcategoriesArr = $stm->fetchAll();

$catValue = [];
$catName = [];

//fetch key and name for category
foreach($sub_subcategoriesArr as $k){
    $catValue[] = $k['category_id'];
    $catName [] = $k['category_name'];
}



if (is_post()) {
  
  $p_id       = $_POST['product_id'] ?? '';
  $p_name     = $_POST['product_name'] ?? '';
  $p_price    = $_POST['product_price'] ?? '';
  $p_category = $_POST['category_id'] ?? '';
  $p_genre    = $_POST['genre'] ?? '';
  $p_keywords = $_POST['keywords'] ?? '';
  $p_stock    = $_POST['stock'] ?? '';


  $f = get_file('image');

  // save value from temp to image
  

if($category_id === 'BOOK-MAIN-001'){
  $p_publisher    = $_POST['publisher'] ?? '';
  $p_publish_date = $_POST['publish_date'] ?? '';
  $p_author       = $_POST['author'] ?? '';
 
}else if($category_id === 'STAT-MAIN-002'){
    $brand    = $_POST['brand'];
    $material = $_POST['material'];
}

$result;


if($category_id ===  'BOOK-MAIN-001'){

    $result = "$p_id.$p_name.$p_price.$p_category.$p_genre.$p_keywords.$p_stock.  $p_publisher .  $p_publish_date.  $p_author . $image ";

}elseif($category_id === 'STAT-MAIN-002'){
    $result = "$p_id.$p_name.$p_price.$p_category.$p_stock.$brand.$material . $image ";
}


// Validation
$_err = [];

if ($p_name != '') {
    if (strlen($p_name) > 51) {
        $_err['name'] = 'Maximum length 50';
    }    
}else{
    $_err['name'] = "Required";
}


if ($p_price != '') {
    $intPrice = (int)$p_price;

    if (!preg_match('/^\d+\.\d{2}$/', $p_price)) {
        
        $_err['price'] = 'Invalid format. Only 2 decimal places is allowed. Must be positif number.';

    } else if ($intPrice > 9999.99 || $intPrice <= 0.05) {

        $_err['price'] = 'Out of Range. Min = 0.05, Max = 9,999.99';
    }    
}else{
    $_err['price'] = "Required";
}




    if ($p_name != '' && strlen($p_name) > 50) {
        $_err['name'] = 'Maximum length is 50 characters';
    }

    if ($p_price != '') {
        $intPrice = (float)$p_price;
        if (!preg_match('/^\d+\.\d{2}$/', $p_price)) {
            $_err['price'] = 'Invalid format. Use 2 decimal places.';
        } elseif ($intPrice > 9999.99 || $intPrice < 0.05) {
            $_err['price'] = 'Price must be between 0.05 and 9,999.99';
        }
    }else{
        $_err['price'] = 'required' ;
    }

    if ($p_stock != '') {
        if (!preg_match('/^\d+$/', $p_stock)) {
            $_err['stock'] = 'Invalid format. Must be a whole number';
        } elseif ((int)$p_stock > 999999 || (int)$p_stock < 1) {
            $_err['stock'] = 'Stock must be between 1 and 999,999';
        }
    }else{
        $_err['stock'] = 'required';
    }

    if ($f) {
        if (!str_starts_with($f->type, 'image/')) {
            $_err['image'] = 'Only image files allowed';
        } elseif ($f->size > 1 * 1024 * 1024) {
            $_err['image'] = 'Maximum image size is 1MB';
        } else {
         
            $image = save_photo($f, 'Img/');
           
           
            $_SESSION['image'] = $image; 
            
        }
    }
    
    // Final update if no error
    if (!$_err) {

        if ($f) {
            unlink("$image");
            $image = save_photo($f,'Img/');
        }
        
      
        // Update product
        $_db->query('UPDATE products 
                        SET name = ?, price = ?, image = ?, category_id = ?
                        WHERE product_id = ?', [$p_name, $p_price, $image, $p_category, $p_id]);

        // Update product details
        if ($BS === 'BOOK') {
            $_db->query('UPDATE product_details 
                            SET category_id = ?, author = ?, publisher = ?, publish_date = ?, 
                                stock = ?, genre = ?, keywords = ?
                            WHERE product_id = ?', 
                            [$p_category, $p_author, $p_publisher, $p_publish_date, $p_stock, $p_genre, $p_keywords, $p_id]);
        } elseif ($BS === 'Stationery') {
            $_db->query('UPDATE product_details 
                            SET category_id = ?, brand = ?, material = ?, 
                                stock = ?, keywords = ?
                            WHERE product_id = ?', 
                            [$p_category, $brand, $material, $p_stock, $p_keywords, $p_id]);
        }

        redirect('/product_list');
        temp('info', 'Record updated');
    
        $_SESSION['image'] = $image;
    }else if($_err){
        dd($_err);

    }



}

            
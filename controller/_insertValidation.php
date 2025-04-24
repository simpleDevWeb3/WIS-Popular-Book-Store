<?php


$_db = new Database();

// Validation
$_err = [];
$cat =  'BOOK-MAIN-001';

$BS = req('BS') ?: 'BOOK';

if ($BS == 'BOOK') {
    $prod_title = 'Book';
    $cat = 'BOOK-MAIN-001';
} else if ($BS == 'STAT') {
    $prod_title = 'Stationary';
    $cat = 'STAT-MAIN-002';
} 


//fetch product
    
    
    $FETCH_PROD_ID = $_db->query('SELECT product_id  FROM products')->fetchAll();

    $EXIST_PROD_ID = [];

    foreach($FETCH_PROD_ID as $k){
        //extract out product_id
        $EXIST_PROD_ID[] = $k['product_id'];
    }

    
     
    $category_id = getParentCategory($_db, $cat);





//lelvel 2  category_id for lvl 3 parent key
$category_prepare =  getAllSubCategory($_db, $category_id);

//get lvl 2 key category_parentid
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

$sub_subcategoriesArr = $stm->fetchAll(); // lvl 3 category

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

  $p_keywords = $_POST['keywords'] ?? '';
  $p_stock    = $_POST['stock'] ?? '';


  $f = get_file('image');

  // save value from temp to image
  

if($BS === 'BOOK'){

  $p_publisher    = $_POST['publisher'] ?? '';
  $p_publish_date = $_POST['publish_date'] ?? '';
  $p_author       = $_POST['author'] ?? '';
  $p_genre    = $_POST['genre'] ?? '';

 

  if($p_publisher !== ''){
    if(strlen($p_publisher)>40){
        $_err['product_publisher'] = "Maximum length 40"; 
    }
   
  }else{
    $_err['product_publisher'] = "Required";
  }

  if($p_publish_date === ''){
    
    $_err['publish_date'] = "Required";
  }

  

  if($p_author !== ''){
    if(strlen($p_author)>40){
        $_err['product_author'] = "Maximum length 40"; 
    }

if($p_genre !== ''){
    if(strlen($p_genre)>40){
        $_err['product_genre'] = "Maximum length 40"; 
    }
    
    }else{
    $_err['product_genre'] = "Required";
    }
   
  }else{
    $_err['product_author'] = "Required";
  }
 
}else if($BS === 'STAT'){
    $brand    = $_POST['brand'];
    $material = $_POST['material'];

    if($brand  !== ''){
        if(strlen($brand)>40){
            $_err['brand'] = "Maximum length 40"; 
        }
       
      }else{
        $_err['brand'] = "Required";
      }

      if($material!== ''){
        if(strlen($material)>40){
            $_err['matrial'] = "Maximum length 40"; 
        }
       
      }else{
        $_err['material'] = "Required";
      }

    


}









if ($p_id != '') {
    if (!preg_match('/^PROD-\d{4}$/', $p_id)) {
        $_err['product_id']= "Invalid format. The code must start with 'PROD-' followed by exactly 3 digits (e.g., PROD-123).";}


    // exclude the $id from the exising array 
    //not change id will not trigger the
    else if( in_array($p_id,  $EXIST_PROD_ID)){
        $_err['product_id']= "Duplicated";
    }

}else{
    $_err['product_id'] = "Required";
}

if ($p_name != '') {
    if (strlen($p_name) > 51) {
        $_err['product_name'] = 'Maximum length 50';
    }    
}else{
    $_err['product_name'] = "Required";
}


if ($p_price != '') {
    $intPrice = (int)$p_price;

    if (!preg_match('/^\d+\.\d{2}$/', $p_price)) {
        
        $_err['product_price'] = 'Invalid format. Only 2 decimal places is allowed. Must be positif number.';

    } else if ($intPrice > 9999.99 || $intPrice <= 0.05) {

        $_err['product_price'] = 'Out of Range. Min = 0.05, Max = 9,999.99';
    }    
}else{
    $_err['product_price'] = "Required";
}

if($p_category === 'select-one'){

    $_err['product_category']= "Required";
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



  if($p_keywords !== ''){
    if(strlen($p_keywords)>40){
        $_err['product_keywords'] = "Maximum length 40"; 
    }
   
  }else{
    $_err['product_keywords'] = "Required";
  }



    if ($f) {

        $allowedTypes = ['image/jpeg', 'image/png'];

        if (!str_starts_with($f->type, 'image/')) {
            $_err['image'] = 'Only image files allowed';
        }
        else if (!in_array($f->type, $allowedTypes)) {
            $_err['image'] = 'Only JPG,PNG images are allowed';
        }
        elseif ($f->size > 1 * 1024 * 1024) {
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
        $_db->query('INSERT INTO  products 
                     (product_id, name, price, image, category_id) 
                     VALUES(?, ?, ?, ?,?)', [ $p_id,$p_name, $p_price, $image, $p_category]);

     

        // Update product details
        if ($BS === 'BOOK') {
            $_db->query('INSERT INTO product_details 
                            (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) VALUES(?, ?, ?, ?, ?, null, null, ?, ?, ?)', 
                            [$p_id,$p_category, $p_author, $p_publisher, $p_publish_date, $p_stock, $p_genre, $p_keywords]);
        } elseif ($BS === 'STAT') {
            $_db->query('INSERT INTO product_details
                (product_id, category_id, author, publisher, publish_date, brand, material, stock, genre, keywords) 
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                [$p_id, $p_category, null, null, null, $brand, $material, $p_stock, $p_genre, $p_keywords]);
        }
        

        redirect('/product_list');
        temp('info', 'Record updated');
    
        $_SESSION['image'] = $image;
    }



}

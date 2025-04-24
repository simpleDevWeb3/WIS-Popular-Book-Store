<?php

date_default_timezone_set('Asia/Kuala_Lumpur');


// Database -----------------------------------------------------------------------
// Global PDO object
$_db = new Database();



//general function---------------------------------------------------------------------------
// Is unique?

function is_unique($value, $table, $field) {
    global $_db;
    $stm = $_db->query("SELECT COUNT(*) FROM $table WHERE $field = ?",[$value]);
    return $stm->fetchColumn() == 0;
}


// Is exists?
function is_exists($value, $table, $field) {
    global $_db;
    $stm = $_db->query("SELECT COUNT(*) FROM $table WHERE $field = ?",[$value]);
    return $stm->fetchColumn() > 0;
}



// Obtain REQUEST (GET and POST) parameter
function req($key, $value = null) {
    $value = $_REQUEST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}


// Set or get temporary session variable
function temp($key, $value = null) {
    if ($value !== null) {
        $_SESSION["temp_$key"] = $value;
    }
    else {
        $value = $_SESSION["temp_$key"] ?? null;
        unset($_SESSION["temp_$key"]);  //delete data from the session
        return $value;
    }
}

function temp_image($key, $value = null) {
    if ($value !== null) {
        $_SESSION["$key"] = $value;
    } else {
        $value = $_SESSION["$key"] ?? null;
        unset($_SESSION["$key"]);
        return $value;
    }
}

// Obtain uploaded file --> cast to object
function get_file($key) {
    $f = $_FILES[$key] ?? null;
  
    if ($f && $f['error'] == 0) {
        return (object)$f;
    }

    return null;
}

//error-------------------------------------------------------------------





/////////////////////////////////////////////////////////////////////
// ---------------------------------HTML helper --------------------------------------------------
////////////////////////////////////////////////////////////////////
function encode($value) {
   
    return htmlentities($value);
}

function html_input($type, $key,$name, $attr = '') {
 
    echo "<input type='$type' id='$name' name='$name' value='$key' $attr>";

}
/*
function html_number($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='number' id='$key' name='$key' value='$value' $attr'>";
}*/

// Generate <select>
function html_select($k, $v, $selected = '', $default = 'Select one', $attr = '') {
    echo "<select name='category_id' id='category_id' class='form-select' $attr>";

    if ($default !== null) {
        echo "<option value='select-one'>$default</option>";
    }

    for ($i = 0; $i < count($k); $i++) {
        $key = $k[$i];
        $value = $v[$i];
        $state = ($key == $selected) ? 'selected' : '';
        echo "<option value='$key' $state>$value</option>";
    }

    echo "</select>";
}

function html_search($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "
    <div style='position: relative; width: 100%; height: 46px; max-width: 400px; display: flex
;'>
      <input type='search' style='padding-left:10px; border-radius: 25px; width:400px; border:none; box-shadow:0px 1px 10px rgba(0,0,0,0.2) ' id='$key' name='$key' value='$value' $attr '>
      <button class = 'search-button-cart' style ='right: 0px;' type='submit''>Search</button>
    </div>";
}

function html_file($key, $accept = '', $attr = '') {
    echo "<input type='file' id='$key' name='$key' accept='$accept' $attr> ";
}

function table_headers($fields, $sort, $dir, $href = '') {
    foreach ($fields as $k => $v) {
        $d = 'asc'; // Default direction
        $c = '';    // Default class
        
        if ($k == $sort) {
            $d = $dir == 'asc' ?  'desc' :  'asc';
            $c = $dir;
        }

        echo "<th><a href='?sort=$k&dir=$d&$href' class='$c'>$v</a></th>";
    }
}

/////////////////////////////////////////////////////////////////////
// ---------------------------------prepare datalist --------------------------------------------------
////////////////////////////////////////////////////////////////////

function preapreDataList($column) {
    global $_db;

    $query = "SELECT DISTINCT $column FROM product_details ORDER BY $column ASC";
    $prepare = $_db->query($query)->fetchAll();

 

    return  $prepare;
}


/////////////////////////////////////////////////////////////////////
// ---------------------------------get all  category --------------------------------------------------
////////////////////////////////////////////////////////////////////

$_categories = $_db->query('SELECT c3.category_id, c3.category_name
                FROM categories c1
                INNER JOIN categories c2
                ON c1.category_id = c2.parent_id
                INNER JOIN categories c3
                ON c2.category_id = c3.parent_id')->fetchAll(PDO::FETCH_KEY_PAIR);

/////////////////////////////////////////////////////////////////////
// ---------------------------------debug --------------------------------------------------
////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
// ---------------------------------book or stat --------------------------------------------------
////////////////////////////////////////////////////////////////////
function statOrBook($cat_id) {
    if (str_starts_with($cat_id, 'BOOK')) {
        return 'BOOK';
    } else {
        return 'STAT';
    }
}

/////////////////////////////////////////////////////////////////////
// ---------------------------------IMAGE --------------------------------------------------
////////////////////////////////////////////////////////////////////
function save_photo($f, $folder,$path = 'product/', $width = 500, $height = 500 ,) {
    $photo = $path . uniqid() . '.jpg';
  

    $img = new SimpleImage();
    $img->fromFile($f->tmp_name)
        ->thumbnail($width, $height)
        ->toFile("$folder/$photo", 'image/jpeg');

      return 'img/' .  $photo; 
}


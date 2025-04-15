<?php

date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

// Database -----------------------------------------------------------------------
// Global PDO object
$_db = new PDO('mysql:dbname=mypopularmain', 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
]);



//general function---------------------------------------------------------------------------
// Is unique?
function is_unique($value, $table, $field) {
    global $_db;
    $stm = $_db->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
    $stm->execute([$value]);
    return $stm->fetchColumn() == 0;
}

// Is exists?
function is_exists($value, $table, $field) {
    global $_db;
    $stm = $_db->prepare("SELECT COUNT(*) FROM $table WHERE $field = ?");
    $stm->execute([$value]);
    return $stm->fetchColumn() > 0;
}

// Is GET request?
function is_get() {
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// Is POST request?
function is_post() {
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

// Obtain REQUEST (GET and POST) parameter
function req($key, $value = null) {
    $value = $_REQUEST[$key] ?? $value;
    return is_array($value) ? array_map('trim', $value) : trim($value);
}

// Redirect to URL
function redirect($url = null) {
    $url ??= $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
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
// Global error array
$_err = [];

// Generate <span class='err'>
function err($key) {
    global $_err;

    if ($_err[$key] ?? false) {
        echo "<span class='err'>$_err[$key]</span>";
    }
    else {
        echo '<span></span>';
    }
}

/////////////////////////////////////////////////////////////////////
// ---------------------------------HTML helper --------------------------------------------------
////////////////////////////////////////////////////////////////////
function encode($value) {
    return htmlentities($value);
}

function html_input($type, $key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='$type' id='$key' name='$key' value='$value' $attr>";

}

function html_number($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='number' id='$key' name='$key' value='$value' $attr'>";
}

// Generate <select>
function html_select($key, $items, $default = 'Select one', $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<select id='$key' name='$key' $attr>";
    if ($default !== null) {
        echo "<option value=''>$default</option>";
    }
    foreach ($items as $item) {
        $state = $item->category_id == $value ? 'selected' : '';
        echo "<option value='$item->category_id' $state>$item->category_name - $item->category_id</option>";
    }
    echo '</select>';
}

function html_search($key, $attr = '') {
    $value = encode($GLOBALS[$key] ?? '');
    echo "<input type='search' id='$key' name='$key' value='$value' $attr>";
}

function html_file($key, $accept = '', $attr = '') {
    echo "<input type='file' id='$key' name='$key' accept='$accept' $attr>";
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
    global  $_db;
    $query = "SELECT DISTINCT $column FROM product_details ORDER BY $column ASC";
    $prepare = $_db->prepare($query);
    $prepare->execute();
    return $prepare->fetchAll();
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
function dd($i) {
    var_dump($i);
    die();
}

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

// Crop, resize and save photo
function save_photo($f, $folder, $width = 500, $height = 500) {
    $photo = 'img/product/' . uniqid() . '.jpg';
    
    require_once 'LIB/SimpleImage.php';
    $img = new SimpleImage();
    $img->fromFile($f->tmp_name)
        ->thumbnail($width, $height)
        ->toFile("$folder/$photo", 'image/jpeg');

    return $photo;
}

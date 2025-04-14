<?php


$db = new Database();
$_user = $_SESSION['user'] ?? null;

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


function redirect($url = null) {
    $url ??= $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit();
  }



function login($user, $url = '/'){
    $_SESSION['user'] = $user;
    redirect($url);
}

function logout($url = '/'){
    unset($_SESSION['user']);
    redirect($url);
}

function auth(...$roles){
  global $_user;
  if($_user){
    if($roles){
        if(in_array($_user->role,$roles)){
            return; //login as user / admin
        }
    }
    else{
        return; //login as visitor
    }
  }
  
  redirect('/login');
}

?>


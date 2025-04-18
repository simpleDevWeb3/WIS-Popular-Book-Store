<?php


$db = new Database();
$_user = $_SESSION['user'] ?? null;





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
function auth(...$roles) {
  global $_user;

  if (isset($_user['role']) && in_array($_user['role'], $roles)) {
    return true; 
  } 
  else{
    redirect('/login');
  }
}

?>


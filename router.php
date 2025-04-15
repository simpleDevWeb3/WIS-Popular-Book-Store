<?php 
// router = directory to page base on requested URI
//used in index.php

// parse_url  ['path] avoid conflict between path and qurey happen
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//og code for routing

    /* router original code
    if($uri === '/')
    {
      require 'controller/index.php';
    }

    else if($uri === '/books')
    {
      require 'controller/books.php';
    }

    else if($uri === '/stationary')
    {
      require 'controller/stationary.php';
    }
    else if($uri === '/product')
    {
      require 'controller/product.php';
    }
    
    */



// map fo website
$routes =[
          '/' => 'controller/index.php',
          '/profile' =>'controller/profile.php',
          '/register'=>'controller/register.php',
          '/login'=> 'controller/login.php',
          '/orderHistory' => 'controller/orderHistory.php',
          '/cart' => 'controller/cart/cart.php',
          '/checkOut' => '/controller/cart/checkOut.php',
          '/books' => 'controller/books.php',
          '/stationary'=>'controller/stationary.php',
          '/product' => 'controller/product.php',
          '/search' => 'controller/search.php',
          '/category' => 'controller/category.php',
          '/subcategory' => 'controller/sub-category.php',
          '/comment'=> 'controller/comment.php'
      
];




// for routing different page base on uri request
function routeToController($uri,$routes){

   //check if $uri requested is exist in $routes
  if (array_key_exists($uri,$routes))
  {
    require $routes[$uri]; //eg /books -> controller/books.php;
  }
  else{
    abort();// eg eror 404
  }

 

}

  // called when request error happens
  function abort($code=404){
    http_response_code($code);
    require "view/{$code}.php";

    die();
  }


routeToController($uri,$routes);//by default it will start in page index 

?>
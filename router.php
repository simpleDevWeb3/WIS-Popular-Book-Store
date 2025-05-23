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
          '/profile-view' => 'view/profile.view.php',
          '/register-account'=>'view/register.view.php',
          '/register-address'=>'view/register.address.view.php',
          '/register-general' =>'view/register.general.view.php',
          '/login'=> 'controller/login.php',
          '/orderHistory' => 'controller/orderHistory.php',
          '/cart' => 'controller/cart/cart.php',
          '/checkOut' => 'controller/cart/checkOut.php',
          '/books' => 'controller/books.php',
          '/stationary'=>'controller/stationary.php',
          '/product' => 'controller/product.php',
          '/search' => 'controller/search.php',
          '/category' => 'controller/category.php',
          '/subcategory' => 'controller/sub-category.php',
          
          '/comment'=> 'controller/comment.php',
          '/address' => 'view/address.view.php',
          '/password' => 'view/password.view.php',
          '/city' => 'controller/city.php',
          '/postal'=> 'controller/postal.php',
         
          
          '/product_list' => 'view/admin_crud_product.php',      
          '/product_detail' => 'view/admin_crud_product-details.php',
          '/member_list' => 'view/admin_crud_member.php',
          '/update' => 'view/admin_crud_product-update.php',
          '/update_validate' => 'view/_updateValidation.php',
          '/insert' => 'view/admin_crud_insert.php',
          '/insert_validate'=> 'controller/_insertValidation.php',
          '/sales_list' => 'view/admin_crud_sales.php',
          '/sales_detail' => 'view/admin_crud_sales_detail.php',
          '/memebr_list' => 'view/admin_crud_member.php',
          '/member_detail' => 'view/admin_crud_member_details.php',
          '/delete' => 'controller/_delete.php'   
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
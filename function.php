<?php
   session_start();
   processCartRequest();

   // code to ensure when page refresh cart quantity will not become 0
   function processCartRequest(){
    if(!isset($_SESSION['cart_count'])){
        $_SESSION['cart_count']=0; // 
    }


    if(isset($_POST['add_quantity'])){
      $quantity = intval($_POST['add_quantity']);
      $_SESSION['cart_count']+= $quantity;

      echo $_SESSION['cart_count'];
    }

 

   }
    //code for debugging eg.checking uri
    function dd($value){

      echo "<pre>";  
        var_dump($value) ;
      echo "</pre>";
    
      die();
    }

    //$value =REQUESTED_URI
    //return boolean after compaer $value with request_uri

    //used in navbar.php
    function urlIs($value){
      return $_SERVER['REQUEST_URI'] === $value;
    }


    








 ?>
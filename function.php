<?php
  

    //code for debugging eg.checking uri
    function dd($value){

      echo "<pre>";  
        var_dump($value) ;
      echo "</pre>";
    
      die();
    }


    //return boolean after compaer $value with request_uri
    //used in navbar.php
    function urlIs($value){
      return $_SERVER['REQUEST_URI'] === $value;
    }

 ?>
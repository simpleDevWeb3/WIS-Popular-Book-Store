<?php 
//connect to db and exexute query
class Database{
 
  public $conn;

  //constructor 
  public function __construct(){
     //$dsn = arrange connection to mysql 
   //default config  
   $dsn = "mysql:host=localhost;port=3306;dbname=mypopularmain;charset=utf8mb4;";
   $username = "root";
   $password = ""; 
          
     

     // construct 
     $this->conn = new PDO($dsn,$username,$password,[
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
     ]);
 
  }


  // can call any query using this function

  public function query($query,$param = [])
  {

   
    //$stmt = get sql query and execute
    $stmt = $this->conn->prepare($query);
    $stmt->execute($param);

   return  $stmt;

   
  
  }

  

 
}
?>
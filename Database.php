<?php 
//connect to db and exexute query
class Database{
 
  public $conn;

  //constructor 
  public function __construct($config,$username = 'root',$password=''){
     //$dsn = arrange connection to mysql 
    

    
     /*
     $dsn = "host={$config['host']};
             port={$config['port']};
             dbname={$config['dbname']};
             charset={$config['charset']};";
     */

     $dsn = 'mysql:' . http_build_query($config,'',';'); //example.com?host=localhost;port=3306;dbname=populardb
   
     $this->conn = new PDO($dsn, $username,$password,[
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
     ]);
 
  }


  public function query($query)
  {

   
    //$stmt = get sql query and execute
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    //query for getting all products
    //fetch_assoc ->remove duplciate data

   return  $stmt;
  
  }
}
?>
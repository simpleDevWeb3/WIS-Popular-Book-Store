<?php 
 $db = new Database();

$cities = [];

 $states = $db->query("SELECT * FROM States ")->fetchAll();



?>
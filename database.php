<?php 
class Data{
   private $host='localhost';
   private $bdname='my_shop';
   private $username='root';
   private $password='masso';
   private $database;

   public function connect(){
    try{
       $this->database= new PDO ("mysql:host=$this->host;dbname=$this->bdname",$this->username,$this->password);
       return $this->database;
    }
   catch(PDOException $e){
    echo"erreur ". $e->getMessage();
   }
   }
}

?>
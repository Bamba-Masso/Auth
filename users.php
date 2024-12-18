<?php
require('database.php');
class User{
    private $id;
    private $database;
       public function __construct(){
        $this->database=(new Data())->connect();
       }
       //requête d'insertion des données dans la base de donnée
    public function register ($username,$email,$password){
       
      $passCrypted=password_hash($password,PASSWORD_BCRYPT);
       $requet='INSERT INTO users (username,email,password) VALUES (:username,:email,:password)';
       $preparer=$this->database->prepare($requet);
       $preparer->bindParam(':username',$username, PDO::PARAM_STR);
       $preparer->bindParam(':email',$email, PDO::PARAM_STR);
       $preparer->bindParam(':password',$passCrypted, PDO::PARAM_STR);
      return $preparer->execute();

    //    return true;
    }

    public function userExiste(){
        $requet='SELECT email FROM users WHERE email=:email AND username=:username';
        $preparer=$this->database->prepare($requet);
         $preparer->bindParam(':email',$email, PDO::PARAM_STR);
         $preparer->bindParam(':username',$username, PDO::PARAM_STR);
        $preparer->execute();
        return $preparer->fetch(PDO::FETCH_ASSOC);
        //  return $users;
    }
//connexion de l'utilisateur
public function singIn($email,$password){
    // var_dump($email); 
    try {
        // Requête pour récupérer l'utilisateur par l'email uniquement
        
        $requet = 'SELECT * FROM users WHERE email=:email';
        $preparer = $this->database->prepare($requet);
        $preparer->bindParam( ':email', $email, PDO::PARAM_STR);
        //  $preparer->bindParam(':password', $password, PDO::PARAM_STR);
          $preparer->execute();
        // if($user){
              $users=$preparer->fetch(PDO::FETCH_ASSOC);
              if($users && password_verify($password, $users['password']) ){
                 session_start();
                $_SESSION['id_user']=$users['id'];
                
                $_SESSION['id_role']=$users['id_role'];
                return $users;
              }
        //     echo $user['id'];
       
        // }
        
        
       

        
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
    return false;
}
}
?>
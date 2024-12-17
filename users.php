<?php
require('database.php');
class User{
    private $database;
       public function __construct(){
        $this->database=(new Data())->connect();
       }
       //requête d'insertion des données dans la base de donnée
    public function register ( $username,$email,$password){
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
        $requet='SELECT email FROM users';
        $preparer=$this->database->prepare($requet);
        // $preparer->bindParam(':email',$email, PDO::PARAM_STR);
        // $preparer->bindParam(':username',$username, PDO::PARAM_STR);
        $preparer->execute();
        return $preparer->fetch(PDO::FETCH_ASSOC);
        //  return $users;
    }
//connexion de l'utilisateur
    public function singIn(){
        $requet='SELECT*FROM users WHERE email= :email';
        $preparer=$this->database->prepare($requet);
        $preparer->bindParam('email',$email );
        // $preparer->bindParam(':password',$password, PDO::PARAM_STR);
        $preparer->execute();
        $users=$preparer->fetch(PDO ::FETCH_ASSOC);
        return $users;
    }

}
?>
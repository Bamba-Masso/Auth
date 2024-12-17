<?php 
include('users.php');

function validateEmail($email) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    return preg_match($pattern, $email);
}

if(!empty($_POST['username']) && !empty($_POST['email']) &&!empty($_POST['password'])&&!empty($_POST['passwordconfirme'])){
$username=trim($_POST['username']); // trim permet de supprimer les espaces
$email=trim($_POST['email']);
$password=trim($_POST['password']);
$password_confirme=trim($_POST['passwordconfirme']);
      //verification des données 
 if(strlen($username)<3 && strlen($username)>10){
     $errorName="Le nombre de carractère doit être entre 3 et 10";
 }
 if(empty($email) or validateEmail($email)){
     $errorEmail="email invalide";
 }
if( empty($password) or strlen($password)<3 && strlen($password)>=9){
        $errorPassword= "Le mot de passe doit avoir au moin 8 carractères"; 
}
if( empty($password_confirme)){
   
    $errorsPassword= "erreur sur le password";
    
}elseif($password != $password_confirme){
    $invalidPass="password non conforme";
}

if(!isset($errorName) && !isset($errorEmail) && !isset($errorPassword) && !isset($errorsPassword) && !isset($invalidPass) ){
    
     $user=new User();
   
     if($user->userExiste()){
        $alertUser="Désolé ce compte à déjà été creer";
     }else{
        $valid=$user->register($username,$email,$password);
        if($valid){
            $valid='user enregister';
        }
       
     }
     
}
}else{
    $errorValid='Veillez remplir tous les champs';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
     <?php if(!empty($valid)){
        echo $valid;
     } ?>
      
      <?php if(!empty($alertUser)){
        echo $alertUser;
     } ?>
        <div>
            <label for="username">username</label>
            <input type="text" name="username">
            <?php 
            if(!empty($errorName)){
                echo $errorName;}
            ?>
        </div>
        <div>
            <label for="email">email</label>
            <input type="email"name='email'>
            <?php if(!empty($errorEmail)){
              echo $errorEmail;} ?>
        </div>
        <div>
            <label for="password">password</label>
            <input type="password" name="password">
            <?php
            if(!empty($errorPassword)){
                echo $errorPassword;}
            ?>
        </div>
        <div>
            <label for="password"> confirmer votre mot de password</label>
            <input type="password" name="passwordconfirme">
            <?php if(!empty($errorsPassword)){
            echo $errorsPassword;} ?>

             <?php if(!empty($invalidPass)){
             echo $invalidPass;} ?>
        </div>
        <input type="submit">
    </form>
</body>
</html>
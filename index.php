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
 if(strlen($username)<3 or strlen($username)>10){
     $errorName="Le nombre de carractère doit être entre 3 et 10";
 }
 if(empty($email) or !validateEmail($email)){
     $errorEmail="email invalide";
 }
if( empty($password) or strlen($password)<3 or strlen($password)>=9){
        $errorPassword= "Le mot de passe doit avoir au moin 8 carractères"; 
}
if( empty($password_confirme)){
   
    $errorsPassword= "erreur sur le password";
    
}elseif($password != $password_confirme){
    $invalidPass="password non conforme";
}
//insertion des données dans la base de donnée

if(!isset($errorName) && !isset($errorEmail) && !isset($errorPassword) && !isset($errorsPassword) && !isset($invalidPass) ){
     //on verifie si l'email de l'utilisateur existe déjà 
     $user=new User();
     if($user->userExiste()){
        $alertUser="Désolé ce compte à déjà été creer";
        //sinon on l'enregistre dans notre base de donnée
     }else{
        $valid=$user->register($username,$email,$password);
        if($valid){
            $valid='user enregister';
            header('LOCATION:singIn.php');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register</title>
</head>
<body>
<div class="bg-white w-screen font-sans text-gray-900">
  <div class=" ">
    <div class="mx-auto w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl">
      <div class="mx-2 py-12 text-center md:mx-auto md:w-2/3 md:py-16">
        <h1 class="text-3xl font-black leading-4 sm:text-5xl xl:text-6xl">Sign up</h1>
      </div>
      <?php 
       if(!empty($alertUser)){
        echo"<p class='mt-2 text-xs text-rose-600 text-center'>$alertUser</p>"; } 
        if(!empty($valid)){
            echo"<p class='mt-2 text-xs text-rose-600 text-center'>$valid</p>"; } 
        if(!empty($errorValid)){
        echo"<p class='mt-2 text-xs text-rose-600 text-center'>$errorValid</p>";}  
      ?>
      <!-- <p class="mt-2 text-xs text-rose-600 text-center">Valid email address required for the account recovery process</p> -->
    </div>
  </div>
  <div class="md:w-2/3 mx-auto w-full pb-16 sm:max-w-screen-sm md:max-w-screen-md lg:w-1/3 lg:max-w-screen-lg xl:max-w-screen-xl">
    <form class="shadow-lg rounded-lg border border-gray-100 py-10 px-8" method="post">
      <div class="mb-4">
            <label class="mb-2 block text-sm font-bold" for="email">Username</label>
            <input name="username"class="shadow-sm w-full rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="email" type="text" />
            <!-- <span class="my-2 block"></span> -->
            <?php 
                if(!empty($errorName)){
                echo"<p class='mt-2 text-xs text-rose-600 text-center'> $errorName</p>"; } 
                
            ?> 
      </div>
      <div class="mb-4">
            <label class="mb-2 block text-sm font-bold" for="email">E-mail</label>
            <input name="email" class="shadow-sm w-full rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="email" type="email" />
            <!-- <span class="my-2 block"></span> -->
            <?php 
                if(!empty($errorEmail)){
                echo"<p class='mt-2 text-xs text-rose-600 text-center'> $errorEmail</p>"; }  
            ?> 
     </div>
     <div class="mb-4">
            <label class="mb-2 block text-sm font-bold" for="phone">Password</label>
            <input name="password"class="shadow-sm w-full cursor-text appearance-none rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="phone" type="password"/>
            <!-- <span class="my-2 block"></span> -->
            <?php 
                if(!empty($errorPassword)){
                echo"<p class='mt-2 text-xs text-rose-600 text-center'>$errorPassword</p>"; }  
            ?> 
     </div>
     <div class="mb-4">
            <label class="mb-2 block text-sm font-bold" for="password">Confirmer votre mot de passe</label>
            <input name="passwordconfirme" class="shadow-sm w-full cursor-text appearance-none rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="password" type="password"/>
            <?php 
                if(!empty( $errorsPassword)){
                echo"<p class='mt-2 text-xs text-rose-600 text-center'> $errorsPassword</p>"; } 

                if(!empty($invalidPass)){
                echo"<p class='mt-2 text-xs text-rose-600 text-center'> $invalidPass</p>"; }   
            ?> 
     </div>
      
      <div class="flex items-center">
      
        <input class="cursor-pointer rounded bg-blue-600 py-2 px-8 text-center text-lg font-bold  text-white" type="submit" value="Create account">
      </div>
    </form>
  </div>
</div>

</body>
</html>
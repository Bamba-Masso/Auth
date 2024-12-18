<?php 
 session_start();
include('users.php');
//  $email=$_POST['email'];

 if(!empty($_POST['email']) && !empty($_POST['password'])){
  $email=$_POST['email'];
  $password=$_POST['password'];
   $sing=new User();
  if($sing->singIn($email,$password)){
    if($_SESSION['id_role']==3){
      header('LOCATION:pageUser.php');
    }elseif($_SESSION['id_role']== 1 || $_SESSION['id_role']==2){
      header('LOCATION:admin.php');
 }else{
  $alert='Mot de passe ou email invalide';
 }
}
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<div class="bg-white w-screen font-sans text-gray-900">
  <div class=" ">
    <div class="mx-auto w-full sm:max-w-screen-sm md:max-w-screen-md lg:max-w-screen-lg xl:max-w-screen-xl">
      <div class="mx-2 py-12 text-center md:mx-auto md:w-2/3 md:py-16">
        <h1 class="text-3xl font-black leading-4 sm:text-5xl xl:text-6xl">Sign in</h1>
      </div>
     
      <!-- <p class="mt-2 text-xs text-rose-600 text-center">Valid email address required for the account recovery process</p> -->
    </div>
  </div>
  <div class="md:w-2/3 mx-auto w-full pb-16 sm:max-w-screen-sm md:max-w-screen-md lg:w-1/3 lg:max-w-screen-lg xl:max-w-screen-xl">
    <form class="shadow-lg rounded-lg border border-gray-100 py-10 px-8" method="post">
    <?php 
         if(!empty($alert)){
         echo"<p class='mt-2 text-xs text-rose-600 text-center'> $alert</p>"; } 
                
        ?> 
      <div class="mb-4">
            <label class="mb-2 block text-sm font-bold" for="email">E-mail</label>
            <input name="email" class="shadow-sm w-full rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="email" type="email" />
            <!-- <span class="my-2 block"></span> -->
           
     </div>
     <div class="mb-4">
        <label class="mb-2 block text-sm font-bold" for="phone">Password</label>
        <input name="password"class="shadow-sm w-full cursor-text appearance-none rounded border border-gray-300 py-2 px-3 leading-tight outline-none ring-blue-500 focus:ring" id="phone" type="password"/>
        <!-- <span class="my-2 block"></span> -->
            
     </div>
     
      <div class="flex items-center">
      
        <input class="cursor-pointer rounded bg-blue-600 py-2 px-8 text-center text-lg font-bold  text-white" type="submit" value="Connexion">
      </div>
    </form>
  </div>
</div>  
</body>
</html>
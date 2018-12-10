<?php
// chargement de l'autoload
require 'inc/bootstrap.php';
// creation de l'objet auth avec ouverture de session si inexistante.
$user= new Auth(Session::getInstance());
// Verification du menu a mettre en noir.
if(isset($_SESSION['menu'])){
  $i= $_SESSION['menu']; 
}
else{
 $i= 0;   
}
//Vérification de l'utilisateur si admin ou non.
if(isset($_SESSION['auth']) AND $_SESSION['auth']->droits=="A"){
    $menuhaut = 'inc/menu_hauta.php';
}else{
    $menuhaut = 'inc/menu_haut.php';
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Collection de jeux</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/style.css" type="text/css">
    </head>
    <body>
        <div class="maincenter">
        <div class="main">
            <div class="menu_haut">
                <?php 
                //chargement des onglets.
                include($menuhaut);
                ?>
            </div>
            <div class="centre">
                <?php
                //chargement de la page principale en fonction d'utilisateur.
                if(!$user->user()){
                include('login.php');
                }else{
                include($_SESSION['page']);    
                }
                ?>
        </div>
        </div>
        </div>
   <?php
    if(Session::getInstance()->hasFlashes()): ?>
    <?php $alert="";?>
    <?php foreach (Session::getInstance()->getFlashes() as $type => $message):?>
    <?php $alert =$alert.$message;?>
    <?php endforeach;?>
    <script>alert('<?= $alert;?>')</script>
    <?php endif;?> 
    </body>
</html>


<?php
//chargement de l'autoloader.
require_once 'inc/bootstrap.php';
//creation de la session si inexistante.
$user= new Auth(Session::getInstance());
//activation du menu accueil et de sa page si l'utilisateur est loggé.
if($user->user())
{
$_SESSION['menu']=0;
App::redirect('accueil.php');
}
else{
App::redirect('');
        
}


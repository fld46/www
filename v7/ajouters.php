<?php
require_once 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if($user->user())
{

$_SESSION['menu']=4;
App::redirect('ajouter.php');
}
else{
App::redirect('');
        
}


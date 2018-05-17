<?php
require_once 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if($user->user())
{

$_SESSION['menu']=3;
App::redirect('supprimer.php');
}
else{
App::redirect('');
        
}



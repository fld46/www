<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin()!="")
{
$_SESSION['page']='accueil.php';
$_SESSION['menu']=0;
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>

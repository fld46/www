<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin()!="")
{
$_SESSION['page']='supprimer.php';
$_SESSION['menu']=3;
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>


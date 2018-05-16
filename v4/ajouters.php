<?php
session_start();
require_once 'Dbconfig.php';
if($user->is_loggedin2()!="")
{
$_SESSION['page']='ajouter.php';
$_SESSION['menu']=1;
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>


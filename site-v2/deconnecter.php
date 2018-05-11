<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin()!="")
{
$user->logout();
$_SESSION['menu']=4;
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>


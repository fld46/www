<?php
session_start();
require_once 'Dbconfig.php';
if($user->is_loggedin()!="")
{
$_SESSION['page']='ajouter.php';
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>


<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin()!="")
{
$user->logout();
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>


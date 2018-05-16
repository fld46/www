
<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin2()!="")
{
$_SESSION['page']='modifier.php';
$_SESSION['menu']=2;
$user->redirect('index.php');
}
else{
$user->redirect('index.php');    
}
?>



<?php
require 'Dbconfig.php';
if($user->is_loggedin()!="")
{
$user->logout();
$user->redirect('loginform.php');
}





?>


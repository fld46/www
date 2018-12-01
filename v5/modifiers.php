<?php
require_once 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if($user->user())
{

$_SESSION['menu']=2;
App::redirect('modifier.php');
}
else{
App::redirect('');
}        


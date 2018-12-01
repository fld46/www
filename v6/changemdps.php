<?php
require_once 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if($user->user())
{

$_SESSION['menu']=4;
App::redirect('account/accountcmdp.php');
}
else{
App::redirect('');
        
}



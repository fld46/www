<?php
//session_start();
//require_once 'Dbconfig.php';
//
//if($user->is_loggedin()!="")
//{
//$_SESSION['page']='accueil.php';
//$_SESSION['menu']=0;
//$user->redirect('index.php');
//}
//else{
//$_SESSION['page']='login.php';
//$_SESSION['menu']=0;
//$user->redirect('/index.php');    
//}

require_once 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if($user->user())
{

$_SESSION['menu']=0;
App::redirect('accueil.php');
}
else{
App::redirect('');
        
}


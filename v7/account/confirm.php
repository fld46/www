<?php
require'../inc/bootstrap.php';
$db = App::getDatabase();


$user=$db->query('SELECT * FROM users WHERE id= ?',[$user_id] )->fetch();

if(App::getAuth()->confirm($db,$_GET['id'],$_GET['token'], Session::getInstance())) {
    
    Session::getInstance()->setFlash('success', "Votre compte a bien été validé");
     $_SESSION['menu']=4;
    App::redirect('account/account.php');
    
    
}else{
     
     Session::getInstance()->setFlash('danger', "Ce token n'est plus valide");
     App::redirect('login.php');
}



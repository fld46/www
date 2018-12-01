<?php
require 'inc/bootstrap.php';
$user= new Auth(Session::getInstance());
if(isset($_SESSION['menu'])){
  $i= $_SESSION['menu']; 
}
else{
 $i= 0;   
}
if(isset($_SESSION['auth']) AND $_SESSION['auth']->droits=="A"){
    $menuhaut = 'inc/menu_hauta.php';
}else{
    $menuhaut = 'inc/menu_haut.php';
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Collection de jeux</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="/style.css" type="text/css">
    </head>
    <body >
        <div class="maincenter">
        <div class="main">
            <div class="menu_haut">
                <?php include($menuhaut);?>
            </div>
            <div class="centre">
                <?php
                if(!$user->user()){
                include('login.php');
                }else{
                include($_SESSION['page']);    
                }
                               
                ?>
        </div>
        </div>
        </div>
        
    </body>
</html>

<?php
session_start();
if(isset($_SESSION['menu'])){
  $i= $_SESSION['menu']; 
}
else{
 $i= 0;   
}
?>

<html>
    <head>
        <title>test de presentation</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body >
        <div class="maincenter">
        <div class="main">
            <div class="menu_haut">
                <?php include('menu_haut.php');?>
            </div>
            <div class="centre">
                <?php
                if(!isset($_SESSION['page'])){
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

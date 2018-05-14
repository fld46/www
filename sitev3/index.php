<?php
session_start();
if(isset($_SESSION['menu'])){
  $i= $_SESSION['menu']; 
}
else{
 $i= 0;   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>test de presentation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
    <body>
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
        
    </body>
</html>

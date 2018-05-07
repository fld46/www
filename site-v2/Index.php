<?php
session_start()
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css"type="text/css"/> 
    </head>
    <body>
        <div class="main">
        <div class="gauche"></div>
        <div class="droite">
        <div class="menu1"> <!-- début de la boite contenant les onglets -->
        <a class="onglet-actif" href="accueils.php">Accueil</a> <!-- onglet actif -->
        <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
        <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
        <a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
        <a class="onglet" href="deconnecter.php" >Deconnecter</a>
        </div>
        </div>
        </div>
        <div class="centre">
            <?php
            if(!isset($_SESSION['page'])){
            include('login.php');
            }else{
            include($_SESSION['page']);    
            }
            ?>
        <div>
        <!--<IFRAME  class="centre"  src="login.php"  name="centre"></IFRAME>-->
        
    </body>
</html>


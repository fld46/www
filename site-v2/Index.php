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
        <link rel="stylesheet" href="style.css"type="text/css"/> 
    </head>
    <body>
        <div class="main">
        <div class="menu1"> <!-- début de la boite contenant les onglets -->
        <?php
        switch ($i) {
        case 0:
            ?><a class="onglet-actif" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 1:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet-actif" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 2:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet-actif" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 3:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet-actif" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 4:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet-actif" href="deconnecter.php" >Deconnecter</a><?php
        break;
}
        ?>
        
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
        <!--<IFRAME  class="centre"  src="login.php"  name="centre"></IFRAME>-->
        
    </body>
</html>


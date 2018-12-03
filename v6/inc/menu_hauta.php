<?php
//menu du haut de l'administrateur en fonction de la variable i.
        switch ($i) {
        case 0:
            ?><a class="onglet-actif" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <!--<a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <!--<a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <!--<a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet" href="accountsa.php" >Gestion</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 4:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <!--<a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <!--<a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <!--<a class="onglet" href="supprimers.php" >Supprimer</a> <!-- onglet inactif -->
            <a class="onglet-actif" href="accountsa.php" >Gestion</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
}
    


<?php
//menu du haut en fonction de la variable i.
        switch ($i) {
        case 0:
            ?><a class="onglet-actif" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="accounts.php" >Profil</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 1:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet-actif" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="accounts.php" >Profil</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        case 2:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet-actif" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet" href="accounts.php" >Profil</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        
        case 4:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
            <a class="onglet" href="ajouters.php" >Ajouter</a> <!-- onglet inACTIF -->
            <a class="onglet" href="modifiers.php" >Modifier</a> <!-- onglet inactif -->
            <a class="onglet-actif" href="accounts.php" >Profil</a>
            <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
}
    


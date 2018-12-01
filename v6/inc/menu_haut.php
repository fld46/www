<?php
//menu du haut en fonction de la variable i.
        switch ($i) {
        case 0:
            ?><a class="onglet-actif" href="accueils.php">Accueil</a> <!-- onglet actif -->
              <a class="onglet" href="accounts.php" >Gestion</a>
              <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        
        case 4:
            ?><a class="onglet" href="accueils.php">Accueil</a> <!-- onglet actif -->
              <a class="onglet-actif" href="accounts.php" >Gestion</a>
              <a class="onglet" href="deconnecter.php" >Deconnecter</a><?php
        break;
        
       
}
    


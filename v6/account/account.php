<?php
if(!isset($_SESSION['auth']->droits)){
    require "../inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
$auth=App::getAuth()->restrict();
$db=App::getDatabase();
$stats = new Accountstat($db, $_SESSION['auth']->id);
?>
   <div class="menu_gauche">
       <div class="liens_account">
           <p><a href="changemdps.php">Changer de mot de passe</a></p>
           <p><a href="Jeux.php">Jeux</a></p>
           <p><a href="prochjeuxafinirs.php">Prochains jeux a finir</a></p>
           <p><a href="jeuxssguide.php">Jeux sans guide</a></p>
           <p><a href="vljeux.php">Votre liste de jeux</a></p>
       </div>
   </div>    
   <div class="droiteaccount">
        
        <table class="droit">
        <thead class="titreaccount">
                <tr class="titre">
                    <th>Nombre de jeux possédés</th>
                    <th>Nombre de jeux finis</th>
                    <th>Jeu Suggéré</th>
                </tr>
        </thead>
        <tbody class="bodyaccount">
        <tr>
            <td><?php echo $stats->getNbjeuxPossede();?></td>
            <td><?php echo $stats->getNbjeuxFini();?></td>
            <td><?php echo $stats->getNbjeuxSuggere();?></td>
        </tr>
        </tbody>
    </table>
</div> 
   
   

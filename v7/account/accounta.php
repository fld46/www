<?php
if(!isset($_SESSION['auth']->droits)or$_SESSION['auth']->droits!="A"){
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
           <p><a href="Users.php">Utilisateurs</a></p>
           <p><a href="Jeux.php">Jeux</a></p>
           <p><a href="ajouters.php">Ajouter un jeux</a></p>
           <p><a href="modifiers.php">Modifier un jeux</a></p>
           <p><a href="supprimers.php">Supprimer un jeux</a></p>
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
    <div class="droiteaccountb">
       <table class="droit">
        <thead class="titreaccountb">
                <tr class="titre">
                    <th>Nombre de jeux </th>
                    <th>Nombre de jeux non renseignés</th>
                </tr>
        </thead>
        <tbody class="bodyaccountb">
        <tr>
            <td><?php echo $stats->getNbjeux();?></td>
            <td><?php echo $stats->getNbjeuxNC();?></td>
        </tr>
        </tbody>
    </table>
    </div>
    <div class="droiteaccountc">
       <table class="droit">
        <thead class="titreaccountc">
                <tr class="titre">
                    <th class="titre">Titre</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th class="console">Console</th>
                </tr>
        </thead>
        <tbody class="bodyaccountc">
        <?php $stats->getLastjeux();?>
        </tbody>
    </table>
    </div>
</div> 
   
   

<?php
//verification que l'utilisateur est loggé et est admin
if(!isset($_SESSION['auth']->droits)or $_SESSION['auth']->droits!="A"){
    require "inc/bootstrap.php";
    App::redirectr('/v4/index.php');
}
//recuperation de la bdd et creation de l'objet manager
$db = App::getDatabase();
$manager = new JeuxManager($db);
//si jeux selectionné, affichage de celui ci grace a manager->get
if(isset($_POST['selectj']))
   {
    $manager->get($_POST['titrejeux']);
}
//Suppression du jeux grace a manager->dejetej
if(isset($_POST['supj']))
{
$manager->deletej($_POST['titrejeux']);
App::redirect('supprimer.php');
 }
//formulaire si aucun jeux selectionné
if(!isset($_POST['selectj'])){
?>    

    <div class ="menu_gauche">
        <form method="post" class="form_ident">
            <fieldset><legend>Selectionner</legend>
            <br> 
                <?php
                    //affichage de la liste de jeux en fonction du navigateur    
                        $liste=new Datalist();
                        $liste->verifNav();
                ?>
                <br><br>
                <button type="submit" name="selectj">SELECT</button>
            </fieldset>
        </form>    
    </div>
    <div class="droitec">
    <div class="droiteint">
    <table class="droit">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixec">
        <tr>
        <form method="post">
        <td class="titre"></td>
        <td class="img"></td><td class="img"></td>
        <td></td>
        <td class="img"></td>
        <td></td>
        <td></td>
        <td></td>
        </form>
        </tr>
    </tbody>
    </table>
    </div>
    </div>
    
    <script src="datalist-polyfill.min.js"></script>


    
<?php

}

?>



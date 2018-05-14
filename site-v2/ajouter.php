<?php
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Dbconfig.php';
//require 'user.class.php';
//require 'Liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
$manager = new JeuxManager($db);

if(isset($_POST['ajouterj']))
{
$jeuxa = new Jeux();
$jeuxa->setTitre($_POST['titre']);
$jeuxa->setTemps($_POST['temps']);
$jeuxa->setDifficulte($_POST['difficulte']);
$jeuxa->setMulti($_POST['multi']);
$jeuxa->setPs4($_POST['ps4']);
$jeuxa->setPs3($_POST['ps3']);
$jeuxa->setPsvita($_POST['psvita']);
$jeuxa->setFini($_POST['fini']);
$jeuxa->setLiens($_POST['liens']);
$jeuxa->setPossede($_POST['possede']);
$manager->add($jeuxa, $_SESSION['user_session']);
$user->redirect('index.php');

}



?>

<div class="droitea">
    <form  method="post" class="form_rempli">
    <table class="bas">
        <thead class="fixe" >
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixeb">
        <tr >
        
            <td class="titre"><p><input type="text" name="Titre" placeholder="titre" required/><br><input type="text" name="liens" placeholder="liens"/></p></td>
        <td><input type="number" name="temps" step="1" min="0" max="10000"/></td>
        <td><input type="number" name="difficulte" step="1" min="0" max="10"/></td>
        <td>
            <p><label>oui</label><input type="radio" name="multi" value="oui" /> <br>
                <label>non</label><input type="radio" name="multi" value="non" /> </p>
            
        </td>
        <td>
            <label>Psvita</label><input type="checkbox" name="psvita" value="oui" /><br>
            <label>Ps3</label><input type="checkbox" name="ps3" value="oui" /><br>
            <label>Ps4</label><input type="checkbox" name="ps4" value="oui" />
        
        </td>
        </tr>
        <tr class="inputaj">
            <td><label>Possede</label><input type="checkbox" name="possede" value="oui" />
                <label>Fini</label><input type="checkbox" name="fini" value="oui" /> 
            </td>
            <td><button type="submit" name="ajouterj" >Ajouter</button></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
     
    </table>
     
</form>
</div>


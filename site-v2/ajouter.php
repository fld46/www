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
<html>
    <head>
        <link rel="stylesheet" href="style.css"type="text/css"/>
    </head>
<body>
    <div class ="gauche">
    </div>
    <div class="droite">
    <table class="bas">
        <thead>
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tr>
        <form   method="post" >
        <td><label>Titre :</label><input type="text" name="titre" required/><br><label>Liens :</label><input type="text" name="liens"/></td>
        <td><input type="number" name="temps"/></td>
        <td><input type="number" name="difficulte"/></td>
        <td><div>
                <input type="radio" name="multi" value="oui" /> <label>oui</label><br />
                <input type="radio" name="multi" value="non" /> <label>non</label><br />
            </div>
        </td>
        <td><div>
                <input type="checkbox" name="psvita" value="oui" /><label>Psvita</label><br />
                <input type="checkbox" name="ps3" value="oui" /><label>Ps3</label><br />
                <input type="checkbox" name="ps4" value="oui" /><label>Ps4</label><br />
            </div>
        </td>
        <!--<td>
            <div>
                    User
            </div>  
        </td>-->
        </tr>
        <tr>
            <td><input type="checkbox" name="possede" value="oui" /> <label>Possede</label>
                <input type="checkbox" name="fini" value="oui" /> <label>Fini</label>
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <!--<td></td>-->
        </tr>
        
        </tr>
    </table>
    </div>
    <button type="submit" name="ajouterj" class="ajouter">Ajouter</button>    
</form>
</body>
</html>


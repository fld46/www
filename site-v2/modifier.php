<?php

require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Dbconfig.php';
$db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
$manager = new JeuxManager($db);
if(isset($_POST['selectj']))
   {
    
    $manager->getm($_POST['titrejeux'],$_SESSION['login'],$_SESSION['login']);
}
if(isset($_POST['modifierj']))
{
 $idt = $_SESSION['tjam'];
 $manager->updateJeux($idt);
 $user->redirect('index.php');
 
 
}
if(!isset($_POST['selectj'])){
?>    

    <div class ="gauche">
        <form method="post">
            <fieldset><legend>Selectionner</legend>
            <br><input list="titrejeu" type="text"  name="titrejeux"/>
                    <datalist id="titrejeu">
                        <?php $manager->listej(); ?>
                    </datalist>
               
                <br><br>
                <button class="tri" name="selectj">SELECT<BUTTon>
            </fieldset>
        </form>    
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
        <form method="post">
        <td></td>
        <td></td>
        <td></td>
        <td>
        </td>
        <td>
        </td>
        <!--<td>
            <div>
                    User
            </div>   
        </td>-->
        </form>
        </tr>
    </table>
    </div>
    </div>
    <!--<button type="submit" class="delete" name="modifierj" >Modifier</button>-->
     <script src="datalist-polyfill.min.js"></script>

    
<?php

}




?>

<?php

require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Dbconfig.php';
require 'datalist.class.php';
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

    <div class="menu_gauche">
        <form class="form_ident" method="post">
            <fieldset><legend>Selectionner</legend>
            <br>
                        <?php
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
                </tr>
        </thead>
        <tbody class="fixec">
        <tr>
        <form method="post">
        <td class="titre"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
    
    
   <script src="datalist-polyfill.min.js"></script>

    
<?php

}




?>

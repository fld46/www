<?php


require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';
require 'Dbconfig.php';
require 'datalist.class.php';
$db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
$manager = new JeuxManager($db);
if(isset($_POST['selectj']))
   {
    
    $manager->get($_POST['titrejeux'],$_SESSION['login'],$_SESSION['login']);
}
if(isset($_POST['supj']))
{
  
//$idt = $_POST['id'];
 $manager->deletej($_POST['titrejeux']);
$user->redirect('index.php');
 
}

if(!isset($_POST['selectj'])){
?>    

    <div class ="gauche">
        <form method="post" class="form_ident">
            <fieldset><legend>Selectionner</legend>
            <br> <?php
                        $liste=new Datalist();
                        $liste->verifNav();
                        ?>
               
                <br><br>
                <button type="submit" name="selectj">SELECT</button>
            </fieldset>
        </form>    
    </div>
    <div class="droitem">
    <table class="bas">
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
        <tbody class="fixeb">
        <tr>
        <form method="post">
        <td class="titre"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </form>
        </tr>
    </tbody>
    </table>
    </div>
    
    <script src="datalist-polyfill.min.js"></script>


    
<?php

}

?>



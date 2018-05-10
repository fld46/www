<?php


require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';

$db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
$manager = new JeuxManager($db);
if(!isset($_POST['selectj'])){
?>    
<html>
    <head>
        <link rel="stylesheet" href="style.css"type="text/css"/>
    </head>
<body>
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
        <td></td>
        <td></td>
        </form>
        </tr>
    </table>
    </div>
    </div>
    <script src="datalist-polyfill.min.js"></script>
</body>
</html>
    
<?php

}


if(isset($_POST['selectj']))
   {
    
    $manager->get($_POST['titrejeux'],$_SESSION['login'],$_SESSION['login']);
}
if(isset($_POST['supj']))
{
  
//$idt = $_POST['id'];
 $manager->deletej($_POST['titrejeux']);

 
}

?>



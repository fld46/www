<?php
require 'jeuxmanager.class.php';
require 'jeux.class.php';
//session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="style.css"type="text/css"/>
    </head>
<body>
    
    <div class ="gauche">
        
        <form method="post">
            <fieldset><legend>Tri</legend>
            <br>tritre<br>temps<br>difficulte<br><br>
            </fieldset>
            <fieldset><legend>Jeux</legend>
            <br>ps vita<br>ps3<br>ps4<br>multi<br>
            </fieldset>
            <fieldset><legend>User</legend>
            <br>user fini<br>
            </fieldset>
            <button class="tri">ok</button>
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
                    <th>User</th>
                </tr>
        </thead>
        <?php
        $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
        $manager = new JeuxManager($db);
        $manager->getList();
        ?><!--<tr>
        <td><a href=''>Titre</a></td>
        <td>Temps</td>
        <td>Difficulte</td>
        <td>Multi</td>
        <td><div>Console</div></td>
        <td>User</td>
        </tr>-->
    </table>
    </div>
    
</body>
</html>

<?php
session_start();
if(!isset($_SESSION['login']))
{
header("Location: loginform.php");
}
require 'vartri.class.php';
$testvar = new vartri();
$testvar->tri();
?>
<html>
<head>
<link rel="stylesheet" href="style.css"type="text/css"/>
</head>
<body>
<table class="haut">
<tr><td><a href="ajouter.php" class="bouton-relief">Ajouter</a></td><td><a href="modifier.php" class="bouton-relief">Modifier</a></td><td><a href="effacer.php" class="bouton-relief">Effacer</a></td><td><a href="deconnecter.php" class="bouton-relief">Deconnecter</a></td></tr>
</table>
<br>
<table class="bas">
    <form method="post" ><tr class="titre"><th align="center"><button type="submit" name="btn_titre" class="btn_titre">TITRE</button></th><th><form method="post"><button type="submit" name="btn_temps" class="btn_titre">Temps</button></th><th><form method="post"><button type="submit" name="btn_difficulte" class="btn_titre">Difficulte</button></th><th><form method="post"><button type="submit" name="btn_multi" class="btn_titre">Multi</button></th><th><form method="post"><button type="submit" name="btn_fini" class="btn_titre">Fini</button></th><th><form method="post"><button type="submit" name="btn_finit" class="btn_titre">Finit</button></th><th><form method="post"><button type="submit" name="btn_ps4" class="btn_titre">Ps4</button></th><th><form method="post"><button type="submit" name="btn_ps3" class="btn_titre">Ps3</button></th><th><form method="post"><button type="submit" name="btn_psvita" class="btn_titre">Psvita</button></th><th><form method="post"><button type="submit" name="btn_fred" class="btn_titre">Fred</button></th><th><form method="post"><button type="submit" name="btn_tristan" class="btn_titre">Tristan</button></th><th><form method="post"><button type="submit" name="btn_jo" class="btn_titre">Jo</button></th></tr></form>
<?php
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
$manager->getList();
//echo $_SESSION['login']

//$manager->add($jeuxa);
?>
</table>
</html>

<?php
//require 'Dbconfig.php';
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
<table  align=center >
<tr><td><a href="ajouter.php" class="bouton-relief">Ajouter</a></td><td><a href="modifier.php" class="bouton-relief">Modifier</a></td><td><a href="effacer.php" class="bouton-relief">Effacer</a></td><td><a href="deconnecter.php" class="bouton-relief">Deconnecter</a></td></tr>
</table>
<br>
<table border = 1 align=center >
    <tr><td> <form method="post"><button type="submit" name="btn_titre">TITRE</button></form></td><td><form method="post"><button type="submit" name="btn_temps">Temps</button></td><td>Difficulte</td><td>Multi</td><td>Fini</td><td>Finit</td><td>Ps4</td><td>Ps3</td><td>Psvita</td><td>Fred</td><td>Tristan</td><td>Jo</td>
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

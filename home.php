<?php
//require 'Dbconfig.php';
session_start();
if(!isset($_SESSION['login']))
{
header("Location: loginform.php");
}
?>

<html>
<head>
</head>
<body>
<table border = 1 align=center >
<tr><td>Ajouter</td><td>Modifier</td><td><a href="effacer.php">Effacer</a></td><td><a href="deconnecter.php">Deconnecter</a></td></tr>
</table>
<br>
<table border = 1 align=center >
<tr><td>Titre</td><td>Temps</td><td>Difficulte</td><td>Multi</td><td>Fini</td><td>Finit</td><td>Ps4</td><td>Ps3</td><td>Psvita</td><td>Fred</td><td>Tristan</td><td>Jo</td>
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

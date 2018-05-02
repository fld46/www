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
    <tr><td align="center"><form method="post" ><input type="submit" name="btn_titre" value="TITRE"></td><td><form method="post"><button type="submit" name="btn_temps">Temps</button></td><td><form method="post"><button type="submit" name="btn_difficulte">Difficulte</button></td><td><form method="post"><button type="submit" name="btn_multi">Multi</button></td><td><form method="post"><button type="submit" name="btn_fini">Fini</button></td><td><form method="post"><button type="submit" name="btn_finit">Finit</button></td><td><form method="post"><button type="submit" name="btn_ps4">Ps4</button></td><td><form method="post"><button type="submit" name="btn_ps3">Ps3</button></td><td><form method="post"><button type="submit" name="btn_psvita">Psvita</button></td><td><form method="post"><button type="submit" name="btn_fred">Fred</button></td><td><form method="post"><button type="submit" name="btn_tristan">Tristan</button></td><td><form method="post"><button type="submit" name="btn_jo">Jo</button></td>
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

<?php
SESSION_start();
?>
<html>
<head>
</head>
<body>
<table border = 1>
<tr><td>Titre</td><td>Temps</td><td>Difficulte</td><td>Multi</td><td>Fini</td><td>Ps4</td><td>Ps3</td><td>Psvita</td>
<?php
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
$manager->getList();
//$manager->add($jeuxa);
?>
</table>

<?php
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$request = $db->query('SELECT id, titre, temps, difficulte, multi, fini, finit, ps4, ps3, psvita, liens, fred, tristan FROM jeux WHERE fred="oui"');
while ($perso = $request->fetch(PDO::FETCH_ASSOC))
      {
      echo $perso['titre'];
      }
?>


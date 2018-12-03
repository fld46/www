<?php
// chargement de l'autoload
require 'inc/bootstrap.php';
// creation de l'objet auth avec ouverture de session si inexistante.
$db = App::getDatabase();
$idjeux=$_GET['id'];
$q=$db->query('SELECT * FROM jeux WHERE id = ?',[$idjeux]);
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    }
   
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Collection de jeux</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/style.css" type="text/css">
    </head>
    <body>
        <div><?php echo $jeux->titre();?></div>
        <div><a href="<?php  echo $jeux->liens();?>" target="new">guide</a></div>
        <div><img src="<?php echo "images/".$jeux->titre()."/".$jeux->image() ;?>"></div>
        <div>multi</div>
        <div>diff</div>
        <div>temps</div>
        <div>comments</div>
        <div>crosssav</div>
        <div>crosstrophe</div>
        <div>crossmulti</div>
        <div>users</div>
        
    </body>
</html>

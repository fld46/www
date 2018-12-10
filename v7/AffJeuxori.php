<?php
// chargement de l'autoload
require 'inc/bootstrap.php';
// creation de l'objet auth avec ouverture de session si inexistante.
$db = App::getDatabase();
$idjeux=$_GET['id'];
$q=$db->query('SELECT * FROM jeux WHERE id = ?',[$idjeux]);
$jeuxm= new JeuxManager($db); 
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    }
if ($jeux->multi()=="oui"){
        $multi='<img src="online.png"  alt="" />';
    }else{
        $multi='';
   }

if($jeux->liens()!=""){
       $guide= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="valido" alt="" /></a>';
    }else{
       $guide=''; 
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Collection de jeux</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/styleAff.css" type="text/css">
    </head>
    <body>
        <div id="total">
            
            <div id="main">
                <div id="img">
                    <img src="<?php echo "images/".$jeux->titre()."/".$jeux->image() ;?>" class="imgaff" alt="">
                </div>
                <div id="contenu">
                    <div class="titre">
                <?= $jeux->titre();?>
                </div>
                    <div><?= $jeuxm->getConsoleAff($jeux);?><?=$guide;?><?= $multi;?></div><br>
                    <div><span>Difficulté :<?= $jeux->difficulte();?></span>
                        <span class="droite">Temps :<?= $jeux->temps();?></span></div><br>
                        <span><?= $jeuxm->verifoui($jeux, 'crosssav');?> <?=$jeuxm->verifoui($jeux, 'crosstrophy');?><?=$jeuxm->verifoui($jeux, 'crossmulti');?></span><br>
                
                        <br><div>Commentaire : <?=$jeux->comments();?></div>
                
                    <br><div>Liste des joueurs possedant ce jeux :<?= $jeuxm->getListeUserPossede($jeux);?></div>
                </div>
            </div>
            
        </div>
    </body>
</html>

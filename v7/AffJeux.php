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
        <div class="total">
            <div class="main">
                <div class="left">
                <?php 
                    if($jeux->image()){
                    echo '<img src="images/'.$jeux->titre().'/'.$jeux->image().'" alt="image">'; }
                    else{
                    echo '<img src="noimg.png" alt="image">';    
                    }
                    ?> 
                
                </div>
                <div class="center">
                    <div class="titre"><a href="<?=$jeux->liens();?>" target="new"><?= $jeux->titre();?></a></div>
                    <?= $jeuxm->getConsoleAff($jeux);?><?= $multi;?>
                    <div class="centercell"><span>Difficulté : <?= $jeux->difficulte();?></span></div><div class="centercell"><span>Temps : <?= $jeux->temps();?> h</span></div>
                   <?PHP 
                   if(($jeux->crossmulti()!="")||($jeux->crosssav()!="")||($jeux->crosstrophy()!="")){
                   echo '<div class="centercell">'.    
                   $jeuxm->verifoui($jeux, 'crosssav','Cross-sav');?> <?=$jeuxm->verifoui($jeux, 'crosstrophy','Cross-trophy');?><?=$jeuxm->verifoui($jeux, 'crossmulti','Cross-multi')
                   .'</div>';
                   
                   }
                  if($jeux->comments()!=""){
                   echo '<div class="centercell">Commentaire : '.$jeux->comments().'</div>';
                  }?>
                   <div class="user">Utilisateurs :<?= $jeuxm->getListeUserPossede($jeux);?></div>
                </div>
                
                
                <div class="clear"></div>
                
             </div>
        </div>
    </body>
</html>

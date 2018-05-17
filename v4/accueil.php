<?php
$db = App::getDatabase();
$userl = new User($db);
$manager = new JeuxManager($db);
?>

   <div class ="menu_gauche">
        <form method="post" class="form_ident">
            <fieldset><legend>Tri</legend>
               <input type="radio" name="tri" id="titre" value="titre" />Titre<br>
               <input type="radio" name="tri" id="temps" value="temps" />Temps<br>
               <input type="radio" name="tri" id="difficulte" value="difficulte" />Difficulte<br>
               <input type="radio" name="ordretri" id="croissant" value="ASC" />Croissant<br>
               <input type="radio" name="ordretri" id="decroissant" value="DESC" />Decroissant<br>    
            </fieldset>
            <fieldset><legend>Jeux</legend>
                <div><input type="checkbox" name="ps4"  value="oui" /> Ps4</div>
                <div><input type="checkbox" name="ps3"  value="oui" /> Ps3</div>
                <div><input type="checkbox" name="psvita"  value="oui" /> Psvita</div>
                <div><input type="checkbox" name="multi"  value="oui" /> Multi</div>
                <div><input type="checkbox" name="nc"  value="oui" /> Enlever les vides</div>
            </fieldset>
            <fieldset><legend>Users</legend>
          
            <?php
            $userl->getListUser();
            ?>
            </fieldset>
            <button type="submit">ok</button>
        </form>
    </div>
  
    <?php
    $manager->getList();
    
  
    
    


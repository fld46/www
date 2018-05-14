<?php
require 'jeuxmanager.class.php';
require 'jeux.class.php';
require 'user.class.php';

//session_start();
?>

   <div class ="gauche">
        <form method="post" class="form_ident">
            <fieldset><legend>Tri</legend>
                <label for="titre">Titre</label><div class="radio"><input type="radio" name="tri" id="titre" value="titre" /></div><br>
                <label for="temps">Temps</label><div class="radio"><input type="radio" name="tri" id="temps" value="temps" /></div><br>
                <label for="difficulte">Difficulte</label><div class="radio"><input type="radio" name="tri" id="difficulte" value="difficulte" /></div><br>
                <label for="croissant">Croissant</label><div class="radio"><input type="radio" name="ordretri" id="croissant" value="ASC" /></div><br>
                <label for="decroissant">Decroissant</label><div class="radio"><input type="radio" name="ordretri" id="decroissant" value="DESC" /></div><br>    
            </fieldset>
            <fieldset><legend>Jeux</legend>
                <div><input type="checkbox" name="ps4"  value="oui" />Ps4</div>
                <div><input type="checkbox" name="ps3"  value="oui" />Ps3</div>
                <div><input type="checkbox" name="psvita"  value="oui" />Psvita</div>
                <div><input type="checkbox" name="multi"  value="oui" />Multi</div>
            </fieldset>
            <fieldset><legend>User</legend>
            <?php
            $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
            $userl = new USER($db);
            $userl->getListUser();
            ?>
            </fieldset>
            <button type="submit">ok</button>
        </form>
      
      
    </div>
    
        <?php
        $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
        $manager = new JeuxManager($db);
        //$manager->verifDroite();
        $manager->getList();
        ?><!--<tr>
        <td><a href=''>Titre</a></td>
        <td>Temps</td>
        <td>Difficulte</td>
        <td>Multi</td>
        <td><div>Console</div></td>
        <td>User</td>
        </tr>-->
        </tbody>
    </table>
    </div>
    


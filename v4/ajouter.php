<?php
//Verification d'utilisateur
if(!isset($_SESSION['auth']->droits)){
    require "inc/bootstrap.php";
    App::redirectr('/v4/index.php');
}
//recuperation de la bdd et creation de l'objet $manager
$db = App::getDatabase();
$manager = new JeuxManager($db);
//si des données sont en POST, on les passe ds l'objet jeux qui lui est ajouter ds la bdd par l'objet $manager
if((isset($_POST['ajouterj']))&&(($_POST['liens']=="")||($_POST['liens']!="")&&(isset($_POST['multi']))))
{
$jeuxb = new Jeux();
$jeuxb->hydrate($_POST);
if(isset($_POST['fini'])){$jeuxb->setFini($_POST['fini']);}                       
if(isset($_POST['possede'])){$jeuxb->setPossede($_POST['possede']);}
$jeuxb->setComments($_POST['comment']);

$manager->add($jeuxb, $_SESSION['auth']->id);


}
?>
<div class="droitec">
    <div class="droiteint">
    <form  method="post" class="form_rempli">
    <table class="droit">
        
        <thead class="fixe" >
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixec">
        <tr >
            <td class="img"></td><td class="img"></td>
            <td class="titre"><p><input type="text" name="Titre" placeholder="titre" required/><br><input type="text" name="liens" placeholder="liens"/></p></td><td class="img"></td>
            <td><input type="number" name="temps" step="1" min="0" max="10000"/></td>
            <td><input type="number" name="difficulte" step="1" min="0" max="10"/></td>
            <td>
            <label for="oui">oui</label><input type="radio" id="oui" name="multi" value="oui" />
            <label for="non">non</label><input type="radio" id="non" name="multi" value="non" /> 
            
            </td>
            <td class="radios">
            <div class="radios"><label>Psvita</label><br><label>Ps3</label><br><label>Ps4</label></div>
            <div><input  type="checkbox" name="psvita" value="oui" /><br>
                <input type="checkbox" name="ps3" value="oui" /><br>
            <input type="checkbox" name="ps4" value="oui" /></div>
        
        </td>
        
        </tr>
        
        <tr>
            <td colspan="8"><TEXTAREA  name="comment" rows="1" cols="50">Commentaire</textarea></td>  
        </tr>
        


        <tr class="inputaj">
            <td class="img"></td><td class="img"></td>
            <td><label>Possede</label><input type="checkbox" name="possede" value="oui" />
                <label>Fini</label><input type="checkbox" name="fini" value="oui" /> 
            </td>
            <td class="img"></td>
            <td><button type="submit" name="ajouterj" >Ajouter</button></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        
        </tbody>
     
    </table>
     
</form>
</div>
</div>

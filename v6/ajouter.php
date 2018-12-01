<?php
//Verification d'utilisateur
if(!isset($_SESSION['auth']->droits)or$_SESSION['auth']->droits!="A"){
    require "inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
//recuperation de la bdd et creation de l'objet $manager
$db = App::getDatabase();
$manager = new JeuxManager($db);
//si des données sont en POST, on les passe ds l'objet jeux qui lui est ajouter ds la bdd par l'objet $manager
if(isset($_POST['ajouterj']))
{
$teste = new Teste($_POST);
$teste->isOk();

if($teste->isValid()){
$jeuxb = new Jeux();
$jeuxb->hydrate($_POST);
$jeuxb->setImage($_FILES['image']['name']);
$manager->copyImage($jeuxb->titre());
$manager->add($jeuxb);


}
}
?>
<div class="droitec">
    <div class="droiteint">
        <form  method="post" class="form_rempli" enctype="multipart/form-data">
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
            <td class="titre"><p><input type="text" name="titre" placeholder="titre" required/><br><input type="text" name="liens" placeholder="liens"/></p></td><td class="img"></td>
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
            <td colspan="8">
            <div> cross sav :<input  type="checkbox" name="crosssav" value="oui" /><br>
                cross trophy :<input type="checkbox" name="crosstrophy" value="oui" /><br>
                cross multi :<input type="checkbox" name="crossmulti" value="oui" /></div>
        
            </td>
        
        <tr>
            <td colspan="8"><input type="file" name="image"/></td> 
        </tr>
        <tr class="inputaj">
            <td colspan="8"><button type="submit" name="ajouterj" >Ajouter</button></td>
        </tr>
        </tbody>
    </table>
</form>
</div>
</div>
<?php
if(Session::getInstance()->hasFlashes()): ?>
    <?php foreach (Session::getInstance()->getFlashes() as $type => $message):?>
        <div class="alert-danger">
            <?= $message;?>
        </div>
<?php endforeach;?>
<?php endif;


    
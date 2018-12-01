<?php
//Verifiacation que l'utilisateur est loggé
if(!isset($_SESSION['auth']->droits)or$_SESSION['auth']->droits!="A"){
    require "inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
//Recuperation de la bdd et creation de l'objet manager.
$db = App::getDatabase();
$manager = new JeuxManager($db);
//si le jeux est selectionner, on affiche son "contenu" avec manager->getm
if(isset($_POST['selectj']))
   {
    
    $manager->getGameSelected($_POST['titrejeux']);
   }
//Si la variable modifierj exist, on modifie celui ci en passant par $manager et redirection vers modifier.php
if(isset($_POST['modifierj']))
{
 $teste = new Teste($_POST);
 $teste->isOKUpdate();
 if($teste->isValid()){
 $jeuxb = new Jeux();
 $jeuxb->hydrate($_POST);
 $idt = $_SESSION['idjam'];
 $manager->updateJeux($idt);
 $manager->copyImage($jeuxb->titre());
 Session::setFlash('update','Update ok');
 App::redirect('modifier.php');
} 
}
//formulaire si aucun jeux selectionné
if(!isset($_POST['selectj'])){
?>    

    <div class="menu_gauche">
        <form class="form_ident" method="post">
            <fieldset><legend>Selectionner</legend>
            <br>
                        <?php
                        //liste des jeux avec verif navigateur
                        $liste=new Datalist();
                        $liste->verifNav();
                        ?>
               
                <br><br>
                <button type="submit" name="selectj">SELECT</button>
            </fieldset>
            </form>    
    </div>
    
    <div class="droitec">
        <div class="droiteint">
        <table class="droit">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                </tr>
        </thead>
        <tbody class="fixec">
        <tr>
        <form method="post">
        <td class="titre"></td>
        <td class="img"></td>
        <td class="img"></td>
        <td></td>
        <td class="img"></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
    
    
   <!--<script src="datalist-polyfill.min.js"></script>-->

 <?php
}

if(Session::getInstance()->hasFlashes()): ?>
    <?php foreach (Session::getInstance()->getFlashes() as $type => $message):?>
        <div class="alert-danger">
            <?= $message;?>
        </div>
<?php endforeach;?>
<?php endif; 


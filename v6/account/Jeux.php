<?php
//Verifiacation que l'utilisateur est loggé
if(!isset($_SESSION['auth']->droits)){
    require "inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
//Recuperation de la bdd et creation de l'objet manager.
$db = App::getDatabase();
$manager = new JeuxManager($db);
//si le jeux est selectionner, on affiche son "contenu" avec manager->getm
if(isset($_POST['selectj']))
   {
    $manager->getGameSelectedGestion($_POST['titrejeux'],$_SESSION['auth']->id);
   }
//Si la variable modifierj exist, on modifie celui ci en passant par $manager et redirection vers modifier.php
if(isset($_POST['modifierj']))
{
 $teste = new Teste($_POST);
 $teste->isOKGestion();
 if($teste->isValid()){
    $jeux = new Jeux();
    $jeux->hydrate($_POST);
    $manager->updateJeuxGestion($jeux);
 
 
 
 //Session::setFlash('update','Update ok');
 //App::redirect('jeux.php');
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
                    <th class="titrejeux">TITRE</th>
                    <!--<th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>-->
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
    <?php $alert="";?>
    <?php foreach (Session::getInstance()->getFlashes() as $type => $message):?>
    <?php $alert =$alert.'\n'.$message;?>
    <?php endforeach;?>
    <script>alert('<?= $alert;?>')</script>
    <?php endif;



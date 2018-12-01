<?php
if(!isset($_SESSION['auth']->droits)or $_SESSION['auth']->droits!="A"){
    require "../inc/bootstrap.php";
    App::redirectr('/v4/index.php');
}
$auth= App::getAuth();
$auth->restrict(Session::getInstance());
$db = App::getDatabase();

if(!empty($_POST)){
    
    if(isset($_POST['btn_delusersnc']) ){
        $auth->deleteNC($db);
        $_SESSION['flash']['success'] = "Les utilisatuers non validés sont supprimés";
    }
    if(isset($_POST['selectu']) ){
        $auth->deleteu($db,$_POST['users']);
        
        $_SESSION['flash']['success'] = $_POST['users']."est supprimés";
    }
}
?>
               
            <div class="droiteaccount">
                <?php if(!empty($errors)):?>
                <div>
                    <p> Vous n'avez pas rempli le formulaire correctement !</p>
                    <ul>
                    <?php foreach($errors as $error):?>
                    <li><?= $error;?></li>
                    <?php endforeach;?>
                    </ul>
                </div>
                <?php endif;?>
                <form method="post" action="" class="form_ident">
                    <label>Supprimer les Utilisateurs non validés :</label>
                 <button type="submit" name="btn_delusersnc">ok</button>  
                </form>
                <div >
                    <form method="post" class="form_ident">
                    <fieldset><legend>Selectionner l'utilisateur à supprimer</legend>
                    <br>
                       
                        <?php
                        $liste=new Datalist();
                        $liste->verifNavu();
                        ?>
                    
               
                <br><br>
                <button type="submit" name="selectu">Delete</button>
                </fieldset>
                </form>    
                </div>
                </div>
 <script src="datalist-polyfill.min.js"></script>
                
        


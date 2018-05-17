<?php
require '../inc/bootstrap.php';
if(!empty($_POST) && !empty($_POST['email'])){
    $db = App::getDatabase();
    $auth = App::getAuth();
    $session = Session::getInstance();
    if($auth->resetPassword($db, $_POST['email'])){
      $session->setFlash('success','Les instructions du rappel de mot de passe vous ont été envoyées par email');
      App::redirect('index.php');         
    }else{
      $session->setFlash('danger','Aucun compte ne correspond a cette adresse'); 
    }
    
}
?>
<html>
    <head>
        <title>Reinitialiser le mdp</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="../style.css" type="text/css">
    </head>
    <body >
        <div class="maincenter">
        <div class="main">
            
            <div class="centre">
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
                    <label>E-mail</label><br><input type='mail' name='email'  ><br>
                    
                    
                    
                <button type="submit" name="btn_register">reinitialiser</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>

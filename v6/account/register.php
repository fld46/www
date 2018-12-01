<?php
//require 'function.php';
require "../inc/bootstrap.php";


if (!empty($_POST)){
    
    $errors=array();
    $db = App::getDatabase();
    $validator = new Validator($_POST);
    $validator->isAlpha('login', "Votre pseudo n'est pas valide");
    if($validator->isValid()){
        $validator->isUniq('login', $db, 'users','Ce pseudo est deja pris');
    }
    $validator->isEmail('email',"Votre e-mail n'est pas valide");
    if($validator->isValid()){
        $validator->isUniq('email', $db, 'users','Cet e-mail est deja utilisé pour un autre compte');
    }
    $validator->isConfirmed('password', 'Vous devez rentrer un mot de passe valide');
    
     
    if($validator->isValid()){
        
        App::getAuth()->register($db,$_POST['login'], $_POST['password'], $_POST['email']);
       Session::getInstance()->setFlash('success', "Un email de confirmation vous a été envoyé pour valider votre compte" );
        App::redirectr('/account/register.php');
    }else{
       $errors = $validator->getErrors(); 
    }
}
?>

<html>
    <head>
        <title>test de presentation</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="../style.css" type="text/css">
    </head>
    <body >
        <div class="maincenter">
        <div class="main">
            
            <div class="centre">
                <?php if(Session::getInstance()->hasFlashes()):?>
                <?php foreach(Session::getInstance()->getFlashes() as $type => $message): ?>
                <div class=''>
                    <?= $message;?>
                </div>
                <?php endforeach; ?>
                <?php endif;?>
                <form method="post" action="" class="form_ident">
                    <label>Pseudo </label><br><input type='text' name='login'  ><br>
                    <label>E-mail </label><br><input type='email' name='email'  ><br>
                    <label>Mot de passe </label><br><input type='password' name='password'  ><br>
                    <label>Confirmer votre mot de passe </label><br><input type='password' name='password2'  ><br>
                <button type="submit" name="btn_register">S'inscrire</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>

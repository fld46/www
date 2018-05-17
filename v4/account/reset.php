<?php
require '../inc/bootstrap.php';
if(isset($_GET['id']) && isset($_GET['token'])){
    $auth = App::getAuth();
    $db= App::getDatabase();
    $user = $auth->checkResetToken($db, $_GET['id'], $_GET['token']);
    if($user){
        if(!empty($_POST)){
            $validator = new Validator($_POST);
            $validator->isConfirmed('password');
            if($validator->isValid()){
                
                $password = $auth->hashPassword($_POST['password']);
                $db->query('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL WHERE id =?',[$password,$_GET['id']]);
                Session::getInstance()->setFlash('success',"Votre mot de passe a bien été modifié");
                $auth->connect($user);
                App::redirect('account/account.php');
                
            }
        }
    }else{
        Session::getInstance()->setFlash('danger',"Ce token n'est pas valide");
        App::redirect('login.php');
           
    }
}else{
   App::redirect('login.php');
    
}
?>
<html>
    <head>
        <title>reinitialiser le mot de passe</title>
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
                    <label>Nouveau mot de passe </label><br><input type='password' name='password'  ><br>
                    
                    <label>Confirmer le nouveau mot de passe </label><br><input type='password' name='password2' ><br>
                    
                <button type="submit" name="btn_register">reinitialiser</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>
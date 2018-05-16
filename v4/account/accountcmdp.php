<?php
require'../inc/bootstrap.php';
$auth= App::getAuth();
$auth->restrict(Session::getInstance());

if(!empty($_POST)){

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
        $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
    }else{
        $user_id = $_SESSION['auth']->id;
        $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
        require_once 'db.php';
        $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password,$user_id]);
        $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
    }

}
?>
<html>
    <head>
        <title>changer le mot de passe</title>
        <meta charset="UTF-8">
        
        <link rel="stylesheet" href="style.css" type="text/css">
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
                    
                    <label>Confirmer le nouveau mot de passe </label><br><input type='password' name='password_confirm' ><br>
                    
                <button type="submit" name="btn_register">changer</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>


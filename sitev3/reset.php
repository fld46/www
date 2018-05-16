<?php
if(isset($_GET['id']) && isset($_GET['token'])){
    require 'db.php';
    require 'function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                $_SESSION['auth'] = $user;
                header('Location: index.php');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['error'] = "Ce token n'est pas valide";
        header('Location: index.php');
        exit();
    }
}else{
    header('Location: index.php');
    exit();
}
?>
<html>
    <head>
        <title>reinitialiser le mot de passe</title>
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
                    
                <button type="submit" name="btn_register">reinitialiser</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>
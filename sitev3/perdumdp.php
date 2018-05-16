<?php
if(!empty($_POST) && !empty($_POST['email'])){
    require_once 'db.php';
    require_once 'function.php';
    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        session_start();
        $reset_token = str_random(60);
        $pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par emails';
        mail($_POST['email'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://192.168.0.1/sitev3/reset.php?id={$user->id}&token=$reset_token");
        header('Location: index.php');
        exit();
    }else{
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cet adresse';
    }
}
?>
<html>
    <head>
        <title>Reinitialiser le mdp</title>
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
                    <label>E-mail</label><br><input type='mail' name='email'  ><br>
                    
                    
                    
                <button type="submit" name="btn_register">reinitialiser</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>

<?php
require 'function.php';
require_once 'db.php';
if (!empty($_POST)){
    
    $errors=array();
    
    if(empty($_POST['login'])||!preg_match('/^[a-z0-9A-Z_]+$/', $_POST['login'])){
        
        $errors['login'] = "Votre pseudo n'est pas valide";
    }else{
        $req=$pdo->prepare('SELECT id FROM users WHERE login = ?');
        $req->execute([$_POST['login']]);
        $user=$req->fetch();
        if($user){
            $errors['username']= 'Ce pseudo est deja pris';
        }
    }
    if(empty($_POST['mail'])|| !filter_var($_POST['mail'],FILTER_VALIDATE_EMAIL)){
        
        $errors['mail'] = "Votre e-mail n'est pas valide";
    }else{
        $req=$pdo->prepare('SELECT id FROM users WHERE email = ?');
        $req->execute([$_POST['mail']]);
        $mail=$req->fetch();
        if($mail){
            $errors['mail']= 'Cet e-mail est deja utilisé pour un autre compte';
        }
    }
        
    if(empty($_POST['password'])||$_POST['password']!=$_POST['password2']){
        
        $errors['password'] = "Vous devez rentrer un mot de passe";
    }
    
    if(empty($errors)){
        
        $req=$pdo->prepare('INSERT INTO users SET login = ?, password= ?, email = ?, confirmation_token = ?');
        $password= password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token=str_random(60);
        $req->execute([$_POST['login'],$password,$_POST['mail'], $token]);
        $user_id= $pdo->lastInsertId();
        mail($_POST['mail'], 'Confirmation de votre inscription', "Afin de completer votre inscription, merci de cliquer sur ce liens : \n\n http://192.168.0.1/sitev3/confirm.php?id=".$user_id."&token=".$token."");
        header('location: index.php');
        exit();
        die('Votre compte a bien été créee');
    }
}
?>
<html>
    <head>
        <title>test de presentation</title>
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
                    <label>Pseudo </label><br><input type='text' name='login'  ><br>
                    <label>E-mail </label><br><input type='email' name='mail'  ><br>
                    <label>Mot de passe </label><br><input type='password' name='password'  ><br>
                    <label>Confirmer votre mot de passe </label><br><input type='password' name='password2'  ><br>
                <button type="submit" name="btn_register">S'inscrire</button>  
                </form>
                
        </div>
        </div>
        </div>
        
    </body>
</html>

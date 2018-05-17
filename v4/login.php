<?php
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);
if($auth->user()){
    App::redirect('accueil.php');
}

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])){
 $user = $auth->login($db,$_POST['username'], $_POST['password'], isset($_POST['remember']));
$session = session::getInstance(); 
 if($user){
     $session->setFlash('success', 'Vous êtes maintenant connecté' );
     App::redirect('accueil.php');       
 }else{
    $session->setFlash('danger', 'Identifiant ou mot de passe incorrecte' );
    }
}


$manager = new JeuxManager($db);
?>

 <div class ="menu_gauche">
 <form method="post" class="form_ident" >
     <fieldset>
 <legend> Identification </legend> 
 <?php
 if(isset($error))
  {
 ?>
 <div class="alert alert-danger">
  <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
 </div>
 <?php
  }
 ?>
 <br>
 <div > 
 <input class="formin" type="text"  name="username" placeholder="Username" />
 <input class="formin" type="password"  name="password" placeholder="Your Password" />
 </div>
  <button type="submit" name="btn-login" >&nbsp;LOGIN</button>
  <a href="account/register.php">register</a><br>
  <a href="account/perdumdp.php">perdu mon mdp</a>
 <br/>
 </fieldset>
 </form>
 </div>     
 <div class="droitec">
     <div class="droiteint">
        <table class="droit">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th class="temps">Temps</th>
                    <th class="">Difficulte</th>
                    <th >Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixec">
        <?php
        $manager->getListnonident();
        ?>
        </tbody>
    </table>
    </div>
 </div>
</body>
</html>
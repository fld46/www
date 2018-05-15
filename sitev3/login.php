<?php
require_once 'Dbconfig.php';
require 'jeuxmanager.class.php';
require 'jeux.class.php';

if($user->is_loggedin()!="")
{
  $_SESSION['page']='accueil.php'; 
  $user->redirect('index.php');
}

if(isset($_POST['btn-login']))
{
 $lname = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];

 if($user->login($lname,$upass))
 {
  $_SESSION['page']='accueil.php'; 
  $user->redirect('index.php');
  }
  
 else
 {
  $error = "Mauvais identifiant/mot de passe !";
 }
}


$db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
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
 <input class="formin" type="text"  name="txt_uname_email" placeholder="Username" />
 <input class="formin" type="password"  name="txt_password" placeholder="Your Password" />
 </div>
  <button type="submit" name="btn-login" >&nbsp;LOGIN</button>
  <a href="register.php">register</a>
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
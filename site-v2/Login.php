<?php
require_once 'Dbconfig.php';
require 'jeuxmanager.class.php';
require 'jeux.class.php';
//session_start();

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
?>
<html>
<head>
 <link rel="stylesheet" href="style.css"type="text/css"/>   
</head>
<body>
 <div class ="gauche">
 <form method="post" class="form_ident">
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
 <div>
 <input class="formin" type="text"  name="txt_uname_email" placeholder="Username" required />
 </div>
 
 <div>
 <input class="formin" type="password"  name="txt_password" placeholder="Your Password" required />
 </div>

 <div>
 <button type="submit" name="btn-login" >&nbsp;LOGIN</button>
 </div>
 <br/>
 </fieldset>
 </form>
 </div>     
 <div class="droitel">
    <table class="bas">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixeb">
        <?php
        $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
        $manager = new JeuxManager($db);
        $manager->getListnonident();
        ?><!--<tr>
        <td><a href=''>Titre</a></td>
        <td>Temps</td>
        <td>Difficulte</td>
        <td>Multi</td>
        <td><div>Console</div></td>
        <td>User</td>
        </tr>-->
        </tbody>
    </table>
    </div>
</body>
</html>


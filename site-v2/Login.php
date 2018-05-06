<?php
require_once 'Dbconfig.php';
if($user->is_loggedin()!="")
{
 $user->redirect('index.php');
}

if(isset($_POST['btn-login']))
{
 $lname = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];

 if($user->login($lname,$upass))
 {
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
 <form method="post" class="ident" >
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
 <div>
 <input type="text"  name="txt_uname_email" placeholder="Username" required />
 </div>
 <div>
 <input type="password"  name="txt_password" placeholder="Your Password" required />
 </div>
 <div>
 <button type="submit" name="btn-login" >&nbsp;LOGIN</button>
 </div>
 <br/>
 </fieldset>
 </form>
</body>
</html>


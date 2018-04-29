
<?php

require_once 'dbconfig.php';

if($user->is_loggedin()!="")
{
 $user->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
 $lname = $_POST['txt_uname_email'];
 $umail = $_POST['txt_uname_email'];
 $upass = $_POST['txt_password'];

 if($user->login($lname,$upass))
 {
  $user->redirect('home.php');
 }
 else
 {
  //echo $lname;
  //echo $upass;
  $error = "Wrong Details !";
 }
}
?>
<html>
<head></head>
<body>
<div class="container" align=center>
     <div>
        <form method="post">
            <h2>Sign in.</h2>
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
            <div></div>
            <div>
             <button type="submit" name="btn-login" >
                 &nbsp;SIGN IN
                </button>
            </div>
            <br />
               <!-- <label>Don't have account yet ! <a href="sign-up.php">Sign Up</a></label>-->
            </form>
       </div>
</div>
 </body>
</html>

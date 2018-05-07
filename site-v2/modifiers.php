
<?php
session_start();
require_once 'Dbconfig.php';

if($user->is_loggedin()!="")
{
$_SESSION['page']='modifier.php';
$user->redirect('index.php');
}
?>



<?php

session_start();
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
if(!isset($_POST['selectj'])){
echo'
<FORM method="post">';
//<SELECT name="titrejeux" >';
//$manager->delete();
//echo '
//</SELECT>
echo '<input list="titrejeu" type="text"  name="titrejeux">
<datalist id="titrejeu">';
  $manager->listej();
echo '</datalist>
<div>
<button type="submit" name="selectj" >
select
</button>
</div>
</FORM>
<script src="datalist-polyfill.min.js"></script>';


}
if(isset($_POST['selectj']))
{
 $mtitre = $_POST['titrejeux'];
 $manager->get($mtitre,$_SESSION['login'],$_SESSION['login']);

}
if(isset($_POST['modifierj']))
{
 $idt = $_POST['id'];
 $manager->updateJeux($idt);
 //header("Location: modifier.php");


}
$home= new Liens();
$home->lien('home');
?>





<html>
<head>
<link rel="stylesheet" href="style.css"type="text/css"/>   
</head>
<body>  
<?php
session_start();
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
if(!isset($_POST['selectj'])){
echo'
<FORM method="post" class="ident">
<fieldset>
<legend> Selectionner          
</legend>
<div class="home">';
$home= new Liens();
$home->lien('home');
echo '</div>
<input list="titrejeu" type="text"  name="titrejeux">
<datalist id="titrejeu">';
$manager->listej();
echo '</datalist>
<div>
<button type="submit" name="selectj" >
select
</button>
</div>
</fieldset>
</FORM>
<script src="datalist-polyfill.min.js"></script>';
}
if(isset($_POST['selectj']))
{
 $mtitre = $_POST['titrejeux'];
 echo'
<FORM method="post" class="ident">
<fieldset>
<legend> modifier          
</legend>
<div class="home">';
$home= new Liens();
$home->lien('home');
echo '</div>';
$manager->get($mtitre,$_SESSION['login'],$_SESSION['login']);
echo '
<button type="submit" name="modifierj" >
modifier
</button>
</div>
</fieldset>
</FORM>';
 

}
if(isset($_POST['modifierj']))
{
 $idt = $_POST['id'];
 $manager->updateJeux($idt);
 
}
?>
</body>
</html>


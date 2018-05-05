<html>
<head>
<link rel="stylesheet" href="style.css"type="text/css"/>    
</head>
<body>
<?php
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'Liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
if(isset($_POST['deletej']))
{
 $dtitre = $_POST['titrejeux'];
 $manager->deletej($dtitre);
}
?>
<FORM method="post" class="ident">
<fieldset>
    <legend>Supprimer</legend>
    <div class='home'>
     <?php
     $home= new Liens();
     $home->lien('home');
     ?>   
    </div>    
<SELECT name="titrejeux" >
<?php
$manager->delete();
?></SELECT>
<div>
<button type="submit" name="deletej" >
delete
</button>
</div>
</fieldset>        
</FORM>

</body>
</html>



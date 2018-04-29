<?php
require 'jeux.class.php';
require 'jeuxmanager.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
if(isset($_POST['deletej']))
{
 $dtitre = $_POST['titrejeux'];
 $manager->deletej($dtitre);
}

?>
<FORM method="post">
<SELECT name="titrejeux" >
<?php
$manager->delete();
?></SELECT>
<div>
<button type="submit" name="deletej" >
delete
</button>
</div>
</FORM>





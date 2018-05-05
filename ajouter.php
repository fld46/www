<html>
    <head>
    <link rel="stylesheet" href="style.css"type="text/css"/>   
    </head>
<body>
<?PHP
session_start();
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';
require 'Liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);

if ($_SESSION['login'] == 'tristan'){
   $login = 'finit';
   //$col = 'setTristan($_POST[\'tristan\'])';
}
if ($_SESSION['login'] == 'fred'){
   $login = 'fini';
}
if (isset($_POST['ajouterj']))
{
$jeuxa = new Jeux();
$jeuxa->setTitre($_POST['titre']);
$jeuxa->setTemps($_POST['temps']);
$jeuxa->setDifficulte($_POST['difficulte']);
$jeuxa->setMulti($_POST['multi']);
if(isset($_POST['fini']))
{
$jeuxa->setFini($_POST['fini']);
}
if(isset($_POST['finit'])){
$jeuxa->setFinit($_POST['finit']);
}
//$jeuxa->setFini($_POST['fini']);
$jeuxa->setPs4($_POST['ps4']);
$jeuxa->setPs3($_POST['ps3']);
$jeuxa->setPsvita($_POST['psvita']);
$jeuxa->setLiens($_POST['liens']);
if (($_SESSION['login']== 'fred')){
$jeuxa->setFred($_POST['fred']);
$jeuxa->setTristan($_POST['tristan']);
$jeuxa->setJo($_POST['jo']);
}
else{
$jeuxa->setTristan($_POST['tristan']);    
}
$manager->add($jeuxa, $login);
}
?>
<FORM method="post" class="ident">
<fieldset>
<legend> Ajouter          
</legend>     
<div class="home"><?php
$home = new Liens();
$home->lien('home');
?>
</div>
<p>
        <label>Titre</label> : <input type="text"  name="titre" required/>
</p>
<p>
        <label>Temps</label> : <input type="number"  style="width:50px" maxlength="4" max="9999"  name="temps"  />
</p>
<p>
        <label>Difficulte</label> : <input type="number" style="width:35px" min="1" max="10" name="difficulte" />
</p>
<p>
        <label>Multi</label> : <input type="radio" name="multi" value="oui" />Oui<input type="radio" name="multi" value="non" />Non
</p>
<?php
if (($_SESSION['login']) == "fred"){
echo'<p>
        <label>Fini</label> : <input type="radio" name="fini" value="oui" />Oui<input type="radio" name="fini" value="non" />Non
</p>';
}
if (($_SESSION['login']) == "tristan"){
echo'<p>
        <label>Fini</label> : <input type="radio" name="finit" value="oui" />Oui<input type="radio" name="finit" value="non" />Non
</p>';
}        
?>
<p>
        <label>Ps4</label> : <input type="radio" name="ps4" value="oui" />Oui<input type="radio" name="ps4" value="non" />Non
</p>
<p>
        <label>Ps3</label> : <input type="radio" name="ps3" value="oui" />Oui<input type="radio" name="ps3" value="non" />Non
</p>
<p>
        <label>Psvita</label> : <input type="radio" name="psvita" value="oui" />Oui<input type="radio" name="psvita" value="non" />Non
</p>
<p>
        <label>liens</label> : <input type="url" name="liens"/>
</p>
<?php
if(($_SESSION['login'] == 'fred')){
echo '<p>
        <label>Fred</label> : <input type="radio" name="fred" value="oui" />Oui<input type="radio" name="fred" value="non" />Non
</p>
<p>
        <label>Tristan</label> : <input type="radio" name="tristan" value="oui" />Oui<input type="radio" name="tristan" value="non" />Non
</p>
<p>
        <label>Jo</label> : <input type="radio" name="jo" value="oui" />Oui<input type="radio" name="jo" value="non" />Non
</p>';
}
else{
echo '<p>
        <label>'.$_SESSION['login'].'</label> : <input type="radio" name="'.$_SESSION['login'].'" value="oui" />Oui<input type="radio" name="'.$_SESSION['login'].'" value="non" />Non
</p>';

}    

?>        
<button type="submit" name="ajouterj" >
ajouter
</button>
</fieldset>
</FORM>
</body>
</html>

<?PHP
session_start();
require 'jeux.class.php';
require 'jeuxmanager.class.php';
require 'user.class.php';
require 'liens.class.php';
$db = new PDO('mysql:host=localhost;dbname=jeux', 'root' );
$manager = new JeuxManager($db);
if (isset($_POST['ajouterj']))
{
$jeuxa = new Jeux();
$jeuxa->setTitre($_POST['titre']);
$jeuxa->setTemps($_POST['temps']);
$jeuxa->setDifficulte($_POST['difficulte']);
$jeuxa->setMulti($_POST['multi']);
$jeuxa->setPs4($_POST['ps4']);
$jeuxa->setPs3($_POST['ps3']);
$jeuxa->setPsvita($_POST['psvita']);
$jeuxa->setLiens($_POST['liens']);
$jeuxa->setFred($_POST['fred']);
$jeuxa->setTristan($_POST['tristan']);
$jeuxa->setJo($_POST['jo']);
$manager->add($jeuxa);
}?>
<FORM method="post">
<p>
        <label>Titre</label> : <input type="text" size="300" name="titre" required/>
</p>
<p>
        <label>Temps</label> : <input type="number" size="4" max="9999"  name="temps" required />
</p>
<p>
        <label>Difficulte</label> : <input type="number" min="1" max="10" name="difficulte" required/>
</p>
<p>
        <label>Multi</label> : <input type="text" name="multi" required/>
</p>
<p>
        <label>Ps4</label> : <input type="text" name="ps4" required/>
</p>
<p>
        <label>Ps3</label> : <input type="text" name="ps3" required/>
</p>
<p>
        <label>Psvita</label> : <input type="text" name="psvita" required/>
</p>
<p>
        <label>liens</label> : <input type="url" name="liens" required/>
</p>
<p>
        <label>Fred</label> : <input type="text" name="fred" required/>
</p>
<p>
        <label>Tristan</label> : <input type="text" name="tristan" required/>
</p>
<p>
        <label>Jo</label> : <input type="text" name="jo" required/>
</p>
<button type="submit" name="ajouterj" >
ajouter
</button>

</FORM>
<?php
$home = new Liens();
$home->lien('home');
?>

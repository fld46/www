<?php
class JeuxManager
{
private $_db;
private $_login;


public function __construct($db)
{
$this->setDb($db);
}
public function add(Jeux $jeux, $login)
{
if(($_SESSION['login']) == 'fred');{
$q = $this->_db->prepare('INSERT INTO jeux SET titre =:titre, temps = :temps, difficulte = :difficulte, multi = :multi, '.$login.' = :fini, ps4 = :ps4, ps3 = :ps3, psvita= :psvita, liens = :liens, fred = :fred, tristan = :tristan, jo = :jo');
$q->bindValue(':titre', $jeux->titre());
$q->bindValue(':temps', $jeux->temps(),PDO::PARAM_INT);
$q->bindValue(':difficulte', $jeux->difficulte(), PDO::PARAM_INT);
$q->bindValue(':multi', $jeux->multi());
$q->bindValue(':fini', $jeux->$login());
$q->bindValue(':ps4', $jeux->ps4());
$q->bindValue(':ps3', $jeux->ps3());
$q->bindValue(':psvita', $jeux->psvita());
$q->bindValue(':liens', $jeux->liens());
$q->bindValue(':fred', $jeux->fred());
$q->bindValue(':tristan', $jeux->tristan());
$q->bindValue(':jo', $jeux->jo());
$q->execute();
}
if(($_SESSION['login']) == 'tristan');{
$q = $this->_db->prepare('INSERT INTO jeux SET titre =:titre, temps = :temps, difficulte = :difficulte, multi = :multi, '.$login.' = :fini, ps4 = :ps4, ps3 = :ps3, psvita= :psvita, liens = :liens, '.$_SESSION['login'].' = :jeuxapp');
$q->bindValue(':titre', $jeux->titre());
$q->bindValue(':temps', $jeux->temps(),PDO::PARAM_INT);
$q->bindValue(':difficulte', $jeux->difficulte(), PDO::PARAM_INT);
$q->bindValue(':multi', $jeux->multi());
$q->bindValue(':fini', $jeux->$login());
$q->bindValue(':ps4', $jeux->ps4());
$q->bindValue(':ps3', $jeux->ps3());
$q->bindValue(':psvita', $jeux->psvita());
$q->bindValue(':liens', $jeux->liens());
$q->bindValue(':jeuxapp', $jeux->tristan());
//var_dump($appj);
//$var_dump($jeux);
$q->execute();  
}

}
public function listej()
//public function delete(Jeux $perso)
{
//if (isset($dtitre))
//{
//$q = $this->_db->prepare('DELETE FROM jeux WHERE titre='.$dtitre.'');
//$q->execute();
//echo 'lol';
//}
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
{
$jeux = new Jeux();
$jeux->hydrate($donnees);
echo '<option value="'.$jeux->titre().'">';
}
return $jeux;
}
 
public function delete()
//public function delete(Jeux $perso)
{
//if (isset($dtitre))
//{
//$q = $this->_db->prepare('DELETE FROM jeux WHERE titre='.$dtitre.'');
//$q->execute();
//echo 'lol';
//}
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
{
$jeux = new Jeux();
$jeux->hydrate($donnees);
echo '<option>'.$jeux->titre().'</option>';
}
return $jeux;
}
 public function deletej($dtitre)
//public function delete(Jeux $perso)
{
if (isset($dtitre))
{
$q = $this->_db->prepare('DELETE FROM jeux WHERE titre="'.$dtitre.'"');
$q->execute();
}


}

public function verifRadio(Jeux $radioj,$input)
{
if ($input == 'finit'){
    $inputlabel = 'Fini';
}else{
    $inputlabel = $input;
    $inputlabel = ucfirst($inputlabel);
}
if ($radioj->$input() == "oui"){
echo'<p>
        <label>'.$inputlabel.'</label> : <input type="radio" name="'.$input.'" value="oui" checked required/>Oui<input type="radio" name="'.$input.'" value="non" required/>Non
</p>';    
}
if(($radioj->$input() == "non")||($radioj->$input() == "")){
echo'<p>
        <label>'.$inputlabel.'</label> : <input type="radio" name="'.$input.'" value="oui" required/>Oui<input type="radio" name="'.$input.'" value="non" checked required/>Non
</p>';    
}
    
}
public function get($tjeux, $login, $ident)
{
if ($login == 'fred'){
   $login = 'fini';
   $this->_login = $login;
}
if ($login == 'tristan'){
   $login = 'finit';
   $this->_login = $login;
}
    
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux WHERE titre="'.$tjeux.'"');

while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
{
$jeux = new Jeux();
$jeux->hydrate($donnees);
echo '
<FORM method="post">
 <p>
        <input type="hidden" size="3" name="id"  value="'.$jeux->id().'"required/>
</p>
<p>
        <label>Titre</label> : <input type="text" size="300" name="titre"  value="'.$jeux->titre().'"required/>
</p>
<p>
        <label>Temps</label> : <input type="number" size="4" max="9999"  name="temps"  value="'.$jeux->temps().'" />
</p>
<p>
        <label>Difficulte</label> : <input type="number"  max="10" name="difficulte" value="'.$jeux->difficulte().'" />
</p>';
//<p>
//        <label>Multi</label> : <input type="text" name="multi"  value="'.$jeux->multi().'"/>
//</p>';
//<p>
//       <label>Fini </label> : <input type="text" name="'.$login.'" value="'.$jeux->$login().'"required/>
//</p>

  //      <p>
    //    <label>Ps4</label> : <input type="text" name="ps4"  value="'.$jeux->ps4().'"required/>
//</p>
$this->verifRadio($jeux, 'multi');
$this->verifRadio($jeux, 'ps4');
$this->verifRadio($jeux, 'ps3');
$this->verifRadio($jeux, 'psvita');
$this->verifRadio($jeux, $ident);
$this->verifRadio($jeux, $login);

/*<p>
        <label>Ps3</label> : <input type="text" name="ps3"  value="'.$jeux->ps3().'"required/>
</p>
<p>
        <label>Psvita</label> : <input type="text" name="psvita"  value="'.$jeux->psvita().'"required/>
</p>*/
echo'
<p>
        <label>Liens</label> : <input type="url" name="liens"  value="'.$jeux->liens().'"/>
</p>';

//<p>
//        <label>Fred</label> : <input type="text" name="'.$ident.'"  value="'.$jeux->$ident().'"required/>
//</p>
echo'<button type="submit" name="modifierj" >
modifier
</button>

</FORM>

';
}
return $jeux;
// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
//$id =  (int)$id;
//$q = $this->_db->query('SELECT * FROM jeux WHERE id = '.$id);
//$donnees = $q->fetch(PDO::FETCH_ASSOC);
//return new Jeux($donnees);
}

//public function get($id)
//{
// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
//$id = (int) $id;
//$q = $this->_db->query('SELECT * FROM jeux WHERE id = '.$id);
//$donnees = $q->fetch(PDO::FETCH_ASSOC);
//return new Jeux($donnees);
//}
public function updateJeux($idj)
{
if ($_SESSION['login'] == 'fred'){
   $login = 'fini';
   $this->_login = $login;
}
if ($_SESSION['login'] == 'tristan'){
   $login = 'finit';
   $this->_login = $login;
}
//$q = $this->_db->prepare('UPDATE jeux SET titre ="'.$_POST['titre'].'", temps ="'.$_POST['temps'].'", difficulte ="'.$_POST['difficulte'].'", multi ="'.$_POST['multi'].'", fini ="'.$_POST['fini'].'", finit ="'.$_POST['finit'].'", ps4 ="'.$_POST['ps4'].'", ps3 ="'.$_POST['ps3'].'", psvita="'.$_POST['psvita'].'", liens ="'.$_POST['liens'].'", fred ="'.$_POST['fred'].'", tristan ="'.$_POST['tristan'].'", jo ="'.$_POST['jo'].'" WHERE id="'.$idj.'"');
$q = $this->_db->prepare('UPDATE jeux SET titre ="'.$_POST['titre'].'", temps ="'.$_POST['temps'].'", difficulte ="'.$_POST['difficulte'].'", multi ="'.$_POST['multi'].'", '. $this->_login.' ="'.$_POST[''.$this->_login.''].'", ps4 ="'.$_POST['ps4'].'", ps3 ="'.$_POST['ps3'].'", psvita="'.$_POST['psvita'].'", liens ="'.$_POST['liens'].'", '.$_SESSION['login'].' ="'.$_POST[''.$_SESSION['login'].''].'" WHERE id="'.$idj.'"');
$q->execute();
}

public function getList()
{
// ordre_var = (defiiculte, titre, ps4)
$jeux = array();
if ($_SESSION['tri']!=""){
    $_SESSION['trieffectif']='ORDER BY '.$_SESSION['tri'];
    $_SESSION['trieffectif']= rtrim($_SESSION['trieffectif'], ",");
    
}else{
    $_SESSION['trieffectif']='';
}
// $q = $this->_db->query('SELECT * FROM jeux WHERE '.$_SESSION['login'].'="oui" ORDER BY ordre_var(1) ORDER BY ordre_var(2) ORDER BY ordre_var(3)')
$q = $this->_db->query('SELECT * FROM jeux WHERE '.$_SESSION['login'].'="oui" '.$_SESSION['trieffectif']);
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
{
$jeux = new Jeux();
$jeux->hydrate($donnees);
echo '<tr><td><a href='.$jeux->liens().'>'.$jeux->titre().'</a></td><td>'.$jeux->temps().'</td><td>'.$jeux->difficulte().'</td><td>'.$jeux->multi().'</td><td>'.$jeux->fini().'</td><td>'.$jeux->finit().'</td><td>'.$jeux->ps4().'</td><td>'.$jeux->ps3().'</td><td>'.$jeux->psvita().'</td><td>'.$jeux->fred().'</td><td>'.$jeux->tristan().'</td><td>'.$jeux->jo().'</td></tr>';
}
return $jeux;
}
public function update(Jeux $perso)
{
// Prépare une requête de type UPDATE.
// Assignation des valeurs à la requête.
// Exécution de la requête.
}
public function setDb(PDO $db)
{
$this->_db = $db;
}
}

?>


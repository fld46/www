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
$q->execute();  
}
}
public function listej()
{
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
{
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
{
if (isset($dtitre))
    {
    $q = $this->_db->prepare('DELETE FROM jeux WHERE titre="'.$dtitre.'"');
    $q->execute();
    }
}

public function verifRadio(Jeux $radioj,$input)
{
if ($input == 'finit')
    {
    $inputlabel = 'Fini';
    }
else{
    $inputlabel = $input;
    $inputlabel = ucfirst($inputlabel);
}
if ($radioj->$input() == "oui")
    {
    echo'<p>
    <label>'.$inputlabel.'</label> : <input type="radio" name="'.$input.'" value="oui" checked required/>Oui<input type="radio" name="'.$input.'" value="non" required/>Non
    </p>';    
    }
if(($radioj->$input() == "non")||($radioj->$input() == ""))
    {
    echo'<p>
    <label>'.$inputlabel.'</label> : <input type="radio" name="'.$input.'" value="oui" required/>Oui<input type="radio" name="'.$input.'" value="non" checked required/>Non
    </p>';    
    }
}

public function get($tjeux, $login, $ident)
{
if ($login == 'fred')
    {
   $login = 'fini';
   $this->_login = $login;
    }
if ($login == 'tristan')
        {
   $login = 'finit';
   $this->_login = $login;
    }
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux WHERE titre="'.$tjeux.'"');

while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    echo'
    <p>
    <input type="hidden" size="3" name="id"  value="'.$jeux->id().'"required/>
    </p>
    <p>
    <label>Titre</label> : <input type="text"  name="titre"  value="'.$jeux->titre().'"required/>
    </p>
    <p>
    <label>Temps</label> : <input type="number" size="4" max="9999"  name="temps"  value="'.$jeux->temps().'" />
    </p>
    <p>
    <label>Difficulte</label> : <input type="number"  max="10" name="difficulte" value="'.$jeux->difficulte().'" />
    </p>';
    $this->verifRadio($jeux, 'multi');
    $this->verifRadio($jeux, 'ps4');
    $this->verifRadio($jeux, 'ps3');
    $this->verifRadio($jeux, 'psvita');
    $this->verifRadio($jeux, $ident);
    $this->verifRadio($jeux, $login);
    echo '<p>
    <label>Liens</label> : <input type="url" name="liens"  value="'.$jeux->liens().'"/>
    </p>';
    }
return $jeux;
}

public function updateJeux($idj)
{
if ($_SESSION['login'] == 'fred')
    {
   $login = 'fini';
   $this->_login = $login;
    }
if ($_SESSION['login'] == 'tristan')
    {
   $login = 'finit';
   $this->_login = $login;
    }
$q = $this->_db->prepare('UPDATE jeux SET titre ="'.$_POST['titre'].'", temps ="'.$_POST['temps'].'", difficulte ="'.$_POST['difficulte'].'", multi ="'.$_POST['multi'].'", '. $this->_login.' ="'.$_POST[''.$this->_login.''].'", ps4 ="'.$_POST['ps4'].'", ps3 ="'.$_POST['ps3'].'", psvita="'.$_POST['psvita'].'", liens ="'.$_POST['liens'].'", '.$_SESSION['login'].' ="'.$_POST[''.$_SESSION['login'].''].'" WHERE id="'.$idj.'"');
$q->execute();
}

public function getList()
{
$jeux = array();
if ($_SESSION['tri']!="")
    {
    $_SESSION['trieffectif']='ORDER BY '.$_SESSION['tri'];
    $_SESSION['trieffectif']= rtrim($_SESSION['trieffectif'], ",");
    }
else
    {
    $_SESSION['trieffectif']='';
    }
$q = $this->_db->query('SELECT * FROM jeux' );
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
   
    if (($jeux->multi())=="oui"){
        $multi='oui.png';
    }else{
        $multi='non.png';
    }
    if(($jeux->ps4())=="oui"){
        $ps4='<span class="ps4">&nbsp;PS4&nbsp;</span>';
    }
    else{
       $ps4=''; 
    }
    if(($jeux->ps3())=="oui"){
        $ps3='<span class="ps3">&nbsp;PS3&nbsp;</span>';
    }
    else{
       $ps3=''; 
    }
    if(($jeux->psvita())=="oui"){
        $psvita='<span class="psvita">&nbsp;PS vita&nbsp;</span>';
    }
    else{
       $psvita=''; 
    }
    echo 
    '<tr>
     <td><a href='.$jeux->liens().'>'.$jeux->titre().'</a></td>
     <td>'.$jeux->temps().'</td>
     <td>'.$jeux->difficulte().'</td>
     <td><img src='.$multi.' class="valid"></td>
     <td>'.$ps4.'
     '.$ps3.'
     '.$psvita.'
     
     </tr>';
    }
return $jeux;
}

public function setDb(PDO $db)
{
$this->_db = $db;
}

}

?>


<?php
class JeuxManager
{
private $_db; // Instance de PDO.

public function __construct($db)
{
$this->setDb($db);
}
public function add(Jeux $jeux )
{
// Préparation de la requête d'insertion.
// Assignation des valeurs pour le nom, la force, les dégâts,l'expérience et le niveau du personnage.
// Exécution de la requête.
$q = $this->_db->prepare('INSERT INTO jeux SET titre =:titre, temps = :temps, difficulte = :difficulte, multi = :multi, ps4 = :ps4, ps3 = :ps3, psvita= :psvita, liens = :liens, fred = :fred, tristan = :tristan, jo = :jo');
$q->bindValue(':titre', $jeux->titre());
$q->bindValue(':temps', $jeux->temps(),PDO::PARAM_INT);
$q->bindValue(':difficulte', $jeux->difficulte(), PDO::PARAM_INT);
$q->bindValue(':multi', $jeux->multi());
$q->bindValue(':ps4', $jeux->ps4());
$q->bindValue(':ps3', $jeux->ps3());
$q->bindValue(':psvita', $jeux->psvita());
$q->bindValue(':liens', $jeux->liens());
$q->bindValue(':fred', $jeux->fred());
$q->bindValue(':tristan', $jeux->tristan());
$q->bindValue(':jo', $jeux->jo());
$q->execute();

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


public function get($id)
{
// Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
$id = (int) $id;
$q = $this->_db->query('SELECT * FROM jeux WHERE id = '.$id);
$donnees = $q->fetch(PDO::FETCH_ASSOC);
return new Jeux($donnees);
}
public function getList()
{

$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux WHERE '.$_SESSION['login'].'="oui" ORDER BY difficulte');
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


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

$q = $this->_db->prepare('INSERT INTO jeux SET titre =:titre, temps = :temps, difficulte = :difficulte, multi = :multi,  ps4 = :ps4, ps3 = :ps3, psvita= :psvita, liens = :liens');
$q->bindValue(':titre', $jeux->titre());
$q->bindValue(':temps', $jeux->temps(),PDO::PARAM_INT);
$q->bindValue(':difficulte', $jeux->difficulte(), PDO::PARAM_INT);
$q->bindValue(':multi', $jeux->multi());
$q->bindValue(':ps4', $jeux->ps4());
$q->bindValue(':ps3', $jeux->ps3());
$q->bindValue(':psvita', $jeux->psvita());
$q->bindValue(':liens', $jeux->liens());
$q->execute();

$q3 = $this->_db->query('SELECT * FROM jeux WHERE titre="'.$jeux->titre().'"');
while ($donnees = $q3->fetch(PDO::FETCH_ASSOC))
    {
    $idjeux = $donnees['id'];
    }
$q2 = $this->_db->prepare('INSERT INTO maintable SET idjeux =:idjeux, idusers = :idusers, possede = :possede, fini = :fini');
$q2->bindValue(':idusers', $_SESSION['user_session']);
$q2->bindValue(':idjeux', $idjeux);
$q2->bindValue(':possede', $jeux->possede());
$q2->bindValue(':fini', $jeux->fini());
$q2->execute();



}
public function listej()
{
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    $_SESSION['idjeuxs']=$jeux->id();
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
    $q = $this->_db->query('SELECT * FROM jeux WHERE titre="'.$dtitre.'"');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeuxad = new Jeux();
    $jeuxad->hydrate($donnees);
    
    }
    $q2 = $this->_db->query('DELETE FROM maintable WHERE idjeux="'.$jeuxad->id().'"');
    $q3 = $this->_db->query('DELETE FROM jeux WHERE titre="'.$jeuxad->titre().'"');
    //$q = $this->_db->prepare('DELETE  FROM jeux WHERE titre="'.$dtitre.'"');
    $q2->execute();
    $q3->execute();
    }
}

public function verifRadio(Jeux $radioj,$input)
{
    $inputlabel = $input;
    $inputlabel = ucfirst($inputlabel);

if ($radioj->$input() == "oui")
    {
    echo'
    <input type="radio" name="'.$input.'" value="oui" checked required/>Oui<input type="radio" name="'.$input.'" value="non" required/>Non
    ';    
    }
if(($radioj->$input() == "non")||($radioj->$input() == ""))
    {
    echo'
    <input type="radio" name="'.$input.'" value="oui" required/>Oui<input type="radio" name="'.$input.'" value="non" checked required/>Non
    ';    
    }
}
public function verifChkbox(Jeux $radioj,$input)
{
    $inputlabel = $input;
    $inputlabel = ucfirst($inputlabel);

if ($radioj->$input() == "oui")
    {
    echo'
    <input type="checkbox" name="'.$input.'" value="oui" checked />
    ';    
    }
if(($radioj->$input() == "non")||($radioj->$input() == ""))
    {
    echo'
    <input type="checkbox" name="'.$input.'" value="oui"  />
    ';    
    }
}

public function get($titre, $login, $ident)
{

$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux WHERE titre="'.$titre.'"');

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
        $ps4='<div class="ps4">&nbsp;PS4&nbsp;</div>';
    }
    else{
       $ps4=''; 
    }
    if(($jeux->ps3())=="oui"){
        $ps3='<div class="ps3">&nbsp;PS3&nbsp;</div>';
    }
    else{
       $ps3=''; 
    }
    if(($jeux->psvita())=="oui"){
        $psvita='<div class="psvita">&nbsp;VITA&nbsp;</div>';
    }
    else{
       $psvita=''; 
    }
    echo'
    
    <div class ="gauche">
        <form method="post">
            <fieldset><legend>Selectionner</legend>
            <br><input list="titrejeu" type="text"  name="titrejeux"/>
                    <datalist id="titrejeu">';
                    $this->listej();   
                    echo'</datalist>
               
                <br><br>
                <button class="tri" name="selectj">SELECT<BUTTon>
            </fieldset>
        </form>    
    </div>
    <div class="droite">
    <table class="bas">
        <thead>
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tr>
        <form method="post">
        <td><input type="text" name="titrejeux" value="'.$jeux->titre().'"></td>
        <td>'.$jeux->temps().'</td>
        <td>'.$jeux->difficulte().'</td>
        <td><img src='.$multi.' class="valid">
        </td>
        <td>'.$ps4.$ps3.$psvita.'</td>
        
        </tr>
    </table>
    </div>
    </div>
    <button type="submit" class="delete" name="supj" >Delete</button>
    </form>
    <script src="datalist-polyfill.min.js"></script>
';
             

    }
return $jeux;
}
public function getm($titre, $login, $ident)
{
$qv = $this->_db->query('SELECT COUNT(*) FROM jeux AS J,maintable AS M WHERE J.titre="'.$titre.'" AND M.idjeux=J.id');
$testv = $qv->fetch();
//var_dump($testv);
if($testv['0'] =='0'){
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre="'.$titre.'"');    
}else{
$q = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre="'.$titre.'" AND M.idjeux=J.id');   
}
$jeux = array();


while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    //var_dump($donnees);//echo $jeux->possede();
    //echo $jeux->fini();
    if (($jeux->multi())=="oui"){
        $multi='oui.png';
    }else{
        $multi='non.png';
    }
    if(($jeux->ps4())=="oui"){
        $ps4='<div class="ps4">&nbsp;PS4&nbsp;</div>';
    }
    else{
       $ps4=''; 
    }
    if(($jeux->ps3())=="oui"){
        $ps3='<div class="ps3">&nbsp;PS3&nbsp;</div>';
    }
    else{
       $ps3=''; 
    }
    if(($jeux->psvita())=="oui"){
        $psvita='<div class="psvita"> &nbsp;VITA&nbsp;</div>';
    }
    else{
       $psvita=''; 
    }
    //var_dump($jeux);
    echo'
    
    <div class ="gauche">
        <form method="post">
            <fieldset><legend>Selectionner</legend>
            <br><input list="titrejeu" type="text"  name="titrejeux"/>
                    <datalist id="titrejeu">';
                    $this->listej();   
                    echo'</datalist>
               
                <br><br>
                <button class="tri" name="selectj">SELECT<BUTTon>
            </fieldset>
        </form>    
    </div>
    <div class="droite">
    <table class="bas">
        <thead>
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tr>
        <form method="post">
        <td><br><input type="text" name="titre" value="'.$jeux->titre().'"><br><input type="text" name="liens" value="'.$jeux->liens().'"><br>Possede ';$this->verifChkbox($jeux, 'possede');echo 'Fini :';$this->verifChkbox($jeux, 'fini');echo'</td>
        <td><input type="number" name="temps" value="'.$jeux->temps().'"></td>
        <td><input type="number" name="difficulte" value="'.$jeux->difficulte().'"></td>
        <td>';
                    $this->verifRadio($jeux, 'multi');                   
        echo '</td>
        <td><div class="modifierj">Psvita :';
                   $this->verifChkbox($jeux, 'psvita');
        echo '</div><div class="modifierj">Ps3 :';
                   $this->verifChkbox($jeux, 'ps3');
        echo '</div><div class="modifierj">Ps4 :';
                   $this->verifChkbox($jeux, 'ps4');
        echo '</div></td>
        
        </tr>
    </table>
    </div>
    </div>
    <button type="submit" class="delete" name="modifierj" >Modifier</button>
    </form>     
    <script src="datalist-polyfill.min.js"></script>
';
    $_SESSION['tjam']=$jeux->titre();    
    }
return $jeux;
}


public function updateJeux($idj)
{
$qv = $this->_db->query('SELECT COUNT(*) FROM jeux AS J,maintable AS M WHERE J.titre="'.$idj.'" AND M.idjeux=J.id');
$testv = $qv->fetch();
//var_dump($testv);
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre="'.$idj.'" ');
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeuxad = new Jeux();
    $jeuxad->hydrate($donnees);
    
    }
if($testv['0'] =='0'){
$q2 = $this->_db->prepare('INSERT INTO maintable SET possede ="'.$_POST['possede'].'", fini ="'.$_POST['fini'].'", idjeux="'.$jeuxad->id().'" ,idusers="'.$_SESSION['user_session'].'" ');
}else{
$q2 = $this->_db->prepare('UPDATE maintable SET possede ="'.$_POST['possede'].'", fini ="'.$_POST['fini'].'" WHERE idjeux="'.$jeuxad->id().'" AND idusers="'.$_SESSION['user_session'].'" ');   
}
$q1 = $this->_db->prepare('UPDATE jeux SET titre ="'.$_POST['titre'].'", temps ="'.$_POST['temps'].'", difficulte ="'.$_POST['difficulte'].'", multi ="'.$_POST['multi'].'",  ps4 ="'.$_POST['ps4'].'", ps3 ="'.$_POST['ps3'].'", psvita="'.$_POST['psvita'].'", liens ="'.$_POST['liens'].'" WHERE id="'.$jeuxad->id().'"');
//$q2 = $this->_db->prepare('UPDATE maintable SET possede ="'.$_POST['possede'].'", fini ="'.$_POST['fini'].'" WHERE idjeux="'.$jeuxad->id().'" AND idusers="'.$_SESSION['user_session'].'" ');
$q1->execute();
$q2->execute();
//var_dump($q1);
//var_dump($q2);

}

public function getList()
{
$jeux = array();
if(!isset($_SESSION['tri'])){
  $_SESSION['tri']='';  
}

if((!isset($_SESSION['filtrec']))OR($_SESSION['filtrec'])==""){
    $_SESSION['filtrec']='';
}
else{
  $_SESSION['filtrec']="WHERE ".$_SESSION['filtrec'];  
}


//if ($_SESSION['tri']!="")
//    {
//    $_SESSION['trieffectif']='ORDER BY '.$_SESSION['tri'];
//    $_SESSION['trieffectif']= rtrim($_SESSION['trieffectif'], ",");
//    }
//else
//    {
//    $_SESSION['trieffectif']='';
//    }
$q = $this->_db->query('SELECT * FROM jeux '.$_SESSION['filtrec'].$_SESSION['tri'].$_SESSION['ordretri']);
//var_dump($_SESSION['filtrec']);
//var_dump($_SESSION['tri']);

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
        $ps4='<div class="ps4">&nbsp;PS4&nbsp;</div>';
    }
    else{
       $ps4=''; 
    }
    if(($jeux->ps3())=="oui"){
        $ps3='<div class="ps3">&nbsp;PS3&nbsp;</div>';
    }
    else{
       $ps3=''; 
    }
    if(($jeux->psvita())=="oui"){
        $psvita='<div class="psvita"> &nbsp;VITA&nbsp;</div>';
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
     '.$psvita.'</td>
     <!--<td></td>-->
     
     </tr>';
    }
return $jeux;
}
public function getListnonident()
{
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY RAND() LIMIT 5' );
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
        $ps4='<div class="ps4">&nbsp;PS4 &nbsp;</div>';
    }
    else{
       $ps4=''; 
    }
    if(($jeux->ps3())=="oui"){
        $ps3='<div class="ps3">&nbsp;PS3 &nbsp;</div>';
    }
    else{
       $ps3=''; 
    }
    if(($jeux->psvita())=="oui"){
        $psvita='<div class="psvita"> &nbsp;VITA &nbsp;</div>';
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
     <td>'.$ps4.''.$ps3.''.$psvita.'
     <!--<td></td>-->
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


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
public function listejsafari()
{
$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    $_SESSION['idjeuxs']=$jeux->id();
    echo '<option value="'.$jeux->titre().'">'.$jeux->titre().'</option>';
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
        <form method="post" class="form_ident">
            <fieldset><legend>Selectionner</legend>
            <br>';
                        $liste=new Datalist();
                        $liste->verifNav();
                        
               
                echo'<br><br>
                <button type="submit" name="selectj">SELECT</button>
            </fieldset>
        </form>    
    </div>
    <div class="droitemmd">
    <form method="post" class="form_rempli">    
    <table class="bas">
        
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixeb">
        <tr>
        
        <td class="titre"><input type="text" name="titrejeux" readonly value="'.$jeux->titre().'"></td>
        <td>'.$jeux->temps().'</td>
        <td>'.$jeux->difficulte().'</td>
        <td><img src='.$multi.' class="valid">
        </td>
        <td>'.$ps4.$ps3.$psvita.'</td>
        
        </tr>
        <tr><td colspan="5"><button type="submit" class="delete" name="supj" >Delete</button></td></tr>
        </tbody>
    </table>
    
    </div>
    
    </div>
    
    </form>
    <script src="datalist-polyfill.min.js"></script>
';
             

    }
return $jeux;
}
public function getm($titre, $login, $ident)
{
$qv = $this->_db->query('SELECT COUNT(*) FROM jeux AS J,maintable AS M WHERE J.titre="'.$titre.'" AND M.idjeux=J.id AND M.idusers="'.$_SESSION['user_session'].'"');
$testv = $qv->fetch();
//var_dump($testv);
if($testv['0'] =='0'){
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre="'.$titre.'"');    
}else{
$q = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre="'.$titre.'" AND M.idjeux=J.id AND M.idusers="'.$_SESSION['user_session'].'"');   
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
        <form method="post" class="form_ident">
            <fieldset><legend>Selectionner</legend>
            <br> ';
                        $liste=new Datalist();
                        $liste->verifNav();
                        
               
               
                echo'<br><br>
                <button  type="submit" name="selectj">SELECT</button>
            </fieldset>
        </form>    
    </div>
    <div class="droitea">
    <form method="post" class="form_rempli">
    <table class="bas">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixeb">
        <tr>
        
        <td class="titre"><br><input type="text" name="titre" value="'.$jeux->titre().'"><br><input type="text" name="liens" value="'.$jeux->liens().'"></td>
        <td><input type="number" name="temps" value="'.$jeux->temps().'"></td>
        <td><input type="number" name="difficulte" value="'.$jeux->difficulte().'"></td>
        <td>';
                    $this->verifRadio($jeux, 'multi');                   
        echo '</td>
        <td><div class="modifierj">Psvita ';
                   $this->verifChkbox($jeux, 'psvita');
        echo '</div><div class="modifierj">Ps3 ';
                   $this->verifChkbox($jeux, 'ps3');
        echo '</div><div class="modifierj">Ps4 ';
                   $this->verifChkbox($jeux, 'ps4');
        echo '</div></td>
        
        </tr>
        
        <tr><td classe="titre">
        Possede ';
        $this->verifChkbox($jeux, 'possede');
        echo 'Fini :';
        $this->verifChkbox($jeux, 'fini');
        echo'
        </td><td colspan="4"><button type="submit" class="delete" name="modifierj" >Modifier</button></td>
        </tr>
        </tbody>
    </table>
    
    </div>
    </div>
    
    </form>     
    <script src="datalist-polyfill.min.js"></script>
';
    $_SESSION['tjam']=$jeux->titre();    
    }
return $jeux;
}


public function updateJeux($idj)
{
$qv = $this->_db->query('SELECT COUNT(*) FROM jeux AS J,maintable AS M WHERE J.titre="'.$idj.'" AND M.idjeux=J.id AND M.idusers="'.$_SESSION['user_session'].'"');
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
var_dump($q1);
var_dump($q2);

}

public function getList()
{

    $jeux = array();

$q = $this->_db->query($_SESSION['trifiltre']);     

    $_SESSION['result']=$q->rowCount();
    if(($_SESSION['result']>=13)OR(!isset($_SESSION['result']))){
        echo'<div class="droite">';
    }else{
      echo'<div class="droitec">';  
    }
    echo'
        <table class="bas">
        
        <thead class="fixe">
              
            <tr class="titre">
                    
                <th class="titre" scope="col" >TITRE</th>
                    <th class="temps" >Temps</th>
                    <th class="difficulte" >Difficulte</th>
                    <th class="multi" >Multi</th>
                    <th class="console" >Console</th>
                    
                    <!--<th>User</th>-->
                </tr>
            
        </thead>
        <tbody class="fixeb">'; 


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
    if($jeux->liens()==""){
        $liens='';
    }else{
       $liens= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg">';
    }
    echo 
    '
    
    <div class="tableaug">    
    <tr>
     <td class="titre">'.$liens.$jeux->titre().'</a></td>
     <td class="temps">'.$jeux->temps().'</td>
     <td class="difficulte">'.$jeux->difficulte().'</td>
     <td class="multi"><img src='.$multi.' class="valid"></td>
     <td class="console">'.$ps4.'
     '.$ps3.'
     '.$psvita.'</td>
     <!--<td></td>-->
     
     </tr>
     </div>
     ';
    
    
    }
    $_SESSION['trifiltre']="";
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
    '
        <tr>
     <td class="titre"><a href='.$jeux->liens().'>'.$jeux->titre().'</a></td>
     <td>'.$jeux->temps().'</td>
     <td>'.$jeux->difficulte().'</td>
     <td><img src='.$multi.' class="valid"></td>
     <td>'.$ps4.''.$ps3.''.$psvita.'
     <!--<td></td>-->
     </tr>
     ';
    }
return $jeux;
}

public function setDb(PDO $db)
{
$this->_db = $db;
}

}

?>


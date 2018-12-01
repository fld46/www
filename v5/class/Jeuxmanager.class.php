<?php
class JeuxManager
{
private $_db;
private $_login;


public function __construct($db)
{
$this->setDb($db);
}

public function add(Jeux $jeux, $user_id)
{
 $q3=$this->_db->query('SELECT * FROM jeux WHERE titre="'.$jeux->titre().'"');
 $exist=$q3->rowCount();
 
 if($exist==0)
 {
 $this->_db->query('INSERT INTO jeux SET titre = ?, temps = ?, difficulte = ?, multi = ?,  ps4 = ?, ps3 = ?, psvita= ?, liens = ?',[$jeux->titre(),$jeux->temps(),$jeux->difficulte(),$jeux->multi(), $jeux->ps4(),$jeux->ps3(),$jeux->psvita(),$jeux->liens()]);
 $q3=$this->_db->query('SELECT * FROM jeux WHERE titre="'.$jeux->titre().'"');

    while ($donnees = $q3->fetch(PDO::FETCH_ASSOC))
    {
    $idjeux = $donnees['id'];
    }

 $this->_db->query('INSERT INTO maintable SET idjeux =?, idusers = ?, possede = ?, fini = ?',[$idjeux,$user_id,$jeux->possede(),$jeux->fini()]);
App::redirect('ajouter.php');
 }else{
   App::redirect('ajouter.php');  
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
    $this->_db->query('DELETE FROM maintable WHERE idjeux= ?',[$jeuxad->id()]);
    $this->_db->query('DELETE FROM jeux WHERE titre= ?',[$jeuxad->titre()]);
    
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

public function get($titre)
{

$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre=?',[$titre]);
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
    
    <div class ="menu_gauche">
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
    <div class="droitec">
    <form method="post" class="form_rempli">    
    <table class="droit">
        
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
        <tbody class="fixec">
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

$testv = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre= ? AND M.idjeux=J.id AND M.idusers= ?',[$titre,$login]);
//$testv->fetch();
if($testv->rowCount()==0){
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre= ?',[$titre]);    
}else{ 
$q = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre= ? AND M.idjeux=J.id AND M.idusers=?',[$titre,$login]);   
}
$jeux = array();

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
    //var_dump($jeux);
    echo'
    
    <div class ="menu_gauche">
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
    <div class="droitec">
    <form method="post" class="form_rempli">
    <table class="droit">
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
        <tbody class="fixec">
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
$testv=$this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre= ? AND M.idjeux=J.id AND M.idusers= ?',[$idj,$_SESSION['auth']->id]);

$q = $this->_db->query('SELECT * FROM jeux  WHERE titre=? ',[$idj]);
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeuxad = new Jeux();
    $jeuxad->hydrate($donnees);
    
    }
if($testv->rowCount() =='0'){
$this->_db->query('INSERT INTO maintable SET possede = ?, fini = ?, idjeux= ? ,idusers= ? ',[$_POST['possede'],$_POST['fini'],$jeuxad->id(),$_SESSION['auth']->id]);
}else{
$this->_db->query('UPDATE maintable SET possede = ?, fini =? WHERE idjeux= ? AND idusers= ? ',[$_POST['possede'],$_POST['fini'],$jeuxad->id(),$_SESSION['auth']->id]);  
}
$this->_db->query('UPDATE jeux SET titre = ?, temps = ?, difficulte = ?, multi = ?,  ps4 = ?, ps3 = ?, psvita= ?, liens = ? WHERE id= ?',[$_POST['titre'],$_POST['temps'],$_POST['difficulte'],$_POST['multi'],$_POST['ps4'],$_POST['ps3'],$_POST['psvita'],$_POST['liens'],$jeuxad->id()]);
}

public function getList()
{

    $jeux = array();
    $q = $this->_db->query($_SESSION['trifiltre']);
    $_SESSION['result']=$q->rowCount();
    if(($_SESSION['result']>=11)OR(!isset($_SESSION['result']))){
        $tableb='fixeb';
        echo'<div class="droite">';
    }else{
        $tableb='fixec';
        echo'<div class="droitec">';  
    }
    echo '
            <div class="droiteint">
            <table class="droit">
                <thead class="fixe">
                    <tr class="titre">
                        <th class="titre" scope="col" >TITRE</th>
                        <th class="temps" >Temps</th>
                        <th class="difficulte" >Difficulte</th>
                        <th class="multi" >Multi</th>
                        <th class="console" >Console</th>
                    </tr>
                </thead>
            <tbody class="'.$tableb.'">'; 


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
        $liens=$jeux->titre();
    }else{
       $liens= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg" alt=""/>'.$jeux->titre().'</a>';
    }
    echo 
    '
    
       
    <tr>
     <td class="titre">'.$liens.'</td>
     <td class="temps">'.$jeux->temps().'</td>
     <td class="difficulte">'.$jeux->difficulte().'</td>
     <td class="multi"><img src='.$multi.' class="valid"/></td>
     <td class="console">'.$ps4.'
     '.$ps3.'
     '.$psvita.'</td>
     </tr>
     ';
    }
    echo'</tbody>
    </table>
    </div>
    </div>
    ';
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
    if($jeux->liens()!=""){
       $liens= '<a href='.$jeux->liens().'>'.$jeux->titre().'</a>';
    }else{
       $liens= $jeux->titre(); 
    }
    echo 
    '
        <tr>
     <td class="titre">'.$liens.'</td>
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

public function setDb( $db)
{
$this->_db = $db;
}

}

?>


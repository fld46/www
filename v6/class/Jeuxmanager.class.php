<?php
class JeuxManager
{
private $_db;
private $_login;

public function __construct($db)
{
$this->setDb($db);
}

public function add(Jeux $jeux)
{
    var_dump($jeux);
 $this->_db->query('INSERT INTO jeux SET titre = ?, temps = ?, difficulte = ?, multi = ?,  ps4 = ?, ps3 = ?, psvita= ?, liens = ?, image = ?, crosssav = ?, crosstrophy = ?, crossmulti = ?',[$jeux->titre(),$jeux->temps(),$jeux->difficulte(),$jeux->multi(), $jeux->ps4(),$jeux->ps3(),$jeux->psvita(),$jeux->liens(),$jeux->image(),$jeux->crosssav(),$jeux->crosstrophy(),$jeux->crossmulti()]);
 Session::setFlash("ajout", "Jeux ajouté avec success");
 App::redirect('ajouter.php');
 
}
public function listej()
{

$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    //$_SESSION['idjeuxs']=$jeux->id();
    echo '<option value="'.$jeux->titre().'">';
    }

}
public function listejsafari()
{
//$jeux = array();
$q = $this->_db->query('SELECT * FROM jeux ORDER BY titre');
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    //$_SESSION['idjeuxs']=$jeux->id();
    echo '<option value="'.$jeux->titre().'">'.$jeux->titre().'</option>';
    }
//return $jeux;
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

public function deletej($id)
{
    
    $this->_db->query('DELETE FROM jeux WHERE id= ?',[$id]);
    $this->_db->query('DELETE FROM maintable WHERE idjeux= ?',[$id]);
    Session::setFlash("ajout", "Le jeu est supprimé");
    
   
}

public function verifRadio(Jeux $radioj,$input)
{
    $inputlabel = $input;
    $inputlabel = ucfirst($inputlabel);

if ($radioj->$input() == "oui")
    {
    echo'
    <input type="radio" name="'.$input.'" value="oui" checked required/>Oui<input type="radio" name="'.$input.'" value="non" r/>Non
    ';    
    }
if($radioj->$input() == "non")
    {
    echo'
    <input type="radio" name="'.$input.'" value="oui" />Oui<input type="radio" name="'.$input.'" value="non" checked />Non
    ';    
    }
if($radioj->$input() == "")
    {
    echo'
    <input type="radio" name="'.$input.'" value="oui" />Oui<input type="radio" name="'.$input.'" value="non"  />Non
    ';    
    }
}
public function verifChkbox(Jeux $radioj,$input)
{

if ($radioj->$input() == "oui")
    {
    $inpute='<input type="checkbox" name="'.$input.'" value="oui" checked />';    
    }
if(($radioj->$input() == "non")||($radioj->$input() == ""))
    {
    $inpute='<input type="checkbox" name="'.$input.'" value="oui"  />';
    
    }
    return $inpute;
}
public function verifChkboxGestion(Jeux $radioj,$input,$idconsole)
{
$q = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE J.titre= ? AND M.idjeux=J.id AND M.idusers= ? AND M.idconsole= ?',[$radioj->titre(),$_SESSION['auth']->id,$idconsole]);
if($q->rowCount()!=0){
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC)){
    $testconsole = new Jeux();
    $testconsole->hydrate($donnees);
    if ($testconsole->$input() == "oui")
        {
        $inpute='<input type="checkbox" name="'.$input.'['.$idconsole.']" value="oui" checked />';    
        }
    else{
        $inpute='<input type="checkbox" name="'.$input.'['.$idconsole.']" value="oui"  />';
    }
    
}
}else{
    $inpute='<input type="checkbox" name="'.$input.'['.$idconsole.']" value="oui"  />';
}
return $inpute;
}

public function getSelectedGame($titre)
{

//$jeux = array();
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
        <td class="img"></td><td class="img"></td>
        <td class="titre"><input type="text" name="titrejeux" readonly value="'.$jeux->titre().'"></td>
        <td class="img"></td>
        <td>'.$jeux->temps().'</td>
        <td>'.$jeux->difficulte().'</td>
        <td><img src='.$multi.' class="valid">
        </td>
        <td>'.$ps4.$ps3.$psvita.'</td>
        
        </tr>
        <tr><td colspan="8"><button type="submit" class="delete" name="supj" >Delete</button></td></tr>
        </tbody>
    </table>
    
    </div>
    
    </div>
    
    </form>
    <script src="datalist-polyfill.min.js"></script>
';
  $_SESSION['idjad']=$jeux->id();
   
             

    }
//return $jeux;
}
public function getGameSelected($titre)
{
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre= ?',[$titre]);    

while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
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
    <form method="post" class="form_rempli" enctype="multipart/form-data">
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
        <td class="img"></td><td class="img"></td>
        <td class="titre"><br><input type="text" name="titre" value="'.$jeux->titre().'"><br><input type="text" name="liens" value="'.$jeux->liens().'"></td>
        <td class="img"></td>
        <td><input type="number" name="temps" value="'.$jeux->temps().'"></td>
        <td><input type="number" name="difficulte" value="'.$jeux->difficulte().'"></td>
        <td>';
                    $this->verifRadio($jeux, 'multi');                   
        echo '</td>
        <td><div class="modifierj">Psvita '.
                   $this->verifChkbox($jeux, 'psvita').
        '</div><div class="modifierj">Ps3 '.
                   $this->verifChkbox($jeux, 'ps3').'
        </div><div class="modifierj">Ps4 '.
                   $this->verifChkbox($jeux, 'ps4').
        '</div></td>
        </tr>
        <tr>
            <td colspan="8">
            <div> cross sav :'.$this->verifChkbox($jeux, 'crosssav').
            '<br>
                cross trophy :'.$this->verifChkbox($jeux, 'crosstrophy').
            '<br>
                cross multi :'.$this->verifChkbox($jeux, 'crossmulti').
            '</div>
        
            </td> 
        </tr>
        <tr>
            <td colspan="8">'.$jeux->image().'<input type="file" name="image"/>
            </td>  
        </tr>
        <tr>
        <td colspan="8"><button type="submit" class="delete" name="modifierj" >Modifier</button></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
    </form>     
    <script src="datalist-polyfill.min.js"></script>
';
            //var_dump($this->verifChkbox($jeux, 'psvita'));
    $_SESSION['idjam']=$jeux->id();
    //$_SESSION['titrejam']=$jeux->titre();    
    }
//return $jeux;
}


public function updateJeux($idj)
{
   $this->_db->query('UPDATE jeux SET titre = ?, temps = ?, difficulte = ?, multi = ?,  ps4 = ?, ps3 = ?, psvita= ?, liens = ?, image = ?, crosssav = ?, crosstrophy = ?, crossmulti = ? WHERE id= ?',[$_POST['titre'],$_POST['temps'],$_POST['difficulte'],$_POST['multi'],$_POST['ps4'],$_POST['ps3'],$_POST['psvita'],$_POST['liens'],$_FILES['image']['name'],$_POST['crosssav'],$_POST['crosstrophy'],$_POST['crossmulti'],$idj]);
   Session::setFlash("update", "Le jeu est modifié");
}
public function updateJeuxGestion(Jeux $jeux)
{
    foreach ($jeux->possede() as $key=> $value){
       $plt=$this->_db->query('SELECT * FROM consoles  WHERE id=?',[$key]);
       while ($donnees = $plt->fetch(PDO::FETCH_ASSOC)){
           echo $donnees['console'];
       }
    }
    
    foreach ($jeux->fini() as $key=> $value){
       $plt=$this->_db->query('SELECT * FROM consoles  WHERE id=?',[$key]);
       while ($donnees = $plt->fetch(PDO::FETCH_ASSOC)){
           echo $donnees['console'];
       }
    }
   
   // //$this->_db->query('UPDATE jeux SET titre = ?, temps = ?, difficulte = ?, multi = ?,  ps4 = ?, ps3 = ?, psvita= ?, liens = ?, image = ?, crosssav = ?, crosstrophy = ?, crossmulti = ? WHERE id= ?',[$_POST['titre'],$_POST['temps'],$_POST['difficulte'],$_POST['multi'],$_POST['ps4'],$_POST['ps3'],$_POST['psvita'],$_POST['liens'],$_FILES['image']['name'],$_POST['crosssav'],$_POST['crosstrophy'],$_POST['crossmulti'],$idj]);
   //Session::setFlash("update", "Le jeu est modifié");
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
                        <th  class="titre" scope="col" >TITRE</th>
                        <th class="temps" >Temps</th>
                        <th class="difficulte" >Difficulte</th>
                        
                        <th class="console" >Console</th>
                    </tr>
                </thead>
            <tbody class="'.$tableb.'">'; 


while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
   
    if (($jeux->multi())=="oui"){
        $multi='<img src="online.png" class="valido" alt="" />';
    }else{
        $multi='';
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
   
    //if(($jeux->comments()=="")&&($jeux->liens()=="")){
    //    $liens='<img src="" class="validg" alt="" />'.$jeux->titre();
    //}elseif(($jeux->comments()=="")&&($jeux->liens()!="")){
    //   $liens= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg" alt="" /><img src="" class="validg" alt="" />'.$jeux->titre().'</a>';
    //}elseif(($jeux->comments()!="")&&($jeux->liens()!="")){
     //  $liens= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg" alt="" /><span title="'.$jeux->comments().'"><img src="comments.png" class="validg" alt="" /></span>'.$jeux->titre().'</a>';
    //}else{
    //   $liens= '<span title="'.$jeux->comments().'"><img src="comments.png" class="validg" alt="" />'.$jeux->titre().'</span></a>'; 
    //}
    if($jeux->comments()!=""){
       $comments= '<span title="'.$jeux->comments().'"><img src="comments.png" class="validg" alt="" /></span>';
    }else{
       $comments=''; 
    }
    if($jeux->liens()!=""){
       $guide= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg" alt="" /></a>';
    }else{
       $guide=''; 
    }
    
    echo 
    '
    
       
    <tr>
     <td class="img">'.$guide.'</td><td class="img">'.$comments.'</td><td class="titre">'.$jeux->titre().'</td><td class="img">'.$multi.'</td>
     <td class="temps">'.$jeux->temps().'</td>
     <td class="difficulte">'.$jeux->difficulte().'</td>
     
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
        $multit = "oui";
    }else{
        $multi='non.png';
        $multit = "non";
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
     <td><img src='.$multi.' class="valid" alt='.$multit.'></td>
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

public function copyImage($nom){
   if(!empty($_FILES)){
       $dest=$_SERVER["DOCUMENT_ROOT"]."/images/$nom";
       if (!is_dir($fdest)){
       mkdir($dest, 0777);
       }
       $name = basename($_FILES["image"]["name"]);
       move_uploaded_file($_FILES['image']['tmp_name'],"$dest/$name");
       //rename("$dest/$name","$dest/$nom.jpeg");
       
   } 
    
}
public function getGameSelectedGestion($titre)
{
$q = $this->_db->query('SELECT * FROM jeux  WHERE titre= ?',[$titre]);    
while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    $jeux = new Jeux();
    $jeux->hydrate($donnees);
    if (($jeux->multi())=="oui"){
        $multi='oui.png';
    }elseif (($jeux->multi())=="non"){
        $multi='non.png';
    }else{
      $multi='nc.png';  
    }
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
    <form method="post" class="form_rempli" enctype="multipart/form-data">
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
        <td class="img"></td><td class="img"></td>
        <td class="titre"><br><di>'.$jeux->titre().'</div></td>
        <td class="img"></td>
        <td><div>'.$jeux->temps().'</div></td>
        <td><div>'.$jeux->difficulte().'</div></td>
        <td><img src="'.$multi.'" class="valid">
                                      
        </td>
        <td></td>
        </tr>'
              .$this->getConsole($jeux).'
                  
        <tr>
        <td colspan="8"><button type="submit" class="delete" name="modifierj" >Modifier</button></td>
        </tr>
        </tbody>
    </table>
    </div>
    </div>
    </form>     
    <script src="datalist-polyfill.min.js"></script>
';
   
    $_SESSION['idjam']=$jeux->id();
    //$_SESSION['titrejam']=$jeux->titre();    
    }
//return $jeux;
}
public function getConsole(jeux $jeux){
    
    if ($jeux->psvita()=="oui"){
        
        $vita='<tr><td colspan="8">Psvita : Possede :'.$this->verifChkboxGestion($jeux, 'possede', 2).' fini :'.$this->verifChkboxGestion($jeux, 'fini', 2).'</td></tr>';
        }else{
        $vita="";  
        }
    if ($jeux->ps3()=="oui"){
        $ps3='<tr><td colspan="8">Ps3 : Possede :'.$this->verifChkboxGestion($jeux, "possede",1).' fini :'.$this->verifChkboxGestion($jeux, "fini",1).'</td></tr>';
    }else{
        $ps3="";  
        }
    if ($jeux->ps4()=="oui"){
        $ps4='<tr><td colspan="8">Ps4 : Possede :'.$this->verifChkboxGestion($jeux, 'possede',3).' fini :'.$this->verifChkboxGestion($jeux, 'fini',3).'</td></tr>';
    }else{
        $ps4="";  
        }
   return $vita.$ps3.$ps4; 
}

}




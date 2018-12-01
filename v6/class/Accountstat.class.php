<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accountstat
 *
 * @author fld
 */
class Accountstat {
    private $_db;
    private $user_id;
   
    public function __construct($db, $user_id) {
         $this->_db = $db;
         $this->user_id = $user_id;
         
    }
    public function getNbjeuxPossede(){
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? and M.possede="oui"',[$this->user_id]);
        $possede=$req->rowCount();
        return $possede;
                
    }
    public function getNbjeuxFini(){
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? and M.fini="oui"',[$this->user_id]);
        $fini=$req->rowCount();
        return $fini;
                
    }
    public function getNbjeuxSuggere(){
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui" AND J.difficulte!=0 AND J.difficulte IS NOT NULL AND (M.fini!="oui"  OR M.fini IS NULL) ORDER BY J.difficulte,J.temps LIMIT 1',[$this->user_id]);
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
        $jeux = new Jeux();
        $jeux->hydrate($donnees);
            
        } 
        if($jeux->liens()){
        $titre = '<a href="'.$jeux->liens().'" target="new"><span title="'.$jeux->comments().'">'.$jeux->titre().'</span></a>';
        return $titre;
        }
        else{
          return $jeux->titre();  
        }
    }
    public function getNbjeuxSuggeresuivant(){
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui" AND J.difficulte!=0 AND J.difficulte IS NOT NULL AND (M.fini!="oui"  OR M.fini IS NULL) ORDER BY J.difficulte,J.temps,J.titre LIMIT 9',[$this->user_id]);
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
        $jeux = new Jeux();
        $jeux->hydrate($donnees);
       if (($jeux->multi())=="oui"){
        $multi='<img src="online.png" class="valido" alt="" />';
    }else{
        $multi='';
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
    //if($jeux->liens()!=""){
    //   $liens= '<a href='.$jeux->liens().'><span title="'.$jeux->comments().'">'.$jeux->titre().'</span></a>';
    //}else{
    //   $liens= '<span title="'.$jeux->comments().'">'.$jeux->titre().'</span>'; 
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
     <td>'.$jeux->temps().'</td>
     <td>'.$jeux->difficulte().'</td>
     
     <td class="console">'.$ps4.''.$ps3.''.$psvita.'
     <!--<td></td>-->
     </tr>
     ';
    }
    
    }
    public function getNbjeux(){
        $req = $this->_db->query('SELECT * FROM jeux ');
        $nbjeux=$req->rowCount();
        return $nbjeux;
                
    }
     public function getNbjeuxNC(){
        $req = $this->_db->query('SELECT * FROM jeux  WHERE difficulte IS NULL OR difficulte=0 OR temps IS NULL OR temps=0  ');
        $nbjeuxnc=$req->rowCount();
        return $nbjeuxnc;
        }   
   
    public function getLastjeux(){
        $req = $this->_db->query('SELECT * FROM jeux ORDER BY id DESC LIMIT 5');
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
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
        //if($jeux->liens()==""){
        //$liens=$jeux->titre();
        //}else{
        //$liens= '<a href='.$jeux->liens().' target="new"><img src="guide.png" class="validg" alt=""/>'.$jeux->titre().'</a>';
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
        echo '<tr>
            <td class="img">'.$guide.'</td><td class="img">'.$comments.'</td><td class="titre">'.$jeux->titre().'</td><td class="img">'.$multi.'</td>
            <td>'.$jeux->temps().'</td>
            <td>'.$jeux->difficulte().'</td>
            
            <td class="console">'.$ps4.$ps3.$psvita.'</td>
            </tr>';
             
        }
    }
    public function getListtopdf()
        {
        
        $pdf = new FPDF();
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $jeux = array();
        $q = $this->_db->query('SELECT * FROM jeux WHERE liens="" ORDER BY titre ASC ' );
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
               $liens = $jeux->titre(); 
               $pdf->Write(10, $liens);
               $pdf->Output();
            }
            
            }
    public function getListnonguide()
        {
        $jeux = array();
        $q = $this->_db->query('SELECT * FROM jeux WHERE liens="" ORDER BY titre ASC ' );
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
             <td>'.$jeux->temps().'</td>
             <td>'.$jeux->difficulte().'</td>
            
             <td class="console">'.$ps4.''.$ps3.''.$psvita.'
             <!--<td></td>-->
             </tr>
             ';
            }
        return $jeux;
        }

    
}

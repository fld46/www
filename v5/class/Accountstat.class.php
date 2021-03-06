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
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui" and M.fini IS NULL AND J.difficulte!=0 AND J.difficulte IS NOT NULL  ORDER BY J.difficulte,J.temps LIMIT 1',[$this->user_id]);
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
        $jeux = new Jeux();
        $jeux->hydrate($donnees);
        return $jeux->titre();
             
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
        echo "<tr>
            <td class=\"titre\">".$liens."</td>
            <td>".$jeux->temps()."</td>
            <td>".$jeux->difficulte()."</td>
            <td ><img src=".$multi." class=\"valid\"/></td>
            <td>".$ps4.$ps3.$psvita."</td>
            </tr>";
             
        }
    }

    
}

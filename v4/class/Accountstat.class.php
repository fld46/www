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
        $req = $this->_db->query('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui" and M.fini IS NULL  ORDER BY J.difficulte,J.temps LIMIT 1',[$this->user_id]);
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
        $jeux = new Jeux();
        $jeux->hydrate($donnees);
        return $jeux->titre();
             
        }   
}
}

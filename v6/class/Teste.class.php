<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validator
 *
 * @author fld
 */
class Teste {
    
    private $data;
    private $errors =[];
    
    public function __construct($data){
     
       $this->data=$data; 
    }
    
    private function getField($field){
     if(!isset($this->data[$field])){
         return null;
     }
       return $this->data[$field];   
    }
    
   
    
    public function isUniq($field, $db, $table, $errorMsg){
        
    $record=$db->query("SELECT id FROM $table WHERE $field = ?",[$this->getField($field)] )->fetch();
         
        if($record){
            $this->errors[$field] = $errorMsg;
            Session::setFlash($field,$errorMsg);
        }
    }
    public function isNoUniq($field, $db, $table, $errorMsg){
        
    $record=$db->query("SELECT id FROM $table WHERE $field = ?",[$this->getField($field)] )->fetch();
         
        if($record=false){
            $this->errors[$field] = $errorMsg;
            Session::setFlash($field,$errorMsg);
        }
    }
   
   public function isOK(){
       $db = App::getDatabase();
       $this->isUniq('titre', $db, 'jeux', 'Ce jeux existe deja');
       $this->isPlateform();
       $this->isMulti();
       $this->isCorrect();
   }
   public function isOKGestion(){
       $db = App::getDatabase();
       $this->isNoUniq('titre', $db, 'jeux', 'Ce jeux n\'existe pas');
       
        
      
   }
   
   public function isOKUpdate(){
       $db = App::getDatabase();
       $this->isNoUniq('titre', $db, 'jeux', 'Ce jeux n\' existe pas');
       $this->isPlateform();
       $this->isMulti();
       $this->isCorrect();
   }    
    
    public function isValid(){
        return empty($_SESSION['flash']);
        
         
    }
    public function isPlateform(){
        if (($this->getField('liens')!="")&&($this->getField('multi')=="")){
            $this->errors['multi'] = 'Vous devez specifier le multi';
            Session::setFlash('multi','Vous devez specifier le multi');
            
        }
    }
    public function isMulti(){
        if (($this->getField('ps4')=="")&&($this->getField('ps3')=="")&&($this->getField('psvita')=="")){
            $this->errors['plateforme'] = 'Vous devez specifier une plateforme';
            Session::setFlash('plateforme','Vous devez specifier une plateforme');
            
        }
    }
    public function isCorrect(){
        $console = array($this->getField('psvita'),$this->getField('ps3'),$this->getField('ps4'));
        $cross = array($this->getField('crosssav'),$this->getField('crosstrophy'),$this->getField('crossmulti'));
        $tab=array('oui','oui','oui');
        $tabc = array_intersect($console,$tab);
        $tabcr = array_intersect($cross,$tab);
        
        if((count($tabcr) >=1)&&(count($tabc) < 2)){
            $this->errors['crossp'] = 'cross impossible avec une seule plateforme';
            Session::setFlash('crossp','cross impossible avec une seule plateforme');
                    
        }
        //if(($this->getField('crossmulti')=="oui")&&(($this->getField('multi')=="")||($this->getField('multi')=="non"))){
        //    $this->errors['crossm'] = 'cross multi impossible sans multi';
        //    Session::setFlash('crossm','cross multi impossible sans multi');
        //}       
        
        
    }

    public function getErrors(){
     return $this->errors;   
    }
}

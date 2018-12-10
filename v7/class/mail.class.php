<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mail
 *
 * @author fld
 */
class mail {
        private $passage_ligne;
        private $header;
        private $boundary; 
        
        public function __construct() {
            
        }
        private function verif($addmail){
           
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $addmail))
            {
            $this->passage_ligne = "\r\n";
            }
            else
            {
            $this->passage_ligne = "\n";
            }
            }
        private function header($expediteur, $addmail, $mailuser){
            self::verif($mailuser);
            $header = "From: \"$expediteur\"<".$addmail.">".$this->passage_ligne;
            $header .= "Reply-to: ".$addmail .$this->passage_ligne;
            $header.= "MIME-Version: 1.0".$this->passage_ligne; 
            $header .= "Content-Type: multipart/alternative;".$this->passage_ligne." boundary=\"$this->boundary\"".$this->passage_ligne ;
            $this->header = $header;
            
        }
        public function createMail($addmail,$expediteur,$addexp,$sujet,$message_txt,$message_html){
           self::verif($addmail);
           self::header($expediteur,$addexp,$addmail);
           $this->boundary = "-----=". md5(rand());
           $message = $this->passage_ligne."--".$this->boundary.$this->passage_ligne;
            //=====Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$this->passage_ligne;
            $message.= $this->passage_ligne.$message_txt.$this->passage_ligne;
            //==========
            $message.= $this->passage_ligne."--".$this->boundary.$this->passage_ligne;
            //=====Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$this->passage_ligne;
            $message.= $this->passage_ligne.$message_html.$this->passage_ligne;
            //==========
            $message.= $this->passage_ligne."--".$this->boundary."--".$this->passage_ligne;
            $message.= $this->passage_ligne."--".$this->boundary."--".$this->passage_ligne;
            //==========
            echo self::header($expediteur,$addexp,$addmail);
            echo $message;
            mail($addmail,$sujet,$message,$this->header);       
                   
           
        }
}

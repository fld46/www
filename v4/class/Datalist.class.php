<?php
class Datalist {
    
    public function verifNav(){
        $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
        $manager = new JeuxManager($db);
        
        if ( preg_match('/Mac/i', $_SERVER['HTTP_USER_AGENT'])){
         echo'<select name="titrejeux" class="formin">';
         $manager->listejsafari();
         echo'</select>';
        }else{
         echo '<input list="titrejeu" type="text"  class="formin" name="titrejeux"/>
                    <datalist id="titrejeu">';
                         $manager->listej(); 
                    echo'</datalist>';
         
     }   
    }
    //put your code here
}

<?php
class Datalist {
    
    public function verifNav(){
        $db = new PDO('mysql:host=sql.free.fr;dbname=webfld', 'webfld','gtt7021y' );
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
    public function verifNavu(){
        $db = new PDO('mysql:host=sql.free.fr;dbname=webfld', 'webfld','gtt7021y' );
        $user = new User($db);
        
        if ( preg_match('/Mac/i', $_SERVER['HTTP_USER_AGENT'])){
         echo'<select name="users" class="formin">';
         $user->getListUserselectsafari();
         echo'</select>';
        }else{
         echo '<input list="user" type="text"  class="formin" name="users"/>
                    <datalist id="user">';
                         $user->getListUserselect(); 
                    echo'</datalist>';
         
     }   
    }
    
    //put your code here
}

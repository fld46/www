<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of App
 *
 * @author fld
 */


class App {
    
    static $db = null;
    
    static function getDatabase(){
        if(!self::$db){
        self::$db = new Database('webfld', 'gtt7021y', 'webfld','sql.free.fr');
        }
        return self::$db;
        
    }
    static function getAuth(){
        return new Auth(Session::getInstance(),['restriction_msg' => 'lol tu es bloqué !']);
    }
    
    static function redirect($page){
        
        $_SESSION['page']= $page;
        header("location: /index.php");
        exit();
    }
    static function redirectr($page){
                
        header("location: ".$page."");
        exit();
    }
    

    
    
}

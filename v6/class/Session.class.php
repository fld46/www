<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author fld
 */
class Session {
    
    static $instance;
    
    static function getInstance(){
        if(!self::$instance){
        self::$instance= new session();  
    }
    return self::$instance;
    
    }
    
    public function __construct(){
     session_start();   
    }
    
    public function setFlash($key, $message){
        
        $_SESSION['flash'][$key] = $message;
    }
    
    public function hasFlashes(){
        return isset($_SESSION['flash']);
    }
    public function getFlashes(){
      $flash = $_SESSION['flash'];
      unset($_SESSION['flash']);
      return $flash;
    }
    public function write($key, $value){
        
        $_SESSION[$key] = $value;
        
    }
    public function read($key){
        
        return  isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        
    }
    public function delete($key){
      unset($_SESSION[$key]);  
    }
    
    
}

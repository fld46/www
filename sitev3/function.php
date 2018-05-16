<?php
function debug($variable){
    echo '<pre>'.print_r($variable,true).'</pre>';
}
function str_random($length){
    $alphabet="0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn";
    return substr(str_shuffle(str_repeat($alphabet, 60)),0,$length);
    }    
function logged_only(){
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    if(!isset($_SESSION['auth'])){
        //$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');
        exit();
    } 
}
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


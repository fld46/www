<?php
//autoloader des class
spl_autoload_register('my_autoload');

function my_autoload($class){
    
   require ($_SERVER["DOCUMENT_ROOT"]."/class/$class.class.php"); 
}
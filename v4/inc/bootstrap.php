<?php

spl_autoload_register('my_autoload');

function my_autoload($class){
    
   require ($_SERVER["DOCUMENT_ROOT"]."/v4/class/$class.class.php"); 
}
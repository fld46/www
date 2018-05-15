<?php
function debug($variable){
    echo '<pre>'.print_r($variable,true).'</pre>';
}
function str_random($length){
    $alphabet="0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn";
    return substr(str_shuffle(str_repeat($alphabet, 60)),0,$length);
    }    
/* 
}
}
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


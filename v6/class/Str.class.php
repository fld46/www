<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Str
 *
 * @author fld
 */
class Str {
    
    static function random($length){
         $alphabet="0123456789AZERTYUIOPQSDFGHJKLMWXCVBNazertyuiopmlkjhgfdsqwxcvbn";
    return substr(str_shuffle(str_repeat($alphabet, 60)),0,$length);
    }
}

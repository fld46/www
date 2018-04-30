<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Liens
 *
 * @author fld
 */
class Liens {
    
    public function lien($cible)
    {
        echo '<a href='.$cible.'.php>'.$cible.'</a>';
        //return "$cible";
    }
    //put your code here
}

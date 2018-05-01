<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vartri
 *
 * @author fld
 */
class vartri {
    //put your code here
    
    private $_var;
    
    public function tri()
    {
    if(isset($_POST['btn_titre'])){
        $_SESSION['tri']=str_replace('titre', '', $_SESSION['tri']);
        $_SESSION['tri']='titre'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_temps'])){
        $_SESSION['tri']=str_replace('temps', '', $_SESSION['tri']);
        $_SESSION['tri']='temps'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    }
}

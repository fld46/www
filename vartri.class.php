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
        $_SESSION['tri']=str_replace('titre ,', '', $_SESSION['tri']);
        $_SESSION['tri']='titre ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_temps'])){
        $_SESSION['tri']=str_replace('temps ,', '', $_SESSION['tri']);
        $_SESSION['tri']='temps ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_difficulte'])){
        $_SESSION['tri']=str_replace('difficulte ,', '', $_SESSION['tri']);
        $_SESSION['tri']='difficulte ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_multi'])){
        $_SESSION['tri']=str_replace('multi ,', '', $_SESSION['tri']);
        $_SESSION['tri']='multi ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_fini'])){
        $_SESSION['tri']=str_replace('fini ,', '', $_SESSION['tri']);
        $_SESSION['tri']='fini ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_finit'])){
        $_SESSION['tri']=str_replace('finit ,', '', $_SESSION['tri']);
        $_SESSION['tri']='finit ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_ps4'])){
        $_SESSION['tri']=str_replace('ps4 ,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps4 ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_ps3'])){
        $_SESSION['tri']=str_replace('ps3 ,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps3 ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_psvita'])){
        $_SESSION['tri']=str_replace('psvita ,', '', $_SESSION['tri']);
        $_SESSION['tri']='psvita ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_fred'])){
        $_SESSION['tri']=str_replace('fred ,', '', $_SESSION['tri']);
        $_SESSION['tri']='fred ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_tristan'])){
        $_SESSION['tri']=str_replace('tristan ,', '', $_SESSION['tri']);
        $_SESSION['tri']='tristan ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
    if(isset($_POST['btn_jo'])){
        $_SESSION['tri']=str_replace('jo ,', '', $_SESSION['tri']);
        $_SESSION['tri']='jo ,'.$_SESSION['tri'];
        echo $_SESSION['tri'];
    }
   //$_SESSION['tri']= rtrim($_SESSION['tri'], ",");
    echo'<br>'.$_SESSION['tri'];
    
    }
    
}

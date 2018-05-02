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
        if(!isset($_SESSION['titread'])){
        $_SESSION['tri']=str_replace('titre ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('titre DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='titre ASC,'.$_SESSION['tri'];
        $_SESSION['titread'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('titre ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='titre DESC,'.$_SESSION['tri'];
        unset($_SESSION['titread']);
        //echo $_SESSION['tri'];
        }    
        }
    if(isset($_POST['btn_temps'])){
        if(!isset($_SESSION['tempsad'])){
        $_SESSION['tri']=str_replace('temps ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('temps DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='temps ASC,'.$_SESSION['tri'];
        $_SESSION['tempsad'] = "1";
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('temps ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='temps DESC,'.$_SESSION['tri'];
        unset($_SESSION['tempsad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_difficulte'])){
        if(!isset($_SESSION['difficultead'])){
        $_SESSION['tri']=str_replace('difficulte ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('difficulte DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='difficulte ASC,'.$_SESSION['tri'];
        $_SESSION['difficultead'] = '1';
        //echo $_SESSION['tri'];
         }else
        {
        $_SESSION['tri']=str_replace('difficulte ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='difficulte DESC,'.$_SESSION['tri'];
        unset($_SESSION['difficultead']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_multi'])){
        if(!isset($_SESSION['multiad'])){
        $_SESSION['tri']=str_replace('multi ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('multi DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='multi ASC,'.$_SESSION['tri'];
        $_SESSION['multiad'] = "1";
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('multi ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='multi DESC,'.$_SESSION['tri'];
        unset($_SESSION['multiad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_fini'])){
        if(!isset($_SESSION['finiad'])){
        $_SESSION['tri']=str_replace('fini ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('fini DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='fini ASC,'.$_SESSION['tri'];
        $_SESSION['finiad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('fini ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='fini DESC,'.$_SESSION['tri'];
        unset($_SESSION['finiad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_finit'])){
        if(!isset($_SESSION['finitad'])){
        $_SESSION['tri']=str_replace('finit ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('finit DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='finit ASC,'.$_SESSION['tri'];
        $_SESSION['finitad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('finit ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='finit DESC,'.$_SESSION['tri'];
        unset($_SESSION['finitad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_ps4'])){
        if(!isset($_SESSION['ps4ad'])){
        $_SESSION['tri']=str_replace('ps4 ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('ps4 DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps4 ASC,'.$_SESSION['tri'];
        $_SESSION['ps4ad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('ps4 ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps4 DESC,'.$_SESSION['tri'];
        unset($_SESSION['ps4ad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_ps3'])){
        if(!isset($_SESSION['ps3ad'])){
        $_SESSION['tri']=str_replace('ps3 ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('ps3 DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps3 ASC,'.$_SESSION['tri'];
        $_SESSION['ps3ad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('ps3 ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='ps3 DESC,'.$_SESSION['tri'];
        unset($_SESSION['ps3ad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_psvita'])){
        if(!isset($_SESSION['psvitaad'])){
        $_SESSION['tri']=str_replace('psvita ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('psvita DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='psvita ASC,'.$_SESSION['tri'];
        $_SESSION['psvitaad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('psvita ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='psvita DESC,'.$_SESSION['tri'];
        unset($_SESSION['psvitaad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_fred'])){
        if(!isset($_SESSION['fredad'])){
        $_SESSION['tri']=str_replace('fred ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('fred DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='fred ASC,'.$_SESSION['tri'];
        $_SESSION['fredad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('fred ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='fred DESC,'.$_SESSION['tri'];
        unset($_SESSION['fredad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_tristan'])){
        if(!isset($_SESSION['tristanad'])){
        $_SESSION['tri']=str_replace('tristan ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('tristan DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='tristan ASC,'.$_SESSION['tri'];
        $_SESSION['tristanad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('tristan ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='tristan DESC,'.$_SESSION['tri'];
        unset($_SESSION['tristanad']);
        //echo $_SESSION['tri'];
        }    
    }
    if(isset($_POST['btn_jo'])){
        if(!isset($_SESSION['joad'])){
        $_SESSION['tri']=str_replace('jo ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']=str_replace('jo DESC,', '', $_SESSION['tri']);
        $_SESSION['tri']='jo ASC,'.$_SESSION['tri'];
        $_SESSION['joad'] = '1';
        //echo $_SESSION['tri'];
        }else
        {
        $_SESSION['tri']=str_replace('jo ASC,', '', $_SESSION['tri']);
        $_SESSION['tri']='jo DESC,'.$_SESSION['tri'];
        unset($_SESSION['joad']);
        //echo $_SESSION['tri'];
        }    
    }
   //$_SESSION['tri']= rtrim($_SESSION['tri'], ",");
    //echo'<br>'.$_SESSION['tri'];
    
    }
    
}

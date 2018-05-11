<?php
 class USERL
 {
  Private $_id;
  Private $_login;
  
  


  public function hydrate(array $donnees)
  {
  foreach ($donnees as $key => $value)
  {
  // On récupère le nom du setter correspondant à l'attribut.
  $method = 'set'.ucfirst($key);
  // Si le setter correspondant existe.
  if (method_exists($this, $method))
   {
   // On appelle le setter.
   $this->$method($value);
   }
   }
   }


  //accesseurs
  Public function id()
  {
  return $this->_id;
  }
  Public function login()
  {
  return $this->_login;
  }
  
  


//Mutateurs
  Public function setId($id)
  {
  if (empty($id))
   {
   trigger_error('Vous devez mettre un id', E_USER_WARNING);
   return;
   }
  $this->_id = $id;
  }
  Public function setLogin($login)
  {
  if (empty($login))
   {
   trigger_error('Vous devez mettre un titre', E_USER_WARNING);
   return;
   }
  $this->_login = $login;
  }
  
  public function makeFiltreConsole()
    {
     if(!isset($_POST['ps4'])){
                $ps4="";
            }else{
                $ps4='J.ps4="'.$_POST['ps4'].'" ';
            }
            
        if(!isset($_POST['ps3'])){
                $ps3="";
            }else{
                if((isset($_POST['ps4']))){
                $ps3='AND J.ps3="'.$_POST['ps3'].'"';    
                }else{
                $ps3='J.ps3="'.$_POST['ps3'].'"';
            }
            }
            
        if(!isset($_POST['psvita'])){
                $psvita="";
            }else{
                if((isset($_POST['ps4']))OR(isset($_POST['ps3']))){
                 $psvita='AND J.psvita="'.$_POST['psvita'].'"';  
                }
                else{            
                $psvita='J.psvita="'.$_POST['psvita'].'"';
            }
            }
            
        if(!isset($_POST['multi'])){
                $multi="";
            }else{
                if((isset($_POST['ps4']))OR(isset($_POST['ps3']))OR(isset($_POST['psvita']))){
                $multi='AND J.multi="'.$_POST['multi'].'"';  
                }
                else{            
                $multi='J.multi="'.$_POST['multi'].'"';
            }
            }
            
        $_SESSION['filtrec']= $ps4.$ps3.$psvita.$multi;
        //var_dump($_SESSION['filtrec']);
        //if(($_SESSION['filtrec']=="")AND($_SESSION['filtreuser']!="")){
        //$_SESSION['filtreuser']='WHERE '.$_SESSION['filtreuser'];
        //}
        //echo $_SESSION['filtrec'];
        //verfif tri
        
    }
  public function makeFiltreUser()
    {
        $_SESSION['filtreuser'] ="";      
//reset filtreuser
      //if($_SESSION['filtrec']=="") //si pas de filtre console
       // {
       //   $_SESSION['filtreuser'] =" J.id=M.idjeux AND "; 
       // }else{
        //  $_SESSION['filtreuser'] =" AND J.id=M.idjeux AND ";   
        //}
      if(isset($_POST['user'])){ //si user selectionné
        
        $nbl=count($_POST['user'])-1;
            foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                if ($key!=$nbl){
                $_SESSION['filtreuser'] = $_SESSION['filtreuser'].' M.idusers='.$value.' AND ';   
                }else {
                $_SESSION['filtreuser'] = $_SESSION['filtreuser'].' M.idusers='.$value.' AND J.id=M.idjeux ';     
                }
            }
            //var_dump($_SESSION['filtreuser']);
        }
      
        if(isset($_POST['possede']))
        {
            $_SESSION['filtreuser']= $_SESSION['filtreuser'].' AND M.possede="oui"';   
        }
        if(isset($_POST['fini']))
        {
            $_SESSION['filtreuser']= $_SESSION['filtreuser'].' AND M.fini="oui"';   
        }
                
        
        //echo $_SESSION['filtreuser'];
        
    }
    public function makeTri(){
        if((!isset($_POST['tri']))or($_POST['tri']=='')){
                $tri=' ORDER BY titre';
                 }else{
                    if(($_POST['tri']=="temps")){
                    $tri=' ORDER BY '.$_POST['tri'].' ';
                    }
                    if(($_POST['tri'])=="difficulte"){
                    $tri=' ORDER BY '.$_POST['tri'].' ';
                    }
                    if(($_POST['tri'])=="titre"){
                    $tri=' ORDER BY '.$_POST['tri'].' ';
                    }
                }
          $_SESSION['tri']= $tri;
          
          //ordre du tri
          
          if(!isset($_POST['ordretri'])){
              $_SESSION['ordretri']= " ASC";
          }
           if ($_SESSION['tri']=="")
              {
              $_SESSION['ordretri'] = "";
              }
          if(($_SESSION['tri']!='')and(isset($_POST['ordretri']))){
              $_SESSION['ordretri'] = " ".$_POST['ordretri']; 
          } 
        
    }
    public function makeVarTriFiltre(){
        if(($_SESSION['filtrec']!="")and($_SESSION['filtreuser'])==''){
        $_SESSION['trifiltre']='WHERE '.$_SESSION['filtrec'].$_SESSION['tri'].$_SESSION['ordretri'];    
        }
        else if(($_SESSION['filtrec']=="")and($_SESSION['filtreuser'])!=''){
        $_SESSION['trifiltre']='WHERE '.$_SESSION['filtreuser'].$_SESSION['tri'].$_SESSION['ordretri'];   
        }
        else if(($_SESSION['filtrec']=="")and($_SESSION['filtreuser'])==''){
        $_SESSION['trifiltre']=$_SESSION['tri'].$_SESSION['ordretri'];     
        }
        else if(($_SESSION['filtrec']!="")and($_SESSION['filtreuser'])!=""){
        $_SESSION['trifiltre']='WHERE '.$_SESSION['filtrec'].' AND '.$_SESSION['filtreuser'].$_SESSION['tri'].$_SESSION['ordretri'];
        var_dump($_SESSION['trifiltre']);
        
        }
        }
}
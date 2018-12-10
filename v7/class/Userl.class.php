<?php
 class Userl
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
          if(!isset($_POST['nc'])){
                $nc="";
            }else{
                if((isset($_POST['ps4']))OR(isset($_POST['ps3']))OR(isset($_POST['psvita']))OR(isset($_POST['multi']))){
                $nc='AND J.difficulte>=1';  
                }
                else{            
                $nc='J.difficulte>=1';
            }
            }
            
            
        $_SESSION['filtrec']= $ps4.$ps3.$psvita.$multi.$nc;
       
        
    }
  public function makeFiltreUser()
    {
        $_SESSION['filtreuser'] ="";      
        $_SESSION['boubou'] ="";
      
      if(isset($_POST['user'])){ 
        
        $nbl=count($_POST['user'])-1;
        $_SESSION['nbu']=$nbl;
        if(($nbl<1) and (!isset($_POST['fini']))and(!isset($_POST['possede']))){
        foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                if ($key<1){
                $_SESSION['boubou'] = 'SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux GROUP BY M.idjeux ';
                $_SESSION['filtreuser'] = $_SESSION['boubou'];
                
                }else {
                $_SESSION['boubou'] = 'SELECT R.* FROM ('.$_SESSION['boubou'].') AS R, (SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux ) AS S WHERE R.idjeux=S.idjeux' ;
                $_SESSION['filtreuser'] = $_SESSION['boubou'];
                
                }
            }
        }else if(!isset($_SESSION['filtrec'])){
            foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                if ($key<1){
                $_SESSION['boubou'] = 'SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND '.$_SESSION['filtrec'].'';
                
                $_SESSION['filtreuser'] = $_SESSION['boubou'];
                
                }else {
                $_SESSION['boubou'] = 'SELECT R.* FROM ('.$_SESSION['boubou'].') AS R, (SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND '.$_SESSION['filtrec'].') AS S WHERE R.idjeux=S.idjeux' ;
                    
                $_SESSION['filtreuser'] = $_SESSION['boubou'];
                
                }
            }
            
        }
        else if(isset($_SESSION['filtrec'])){
            if((isset($_POST['possede']))and (!isset($_POST['fini']))){
                foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                    if ($key<1){
                    $_SESSION['boubou'] = 'SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.possede="oui" GROUP BY M.idjeux';
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }else {
                    $_SESSION['boubou'] = 'SELECT R.* FROM ('.$_SESSION['boubou'].') AS R, (SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.possede="oui") AS S WHERE R.idjeux=S.idjeux  ' ;
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }
                }
            }
            if((isset($_POST['fini']))and (!isset($_POST['possede']))){
                foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                    if ($key<1){
                    $_SESSION['boubou'] = 'SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.fini="oui" GROUP BY M.idjeux';
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }else {
                    $_SESSION['boubou'] = 'SELECT R.* FROM ('.$_SESSION['boubou'].') AS R, (SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.fini="oui") AS S WHERE R.idjeux=S.idjeux  ' ;
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }
                }
            }
            if((isset($_POST['fini']))and(isset($_POST['possede']))){
                foreach ($_POST['user'] as $key => $value) { //remplissage de la variable filtreuser en fonction du nombre de user trouvé
                    if ($key<1){
                    $_SESSION['boubou'] = 'SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.fini="oui" AND possede="oui"';
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }else {
                    $_SESSION['boubou'] = 'SELECT R.* FROM ('.$_SESSION['boubou'].') AS R, (SELECT J.* ,M.idjeux ,M.idusers ,M.possede ,M.fini FROM jeux AS J, maintable AS M WHERE M.idusers='.$value.' AND J.id=M.idjeux AND M.fini="oui" AND possede="oui") AS S WHERE R.idjeux=S.idjeux  ' ;
                    $_SESSION['filtreuser'] = $_SESSION['boubou'];
                    }
                }
            }
        }
        //var_dump($_SESSION['filtreuser']);
        }
        //var_dump($_SESSION['boubou']);
        //if(isset($_POST['possede'])and($_SESSION['filtreuser']!=''))
        //{
        //    $_SESSION['filtreuser']= $_SESSION['filtreuser'].' AND M.possede="oui"';   
        //}
        //if(isset($_POST['fini'])and($_SESSION['filtreuser']!=''))
        //{
        //    $_SESSION['filtreuser']= $_SESSION['filtreuser'].' AND M.fini="oui"';   
        //}
                
        
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
        $_SESSION['trifiltre']='SELECT * FROM jeux AS J WHERE  '.$_SESSION['filtrec'].$_SESSION['tri'].$_SESSION['ordretri'];    
        }
        else if(($_SESSION['filtrec']=="")and($_SESSION['filtreuser'])!=''){
        $_SESSION['trifiltre']=$_SESSION['filtreuser'].$_SESSION['tri'].$_SESSION['ordretri'];   
        }
        else if(($_SESSION['filtrec']=="")and($_SESSION['filtreuser'])==''){
        $_SESSION['trifiltre']='SELECT * FROM jeux AS J '.$_SESSION['tri'].$_SESSION['ordretri'];     
        }
        else if(($_SESSION['filtrec']!="")and($_SESSION['filtreuser'])!="" and($_SESSION['nbu']<1)){
        $_SESSION['trifiltre']=$_SESSION['filtreuser'].' AND '.$_SESSION['filtrec'].$_SESSION['tri'].$_SESSION['ordretri'];
        }
        else if(($_SESSION['filtrec']!="")and($_SESSION['filtreuser'])!="" and($_SESSION['nbu']>=1)){
        $_SESSION['trifiltre']=$_SESSION['filtreuser'].$_SESSION['tri'].$_SESSION['ordretri'];
        }
        
        //var_dump($_SESSION['trifiltre']);
        }
  
        
        }
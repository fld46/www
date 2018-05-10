<?php
require 'jeuxmanager.class.php';
require 'jeux.class.php';
//session_start();
?>
<
   <div class ="gauche">
        <form method="post">
            <fieldset><legend>Tri</legend>
            <p>
            <label>Titre</label> : <input type="radio" name="tri" value="titre" />
            </p>
            <p>
            <label>Temps</label> : <input type="radio" name="tri" value="temps" />
            </p>
            <p>
            <label>Difficulte</label> : <input type="radio" name="tri" value="difficulte" />
            </p>
            <p>
            croissant<input type="radio" name="ordretri" value="ASC" />decroissant<input type="radio" name="ordretri" value="DESC" />    
            </p>
            </fieldset>
            <fieldset><legend>Jeux</legend>
            <p>
            <label>Ps4</label> : <input type="checkbox" name="ps4" value="oui" />
            </p>
            <p>
            <label>Ps3</label> : <input type="checkbox" name="ps3" value="oui" />
            </p>
            <p>
            <label>Psvita</label> : <input type="checkbox" name="psvita" value="oui" />
            </p>
            <p>    
            <label>Multi</label> : <input type="checkbox" name="multi" value="oui" />
            </p>
            </fieldset>
            <fieldset><legend>User</legend>
            <br>user fini<br>
            </fieldset>
            <button class="tri">ok</button>
        </form>
        <?php
        // verif console
        if(!isset($_POST['ps4'])){
                $ps4="";
            }else{
                $ps4='ps4="'.$_POST['ps4'].'" ';
            }
            
        if(!isset($_POST['ps3'])){
                $ps3="";
            }else{
                if(isset($_POST['ps4'])){
                $ps3='AND ps3="'.$_POST['ps3'].'"';    
                }else{
                $ps3='ps3="'.$_POST['ps3'].'"';
            }
            }
            
        if(!isset($_POST['psvita'])){
                $psvita="";
            }else{
                if((isset($_POST['ps4']))OR(isset($_POST['ps3']))){
                 $psvita='AND psvita="'.$_POST['psvita'].'"';  
                }
                else{            
                $psvita='psvita="'.$_POST['psvita'].'"';
            }
            }
            
        if(!isset($_POST['multi'])){
                $multi="";
            }else{
                if((isset($_POST['ps4']))OR(isset($_POST['ps3']))OR(isset($_POST['psvita']))){
                $multi='AND multi="'.$_POST['multi'].'"';  
                }
                else{            
                $multi='multi="'.$_POST['multi'].'"';
            }
            }
            
        $_SESSION['filtrec']= $ps4.$ps3.$psvita.$multi;
        //echo $_SESSION['filtrec'];
        //verfif tri
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
                $tri='ORDER BY '.$_POST['tri'].' ';
                }
                //echo 'toto'.$_SESSION['filtrec'];
                //echo $tri;
            }
          $_SESSION['tri']= $tri;
          
          //ordre du tri
          //if( $_SESSION['tri']==''){
            //  $_SESSION['ordretri']= $_SESSION['tri'];
          //}
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
       
       ?>
    </div>
    <div class="droite">
    <table class="bas">
        <thead>
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <?php
        $db = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root' );
        $manager = new JeuxManager($db);
        $manager->getList();
        ?><!--<tr>
        <td><a href=''>Titre</a></td>
        <td>Temps</td>
        <td>Difficulte</td>
        <td>Multi</td>
        <td><div>Console</div></td>
        <td>User</td>
        </tr>-->
    </table>
    </div>
    


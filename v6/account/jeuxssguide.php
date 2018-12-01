<?php
if(!isset($_SESSION['auth']->droits)){
    require "../inc/bootstrap.php";
    App::redirectr('/v6/index.php');
}
$auth= App::getAuth();
$auth->restrict(Session::getInstance());
$db = App::getDatabase();
$stats = new Accountstat($db, $_SESSION['auth']->id);
?>
<div class="menu_gauche">
       <div class="liens_account">
           <fieldset><legend>Jeux sans guide</legend>
               <p><a href="pdf.php" target="new">PDF</a></p>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           <br>
           </fieldset>
       </div>
   </div>    
        <?php $stats->getListnonguide();?>
        
    </table>
    
    </div>

</div>

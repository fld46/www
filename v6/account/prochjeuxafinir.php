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
           <fieldset><legend>Prochains jeux a finir</legend>
               <p><a href="pdfaf.php" target="new">PDF</a></p>
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
<div class="droitec">
     <div class="droiteint">
        <table class="droit">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th class="temps">Temps</th>
                    <th class="">Difficulte</th>
                    
                    <th class="console">Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixec">
        <?php $stats->getNbjeuxSuggeresuivant();?>
        </tbody>
    </table>
    </div>
 </div>



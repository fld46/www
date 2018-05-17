<?php
$db = App::getDatabase();
$manager = new JeuxManager($db);
if(isset($_POST['selectj']))
   {
    $manager->get($_POST['titrejeux']);
}
if(isset($_POST['supj']))
{
$manager->deletej($_POST['titrejeux']);
App::redirect('supprimer.php');
 
}

if(!isset($_POST['selectj'])){
?>    

    <div class ="menu_gauche">
        <form method="post" class="form_ident">
            <fieldset><legend>Selectionner</legend>
            <br> <?php
                        $liste=new Datalist();
                        $liste->verifNav();
                        ?>
               
                <br><br>
                <button type="submit" name="selectj">SELECT</button>
            </fieldset>
        </form>    
    </div>
    <div class="droitec">
    <div class="droiteint">
    <table class="droit">
        <thead class="fixe">
                <tr class="titre">
                    <th class="titre">TITRE</th>
                    <th>Temps</th>
                    <th>Difficulte</th>
                    <th>Multi</th>
                    <th>Console</th>
                    <!--<th>User</th>-->
                </tr>
        </thead>
        <tbody class="fixec">
        <tr>
        <form method="post">
        <td class="titre"></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </form>
        </tr>
    </tbody>
    </table>
    </div>
    </div>
    
    <script src="datalist-polyfill.min.js"></script>


    
<?php

}

?>



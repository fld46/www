<html>
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="tounudanlescalier.css" />
   </head>
   <body>

      <?php
         try
	 {
         // On se connecte à MySQL
         $bdd = new PDO('mysql:host=localhost;dbname=tristan;charset=utf8', 'Tristan', 'tristantupu');
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
	 }
         catch(Exception $e)
	 {
         // En cas d'erreur, on affiche un message et on arrête tout
         die('Erreur : '.$e->getMessage());
	 }
         

	 if (!isset($_POST['tri']))
	 {
         $tri = 'nom';
	 }
	 else
	 {
	    switch ($_POST['tri'])
	    {
	       case 1:
		       $tri = 'nom';
		       break;
	       case 2:
		       $tri ='Qinit';
		       break;
	       case 3:
		       $tri = 'Qfin';
		       break;
	       case 4:
		       $tri = 'jeu';
		       break;
	       case 5:
		       $tri = 'poss';
		       break;
	       case 6:
		       $tri = 'stats';
		       break;
	       case 7:
		       $tri = 'armes';
		       break;
	       case 8:
		       $tri = 'tueurs';
		       break;
	       case 9:
		       $tri = 'event';
		       break;
	       default:
		       $tri = 'nom';
	    }
	 //$tri = $_POST['tri'];
	 }

         // Si tout va bien, on peut continuer
         // On récupère tout le contenu de la table jeux_video
	 $reponse = $bdd->prepare("SELECT * FROM test ORDER BY ".$tri);
	 $reponse->execute();
         $ncol = 9;
	 $num_col = 1;
      ?>

      <table>
         <thead>
	    <tr>
	       <?php
	 	  while ($num_col <= $ncol)
	  	  {
                       
	       ?>
		     <th>
			<center>
			   <form method="post">
                               <button name="tri" type="submit" value="<?php echo $num_col; ?>">ce que tu veux</button>
                              
			   </form>
			</center>
		     </th>
	       <?php
		     $num_col++;
	          }
	       ?>
	    </tr>
         </thead>

         <tbody>
            <?php
               // On affiche chaque entrée une à une
               while ($donnees = $reponse->fetch())
               {
            ?>
            <tr>
	       <td><center><?php echo $donnees{'nom'} ?></center></td>
	       <td><center><?php echo $donnees{'Qinit'} ?></center></td>
               <td><center><?php echo $donnees{'Qfin'} ?></center></td>
	       <td><center><?php echo $donnees{'jeu'} ?></center></td>
	       <td><center><?php echo $donnees{'poss'} ?></center></td>
               <td><?php echo $donnees{'stats'} ?></td>
	       <td><?php echo $donnees{'armes'} ?></td>
	       <td><?php echo $donnees{'tueurs'} ?></td>
               <td><center><?php echo $donnees{'event'} ?></center></td>
	    </tr>
            <?php
               }
            ?>
         </tbody>
      </table>
   </body>
</html>

<?php
   $reponse->closeCursor(); // Termine le traitement de la requête
?>

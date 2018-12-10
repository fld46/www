<?php
require('pdf/fpdf.php');
require "inc/bootstrap.php";
$auth=App::getAuth()->restrict();
$db=App::getDatabase();
$stats = new Accountstat($db, $_SESSION['auth']->id);
// connexion base de données
//$db_server = "localhost";
//$db_user = "root";
//$db_pass = "et2tcmdp";
//$db_name = "sitejeuxv2";
//function connect($db_server, $db_user, $db_pass, $db) {
//    if (!($link= mysql_connect($db_server,$db_user,$db_pass))) {
//        exit();
//    }
 //   if (!(mysql_select_db($db,$link))) {
 //       exit();
 //   }
 //   return $link;
//}

//$connexion=mysql_connconnect($db_server,$db_user,$db_pass,$db_name);
$pdo = new PDO('mysql:host=localhost;dbname=sitejeuxv3', 'root', 'et2tcmdp');
// classe étendue pour créer en-tête et pied de page
class PDF extends FPDF
{
// en-tête
function Header()
{
    global $site_footer;
    $pdo = new PDO('mysql:host=localhost;dbname=sitejeuxv3', 'root', 'et2tcmdp');
    $sql = 'SELECT * FROM jeux WHERE liens="" ORDER BY titre ASC' ;
    $stmt 	= $pdo->prepare($sql); // Prevent MySQl injection. $stmt means statement
    $stmt->execute();
    $nb=$stmt->rowCount();
    //Police Arial gras 15
    $this->SetFont('Arial','B',14);
    //Décalage à droite
    $this->Cell(80);
    //Titre
    $this->Cell(130,10,$site_footer,0,0,'C');
    //Saut de ligne
    $this->Ln(20);
}

// pied de page
function Footer()
{
    //Positionnement à 1,5 cm du bas
    $this->SetY(-15);
    //Police Arial italique 8
    $this->SetFont('Arial','I',8);
    //Numéro de page
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// requête
$sql = 'SELECT * FROM jeux WHERE liens="" AND ps4="oui" ORDER BY titre ASC' ;
$stmt 	= $pdo->prepare($sql); // Prevent MySQl injection. $stmt means statement
$stmt->execute();
$nb=$stmt->rowCount();
$site_footer="Liste de jeux PS4 sans guide (".$nb.")";
// création du pdf
$w = array(130, 25, 40, 80);
$pdf=new PDF('L','mm','A4');
$pdf->SetAuthor('fld');
$pdf->SetTitle('Liste des jeux sans guide');
$pdf->SetSubject('jeux');
$pdf->SetCreator('fld');
$pdf->AliasNBPages();
$pdf->AddPage();
$pdf->SetFillColor(198,237,232);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell($w[0],6,'Titres',1,0,'C',true);
$pdf->Cell($w[1],6,'Multi',1,0,'C',true);
//$pdf->Cell($w[2],6,'Consoles',1,0,'C',true);
$pdf->Cell($w[3],6,'Commentaires',1,0,'C',true);
$pdf->Ln();

// on boucle  
    while ($row = $stmt->fetch()) {
        if(($row["ps4"]!="")&&($row["ps4"]!="non")){
                    $ps4="ps4";
                }else{
                    $ps4="";
                }
                if(($row["ps3"]!="")&&($row["ps3"]!="non")){
                    $ps3="ps3 ";
                }else{
                    $ps3="";
                }
                if(($row["psvita"]!="")&&($row["psvita"]!="non")){
                    $psvita="psvita ";
                }else{
                    $psvita="";
                }
        $id = $row["id"];
        $titre = utf8_decode($row["titre"]);
        $description = $row["multi"];
        $comments = utf8_decode($row["comments"]);
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell($w[0],6,$titre,1,0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[1],6,$description,1,0,'C');
        //$pdf->SetFont('Arial','',8);
        //$pdf->Cell($w[2],6,$psvita.$ps3.$ps4,1,0,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[3],6,$comments,1,0,'L');
       
      
        $pdf->Ln();
    }
    // requête
$sql = 'SELECT * FROM jeux WHERE liens="" AND ps3="oui" ORDER BY titre ASC' ;
$stmt 	= $pdo->prepare($sql); // Prevent MySQl injection. $stmt means statement
$stmt->execute();
$nb=$stmt->rowCount();
$site_footer="Liste de jeux PS3 sans guide (".$nb.")";
// création du pdf

$pdf->AliasNBPages();
$pdf->AddPage();
$pdf->SetFillColor(198,237,232);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell($w[0],6,'Titres',1,0,'C',true);
$pdf->Cell($w[1],6,'Multi',1,0,'C',true);
//$pdf->Cell($w[2],6,'Consoles',1,0,'C',true);
$pdf->Cell($w[3],6,'Commentaires',1,0,'C',true);
$pdf->Ln();

// on boucle  
    while ($row = $stmt->fetch()) {
        if(($row["ps4"]!="")&&($row["ps4"]!="non")){
                    $ps4="ps4";
                }else{
                    $ps4="";
                }
                if(($row["ps3"]!="")&&($row["ps3"]!="non")){
                    $ps3="ps3 ";
                }else{
                    $ps3="";
                }
                if(($row["psvita"]!="")&&($row["psvita"]!="non")){
                    $psvita="psvita ";
                }else{
                    $psvita="";
                }
        $id = $row["id"];
        $titre = utf8_decode($row["titre"]);
        $description = $row["multi"];
        $comments = utf8_decode($row["comments"]);
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell($w[0],6,$titre,1,0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[1],6,$description,1,0,'C');
        //$pdf->SetFont('Arial','',8);
        //$pdf->Cell($w[2],6,$psvita.$ps3.$ps4,1,0,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[3],6,$comments,1,0,'L');
       
      
        $pdf->Ln();
    }
    // requête
$sql = 'SELECT * FROM jeux WHERE liens="" AND psvita="oui" ORDER BY titre ASC' ;
$stmt 	= $pdo->prepare($sql); // Prevent MySQl injection. $stmt means statement
$stmt->execute();
$nb=$stmt->rowCount();
$site_footer="Liste de jeux PSVITA sans guide (".$nb.")";
// création du pdf

$pdf->AliasNBPages();
$pdf->AddPage();
$pdf->SetFillColor(198,237,232);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.3);
$pdf->SetFont('','B');
$pdf->Cell($w[0],6,'Titres',1,0,'C',true);
$pdf->Cell($w[1],6,'Multi',1,0,'C',true);
//$pdf->Cell($w[2],6,'Consoles',1,0,'C',true);
$pdf->Cell($w[3],6,'Commentaires',1,0,'C',true);
$pdf->Ln();

// on boucle  
    while ($row = $stmt->fetch()) {
        if(($row["ps4"]!="")&&($row["ps4"]!="non")){
                    $ps4="ps4";
                }else{
                    $ps4="";
                }
                if(($row["ps3"]!="")&&($row["ps3"]!="non")){
                    $ps3="ps3 ";
                }else{
                    $ps3="";
                }
                if(($row["psvita"]!="")&&($row["psvita"]!="non")){
                    $psvita="psvita ";
                }else{
                    $psvita="";
                }
        $id = $row["id"];
        $titre = utf8_decode($row["titre"]);
        $description = $row["multi"];
        $comments = utf8_decode($row["comments"]);
        $pdf->SetFillColor(224,235,255);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell($w[0],6,$titre,1,0,'L');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[1],6,$description,1,0,'C');
        //$pdf->SetFont('Arial','',8);
        //$pdf->Cell($w[2],6,$psvita.$ps3.$ps4,1,0,'C');
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[3],6,$comments,1,0,'L');
       
      
        $pdf->Ln();
    }
// sortie du fichier
$pdf->Output('Jeuxsansguide.pdf', 'I');

<?php
// la classe de fonctions
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
$pdo = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root', 'et2tcmdp');
// classe étendue pour créer en-tête et pied de page
class PDF extends FPDF
{
// en-tête
function Header()
{
    $pdo = new PDO('mysql:host=localhost;dbname=sitejeuxv2', 'root', 'et2tcmdp');
    $req = $pdo->prepare('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui"   ORDER BY J.titre ');
    $req->execute([$_SESSION['auth']->id]);
    $nb=$req->rowCount();
    //Police Arial gras 15
    $this->SetFont('Arial','B',14);
    //Décalage à droite
    $this->Cell(80);
    //Titre
    $this->Cell(130,10,'Jeux Playstation ('.$nb.')',0,0,'C');
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
// création du pdf
$w = array(100, 25, 40, 80,15);
$pdf=new PDF('L','mm','A4');
$pdf->SetAuthor('fld');
$pdf->SetTitle('Liste des jeux');
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
$pdf->Cell($w[4],6,'Diff',1,0,'C',true);
$pdf->Cell($w[4],6,'Tps',1,0,'C',true);
$pdf->Cell($w[1],6,'Multi',1,0,'C',true);
$pdf->Cell($w[2],6,'Consoles',1,0,'C',true);
$pdf->Cell($w[3],6,'Commentaires',1,0,'C',true);
$pdf->Ln();
// requête
$req = $pdo->prepare('SELECT * FROM jeux AS J,maintable AS M WHERE  M.idjeux=J.id AND M.idusers= ? AND M.possede="oui"   ORDER BY J.titre ');
$req->execute([$_SESSION['auth']->id]);
//$nb=$req->rowCount();

while ($row = $req->fetch())
                {
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
// on boucle  
    //while ($row = $stmt->fetch()) {
        $id = $row["id"];
        $titre = utf8_decode($row["titre"]);
        $description = $row["multi"];
        $comments = utf8_decode($row["comments"]);
        $temps = $row["temps"];
        $diff = $row["difficulte"];
        $liens= $row["liens"];
        if ($row["fini"]== "oui"){
            $fill=true;
        }else{
            $fill=false;
        }
        $pdf->SetFillColor(246,43,43);
        $pdf->SetTextColor(0);
        $pdf->SetFont('');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell($w[0],6,$titre,1,0,'L',$fill,$liens);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[4],6,$diff,1,0,'C',$fill);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[4],6,$temps,1,0,'C',$fill);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[1],6,$description,1,0,'C',$fill);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[2],6,$psvita.$ps3.$ps4,1,0,'C',$fill);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell($w[3],6,$comments,1,0,'L',$fill);
        $pdf->Ln();
        
    }

    
// sortie du fichier
$pdf->Output('Jeuxps.pdf', 'I');

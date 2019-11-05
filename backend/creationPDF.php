<?php

require "fpdf.php";
include_once "bddPlongee.php";

$bdd = new bddPlongee();



$dateplongee = "'".$_GET['dateplongee']."'";
$seanceplongee = "'".$_GET['seance']."'";

$reqPlongee = "SELECT * FROM PLO_PLONGEE JOIN PLO_SITE USING(SIT_NUM) WHERE PLO_DATE = $dateplongee AND PLO_MAT_MID_SOI = $seanceplongee";
$reqPalanquees = "SELECT * FROM PLO_PALANQUEE WHERE PLO_DATE = $dateplongee AND PLO_MAT_MID_SOI = $seanceplongee";



$resPlongee = $bdd->exec($reqPlongee);

$resPalanquees = $bdd->exec($reqPalanquees);


$siteplongee = $resPlongee[0]['SIT_NOM'].", ".$resPlongee[0]['SIT_LOCALISATION'];

$numDir = "'".$resPlongee[0]['PER_NUM_DIR']."'";
$reqdir = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $numDir";
$resDir = $bdd->exec($reqdir);
$directeur = $resDir[0]['PER_NOM']." ".$resDir[0]['PER_PRENOM'];

$numSecu = "'".$resPlongee[0]['PER_NUM_SECU']."'";
$reqSecu = "SELECT PER_NOM, PER_PRENOM FROM PLO_PERSONNE WHERE PER_NUM = $numSecu";
$resSecu = $bdd->exec($reqSecu);
$securite = $resSecu[0]['PER_NOM']." ".$resSecu[0]['PER_PRENOM'];


$effectifbat = $resPlongee[0]['PLO_EFFECTIF_BATEAU'] ;





class myPDF extends FPDF{
    public function Header()
    {
        $this->Image('../images/logo-carantec_nautisme.jpg',10,6,70,20);
        $this->SetFont('Arial','B',25);
        $this->Cell(270,10,"FICHE DE SECURITE",0,0,'C');
        $this->Ln();
        //$this->SetFont('Times','',12);
        //$this->Cell(270,5,"Thomas",0,0,'C');

    }


    function headerTable($date,$site,$dir,$sec,$eff){
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Date',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,$date,1,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Site de plongee',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,$site,1,0,'C');
        $this->Ln();


        $this->SetFont('Times','B',12);
        $this->Ln();
        $this->Cell(50,10,'Directeur de plongee',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,$dir,1,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Securite de surface',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,$sec,1,0,'C');
        $this->Ln();


        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Effectif',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,$eff,1,0,'C');
        $this->Ln();


    }

    function palanquee($heuredep,$heureret,$tempsprev,$profprev,$tempsrea,$profreal){
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(185,10,'Palanquee n1',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Heure de depart',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$heuredep,1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Heure de retour',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$heureret,1,0,'C');

        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Temps prevu',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$tempsprev,1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Profondeur prevu',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$profprev,1,0,'C');

        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Temps realise',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$tempsrea,1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Profondeur realise',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,$profreal,1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(92.5,10,'Nom Prenom',1,0,'C');
        $this->Cell(92.5,10,'Niveau',1,0,'C');
        $this->Ln();








    }

    function ajoutNomNiveau($nom,$niv){
        $this->SetFont('Times','',12);
        $this->Cell(92.5,10,$nom,1,0,'C');
        $this->Cell(92.5,10,$niv,1,0,'C');
        $this->Ln();
    }

}







$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable($dateplongee,$siteplongee,$directeur,$securite,$effectifbat);


for ($i = 0; $i<sizeof($resPalanquees); $i++) {

    $heuredep = $resPalanquees[$i]['PAL_HEURE_IMMERSION'];
    $heuresorti = $resPalanquees[$i]['PAL_HEURE_SORTIE_EAU'];
    if (!empty($resPalanquees[$i]['PAL_DUREE_PREVUE'])) {
        $dureepre = $resPalanquees[$i]['PAL_DUREE_PREVUE'] . " min";
    } else {
        $dureepre = "/";
    }


    if (!empty($resPalanquees[$i]['PAL_PROFONDEUR_PREVU'])) {
        $profpre = $resPalanquees[$i]['PAL_PROFONDEUR_PREVU'] . " m";
    }else{
        $profpre = "/";
    }

    if (!empty($resPalanquees[$i]['PAL_DUREE_FOND'])) {
        $dureefinal = $resPalanquees[$i]['PAL_DUREE_FOND'] . " min";
    }else{
        $dureefinal = "/";
    }

    if (!empty($resPalanquees[$i]['PAL_PROFONDEUR_REELLE'])) {
        $profreel = $resPalanquees[$i]['PAL_PROFONDEUR_REELLE'] . " m";
    }else{
        $profreel = "/";
    }


    $pdf->palanquee($heuredep,$heuresorti,$dureepre,$profpre,$dureefinal,$profreel);

    $numPal = "'".$resPalanquees[$i]['PAL_NUM']."'";
    $reqPlongeur = "SELECT * FROM PLO_PALANQUEE JOIN PLO_CONCERNER USING (PLO_DATE,PLO_MAT_MID_SOI,PAL_NUM) JOIN PLO_PLONGEUR USING (PER_NUM) JOIN PLO_PERSONNE USING (PER_NUM) JOIN PLO_APTITUDE USING (APT_CODE) WHERE PLO_DATE = $dateplongee AND PLO_MAT_MID_SOI = $seanceplongee AND PAL_NUM=$numPal";
    $reqPlongeur = $bdd->exec($reqPlongeur);
    for ($j=0 ; $j<sizeof($reqPlongeur); $j++){
            $nomPlongeur = $reqPlongeur[$j]['PER_NOM']." ".$reqPlongeur[$j]['PER_PRENOM'];
            $nivPlongeur = $reqPlongeur[$j]['APT_LIBELLE'];
            $pdf->ajoutNomNiveau($nomPlongeur,$nivPlongeur);

    }

}




$pdf->Output();

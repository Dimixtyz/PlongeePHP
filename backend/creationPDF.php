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

var_dump($resPlongee);

$siteplongee = $resPlongee[0]['SIT_NOM'].", ".$resPlongee[0]['SIT_LOCALISATION'];







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


    function headerTable($date,$site){
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
        $this->Cell(50,10,'thomas lala',1,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Securite de surface',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'Benjamin FONTAINE',1,0,'C');
        $this->Ln();


        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Effectif',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'12 personnes',1,0,'C');
        $this->Ln();


    }

    function palanquee(){
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(185,10,'Palanquee n1',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Heure de depart',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'12h55',1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Heure de retour',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'13h30',1,0,'C');

        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Temps prevu',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'3min',1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Profondeur prevu',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'6min',1,0,'C');

        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Temps realise',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'3min',1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(46.25,10,'Profondeur realise',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(46.25,10,'2min',1,0,'C');

        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(92.5,10,'Nom Prenom',1,0,'C');
        $this->Cell(92.5,10,'Niveau',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);







    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable($dateplongee,$siteplongee);
$pdf->palanquee();
$pdf->Output();

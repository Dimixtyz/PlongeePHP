<?php

require "fpdf.php";



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


    function headerTable(){
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Date',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'12-05-13',1,0,'C');
        $this->Ln();

        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Site de plongee',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'Villers sur Mer',1,0,'C');
        $this->Ln();


        $this->SetFont('Times','B',12);
        $this->Ln();
        $this->Cell(50,10,'Directeur de plongee',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'Thomas LAPIERRE',1,0,'C');
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
        $this->Cell(200,10,'Palanquee n1',1,0,'C');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Heure de depart',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'12h55',1,0,'C');
        $this->SetFont('Times','B',12);
        $this->Cell(50,10,'Heure de retour',1,0,'C');
        $this->SetFont('Times','',12);
        $this->Cell(50,10,'13h30',1,0,'C');

    }

}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->palanquee();
$pdf->Output();

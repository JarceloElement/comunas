<?php
require('../assets/fpdf/fpdf.php');
require ('../core/app/view/conexion.php');


class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        // $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',16);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Reportes',0,0,'C');
        // Line break
        $this->Ln(20);

        // $this->Cell(40,10,utf8_decode("Código Inf."),1,0,"C",0);
        // // $this->MultiCell(40,10,utf8_decode("Línea de Acción y mas"),1,"C",0);
        // $this->Cell(40,10,utf8_decode("Línea de Acción y mas"),1,0,"C",0);
        // $this->Cell(80,10,utf8_decode("Título Act."),1,1,"C",0);

    }

    // // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',12);
        // Page number
        $this->Cell(0,10, ('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }












    // Colored table
    function FancyTable()
    {
        // Colors, line width and bold font
        $this->SetFillColor(0,205,255);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        
        // Header
        $header = array('Código', 'Línea de acción', 'Título de la actividad',);

        $w = array(30, 40, 80);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,($header[$i]),1,0,'C',true);
        $this->Ln();
        
        // Color and font restoration
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        $this->SetFont('');
        
        // Data
        $fill = false;
        
        $db = Database::connect();
        
        // $id_estado = $_POST['id_estado'];
        
        $statement_1 = $db->query("SELECT * FROM reports ");
        $res = $statement_1->fetchAll();
        Database::disconnect();

        if(isset($res)){
            foreach ($res as $row){
                // $pdf->Cell(40,10,utf8_decode($row['code_info']),1,0,"C",0);
                $this->Cell(30,10,($row['code_info']),'LR',0,'L',$fill);
                $this->Cell(40,10,($row['line_action']),'LR',0,'L',$fill);
                // $this->MultiCell(40,10,utf8_decode($row['line_action']),1,"C");
                $this->Cell(80,10,($row['activity_title']),'LR',0,'L',$fill);
                $this->Ln();
                $fill = !$fill;
            }
        }


        // Closing line
        $this->Cell(array_sum($w),0,'','T');
        

    }


}


$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages(); # para la numeracion de la p
$pdf->SetFont('Arial','',12);

$pdf->FancyTable();
$pdf->Output();


?>

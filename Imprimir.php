<?php

include('FPDF/fpdf.php');
include('includes/conectar.php');

class PDF extends FPDF{

	function Header(){
		$this->Image('img/Logo-UJAP2.jpg', 2, 2, 2.5, 2.5, 'JPG');
		$this->SetXY(1, 2.2);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(4);
		$this->Cell(15, 0.6, 'UNIVERSIDAD JOSE ANTONIO PAEZ', 1, 0, "L");
		$this->Ln();
		$this->Cell(4);
		$this->Cell(15, 0.6, 'VICERRECTORADO ACADEMICO', 1, 0, "L");
		$this->Ln();
		$this->Cell(4);
		$this->Cell(15, 0.6, 'COORDINACION DE EVALUACION DOCENTE', 1, 0, "L");
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Cell(3);
		$this->Cell(15, 0.6, 'Reporte de EvaluaciOn de Desempeño AcadEmico', 1, 0, "C");
	}
}

$pdf = new PDF("P", "cm", "Letter");
$pdf->AddPage();
$pdf->SetMargins(3, 3, 3, 3);
$pdf->SetFont('Times','',12);
//Aquí escribimos lo que deseamos mostrar
$pdf->Output();

?>
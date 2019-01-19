<?php

require('FPDF/fpdf.php');
include('includes/conectar.php');

$tipo = $_GET['tipo'];
$periodo = $_GET['periodo'];
$docente = $_GET['docente'];
$acta = $_GET['acta'];

if($acta == 0){

	$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' GROUP BY topico");
	$consulta = $conexion->query("SELECT alumnos.alumno FROM alumnos INNER JOIN respuestas ON alumnos.acta = respuestas.acta WHERE respuestas.docente = '$docente' GROUP BY alumnos.alumno");
	$totalEv = $conexion->query("SELECT SUM(evaluado) AS total FROM alumnos WHERE evaluado='1' AND acta IN (SELECT acta FROM respuestas WHERE docente = '$docente')");

}else{

	$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' AND acta = '$acta'");
	$consulta = $conexion->query("SELECT alumnos.alumno FROM alumnos INNER JOIN respuestas ON alumnos.acta = respuestas.acta WHERE respuestas.docente = '$docente' AND respuestas.acta = '$acta' GROUP BY alumnos.alumno");
	$totalEv = $conexion->query("SELECT SUM(evaluado) AS total FROM alumnos WHERE evaluado='1' AND acta='$acta'");

}

$evaluacion = 0;

class PDF extends FPDF{

	function Header(){
		$this->Image('img/Logo-UJAP2.jpg', 2, 2, 2.5, 2.5, 'JPG');
		$this->SetXY(1, 2.2);

		$this->Cell(4);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(15, 0.6, 'UNIVERSIDAD JOSE ANTONIO PAEZ', 0, 0, "L");

		$this->Ln();
		$this->Cell(4);
		$this->Cell(15, 0.6, 'VICERRECTORADO ACADEMICO', 0, 0, "L");

		$this->Ln();
		$this->Cell(4);
		$this->Cell(15, 0.6, 'COORDINACION DE EVALUACION DOCENTE', 0, 0, "L");

		$this->Ln();
		$this->Ln();

		$this->Ln();
		$this->Cell(3);
		$this->Cell(15, 0.6, 'Reporte de Evaluacion de Desempeno Academico', 0, 0, "C");

		$this->Ln();
		$this->Cell(3);
		$this->SetFont('Times', '', 10);
		$this->Cell(15, 0.6, 'Periodo lectivo '.$_GET['periodo'].'', 0, 0, "C");

		$this->Ln();
		$this->Cell(1);
		$this->SetFont('Times', 'B', 12);
		if($_GET['acta']==0){
			$this->Cell(18, 0.6, 'Acta No.: Evaluacion general', 0, 0, "L");
		}else{
			$this->Cell(18, 0.6, 'Acta No.: '.$_GET['acta'], 0, 0, "L");
		}

		$this->Ln();
		$this->Cell(1);
		$this->SetFont('Times', 'B', 12);
		$this->Cell(18, 0.6, 'Docente: '.$_GET['docente'], 0, 0, "L");
	}
}

$pdf = new PDF("P", "cm", "Letter");
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(249, 57, 57);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(1);
$pdf->Cell(9, 0.6, 'Item', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, '5', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, '4', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, '3', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, '2', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, '1', 1, 0, "C", 1);
$pdf->Cell(1.5, 0.6, 'Total', 1, 0, "C", 1);

$pdf->Ln();
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times', '', 8);

while($valores = mysqli_fetch_array($query)){
	$topico = utf8_decode($valores['topico']);
	$acta = utf8_encode($valores['acta']);
	$docente = utf8_encode($valores['docente']);
	$periodo = utf8_encode($valores['periodo']);
	$mb = utf8_encode($valores['muy_bueno']);
	$b = utf8_encode($valores['bueno']);
	$a = utf8_encode($valores['aceptable']);
	$d = utf8_encode($valores['deficiente']);
	$md = utf8_encode($valores['muy_deficiente']);
	$total = utf8_encode($valores['total']);

	$valor = (($mb*5)+($b*4)+($a*3)+($d*2)+($md*1))/$total;

	$valoracion = number_format($valor, 2, '.', '');

	$pdf->Cell(1);
	$pdf->Cell(9, 0.6, $topico, 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $mb.' ('.($mb*100)/$total.'%)', 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $b.' ('.($b*100)/$total.'%)', 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $a.' ('.($a*100)/$total.'%)', 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $d.' ('.($d*100)/$total.'%)', 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $md.' ('.($md*100)/$total.'%)', 1, 0, "C", 1);
	$pdf->Cell(1.5, 0.6, $valoracion, 1, 0, "C", 1);
	$pdf->Ln();

	$evaluacion = $evaluacion + $valoracion;
}

$evaluacionT = number_format(($evaluacion / mysqli_num_rows($query)), 2, '.', '');

$pdf->Ln();
$pdf->Ln();
$pdf->SetFillColor(249, 57, 57);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times', 'B', 12);
$pdf->Cell(1);
$pdf->Cell(5, 0.6, 'Docente', 1, 0, "C", 1);
$pdf->Cell(1.2);
$pdf->Cell(5, 0.6, utf8_decode('Evluación'), 1, 0, "C", 1);
$pdf->Cell(1.2);
$pdf->Cell(5, 0.6, utf8_decode('Escalas de evaluación'), 1, 0, "C", 1);

$pdf->Ln();
$pdf->SetFillColor(255);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetFont('Times', '', 8);

$pdf->Cell(1);
$pdf->Cell(2.5, 0.6, 'Inscritos', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Encuestados', 1, 0, "C", 1);
$pdf->Cell(1.2);
$pdf->Cell(2.5, 0.6, $evaluacionT, 1, 0, "C", 1);
if($evaluacionT > 4.50 && $evaluacionT < 5.00){
	$pdf->Cell(2.5, 0.6, 'Muy bueno', 1, 0, "C", 1);
}elseif($evaluacionT > 3.50 && $evaluacionT < 4.49){
	$pdf->Cell(2.5, 0.6, 'Bueno', 1, 0, "C", 1);
}elseif($evaluacionT > 2.50 && $evaluacionT < 3.49){
	$pdf->Cell(2.5, 0.6, 'Aceptable', 1, 0, "C", 1);
}elseif($evaluacionT > 1.50 && $evaluacionT < 2.49){
	$pdf->Cell(2.5, 0.6, 'Deficiente', 1, 0, "C", 1);
}elseif($evaluacionT > 1.00 && $evaluacionT < 1.49){
	$pdf->Cell(2.5, 0.6, 'Muy deficiente', 1, 0, "C", 1);
}
$pdf->Cell(1.2);
$pdf->Cell(2.5, 0.6, '4.50 -> 5', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Muy bueno', 1, 0, "C", 1);

$pdf->Ln();
$pdf->Cell(1);
$pdf->Cell(2.5, 0.6, mysqli_num_rows($consulta) , 1, 0, "C", 1);
while($valores = mysqli_fetch_array($totalEv)){
	$pdf->Cell(2.5, 0.6, ''.$valores['total'].' ('.number_format(($valores['total']*100)/mysqli_num_rows($consulta), 2, '.', '').'%)', 1, 0, "C", 1);
}
$pdf->Cell(7.4);
$pdf->Cell(2.5, 0.6, '3.50 -> 4.49', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Bueno', 1, 0, "C", 1);

$pdf->Ln();
$pdf->Cell(13.4);
$pdf->Cell(2.5, 0.6, '2.50 -> 3.49', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Aceptable', 1, 0, "C", 1);

$pdf->Ln();
$pdf->Cell(13.4);
$pdf->Cell(2.5, 0.6, '1.50 -> 2.49', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Deficiente', 1, 0, "C", 1);

$pdf->Ln();
$pdf->Cell(13.4);
$pdf->Cell(2.5, 0.6, '1.00 -> 1.49', 1, 0, "C", 1);
$pdf->Cell(2.5, 0.6, 'Muy Deficiente', 1, 0, "C", 1);

$pdf->Output();

?>
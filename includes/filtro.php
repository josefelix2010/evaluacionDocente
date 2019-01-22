<?php

include("conectar.php");

$tipo = $_POST['tipo'];
$periodo = $_POST['periodo'];
$docente = $_POST['docente'];
$acta = $_POST['acta'];
$comentario = '';

if($tipo==1){

	if($acta == 0){
		$query = $conexion->query("SELECT * FROM respuestascoor WHERE periodo='$periodo' AND docente='$docente' GROUP BY topico");
	}else{
		$query = $conexion->query("SELECT * FROM respuestascoor WHERE periodo='$periodo' AND docente='$docente' AND acta='$acta'");
	}

	echo '<div class="col s12 m12 l12">';

	echo '<div class="row">';

	echo '<table class="striped centered responsive-table" style="width: 60%;">';
	echo '<tbody>';

	echo '<tr>';
	echo '<th>Docente</th>';
	echo '<th>Acta</th>';
	echo '<th>Período</th>';
	echo '</tr>';

	echo '<tr>';
	echo '<td>'.$docente.'</td>';
	if($acta == 0){
		echo '<td>Evaluación general</td>';
	}else{
		echo '<td>'.$acta.'</td>';
	}
	echo '<td>'.$periodo.'</td>';
	echo '</tr>';

	echo '</tbody>';
	echo '</table>';

	echo '</div>';

	echo '</div>';

	echo '<br>';



		echo '<table class="striped centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '<th>#</th>';
		echo '<th>Ítem</th>';
		echo '<th>Respuesta</th>';
		echo '</tr>';

		$evaluacion = 0;
		$count = 1;

		while($valores = mysqli_fetch_array($query)){
			$topico = utf8_encode($valores['topico']);
			$acta = utf8_encode($valores['acta']);
			$periodo = utf8_encode($valores['periodo']);
			$respuesta = utf8_encode($valores['respuesta']);
			$comentario = utf8_encode($valores['comentario']);

			$valoracion = number_format(($respuesta*0.5), 2, '.', '');

			echo '<tr>';
			echo '<td>'.$count.'</td>';
			echo '<td>'.$topico.'</td>';
			echo '<td>'.$respuesta.'</td>';
			echo '</tr>';

			$evaluacion = $evaluacion + $valoracion;

			$count++;

		}

		$evaluacionT = number_format(($evaluacion / 4.2), 2, '.', '');

		echo '</tbody>';
		echo '</table>';


		echo '<br>';


		echo '<div class="row">';

		echo '<div class="col s6 m6 l6">';

		echo '<table class="centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '<th>Comentario</th>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>'.$comentario.'</td>';
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';

		echo '</div>';


		echo '<div class="col s2 m2 l2">';

		echo '<table class="centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '</tr>';

		echo '<tr>';
		echo '<th colspan="2">Evaluación</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>'.$evaluacionT.'</td>';
		if($evaluacionT > 4.50 && $evaluacionT < 5.00){
			echo '<td>Muy bueno</td>';
		}elseif($evaluacionT > 3.50 && $evaluacionT < 4.49){
			echo '<td>Bueno</td>';
		}elseif($evaluacionT > 2.50 && $evaluacionT < 3.49){
			echo '<td>Aceptable</td>';
		}elseif($evaluacionT > 1.50 && $evaluacionT < 2.49){
			echo '<td>Deficiente</td>';
		}elseif($evaluacionT > 1.00 && $evaluacionT < 1.49){
			echo '<td>Muy deficiente</td>';
		}
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';

		echo '</div>';


		echo '<div class="col s4 m4 l4">';
		echo '<table class="responsive-table centered">';
        echo '<thead>';
        echo '<th colspan="2">Escalas de evaluación</th>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>4.50 -> 5</td>';
        echo '<td>Muy bueno</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>3.50 -> 4.49</td>';
        echo '<td>Bueno</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>2.50 -> 3.49</td>';
        echo '<td>Aceptable</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>1.50 -> 2.49</td>';
        echo '<td>Deficiente</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>1 -> 1.49</td>';
        echo '<td>Muy deficiente</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
		echo '</div>';


		echo '</div>';

		echo '</div>';

}else{

	if($acta == 0){
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' GROUP BY topico");
		$consulta = $conexion->query("SELECT alumnos.alumno FROM alumnos INNER JOIN respuestas ON alumnos.acta = respuestas.acta WHERE respuestas.docente = '$docente' GROUP BY alumnos.alumno");
		$totalEv = $conexion->query("SELECT SUM(evaluado) AS total FROM alumnos WHERE evaluado='1' AND acta IN (SELECT acta FROM respuestas WHERE docente = '$docente')");
	}else{
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' AND acta = '$acta'");
		$consulta = $conexion->query("SELECT alumnos.alumno FROM alumnos INNER JOIN respuestas ON alumnos.acta = respuestas.acta WHERE respuestas.docente = '$docente' AND respuestas.acta = '$acta' GROUP BY alumnos.alumno");
		$totalEv = $conexion->query("SELECT SUM(evaluado) AS total FROM alumnos WHERE evaluado='1' AND acta='$acta'");
	}

	echo '<div class="col s12 m12 l12">';

	echo '<div class="row">';

	echo '<table class="striped centered responsive-table" style="width: 60%;">';
	echo '<tbody>';

	echo '<tr>';
	echo '<th>Docente</th>';
	echo '<th>Acta</th>';
	echo '<th>Período</th>';
	echo '</tr>';

	echo '<tr>';
	echo '<td>'.$docente.'</td>';
	if($acta == 0){
		echo '<td>Evaluación general</td>';
	}else{
		echo '<td>'.$acta.'</td>';
	}
	echo '<td>'.$periodo.'</td>';
	echo '</tr>';

	echo '</tbody>';
	echo '</table>';

	echo '</div>';

	echo '</div>';

	echo '<br>';



		echo '<table class="striped centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '<th>Ítem</th>';
		echo '<th>Muy Bueno</th>';
		echo '<th>Bueno</th>';
		echo '<th>Aceptable</th>';
		echo '<th>Deficiente</th>';
		echo '<th>Muy Deficiente</th>';
		echo '<th>Total</th>';
		echo '</tr>';

		$evaluacion = 0;

		while($valores = mysqli_fetch_array($query)){
			$topico = utf8_encode($valores['topico']);
			$acta = utf8_encode($valores['acta']);
			$periodo = utf8_encode($valores['periodo']);
			$mb = utf8_encode($valores['muy_bueno']);
			$b = utf8_encode($valores['bueno']);
			$a = utf8_encode($valores['aceptable']);
			$d = utf8_encode($valores['deficiente']);
			$md = utf8_encode($valores['muy_deficiente']);
			$total = utf8_encode($valores['total']);

			$valor = (($mb*5)+($b*4)+($a*3)+($d*2)+($md*1))/$total;

			$valoracion = number_format($valor, 2, '.', '');

			echo '<tr>';
			echo '<td>'.$topico.'</td>';
			echo '<td>'.$mb.' ('.($mb*100)/$total.'%)</td>';
			echo '<td>'.$b.' ('.($b*100)/$total.'%)</td>';
			echo '<td>'.$a.' ('.($a*100)/$total.'%)</td>';
			echo '<td>'.$d.' ('.($d*100)/$total.'%)</td>';
			echo '<td>'.$md.' ('.($md*100)/$total.'%)</td>';
			echo '<td>'.$valoracion.'</td>';
			echo '</tr>';

			$evaluacion = $evaluacion + $valoracion;

		}

		$evaluacionT = number_format(($evaluacion / mysqli_num_rows($query)), 2, '.', '');

		echo '</tbody>';
		echo '</table>';

		echo '<br>';



		echo '<div class="row">';

		echo '<div class="col s4 m4 l4">';

		echo '<table class="centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '<th colspan="2">Docente</th>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>Inscritos</td>';
		echo '<td>Encuestados</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>'.mysqli_num_rows($consulta).'</td>';
		while($valores = mysqli_fetch_array($totalEv)){
			echo '<td>'.$valores['total'].' ('.number_format(($valores['total']*100)/mysqli_num_rows($consulta), 2, '.', '').'%)</td>';
		}
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';

		echo '</div>';


		echo '<div class="col s4 m4 l4">';

		echo '<table class="centered responsive-table">';
		echo '<tbody>';

		echo '<tr>';
		echo '</tr>';

		echo '<tr>';
		echo '<th colspan="2">Evaluación</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td>'.$evaluacionT.'</td>';
		if($evaluacionT > 4.50 && $evaluacionT < 5.00){
			echo '<td>Muy bueno</td>';
		}elseif($evaluacionT > 3.50 && $evaluacionT < 4.49){
			echo '<td>Bueno</td>';
		}elseif($evaluacionT > 2.50 && $evaluacionT < 3.49){
			echo '<td>Aceptable</td>';
		}elseif($evaluacionT > 1.50 && $evaluacionT < 2.49){
			echo '<td>Deficiente</td>';
		}elseif($evaluacionT > 1.00 && $evaluacionT < 1.49){
			echo '<td>Muy deficiente</td>';
		}
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';

		echo '</div>';


		echo '<div class="col s4 m4 l4">';
		echo '<table class="responsive-table centered">';
        echo '<thead>';
        echo '<th colspan="2">Escalas de evaluación</th>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>4.50 -> 5</td>';
        echo '<td>Muy bueno</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>3.50 -> 4.49</td>';
        echo '<td>Bueno</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>2.50 -> 3.49</td>';
        echo '<td>Aceptable</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>1.50 -> 2.49</td>';
        echo '<td>Deficiente</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td>1 -> 1.49</td>';
        echo '<td>Muy deficiente</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
		echo '</div>';


		echo '</div>';

		echo '</div>';
		//echo '</div>';

}

?>
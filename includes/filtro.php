<?php

include("conectar.php");

$tipo = $_POST['tipo'];
$periodo = $_POST['periodo'];
$docente = $_POST['docente'];
$acta = $_POST['acta'];

if($tipo==1){
	echo "Mostrar resultados de tabla resultadosCoordinadores";
}else{

	if($acta == 0){
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' GROUP BY topico");
		$consulta = $conexion->query("SELECT * FROM alumnos AS al INNER JOIN respuestas as resp ON al.acta = resp.acta WHERE resp.docente = '$docente'");
		$totalEv = $conexion->query("SELECT SUM(evaluado) AS total FROM alumnos WHERE evaluado='1' AND acta IN (SELECT acta FROM respuestas WHERE docente = '$docente')");
	}else{
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' AND acta = '$acta'");
		$consulta = $conexion->query("SELECT * FROM alumnos AS al INNER JOIN respuestas as resp ON al.acta = resp.acta WHERE resp.docente = '$docente' AND resp.acta = '$acta'");
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

		while($valores = mysqli_fetch_array($query)){
			$topico = utf8_encode($valores['topico']);
			$acta = utf8_encode($valores['acta']);
			$docente = utf8_encode($valores['docente']);
			$periodo = utf8_encode($valores['periodo']);
			$mb = utf8_encode($valores['muy_bueno']);
			$b = utf8_encode($valores['bueno']);
			$a = utf8_encode($valores['aceptable']);
			$d = utf8_encode($valores['deficiente']);
			$md = utf8_encode($valores['muy_deficiente']);
			$total = utf8_encode($valores['total']);

			echo '<tr>';
			echo '<td>'.$topico.'</td>';
			echo '<td>'.$mb.' ('.($mb*100)/$total.'%)</td>';
			echo '<td>'.$b.' ('.($b*100)/$total.'%)</td>';
			echo '<td>'.$a.' ('.($a*100)/$total.'%)</td>';
			echo '<td>'.$d.' ('.($d*100)/$total.'%)</td>';
			echo '<td>'.$md.' ('.($md*100)/$total.'%)</td>';
			echo '<td>'.$total.'</td>';
			echo '</tr>';

		}

		echo '</tbody>';
		echo '</table>';

		echo '<br>';

		echo '<div class="row">';

		echo '<div class="col s4 m4 l4">';

		echo '<table class="striped centered responsive-table">';
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
			echo '<td>'.$valores['total'].'</td>';
		}
		echo '</tr>';

		echo '</tbody>';
		echo '</table>';

		echo '</div>';

		echo '</div>';

		echo '</div>';
		//echo '</div>';

}

?>
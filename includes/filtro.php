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
	}else{
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' AND acta = '$acta'");
	}

		//echo '<div class="row">';
		echo '<div class="col s12 m12 l12>';

		echo '<div class="row">';

		echo '<div class="col s3 m3 l3">';
        echo '<label>Docente</label>';
        echo '<input type="text" value="'.$docente.'" readonly>';
        echo '</div>';

        echo '<div class="col s3 m3 l3">';
        echo '<label>Acta</label>';
        if($acta == 0){
        	echo '<input type="text" value="Evaluación general" readonly>';
        }else{
        	echo '<input type="text" value="'.$acta.'" readonly>';
        }
        echo '</div>';

        echo '<div class="col s3 m3 l3">';
        echo '<label>Período</label>';
        echo '<input type="text" value="'.$periodo.'" readonly>';
        echo '</div>';

		echo '</div>';

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

		echo '</div>';
		//echo '</div>';

}

?>
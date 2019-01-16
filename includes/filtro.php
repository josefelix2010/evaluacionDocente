<?php

include("conectar.php");

$tipo = $_POST['tipo'];
$periodo = $_POST['periodo'];
$docente = $_POST['docente'];
$acta = $_POST['acta'];

echo $tipo.' - '.$periodo.' - '.$docente.' - '.$acta;

if($tipo==1){
	echo "Mostrar resultados de tabla resultadosCoordinadores";
}else{

	if($acta == 0){
		$query = $conexion->query("SELECT * FROM respuestas WHERE periodo='$periodo' AND docente='$docente' GROUP BY topico");

		while($valores = mysqli_fetch_array($query)){
			$topico = utf8_encode($topico);
			$acta = utf8_encode($acta);
			$docente = utf8_encode($docente);
			$periodo = utf8_encode($periodo);
			$mb = utf8_encode($muy_bueno);
			$b = utf8_encode($bueno);
			$a = utf8_encode($acetable);
			$d = utf8_encode($deficiente);
			$md = utf8_encode($muy_deficiente);
			$total = utf8_encode($total);
		}
	}
}

?>
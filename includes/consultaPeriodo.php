<?php

include("conectar.php");

$id_periodo = $_POST['id_periodo'];

$tipo = $_POST['tipo'];

if($tipo == 1){
	$queryD = $conexion->query("SELECT * FROM respuestascoor WHERE periodo = '$id_periodo' GROUP BY docente ORDER BY docente ASC");

	echo '<option value="0" selected hidden>Seleccione</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['docente'].'">'.$valor['docente'].'</option>';
	}
}else{
	$queryD = $conexion->query("SELECT * FROM respuestas WHERE periodo = '$id_periodo' GROUP BY docente ORDER BY docente ASC");

	echo '<option value="0" selected hidden>Seleccione</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['docente'].'">'.$valor['docente'].'</option>';
	}
}

?>
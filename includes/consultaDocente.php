<?php

include("conectar.php");

$id_docente = $_POST['id_docente'];

$periodo = $_POST['periodo'];

$tipo = $_POST['tipo'];

if($tipo == 1){
	$queryD = $conexion->query("SELECT * FROM respuestascoor WHERE periodo = '$periodo' AND docente = '$id_docente' GROUP BY docente ORDER BY docente ASC");

	echo '<option value="0" selected>Todas</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['acta'].'">'.$valor['acta'].'</option>';
	}
}else{
	$queryD = $conexion->query("SELECT * FROM respuestas WHERE periodo = '$periodo' AND docente = '$id_docente' GROUP BY docente ORDER BY docente ASC");

	echo '<option value="0" selected>Todas</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['acta'].'">'.$valor['acta'].'</option>';
	}
}

?>
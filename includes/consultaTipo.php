<?php

include("conectar.php");

$tipo = $_POST['id_tipo'];

if($tipo == 1){
	$queryD = $conexion->query("SELECT periodo FROM respuestascoor GROUP BY periodo ORDER BY periodo ASC");

	echo '<option value="0" selected hidden>Seleccione</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['periodo'].'">'.$valor['periodo'].'</option>';
	}
}elseif($tipo == 2){
	$queryD = $conexion->query("SELECT periodo FROM respuestas GROUP BY periodo ORDER BY periodo ASC");

	echo '<option value="0" selected hidden>Seleccione</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['periodo'].'">'.$valor['periodo'].'</option>';
	}
}

?>
<?php

include("conectar.php");

$tipo = $_POST['id_tipo'];

if($tipo == 1){
	echo 'Mostrar resultados de periodos en evaluacion de coordinador';
	echo '<option value="0" selected hidden>Seleccione</option>';
}else{
	$queryD = $conexion->query("SELECT periodo FROM respuestas GROUP BY periodo ORDER BY periodo ASC");

	echo '<option value="0" selected hidden>Seleccione</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['periodo'].'">'.$valor['periodo'].'</option>';
	}
}

?>
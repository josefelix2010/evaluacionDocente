<?php

include("conectar.php");

$id_docente = $_POST['id_docente'];

$periodo = $_POST['periodo'];

$tipo = $_POST['tipo'];

if($tipo == 1){
	echo 'Mostrar resultados de periodos en evaluacion de coordinador';
}else{
	$queryD = $conexion->query("SELECT * FROM respuestas WHERE periodo = '$periodo' AND docente = '$id_docente' GROUP BY docente ORDER BY docente ASC");

	echo '<option value="0" selected>Todas</option>';

	while($valor = mysqli_fetch_array($queryD)){
		echo '<option value="'.$valor['acta'].'">'.$valor['acta'].'</option>';
	}
}

/**$queryD = $conexion->query("SELECT * FROM respuestas WHERE periodo = '$id_periodo' GROUP BY docente ORDER BY docente ASC");

echo '<option value="0" selected hidden>Seleccione</option>';

while($valor = mysqli_fetch_array($queryD)){
	echo '<option value="'.$valor['docente'].'">'.$valor['docente'].'</option>';
}*/

?>
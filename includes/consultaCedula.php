<?php

include('conectar.php');

$cedula = $_POST['cedula'];

$query = $conexion->query("SELECT * FROM coordinadores WHERE coordinador = '$cedula'");


if(mysqli_num_rows($query) > 0){

	echo '<option value="" selected>Seleccione</option>';

	while($valores = mysqli_fetch_array($query)){
		$asignatura = $valores['asignatura'];

		echo '<option value="'.$asignatura.'">'.$asignatura.'</option>';
	}

}else{

	$queryAl = $conexion->query("SELECT act.asignatura FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE alu.alumno = '$cedula' AND alu.evaluado = '0'");

	if(mysqli_num_rows($queryAl) > 0){

		echo '<option value="" selected>Seleccione</option>';

		while($valores = mysqli_fetch_array($queryAl)){
			$asignatura = $valores['asignatura'];

			echo '<option value="'.$asignatura.'">'.$asignatura.'</option>';
		}
	}else{
		echo '0';
	}



}


?>
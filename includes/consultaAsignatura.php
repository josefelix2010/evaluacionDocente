<?php

include('conectar.php');

$cedula = $_POST['cedula'];
$asignatura = $_POST['asignatura'];

$query = $conexion->query("SELECT act.docente FROM actas act INNER JOIN coordinadores coo ON act.acta = coo.acta WHERE coo.coordinador = '$cedula' AND act.asignatura = '$asignatura'");

if(mysqli_num_rows($query) > 0){

	while($valores = mysqli_fetch_array($query)){
		echo $valores['docente'];
	}

}else{
	$buscarAsig = $conexion->query("SELECT act.docente FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE alu.alumno='$cedula' and act.asignatura='$asignatura'");

	while($valores = mysqli_fetch_array($buscarAsig)){
		echo $valores['docente'];
	}
}

?>
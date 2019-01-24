<?php

session_start();
ob_start();

include('conectar.php');

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$login = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND password = '$password'");

if($valores = mysqli_fetch_array($login)){

	$_SESSION['usuarioLogin'] = $usuario;
	$_SESSION['nombres'] = utf8_encode($valores['nombre']).' '.utf8_encode($valores['apellido']);
	$_SESSION['email'] = utf8_encode($valores['correo']);
	$_SESSION['sesionAbierta'] = 'Activa';

	if($valores['administrador']==1){
		$_SESSION['tipo'] = 'administrador';
	}else{
		$_SESSION['tipo'] = 'coordinador';
	}

	echo '1';

}else{
	echo '0';
}


?>
<?php

include('conectar.php');

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['tipo']) ){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $pass = $_POST['password'];
    $tipo = $_POST['tipo'];

    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

    $consulta = $conexion->query($query);

    $filas = mysqli_num_rows($consulta);

    if($filas==0){
        $queryIns = "INSERT INTO usuarios (usuario, nombre, apellido, correo, password, administrador) VALUES ('$usuario', '$nombre', '$apellido', '$correo', '$pass', '$tipo')";
        $insert = $conexion->query($queryIns) or die (mysqli_errno());
        echo 1;
    }else{
        echo 0;
    }

}else{
    echo 2;
}

?>

<?php

include('conectar.php');

if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['usuario']) && isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['tipo']) ){

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];
    $pass = $_POST['password'];
    $tipo = $_POST['tipo'];

    $update = "UPDATE usuarios SET usuario='$usuario', nombre='$nombre', apellido='$apellido', correo='$correo', password='$pass', administrador='$tipo' WHERE usuario='$usuario'";

    if($conexion->query($update)){
        echo 1;
    }else{
        echo 0;
    }

}else{
    echo 2;
}

?>
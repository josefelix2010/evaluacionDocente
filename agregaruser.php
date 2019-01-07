<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

    if(isset($_POST['agregar'])){

        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $correo = $_POST['correo'];
        $pass1 = $_POST['password1'];
        $pass2 = $_POST['password2'];

        if($pass1 === $pass2){

            $sql = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");

            if($valores = mysqli_fetch_array($sql)){

                echo '<script type="text/javascript">';
                echo 'alert("Este usuario ya existe.");';
                echo '</script>';

            }else{

                $insert = "INSERT INTO usuarios(usuario, nombre, apellido, correo, password) VALUES ('$usuario', '$nombre', '$apellido', '$correo', '$pass1')";

                if($conexion->query($insert)){

                    echo '<script type="text/javascript">';
                    echo 'alert("Usuario agregado con éxito.");';
                    echo '</script>';

                    header('location: agregaruser.php');;

                }else{
                    echo '<script type="text/javascript">';
                    echo 'alert("No se pudo agregar a la base de datos, intente nuevamente.");';
                    echo '</script>';
                }

            }

        }else{
            echo '<script type="text/javascript">';
            echo 'alert("Las contraseñas no coinciden.");';
            echo '</script>';
        }



    }

    if(isset($_POST['volver'])){

        header('location:usuarios.php');

    }

}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Agregar usuario</title>

        <link rel="stylesheet" href="css/base.css">

        <link rel="stylesheet" href="css/agregarUser.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="libs/Quicksand">

    </head>
    <body>

        <div class="row">
            <nav>
                <div class="nav-wrapper navbar">
                    <img src="img/Logo.png" alt="Logo" height="48">
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="inicio.php">Inicio</a></li>
                        <li><a href="topicos.php">Formulario</a></li>
                        <li><a href="resultados.php">Resultados</a></li>
                        <li><a href="usuarios.php">Usuarios</a></li>
                        <li><a href="index.php">Salir</a></li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="container form">
                    <div class="card">

                        <div class="card-action center-align">
                            <p>Agregar usuario</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="usuario">Usuario</label>
                                                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" placeholder="Nombre">
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" placeholder="Apellido">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="correo">Correo electrónico</label>
                                                <input id="correo" type="email" class="validate" placeholder="correo@electronico.com" name="correo">
                                                <span class="helper-text" data-error="Error" data-success="Correcto"></span>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="password1">Contraseña</label>
                                                <input type="password" name="password1" id="password1" placeholder="Contraseña">
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="password2">Valide su contraseña</label>
                                                <input type="password" name="password2" id="password2" placeholder="Valide su contraseña">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-field center-align">
                                        <input class="btn" type="submit" name="agregar" value="Agregar">
                                        <input class="btn" type="submit" name="volver" value="Volver">
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
            </did>

    </body>
</html>
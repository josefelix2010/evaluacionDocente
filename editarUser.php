<?php

session_start();
ob_start();

include('includes/conectar.php');

/*if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{*/

    $consulta = $conexion->query("SELECT * FROM usuarios");

    if(isset($_POST['modificar'])){

        $usuario = utf8_decode($_POST['user']);
        $nombre = utf8_decode($_POST['nombre']);
        $apellido = utf8_decode($_POST['apellido']);
        $correo = utf8_decode($_POST['correo']);
        $password = utf8_decode($_POST['password']);

        $update = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', correo='$correo', password='$password' WHERE usuario = '$usuario'";

        if($conexion->query($update)){

            echo '<script type="text/javascript">';
            echo 'alert("Usuario modificado correctamente.");';
            echo '</script>';

        }else{
            echo "error";
        }



    }

    if(isset($_POST['volver'])){

        header('location:usuarios.php');

    }

//}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Modificar usuario</title>

        <link rel="stylesheet" href="css/base.css">

        <link rel="stylesheet" href="css/editarUser.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="libs/Quicksand">

        <script type="text/javascript">
            function cambiar(){
                var id = document.getElementById('usuario');
                var opcion = id.options[id.selectedIndex].text;
                window.location.href="editarUser.php?opcion="+opcion;
            }
        </script>

    </head>
    <body>

        <div class="row">
            <nav>
                <div class="nav-wrapper navbar">
                    <img src="img/Logo.png" alt="Logo" height="48">
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="inicio.php">Inicio</a></li>
                        <li><a href="formEdit.php">Formulario</a></li>
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
                            <p>Modificar usuario</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="usuario">Elija un usuario</label>
                                                <div class="input-field">
                                                    <select class="browser-default" name="usuario" id="usuario" onchange="cambiar()">
                                                        <option value="" disabled selected hidden>Elija un usuario</option>

                                                        <?php

                                                        while($resultados = mysqli_fetch_array($consulta)){
                                                            echo '<option value="'.utf8_encode($resultados['usuario']).'">'.utf8_encode($resultados['usuario']).'</option>';;
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <?php

                                        if(isset($_GET['opcion'])){

                                            $usuario = $_GET['opcion'];

                                            $sql = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario'");

                                            while($valores = mysqli_fetch_array($sql)){

                                        ?>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="user">Usuario</label>
                                                <input type="text" name="user" id="user" value="<?php echo utf8_encode($valores['usuario']); ?>">
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="password">Contraseña</label>
                                                <input type="password" name="password" id="password" value="<?php echo utf8_encode($valores['password']); ?>" required>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" value="<?php echo utf8_encode($valores['nombre']); ?>" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" value="<?php echo utf8_encode($valores['apellido']); ?>" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="correo">Correo electrónico</label>
                                                <input id="correo" name="correo" type="email" class="validate" value="<?php echo utf8_encode($valores['correo']); ?>" required>
                                                <span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto"></span>
                                            </div>

                                        </div>

                                        <?php

                                            }

                                        }

                                        ?>

                                    </div>

                                    <div class="form-field center-align">
                                        <input class="btn" type="submit" name="modificar" value="Modificar">
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
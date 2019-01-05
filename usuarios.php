<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    
    header('location: index.php');
    
}else{


    $sql = $conexion->query("SELECT * FROM usuarios");

    if(isset($_POST['agregar'])){
        header('location:agregarUser.php');
    }

    if(isset($_POST['modificar'])){
        header('location:editarUser.php');
    }

    if(isset($_POST['volver'])){
        header('location:inicio.php');
    }

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Usuarios</title>

        <link rel="stylesheet" href="css/base.css">

        <link rel="stylesheet" href="css/usuarios.css">

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
                            <p>Lista de usuarios</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col 12 m12 l12">

                                    <table class="striped centered responsive-table">
                                        <thead>
                                            <tr class="hightlight">
                                                <th>Usuario</th>
                                                <th>Nombre</th>
                                                <th>Chaparro</th>
                                                <th>Correo Electrónico</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            while($valores = mysqli_fetch_array($sql)){

                                                echo '<tr>';
                                                echo '<td>'.$valores['usuario'].'</td>';
                                                echo '<td>'.$valores['nombre'].'</td>';
                                                echo '<td>'.$valores['apellido'].'</td>';
                                                echo '<td>'.$valores['correo'].'</td>';
                                                echo '<tr>';

                                            }

                                            ?>
                                        </tbody>
                                    </table>

                                    <br>

                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="form-field">

                                            <div class="form-field center-align">
                                                <input class="btn" type="submit" name="agregar" value="Agregar">
                                                <input class="btn" type="submit" name="modificar" value="Modificar">
                                                <input class="btn" type="submit" name="volver" value="Volver">
                                            </div>

                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
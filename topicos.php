<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

    $sql = $conexion->query("SELECT * FROM topicos");

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

        <script type="text/javascript">
            function modificar(){
                window.location.href='formEdit.php';
            }

            function volver(){
                window.location.href='inicio.php';
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
                            <p>Lista de Tópicos</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col 12 m12 l12">

                                    <div class="container form1">

                                        <table class="striped centered responsive-table">
                                            <thead>
                                                <tr class="hightlight">
                                                    <th>Títulos</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php

                                                while($valores = mysqli_fetch_array($sql)){

                                                    echo '<tr>';
                                                    echo '<td>'.utf8_encode($valores['titulo']).'</td>';
                                                    echo '<tr>';

                                                }

                                                ?>
                                            </tbody>
                                        </table>

                                        <br>

                                        <div class="form-field center-align">
                                            <input class="btn" type="submit" name="agregar" value="Modificar Lista" onclick="modificar()">
                                            <input class="btn" type="submit" name="volver" value="Volver" onclick="volver()">
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
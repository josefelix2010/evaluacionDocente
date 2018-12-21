<?php

session_start();

include('includes/conectar.php');

$consulta2 = $conexion->query("SELECT * FROM topicos ORDER BY RAND() LIMIT 12");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de evaluación</title>

        <link rel="stylesheet" href="css/evaluacion.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

    </head>
    <body>

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="container form">

                    <div class="card">

                        <div class="card-action">
                            <div class="row" style="margin-bottom: 0px;">

                                <div class="col s1 m1 l1">
                                    <img src="img/Logo.png" alt="Logo" height="70">
                                </div>

                                <div class="col s6 m6 l6">
                                    <p>FORMULARIO DE EVALUACIÓN DOCENTE</p>
                                </div>

                                <div class="col s5 m5 l5" id="cabecera">
                                    <p>UNIVERSIDAD JOSÉ ANTONIO PÁEZ<br>
                                        VICERRECTORADO ACADÉMICO<br>
                                        COORDINACIÓN DE EVALUACIÓN DOCENTE
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        <div class="container form1">

                                            <p class="center-align" style="font-size: 16px !important;">Evaluación Docente</p>

                                            <br>

                                            <form method="POST" action="pruebaForm.php">
                                                <div class="row">
                                                    <div class="col s12 m12 l12">

                                                        <table class="striped responsive-table">
                                                            <thead>
                                                                <tr class="hightlight">
                                                                    <th width="450px">Tópico</th>
                                                                    <th>5</th>
                                                                    <th>4</th>
                                                                    <th>3</th>
                                                                    <th>2</th>
                                                                    <th>1</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $count = 1;
                                                                    while($valores = mysqli_fetch_array($consulta2)){
                                                                        
                                                                        echo '<tr>';
                                                                        echo '<td><input type="text" name="tabla['.$count.'][titulo]" value="'.utf8_encode($valores['titulo']).'" readonly></td>';
                                                                        echo '<td width="35"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '<td width="35"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '<td width="35"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '<td width="35"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '<td width="35"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '</tr>';
                                                                        $count++;
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                </div>
                                            </div>

                                                <div class="form-field center-align">
                                                    <input class="btn" style="margin: 20px;" type="submit" name="finalizar" value="Finalizar">
                                                </div>
                                            </form>

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
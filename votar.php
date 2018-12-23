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
                                            
                                            <div class="row">
                                                
                                                <div class="col s7 m7 l7">
                                                    
                                                    <table class="responsive-table">
                                                        <thead>
                                                            <th class="celdasTitulo">Docente</th>
                                                            <th class="celdasTitulo">Asignatura</th>
                                                        </thead>
                                                        <tbody>
                                                            
                                                            <?php
                                                            
                                                                if(isset($_GET['docente']) && isset($_GET['asignatura'])){
                                                                    $docente = $_GET['docente'];
                                                                    $asignatura = $_GET['asignatura'];
                                                            ?>
                                                            <td><?php echo $docente; ?></td>
                                                            <td><?php echo $asignatura; ?></td>
                                                            
                                                            <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                
                                            </div>

                                            <div class="row">
                                                <div class="col s12 m12 l12">
                                                    <form method="POST" action="pruebaForm.php">

                                                        <table class="striped responsive-table">
                                                            <thead>
                                                                <tr class="hightlight">
                                                                    <th class="celdasTitulo" width="450px">Tópico</th>
                                                                    <th class="celdasTitulo">5</th>
                                                                    <th class="celdasTitulo">4</th>
                                                                    <th class="celdasTitulo">3</th>
                                                                    <th class="celdasTitulo">2</th>
                                                                    <th class="celdasTitulo">1</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $count = 1;
                                                                    while($valores = mysqli_fetch_array($consulta2)){
                                                                        
                                                                        echo '<tr>';
                                                                        echo '<td class="celdasInfo"><textarea rows="2" col="50" name="tabla['.$count.'][titulo]" readonly>'.utf8_encode($valores['titulo']).'</textarea></td>';
                                                                        echo '<td width="35" class="celdasInfo"><label><input type="radio" name="tabla['.$count.'][opcion]" value="mb" required><span></span></label></td>';
                                                                        echo '<td width="35" class="celdasInfo"><label><input type="radio" name="tabla['.$count.'][opcion]" value="b" required><span></span></label></td>';
                                                                        echo '<td width="35" class="celdasInfo"><label><input type="radio" name="tabla['.$count.'][opcion]" value="a" required><span></span></label></td>';
                                                                        echo '<td width="35" class="celdasInfo"><label><input type="radio" name="tabla['.$count.'][opcion]" value="d" required><span></span></label></td>';
                                                                        echo '<td width="35" class="celdasInfo"><label><input type="radio" name="tabla['.$count.'][opcion]" value="md" required><span></span></label></td>';
                                                                        echo '</tr>';
                                                                        $count++;
                                                                    }
                                                                ?>
                                                            </tbody>
                                                        </table>
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
                </div>
            </div>

            </body>
        </html>
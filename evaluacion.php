<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_SESSION['sesionActiva'])){
    header('location: votar.php?cedula='.$_SESSION['cedula'].'&asignatura='.$_SESSION['asignatura'].'&docente='.$_SESSION['docente'].'');
}

if(isset($_POST['evaluar'])){

    if(isset($_POST['asignaturaIn'])){

        $_SESSION['cedula'] = $_POST['cedula'];
        $_SESSION['asignatura'] = $_POST['asignaturaIn'];
        $_SESSION['docente'] = $_POST['docente'];

        $cedula = $_SESSION['cedula'];
        $asignatura = $_SESSION['asignatura'];
        $docente = $_SESSION['docente'];

        $_SESSION['sesionActiva'] = "Activa";

        $consulta2 = $conexion->query("SELECT * FROM topicos ORDER BY RAND() LIMIT 12");

        $preguntas = array();

        $filas = mysqli_num_rows($consulta2);

        if($filas > 0){
            for($i=0; $i<$filas; $i++){
                $valor = mysqli_fetch_array($consulta2);
                $preguntas[$i] = utf8_encode($valor['titulo']);
            }
        }

        $_SESSION['preguntas'] = $preguntas;

        header('location: Formulario.php?cedula='.$cedula.'&asignatura='.$asignatura.'&docente='.$docente.'');

    }else{

        echo '<script type="text/javascript">';
        echo    'alert("Debe seleccionar una materia para continuar.")';
        echo '</script>';

    }

}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Formulario de evaluación</title>

        <link rel="stylesheet" href="css/evaluacion.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="libs/Quicksand">

        <script type="text/javascript">
            function buscarCI(){
                var ci = document.getElementById('cedula').value;
                window.location.href="evaluacion.php?cedula="+ci+"";
            }

            function cambiar(){
                var id = document.getElementById('asignatura');
                var opciones = id.options[id.selectedIndex].text;
                var cedula = document.getElementById('cedula').value;
                window.location.href="evaluacion.php?cedula="+cedula+"&asignatura="+opciones+"";
            }

            /*function evaluar(){
                var id = document.getElementById('asignatura');
                var opciones = id.options[id.selectedIndex].text;
                var cedula = document.getElementById('cedula').value;
                var docente = document.getElementById('docente').value;
                window.location.href="votar.php?cedula="+cedula+"&asignatura="+opciones+"&docente="+docente+"";
            }*/
        </script>

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

                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col s12 m12 l12">
                                    <p class="cabecera">Este instrumento anónimo recaba información sobre el docente. Se agradece una opinión objetiva de acuerdo con su percepción
                                        sobre las actividades realizadas. Sus respuestas son importantes ya que contribuirán a mejorar la calidad docente y su desempeño
                                        en el aula.
                                    </p>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col s12 m12 l12">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <table class="striped centered responsive-table">
                                            <tbody>
                                                <tr>
                                                    <td class="celdasTitulo">Cédula</td>
                                                    <td class="celdasTitulo">Asignatura</td>
                                                    <td class="celdasTitulo">Docente</td>
                                                </tr>
                                                <tr>

                                                    <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">
                                                        <div class="form-field">

                                                            <?php
                                                            if(isset($_GET['cedula'])){
                                                                $cedulaG = $_GET['cedula'];
                                                                echo '<input type="text" name="cedula" id="cedula" value="'.$cedulaG.'" required onblur="buscarCI()">';
                                                            }else{
                                                                echo '<input type="text" name="cedula" id="cedula" value="" required onblur="buscarCI()">';
                                                            }
                                                            ?>

                                                        </div>
                                                    </td>
                                                    <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">

                                                        <div class="form-field">

                                                            <select class="browser-default" name="asignatura" id="asignatura" onchange="cambiar()">

                                                                <?php
                                                                if(isset($_GET['cedula']) && !isset($_GET['asignatura'])){

                                                                    $cedula = $_GET['cedula'];

                                                                    echo '<option value="" disabled selected hidden>Seleccione</option>';

                                                                    $buscarCI = $conexion->query("SELECT asignatura FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE alu.alumno = '$cedula' AND alu.evaluado = '0'");

                                                                    $cont = 1;
                                                                    while($valores = mysqli_fetch_array($buscarCI)){
                                                                        echo '<option value="'.$cont.'">'.utf8_encode($valores['asignatura']).'</option>';
                                                                        $cont++;
                                                                    }

                                                                }elseif(isset($_GET['cedula']) && isset($_GET['asignatura'])){

                                                                    $cedula = $_GET['cedula'];
                                                                    $asignatura = $_GET['asignatura'];

                                                                    echo '<option value="" disabled selected hidden>'.$asignatura.'</option>';

                                                                    $buscarCI = $conexion->query("SELECT asignatura FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE alu.alumno = '$cedula' AND alu.evaluado = '0'");

                                                                    $cont = 1;
                                                                    while($valores = mysqli_fetch_array($buscarCI)){
                                                                        echo '<option value="'.$cont.'">'.utf8_encode($valores['asignatura']).'</option>';
                                                                        $cont++;
                                                                    }

                                                                    echo '<input type="text" name="asignaturaIn" id="asignaturaIn" value="'.$asignatura.'" hidden required>';

                                                                }else{

                                                                    echo '<option value="" disabled selected hidden>Materia</option>';

                                                                }
                                                                ?>

                                                            </select>

                                                        </div>

                                                    </td>
                                                    <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">

                                                        <?php
                                                        if(isset($_GET['asignatura']) && isset($_GET['cedula'])){

                                                            $cedula = $_GET['cedula'];
                                                            $asignatura = $_GET['asignatura'];

                                                            $buscarAsig = $conexion->query("SELECT act.docente FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE alu.alumno='$cedula' and act.asignatura='$asignatura'");

                                                            while($valor = mysqli_fetch_array($buscarAsig)){
                                                                echo '<input type="text" name="docente" id="docente" value="'.$valor['docente'].'" readonly>';
                                                            }

                                                        }else{
                                                            echo '<input type="text" name="docente" id="docente" value="" readonly required>';
                                                        }
                                                        ?>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="form-field center-align">
                                            <?php

                                            if(isset($_GET['asignatura'])){
                                                echo '<input class="btn" type="submit" name="evaluar" value="Evaluar">';
                                            }else{
                                                echo '<input class="btn" type="submit" name="evaluar" value="Seleccione una materia" disabled>';
                                            }

                                            ?>
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
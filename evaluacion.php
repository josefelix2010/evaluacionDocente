<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_SESSION['sesionActiva'])){
    if($_SESSION['tipo'] == 'coordinador'){
        header('location: FormularioCoor.php');
    }else{
        header('location: Formulario.php');
    }
}

if(isset($_POST['evaluar'])){

    if(isset($_POST['asignaturaTxt'])){

        $_SESSION['cedula'] = $_POST['cedula'];
        $_SESSION['asignatura'] = $_POST['asignaturaTxt'];
        $_SESSION['docente'] = $_POST['docente'];

        $cedula = $_SESSION['cedula'];
        $asignatura = $_SESSION['asignatura'];
        $docente = $_SESSION['docente'];

        $_SESSION['sesionActiva'] = "Activa";

        $query = $conexion->query("SELECT * FROM coordinadores WHERE coordinador = '$cedula'");

        if(mysqli_num_rows($query) > 0){
            $_SESSION['tipo'] = 'coordinador';

            $consulta2 = $conexion->query("SELECT * FROM topicoscoor ORDER BY RAND() LIMIT 12");

            $preguntas = array();

            $filas = mysqli_num_rows($consulta2);

            if($filas > 0){
                for($i=0; $i<$filas; $i++){
                    $valor = mysqli_fetch_array($consulta2);
                    $preguntas[$i] = utf8_encode($valor['titulo']);
                }
            }

            $_SESSION['preguntas'] = $preguntas;

            header('location: FormularioCoor.php');

        }else{
            $_SESSION['tipo'] = 'estudiante';

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

            header('location: Formulario.php');

        }

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

        <link rel="stylesheet" href="fonts/Quicksand">

        <script src="libs/jquery-3.3.1.min.js"></script>

        <script src="libs/materialize/js/materialize.min.js"></script>

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

            $(document).ready(function(){

                $('#cedula').on('blur', function(){
                    var cedula = $(this).val();

                     $.ajax({
                        type: "POST",
                        url: "includes/consultaCedula.php",
                        data: ("cedula="+cedula),
                        success: function(resultado){
                            if(resultado == 0){
                                alert("Ingrese una cédula válidad.");
                            }else{
                                $('#asignatura').html(resultado);
                            }
                        }
                    });
                });

                $('#asignatura').change(function() {
                    $('#asignatura option:selected').each(function() {
                        var asignatura = $(this).val();
                        var cedula = $('#cedula').val();
                        $('#asignaturaTxt').val(asignatura);

                        $.ajax({
                            type: "POST",
                            url: "includes/consultaAsignatura.php",
                            data: ("cedula="+cedula+"&asignatura="+asignatura),
                            success: function(resultado){
                                $('#docente').val(resultado);
                                $('#evaluar').attr("disabled", false);
                            }
                        });
                    });
                });
            });

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

                                                            <input type="text" name="cedula" id="cedula" value="" required>

                                                        </div>
                                                    </td>
                                                    <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">

                                                        <div class="form-field">

                                                            <select class="browser-default" name="asignatura" id="asignatura">

                                                                <option value="" disabled selected hidden></option>

                                                            </select>

                                                            <input type="text" name="asignaturaTxt" id="asignaturaTxt" value="" readonly hidden required>

                                                        </div>

                                                    </td>
                                                    <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">

                                                        <input type="text" name="docente" id="docente" value="" readonly required>

                                                    </td>

                                                </tr>
                                            </tbody>
                                        </table>
                                        <br>
                                        <div class="form-field center-align">
                                            <input class="btn" type="submit" name="evaluar" id="evaluar" value="Evaluar" disabled>
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
<?php

session_start();
ob_start();

include('includes/conectar.php');

/*if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{*/

$consultaPeriodo = $conexion->query("SELECT periodo FROM respuestas GROUP BY periodo");
$cont = 1;

if(isset($_GET['acta']) && isset($_GET['periodo'])){

    $acta = $_GET['acta'];

    $periodo = $_GET['periodo'];

    $consultaDocente = $conexion->query("SELECT * FROM actas WHERE acta = '$acta' and periodo = '$periodo'");

    $consulta = $conexion->query("SELECT * FROM respuestas WHERE acta = '$acta' and periodo = '$periodo'");

}

//{

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Resultados</title>

        <link rel="stylesheet" href="css/base.css">

        <link rel="stylesheet" href="css/resultados.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="libs/Quicksand">

        <script type="text/javascript">
            function buscarActa(){
                var id = document.getElementById('periodos');
                var periodo = id.options[id.selectedIndex].text;
                var acta = document.getElementById('acta').value;
                window.location.href="resultados.php?periodo="+periodo+"&acta="+acta+"";
            }

            function volver(){
                window.location.href="inicio.php";
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
                            <p>Ver resultados</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col s2 m2 l2"></div>

                                <div class="col s8 m8 l8">
                                    <form>

                                        <div class="form-field">

                                            <div class="row">

                                                <div class="col s6 m6 l6">
                                                    <label for="docente">Docente</label>
                                                    <select class="browser-default" name="periodos" id="periodos" onchange="modificar()">



                                                        <?php

                                                        if(isset($_GET['periodo'])){

                                                            $periodo = $_GET['periodo'];

                                                            echo '<option value="" disabled selected hidden>'.$periodo.'</option>';

                                                            while($valores = mysqli_fetch_array($consultaPeriodo)){
                                                                $cont = 1;
                                                                echo '<option value="'.$cont.'">'.$valores['periodo'].'</option>';
                                                                $cont++;
                                                            }

                                                        }else{

                                                            while($valores = mysqli_fetch_array($consultaPeriodo)){
                                                                $cont = 1;
                                                                echo '<option value="'.$cont.'">'.$valores['periodo'].'</option>';
                                                                $cont++;
                                                            }

                                                        }


                                                        ?>

                                                    </select>
                                                </div>

                                                <div class="col s6 m6 l6">
                                                    <label for="acta">Nº de Acta</label>

                                                    <?php

                                                    if(isset($_GET['acta'])){

                                                        $acta = $_GET['acta'];

                                                        echo '<input type="text" name="acta" id="acta" value="'.$acta.'" onblur="buscarActa()">';

                                                    }else{

                                                        echo '<input type="text" name="acta" id="acta" placeholder="Nº de Acta" onblur="buscarActa()">';

                                                    }

                                                    ?>

                                                </div>

                                            </div>

                                            <div class="row">

                                                <?php

                                                if(isset($_GET['acta'])){

                                                    while($resultados = mysqli_fetch_array($consultaDocente)){

                                                        echo '<div class="col s6 m6 l6">';
                                                        echo '    <label for="docente">Docente</label>';
                                                        echo '    <input type="text" name="docente" id="docente" placeholder="'.$resultados['docente'].'" disabled>';
                                                        echo '</div>';

                                                        echo '<div class="col s6 m6 l6">';
                                                        echo '    <label for="docente">Asignatura</label>';
                                                        echo '    <input type="text" name="asignatura" id="asignatura" placeholder="'.$resultados['asignatura'].'" disabled>';
                                                        echo '</div>';

                                                    }

                                                }

                                                ?>

                                            </div>

                                        </div>

                                    </form>
                                </div>

                                <div class="col s2 m2 l2"></div>

                            </div>

                            <div class="row">

                                <?php

                                if(isset($_GET['acta']) && isset($_GET['periodo'])){

                                    echo '<div class="col s12 m12 l12">';
                                    echo '<div class="container form1">';


                                    while($result = mysqli_fetch_array($consulta)){

                                        $titulo = utf8_encode($result['topico']);
                                        $mb = $result['muy_bueno'];
                                        $b = $result['bueno'];
                                        $a = $result['aceptable'];
                                        $d = $result['deficiente'];
                                        $md = $result['muy_deficiente'];
                                        $total = $result['total'];


                                        echo '<div class="row">';
                                        echo    '<div class="col s9 m9 l9"><p>'.$titulo.'</p></div>';
                                        echo    '<div class="col s3 m3 l3"><p style="text-align: center;">Votos</p></div>';
                                        echo '</div>';

                                        echo '<ul>';

                                        echo '<li>';
                                        echo    '<div class="col s3 m3 l3"><p>Muy Bueno</p></div>';
                                        if($mb==0){
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: 0%">0%</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: '.($mb*100)/$total.'%;">'.round(($mb*100)/$total).'%</div>';
                                            echo '</div>';
                                        }
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$mb.'</p></div>';
                                        echo '</li>';



                                        echo '<li>';
                                        echo    '<div class="col s3 m3 l3"><p>Bueno</p></div>';
                                        if($b==0){
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: 0%">0%</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: '.($b*100)/$total.'%;">'.round(($b*100)/$total).'%</div>';
                                            echo '</div>';
                                        }
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$b.'</p></div>';
                                        echo '</li>';



                                        echo '<li>';
                                        echo    '<div class="col s3 m3 l3"><p>Aceptable</p></div>';
                                        if($a==0){
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: 0%">0%</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: '.($a*100)/$total.'%;">'.round(($a*100)/$total).'%</div>';
                                            echo '</div>';
                                        }
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$a.'</p></div>';
                                        echo '</li>';



                                        echo '<li>';
                                        echo    '<div class="col s3 m3 l3"><p>Deficiente</p></div>';
                                        if($d==0){
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: 0%">0%</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: '.($d*100)/$total.'%;">'.round(($d*100)/$total).'%</div>';
                                            echo '</div>';
                                        }
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$d.'</p></div>';
                                        echo '</li>';



                                        echo '<li>';
                                        echo    '<div class="col s3 m3 l3"><p>Muy Defciente</p></div>';
                                        if($md==0){
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: 0%">0%</div>';
                                            echo '</div>';
                                        }else{
                                            echo '<div class="col s6 m6 l6">';
                                            echo    '<div class="barra" style="width: '.($md*100)/$total.'%;">'.round(($md*100)/$total).'%</div>';
                                            echo '</div>';
                                        }
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$md.'</p></div>';
                                        echo '</li>';



                                        echo '</ul>';

                                        echo '<div class="row">';
                                        echo    '<div class="col s3 m3 l3"></div>';
                                        echo    '<div class="col s6 m6 l6"><p style="text-align: right;">Votos totales:</p></div>';
                                        echo    '<div class="col s3 m3 l3"><p class="derecho">'.$total.'</p></div>';
                                        echo '</div>';

                                        echo '<br>';

                                    }
                                }


                                echo '</div>';
                                echo '</div>';

                                ?>


                                <div class="form-field center-align">

                                    <input class="btn" type="submit" name="volver" value="Volver" onclick="volver()">

                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<?php

include('includes/conectar.php');

session_start();
ob_start();

/*if($_SESSION['sesionActiva'] != "Activa"){
    header('location: Evaluacion.php');
}else{*/

    $alumno = $_SESSION['cedula'];
    $tabla = $_POST['tabla'];
    $docente = $_POST['docente'];
    $asignatura = $_POST['asignatura'];

    //$buscarActa = $conexion->query("SELECT acta FROM actas WHERE asignatura='$asignatura' AND docente='$docente'");
    $buscarActa = $conexion->query("SELECT * FROM actas act INNER JOIN alumnos alu ON act.acta = alu.acta WHERE act.asignatura = '$asignatura' AND act.docente = '$docente' AND alu.alumno = '$alumno'");

    while($valor = mysqli_fetch_array($buscarActa)){

        $acta = $valor['acta'];

        foreach($tabla as $fila){
            /*echo $docente.' ';
            echo $fila['titulo'].' '. $fila['opcion'];
            echo '<br>';*/

            $topico = $fila['titulo'];
            $opcion = $fila['opcion'];
            $titulo = utf8_decode($topico);

            //echo $docente.' '.$acta.' '.$asignatura.' '.$topico.' '.$opcion.'<br>';

            $buscarResp = $conexion->query("SELECT * FROM respuestas WHERE topico = '$titulo' AND acta = '$acta'");

            if($valores = mysqli_fetch_array($buscarResp)){

                if($opcion=='mb'){

                    $act = $conexion->query("UPDATE respuestas SET muy_bueno=muy_bueno+1, total=total+1 WHERE topico='$titulo' AND acta='$acta'");

                }elseif($opcion=='b'){

                    $act = $conexion->query("UPDATE respuestas SET bueno=bueno+1, total=total+1 WHERE topico='$titulo' AND acta='$acta'");

                }elseif($opcion=='a'){

                    $act = $conexion->query("UPDATE respuestas SET aceptable=aceptable+1, total=total+1 WHERE topico='$titulo' AND acta='$acta'");

                }elseif($opcion=='d'){

                    $act = $conexion->query("UPDATE respuestas SET deficiente=deficiente+1, total=total+1 WHERE topico='$titulo' AND acta='$acta'");

                }elseif($opcion=='md'){

                    $act = $conexion->query("UPDATE respuestas SET muy_deficiente=muy_deficiente+1, total=total+1 WHERE topico='$titulo' AND acta='$acta'");

                }

            }else{

                if($opcion=="mb"){

                    $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', '$acta', '$docente', 1, 0, 0, 0, 0, 1)");

                }elseif($opcion=='b'){

                    $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', '$acta', '$docente', 0, 1, 0, 0, 0, 1)");

                }elseif($opcion=='a'){

                    $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', '$acta', '$docente', 0, 0, 1, 0, 0, 1)");

                }elseif($opcion=='d'){

                    $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', '$acta', '$docente', 0, 0, 0, 1, 0, 1)");

                }elseif($opcion=='md'){

                    $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', '$acta', '$docente', 0, 0, 0, 0, 1, 1)");

                }


            }

        }

        $conexion->query("UPDATE alumnos SET evaluado = '1' WHERE alumno = '$alumno' AND acta = '$acta'");

    }

    header('location: EvaluacionExitosa.php');

//}

?>

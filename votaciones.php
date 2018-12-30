<?php

include('includes/conectar.php');

$tabla = $_POST['tabla'];
$docente = $_POST['docente'];
$act = "";
$ins = "";

foreach($tabla as $fila){
    /*echo $docente.' ';
        echo $fila['titulo'].' '. $fila['opcion'];
        echo '<br>';*/

    $topico = $fila['titulo'];
    $opcion = $fila['opcion'];

    $buscarActa = $conexion->query("SELECT acta FROM actas WHERE docente='$docente'");

    while($valor = mysqli_fetch_array($buscarActa)){

        $acta = $valor['acta'];

        $buscarResp = $conexion->query("SELECT * FROM respuestas WHERE topico = '$topico' AND acta = '$acta' AND docente = '$docente'");

        if($valores = mysqli_fetch_array($buscarResp)){

            if($opcion=='mb'){

                $act = $conexion->query("UPDATE respuestas SET muy_bueno = muy_bueno + 1, AND total = total + 1 WHERE topico='$topico' AND acta='$acta' AND docente='$docente'");

            }elseif($opcion=='b'){

                $act = $conexion->query("UPDATE respuestas SET bueno = bueno + 1, AND total = total + 1 WHERE topico='$topico' AND acta='$acta' AND docente='$docente'");

            }elseif($opcion=='a'){

                $act = $conexion->query("UPDATE respuestas SET aceptable = aceptable + 1, AND total = total + 1 WHERE topico='$topico' AND acta='$acta' AND docente='$docente'");

            }elseif($opcion=='d'){

                $act = $conexion->query("UPDATE respuestas SET deficiente = deficiente + 1, AND total = total + 1 WHERE topico='$topico' AND acta='$acta' AND docente='$docente'");

            }elseif($opcion=='md'){

                $act = $conexion->query("UPDATE respuestas SET muy_deficiente = muy_deficiente + 1, AND total = total + 1 WHERE topico='$topico' AND acta='$acta' AND docente='$docente'");

            }

        }else{

            if($opcion=="mb"){

                $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$topico', '$acta', '$docente', 1, 0, 0, 0, 0, 1)");

            }elseif($opcion=='b'){

                $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$topico', '$acta', '$docente', 0, 1, 0, 0, 0, 1)");

            }elseif($opcion=='a'){

                $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$topico', '$acta', '$docente', 0, 0, 1, 0, 0, 1)");

            }elseif($opcion=='d'){

                $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$topico', '$acta', '$docente', 0, 0, 0, 1, 0, 1)");

            }elseif($opcion=='md'){

                $ins = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$topico', '$acta', '$docente', 0, 0, 0, 0, 1, 1)");

            }

        }

    }
    
    header('locacion: evaluacionExitosa.php');
    
}

?>

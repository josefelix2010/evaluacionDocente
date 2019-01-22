<?php

include('includes/conectar.php');

session_start();
ob_start();

if($_SESSION['sesionActiva'] != "Activa"){
    header('location: Evaluacion.php');
}else{

    $coordinador = $_SESSION['cedula'];
    $tabla = $_POST['tabla'];
    $docente = $_POST['docente'];
    $asignatura = $_POST['asignatura'];
    $comentario = $_POST['coment'];

    //$buscarActa = $conexion->query("SELECT acta FROM actas WHERE asignatura='$asignatura' AND docente='$docente'");
    $buscarActa = $conexion->query("SELECT act.acta, act.periodo FROM actas act INNER JOIN coordinadores coo ON act.acta = coo.acta WHERE act.asignatura = '$asignatura' AND act.docente = '$docente' AND coo.coordinador = '$coordinador'");

    while($valor = mysqli_fetch_array($buscarActa)){

        $acta = $valor['acta'];
        $periodo = $valor['periodo'];

        foreach($tabla as $fila){

            $topico = $fila['titulo'];
            $opcion = $fila['opcion'];
            $titulo = utf8_decode($topico);

            $ins = $conexion->query("INSERT INTO respuestascoor (topico, acta, docente, periodo, respuesta, comentario) VALUES ('$titulo', '$acta', '$docente', '$periodo', '$opcion', '$comentario')");

        }

        $conexion->query("UPDATE coordinadores SET evaluado = '1' WHERE coordinador = '$coordinador' AND acta = '$acta'");

    }

    session_unset();
    session_destroy();

    header('location: EvaluacionExitosa.php');

}

?>

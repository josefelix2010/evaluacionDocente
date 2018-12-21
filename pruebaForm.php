<?php

    $tabla = $_POST['tabla'];
    
    foreach($tabla as $fila){
        echo $fila['titulo'].' '. $fila['opcion'];
        echo '<br>';
    }

?>
<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_POST['login'])){
    echo 'bien';
    $consulta2 = $conexion->query("SELECT * FROM topicos ORDER BY RAND() LIMIT 12");
    
    $preguntas = array();
    
    $lineas = mysqli_num_rows($consulta2);
    
    if($lineas > 0){
        for($i=0; $i<$lineas; $i++){
            $valor = mysqli_fetch_array($consulta2);
            $preguntas[$i] = utf8_encode($valor['titulo']);
        }
    }
    
    $_SESSION['preguntas'] = $preguntas;
    
    header('location: prueba.php');
}

?>


<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">
    
    <title></title>
</head>

<body>
    <div class="row">

            <div class="col s12 l4 offset-l4">

                <div class="card">

                    
                    <div class="card-content">

                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="form-field center-align">
                                <input class="btn red" type="submit" name="login" value="Ingresar">
                                <input class="btn red" type="submit" name="olvido" value="Olvidé mi contraseña">
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>
    
</body>
</html>
<?php

include('includes/conectar.php');

if(isset($_POST['buscar'])){

    $usuario = $_POST['usuario'];
    $correo = $_POST['correo'];

    $consulta = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$usuario' AND correo = '$correo'");

    if($valores = mysqli_fetch_array($consulta)){
        header('location: recuperar.php?usuario='.$usuario.'&correo='.$correo.'');
    }else{
        echo '<script type="text/javascript">';
        echo 'alert("Usuario o contraseña incorrecta.");';
        echo '</script>';
        
        header('location: recuperar.php');
    }

}

if(isset($_POST['guardar'])){
    
    $usuario = $_GET['usuario'];
    $correo = $_GET['correo'];
    $pass = $_POST['password'];
    $pass1 = $_POST['password1'];
    
    if($pass == $pass1){
        
        $update = $conexion->query("UPDATE usuarios SET password = '$pass' WHERE usuario = '$usuario' AND correo = '$correo'");
        
        if(mysqli_affected_rows($conexion) > 0){
            echo '<script type="text/javascript">';
            echo    'alert("Cambio de contraseña exitoso para el usuario: '.$usuario.'.")';
            echo '</script>';
            header('location: recuperar.php');
        }
        
    }
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Recuperar contraseña</title>

        <link rel="stylesheet" href="css/index.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="fonts/Quicksand">
        
        <script type="text/javascript">
            function volver(){
                window.location.href="index.php";
            }
        </script>

    </head>
    <body>

        <div class="row login">

            <div class="col s12 l4 offset-l4">

                <div class="card">

                    <div class="card-action red">
                        <p>Inicio de sesión</p>
                    </div>

                    <div class="card-content">

                        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

                            <?php
                            
                            if(!isset($_GET['usuario']) && !isset($_GET['correo'])){                                
                                
                                echo '<div class="form-field">';
                                echo '<label for="usuario">Usuario</label>';
                                echo '<input type="text" name="usuario" id="usuario" placeholder="Usuario" required>';
                                echo '</div>';

                                echo '<br>';

                                echo '<div class="form-field">';
                                echo '<label for="correo">Correo electrónico</label>';
                                echo '<input id="correo" name="correo" type="email" class="validate" placeholder="correo@electronico.com" required>';
                                echo '<span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto" required></span>';
                                echo '</div>';

                                echo '<br>';
                                
                                echo '<div class="form-field center-align">';
                                echo '<input class="btn red" style="margin: 5px;" type="submit" name="buscar" value="Buscar">';
                                echo '</div>';
                                
                            }elseif(isset($_GET['usuario']) && isset($_GET['correo'])){
                                
                                if($_GET['usuario']!="" && $_GET['correo']!=""){
                                    
                                    echo '<div class="form-field">';
                                    echo '<label for="usuario">Usuario</label>';
                                    echo '<input type="text" name="usuario" id="usuario" placeholder="'.$_GET['usuario'].'">';
                                    echo '</div>';

                                    echo '<br>';

                                    echo '<div class="form-field">';
                                    echo '<label for="correo">Correo electrónico</label>';
                                    echo '<input id="correo" name="correo" type="email" class="validate" placeholder="'.$_GET['correo'].'">';
                                    echo '<span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto"></span>';
                                    echo '</div>';

                                    echo '<br>';
                                    
                                    echo '<div class="form-field">';
                                    echo '<label for="password">Contraseña</label>';
                                    echo '<input type="password" name="password" id="password" placeholder="Contraseña" required>';
                                    echo '</div>';

                                    echo '<div class="form-field">';
                                    echo '<label for="password1">Valide su contraseña</label>';
                                    echo '<input type="password" name="password1" id="passwor1" placeholder="Valide su csontraseña" required>';
                                    echo '</div>';

                                    echo '<br>';
                                    
                                    echo '<div class="form-field center-align">';
                                    echo '<input class="btn red" style="margin: 5px;" type="submit" name="buscar" value="Buscar">';
                                    echo '<input class="btn red" style="margin: 5px;" type="submit" name="guardar" value="Guardar">';
                                    echo '</div>';
                                    
                                }else{
                                    
                                    echo '<div class="form-field">';
                                    echo '<label for="usuario">Usuario</label>';
                                    echo '<input type="text" name="usuario" id="usuario" placeholder="Usuario" required>';
                                    echo '</div>';

                                    echo '<br>';

                                    echo '<div class="form-field">';
                                    echo '<label for="correo">Correo electrónico</label>';
                                    echo '<input id="correo" name="correo" type="email" class="validate" placeholder="correo@electronico.com" required>';
                                    echo '<span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto" required></span>';
                                    echo '</div>';

                                    echo '<br>';
                                    
                                    echo '<div class="form-field center-align">';
                                    echo '<input class="btn red" style="margin: 5px;" type="submit" name="Buscar" value="Buscar">';
                                    echo '</div>';
                                    
                                }
                                
                            }
                            
                            ?>

                        </form>
                        
                        <div class="form-field center-align">
                        <input class="btn red" style="margin: 5px;" type="submit" name="volver" value="Volver" onclick="volver()">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>
</html>
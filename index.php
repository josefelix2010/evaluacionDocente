<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_POST['login'])){

    $user = $_POST['usuario'];
    $pass = $_POST['password'];

    $login = $conexion->query("SELECT * FROM usuarios WHERE usuario = '$user' AND password = '$pass'");

    if($resultado = mysqli_fetch_array($login)){

        $_SESSION['usuarioLogin'] = $user;
        $_SESSION['sesionAbierta'] = 'Activa';

        header('Location: inicio.php');

    }else{

        echo '<script type="text/javascript">';
        echo 'alert("Usuario o contraseña incorrecta.");';
        echo '</script>';

    }


}

if(isset($_POST['olvido'])){

    header('Location: recuperar.php');

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio de sesión</title>

        <link rel="stylesheet" href="css/index.css">

        <link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

        <link rel="stylesheet" href="fonts/Quicksand">

        <link rel="stylesheet" href="fonts/Nunito">

    </head>
    <body>

        <div class="row login">

            <div class="col s12 l4 offset-l4">

                <div class="card">

                    <div class="card-action red">
                        <p>Inicio de sesión</p>
                    </div>

                    <div class="card-content">

                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                            <div class="form-field">
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" id="usuario" placeholder="Usuario" required>
                            </div>

                            <br>

                            <div class="form-field">
                                <label for="password">Contraseña</label>
                                <input type="password" name="password" id="password" placeholder="Contraseña" required>
                            </div>

                            <br>

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
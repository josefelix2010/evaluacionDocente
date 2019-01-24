<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_SESSION['sesionAbierta'])){
    header('Location: inicio.php');
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

        <script src="libs/jquery-3.3.1.min.js"></script>

        <script src="libs/materialize/js/materialize.min.js"></script>

        <script type="text/javascript">
            function olvido(){
                window.location.href='recuperar.php';
            }

            $(document).ready(function(){
                $('#loginBtn').on('click', function(e){
                    e.preventDefault();

                    var usuario = $('#usuario').val();
                    var password = $('#password').val();

                    $.ajax({
                        type: "POST",
                        url: "includes/validarIndex.php",
                        data: ("usuario="+usuario+"&password="+password),
                        success: function(respuesta){
                            if(respuesta==1){
                                location.href="Inicio.php";
                            }else{
                                alert('Usuario o contraseña incorrecta.');
                            }
                        }
                    })
                })
            });
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

                        <form method="POST" id="login">

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
                                <input class="btn red" type="submit" name="login" id="loginBtn" value="Ingresar">
                            </div>

                        </form>

                        <br>

                        <div class="form-field center-align">
                            <input class="btn red" type="submit" name="olvido" value="Olvidé mi contraseña" onclick="olvido()">
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </body>
</html>
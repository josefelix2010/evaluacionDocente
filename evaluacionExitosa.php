<?php

session_start();
ob_start();

if(isset($_POST['volver'])){
    
    session_unset();
    session_destroy();
    
    header('location: evaluacion.php');
    
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

        <!--<script type="text/javascript">
            function volver(){
                window.location.href="evaluacion.php";
            }
        </script>-->

    </head>
    <body>

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="container form2">

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

                            <div class="row">

                                <div class="row">
                                    <div class="col s12 m12 l12">
                                        
                                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                            
                                            <div class="container form2">

                                                <p class="center-align" id="exito">Evaluación realizada con éxito.</p>

                                            </div>

                                            <br>

                                            <div class="form-field center-align">
                                                <input class="btn" style="background-color: #3582ff !important;" type="submit" name="volver" value="Volver">
                                            </div>
                                            
                                        </form>
                                        
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
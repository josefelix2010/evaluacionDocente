<?php

session_start();

  include('includes/conectar.php');

  $consulta2 = $conexion->query("SELECT * FROM topicos");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Formulario de evaluación</title>

	<link rel="stylesheet" href="css/evaluacion.css">

	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

	<link rel="stylesheet" href="libs/Quicksand">

  <script type="text/javascript">

  </script>

</head>
<body>

	<div class="row">
		<div class="col s12 m12 l12">
			<div class="container form">

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

          	<div class="row" style="margin-bottom: 10px;">
          		<div class="col s12 m12 l12">
          			<p class="cabecera">Este instrumento anónimo recaba información sobre el docente. Se agradece una opinión objetiva de acuerdo con su percepción
          				sobre las actividades realizadas. Sus respuestas son importantes ya que contribuirán a mejorar la calidad docente y su desempeño
          				en el aula.
          			</p>
          		</div>
          	</div>

          	<div class="row">

          	<div class="row">
          		<div class="col s12 m12 l12">
          			<div class="container form1">

          				<p class="center-align">Evaluación Docente</p>

          				<br>

          				<div class="row">
          					<div class="col s12 m12 l12">

                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <ul class="encuestas">
                          <?php

                            while($valores = mysqli_fetch_array($consulta2)){
                              echo '<li style="padding: 10px; margin: 10px; font-family: \'Quicksand\', sans-serif !important;">
                                      <a href="encuesta.php?id='.$valores['id'].'">'.utf8_encode($valores['titulo']).'</a>
                                    </li>';
                            }

                          ?>
                        </ul>
                      </form>

          					</div>
          				</div>

                  <div class="form-field center-align">
                    <input class="btn" style="margin: 20px;" type="submit" name="finalizar" value="Finalizar">
                  </div>

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
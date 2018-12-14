<?php

session_start();

  include('includes/conectar.php');

  if(isset($_GET['id'])){
    $id = $_GET['id'];
    $consulta2 = $conexion->query("SELECT * FROM topicos WHERE id='$id'");
  }

  if(isset($_POST['votar'])){

    if(isset($_POST['votos'])){
      $consulta = $conexion->query("SELECT * FROM respuestas WHERE topico = '$titulo' AND docente = '$docente'");

        if($valores = mysqli_fetch_array($consulta)){

          if($votos == "mb"){
            $update = $conexion->query("UPDATE respuestas SET muy_bueno = muy_bueno+1 AND total = total+1 WHERE topico = '$titulo' AND acta = '$acta'");
          }

          if($votos == "b"){
            $update = $conexion->query("UPDATE respuestas SET bueno = bueno+1 AND total = total+1 WHERE topico = '$titulo' AND acta = '$acta'");
          }

          if($votos == "a"){
            $update = $conexion->query("UPDATE respuestas SET aceptable = aceptable+1 AND total = total+1 WHERE topico = '$titulo' AND acta = '$acta'");
          }

          if($votos == "d"){
            $update = $conexion->query("UPDATE respuestas SET deficiente = deficiente+1 AND total = total+1 WHERE topico = '$titulo' AND acta = '$acta'");
          }

          if($votos == "md"){
            $update = $conexion->query("UPDATE respuestas SET muy_deficiente = muyDeficiente+1 AND total = total+1 WHERE topico = '$titulo' AND acta = '$acta'");
          }

        }else{

          if($votos == "mb"){
            $insert = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', 'acta', 'docente', 1, 0, 0, 0, 0, 1)");
          }

          if($votos == "b"){
            $insert = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', 'acta', 'docente', 0, 1, 0, 0, 0, 1)");
          }

          if($votos == "a"){
            $insert = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', 'acta', 'docente', 0, 0, 1, 0, 0, 1)");
          }

          if($votos == "d"){
            $insert = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', 'acta', 'docente', 0, 0, 0, 1, 0, 1)");
          }

          if($votos == "md"){
            $insert = $conexion->query("INSERT INTO respuestas (topico, acta, docente, muy_bueno, bueno, aceptable, deficiente, muy_deficiente, total) VALUES ('$titulo', 'acta', 'docente', 0, 0, 0, 0, 1, 1)");
          }

        }

        header('location: votar.php');
    }

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

          	<div class="row">

          	<div class="row">
          		<div class="col s12 m12 l12">
          			<div class="container form1">

                  <?php

                    while($valor = mysqli_fetch_array($consulta2)){
                      echo '<p class="center-align">'.utf8_encode($valor['titulo']).'</p>';
                    }
                  ?>
          				<br>

          				<div class="row">
          					<div class="col s12 m12 l12">

                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <p>
                          <label>
                            <input class="with-gap"  name="votos" type="radio" value="mb" />
                            <span>Muy Bueno</span>
                          </label>



                          <label>
                            <input class="with-gap" name="votos"  type="radio" value="b" />
                            <span>Bueno</span>
                          </label>



                          <label>
                            <input class="with-gap"  name="votos" type="radio" value="a" />
                            <span>Aceptable</span>
                          </label>



                          <label>
                            <input class="with-gap"  name="votos" type="radio" value="d" />
                            <span>Deficiente</span>
                          </label>



                          <label>
                            <input class="with-gap"  name="votos" type="radio" value="md" />
                            <span>Muy Deficiente</span>
                          </label>
                        </p>

                        <div class="form-field center-align">
                          <input class="btn" style="margin: 20px;" type="submit" name="votar" value="Votar">
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
		</div>
	</div>

</body>
</html>
<?php

  include('includes/conectar.php');

  //--------OBTENER CEDULA DE JS-------------

  if(isset($_POST['cedula'])){
    $cedula = $_POST['cedula'];
    $buscar = $conexion->query("SELECT * FROM alumnos WHERE alumno = '$cedula'");
  }

  //--------OBTENER OPCION DE JS-------------

  if(isset($_GET['actas'])){
    $acta = $_GET['actas'];
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
    function cambiar(){
      var id = document.getElementById('actas');
      var opciones = id.options[id.selectedIndex].text;
      var cedula = document.getElementById('cedula').value;
      window.location.href="evaluacion.php?cedula="+cedula+"&actas="+opciones+"";
      document.getElementById('cedula').value = cedula;
    }
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

          		<div class="col s12 m12 l12">
          			<table class="striped centered responsive-table">
					        <tbody>
					          <tr>
					            <td class="celdasTitulo">Cédula</td>
                      <td class="celdasTitulo">Acta</td>
                      <td class="celdasTitulo">Docente</td>
                    </tr>
                    <tr>
                      <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">
					            		<div class="form-field">

					            			<?php
                                if(isset($_POST['cedula'])){
                                  $cedula = $_POST['cedula'];
                              ?>
                              <input type="text" name="cedula" id="cedula" value="<?php echo $cedula; ?>" required>

                            <?php }else{
                              echo '<input type="text" name="cedula" id="cedula" placeholder="Cedula">';
                            } ?>

				                    	<input class="btn" type="submit" name="buscar" value="Buscar">

				                  </div>
                        </td>
                      </form>
                      <form method="POST" action="votar.php" id="evaluacion">
                        <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">
                            <div class="form-field">
                              <select class="browser-default" name="actas" id="actas" onchange="cambiar()">
                                <option value="" disabled selected hidden>Actas</option>

                                <?php
                                  while($valores = mysqli_fetch_array($buscar)){
                                    echo '<option value="'.$valores['id'].'">'.utf8_encode($valores['acta']).'</option>';
                                  }
                                ?>
                              </select>

                              <?php
                              if(isset($_GET['actas'])){
                                $acta = $_GET['actas'];
                              ?>
                              <input type="text" name="acta" id="acta" value="<?php echo $acta; ?>" hidden>
                            <?php } ?>
                            </div>

                        </td>
                        <td class="celdasInfo" style="max-width: 120px; padding: 10px 50px;">

                          <?php
                            if(isset($_GET['actas'])){
                              $acta = $_GET['actas'];
                              $actas = $conexion->query("SELECT * FROM actas WHERE acta = '$acta'");
                              while($valores = mysqli_fetch_array($actas)){
                                $docente = $valores['docente'];
                          ?>

                          <input type="text" name="docente" id="docente" value="<?php echo $docente; ?>" readonly>
                            <?php
                              }
                              }
                            ?>

                        </td>
      					      </form>
                    </tr>
                  </tbody>
                </table>
                <div class="form-field center-align">
                  <input class="btn" type="submit" name="evaluar" value="Evaluar" form="evaluacion">
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
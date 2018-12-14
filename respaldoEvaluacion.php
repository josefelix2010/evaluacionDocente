<?php

  include('includes/conectar.php');
  include('includes/votar.php');

  //----------------------PAGINACION------------------------

  $consulta = $conexion->query("SELECT * FROM topicos");
  $numRegistros = mysqli_num_rows($consulta);
  $regXPagina = 1;
  if(isset($_GET['pag'])){
    $num_pag = $_GET['pag'];
  }else{
    $num_pag = 1;
  }
  if(is_numeric($num_pag)){
    $inicio = ($num_pag - 1) * $regXPagina;
  }else{
    $inicio = 0;
  }
  $consulta2 = $conexion->query("SELECT * FROM topicos LIMIT $inicio, $regXPagina");
  $cantidad = ceil($numRegistros/$regXPagina);

  //------------------FIN PAGINACIÓN--------------------------------------------

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

              <div class="col s12 m12 l12">
      		    <form method="POST" action="includes/votar.php">
                <table class="striped centered responsive-table">
                  <tbody>
                    <tr>
                      <td class="celdasTitulo">Cédula</td>
                      <td class="celdasTitulo">Acta</td>
                      <td class="celdasTitulo">Docente</td>
                    </tr>
                    <tr>
                      <td class="celdasInfo">

					            		<div class="form-field">
                            <?php

                            if(isset($cedula)){

                            ?>
					            			<input type="text" name="cedula" id="cedula" value="<?php echo $cedula; ?>" required>

                            <?php
                            }
                            ?>
					                  <input class="btn" type="submit" name="buscar" value="Buscar">
				                  </div>

					            </td>
					            <td class="celdasInfo">
					            	<div class="form-field">
				                  <select class="browser-default" name="actas" id="actas" onchange="cambiar()">
				                   	<option value="" disabled selected hidden>Actas</option>

                            <?php
                              $consulta = mysqli_query($buscarCedula);
                              while ($valActas = mysqli_fetch_array($consulta)) {
                                echo '<option value="'.$valActas['id'].'">'.utf8_encode($valActas['acta']).'</option>';
                              }
                            ?>

				                  </select>
				                </div>
                        <input class="btn" type="submit" name="buscar" value="Buscar">
					            </td>
					            <td class="celdasInfo">

                        <input type="text" name="docente" id="docente" value="" readonly>

                      </td>
					          </tr>
					        </tbody>
					      </table>
          		</div>

          	</div>

          	<hr>

          	<div class="row">
          		<div class="col s12 m12 l12">
          			<div class="container form1">

          				<p class="center-align">Evaluación Docente</p>

          				<br>

          				<div class="row">
          					<div class="col s12 m12 l12">

                        <table class="striped centered responsive-table">
                          <tr>
                            <td colspan="2" class="celdasTitulo"><input type="text" style="font-family: 'Quicksand', sans-serif; color: #FFF" class="center-align" name="titulo" id="titulo" value="Titulo" readonly></td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                          </tr>
                            <tr>
                              <td width="60" class="celdasInfo">
                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="mb" />
                                    <span>Muy Bueno</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap" name="votos"  type="radio" value="b" />
                                    <span>Bueno</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="a" />
                                    <span>Aceptable</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="d" />
                                    <span>Deficiente</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="md" />
                                    <span>Muy Deficiente</span>
                                  </label>
                                </p>
                              </td>
                            </tr>
                            <tr>

                              <td><input class="btn" type="submit" name="votar" value="Votar"></td>

                            </tr>
                        </table>
              </form>

                      <div id="pagination">
                        <center>
                          <?php
                            if(isset($_GET['cedula']) && isset($_GET['actas'])){
                              $cedula=$_GET['cedula'];
                              $opciones=$_GET['actas'];
                              if($num_pag>1){
                                echo '<a class="btn-small" href="evaluacion.php?cedula='.$cedula.'&actas='.$opciones.'&pag=1">Primero</a>';
                                echo '<a class="btn-small" href="evaluacion.php?cedula='.$cedula.'&actas='.$opciones.'&pag='.($num_pag-1).'">Anterior</a>';
                              }
                              echo '<strong>'.$num_pag.' de '.$cantidad.'</strong>';
                              if($num_pag<$cantidad){
                                echo '<a class="btn-small" href="evaluacion.php?cedula='.$cedula.'&actas='.$opciones.'&pag='.($num_pag+1).'">Siguiente</a>';
                                echo '<a class="btn-small" href="evaluacion.php?cedula='.$cedula.'&actas='.$opciones.'&pag='.$cantidad.'">Ultimo</a>';
                              }
                            }
                          ?>
                        </center>
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
	</div>

</body>
</html>
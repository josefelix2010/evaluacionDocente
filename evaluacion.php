<?php

  include('includes/conectar.php');

  //--------------------VOTAR-----------------------------
  if(isset($_POST['votar'])){

    if(isset($_POST['votos'])){}

  }

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


  //--------OBTENER CEDULA DE JS-------------
  if(isset($_GET['cedula'])){

    $cedula = $_GET['cedula'];

    $buscar = $conexion->query("SELECT * FROM alumnos WHERE alumno = '$cedula'");

  }


  //--------OBTENER OPCION DE JS-------------
  if(isset($_GET['opciones'])){

    $opciones = $_GET['opciones'];

    $actas = $conexion->query("SELECT * FROM actas WHERE acta = '$opciones'");

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
					            <td class="celdasInfo">
					            	<form>
					            		<div class="form-field">

					            			<div class="col s8 m8 l8">

                              <?php

                                if(isset($_GET['cedula'])){
                                  $cedula = $_GET['cedula'];

                              ?>
					                    <input type="text" name="cedula" id="cedula" value="<?php echo $cedula; ?>">

                            <?php }else{
                              echo '<input type="text" name="cedula" id="cedula" placeholder="Cedula">';
                            } ?>
					                  </div>

					                  <div class="col s4 m4 l4">
				                    	<button class="btn" onclick="cedula()">Buscar</button>
				                    </div>

				                  </div>
					            	</form>
					            </td>
					            <td class="celdasInfo">
					            	<form>
					            		<div class="form-field">
				                    <select class="browser-default" name="actas" id="actas" onchange="cambiar()">
				                    	<option value="" disabled selected hidden>Actas</option>

                              <?php

                                while($valores = mysqli_fetch_array($buscar)){

                                  echo '<option value="'.$valores['id'].'">'.utf8_encode($valores['acta']).'</option>';

                                }

                              ?>
				                    </select>
				                  </div>
					            	</form>
					            </td>
					            <td class="celdasInfo">
                        <input type="text" name="docente" id="docente" value="<?php if(isset($_GET['opciones'])){echo $_GET['opciones'];} ?>" readonly>
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

											<form method="POST" action="insertVotos.php">
                        <table class="striped centered responsive-table">
                          <?php

                            while($valores = mysqli_fetch_array($consulta2)){

                              $titulo = $valores['titulo'];
                              $id = $valores['id'];

                          ?>
                          <tr>
                            <td colspan="2" class="celdasTitulo"><?php echo utf8_encode($titulo); ?></td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                          </tr>
                          <form method="POST" action="<?php echo $_SERVER['PHO_SELF']; ?>">
                            <tr>
                              <td width="60" class="celdasInfo">
                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="5" required="true" />
                                    <span>Muy Bueno</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap" name="votos"  type="radio" value="4" required="true"/>
                                    <span>Bueno</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="3" required="true"/>
                                    <span>Aceptable</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="2" required="true"/>
                                    <span>Deficiente</span>
                                  </label>
                                </p>

                                <p>
                                  <label>
                                    <input class="with-gap"  name="votos" type="radio" value="1" required="true"/>
                                    <span>Muy Deficiente</span>
                                  </label>
                                </p>
                              </td>
                            </tr>
                            <tr>
                              <td><input class="btn" type="submit" name="votar" value="Votar"></td>
                            </tr>
                          </form>
                          <?php } ?>
                        </table>
                      </form>

                      <center>
                        <div id="pagination">
                          <?php
                            if($num_pag>1){
                              echo '<a class="waves-effect" href="evaluacion.php?pag=1">Primero</a>';
                              echo '<a class="waves-effect" href="evaluacion.php?pag=1'.($num_pag-1).'">Anterior</a>';
                            }

                            echo '<strong id="paginas2">'.$num_pag.' de '.$cantidad.'</strong>';

                            if($num_pag<$cantidad){
                              echo '<a class="waves-effect" href="evaluacion.php?pag='.($num_pag+1).'">Siguiente</a>';
                              echo '<a class="waves-effect" href="evaluacion.php?pag='.$cantidad.'">Ultimo</a>';
                            }
                          ?>
                        </div>
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

</body>
</html>
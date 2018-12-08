<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Formulario de evaluación</title>

	<link rel="stylesheet" href="css/evaluacion.css">

	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

	<link rel="stylesheet" href="libs/Quicksand">

</head>
<body>

	<div class="row">
		<div class="col s12 m12 l12">
			<div class="container form">

				<div class="card">

          <div class="card-action">
            <div class="row">

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
          		<div class="col s12 m12 l12">
          			<p class="cabecera">Este instrumento anónimo recaba información sobre el docente. Se agradece una opinión objetiva de acuerdo con su percepción
          				sobre las actividades realizadas. Sus respuestas son importantes ya que contribuirán a mejorar la calidad docente y su desempeño
          				en el aula.
          			</p>
          		</div>
          	</div>

          	<div class="row">

          		<div class="col s7 m7 l7">
          			<table class="striped centered responsive-table">
					        <tbody>
					          <tr>
					            <td class="celdasTitulo">Cédula</td>
					            <td class="celdasInfo">
					            	<form>
					            		<div class="form-field">

					            			<div class="col s8 m8 l8">
					                    <input type="text" name="cedula" id="cedula" placeholder="Cédula">
					                  </div>

					                  <div class="col s4 m4 l4">
				                    	<input class="btn" type="submit" name="buscar" value="Buscar">
				                    </div>

				                  </div>
					            	</form>
					            </td>
					          </tr>
					          <tr>
					            <td class="celdasTitulo">Acta</td>
					            <td class="celdasTitulo">Sección</td>
					          </tr>
					          <tr>
					            <td class="celdasInfo">
					            	<form>
					            		<div class="form-field">
				                    <select class="browser-default" name="titulos" id="titulos">
				                    	<option value="" disabled selected hidden>Elija un tópico</option>
				                    </select>
				                  </div>
					            	</form>
					            </td>
					            <td class="celdasInfo">Prueba</td>
					          </tr>
					        </tbody>
					      </table>
          		</div>

          		<div class="col s1 m1 l1"></div>

          		<div class="col s4 m4 l4">
          			<p class="celdasTitulo" style="padding: 5px;">Instrucciones para responder</p>
          			<p class="celdasInst">Lea cuidadosamente cada uno de los tópicos. Las opciones está ordenadas de la siguiente manera:<br>
          			5->MUY BUENO<br>
          			4->BUENO<br>
          			3->ACEPTABLE<br>
          			2->DEFICIENTE<br>
          			1-> MUY DEFICIENTE</p>
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

											<ul>
												<li>Título del tópico</li>
											</ul>
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
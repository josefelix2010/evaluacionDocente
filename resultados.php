<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Resultados</title>

	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/resultados.css">

	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

	<link rel="stylesheet" href="libs/Quicksand">

</head>
<body>

	<div class="row">
		<nav>
	    <div class="nav-wrapper navbar">
	     <img src="img/Logo.png" alt="Logo" height="48">
	      <ul id="nav-mobile" class="right hide-on-med-and-down">
	        <li><a href="inicio.php">Inicio</a></li>
	        <li><a href="formEdit.php">Formulario</a></li>
	        <li><a href="resultados.php">Resultados</a></li>
	        <li><a href="usuarios.php">Usuarios</a></li>
	        <li><a href="index.php">Salir</a></li>
	      </ul>
	    </div>
	  </nav>
	</div>

	<div class="row">
		<div class="col s12 m12 l12">
			<div class="container form">
				<div class="card">

          <div class="card-action center-align">
            <p>Ver resultados</p>
          </div>

          <div class="card-content">

            <div class="row">

              <div class="col s2 m2 l2"></div>

              <div class="col s8 m8 l8">
                <form>

                  <div class="form-field">

                  	<div class="row">
	                  	<div class="col s4 m4 l4">

		                    <label for="acta">Nº de Acta</label>
		                    <input type="text" name="acta" id="acta" placeholder="Nº de Acta">

	                    </div>

	                    <div class="col s4 m4 l4">
												<label for="docente">Docente</label>
	                    	<input type="text" name="docente" id="docente" placeholder="Docente" disabled>
	                    </div>

	                    <div class="col s4 m4 l4">
	                    	<input class="btn" type="submit" name="buscar" id="buscar" value="Buscar">
	                    </div>
                  	</div>

                  </div>

                </form>
              </div>

              <div class="col s2 m2 l2"></div>

            </div>

            <div class="row">
            	<div class="col s12 m12 l12">
	            	<canvas id="myCanvas" style="border:1px solid #000000;"></canvas>
	            </div>
            </div>

            <div class="row center-align" id="noMargin">
            	<div class="col s12 m12 l12">
            		<ul class="pagination">
							    <li class="active"><a href="#!">1</a></li>
							    <li class="waves-effect"><a href="#!">2</a></li>
							    <li class="waves-effect"><a href="#!">3</a></li>
							    <li class="waves-effect"><a href="#!">4</a></li>
							    <li class="waves-effect"><a href="#!">5</a></li>
							  </ul>
            	</div>
            </div>

          </div>

        </div>
			</div>
		</div>
	</div>

</body>
</html>
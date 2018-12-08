<?php

  session_start();




?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio</title>

	<link rel="stylesheet" href="css/base.css">

  <link rel="stylesheet" href="css/inicio.css">

	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

	<link rel="stylesheet" href="fonts/Quicksand">

  <link rel="stylesheet" href="fonts/Arimo">

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
          <li><a href="includes/logout.php">Salir</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="row inicio">

    <div class="col s6 m6 l6">
      <div class="card medium">
        <div class="card-image">
          <img src="img/formulario.jpg">
          <span class="card-title">Editar Formulario</span>
        </div>
        <div class="card-content">
          <p>Edite los tópicos del formulario que presentan los alumnos
           al momento de evaluar a los docentes.</p>
        </div>
        <div class="card-action">
          <a href="formEdit.php">Editar formulario</a>
        </div>
      </div>
    </div>

    <div class="col s6 m6 l6">
      <div class="card medium">
        <div class="card-image">
          <img src="img/estadisticas.jpg">
          <span class="card-title">Ver Resultados</span>
        </div>
        <div class="card-content">
          <p>Revise los resultados arrojados por la evaluación de los alumnos hacia sus docentes.</p>
        </div>
        <div class="card-action">
          <a href="resultados.php">Ver resultados</a>
        </div>
      </div>
    </div>

  </div>



</body>
</html>
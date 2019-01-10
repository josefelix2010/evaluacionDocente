<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Base</title>

		<link rel="stylesheet" type="text/css" href="css/base.css" />
    
    <link rel="stylesheet" type="text/css" href="libs/materialize/css/materialize.min.css" />
    
    <script src="libs/jquery-3.3.1.min.js"></script>

    <script src="libs/materialize/js/materialize.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.dropdown-trigger').dropdown();
        });
    </script>

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
	        <li>
					<a class='dropdown-trigger btn' href='' data-target='dropdown1'>Drop Me!</a>

                <!-- Dropdown Structure -->
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!">one</a></li>
                    <li><a href="#!">two</a></li>
                    <li><a href="#!">three</a></li>
                </ul>
					</li>
	      </ul>
	    </div>
	  </nav>
	</div>

</body>
</html>
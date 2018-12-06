<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Modificar usuario</title>

	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/editarUser.css">

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
            <p>Modificar usuario</p>
          </div>

          <div class="card-content">

            <div class="row">

              <form>

              	<div class="row">

	      	        <div class="col s4 m4 l4">

	      	        	<div class="form-field">
	                    <label for="usuario">Elija un usuario</label>
	                      <div class="input-field">
	                        <select class="browser-default" name="usuario" id="usuario">
	                          <option value="" disabled selected hidden>Elija un usuario</option>
	                        </select>
	                      </div>
	                  </div>

	    	          </div>

	  	            <div class="col s4 m4 l4">

	                  <div class="form-field">
	                    <label for="usuario">Usuario</label>
	                    <input type="text" name="usuario" id="usuario" placeholder="Usuario">
	                  </div>

		              </div>

		              <div class="col s4 m4 l4">

	                  <div class="form-field">
	                    <label for="password1">Contraseña</label>
	                    <input type="password" name="password1" id="password1" placeholder="Contraseña">
	                  </div>

		              </div>

              	</div>

              	<div class="row">

		              <div class="col s4 m4 l4">

	                  <div class="form-field">
	                    <label for="nombre">Nombre</label>
	                    <input type="text" name="nombre" id="nombre" placeholder="Nombre">
	                  </div>

		              </div>

	      	        <div class="col s4 m4 l4">

	                  <div class="form-field">
	                    <label for="apellido">Apellido</label>
	                    <input type="text" name="apellido" id="apellido" placeholder="Apellido">
	                  </div>

	    	          </div>

	  	            <div class="col s4 m4 l4">

	                  <div class="form-field">
					            <label for="correo">Correo electrónico</label>
					            <input id="correo" type="email" class="validate" placeholder="correo@electronico.com">
					            <span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto"></span>
	                  </div>

		              </div>

              	</div>

	              <div class="form-field center-align">
	                <input class="btn" type="submit" name="modificar" value="Modificar">
	                <input class="btn" type="submit" name="volver" value="Volver">
	              </div>
            	</form>

            </div>

          </div>

        </div>
			</div>
		</div>
	</did>

</body>
</html>
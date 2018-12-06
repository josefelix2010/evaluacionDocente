<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inicio</title>

	<link rel="stylesheet" href="css/base.css">

	<link rel="stylesheet" href="css/usuarios.css">

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
            <p>Editar formulario</p>
          </div>

          <div class="card-content">

            <div class="row">

              <div class="col 12 m12 l12">

								<table class="striped centered responsive-table">
					        <thead>
					          <tr class="hightlight">
					              <th>Usuario</th>
					              <th>Nombre</th>
					              <th>Chaparro</th>
					              <th>Correo Electrónico</th>
					          </tr>
					        </thead>

					        <tbody>
					          <tr>
					            <td>admin</td>
					            <td>admin</td>
					            <td>admin</td>
					            <td>admin@admin.com</td>
					          </tr>
					          <tr>
					            <td>usuario1</td>
					            <td>usuario1</td>
					            <td>usuario1</td>
					            <td>usuario@numero1.com</td>
					          </tr>
					        </tbody>
					      </table>

					      <br>

                <form>

                  <div class="form-field">

                  <div class="form-field center-align">
                    <input class="btn" type="submit" name="login" value="Agregar">
                    <input class="btn" type="submit" name="olvido" value="Modificar">
                  </div>

                </form>
              </div>

            </div>

          </div>

        </div>

			</div>
		</div>
	</div>

</body>
</html>
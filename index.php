<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>

	<link rel="stylesheet" href="css/index.css">

	<link rel="stylesheet" href="libs/materialize/css/materialize.min.css">

	<link rel="stylesheet" href="fonts/Quicksand">

	<link rel="stylesheet" href="fonts/Nunito">

</head>
<body>

	<div class="row login">

		<div class="col s12 l4 offset-l4">

			<div class="card">

				<div class="card-action red">
					<p>Inicio de sesión</p>
				</div>

				<div class="card-content">

					<div class="form-field">
						<label for="usuario">Usuario</label>
						<input type="text" name="usuario" id="usuario" placeholder="Usuario">
					</div>

					<br>

					<div class="form-field">
						<label for="password">Contraseña</label>
						<input type="password" name="password" id="password" placeholder="Contraseña">
					</div>

					<br>

					<div class="form-field center-align">
						<input class="btn red" type="submit" name="login" value="Ingresar">
						<input class="btn red" type="submit" name="olvido" value="Olvidé mi contraseña">
					</div>

				</div>

			</div>

		</div>

	</div>

</body>
</html>
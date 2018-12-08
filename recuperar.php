<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Recuperar contraseña</title>

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
					    <label for="correo">Correo electrónico</label>
					    <input id="correo" type="email" class="validate" placeholder="correo@electronico.com">
					    <span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto"></span>
	                </div>

					<br>

					<div class="form-field">
						<label for="password">Contraseña</label>
						<input type="password" name="password" id="password" placeholder="Contraseña" disabled>
					</div>

					<div class="form-field">
						<label for="password1">Valide su contraseña</label>
						<input type="password" name="password1" id="passwor1" placeholder="Valide su csontraseña" disabled>
					</div>

					<br>

					<div class="form-field center-align">
						<input class="btn red" type="submit" name="guardar" value="Guardar">
						<input class="btn red" type="submit" name="cancelar" value="Cancelar">
					</div>

				</div>

			</div>

		</div>

	</div>

</body>
</html>
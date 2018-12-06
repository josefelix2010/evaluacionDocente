<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Modificar formulario</title>

	<link rel="stylesheet" href="css/base.css">

  <link rel="stylesheet" href="css/formEdit.css">

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

              <div class="col s2 m2 l2"></div>

              <div class="col s8 m8 l8">
                <form>

                  <div class="form-field">
                    <label for="titulo">Elija un tópico</label>
                      <div class="input-field">
                        <select class="browser-default" name="titulos" id="titulos">
                          <option value="" disabled selected hidden>Elija un tópico</option>
                        </select>
                      </div>
                  </div>

                  <br>

                  <div class="form-field">
                    <label for="topico">Tópico</label>
                    <input type="text" name="topico" id="topico" placeholder="Tópico">
                  </div>

                  <br>

                  <div class="form-field center-align">
                    <input class="btn" type="submit" name="agregar" value="Agregar">
                    <input class="btn" type="submit" name="eliminar" value="Eliminar">
                  </div>

                </form>
              </div>

              <div class="col s2 m2 l2"></div>

            </div>

          </div>

        </div>

      </div>
    </div>
  </div>

</body>
</html>
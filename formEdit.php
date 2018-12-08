<?php

  include('includes/conectar.php');

  $consulta = $conexion->query("SELECT * FROM topicos");

  if(isset($_POST['agregar'])){

    $titulo = utf8_decode($_POST['topico']);

    if($titulo == ""){

      /*echo '<script type="text/javascript">';
      echo 'alert("Debe insertar el título del tópico que quiere agregar.");';
      echo '</script>';*/

      $error = "ERRRRROROROORORORORORO";

    }else{

      $select = $conexion->query("SELECT * FROM topicos WHERE titulo = '$titulo'");

      if($existe = mysqli_fetch_array($select)){

        echo '<script type="text/javascript">';
        echo 'alert("Este tópico ya existe.");';
        echo '</script>';

      }else{

        $insert = "INSERT INTO topicos (titulo) VALUES ('$titulo')";

        if($conexion->query($insert) === TRUE){

          $mensaje = 'Tópico agragado con éxito.';

          header('location: formEdit.php');

        }

      }

    }

  }

  if(isset($_POST['eliminar'])){

    $titulo = utf8_decode($_POST['topico']);

    $delete = "DELETE FROM topicos WHERE titulo = '$titulo'";

    if($conexion->query($delete)){

      $mensaje = 'Tópico eliminado con éxito.';

      header('location: formEdit.php');

    }

  }

  if(isset($_POST['volver'])){

    header('location:inicio.php');

  }

?>



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

  <script type="text/javascript">
    function modificar(){
      var id = document.getElementById('titulos');
      var opcion = id.options[id.selectedIndex].text;
      document.getElementById('topico').value = opcion;
    }
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
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                  <?php

                    if(isset($mensaje)){
                      echo $mensaje;
                    }

                  ?>

                  <div class="form-field">
                    <label for="titulo">Elija un tópico</label>
                      <div class="input-field">
                        <select class="browser-default" name="titulos" id="titulos" onchange="modificar()">
                          <option value="" disabled selected hidden>Elija un tópico</option>
                          <?php

                            while($valores = mysqli_fetch_array($consulta)){
                              echo '<option value="'.$valores['id'].'">'.utf8_encode($valores['titulo']).'</option>';
                            }

                          ?>
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
                    <input class="btn" type="submit" name="volver" value="Volver">
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
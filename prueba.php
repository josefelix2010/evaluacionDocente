<?php

include('includes/conectar.php');

session_start();
ob_start();

if(isset($_SESSION['preguntas'])){
    foreach($_SESSION['preguntas'] as $preguntas){
        echo $preguntas.'<br>';
    }
}

session_unset();
session_destroy();


























/*$consulta = $conexion->query("SELECT * FROM topicos");

$numRegistros = mysqli_num_rows($consulta);

$regXPagina = 1;

if(isset($_GET['pag'])){

  $num_pag = $_GET['pag'];

}else{

  $num_pag = 1;

}

if(is_numeric($num_pag)){

  $inicio = ($num_pag - 1) * $regXPagina;

}else{

  $inicio = 0;

}

$consulta2 = $conexion->query("SELECT * FROM topicos LIMIT $inicio, $regXPagina");

$cantidad = ceil($numRegistros/$regXPagina);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
</head>
<body>

  <section id="form">
    <form action="prueba.php" class="contact_form" name="form1" metho="POST">
      <table>
        <?php

          while($row = mysqli_fetch_array($consulta2)){
            $titulo=$row['titulo'];
            $id=$row['id'];


        ?>

        <tr>
          <td width="50"><input type="radio" name="opcion" value="<?php echo $id; ?>" required></td>
          <td width="470"><?php echo $titulo ?></td>
        </tr>
        <?php } ?>
        <tr>
          <td><input type="submit" class="submit" value="Ver"></td>
          <td></td>
        </tr>
      </table>
      <center>
        <div id="paginador">
          <?php
            if($num_pag>1){
              echo '<a id="paginas1" href="prueba.php?pag=1">Primero</a>';
              echo '<a id="paginas1" href="prueba.php?pag=1'.($num_pag-1).'">Anterior</a>';
            }

            echo '<strong id="paginas2">'.$num_pag.' de '.$cantidad.'</strong>';

            if($num_pag<$cantidad){
              echo '<a id="paginas1" href="prueba.php?pag='.($num_pag+1).'">Siguiente</a>';
              echo '<a id="paginas1" href="prueba.php?pag='.$cantidad.'">Ultimo</a>';
            }
          ?>
        </div>
      </center>
    </form>
  </section>
  <center>
    <a id="paginas1" href="javascript.window.history.back();">$laquo; Volver</a>
  </center><br>

</body>
</html>*/

?>
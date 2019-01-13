<?php

session_start();
ob_start();

include('includes/conectar.php');

/*if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{*/

$consulta = $conexion->query("SELECT * FROM topicos");

if(isset($_POST['agregar'])){

    $titulo = utf8_decode($_POST['topico']);

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

//}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Modificar formulario</title>

        <link rel="stylesheet" href="css/formEdit.css">

        <link rel="stylesheet" type="text/css" href="css/base.css" />

        <link rel="stylesheet" type="text/css" href="libs/materialize/css/materialize.min.css" />

        <link rel="stylesheet" type="text/css" href="libs/material-design-icons-master/iconfont/material-icons.css" />

        <script src="libs/jquery-3.3.1.min.js"></script>

        <script src="libs/materialize/js/materialize.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.dropdown-trigger').dropdown();
                $('.sidenav').sidenav();
                $('.collapsible').collapsible();
            });
            
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
                    <ul class="left">
                        <li>
                            <a href="" class="sidenav-trigger show-on-large" data-target="menu-nav" style="margin-right: 0px; padding-right: 0px;">
                                <i class="material-icons" style="color: #000;">menu</i>
                            </a>
                        </li>
                        <li><a href="" class="sidenav-trigger show-on-large" data-target="menu-nav" style="margin: 0px; padding-left: 0px; color:#000;">SEDUJAP</a></li>
                    </ul>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li>
                            <a href=''><i class="material-icons" style="color: #f00">close</i><span style="color: #fff;">Salir</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="sidenav" id="menu-nav" style="background-image: linear-gradient(#E8F0FF, #3582ff); padding-top: 0px;">
            <ul style="margin: 0px;">
                <li>
                    <div class="user-view center-align" style="background-image: linear-gradient(#E8F0FF, #9bbef7);">
                        <p class="infoUser" style="color: #000 !important;"><span class="email">Sistema de Evaluación Docente</span></p>
                        <a style="text-align: center;"><img src="img/Logo-UJAP2.jpg" class="circle" style="display: block; margin: auto; height: 75px; width: 75px;"></a>
                        <p class="infoUser"><span>Usuario</span></p>
                        <p class="infoUser"><span class="name" style="margin-top: 0px !important;">Nombre y apellido</span></p>
                        <p class="infoUser"><span class="email">Correo</span></p>
                    </div>
                </li>
            </ul>

            <div>
                <ul>
                    <li>
                        <div class="collapsible-header">
                            <i class="material-icons">home</i>Inicio
                        </div>
                    </li>

                    <li>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">description</i>Formulario</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a>Lista de Ítems</a></li>
                                        <li><a>Agregar Ítem</a></li>
                                        <li><a>Eliminar Ítem</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">done_all</i>Resultados</div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">perm_identity</i>Usuarios</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li><a>Lista de Usuarios</a></li>
                                        <li><a>Agregar Usuario</a></li>
                                        <li><a>Editar Usuario</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>

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
                                            <input type="text" name="topico" id="topico" placeholder="Tópico" required>
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
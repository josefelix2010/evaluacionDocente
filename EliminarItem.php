<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

if(isset($_GET['id'])){
    $id = $_GET['id'];

    if($id == 1){
        $consulta = $conexion->query("SELECT * FROM topicos");
    }elseif($id == 2){
        $consulta = $conexion->query("SELECT * FROM topicoscoor");
    }
}

if(isset($_POST['eliminar'])){

    if(isset($_POST['topico']) && isset($_POST['tipo']))

        $titulo = utf8_decode($_POST['topico']);

    $id = $_POST['tipo'];

    if($id == 1){

        $delete = $conexion->query("DELETE FROM topicos WHERE titulo = '$titulo'");

        $filas = mysqli_affected_rows($conexion);

        if($filas > 0){
            echo '<script>';
            echo 'alert("Ítem eliminado de manera exitosa.")';
            echo '</script>';
        }

    }elseif($id == 2){

        $delete = $conexion->query("DELETE FROM topicoscoor WHERE titulo = '$titulo'");

        $filas = mysqli_affected_rows($conexion);

        if($filas > 0){
            echo '<script>';
            echo 'alert("Ítem eliminado de manera exitosa.")';
            echo '</script>';
        }

    }


}

if(isset($_POST['volver'])){

    header('location: Inicio.php');

}


}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Eliminar Ítem</title>

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

            function inicio(){
                location.href="Inicio.php";
            }

            function listaItems(){
                location.href="Items.php"
            }

            function agregarItem(){
                location.href="AgregarItem.php"
            }

            function eliminarItem(){
                location.href="EliminarItem.php"
            }

            function resultados(){
                location.href="Resultados.php"
            }

            function listaUsuarios(){
                location.href="Usuarios.php"
            }

            function agregarUsuario(){
                location.href="AgregarUsuario.php"
            }

            function editarUsuario(){
                location.href="EditarUsuario.php"
            }

            function modificar(){
                window.location.href='formEdit.php';
            }

            function volver(){
                window.location.href='inicio.php';
            }

            function modificar(){
                var id = document.getElementById('titulos');
                var opcion = id.options[id.selectedIndex].text;
                document.getElementById('topico').value = opcion;
            }

            function cambiar(){
                var id = document.getElementById('tipo').value;
                if(id == 1){
                    window.location.href="EliminarItem.php?id=1";
                }else if(id == 2){
                    window.location.href="EliminarItem.php?id=2";
                }
            }

            function modal(){
                var item = document.getElementById('topico').value;
                var id = document.getElementById('tipo');
                var tipo = id.options[id.selectedIndex].text;

                var topico = item.charAt(0).toUpperCase() + item.slice(1);

                if(item == "" || id == 0){
                    alert('El campo "Ítem" no puede estar vacío y debe haber seleccionado alguno de los formularios.');
                }else{

                    document.getElementById('itemModal').textContent = topico;
                    document.getElementById('tipoModal').textContent = tipo;

                    $('.modal').modal()

                }
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
                                <i class="material-icons" style="color: #000;">menu</i>Menú
                            </a>
                        <li style="color:#000;">SEDUJAP</li>
                    </ul>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li>
                            <a href='includes/logout.php'><i class="material-icons" style="color: #f00">close</i><span style="color: #fff;">Salir</span></a>
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
                        <p class="infoUser"><span><?php echo $_SESSION['usuarioLogin']; ?></span></p>
                        <p class="infoUser"><span class="name" style="margin-top: 0px !important;"><?php echo $_SESSION['nombres']; ?></span></p>
                        <p class="infoUser"><span class="email"><?php echo $_SESSION['email']; ?></span></p>
                    </div>
                </li>
            </ul>

            <div>
                <ul>
                    <li>
                        <div class="collapsible-header" onclick="inicio()">
                            <i class="material-icons">home</i>Inicio
                        </div>
                    </li>

                    <li>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">description</i>Formulario</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li onclick="listaItems()"><a>Lista de Ítems</a></li>
                                        <li onclick="agregarItem()"><a>Agregar Ítem</a></li>
                                        <li onclick="eliminarItem()"><a>Eliminar Ítem</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <div class="collapsible-header" onclick="resultados()">
                            <i class="material-icons">done_all</i>Resultados
                        </div>
                    </li>

                    <?php

                    if($_SESSION['tipo'] == 'administrador'){

                        echo '<li>';
                            echo '<ul class="collapsible">';
                                echo '<li>';
                                    echo '<div class="collapsible-header"><i class="material-icons">perm_identity</i>Usuarios</div>';
                                    echo '<div class="collapsible-body">';
                                        echo '<ul>';
                                            echo '<li onclick="listaUsuarios()"><a>Lista de Usuarios</a></li>';
                                            echo '<li onclick="agregarUsuario()"><a>Agregar Usuario</a></li>';
                                            echo '<li onclick="editarUsuario()"><a>Editar Usuario</a></li>';
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</li>';
                            echo '</ul>';
                        echo '</li>';

                    }
                    ?>

                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col s12 m12 l12">
                <div class="container form">

                    <div class="card">

                        <div class="card-action center-align">
                            <p>Eliminar Ítem</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col s2 m2 l2"></div>

                                <div class="col s8 m8 l8">
                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="row">
                                            <div class="col s4 m4 l4">
                                                <label>Elija un formulario:</label>
                                                <div class="form-field">

                                                    <select class="browser-default left" name="tipo" id="tipo" onchange="cambiar()">

                                                        <?php

                                                        if(isset($_GET['id'])){

                                                            $id = $_GET['id'];

                                                            if($id == "1"){

                                                                echo '<option value="1" selected>Ítems para alumnos</option>';
                                                                echo '<option value="2">Ítems para coordinadores</option>';

                                                            }else if($id == "2"){

                                                                echo '<option value="1">Ítems para alumnos</option>';
                                                                echo '<option value="2" selected>Ítems para coordinadores</option>';

                                                            }

                                                        }else{

                                                            echo '<option value="0" disabled selected hidden>Seleccione</option>';
                                                            echo '<option value="1">Ítems para alumnos</option>';
                                                            echo '<option value="2">Ítems para coordinadores</option>';

                                                        }

                                                        ?>

                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col s8 m8 l8">
                                                <div class="form-field">
                                                    <label for="titulo">Elija un ítem</label>
                                                    <select class="browser-default" name="titulos" id="titulos" onchange="modificar()">
                                                        <option value="" disabled selected hidden>Elija un ítem</option>
                                                        <?php

                                                        while($valores = mysqli_fetch_array($consulta)){
                                                            echo '<option value="'.$valores['id'].'">'.utf8_encode($valores['titulo']).'</option>';
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-field">
                                                <label for="topico">Ítem</label>
                                                <input type="text" name="topico" id="topico" placeholder="Tópico" required readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-field center-align">
                                                <a class="waves-effect waves-light btn modal-trigger" href="#eliminar" onclick="modal()">Eliminar</a>
                                                <a class="waves-effect waves-light btn" href="Inicio.php">Volver</a>

                                                <div id="eliminar" class="modal">
                                                    <div class="modal-content">
                                                        <h4><i class="material-icons" style="color: #000;">warning</i> ¡Atención! <i class="material-icons" style="color: #000;">warning</i></h4>
                                                        <br>
                                                        <p>¿Seguro que desea eliminar el ítem "<span id="itemModal"></span>" al formulario de "<span id="tipoModal"></span>"?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="submit" class="modal-close waves-effect waves-light btn-flat" value="Aceptar" name="eliminar">
                                                    </div>
                                                </div>
                                            </div>
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
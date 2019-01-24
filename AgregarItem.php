<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

if(isset($_POST['tipo']) && isset($_POST['item'])){

$tipo = $_POST['tipo'];
$item = $_POST['item'];

if($tipo == 1){

    $insert = $conexion->query("INSERT INTO topicos (`titulo`) VALUES ('$item')");

}elseif($tipo == 2){

    $insert = $conexion->query("INSERT INTO topicoscoor (`titulo`) VALUES ('$item')");

}

$filas = mysqli_affected_rows($conexion);

if($filas > 0){

    echo '<script>';
    echo 'alert("Ítem agregado de manera exitosa.")';
    echo '</script>';

}else{
    echo "NO";
}

}

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Agregar Ítem</title>

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

            function modal(){
                var item = document.getElementById('item').value;
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
                            <p>Agregar Ítem</p>
                        </div>

                        <div class="card-content">

                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">

                                <div class="row">

                                    <div class="col s1 m1 l1"></div>

                                    <div class="col s4 m4 l4">
                                        <label>Elija un formulario:</label>
                                        <div class="form-field">

                                            <select class="browser-default left" name="tipo" id="tipo">

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

                                    <div class="col s6 m6 l6">
                                        <label>Ítem a agregar:</label>
                                        <input type="text" id="item" name="item" placeholder="Ítem" required>
                                    </div>

                                    <div class="col s1 m1 l1"></div>


                                </div>

                                <div class="row">

                                    <div class="col s12 m12 l12">

                                        <div class="form-field center-align">

                                            <a class="waves-effect waves-light btn modal-trigger" href="#agregar" onclick="modal()">Agregar</a>
                                            <a class="waves-effect waves-light btn" href="Inicio.php">Volver</a>

                                            <div id="agregar" class="modal">
                                                <div class="modal-content">
                                                    <h4><i class="material-icons" style="color: #000;">warning</i> ¡Atención! <i class="material-icons" style="color: #000;">warning</i></h4>
                                                    <br>
                                                    <p>¿Seguro que desea agregar el ítem "<span id="itemModal"></span>" al formulario de "<span id="tipoModal"></span>"?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="modal-close waves-effect waves-light btn-flat" value="Aceptar" name="aceptar">
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>
            </div>
        </div>

    </body>
</html>
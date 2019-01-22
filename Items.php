<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Ítems</title>

        <link rel="stylesheet" href="css/usuarios.css">

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
                location.href="Items.php"
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

            function cambiar(){
                var id = document.getElementById('tipo').value;
                if(id == 1){
                    location.href="Items.php?id=1";
                }else if(id == 2){
                    location.href="Items.php?id=2";
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
                        <p class="infoUser"><span>Usuario</span></p>
                        <p class="infoUser"><span class="name" style="margin-top: 0px !important;">Nombre y apellido</span></p>
                        <p class="infoUser"><span class="email">Correo</span></p>
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

                    <li>
                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">perm_identity</i>Usuarios</div>
                                <div class="collapsible-body">
                                    <ul>
                                        <li onclick="listaUsuarios()"><a>Lista de Usuarios</a></li>
                                        <li onclick="agregarUsuario()"><a>Agregar Usuario</a></li>
                                        <li onclick="editarUsuario()"><a>Editar Usuario</a></li>
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
                            <p>Lista de Ítems</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col s6 m6 l6">
                                    <p class="right">Seleccione alguna de las opciones:</p>
                                </div>

                                <div class="col s6 m6 l6">
                                    <div class="form-field">

                                        <select class="browser-default left" name="tipo" id="tipo" onchange="cambiar()">

                                            <?php

                                            if(isset($_GET['id'])){

                                                $id = $_GET['id'];

                                                if($id == "1"){

                                                    $sql = $conexion->query("SELECT * FROM topicos");

                                                    echo '<option value="1" selected>Ítems para alumnos</option>';
                                                    echo '<option value="2">Ítems para coordinadores</option>';

                                                }else if($id == "2"){

                                                    $sql = $conexion->query("SELECT * FROM topicoscoor");

                                                    echo '<option value="1">Ítems para alumnos</option>';
                                                    echo '<option value="2" selected>Ítems para coordinadores</option>';

                                                }

                                            }else{

                                                echo '<option value="" disabled selected hidden>Seleccione</option>';
                                                echo '<option value="1">Ítems para alumnos</option>';
                                                echo '<option value="2">Ítems para coordinadores</option>';

                                            }

                                            ?>

                                        </select>

                                    </div>
                                </div>


                            </div>

                            <?php

                            if(isset($_GET['id'])){

                                echo '<div class="row">';

                                echo '<div class="col s12 m12 l12">';

                                echo '<div class="container form1">';

                                echo '<table class="striped centered responsive-table">';
                                echo '<tbody>';
                                echo '<tr>';
                                echo '<th>#</th>';
                                echo '<th>Ítem</th>';
                                echo '</tr>';

                                $cont = 1;

                                while($valores = mysqli_fetch_array($sql)){

                                    echo '<tr>';
                                    echo '<td>'.$cont.'</td>';
                                    echo '<td>'.utf8_encode($valores['titulo']).'</td>';
                                    echo '<tr>';

                                    $cont++;

                                }

                                echo '</tbody>';
                                echo '</table>';

                                echo '</div>';

                                echo '</div>';

                                echo '</div>';

                            }

                            ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
<?php

session_start();
ob_start();

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Inicio</title>

        <link rel="stylesheet" href="css/inicio.css">

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

        <div class="container">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title">Bienvenido al Sistema de Evaluación Docente de la Universidad José Antonio Páez (SEDUJAP) <?php //echo $_SESSION['usuarioLogin'] = $user; ?></span>
                            <br>
                            <p class="instrucciones">

                                El sistema le permite a los usuarios de tipo <u>Coordinador</u> visualizar resultados de evaluaciones al docente realizadas tanto por alumnos como por directores de escuela. También permite agregar ítems al formulario de evaluación para los alumnos.

                                <br><br>

                                Para los usuarios de tipo <u>Administrador</u> el sistema permite agregar nuevos usuarios y editar datos de usuarios existentes, también agregar ítems tanto a cada uno de los formularios, tanto el de la evaluación que realizan alumnos como la evaluación que realizan los coordinadores, así como eliminar ítems de estos formularios. De igual manera permite ver los resultados de las evaliuaciones.

                                <br><br>

                                <span style="font-family: 'Quicksand', sans-serif; font-size: 16px;">Instrucciones:</span>

                                <br><br>

                                Para ingresar al menú presione el botón "Menú", ubicado en la esquina superior izquierda.

                                <br>

                                Seleccione la opción que desea en la lista desplegable que se muestra en el menú, donde cada opción muestra cada una de las funciones disponibles según el tipo de usuario.

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
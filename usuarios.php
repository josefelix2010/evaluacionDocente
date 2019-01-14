<?php

session_start();
ob_start();

include('includes/conectar.php');

/*if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{*/


$sql = $conexion->query("SELECT * FROM usuarios");

if(isset($_POST['agregar'])){
    header('location:agregarUser.php');
}

if(isset($_POST['modificar'])){
    header('location:editarUser.php');
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
        <title>Usuarios</title>

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
                    window.location.href="Usuarios.php?id=1";
                }else if(id == 2){
                    window.location.href="Usuarios.php?id=2";
                }else if(id == 3){
                    window.location.href="Usuarios.php?id=3";
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
                            <p>Lista de usuarios</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col s3 m3 l3"></div>

                                <div class="col s6 m6 l6">

                                    <label>Elija el tipo de usuario a consultar:</label>

                                    <div class="form-field">

                                        <select class="browser-default left" name="tipo" id="tipo" onchange="cambiar()">

                                            <?php

                                            if(isset($_GET['id'])){

                                                $id = $_GET['id'];

                                                if($id == "1"){

                                                    $sql = $conexion->query("SELECT * FROM usuarios");

                                                    echo '<option value="1" selected>Todos</option>';
                                                    echo '<option value="2">Administradores</option>';
                                                    echo '<option value="3">Coordinadores</option>';

                                                }elseif($id == "2"){

                                                    $sql = $conexion->query("SELECT * FROM usuarios WHERE administrador = 1");

                                                    echo '<option value="1">Todos</option>';
                                                    echo '<option value="2" selected>Administradores</option>';
                                                    echo '<option value="3">Coordinadores</option>';

                                                }elseif($id == "3"){

                                                    $sql = $conexion->query("SELECT * FROM usuarios WHERE administrador = 0");

                                                    echo '<option value="1">Todos</option>';
                                                    echo '<option value="2">Administradores</option>';
                                                    echo '<option value="3" selected>Coordinadores</option>';

                                                }

                                            }else{

                                                echo '<option value="" disabled selected hidden>Seleccione</option>';
                                                echo '<option value="1">Todos</option>';
                                                echo '<option value="2">Administradores</option>';
                                                echo '<option value="3">Coordinadores</option>';

                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>

                                <div class="col s3 m3 l3"></div>

                            </div>

                            <div class="row">

                                <div class="col 12 m12 l12">

                                    <table class="striped centered responsive-table">
                                        <thead>
                                            <tr class="hightlight">
                                                <th>Usuario</th>
                                                <th>Nombre</th>
                                                <th>Chaparro</th>
                                                <th>Correo Electrónico</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php

                                            while($valores = mysqli_fetch_array($sql)){

                                                echo '<tr>';
                                                echo '<td>'.$valores['usuario'].'</td>';
                                                echo '<td>'.$valores['nombre'].'</td>';
                                                echo '<td>'.$valores['apellido'].'</td>';
                                                echo '<td>'.$valores['correo'].'</td>';
                                                echo '<tr>';

                                            }

                                            ?>
                                        </tbody>
                                    </table>

                                    <br>

                                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                                        <div class="form-field">

                                            <div class="form-field center-align">
                                                <a class="waves-effect waves-light btn" href="Inicio.php">Volver</a>
                                            </div>

                                        </div>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
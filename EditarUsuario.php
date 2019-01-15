<?php

session_start();
ob_start();

include('includes/conectar.php');

/*if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{*/

$consulta = $conexion->query("SELECT * FROM usuarios");

//}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Modificar usuario</title>

        <link rel="stylesheet" href="css/editarUser.css">

        <link rel="stylesheet" type="text/css" href="css/base.css" />

        <link rel="stylesheet" type="text/css" href="libs/materialize/css/materialize.min.css" />

        <link rel="stylesheet" type="text/css" href="libs/material-design-icons-master/iconfont/material-icons.css" />

        <script src="libs/jquery-3.3.1.min.js"></script>

        <script src="libs/materialize/js/materialize.min.js"></script>

        <script src="js/dist/jquery.validate.js"></script>

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
                var id = document.getElementById('usuario').value;
                window.location.href="EditarUsuario.php?id="+id;
            }

            function modal(){
                var usuario = document.getElementById('user').value;
                var nombre = document.getElementById('nombre').value;
                var apellido = document.getElementById('apellido').value;
                var correo = document.getElementById('correo').value;
                var admin = document.getElementById('admin').checked;
                var pass = document.getElementById('password').value;

                if(usuario!="" && nombre!="" && apellido!="" && correo!="" && pass!=""){

                    var nombres = nombre+" "+apellido;

                    document.getElementById('usuarioModal').textContent = usuario;
                    document.getElementById('nombresModal').textContent = nombres;
                    document.getElementById('correoModal').textContent = correo;

                    if(admin == true){
                        document.getElementById('tipoModal').textContent = "Administrador";
                    }else{
                        document.getElementById('tipoModal').textContent = "Coordinador";
                    }

                    $('.modal').modal()
                }else{
                    alert('Uno o mas campos están vacíos.');
                }
            }

            $(function() {
                $('#aceptar').on('click', function(e){
                    e.preventDefault();

                    var nombre = $('#nombre').val();
                    var apellido = $('#apellido').val();
                    var usuario = $('#user').val();
                    var correo = $('#correo').val();
                    var password = $('#password').val();
                    var admin = $('#admin').is(':checked');

                    if(admin == true){
                        tipo = "1";
                    }else{
                        tipo = "0";
                    }

                    $.ajax({
                        type: "POST",
                        url: "includes/modificarUsuario.php",
                        data: ("nombre="+nombre+"&apellido="+apellido+"&usuario="+usuario+"&correo="+correo+"&password="+password+"&tipo="+tipo),
                        success: function(respuesta){
                            if(respuesta==1){
                                alert("Usuario modificado con éxito.");
                                window.location.href="EditarUsuario.php";
                            }else if(respuesta==0){
                                alert("El usuario no se ha podido modificar.");
                                $('#usuario').attr("readonly", false);
                            }else if(respuesta==2){
                                alert("No validado");
                            }
                        }
                    })
                })
            })
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
                            <p>Modificar usuario</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <form method="POST" action="" id="editarUsurio">

                                    <div class="row">

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="usuario">Elija un usuario</label>
                                                <div class="input-field">
                                                    <select class="browser-default" name="usuario" id="usuario" onchange="cambiar()">
                                                        <option value="" disabled selected hidden>Elija un usuario</option>

                                                        <?php

                                                        while($resultados = mysqli_fetch_array($consulta)){
                                                            echo '<option value="'.utf8_encode($resultados['id']).'">'.utf8_encode($resultados['usuario']).'</option>';;
                                                        }

                                                        ?>

                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                        <?php

                                        if(isset($_GET['id'])){

                                            $id = $_GET['id'];

                                            $sql = $conexion->query("SELECT * FROM usuarios WHERE id = '$id'");

                                            while($valores = mysqli_fetch_array($sql)){

                                        ?>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="user">Usuario</label>
                                                <input type="text" name="user" id="user" value="<?php echo utf8_encode($valores['usuario']); ?>" readonly>
                                            </div>

                                        </div>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="password">Contraseña</label>
                                                <input type="password" name="password" id="password" value="<?php echo utf8_encode($valores['password']); ?>" required>
                                            </div>

                                        </div>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="admin">Tipo de usuario</label>
                                                <p  style="margin-top: 20px !important;">
                                                    <label>

                                                        <?php

                                                if($valores['administrador'] == 1){
                                                    echo '<input type="checkbox" checked="checked" class="filled-in" name="admin" id ="admin">';
                                                }else{
                                                    echo '<input type="checkbox" class="filled-in" name="admin" id ="admin">';
                                                }

                                                        ?>
                                                        <span>Usuario administrador</span>
                                                    </label>
                                                </p>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" value="<?php echo utf8_encode($valores['nombre']); ?>" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" value="<?php echo utf8_encode($valores['apellido']); ?>" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="correo">Correo electrónico</label>
                                                <input id="correo" name="correo" type="email" class="validate" value="<?php echo utf8_encode($valores['correo']); ?>" required>
                                                <span class="helper-text" data-error="Formato incorrecto de correo" data-success="Formato correcto"></span>
                                            </div>

                                        </div>

                                        <?php

                                            }

                                        }

                                        ?>

                                    </div>

                                    <div class="form-field center-align">
                                        <a class="waves-effect waves-light btn modal-trigger" href="#agregar" onclick="modal()">Modificar</a>
                                        <a class="waves-effect waves-light btn" href="Inicio.php">Volver</a>

                                        <div id="agregar" class="modal">
                                            <div class="modal-content">
                                                <h4><i class="material-icons" style="color: #000;">warning</i> ¡Atención! <i class="material-icons" style="color: #000;">warning</i></h4>
                                                <br>

                                                <p>¿Seguro que desea modificar los datos del siguiente usuario?</p>

                                                <br>

                                                <p>Usuario: <span id="usuarioModal"></span> <br>
                                                    Nombres: <span id="nombresModal"></span> <br>
                                                    Correo: <span id="correoModal"></span> <br>
                                                    Tipo de usuario <span id="tipoModal"></span>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="modal-close waves-effect waves-light btn-flat" value="Aceptar" name="aceptar" id="aceptar">
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
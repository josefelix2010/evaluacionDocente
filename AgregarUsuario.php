<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}

if($_SESSION['tipo'] != 'administrador'){
    header('location: inicio.php');
}

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Agregar usuario</title>

        <link rel="stylesheet" type="text/css" href="css/agregarUser.css" />

        <link rel="stylesheet" type="text/css" href="css/base.css" />

        <link rel="stylesheet" type="text/css" href="libs/materialize/css/materialize.min.css" />

        <link rel="stylesheet" type="text/css" href="libs/material-design-icons-master/iconfont/material-icons.css" />

        <script src="libs/jquery-3.3.1.min.js"></script>

        <script src="libs/materialize/js/materialize.min.js"></script>

        <script src="js/dist/jquery.validate.js"></script>

        <script src="js/validar-form.js"></script>

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
                var usuario = document.getElementById('usuario').value;
                var nombre = document.getElementById('nombre').value;
                var apellido = document.getElementById('apellido').value;
                var correo = document.getElementById('correo').value;
                var admin = document.getElementById('admin').checked;
                var pass1 = document.getElementById('password1').value;
                var pass2 = document.getElementById('password2').value;

                if(usuario!="" && nombre!="" && apellido!="" && correo!="" && pass1!="" && pass2!=""){

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

            function letras(string) {
                var out = '';
                var filtro = 'abcdefghijklmnñopqrstuvwxyzABCDEFGHIJKLMNÑOSPQRSTUVWXYZ';

                for(var i=0; i<string.length; i++){
                    if(filtro.indexOf(string.charAt(i)) != -1){
                        out += string.charAt(i);
                    }
                }

                return out;
            }

            function vaciar(){
                document.getElementById('nombre').value = "";
                document.getElementById('apellido').value = "";
                document.getElementById('usuario').value = "";
                document.getElementById('correo').value = "";
                document.getElementById('password1').value = "";
                document.getElementById('password2').value = "";
            }


            $(function(){
                $('#aceptar').on('click', function(e){
                    e.preventDefault();

                    var nombre = $('#nombre').val();
                    var apellido = $('#apellido').val();
                    var usuario = $('#usuario').val();
                    var correo = $('#correo').val();
                    var password = $('#password1').val();
                    var admin = $('#admin').is(':checked');

                    if(admin == true){
                        tipo = "1";
                    }else{
                        tipo = "0";
                    }

                    $.ajax({
                        type: "POST",
                        url: "includes/verificarUsuario.php",
                        data: ("nombre="+nombre+"&apellido="+apellido+"&usuario="+usuario+"&correo="+correo+"&password="+password+"&tipo="+tipo),
                        success: function(respuesta){
                            if(respuesta==1){
                                alert("Usuario agregado con éxito.");
                                window.location.reload();
                            }else if(respuesta==0){
                                alert("El usuario ya existe, por favor modifique el usuario.");
                                $('#usuario').attr("readonly", false);
                            }else if(respuesta==2){
                                alert("No validado");
                            }
                        }
                    });
                });
            });
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
                            <p>Agregar usuario</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <form method="POST" action="" id="agregarUsuario">

                                    <div class="row">

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="nombre">Nombre</label>
                                                <input type="text" name="nombre" id="nombre" placeholder="Nombre" required onkeyup="this.value=letras(this.value)">
                                            </div>

                                        </div>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="apellido">Apellido</label>
                                                <input type="text" name="apellido" id="apellido" placeholder="Apellido" required onkeyup="this.value=letras(this.value)" value="HOLIS">
                                            </div>

                                        </div>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="usuario">Usuario</label>
                                                <input type="text" name="usuario" id="usuario" placeholder="Usuario" required readonly>
                                            </div>

                                        </div>

                                        <div class="col s3 m3 l3">

                                            <div class="form-field">
                                                <label for="correo">Correo electrónico</label>
                                                <input id="correo" type="email" class="validate" placeholder="correo@electronico.com" name="correo" required>
                                                <span class="helper-text" data-error="Error" data-success="Correcto"></span>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="password1">Contraseña</label>
                                                <input type="password" name="password1" id="password1" placeholder="Contraseña" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="password2">Valide su contraseña</label>
                                                <input type="password" name="password2" id="password2" placeholder="Valide su contraseña" required>
                                            </div>

                                        </div>

                                        <div class="col s4 m4 l4">

                                            <div class="form-field">
                                                <label for="admin">Tipo de usuario</label>
                                                <p  style="margin-top: 20px !important;">
                                                    <label>
                                                        <input type="checkbox" checked="checked" class="filled-in" name="admin" id ="admin">
                                                        <span>Usuario administrador</span>
                                                    </label>
                                                </p>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="form-field center-align">
                                        <a class="waves-effect waves-light btn modal-trigger" href="#agregar" onclick="modal()">Agregar</a>
                                        <a class="waves-effect waves-light btn" href="" onclick="vaciar()">Borrar Campos</a>
                                        <a class="waves-effect waves-light btn" href="Inicio.php">Volver</a>

                                        <div id="agregar" class="modal">
                                            <div class="modal-content">
                                                <h4><i class="material-icons" style="color: #000;">warning</i> ¡Atención! <i class="material-icons" style="color: #000;">warning</i></h4>
                                                <br>

                                                <p>¿Seguro que desea agregar al siguiente usuario en el sistema?</p>

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
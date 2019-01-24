<?php

session_start();
ob_start();

include('includes/conectar.php');

if($_SESSION['sesionAbierta'] != 'Activa'){
    header('location: index.php');
}else{

$consultaPeriodo = $conexion->query("SELECT periodo FROM respuestas GROUP BY periodo ORDER BY periodo ASC");
$cont = 1;

}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Resultados</title>

        <link rel="stylesheet" type="text/css" href="css/resultados.css">

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
                $('.tabs').tabs();
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

            function buscarActa(){
                var id = document.getElementById('periodos');
                var periodo = id.options[id.selectedIndex].text;
                var acta = document.getElementById('acta').value;
                window.location.href="resultados.php?periodo="+periodo+"&acta="+acta+"";
            }


            $(document).ready(function(){

                $('#tipo').change(function(){
                    $('#tipo option:selected').each(function() {
                        var id_tipo = $(this).val();
                        $('#tipoTxt').val(id_tipo);

                        $.ajax({
                            type: "POST",
                            url: "includes/consultaTipo.php",
                            data: ("id_tipo="+id_tipo),
                            success: function(resultado){
                                $('#periodos').html(resultado);
                            }
                        })
                    });
                });

                $('#periodos').change(function(){
                    $('#periodos option:selected').each(function() {
                        var id_periodo = $(this).val();
                        var tipo = $('#tipoTxt').val();
                        $('#periodoTxt').val(id_periodo);

                        $.ajax({
                            type: "POST",
                            url: "includes/consultaPeriodo.php",
                            data: ("id_periodo="+id_periodo+"&tipo="+tipo),
                            success: function(resultado){
                                $('#docente').html(resultado);
                            }
                        })
                    });
                });

                $('#docente').change(function(){
                    $('#docente option:selected').each(function() {
                        var id_docente = $(this).val();
                        var periodo = $('#periodoTxt').val();
                        var tipo = $('#tipoTxt').val();
                        $('#docenteTxt').val(id_docente);

                        $.ajax({
                            type: "POST",
                            url: "includes/consultaDocente.php",
                            data: ("id_docente="+id_docente+"&periodo="+periodo+"&tipo="+tipo),
                            success: function(resultado){
                                $('#filtrar').attr('disabled', false);
                                $('#actas').html(resultado);
                            }
                        })
                    });
                });

                $('#actas').change(function(){
                    $('#actas option:selected').each(function(){
                        var id_actas = $(this).val();
                        $('#actasTxt').val(id_actas);
                    })
                })

                $('#filtrar').on('click', function(e){
                    e.preventDefault();

                    var tipo = $('#tipoTxt').val();
                    var periodo = $('#periodoTxt').val();
                    var docente = $('#docenteTxt').val();
                    var acta = $('#actasTxt').val();

                    $('#imprimir').attr("disabled", false);

                    $.ajax({
                        type: "POST",
                        url: "includes/filtro.php",
                        data: ("tipo="+tipo+"&periodo="+periodo+"&docente="+docente+"&acta="+acta),
                        success: function(respuesta){
                            $('#tabla').html(respuesta);
                        }
                    })

                })

                $('#imprimir').on('click', function(e){
                    e.preventDefault();

                    var tipo = $('#tipoTxt').val();
                    var periodo = $('#periodoTxt').val();
                    var docente = $('#docenteTxt').val();
                    var acta = $('#actasTxt').val();

                    window.open('Imprimir.php?tipo='+tipo+'&periodo='+periodo+'&docente='+docente+'&acta='+acta);
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
                <div class="form">
                    <div class="card">

                        <div class="card-action center-align">
                            <p>Resultados</p>
                        </div>

                        <div class="card-content">

                            <div class="row">

                                <div class="col s1 m1 l1"></div>

                                <div class="col s10 m10 l10">
                                    <div class="row">

                                        <form method="POST" id="form-filtros" name="form-filtros">
                                            <div class="form-field">

                                                <div class="col s10 m10 l10">

                                                    <div class="row">

                                                        <div class="col s3 m3 l3">
                                                            <label>Seleccione el tipo evaluación:</label>
                                                            <select class="browser-default" name="tipo" id="tipo" >

                                                                <option value="0" selected hidden>Seleccione</option>

                                                                <option value="1">Evaluación de coordinadores</option>

                                                                <option value="2">Evaluación de alumnos</option>

                                                            </select>
                                                            <input type="text" name="tipoTxt" id="tipoTxt" hidden>
                                                        </div>

                                                        <div class="col s3 m3 l3">
                                                            <label>Seleccione un período lectivo:</label>
                                                            <select class="browser-default" name="periodos" id="periodos" >

                                                                <option value="0" selected hidden>Seleccione</option>

                                                            </select>
                                                            <input type="text" name="periodoTxt" id="periodoTxt" hidden>
                                                        </div>

                                                        <div class="col s3 m3 l3">
                                                            <label>Seleccione un docente:</label>
                                                            <select class="browser-default" name="docente" id="docente" >

                                                                <option value="0" selected hidden>Seleccione</option>

                                                            </select>
                                                            <input type="text" name="docenteTxt" id="docenteTxt" hidden>
                                                        </div>

                                                        <div class="col s3 m3 l3">
                                                            <label>Seleccione una de las actas:</label>
                                                            <select class="browser-default" name="actas" id="actas" id="actasTxt">

                                                                <option value="0" selected hidden>Seleccione</option>

                                                            </select>
                                                            <input type="text" name="actasTxt" id="actasTxt" value="0" hidden>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col s2 m2 l2">
                                                    <div class="form-field center-align">
                                                        <input class="btn" type="submit" name="filtrar" value="Filtrar" id="filtrar" disabled>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>


                                    <div class="row">
                                        <div class="col s12 m12 l12" id="tabla">

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col s12 m12 l12">

                                            <div class="form-field center-align">

                                                <input class="btn" type="submit" name="imprimir" id="imprimir" value="Imprimir" disabled onclick="imprimir()">

                                                <input class="btn" type="submit" name="volver" id="volver" value="Volver" onclick="volver()">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col s1 m1 l1"></div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
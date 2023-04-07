<!DOCTYPE html>
<?php 
include ("../controller/conexion.php");
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />

    <!-- Meta -->
    <meta name="author" content="Jessica Soto">

    <title>JLM|Agregar Usuario</title>

    <!--  css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
    <!-- js -->
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="../controller/js/catalogos.js"></script>


    <!-- Bracket CSS -->

    <!-- <link rel="stylesheet" href="../template/css/card.css"> -->

</head>
<style>
.swal-wide {
    width: 500px !important;
    font-size: 16px !important;
}

.a-alert {
    outline: none;
    text-decoration: none;
    padding: 2px 1px 0;
}

.a-alert:link {
    color: white;
}

.a-alert:visited {
    color: white;
}
</style>

<body class="collapsed-menu">
    <?php
  include('header.php');
?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="../administrador/usuarios.php">Usuarios</a>
                <span class="breadcrumb-item active">Alta de Usuarios</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">ALTA DE USUARIO</h4>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form id="personal-ext" method="POST">
                    <div class="row mg-b-25">
                        <div class="form-layout form-layout-1">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label label2">Nombre(s): <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                            name="usunom" id="usunom" placeholder="Ingresar Nombre's">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label label2">Apellidos: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                            name="usuapell" id="usuapell" placeholder="Ingresa los Apellidos">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label label2">Correo Electronico: </label>
                                        <input class="form-control inputalta" type="text" name="correo" id="correo"
                                            placeholder="ingresa@hotmail.com">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label label2">Usuario: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                            name="usuario" id="usuario" placeholder="Ingresa Usuario">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label label2">Contraseña: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control inputalta" type="password" name="password"
                                            id="password" placeholder="Ingresa Contraseña">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-6-force">
                                        <label class="form-control-label label2">Privilegios: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2 inputalta" id="privilegios"
                                            name="privilegios" data-placeholder="Eliga una opción">
                                            <option label="Choose country"></option>
                                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="button" class="btn btn-info"
                                    style="background-color:#1774D8; font-size: 14px;"
                                    onclick="addPerson()">ACEPTAR</button>
                                <button class="btn btn-secondary" onclick="closeaddusu()">CANCELAR</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                    </div><!-- row -->
                </form>
                <br>
                <div style="display:none;" id="dubli" name="dubli" class="alert alert-warning" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="vacios" name="vacios" class="alert alert-info" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="err" name="err" class="alert alert-danger" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-close alert-icon tx-24"></i>
                        <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte tecnico o levantar
                            un ticket</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
            </div>
        </div><!-- br-pagebody -->
        <footer class="br-footer">
            <div class="footer-left">
                <div class="mg-b-2">Copyright &copy; 2022. Derechos reservados a JLM.</div>
                <div>Jose Luis Mondragon y CIA.</div>
            </div>
            <div class="footer-right d-flex align-items-center">
                <a target="_blank" class="pd-x-5" href="http://www.facebook.com/JLMPAPELERA"><i
                        class="fa fa-facebook tx-20"></i></a>
                <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i class="fa fa-globe tx-20"></i></a>
            </div>
        </footer>
    </div><!-- br-mainpanel -->

    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../template/lib/jquery/jquery.js"></script>
    <script src="../template/lib/popper.js/popper.js"></script>
    <script src="../template/lib/bootstrap/bootstrap.js"></script>
    <script src="../template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../template/lib/moment/moment.js"></script>
    <script src="../template/lib/jquery-ui/jquery-ui.js"></script>
    <script src="../template/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../template/lib/peity/jquery.peity.js"></script>
    <script src="../template/lib/highlightjs/highlight.pack.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../template/js/bracket.js"></script>
    <script>
    //FUNCION PARA AGREGAR UN USUARIO NUEVO
    function addPerson() {
        //alert("entra");
        var usunom = document.getElementById('usunom').value;
        var usuapell = document.getElementById('usuapell').value;
        var correo = document.getElementById('correo').value;
        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;
        var privilegios = document.getElementById('privilegios').value;

        var datos = 'usunom=' + usunom + '&usuapell=' + usuapell + '&correo=' + correo + '&usuario=' + usuario +
            '&password=' + password + '&privilegios=' + privilegios + '&opcion=registrar';
        //var datos =$('#personal-ext').serialize();
        //alert(datos);
        if (document.getElementById('usunom').value == '' || document.getElementById('usuapell').value == '' ||
            document.getElementById('usuario').value == '' || document.getElementById('password').value == '' ||
            document.getElementById('privilegios').value == '') {
            document.getElementById('vacios').style.display = ''
            setTimeout(function() {
                document.getElementById('vacios').style.display = 'none';
            }, 2000);
            return;
        } else {
            $.ajax({
                type: "POST",
                url: "../controller/insertusu.php",
                data: datos
            }).done(function(respuesta) {
                if (respuesta == 0) {
                    correoResponsable = document.getElementById('correo').value;
                    if (correoResponsable == '') {
                        Swal.fire({
                            type: 'success',
                            title: 'JLM INFORMA',
                            text: 'SUS DATOS FUERON GUARDADOS CORRECTAMENTE',
                            showCloseButton: false,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonColor: "#1774D8",
                            customClass: 'swal-wide',
                            confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newacces">¿Deseas agregar otro registro?</a></span>',
                            confirmButtonAriaLabel: 'Thumbs up, great!',
                            cancelButtonText: '<a  class="a-alert" href="usuarios.php"><span style="color: white;">Cerrar</span></a>',
                            cancelButtonAriaLabel: 'Thumbs down'
                            // timer: 2900
                        });
                    } else {
                        $.ajax({
                            url: '../admin/enviarMailResp.php',
                            type: 'POST',
                            data: 'correoResponsable=' + correoResponsable
                        }).done(function(html) {
                            Swal.fire({
                                type: 'success',
                                title: 'JLM INFORMA',
                                text: 'SUS DATOS FUERON GUARDADOS CORRECTAMENTE',
                                showCloseButton: false,
                                showCancelButton: true,
                                focusConfirm: false,
                                confirmButtonColor: "#1774D8",
                                customClass: 'swal-wide',
                                confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newacces">¿Deseas agregar otro registro?</a></span>',
                                confirmButtonAriaLabel: 'Thumbs up, great!',
                                cancelButtonText: '<a  class="a-alert" href="usuarios.php"><span style="color: white;">Cerrar</span></a>',
                                cancelButtonAriaLabel: 'Thumbs down'
                                // timer: 2900
                            });
                        });
                    }
                } else if (respuesta == 2) {
                    document.getElementById('dubli').style.display = ''
                    setTimeout(function() {
                        document.getElementById('dubli').style.display = 'none';
                    }, 1000);
                    //alert("datos repetidos");
                } else {
                    document.getElementById('err').style.display = ''
                    setTimeout(function() {
                        document.getElementById('err').style.display = 'none';
                    }, 1000);
                }
            });

        }
    }
    //FIN DE LA FUNCIÓN
    $(function() {
        'use strict'

        $('.form-layout .form-control').on('focusin', function() {
            $(this).closest('.form-group').addClass('form-group-active');
        });

        $('.form-layout .form-control').on('focusout', function() {
            $(this).closest('.form-group').removeClass('form-group-active');
        });

        // Select2
        $('#select2-a, #select2-b').select2({
            minimumResultsForSearch: Infinity
        });

        $('#select2-a').on('select2:opening', function(e) {
            $(this).closest('.form-group').addClass('form-group-active');
        });

        $('#select2-a').on('select2:closing', function(e) {
            $(this).closest('.form-group').removeClass('form-group-active');
        });

    });
    </script>
</body>

</html>
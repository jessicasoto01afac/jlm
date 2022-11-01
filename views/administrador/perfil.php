<!DOCTYPE html>
<?php include ("../controller/conexion.php");


?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <title>JOSE LUIS MONDRAGON Y COMPAÑIA, S.A. DE C.V.</title>

    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="../template/lib/chartist/chartist.css" rel="stylesheet">
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
</head>
<style>
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
</style>
<body class="collapsed-menu">
    <?php

    include('header.php');
    ?>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="inicio.php">Dashboard</a>
                <span class="breadcrumb-item active">Perfil</span>
            </nav>
        </div>
        <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Perfil</h4>
        </div><!-- d-flex -->

        <div class="br-pagebody mg-t-5 pd-x-30">
        <input type="text" class="form-control d-none" id="id_usu" name="id_usu"  placeholder="Enter email address" value="<?php echo $datos[0]?>">

            <div class="form-layout form-layout-4 bg-white">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Información personal</h6>
                <div class="row">
                    <label class="col-sm-4 form-control-label">Nombres(s): <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" disabled placeholder="Enter firstname" value="<?php echo $datos[1]?>">
                    </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Apellidos: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" disabled placeholder="Enter lastname" value="<?php echo $datos[2]?>">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Correo: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" disabled placeholder="Enter email address" value="<?php echo $datos[3]?>">
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Privilegios: <span class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" disabled placeholder="Enter email address" value="<?php echo $datos[4]?>">
                    </div>
                </div>
            </div><!-- form-layout -->
            <br>
            <div class="form-layout form-layout-4 bg-white">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Contraseña</h6>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Ingresa nueva contraseña: <span
                            class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" id="idcontra" name="idcontra" onchange="contrase()" placeholder="Ingresa la contraseña">
                    </div>
                    <div class="col-sm-7 mg-t-10 mg-sm-t-0">
                    <label style="float:right" id="non8" name="non8" class="alert-danger d-none" for="">la contraseña dene tener minimo 8 digitos</label>
                    </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Confirmar contraseña: <span
                            class="tx-danger">*</span></label>
                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                        <input type="text" class="form-control" id="confirmaa" name="confirmaa" onchange="conciden()" disabled placeholder="Confirma la contraseña">
                    </div>
                    <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                        <label style="float:right" id="concid" name="concid" class="alert-danger d-none" for="">las contraseñas no coinciden</label>
                    </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                    <button class="col-sm-2 btn btn-primary" id="saveup" name="saveup" onclick="savenewpas()">Actualizar contraseña</button>
                    <br><br>
                    <div class="alert alert-primary alert-dismissible fade show d-none" role="alert">
                        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div style="display:none" id="llenaod" name="llenaod" class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Ingresar todos los campos!</strong> no debe tener ningun campo vacio
                    </div>
                </div><!-- form-layout-footer -->
            </div><!-- form-layout -->
        </div><!-- col-9 -->

        <footer class="br-footer">
            <div class="footer-left">
                <div class="mg-b-2">Copyright &copy; 2022 Derechos reservados a JLM.</div>
                <div>Jose Luis Mondragon y CIA.</div>
            </div>
            <div class="footer-right d-flex align-items-center">
                <span class="tx-uppercase mg-r-10">Siguenos:</span>
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
    <script src="../template/lib/chartist/chartist.js"></script>
    <script src="../template/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="../template/lib/d3/d3.js"></script>
    <script src="../template/lib/rickshaw/rickshaw.min.js"></script>


    <script src="../template/js/bracket.js"></script>
    <script src="../template/js/ResizeSensor.js"></script>
    <script src="../template/js/dashboard.js"></script>
    <script src="../controller/js/profile.js"></script>
    <script>
    $(function() {
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function() {
            minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
            if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)')
                .matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if (window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass(
                    'collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
        }
    });
    </script>
</body>

</html>
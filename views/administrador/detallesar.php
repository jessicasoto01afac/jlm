<!DOCTYPE html>
<?php include ("../controller/conexion.php");
      $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);

      $sql1 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $extendido = mysqli_query($conexion,$sql1);

      $sql2 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $etiquetas = mysqli_query($conexion,$sql2);

      $sql3 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo2 = mysqli_query($conexion,$sql3);

      $sql4 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo3 = mysqli_query($conexion,$sql4);
?>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <title>JLM|INVENTARIO</title>
    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../template/lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
</head>

<body class="collapsed-menu">

    <?php

include('header.php');
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h3 class="tx-gray-800 mg-b-5">INVENTARIO</h3>
        </div>
        <div class="col-sm-2 col-lg-12">
            <div class="row row-sm mg-t-20">
                <div class="row row-sm mg-t-20">
                    <div class="col-lg-6">
                        <div class="card shadow-base card-body pd-25 bd-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="card-title tx-uppercase tx-12">Estadistica de las salidas</h6>
                                    <p class="display-4 tx-medium tx-inverse mg-b-5 tx-lato">25%</p>
                                    <div class="progress mg-b-10">
                                        <div class="progress-bar bg-primary progress-bar-xs wd-30p" role="progressbar"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                    <p class="tx-12">Nulla consequat massa quis enim. Donec pede justo, fringilla vel...
                                    </p>
                                    <p class="tx-11 lh-3 mg-b-0">You can also use other progress variant found in <a
                                            href="progress.html" target="blank">progress section</a>.</p>
                                </div><!-- col-6 -->
                                <div
                                    class="col-sm-6 mg-t-20 mg-sm-t-0 d-flex align-items-center justify-content-center">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 60, "radius": 90 }'>30/100</span>
                                </div><!-- col-6 -->
                            </div><!-- row -->
                        </div><!-- card -->
                    </div><!-- col-6 -->
                    <div class="col-lg-6 mg-t-30 mg-lg-t-0">
                        <div class="card shadow-base card-body pd-25 bd-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="card-title tx-uppercase tx-12 tx-inverse">Estadisticas de las entradas</h6>
                                    <p class="display-4 tx-medium tx-inverse mg-b-5 tx-lato">45%</p>
                                    <div class="progress mg-b-10">
                                        <div class="progress-bar bg-info progress-bar-xs wd-45p" role="progressbar"
                                            aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div><!-- progress -->
                                    <p class="tx-12">Nulla consequat massa quis enim. Donec pede justo, fringilla vel...
                                    </p>
                                    <p class="tx-11 lh-3 mg-b-0">You can also use other progress variant found in <a
                                            href="progress.html" class="tx-info" target="blank">progress section</a>.
                                    </p>
                                </div><!-- col-6 -->
                                <div class="col-sm-6 mg-t-20 mg-sm-t-0 d-flex align-items-end justify-content-center">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 60, "radius": 90 }'>30/100</span>
                                </div><!-- col-6 -->
                            </div><!-- row -->
                        </div><!-- card -->
                    </div><!-- col-6 -->
                </div><!-- row -->
                <div class="col-sm-5 col-lg-11 mg-t-20 mg-sm-t-5">
                </div><!-- col-4 -->
            </div><!-- row -->
            <br>
            <div style="float: right;">
                <div class="col-lg-0 mg-t-20 mg-lg-t-0">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="inventario.php" title="Actualizar" class="btn btn-primary btn-icon">
                            <div><i class="icon ion-refresh tx-18"></i></div>
                        </a>
                    </div>
                </div><!-- col-5 -->
            </div>
            <div class="br-section-wrapper">
                <!-- <div id="listartic"> -->
                <br>
                <div class="rounded table-responsive">
                    <table class="table display dataTable" name="inventario" id="inventario" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:5%;">ID</th>
                                <th>CODIGO</th>
                                <th style="width:400px;">DESCRIPCIÓN</th>
                                <th>UNIDAD</th>
                                <th>STOCK MINIMO</th>
                                <th>STOCK MAXIMO</th>
                                <th>STOCK INICIAL</th>
                                <th>EXISTENCIAS</th>
                                <th>SOLICITAR</th>
                                <th>COSTO</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div><!-- br-section-wrapper -->
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
    <script src="../template/lib/datatables/jquery.dataTables.js"></script>
    <script src="../template/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../controller/js/catalogos.js"></script>
    <script src="../template/js/bracket.js"></script>

    <script src="../controller/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../controller/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../controller/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script src="../template/js/ResizeSensor.js"></script>
    <script src="../template/js/widgets.js"></script>
    <script src="../template/lib/d3/d3.js"></script>








    <script src="../template/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>

    <script src="../template/lib/rickshaw/rickshaw.min.js"></script>



    <script>
    let date = new Date();
    let output = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0') +
        '/' + date.getFullYear();
    //alert(output);
    document.getElementById('mayor').innerHTML = output;
    document.getElementById('menor').innerHTML = output;
    document.getElementById('entradas').innerHTML = output;
    </script>

    <?php include('../administrador/modal.php');?>
    <script type="text/javascript">
    // TABLA INSPECTORES EXTERNOS//
    let table = $('#inventario').DataTable({

        "language": {
            "searchPlaceholder": "Buscar datos...",
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        },
        "order": [
            [4, "DESC"]
        ],
        "ajax": "../controller/php/infinventario.php",
        "columnDefs": [{
            //  "targets": -1,
            // "data": null,
            //"defaultContent": ""

        }]
    });
    </script>
    <script>
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
    });

    $(function() {
        'use strict';


        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1199px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function() {
            minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
            if (window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1199px)')
                .matches) {
                // show only the icons and hide left menu label by default
                $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                $('body').addClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideUp();
            } else if (window.matchMedia('(min-width: 1200px)').matches && !$('body').hasClass(
                    'collapsed-menu')) {
                $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                $('body').removeClass('collapsed-menu');
                $('.show-sub + .br-menu-sub').slideDown();
            }
        }

        $('#datatable1').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

        $('#datatable2').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({
            minimumResultsForSearch: Infinity
        });

    });

    $(function() {

    });
    </script>
</body>

</html>
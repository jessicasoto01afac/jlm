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
    <section class="content" id="inventarios">
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h3 class="tx-gray-800 mg-b-5">INVENTARIO</h3>
            </div>
            <div class="col-sm-2 col-lg-12">
                <div class="br-pagebody">
                    <div class="row row-sm mg-t-20">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card shadow-base bd-0">
                                <div
                                    class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">ARTICULO CON MAYOR MOVIMIENTO</h6>
                                    <span id="mayor" name="mayor" class="tx-12 tx-uppercase"></span>
                                </div><!-- card-header -->
                                <div class="card-body d-xs-flex justify-content-between align-items-center">
                                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold">5,322,425</h4>
                                    <p class="mg-b-0 tx-sm"><span class="tx-success"><i class="fa fa-arrow-up"></i>
                                            34.32%</span> Codigo:</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col-4 -->
                        <div class="col-sm-6 col-lg-4 mg-t-20 mg-sm-t-0">
                            <div class="card shadow-base bd-0">
                                <div
                                    class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">ARTICULO CON MAYOR ENTRADAS</h6>
                                    <span id="entradas" name="entradas" class="tx-12 tx-uppercase"></span>
                                </div><!-- card-header -->
                                <div class="card-body d-xs-flex justify-content-between align-items-center">
                                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold">23,554</h4>
                                    <p class="mg-b-0 tx-sm"><span class="tx-success"><i class="fa fa-arrow-up"></i>
                                            16.34%</span> Codigo:</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col-4 -->
                        <div class="col-sm-6 col-lg-4 mg-t-20 mg-lg-t-0">
                            <div class="card shadow-base bd-0">
                                <div
                                    class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">ARTICULO CON MENOR MOVIMIENTOS</h6>
                                    <span id="menor" name="menor" class="tx-12 tx-uppercase"></span>
                                </div><!-- card-header -->
                                <div class="card-body d-xs-flex justify-content-between align-items-center">
                                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold">3,006,983</h4>
                                    <p class="mg-b-0 tx-sm"><span class="tx-danger"><i class="fa fa-arrow-down"></i>
                                            0.92%</span> Codigo:</p>
                                </div><!-- card-body -->
                            </div><!-- card -->
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
                        <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i
                                class="fa fa-globe tx-20"></i></a>
                    </div>
                </footer>
            </div><!-- br-mainpanel -->
            <!-- ########## END: MAIN PANEL ########## -->
    </section>
    <!-- ########## END: MAIN PANEL ########## -->
    <!------------------------------- ########## DETALLES DEL VALE ########## -------------------------->
    <section class="content" id="datalles" style="display: none;">
    
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/inventario.php">Inventario</a>
                    <span class="breadcrumb-item active">Detalles del articulo</span>
                </nav>
            </div><!-- br-pageheader -->
            <div style="float: right;">
                    <div class="col-lg-0 mg-t-20 mg-lg-t-0">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a onclick="actualizar()" title="Actualizar" class="btn btn-primary btn-icon">
                                <div><i class="icon ion-refresh tx-18 tx-white"></i></div>
                            </a>
                        </div>
                    </div><!-- col-5 -->
                </div>

            <input style="display: none;" id="idartic" name="idartic" type="text">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 id="noartdell" name="noartdell" class="tx-gray-800 mg-b-5"></h4>
            </div>
            <div class="col-sm-4 col-lg-12">
                <div class="row row-sm mg-t-20">
                    <div class="col-sm-6 col-lg-5">
                        <div class="bg-white rounded shadow-base overflow-hidden">
                            <div class="pd-x-20 pd-t-20 d-flex align-items-center">
                                <i class="ion ion-monitor tx-80 lh-0 tx-primary op-5"></i>
                                <div class="mg-l-20">
                                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase mg-b-10">Existencia</p>
                                    <p id="existe" name="existe" class="tx-32 tx-inverse tx-lato tx-black mg-b-0 lh-1">
                                    </p>
                                    <span class="tx-18 tx-arial tx-gray-800">Stock inicial:</span>
                                    <span id="stockini" name="stockini"
                                        class="tx-20 tx-roboto  tx-bold tx-gray-650"></span>

                                </div>
                            </div>
                            <div id="ch5" class="ht-60 tr-y-10">
                            <svg width="524" height="60"><g><path d="M0,30Q37.84444444444444,25.75,43.666666666666664,26.25C52.39999999999999,27,78.6,37.125,87.33333333333333,37.5S122.26666666666667,31.5,131,30S165.93333333333334,22.5,174.66666666666666,22.5S209.60000000000002,27.75,218.33333333333334,30S253.26666666666668,42.75,262,45S296.93333333333334,52.5,305.6666666666667,52.5S340.59999999999997,46.125,349.3333333333333,45S384.26666666666665,42.375,393,41.25S427.93333333333334,33.375,436.6666666666667,33.75S471.59999999999997,45.375,480.3333333333333,45Q486.1555555555555,44.75,524,30L524,60Q486.1555555555555,60,480.3333333333333,60C471.59999999999997,60,445.40000000000003,60,436.6666666666667,60S401.73333333333335,60,393,60S358.06666666666666,60,349.3333333333333,60S314.40000000000003,60,305.6666666666667,60S270.73333333333335,60,262,60S227.06666666666666,60,218.33333333333334,60S183.39999999999998,60,174.66666666666666,60S139.73333333333332,60,131,60S96.06666666666666,60,87.33333333333333,60S52.39999999999999,60,43.666666666666664,60Q37.84444444444444,60,0,60Z" class="area" fill="#0866C6"></path></g></svg>
                            </div>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-sm-4 col-lg-7">
                        <div class="card shadow-base bd-0">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                <h6 class="card-title tx-uppercase tx-12 mg-b-0">ESTADISTICAS GENERALES</h6>
                                <span id="id_cod" name="id_cod" class="tx-12 tx-uppercase"></span>
                            </div><!-- card-header -->
                            <div class="card-body">
                                <br>
                                <div class="row align-items-center">
                                    <div id="entradas2" name="entradas2" class="col-3 tx-16">ENTRADAS:</div><!-- col-3 -->
                                    <div class="col-9">
                                        <div class="progress rounded-4 mg-b-0">
                                            <div id="porentradas" name="porentradas" class="progress-bar bg-indigo  wd-50p lh-3" role="progressbar"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div><!-- progress -->
                                    </div><!-- col-9 -->
                                </div><!-- row -->
                                <div class="row align-items-center mg-t-5">
                                    <div id="salidas2" name="salidas2" class="col-3 tx-16">SALIDAS:</div><!-- col-3 -->
                                    <div class="col-9">
                                        <div class="progress rounded-4 mg-b-0">
                                            <div id="porsalidas" name="porsalidas" class="progress-bar bg-blue wd-90p lh-3" role="progressbar"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div><!-- progress -->
                                    </div><!-- col-9 -->
                                    <br>
                                    <br>

                                </div><!-- row -->
                            </div><!-- card-body -->
                        </div><!-- card -->
                    </div>
                </div><!-- col-4 -->
                <br>

                <div class="br-section-wrapper">
                    <!-- <div id="listartic"> -->
                    <br>
                    <div class="">
                        <div id="datakardex" name="datakardex" ></div>
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
                    <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i
                            class="fa fa-globe tx-20"></i></a>
                </div>
            </footer>
        </div><!-- br-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->


    </section>

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
    <script src="../controller/js/inventario.js"></script>
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
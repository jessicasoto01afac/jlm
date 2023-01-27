<!DOCTYPE html>
<?php include ("../controller/conexion.php");

$sen = "SELECT count(*) as result FROM (SELECT tipo FROM kardex k, articulos a where a.artcodigo=k.codigo_1 AND k.estado='0' AND k.tipo ='PEDIDO' AND a.artubicac='ALMACEN' GROUP BY k.refe_1) AS Total";
$resultado = mysqli_query($conexion,$sen);
$pedidos = mysqli_fetch_assoc($resultado); 

$ped = "SELECT count(*) as result FROM (SELECT tipo FROM kardex k, articulos a where a.artcodigo=k.codigo_1 AND k.estado='0' AND k.tipo ='PEDIDO' AND a.artubicac='ALMACEN' AND k.status_2='PENDIENTE' GROUP BY k.refe_1) AS Total";
$resulpe = mysqli_query($conexion,$ped);
$pedtotal = mysqli_fetch_assoc($resulpe); 

$val = "SELECT count(*) as result FROM (select * from kardex where proveedor_cliente='ALMACEN' AND tipo='VALE_PRODUCCION' GROUP BY refe_1) AS Total";
$resvale = mysqli_query($conexion,$val);
$vales = mysqli_fetch_assoc($resvale);

$valpen = "SELECT count(*) as result FROM (select * from kardex where proveedor_cliente='ALMACEN' AND tipo='VALE_PRODUCCION' GROUP BY refe_1 AND status_2='PENDIENTE') AS Total";
$valepen = mysqli_query($conexion,$valpen);
$valepd = mysqli_fetch_assoc($valepen);



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

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
</head>

<body>
    <?php

    include('header.php');
    ?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel br-profile-page">
        <div class="card shadow-base bd-0 rounded-0 widget-4">
            <div class="card-header ht-75">
                <div class="hidden-xs-down">
                    <a href="" class="mg-r-10"><span class="tx-medium">498</span>Vales de producción</a>
                    <a href=""><span class="tx-medium">498</span>Pedidos</a>
                </div>
                <div class="tx-24 hidden-xs-down">
                    <a href="" class="mg-r-10"><i class="icon ion-ios-email-outline"></i></a>
                    <a href=""><i class="icon ion-more"></i></a>
                </div>
            </div><!-- card-header -->
            <div class="card-body">
                <div class="card-profile-img">
                    <img src="http://via.placeholder.com/280x280" alt="">
                </div><!-- card-profile-img -->
                <h4 class="tx-normal tx-roboto tx-white"><?php echo $datos[1].' '.$datos[2]?></h4>
                <p class="mg-b-25 tx-white">ALMACEN</p>
                <!-- <p class="mg-b-0 tx-24">
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-facebook-official"></i></a>
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-twitter"></i></a>
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-pinterest"></i></a>
                    <a href="" class="tx-white-8"><i class="fa fa-instagram"></i></a>
                </p> -->
            </div><!-- card-body -->
        </div><!-- card -->
        <div class="tab-content br-profile-body">
            <div class="card shadow-base bd-0 mg-t-20">
                <div
                    class="card-header bg-transparent pd-x-25 pd-y-15 bd-b-0 d-flex justify-content-between align-items-center">
                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">ESTADISTICAS DE ALMACEN</h6>
                    <a href="" class="tx-gray-500 hover-info lh-0"><i
                            class="icon ion-android-more-horizontal tx-24 lh-0"></i></a>
                </div><!-- card-header -->
                <div class="card-body bg-white pd-x-25 pd-b-25 pd-t-0">
                    <div class="row no-gutters bg-white">
                        <div class="col-sm-6 col-lg-3 bg-white">
                            <div class="card card-body bg-white rounded-0">
                                <h6 class="tx-inverse tx-14 mg-b-5">PEDIDOS</h6>
                                <div class="tx-center mg-y-20">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#17A2B8", "#E9ECEF"],  "innerRadius": 50, "radius": 80 }'><?php echo $pedidos['result']-$pedtotal['result'] ?>/<?php echo $pedidos['result']?></span>
                                </div>
                                <p class="tx-10 tx-uppercase tx-medium mg-b-0 tx-spacing-1">Total de pedidos 2022</p>
                                <h2 class="tx-inverse tx-bold tx-lato">
                                    <span><?php echo $pedidos['result']?></span>
                                </h2>
                                <div class="d-flex justify-content-between tx-12">
                                    <div>
                                        <span class="square-10 bg-info mg-r-5"></span> <?php echo $pedidos['result']-$pedtotal['result'] ?>
                                        surtidos
                                        <h5 class="mg-b-0 mg-t-5 tx-bold tx-inverse tx-lato">
                                            <?php echo number_format(($pedidos['result']-$pedtotal['result']) * 100 / $pedidos['result'],2)?>%
                                        </h5>
                                    </div>
                                    <div>
                                        <span class="square-10 bg-gray-300 mg-r-5"></span>
                                        <?php echo $pedtotal['result']?> pendientes
                                        <h5 class="mg-b-0 mg-t-5 tx-bold tx-inverse tx-lato">
                                            <?php echo number_format($pedtotal['result'] * 100 / $pedidos['result'],2)?>%
                                        </h5>
                                    </div>
                                </div><!-- d-flex -->
                            </div><!-- card -->
                        </div><!-- col-3 -->
                        <div class="col-sm-6 col-lg-3 mg-t--1 mg-sm-t-0 mg-lg-l--1">
                            <div class="card card-body rounded-0 bg-white bd-lg-l-0">
                                <h6 class="tx-inverse tx-14 mg-b-5">VALES DE PRODUCCIÓN</h6>
                                <div class="tx-center mg-y-20">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#6F42C1", "#E9ECEF"],  "innerRadius": 50, "radius": 80 }'><?php echo $vales['result'] - $valepd['result'] ?>/<?php echo $vales['result']?></span>
                                </div>
                                <p class="tx-10 tx-uppercase tx-medium mg-b-0 tx-spacing-1">TOTAL DE VALES 2022</p>
                                <h2 class="tx-inverse tx-bold tx-lato">
                                    <span><?php echo $vales['result']?></span>
                                </h2>
                                <div class="d-flex justify-content-between tx-12">
                                    <div>
                                        <span class="square-10 bg-purple mg-r-5"></span><?php echo $vales['result'] - $valepd['result'] ?> surtidos
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-lato tx-bold"><?php echo number_format(($vales['result'] - $valepd['result']) * 100 / $vales['result'],2)?>%</h5>
                                    </div>
                                    <div>
                                        <span class="square-10 bg-gray-300 mg-r-5"></span><?php echo $valepd['result']?> pendientes
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-lato tx-bold"><?php echo number_format($valepd['result'] * 100 / $vales['result'],2)?>%</h5>
                                    </div>
                                </div><!-- d-flex -->
                            </div><!-- card -->
                        </div><!-- col-3 -->
                        <div class="col-sm-6 col-lg-3 mg-t--1 mg-lg-t-0 mg-lg-l--1">
                            <div class="card card-body bg-white rounded-0">
                                <h6 class="tx-inverse tx-14 mg-b-5">VALES DE OFICINA</h6>
                                <div class="tx-center mg-y-20">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#20C997", "#E9ECEF"],  "innerRadius": 50, "radius": 80 }'>60/100</span>
                                </div>
                                <p class="tx-10 tx-uppercase tx-medium mg-b-0 tx-spacing-1">TOTAL DE VALES 2022</p>
                                <h2 class="tx-inverse tx-bold tx-lato">
                                    <span>1.95TB</span>
                                </h2>
                                <div class="d-flex justify-content-between tx-12">
                                    <div>
                                        <span class="square-10 bg-teal mg-r-5"></span> 404 GB used
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-bold tx-lato">21%</h5>
                                    </div>
                                    <div>
                                        <span class="square-10 bg-gray-300 mg-r-5"></span> 1.59 GB free
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-bold tx-lato">79%</h5>
                                    </div>
                                </div><!-- d-flex -->
                            </div><!-- card -->
                        </div><!-- col-3 -->
                        <div class="col-sm-6 col-lg-3 mg-t--1 mg-lg-t-0 mg-lg-l--1">
                            <div class="card card-body bg-white rounded-0">
                                <h6 class="tx-inverse tx-14 mg-b-5">RECLAMOS</h6>
                                <div class="tx-center mg-y-20">
                                    <span class="peity-donut"
                                        data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 50, "radius": 80 }'>75/100</span>
                                </div>
                                <p class="tx-10 tx-uppercase tx-medium mg-b-0 tx-spacing-1">Storage Size</p>
                                <h2 class="tx-inverse tx-bold tx-lato">
                                    <span>1.95TB</span>
                                </h2>
                                <div class="d-flex justify-content-between tx-12">
                                    <div>
                                        <span class="square-10 bg-primary mg-r-5"></span> 404 GB used
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-bold tx-lato">21%</h5>
                                    </div>
                                    <div>
                                        <span class="square-10 bg-gray-300 mg-r-5"></span> 1.59 GB free
                                        <h5 class="mg-b-0 mg-t-5 tx-inverse tx-bold tx-lato">79%</h5>
                                    </div>
                                </div><!-- d-flex -->
                            </div><!-- card -->
                        </div><!-- col-3 -->
                    </div><!-- row -->
                </div><!-- card-body -->
            </div><!-- card -->

        </div><!-- br-pagebody -->



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
    <script src="../template/lib/jquery-toggles/toggles.min.js"></script>
    <script src="../template/lib/jt.timepicker/jquery.timepicker.js"></script>
    <script src="../template/lib/spectrum/spectrum.js"></script>
    <script src="../template/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    <script src="../template/lib/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="../template/lib/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


    <script src="../template/js/bracket.js"></script>
    <script src="../template/js/ResizeSensor.js"></script>
    <script src="../template/js/dashboard.js"></script>
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
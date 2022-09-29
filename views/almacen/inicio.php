<!DOCTYPE html>
<?php include ("../controller/conexion.php");

$sen = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1) AS Total";
$resultado = mysqli_query($conexion,$sen);
$pedidos = mysqli_fetch_assoc($resultado); 

$ped = "SELECT count(*) as result FROM (SELECT tipo FROM kardex k, articulos a where k.estado='0' AND k.tipo ='PEDIDO' AND status='PENDIENTE' AND a.artcodigo=k.codigo_1 AND a.artubicac='ALMACEN' GROUP BY k.refe_1) AS Total";
$resulpe = mysqli_query($conexion,$ped);
$pedtotal = mysqli_fetch_assoc($resulpe); 

$pedfin = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='PEDIDO' AND status='FINALIZADO' GROUP BY refe_1) AS Total";
$resulpefin = mysqli_query($conexion,$pedfin);
$pedfinali = mysqli_fetch_assoc($resulpefin); 


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
                <h4 class="tx-normal tx-roboto tx-white">Katherine M. Pechon</h4>
                <p class="mg-b-25">Wine Connoisseur</p>

                <p class="wd-md-500 mg-md-l-auto mg-md-r-auto mg-b-25">Singer, Lawyer, Achiever, Wearer of unrelated
                    hats, Data Visualizer, Mayonaise Tester. I don't know what alt-tab does. Storyteller.</p>

                <p class="mg-b-0 tx-24">
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-facebook-official"></i></a>
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-twitter"></i></a>
                    <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-pinterest"></i></a>
                    <a href="" class="tx-white-8"><i class="fa fa-instagram"></i></a>
                </p>
            </div><!-- card-body -->
        </div><!-- card -->
        <div class="tab-content br-profile-body">
            <div class="tab-pane fade active show" id="posts">
                <div class="row row-sm mg-t-20">
                    <div class="col-lg-6">
                        <div class="card bg-white shadow-base card-body pd-25 bd-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="bg-white card-title tx-uppercase tx-12">PEDIDOS PENDIENTES</h6>
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
                                        data-peity='{ "fill": ["#0866C6", "#E9ECEF"],  "innerRadius": 60, "radius": 90 }'><?php echo $pedtotal['result']?>/100</span>
                                </div><!-- col-6 -->
                            </div><!-- row -->
                        </div><!-- card -->
                    </div><!-- col-6 -->
                    <div class="col-lg-6 mg-t-30 mg-lg-t-0">
                        <div class="card bg-white shadow-base card-body pd-25 bd-0">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6 class="bg-white card-title tx-uppercase tx-12 tx-inverse">VALES PENDIENTES</h6>
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
                                    <span class="peity-bar"
                                        data-peity='{ "fill": ["#17A2B8","#6F42C1","#20C997","#0866C6"], "height": 150, "width": 250 }'>8,6,5,9,8,4,9,3,5,9</span>
                                </div><!-- col-6 -->
                            </div><!-- row -->
                        </div><!-- card -->
                    </div><!-- col-6 -->
                </div><!-- row -->
            </div><!-- tab-pane -->
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
    <script src="../template/lib/chartist/chartist.js"></script>
    <script src="../template/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="../template/lib/d3/d3.js"></script>
    <script src="../template/lib/rickshaw/rickshaw.min.js"></script>


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
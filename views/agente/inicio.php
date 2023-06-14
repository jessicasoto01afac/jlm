<!DOCTYPE html>
<?php include ("../controller/conexion.php");

$sen = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1) AS Total";
$resultado = mysqli_query($conexion,$sen);
$pedidos = mysqli_fetch_assoc($resultado); 

$ped = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1) AS Total";
$resulpe = mysqli_query($conexion,$ped);
$pedtotal = mysqli_fetch_assoc($resulpe); 

$pedfin = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='PEDIDO' AND status='FINALIZADO' GROUP BY refe_1) AS Total";
$resulpefin = mysqli_query($conexion,$pedfin);
$pedfinali = mysqli_fetch_assoc($resulpefin); 

$bureclam = "SELECT count(*) as result FROM (SELECT folio_recl FROM reclamoclient where estado='0' GROUP BY folio_recl) AS Total";
$resulrecli = mysqli_query($conexion,$bureclam);
$reclamo = mysqli_fetch_assoc($resulrecli); 

$busproduc = "SELECT CONCAT(ROUND(((SELECT count(*) as cantidad FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='VALE_PRODUCCION' AND status='FINALIZADO' GROUP BY refe_1)AS Cantidad ) / (SELECT count(*) as result FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='VALE_PRODUCCION' GROUP BY refe_1) AS Total) * 100), 2), '%') AS porcentaje";
$resulprod = mysqli_query($conexion,$busproduc);
$product = mysqli_fetch_assoc($resulprod);

$busped = "SELECT CONCAT(ROUND(((SELECT count(*) as cantidad FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='PEDIDO' AND status='FINALIZADO' GROUP BY refe_1)AS Cantidad ) / (SELECT count(*) as result FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='PEDIDO' GROUP BY refe_1) AS Total) * 100), 2), '%') AS porcentaje";
$resulped = mysqli_query($conexion,$busped);
$porpedid = mysqli_fetch_assoc($resulped);

$busped2 = "SELECT CONCAT(ROUND(((SELECT count(*) as cantidad FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='PEDIDO' AND status='FINALIZADO' GROUP BY refe_1)AS Cantidad ) / (SELECT count(*) as result FROM (SELECT id_kax FROM kardex where estado='0' AND tipo='PEDIDO' GROUP BY refe_1) AS Total) * 100), 2)) AS porcentaje";
$resulped2 = mysqli_query($conexion,$busped2);
$porpedid2 = mysqli_fetch_assoc($resulped2);


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

<body class="collapsed-menu with-subleft">
    <?php

    include('header.php');
    ?>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel br-profile-page">
        <div class="card shadow-base bd-0 rounded-0 widget-4 bg-dark ">
            <div class="card-header ht-75 ">
                <div class="hidden-xs-down">
                    <a href="" class="mg-r-10"><span class="tx-medium">498</span> Followers</a>
                    <a href=""><span class="tx-medium">498</span> Following</a>
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
                <p class="mg-b-25">AGENTE DE VENTAS</p>
            </div><!-- card-body -->
        </div><!-- card -->
        <!-- <div class="pd-30">
            <h4 class="tx-gray-800 mg-b-5">Dashboard</h4>
        </div> -->
        <!-- d-flex -->
        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="card bd-0 shadow-base pd-30 mg-t-20">
                <div class="d-flex align-items-center justify-content-between mg-b-30">
                    <div>
                        <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">CLIENTES CON MAYOR DEMANDA
                        </h6>
                        <p class="mg-b-0"><i class="icon ion-calendar mg-r-5"></i>Enero 2022 - Diciembre 2022</p>
                    </div>
                    <a href="../administrador/listpedido.php"
                        class="btn btn-outline-info btn-oblong tx-11 tx-uppercase tx-mont tx-medium tx-spacing-1 pd-x-30 bd-2">Agregar Prepedido</a>
                </div><!-- d-flex -->

                <table class="table table-valign-middle mg-b-0">
                    <tbody>
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">Deborah Miner</h6>
                                <span class="tx-12">@deborah.miner</span>
                            </td>
                            <td>Nov 01, 2017</td>
                            <td><span id="sparkline1">1,4,4,7,5,9,4,7,5,9,1</span></td>
                            <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i
                                        class="icon ion-more tx-18 lh-0"></i></a></td>
                        </tr>
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">Belinda Connor</h6>
                                <span class="tx-12">@belinda.connor</span>
                            </td>
                            <td>Oct 28, 2017</td>
                            <td><span id="sparkline2">1,3,6,4,5,8,4,2,4,5,0</span></td>
                            <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i
                                        class="icon ion-more tx-18 lh-0"></i></a></td>
                        </tr>
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">Andrew Wiggins</h6>
                                <span class="tx-12">@andrew.wiggins</span>
                            </td>
                            <td>Oct 27, 2017</td>
                            <td><span id="sparkline3">1,2,4,2,3,6,4,2,4,3,0</span></td>
                            <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i
                                        class="icon ion-more tx-18 lh-0"></i></a></td>
                        </tr>
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">Brandon Lawrence</h6>
                                <span class="tx-12">@brandon.lawrence</span>
                            </td>
                            <td>Oct 27, 2017</td>
                            <td><span id="sparkline4">1,4,4,7,5,9,4,7,5,9,1</span></td>
                            <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i
                                        class="icon ion-more tx-18 lh-0"></i></a></td>
                        </tr>
                        <tr>
                            <td class="pd-l-0-force">
                                <img src="http://via.placeholder.com/280x280" class="wd-40 rounded-circle" alt="">
                            </td>
                            <td>
                                <h6 class="tx-inverse tx-14 mg-b-0">Marilyn Tarter</h6>
                                <span class="tx-12">@marilyn.tarter</span>
                            </td>
                            <td>Oct 27, 2017</td>
                            <td><span id="sparkline5">1,3,6,4,5,8,4,2,4,5,0</span></td>
                            <td class="pd-r-0-force tx-center"><a href="" class="tx-gray-600"><i
                                        class="icon ion-more tx-18 lh-0"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- card -->
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
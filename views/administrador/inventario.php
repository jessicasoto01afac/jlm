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
    <title>JLM|Articulos</title>
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
            <div class="br-pagebody">
                <div class="row row-sm mg-t-20">
                    <div class="col-sm-6 col-lg-4">
                        <div class="card shadow-base bd-0">
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
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
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
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
                            <div class="card-header bg-transparent d-flex justify-content-between align-items-center">
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
let output = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0') + '/' + date.getFullYear();
//alert(output);
document.getElementById('mayor').innerHTML=output;
document.getElementById('menor').innerHTML=output;
document.getElementById('entradas').innerHTML=output;


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
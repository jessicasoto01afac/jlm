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

      $sql5 = "SELECT codigo_1, COUNT(codigo_1) as cantidad from kardex group by codigo_1 order by cantidad desc LIMIT 0, 1";
      $datos2 = mysqli_query($conexion,$sql5);
      $movmas = mysqli_fetch_assoc($datos2);

      $sql6 = "SELECT codigo_1, sum(salida) as salida from kardex group by codigo_1 order by salida desc LIMIT 0, 1";
      $datos3 = mysqli_query($conexion,$sql6);
      $salmas = mysqli_fetch_assoc($datos3);
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold"><?php echo $movmas['cantidad']?></h4>
                                    <p class="mg-b-0 tx-sm"> Codigo:<?php echo $movmas['codigo_1']?> <span class="tx-success"><i class="fa fa-arrow-up"></i>
                                            34.32%</span></p>
                                </div><!-- card-body -->
                            </div><!-- card -->
                        </div><!-- col-4 -->
                        <div class="col-sm-6 col-lg-4 mg-t-20 mg-sm-t-0">
                            <div class="card shadow-base bd-0">
                                <div
                                    class="card-header bg-transparent d-flex justify-content-between align-items-center">
                                    <h6 class="card-title tx-uppercase tx-12 mg-b-0">ARTICULO CON MAYOR SALIDAS</h6>
                                    <span id="entradas" name="entradas" class="tx-12 tx-uppercase"></span>
                                </div><!-- card-header salmas-->
                                <div class="card-body d-xs-flex justify-content-between align-items-center">
                                    <h4 class="mg-b-0 tx-inverse tx-lato tx-bold"><?php echo $salmas['salida']?></h4>
                                    <p class="mg-b-0 tx-sm"> Codigo:<?php echo $salmas['codigo_1']?> <span class="tx-success"><i class="fa fa-arrow-up"></i>
                                            34.32%</span></p>
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
                        <div class="table-wrapper rounded table-responsive">
                            <table class="table display dataTable" name="inventario" id="inventario" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:5%;">ID</th>
                                        <th>CODIGO</th>
                                        <th style="width:200px;">DESCRIPCIÓN</th>
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
                        <a onclick="recargarg2()" title="Actualizar" class="btn btn-primary btn-icon">
                            <div><i class="icon ion-refresh tx-18 tx-white"></i></div>
                        </a>
                    </div>
                </div><!-- col-5 -->
            </div>
            <input style="display: none;" id="idartic" name="idartic" type="text">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 id="noartdell" name="noartdell" class="tx-gray-800 mg-b-5"></h4>
            </div>
            <!-- filtro de fechas -->
            <div class="col-sm-4 col-lg-12">
                <div class="d-flex align-items-center justify-content-end bg-gray-100 ht-md-80 bd pd-x-20 mg-t-10">
                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                        
                        <input class="form-control" type="date" id="vpfechaini" name="vpfechaini" value="2022-01-01"
                            placeholder="">

                        <input class="form-control" type="date" id="vpfechafin" name="vpfechafin" value="2022-12-31"
                            placeholder="">
                        <button
                            class="btn btn-primary pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2" onclick="recargarg2()">Validar Filtro</button>
                    </div>
                </div><!-- d-flex -->
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
                                <svg width="524" height="60">
                                    <g>
                                        <path
                                            d="M0,30Q37.84444444444444,25.75,43.666666666666664,26.25C52.39999999999999,27,78.6,37.125,87.33333333333333,37.5S122.26666666666667,31.5,131,30S165.93333333333334,22.5,174.66666666666666,22.5S209.60000000000002,27.75,218.33333333333334,30S253.26666666666668,42.75,262,45S296.93333333333334,52.5,305.6666666666667,52.5S340.59999999999997,46.125,349.3333333333333,45S384.26666666666665,42.375,393,41.25S427.93333333333334,33.375,436.6666666666667,33.75S471.59999999999997,45.375,480.3333333333333,45Q486.1555555555555,44.75,524,30L524,60Q486.1555555555555,60,480.3333333333333,60C471.59999999999997,60,445.40000000000003,60,436.6666666666667,60S401.73333333333335,60,393,60S358.06666666666666,60,349.3333333333333,60S314.40000000000003,60,305.6666666666667,60S270.73333333333335,60,262,60S227.06666666666666,60,218.33333333333334,60S183.39999999999998,60,174.66666666666666,60S139.73333333333332,60,131,60S96.06666666666666,60,87.33333333333333,60S52.39999999999999,60,43.666666666666664,60Q37.84444444444444,60,0,60Z"
                                            class="area" fill="#0866C6"></path>
                                    </g>
                                </svg>
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
                                    <div id="entradas2" name="entradas2" class="col-3 tx-16">ENTRADAS:</div>
                                    <!-- col-3 -->
                                    <div class="col-9">
                                        <div class="progress rounded-4 mg-b-0">
                                            <div id="porentradas" name="porentradas"
                                                class="progress-bar bg-indigo  wd-50p lh-3" role="progressbar"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">0%</div>
                                        </div><!-- progress -->
                                    </div><!-- col-9 -->
                                </div><!-- row -->
                                <div class="row align-items-center mg-t-5">
                                    <div id="salidas2" name="salidas2" class="col-3 tx-16">SALIDAS:</div><!-- col-3 -->
                                    <div class="col-9">
                                        <div class="progress rounded-4 mg-b-0">
                                            <div id="porsalidas" name="porsalidas"
                                                class="progress-bar bg-blue wd-90p lh-3" role="progressbar"
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
                    <div class="table-wrapper rounded table-responsive">
                        <!-- <div id="datakardex" name="datakardex" ></div> -->
                        <table class="display table table-striped table-bordered dataTable" id="datakardex"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CODIGO</th>
                                    <th>FECHA</th>
                                    <th>FOLIO</th>
                                    <th>REFERENCIA_2</th>
                                    <th>TIPO</th>
                                    <th>CLASE</th>
                                    <th>PROVEEDOR/CLIENTE</th>
                                    <th>SALIDA</th>
                                    <th>ENTRADA</th>
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
    <?php include('../administrador/modal.php');?>
    <script type="text/javascript">
    //alert("pruebas");
    cargainv();
    </script>
</body>

</html>
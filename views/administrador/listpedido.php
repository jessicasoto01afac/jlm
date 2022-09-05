<!DOCTYPE html>
<html lang="es">
<?php include ("../../controller/conexion.php");

    
$sql = "SELECT codigo_clie,nombre FROM clientes WHERE estado = 0";
$cliente = mysqli_query($conexion,$sql);

$sql = "SELECT id_per,usunom,usuapell FROM accesos WHERE estado = 0";
$person = mysqli_query($conexion,$sql);


?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Info de pedido</title>

    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">

    <link href="../template/css/diseno.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
    <script src="../controller/js/pedidos.js"></script>
</head>
<style>


</style>

<body class="collapsed-menu">

    <?php

include('header.php');
?>
    <section class="content" id="listaped">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">Pedidos</h4>
            </div>

            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <a class="btn btn-primary" href="newpedido.php" style="float:right"><i
                            class="fa fa-plus mg-r-10"></i>Agregar Pedido</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-wrapper rounded table-responsive">
                        <table class="table display dataTable no-footer" id="pedidosdata" name="pedidosdata"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">#</th>
                                    <th>N. DE PEDIDO</th>
                                    <th>FECHA</th>
                                    <th>EMPRESA</th>
                                    <th>ESTATUS</th>
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
    </section>
    <!-- ########## END: MAIN PANEL ########## -->
    <!------------------------------- ########## DETALLES DEL PEDIDO ########## -------------------------->
    <section class="content" id="dettpedido" style="display: none;">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/listpedido.php">Lista de pedidos</a>
                    <span class="breadcrumb-item active">Info de pedido</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="br-pagebody">
                <div style="float: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="editpediinf()" id="openedipi" title="Dar clic para editar" type="button"
                            class="btn btn-secondary btn btn-secondary"><i class="fa fa-edit"></i></button>
                        <button onclick="closedithpin()" id="closepedi" title="Dar clic para cerrar edición"
                            type="button" style="display:none;" class="btn btn-secondary btn-danger"><i
                                class="fa fa-times"></i></button>
                        <button title="ver historial" onclick="histvalepro()" data-toggle="modal"
                            data-target="#modal-vphistorial" type="button" class="btn btn-primary"><i
                                class="fa fa-history"></i></button>
                    </div>
                </div><!-- col-5 -->
                <div class="br-section-wrapper">
                    <h6 class="">INFORMACIÓN DEL PEDIDO:</h6>
                    <div class="form-group">
                        <div class="row mg-b-25">
                            <div class="col-sm-9">

                            </div>
                            <div class="col-sm-3">
                                <div name="button_estatus" id="button_estatus"></div>
                                <input style="display:none" name="estatus2" id="estatus2" type="text">
                            </div>
                        </div>
                    </div>
                    <form id="info-valofi" method="POST">
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" style="font-size:14px">NUMERO DE PEDIDO: <span
                                                class="tx-danger" style="font-size:14px">*</span></label>
                                        <h3><label for="" id="idinped" readonly name="idinped"
                                                style="color:#14128F"></label>
                                        </h3>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">REMISIÓN DE PEDIDO:
                                            <span class="tx-danger" style="font-size:14px">*</span></label>
                                        <input class="form-control" style="color:#14128F;font-size:18px" readonly=""
                                            type="text" id="remisioninf" name="remisioninf"
                                            placeholder="Ingresar la remisión">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">FECHA DE INGRESO: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly="" type="date" id="infvpdate"
                                            name="infvpdate" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">CLIENTE: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="text" name="infclinte" id="infclinte"
                                            value="" placeholder="Enter address" style="font-size:16px">
                                        <!-- <select disabled class="form-control" name="infclinte" id="infclinte"
                                            style="font-size:16px" data-placeholder="Choose country">
                                            <option label="">Selecciona</option>
                                            <?php while($clie = mysqli_fetch_row($cliente)):?>
                                            <option value="<?php echo $clie[0]?>"><?php echo $clie[1]?></option>
                                            <?php endwhile; ?>

                                        </select> -->
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-4">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force">ANTENDIO:<span
                                                class="tx-danger">*</span></label>
                                        <select disabled class="form-control" name="atendioinf" id="atendioinf"
                                            style="font-size:14px" data-placeholder="Choose country">
                                            <option label="">Selecciona</option>
                                            <?php while($per = mysqli_fetch_row($person)):?>
                                            <option value="<?php echo $per[0]?>"><?php echo $per[1]?>
                                                <?php echo $per[2]?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">AUTORIZA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="text" name="auropedid" id="auropedid"
                                            value="" placeholder="Enter address" style="font-size:16px">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">FECHA DE AUTORIZACIÓN:
                                            <span class="tx-danger">*</span></label>
                                        <input class="form-control" readonly="" type="date" id="feautoped"
                                            name="feautoped" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">FECHA DE SURTIDO: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly="" type="date" id="fesurtped"
                                            name="fesurtped" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">FECHA DE ENTREGA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly="" type="date" id="fecentrega"
                                            name="fecentrega" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                            <div class="form-layout-footer bd pd-20 bd-t-0">
                                <button class="btn btn-info">Finalizar</button>
                                <button id="cancelpe" style="display:none;" class="btn btn-secondary">Cancelar
                                    pedido</button>
                            </div><!-- form-group -->
                        </div><!-- form-layout -->
                    </form>
                    <br>
                    <button type="button" onclick="masarticvo()" data-toggle='modal'
                        style="display:none; background-color: rgb(0, 156, 40);" data-target='#modal-editavo1'
                        onclick="" id="addarticp"
                        class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                            class="fa fa-plus"></i> Agregar Articulo</button>
                    <br>
                    <br>
                    <h6 class="col-md-4 mg-t--1 mg-md-t-0">ARTICULOS</h6>
                    <br>
                    <div class="col-lg-20">
                        <div id="listpedidinf"></div><!-- col-12 -->
                    </div><!-- form-layout -->

                </div><!-- br-pagebody -->
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
    <script src="../controller/js/catalogos.js"></script>
    <script src="../template/js/bracket.js"></script>
    <!-- DataTables -->
    <script src="../controller/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../controller/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../controller/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

    <?php include('modal/mpedido.php');?>
    <script>
    openpedidos();
    </script>


</body>

</html>
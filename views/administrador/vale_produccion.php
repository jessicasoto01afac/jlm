<!DOCTYPE html>
<html lang="es">
<?php 
include ("../controller/conexion.php");
session_start();
      $allvp= "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='VALE_PRODUCCION' GROUP BY refe_1) AS Total";
      $resulall = mysqli_query($conexion,$allvp);
      $allvp = mysqli_fetch_assoc($resulall);

      $pendievp= "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='VALE_PRODUCCION' AND status='PENDIENTE' GROUP BY refe_1) AS Total";
      $resulpedidvp = mysqli_query($conexion,$pendievp);
      $pendientesvp = mysqli_fetch_assoc($resulpedidvp);

      $buspedfinvp = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='VALE_PRODUCCION' AND status='FINALIZADO' GROUP BY refe_1) AS Total";
      $resulfinvp = mysqli_query($conexion,$buspedfinvp);
      $finalizadosvp = mysqli_fetch_assoc($resulfinvp);

      $buspedsurtvp = "SELECT count(*) as result FROM (SELECT tipo FROM kardex where estado='0' AND tipo ='VALE_PRODUCCION' AND status='SURTIDO' GROUP BY refe_1) AS Total";
      $resulsurvp = mysqli_query($conexion,$buspedsurtvp);
      $surtidosvp = mysqli_fetch_assoc($resulsurvp);
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Vale_produccion</title>

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
    <script src="../controller/js/vale_produc.js"></script>

</head>

<body class="collapsed-menu">


    <?php

include('header.php');
?>
    <!------------------------------- ########## LISTA DE VALES ########## -------------------------->
    <style>

    </style>
    <section class="content" id="lista">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">VALES DE PRODUCCIÓN</h4>
            </div>

            <div class="br-pagebody">
                <div
                    class="d-flex align-items-center justify-content-start pd-x-20 pd-sm-x-2 pd-t-6 mg-b-20 mg-sm-b-30">
                    <div class="btn-group mg-l-auto hidden-sm-down">
                        <a href="#" class="btn btn-outline-primary active">Todos <span><span class="pd-l-6 pd-r-6 pd-t-2 pd-b-2 square-12 bg-info mg-r-12 rounded-circle text-white center"><?php echo $allvp['result']?></span></span></a>
                        <a href="#" class="btn btn-outline-primary">Pendiente <span class="pd-l-6 pd-r-6 pd-t-2 pd-b-2 square-12 bg-info mg-r-12 rounded-circle text-white center"><?php echo $pendientesvp['result']?></span></a>
                        <a href="#" class="btn btn-outline-primary">Surtidos <span class="pd-l-6 pd-r-6 pd-t-2 pd-b-2 square-12 bg-info mg-r-12 rounded-circle text-white center"><?php echo $surtidosvp['result']?></span></a>
                        <a href="#" class="btn btn-outline-primary">Finalizados <span class="pd-l-6 pd-r-6 pd-t-2 pd-b-2 square-12 bg-info mg-r-12 rounded-circle text-white center"><?php echo $finalizadosvp['result']?></span></a>
                        <a href="#" class="btn btn-outline-primary">Enviados</a>
                    </div><!-- btn-group -->

                    <!-- START: DISPLAYED FOR MOBILE ONLY -->
                    <div class="dropdown mg-l-auto hidden-md-up">
                        <a href="#" class="btn btn-outline-secondary" data-toggle="dropdown">All<i
                                class="fa fa-angle-down mg-l-5"></i></a>
                        <div class="dropdown-menu dropdown-menu-right pd-10">
                            <nav class="nav nav-style-1 flex-column">
                                <a href="" class="nav-link">Todos <span><?php echo $allvp['result']?></span></a>
                                <a href="" class="nav-link">Pendiente<span> <?php echo $pendientes['result']?></span></a>
                                <a href="" class="nav-link">Surtidos <span><?php echo $surtidosvp['result']?></span></a>
                                <a href="" class="nav-link">Finalizados <span><?php echo $finalizadosvp['result']?></span></a>
                                <a href="" class="nav-link">Enviados</a>
                            </nav>
                        </div><!-- dropdown-menu -->
                    </div><!-- dropdown -->
                </div>
                <div class="br-section-wrapper">
                    <a class="btn btn-primary text-white" onclick="foliovp()" style="float:right; cursor:pointer"><i
                            class="fa fa-list-alt mg-r-10"></i>Agregar vale de producción</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-wrapper rounded table-responsive">
                        <table class="table display dataTable no-footer" id="example" name="example" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">ID</th>
                                    <th>FOLIO</th>
                                    <th>FECHA</th>
                                    <th>DEPARTAMENTO</th>
                                    <th>PEDIDO</th>
                                    <th>FOLIO JLM</th>
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
    <!------------------------------- ########## DETALLES DEL VALE ########## -------------------------->
    <section class="content" id="detaproduccion" style="display: none;">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/vale_produccion.php">Lista de
                        vale_producción</a>
                    <span class="breadcrumb-item active">Info de vale de producción</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="br-pagebody">
                <div style="float: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="editvaleproinf()" id="openedivpinf" name="openedivpinf"
                            title="Dar clic para editar" type="button" class="btn btn-secondary btn btn-secondary"><i
                                class="fa fa-edit"></i></button>
                        <button onclick="closevaleproinf()" id="closedvp" title="Dar clic para cerrar edición"
                            type="button" style="display:none;" class="btn btn-secondary btn-danger"><i
                                class="fa fa-times"></i></button>
                        <button onclick="pdfvp()" style="display:none;" title="Imprimir" id="pdfvprod" name="pdfvprod"
                            type="button" class="btn btn-secondary"><i class="fa fa-file-pdf-o"></i></button>
                        <button title="ver historial" onclick="histvalepro()" data-toggle="modal"
                            data-target="#modal-vphistorial" type="button" class="btn btn-primary"><i
                                class="fa fa-history"></i></button>
                    </div>
                </div><!-- col-5 -->
                <div class="br-section-wrapper">
                    <h6 class="">INFORMACIÓN DEL VALE DE PRODUCCIÓN</h6>
                    <form id="info-memo" method="POST">

                        <div class="form-layout form-layout-2">

                            <div class="row no-gutters">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta"
                                            type="text" name="vpfolio" id="vpfolio">
                                        <label class="form-control-label" style="font-size:14px">Orden de Producción No:
                                            <span class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingresa el Folio"> -->
                                        <label class="form-control-label" id="folprod" name="folprod"
                                            style="font-size:24px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">Fecha: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infvpdate" name="infvpdate"
                                            placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force" style="font-size:14px">TIPO DE
                                            VALE: <span class="tx-danger">*</span></label>
                                        <select id="infvptipo" disabled="" name="infvptipo" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="NORMAL">NORMAL</option>
                                            <option value="OPERADORA">OPERADORA</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">DEPARTAMENTO
                                            SOLICITANTE: <span class="tx-danger">*</span></label>
                                        <select id="infvpdepat" disabled="" name="infvpdepat" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="EMPAQUE">EMPAQUE</option>
                                            <option value="OFICINA">OFICINA</option>
                                            <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div><!-- col-4 -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">DEPARTAMENTO AL QUE
                                            SOLICITA: <span class="tx-danger">*</span></label>
                                        <select id="infvpsolicita" disabled="" name="infvpsolicita" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="EMPAQUE">EMPAQUE</option>
                                            <option value="OFICINA">OFICINA</option>
                                            <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div><!-- col-4 -->
                                </div>
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force" style="font-size:14px">CARACTER
                                            DEL VALE: <span class="tx-danger">*</span></label>
                                        <select id="infvpcaracter" disabled="" name="infvpcaracter" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="NORMAL">NORMAL</option>
                                            <option value="URGENTE">URGENTE</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">PEDIDOS
                                            RELACIONADOS:<span class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infvppedidos" name="infvppedidos"
                                            type="text" name="address" placeholder="Enter address">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">FORMULA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infvpformula" name="infvpformula"
                                            type="text" name="address" placeholder="FORMULA">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">AUTORIZA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infvpautoriza" name="infvpautoriza"
                                            type="text" placeholder="Autoriza">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">SURTIO: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infvpsutio" name="infvpsutio"
                                            type="text" placeholder="Autoriza">
                                    </div>
                                </div><!-- col-3 -->
                                <div class="col-md-2 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">Fecha/surtido: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infvpdatesurt"
                                            name="infvpdatesurt" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-3 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">RECIBIO: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infvprecibio" name="infvprecibio"
                                            type="text" placeholder="Autoriza">
                                    </div>
                                </div><!-- col-3 -->
                                <div class="col-md-2 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">Fecha/Recibio: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infvpdaterecibio"
                                            name="infvpdaterecibio" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-3 -->
                                <div class="col-md-6">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">ACCIONES: <span
                                                class="tx-danger">*</span></label>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button id="btnvpautoriz" name="btnvpautoriz" type="button"
                                                style="display:none;" onclick="autorizavp()"
                                                class="btn btn-info pd-x-30">Autorizar</button>
                                            <button title="Dar click para liberar" id="btnvpliberar" name="btnvpliberar"
                                                type="button" style="display:none;" onclick="liberarm()"
                                                class="btn btn-dark pd-x-25">Liberar</button>
                                            <button id="btnvpsurtir" name="btnvpsurtir" type="button"
                                                style="display:none;" onclick="surtidovp()"
                                                class="btn btn-indigo pd-x-25">Surtir</button>
                                            <button id="btnvpfinaliz" name="btnvpfinaliz" type="button"
                                                style="display:none;" onclick="finalizarvp()"
                                                class="btn btn-success pd-x-25">Finalizar</button>
                                        </div>

                                    </div>
                                </div><!-- col-6 -->
                                <div class="col-md-3">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">RELACIÓN JLM/ <a
                                                href="javascript:savevrevicion()">Guardar</a></label>
                                        <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="relajlm"
                                            id="relajlm" placeholder="JLM"></textarea>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force" style="font-size:14px">ESTATUS:
                                            <span class="tx-danger">*</span></label>
                                        <select id="infvpestatus" disabled="" name="infvpestatus"
                                            style="font-size:18px; color:#14128F" class="form-control">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="SURTIDO">SURTIDO</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="AUTORIZADO">AUTORIZADO</option>
                                        </select>

                                    </div>

                                </div><!-- col-4 -->
                                <br>
                            </div><!-- row -->
                            <div class="modal-footer">
                                <button type="button" onclick="savevpcabe()" id="saveinfvp" style="display:none;"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                                    CAMBIOS</button>
                                <br>
                            </div>

                            <div style="display:none;" id="edthvpexi" name="edthvpexi" class="alert alert-warning"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthvpivacios" name="edthvpivacios" class="alert alert-info"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthvpierror" name="edthvpierror" class="alert alert-danger"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte
                                        tecnico o levantar un ticket</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div>
                                <button type="button" data-toggle='modal'
                                    style="display:none; background-color: #009C28;" data-target='#modal-addartvpinfo'
                                    onclick="" id="vpaddartinf"
                                    class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                                        class="fa fa-plus"></i> AGREGAR ARTICULO</button>
                            </div>
                            <br>
                            <h5 class="tx-gray-700 mg-b-5" style="text-align:center">EXTENDIDO</h5>
                            <div class="col-lg-20">
                                <div id="listextent"></div><!-- col-12 -->
                            </div><!-- form-layout -->
                            <h5 class="tx-gray-700 mg-b-5" style="text-align:center">ETIQUETAS</h5>
                            <div class="col-lg-20">
                                <div id="listetiquetas"></div><!-- col-12 -->
                            </div>
                            <h5 class="tx-gray-700 mg-b-5" style="text-align:center">PRODUCTO TERMINADO</h5>
                            <div class="col-lg-20">
                                <div id="listproducfinal"></div><!-- col-12 -->
                            </div>
                    </form>
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
                    <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i
                            class="fa fa-globe tx-20"></i></a>
                </div>
            </footer>
    </section>
    <?php include('../administrador/modal.php');?>

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
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script type="text/javascript">
    // TABLA INSPECTORES EXTERNOS//
    openvalepr();
    </script>


</body>

</html>
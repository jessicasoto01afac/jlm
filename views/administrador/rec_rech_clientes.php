<!DOCTYPE html>
<html lang="es">
<?php include ("../../controller/conexion.php");
    
$sql = "SELECT codigo_clie,nombre FROM clientes WHERE estado = 0";
$cliente = mysqli_query($conexion,$sql);

?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <title>JLM|Clientes-Reclamos/Rechazos</title>
    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../template/css/diseno.css" rel="stylesheet">
    <link href="../template/lib/summernote/summernote-bs4.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">

</head>

<body class="collapsed-menu">
    <?php 
    include('header.php');
    ?>
    <section class="content" id="lista">
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">CLIENTE</h4>
                <p class="mg-b-0">Reclamos y rechazos</p>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <a class="btn btn-purple" title="Agregar nuevo reporte" href="javascript:foliovp()"
                        style="float:right"><i class="fa fa-plus mg-r-10"></i>Agregar reporte</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-wrapper rounded table-responsive">
                        <table class="table display dataTable no-footer" id="recliente2" name="recliente2"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">ID</th>
                                    <th>FOLIO</th>
                                    <th>FECHA</th>
                                    <th>CLIENTE</th>
                                    <th>REMISION</th>
                                    <th>FACTURA</th>
                                    <th>ESTATUS</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
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
        </div>
    </section>
    <!------------------------------- ########## DETALLES DEL RECLAMO CLIENTE ########## -------------------------->
    <section class="content" id="detareport" style="display: none;">
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/rec_rech_clientes.php">Lista reportes clientes</a>
                    <span class="breadcrumb-item active">Información del reporte</span>
                </nav>
            </div>
            <div class="br-pagebody">
                <div style="float: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="editreportinf()" id="openedipcliinf" name="openedipcliinf"
                            title="Dar clic para editar" type="button" class="btn btn-secondary btn btn-secondary"><i
                                class="fa fa-edit"></i></button>
                        <button onclick="closereporinf()" id="closedrcliet" title="Dar clic para cerrar edición"
                            type="button" style="display:none;" class="btn btn-secondary btn-danger"><i
                                class="fa fa-times"></i></button>
                        <button onclick="pdfvp()" style="display:none;" title="Imprimir" id="pdfrpclient"
                            name="pdfrpclient" type="button" class="btn btn-secondary"><i
                                class="fa fa-file-pdf-o"></i></button>
                        <button title="ver historial" onclick="histvalepro()" data-toggle="modal"
                            data-target="#modal-vphistorial" type="button" class="btn btn-primary"><i
                                class="fa fa-history"></i></button>
                    </div>
                </div><!-- col-5 -->
                <div class="br-section-wrapper">
                    <h6 class="">INFORMACIÓN DEL REPORTE DE CLIENTE</h6>
                    <form id="info-memo" method="POST">
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta"
                                            type="text" name="rclietfolio" id="rclietfolio">
                                        <label class="form-control-label" style="font-size:14px">FOLIO DE REPORTE
                                            <span class="tx-danger">*</span></label>
                                        <input class="form-control" style="display:none" type="text" id="folioreclie"
                                            name="folioreclie">
                                        <label class="form-control-label" id="folreport" name="folreport"
                                            style="font-size:24px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">Fecha: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infrepdate"
                                            name="infrepdate" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force" style="font-size:14px">TIPO DE
                                            REPORTE:<span class="tx-danger">*</span></label>
                                        <select id="infreptipo" disabled="" name="infreptipo" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="RECLAMO">RECLAMO</option>
                                            <option value="RECHAZO">RECHAZO</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-3 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">TIPO DE
                                            INCIDENCIA:<span class="tx-danger">*</span></label>
                                        <select id="infrepincid" disabled="" name="infrepincid" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="ERROR EN EL COSTO">ERROR EN EL COSTO</option>
                                            <option value="MATERIAL DEFECTUOSO">MATERIAL DEFECTUOSO</option>
                                            <option value="MATERIAL INCORRECTO">MATERIAL INCORRECTO</option>
                                            <option value="MATERIAL NO ENVIADO">MATERIAL NO ENVIADO</option>
                                            <option value="ERROR DE FACTURACIÓN">ERROR DE FACTURACIÓN</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div><!-- col-4 -->
                                </div>
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
                                        <label class="form-control-label" style="font-size:14px">REMISION: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infpedremisi" name="infpedremisi"
                                            type="text" name="address" placeholder="Enter address">
                                    </div><!-- col-4 -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">FACTURA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infpedfac" name="infpedfac" type="text"
                                            name="address" placeholder="Enter address">
                                    </div><!-- col-4 -->
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                    <label class="form-control-label" style="font-size:14px">CLIENTE: <span
                                                class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" readonly type="text" name="infclinte" id="infclinte"
                                            value="" placeholder="Enter address" style="font-size:16px"> -->
                                        <select disabled class="form-control" name="infrepxlientes" id="infrepxlientes" 
                                            style="font-size:16px" data-placeholder="Choose country">
                                            <option label="">Selecciona</option>
                                            <?php while($clie = mysqli_fetch_row($cliente)):?>
                                            <option value="<?php echo $clie[0]?>"><?php echo $clie[1]?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">SE ACREDITA EL RECLAMO
                                            A:<span class="tx-danger">*</span></label>
                                        <select id="infrepacred" disabled="" name="infrepacred" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="EMPAQUE">EMPAQUE</option>
                                            <option value="DISEÑO">DISEÑO</option>
                                            <option value="FACTURACIÓN">FACTURACIÓN</option>
                                            <option value="TALLER DE CORTE">SISTEMAS</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div><!-- col-4 -->
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">FORMULA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infrepformul" name="infrepformul"
                                            type="text" placeholder="Autoriza">
                                    </div>
                                </div><!-- col-3 -->
                                <div class="col-md-4">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force" style="font-size:16px">ESTATUS:
                                            <span class="tx-danger">*</span></label>
                                        <select id="infrpestatus" disabled="" name="infrpestatus"
                                            style="font-size:16px; color:#14128F" class="form-control">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">ACCIONES: <span
                                                class="tx-danger">*</span></label>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button title="Dar click para liberar" id="btnrclitliberar"
                                                name="btnrclitliberar" type="button" style="display:none;"
                                                onclick="liberarm()" class="btn btn-dark pd-x-25">Liberar</button>
                                            <button id="btnrclitfinaliz" name="btnrclitfinaliz" type="button"
                                                style="display:none;" onclick="finalizarep()"
                                                class="btn btn-success pd-x-25">Finalizar</button>
                                        </div>

                                    </div>
                                </div><!-- col-6 -->
                                <br>
                            </div><!-- row -->
                            <div class="modal-footer">
                                <button type="button" onclick="saverepcabe()" id="savehadearrep" style="display:none;"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                                    CAMBIOS</button>
                                <br>
                            </div>
                            <div style="display:none;" id="edthrepexi" name="edthrepexi" class="alert alert-warning"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthrepvacios" name="edthrepvacios" class="alert alert-info"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthreierror" name="edthreierror" class="alert alert-danger"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte
                                        tecnico o levantar un ticket</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div>
                                <button type="button" data-toggle='modal'
                                    style="display:none; background-color: #009C28;" data-target='#modal-addartrpinfo'
                                    onclick="" id="repaddartinf"
                                    class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                                        class="fa fa-plus"></i> AGREGAR ARTICULO</button>
                                
                            </div>
                            <h4 style="text-align:center">Articulos Relacionados</h4>
                            <div class="col-lg-20">
                                <div id="listarticlien"></div><!-- col-12 -->
                            </div><!-- form-layout -->
                        </div>
                        <h4 style="text-align:center">Resumen del reporte</h4>
                        <button onclick="edithrep()" id="edithreport" name="edithreport" title="Dar clic para editar"
                            type="button" style="float: right" class="btn btn-secondary btn btn-secondary"><i
                                class="fa fa-edit"></i></button>
                        <button onclick="closeedithrep()" id="edithreportclose" name="edithreportclose"
                            title="Dar clic para editar" type="button" style="float: right; display:none"
                            class="btn btn-danger btn btn-danger"><i class="fa fa-times"></i></button>
                        <br>
                        <br>
                        <section>
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6 class="form-control-label">REPORTE DEL
                                            CLIENTE: </h6>
                                        <div id="clientenote" name="clientenote"></div>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div style="display:none;" name="repcliente" id="repcliente"></div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6 class="form-control-label">REPORTE DE
                                            JLM:</h6>
                                        <div id="jlmnote"></div>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div style="display:none;" name="repjlm" id="repjlm"></div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6 class="form-control-label">SEGUIMIENTO:</h6>
                                        <div id="seguimientonote"></div>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div style="display:none;" name="repseguimiento" id="repseguimiento"></div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6 class="form-control-label">CONCLUSIÓN: </h6>
                                        <div id="conclicionnote"></div>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div style="display:none;" name="repconclu" id="repconclu"></div>

                                <div class="col-lg-12">
                                    <button onclick="saveupdatereport()" id="saverepoinf" name="saverepoinf"
                                        title="Dar clic para editar" type="button" style="float:right; display:none"
                                        class="col-lg-2 btn btn-info btn btn-info">Guardar</button>
                                    <br>
                                    <div class="form-group">
                                        <br>
                                        <div style="display:none;" id="dublirec2" name="dublirec2"
                                            class="alert alert-warning" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                            </div><!-- d-flex -->
                                        </div><!-- alert -->
                                        <div style="display:none;" id="vaciosrec2" name="vaciosrec2"
                                            class="alert alert-info" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i
                                                    class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                            </div><!-- d-flex -->
                                        </div><!-- alert -->
                                        <div style="display:none;" id="errcla2" name="errcla2"
                                            class="alert alert-danger" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-ios-close alert-icon tx-24"></i>
                                                <span><strong>Advertencia!</strong>No se puedo guardar coontactar a
                                                    soporte
                                                    tecnico o levantar un ticket</span>
                                            </div><!-- d-flex -->
                                        </div><!-- alert -->
                                    </div>
                                </div><!-- col-12 -->
                            </div>
                        </section>
                    </form>
                </div>
            </div>
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
        </div>
    </section>
    <?php include('../administrador/modal/mreporte.php');?>

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
    <script src="../controller/js/reclamos.js"></script>
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
    <script src="../template/lib/summernote/summernote-bs4.min.js"></script>
    <script src="../template/lib/medium-editor/medium-editor.js"></script>
    <script type="text/javascript"></script>


    <script>
    openreclientes();
    $(function() {
        'use strict';

        // Inline editor
        var editor = new MediumEditor('.editable');

        $('#clientenote').summernote({
            height: 250,
            tooltip: false
        });
        $('#jlmnote').summernote({
            height: 250,
            tooltip: false
        });
        $('#seguimientonote').summernote({
            height: 250,
            tooltip: false
        });
        $('#conclicionnote').summernote({
            height: 250,
            tooltip: false
        });
    });
    </script>


</body>

</html>
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
    <title>JLM|Material Defectuoso</title>
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
</head>

<body class="collapsed-menu">
    <?php
include('header.php');
?>
    <section class="content" id="lista">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">MATERIAL DEFECTUOSO</h4>
            </div>
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <a class="btn btn-primary" href="javascript:foliomatdefect()" style="float:right"><i
                            class="fa fa-list-alt mg-r-10"></i>Agregar Material Defectuoso</a>
                    <br>
                    <br>
                    <br>
                    <div class="table-wrapper rounded table-responsive">
                        <table class="table display dataTable no-footer" id="datadefctuoso" name="datadefctuoso"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:5%;">ID</th>
                                    <th>FOLIO</th>
                                    <th>FECHA</th>
                                    <th>CLIENTE</th>
                                    <th>DEPARTAMENTO</th>
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
    <!------------------------------- ########## DETALLES DEL MATERIAL DEFECUOSO ########## -------------------------->
    <section class="content" id="detalles" style="display: none;">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/matdefectuoso.php" onclick="cancelar();">Lista de
                        Material Defectuoso</a>
                    <span class="breadcrumb-item active">Material Defectuoso</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="br-pagebody">
                <div style="float: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="editmatdef()" id="openedimt1" title="Dar clic para editar" type="button"
                            class="btn btn-secondary btn btn-secondary"><i class="fa fa-edit"></i></button>
                        <button onclick="closedithmdef()" id="closemted" title="Dar clic para cerrar edición"
                            type="button" style="display:none;" class="btn btn-secondary btn-danger"><i
                                class="fa fa-times"></i></button>
                        <button onclick="pdfvp()" style="display:none;" title="Imprimir" id="pdfvofi" name="pdfvofi"
                            type="button" class="btn btn-secondary"><i class="fa fa-file-pdf-o"></i></button>
                        <button title="ver historial" onclick="histvaleofi()" data-toggle="modal"
                            data-target="#modal-vphistorial" type="button" class="btn btn-primary"><i
                                class="fa fa-history"></i></button>
                    </div>
                </div><!-- col-5 -->
                <div class="br-section-wrapper">

                    <h6 class="">MATERIAL DEFECTUOSO</h6>
                    <form id="info-valofi" method="POST">

                        <div class="form-layout form-layout-2">

                            <div class="row no-gutters">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta"
                                            type="text" name="infidmd" id="infidmd">
                                        <label class="form-control-label" style="font-size:14px">FOLIO: <span
                                                class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingresa el Folio"> -->
                                        <label class="form-control-label" id="fmdi" name="fmdi"
                                            style="font-size: 24px;px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label" style="font-size:14px">Fecha: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infecdf" name="infecdf"
                                            placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force"
                                            style="font-size:14px; width:100%">DEPARTAMENTO:<span class="tx-danger">*</span></label>
                                        <select id="infdepmd" disabled="" name="infdepmd" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="EMPAQUE">EMPAQUE</option>
                                            <option value="OFICINA">OFICINA</option>
                                            <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">CLIENTE:
                                            <span class="tx-danger">*</span></label>
                                        <select disabled class="form-control" name="infclinte" id="infclinte"
                                            style="font-size:16px" data-placeholder="Choose country">
                                            <option label="">Selecciona</option>
                                            <?php while($clie = mysqli_fetch_row($cliente)):?>
                                            <option value="<?php echo $clie[0]?>"><?php echo $clie[1]?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">MOTIVO DE LA
                                            DEVOLUCIÓN:
                                            <span class="tx-danger">*</span></label>
                                        <textarea readonly class="form-control" name="motdf" id="motdf" cols="3"
                                            rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">PEDIDOS RELACIONADOS/STOCK:</label>
                                        <div id="pedmatdef"></div>
                                    </div><!-- col-4 -->
                                </div><!-- col-8 -->
                                <div class="col-md-6">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label" style="font-size:14px">RELACIÓN JLM/ <a
                                                href="javascript:saverevicionvof()">Guardar</a></label>
                                        <textarea onkeyup="mayus(this);" rows="2" class="form-control" name="relajlvof"
                                            id="relajlvof" placeholder="JLM"></textarea>
                                    </div>
                                </div>
                                <br>
                            </div><!-- row -->
                            <div class="modal-footer">
                                <button type="button" onclick="savevofic()" id="mtedith" style="display:none;"
                                    class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR
                                    CAMBIOS</button>
                            </div>
                            <br>
                            <div style="display:none;" id="edthvoiexi" name="edthvoiexi" class="alert alert-warning"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthvoivacios" name="edthvoivacios" class="alert alert-info"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div style="display:none;" id="edthvoierror" name="edthvoierror" class="alert alert-danger"
                                role="alert">
                                <div class="d-flex align-items-center justify-content-start">
                                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o
                                        levantar un ticket</span>
                                </div><!-- d-flex -->
                            </div><!-- alert -->
                            <div>
                                <button type="button" onclick="masarticvo()" data-toggle='modal'
                                    style="display:none; background-color: #009C28;" data-target='#modal-editavo1'
                                    onclick="" id="voagartic"
                                    class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                                        class="fa fa-plus"></i> AGREGAR ARTICULO</button>
                            </div>
                            <br>
                            <h6 class="col-md-4 mg-t--1 mg-md-t-0">ARTICULOS</h6>
                            <br>
                            <div class="col-lg-12">
                            <div id="listdefinf"></div><!-- col-12 -->
                            </div><!-- form-layout -->
                    </form>
                </div>
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
    <script src="../controller/js/entrada_salida.js"></script>
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
    <?php include('../administrador/modal.php');?>
    <script type="text/javascript">
    // TABLA INSPECTORES EXTERNOS//
    opendefectuoso();
    </script>


</body>

</html>
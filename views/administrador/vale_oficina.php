<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Vale de oficina</title>

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
    <script src="../controller/js/vales.js"></script>

</head>

<body class="collapsed-menu">


    <?php

include('header.php');
?>
    <?php include('../administrador/modal.php');?>
    <!------------------------------- ########## LISTA DE VALES ########## -------------------------->
    <style>

    </style>
    <section class="content" id="lista">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
                <h4 class="tx-gray-800 mg-b-5">VALES DE OFICINA</h4>
            </div>

            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <a class="btn btn-primary" href="../administrador/newvaleofi.php" style="float:right"><i
                            class="fa fa-list-alt mg-r-10"></i>Agregar vale</a>
                    <br>
                    <br>
                    <br>
                    <div id="listvale_ofi">
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
    <section class="content" id="detalles" style="display: none;">
        <!-- ########## START: MAIN PANEL ########## -->
        <div class="br-mainpanel">
            <div class="br-pageheader pd-y-15 pd-l-20">
                <nav class="breadcrumb pd-0 mg-0 tx-12">
                    <a class="breadcrumb-item" href="../administrador/vale_oficina.php">Lista de vales</a>
                    <span class="breadcrumb-item active">Info de vale</span>
                </nav>
            </div><!-- br-pageheader -->
            <div class="br-pagebody">
                <div style="float: right;">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button onclick="editvaleof()" id="openedivo1" title="Dar clic para editar" type="button"
                            class="btn btn-secondary btn btn-warning"><i class="fa fa-edit"></i></button>
                        <button onclick="closedithvo()" id="closevoed" title="Dar clic para cerrar edición"
                            type="button" style="display:none;" class="btn btn-secondary btn-danger"><i
                                class="fa fa-times"></i></button>
                        <button title="Imprimir" type="button" class="btn btn-secondary"><i
                                class="fa fa-file-pdf-o"></i></button>
                    </div>
                </div><!-- col-5 -->
                <div class="br-section-wrapper">

                    <h6 class="">INFORMACIÓN DEL VALE</h6>
                    <form id="info-valofi" method="POST">

                        <div class="form-layout form-layout-2">

                            <div class="row no-gutters">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta"
                                            type="text" name="infid" id="infid">
                                        <label class="form-control-label">FOLIO: <span
                                                class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingresa el Folio"> -->
                                        <label class="form-control-label" id="fvofi" name="fvofi"
                                            style="font-size: 24px;px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label">Fecha: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infecvo" name="infecvo"
                                            placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force">TIPO DE VALE: <span
                                                class="tx-danger">*</span></label>
                                        <select id="inftipevo" disabled="" name="inftipevo" class="form-control"
                                            data-placeholder="Choose country">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="INTERNO">INTERNO</option>
                                            <option value="VENTA">VENTA</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label">SOLICITANTE: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infsolivo" name="infsolivo" type="text"
                                            name="address" placeholder="Enter address">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-4">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force">ESTATUS: <span
                                                class="tx-danger">*</span></label>
                                        <select id="infestavo" disabled="" name="infestavo"
                                            style="font-size:14px; color:#14128F" class="form-control">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="SURTIDO">SURTIDO</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="AUTORIZADO">AUTORIZADO</option>
                                        </select>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button id="btnautorizv" name="btnautorizv" type="button"
                                                style="display:none;" onclick="autorizarvo()"
                                                class="btn btn-info pd-x-30">Autorizar</button>
                                            <button title="Dar click para liberar" id="btnliberarv" name="btnliberarv"
                                                type="button" style="display:none;" onclick="libervo()"
                                                class="btn btn-dark pd-x-25">Liberar</button>
                                            <button id="btnsurtirv" name="btnsurtirv" type="button"
                                                style="display:none;" onclick="surtirvo()"
                                                class="btn btn-indigo pd-x-25">Surtir</button>
                                            <button id="btnfinalizv" name="btnfinalizv" type="button"
                                                style="display:none;" onclick="finalivo()"
                                                class="btn btn-success pd-x-25">Finalizar</button>
                                        </div>
                                    </div>
                                </div><!-- col-4 -->
                                <br>
                            </div><!-- row -->
                            <div class="modal-footer">
                                <button type="button" onclick="savevofic()" id="voedith" style="display:none;"
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
                                <div id="listvaleofi1">
                                </div><!-- col-12 -->
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
    <script src="../controller/js/catalogos.js"></script>
    <script src="../template/js/bracket.js"></script>
    <!-- DataTables -->
    <script src="../controller/datatables.net/js/jquery.dataTables.js"></script>
    <script src="../controller/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../controller/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <?php include('../administrador/modal.php');?>
    <script type="text/javascript">
    // TABLA INSPECTORES EXTERNOS//
    $.ajax({
        url: '../controller/php/convaleoficin.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html =
            '<div class="table-wrapper table-responsive"><table style="width:100%" id="datavaleofi" name="datavaleofi" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>FOLIO</th><th style="width:100px;"><i></i>FECHA</th><th><i></i>SOLICITANTE</th><th><i></i>ESTADO</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;

            id_per = "este es la person" //indentificacion de la person

            html += "<tr><td>" + x + "</td><td>" + obj.data[U].refe_1 + "</td><td>" + obj.data[U].fecha +
                "</td><td>" + obj.data[U].proveedor_cliente + "</td><td>" + obj.data[U].status + "</td><td>" +
                "<a onclick='infvale()' style='cursor:pointer;' title='Editar Articulo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletvolis()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevol'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" +
                "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listvale_ofi").html(html);
        'use strict';
        $('#datavaleofi').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Buscar...',
                sSearch: '',
                lengthMenu: 'mostrando _MENU_ paginas',
                sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
                sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
                oPaginate: {
                    sFirst: 'Primero',
                    sLast: 'Último',
                    sNext: 'Siguiente',
                    sPrevious: 'Anterior',
                },
            }
        });
    })

    //otro script
    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity
    });

    $(function() {
        'use strict';

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
    </script>


</body>

</html>
<!DOCTYPE html>
<?php include ("../controller/conexion.php");
      $sql = "SELECT MAX(folio) AS id_foliovp FROM folios where tipo ='VALE_OFICINA' AND estado_f=0";
      $foliomemo = mysqli_query($conexion,$sql);
      $folio = mysqli_fetch_row($foliomemo);

?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <!-- Meta -->
    <meta name="author" content="Jessica Soto">
    <title>JLM|Vales_oficina</title>
    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/jquery.steps/jquery.steps.css" rel="stylesheet">
    <script src="../controller/js/vales.js"></script>

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
</head>
<style>
.swal-wide {
    width: 500px !important;
    font-size: 16px !important;
}
</style>


<body class="collapsed-menu">
    <?php
    include('header.php');
  ?>
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="../administrador/vale_oficina.php">Lista de vales</a>
                <span class="breadcrumb-item active">Alta de Vale de Oficina</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">ALTA DE VALE DE OFICINA</h4>
        </div>
        <div class="br-pagebody">
            <div style="float: right;">
                <a href="../administrador/vale_oficina.php" onclick="cancelarvo()" id="closememo"
                    title="Dar clic para cancelar el memo" type="button" class="btn btn-secondary"><i
                        class="fa fa-times"></i></a>
            </div>
            <div class="br-section-wrapper">

                <div id="wizard2">
                    <h3>Cabezera del vale</h3>
                    <section>
                        <form id="valeoficina" method="POST">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FOLIO: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" readonly class="form-control" type="text"
                                            id="vfolio" name="vfolio" value="<?php echo $folio[0]?>" placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FECHA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" id="vfecha" name="vfecha" value=""
                                            placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label style="font-size:16px" class="form-control-label">TIPO DE VALE: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control" onchange="tipevale()" id="vtipo" name="vtipo">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="INTERNO">INTERNO</option>
                                            <option value="VENTA">VENTA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6" id="personal" style="display:none;">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">NOMBRE DEL PERSONAL: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" class="form-control" type="text" id="vprove"
                                            name="vprove" placeholder="Ingrese el Nombre">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-lg-6" id="departamento">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">DEPARTAMENTO SOLICITANTE: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control" id="vdep" name="vdep">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="ALMACEN">ALMACEN</option>
                                            <option value="BODEGA">BODEGA</option>
                                            <option value="COMPRAS">COMPRAS</option>
                                            <option value="EMPAQUE">EMPAQUE</option>
                                            <option value="OFICINA">OFICINA</option>
                                            <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                            <option value="TALLER DE MEDICIÓN">TALLER DE MEDICIÓN</option>
                                            <option value="SISTEMAS">SISTEMAS</option>
                                            <option value="VENTAS">VENTAS</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                    </section>
                    <h3>Agregar Articulos</h3>
                    <section>
                        <p>INGRESE LOS ARTICULOS</p>
                        <div class="row mg-b-25">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CODIGO: <span
                                            class="tx-danger">*</span></label>
                                    <div id="busccodigo"></div>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" readonly name="vdescrip"
                                        id="vdescrip" placeholder="" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="vcantidad" id="vcantidad"
                                        placeholder="Ingrese la cantidad" type="number" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="vdepart" id="vdepart"
                                        placeholder="Departamento" readonly type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3" id="precio" style="display:none;">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">$ PRECIO: <span class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" onchange="totalvo()" min="0" value="0" step="0.1"
                                        class="form-control" type="text" id="vprecio" name="vprecio"
                                        placeholder="Ingrese el precio">
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-3" id="total" style="display:none;">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">$ TOTAL: <span class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" value="0" type="number" min="0"
                                        max="4" id="vtotal" name="vtotal" readonly placeholder="Total">
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label label2">OBSERBACIONES: <span
                                            class="tx-danger"></span></label>
                                    <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="observo"
                                        id="observo" placeholder="Ingresa alguna observación"></textarea>
                                </div>
                            </div><!-- col-12 -->
                            </form>
                            <br>
                            <br>
                            <div class="form-layout-footer">
                                <button class="btn btn-primary" onclick="addvaleofi()">AGREGAR</button>
                            </div><!-- form-layout-footer -->
                            <div class="col-lg-12">
                                <br>
                                <div class="form-group">
                                    <br>
                                    <div style="display:none;" id="dublivo" name="dublivo" class="alert alert-warning"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                    <div style="display:none;" id="vaciosvo" name="vaciosvo" class="alert alert-info"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                    <div style="display:none;" id="errvo" name="errvo" class="alert alert-danger"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-24"></i>
                                            <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte
                                                tecnico o levantar un ticket</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                </div>
                            </div><!-- col-12 -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div id="listvaleofi">
                                    </div>
                                </div><!-- col-12 -->
                                <!-- <a class="btn btn-primary" href="../administrador/vale_oficina.php"
                                    style="float:right; color:white">FINALIZAR</a> -->
                    </section>
                </div>
                <br>
                <a onclick="cancelarvo()" class="btn btn-danger" style="float:right; color:white">CANCELAR</a>



            </div><!-- br-pagebody -->
        </div><!-- br-pagebody -->
        <footer class="br-footer">
            <div class="footer-left">
                <div class="mg-b-2">Copyright &copy; 2022. Derechos reservados a JLM.</div>
                <div>Jose Luis Mondragon y CIA.</div>
            </div>
            <div class="footer-right d-flex align-items-center">
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
    <script src="../template/lib/highlightjs/highlight.pack.js"></script>
    <script src="../template/lib/jquery.steps/jquery.steps.js"></script>
    <script src="../template/lib/datatables/jquery.dataTables.js"></script>
    <script src="../template/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../template/lib/parsleyjs/parsley.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <?php include('../administrador/modal.php');?>

    <script src="../template/js/bracket.js"></script>
    <script>
    document.getElementById('vfolio').value;
    $.ajax({
        url: '../controller/php/convaleoficin.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html =
            '<div class="table-wrapper"><table style="width:100%" id="datavaofi1" name="datavaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            if (obj.data[U].refe_1 == id_valeofi) {
                x++;

                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].refe_1 + "</td><td>" + obj
                    .data[U].salida + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U]
                    .observ_val + "</td><td>" +
                    "<a onclick='proveedith()' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editprov'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletprov()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleprov'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" +
                    "</td></tr>";
            }

        }
        html += '</div></tbody></table></div></div>';
        $("#datavaofi1").html(html);
        'use strict';
        $('#datavaofi').DataTable({
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

    $(document).ready(function() {
        'use strict';
        $('#wizard2').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            enableFinishButton: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            labels: {
                cancel: "Cancelar",
                current: "current step:",
                pagination: "Pagination",
                finish: "Finalizar",
                next: "Siguiente",
                previous: "Anterior",
                loading: "Cargando ..."
            },
            onFinished: function(event, currentIndex) {
                //alert("Form submitted.");
                var refe_1 = document.getElementById('vfolio').value; //FOLIO DEL VALE
                var fecha = document.getElementById('vfecha').value;
                var refe_3 = document.getElementById('vtipo').value;
                var proveedor_cliente = document.getElementById('vdep').value + document
                    .getElementById('vprove').value;

                let datos = 'refe_1=' + refe_1 + '&refe_3=' + refe_3 + '&opcion=registrarfin';
                //alert(datos);
                if (document.getElementById('vfolio').value == '' || document.getElementById(
                        'vfecha').value == '' || document.getElementById('vtipo').value == '' ||
                    proveedor_cliente == '') {
                    document.getElementById('vaciosvo').style.display = ''
                    setTimeout(function() {
                        document.getElementById('vaciosvo').style.display = 'none';
                    }, 2000);
                    return;
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../controller/php/insertvaleofi.php",
                        data: datos
                    }).done(function(respuesta) {
                        //alert(respuesta);
                        if (respuesta == 0) {
                            Swal.fire({
                                type: 'success',
                                text: 'Se AGREGO el vale de producción de forma correcta',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            setTimeout("location.href = 'vale_oficina.php';", 1500);
                        } else if (respuesta == 2) {
                            Swal.fire({
                                type: 'warning',
                                text: 'ya esta duplicado',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                type: 'error',
                                text: 'Error contactar a soporte tecnico o levantar un ticket',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    });
                }
            },
            onStepChanging: function(event, currentIndex, newIndex) {
                if (currentIndex < newIndex) {
                    // Step 1 form validation
                    if (currentIndex === 0) {
                        var fname = $('#vfolio').parsley();
                        var lname = $('#vfecha').parsley();

                        if (fname.isValid() && lname.isValid()) {
                            return true;
                        } else {
                            fname.validate();
                            lname.validate();
                        }
                    }

                    // Step 2 form validation
                    if (currentIndex === 1) {
                        var email = $('#vcodigo').parsley();
                        if (email.isValid()) {
                            return true;
                        } else {
                            email.validate();
                        }
                    }
                    // Always allow step back to the previous step even if the current step is not valid.
                } else {
                    return true;
                }
            }
        });
    });

    $(document).ready(function() {
        $('#busccodigo').load('./select/buscar.php');
    });
    </script>
</body>
</html>
<!DOCTYPE html>
<?php include ("../controller/conexion.php");

      $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);

      $querry = "SELECT * FROM proveedores WHERE estado = 0";
      $proveedor = mysqli_query($conexion,$querry);

      $sql2 = "SELECT MAX(folio) AS id_foliorecli FROM folios where tipo ='RECLAMO_PROVEEDOR' AND estado_f=0";
      $foliovale_p = mysqli_query($conexion,$sql2);
      $folio = mysqli_fetch_row($foliovale_p);

      $sql11 = "SELECT id_per,usunom,usuapell FROM accesos WHERE estado = 0";
      $personak = mysqli_query($conexion,$sql11);
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <!-- Meta -->
    <meta name="author" content="Jessica Soto">
    <title>JLM|Agregar Reporte de Proveedor</title>
    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/jquery.steps/jquery.steps.css" rel="stylesheet">
    <script src="../controller/js/memos.js"></script>
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/medium-editor/medium-editor.css" rel="stylesheet">
    <link href="../template/lib/medium-editor/default.css" rel="stylesheet">
    <link href="../template/lib/summernote/summernote-bs4.css" rel="stylesheet">
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
                <a class="breadcrumb-item" href="../administrador/rec_rech_proveedor.php">Lista de proveedor</a>
                <span class="breadcrumb-item active">Alta de Reclamo "Proveedor"</span>
            </nav>
        </div><!-- br-pageheader -->

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h5 class="tx-gray-800 mg-b-5">ALTA DE RECLAMOS/RECHAZOS "PROVEEDOR"</h5>
        </div>
        <div class="br-pagebody">
            <div style="float: right;">
                <a href="../administrador/new_reclacliente.php" onclick="cancealmemo()" id="cerrprov"
                    title="Dar clic para cancelar el memo" type="button" class="btn btn-secondary"><i
                        class="fa fa-times"></i></a>
            </div>
            <div class="br-section-wrapper">
                <div id="wizard7">
                    <h3>Cabezera del Reporte</h3>
                    <section>
                        <form id="valeoficina" method="POST">
                            <div class="row mg-b-25">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FOLIO: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" readonly style="font-size:18px; color:#1F618D"
                                            class="form-control" type="text" id="folioprove" name="folioprove"
                                            value="<?php echo $folio[0]?>" placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FECHA: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" id="fecharepprove" name="fecharepprove"
                                            value="" placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label style="font-size:16px" class="form-control-label">TIPO DE REPORTE:
                                            <span class="tx-danger">*</span></label>
                                        <select class="form-control" onchange="" id="tiporeprove" name="tiporeprove">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="RECLAMO">RECLAMO</option>
                                            <option value="RECHAZO">RECHAZO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group mg-b-10-force">
                                        <label style="font-size:16px" class="form-control-label">TIPO DE INCIDENCIA:
                                            <span class="tx-danger">*</span></label>
                                        <select class="form-control" onchange="" id="tipoincprove" name="tipoincprove">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="ERROR EN EL COSTO">ERROR EN EL COSTO</option>
                                            <option value="MATERIAL DEFECTUOSO">MATERIAL DEFECTUOSO</option>
                                            <option value="MATERIAL INCORRECTO">MATERIAL INCORRECTO</option>
                                            <option value="MATERIAL NO ENVIADO">MATERIAL NO ENVIADO</option>
                                            <option value="ERROR DE FACTURACIÓN">ERROR DE FACTURACIÓN</option>
                                            <option value="OTROS">OTROS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="font-size:14px" class="form-control-label">ORDEN DE COMPRA: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" style="font-size:18px; color:#1F618D"
                                            class="form-control" type="text" id="ordcproveed" name="ordcproveed"
                                            value="" placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label style="font-size:14px" class="form-control-label">FACTURA: <span
                                                class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" style="font-size:18px; color:#1F618D"
                                            class="form-control" type="text" id="factprove" name="factprove" value=""
                                            placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->

                                <div class="col-lg-6" id="departamento">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">PROVEEDOR: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control" id="deprechaclie" name="deprechaclie">
                                            <option value="">SELECCIONA AL PROVEEDOR
                                            </option>
                                            <?php while($provee = mysqli_fetch_row($proveedor)):?>
                                            <option value="<?php echo $provee[1]?>"><?php echo $provee[2]?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4" id="departamento">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">DEPARTAMENTO REPORTANTE</label>
                                        <select class="form-control" id="repprovedd" name="repprovedd">
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
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6" id="departamento">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">REPORTA</label>
                                        <select class="form-control" id="repprovee" name="repprovee">
                                            <option label="">Selecciona</option>
                                            <?php while($per1 = mysqli_fetch_row($personak)):?>
                                            <option value="<?php echo $per1[0]?>"><?php echo $per1[1].' '.$per1[2] ?>
                                            </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- col-4 -->
                    </section>
                    <h3>Ingres los articulos</h3>
                    <section>
                        <h5>INGRESE LOS ARTICULOS RELACIONADOS</h5>
                        <br>
                        <div class="row mg-b-25">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CODIGO: <span
                                            class="tx-danger">*</span></label>
                                    <div id="busccodimem"></div>
                                    <!-- <div id="busrecliente"></div> -->
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" readonly name="mdecriptr"
                                        id="mdecriptr" placeholder="" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="cantidadrecl"
                                        id="cantidadrecl" placeholder="Ingrese la cantidad" type="number" required>
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label label2">OBSERBACIONES: <span
                                            class="tx-danger"></span></label>
                                    <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="pedobservo"
                                        id="pedobservo" placeholder="Ingresa alguna observación"></textarea>
                                </div>
                            </div><!-- col-12 -->
                            </form>
                            <br>
                            <div class="col-lg-12">
                                <div class="form-layout-footer">
                                    <button class="btn btn-primary" onclick="addartreprove()">AGREGAR</button>
                                </div><!-- form-layout-footer -->
                                <div class="col-lg-12">
                                    <br>
                                    <div class="form-group">
                                        <br>
                                        <div style="display:none;" id="dublirecc" name="dublirecc"
                                            class="alert alert-warning" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                            </div><!-- d-flex -->
                                        </div><!-- alert -->
                                        <div style="display:none;" id="vaciosrecc" name="vaciosrecc"
                                            class="alert alert-info" role="alert">
                                            <div class="d-flex align-items-center justify-content-start">
                                                <i
                                                    class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                                <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                            </div><!-- d-flex -->
                                        </div><!-- alert -->
                                        <div style="display:none;" id="errrecc" name="errrecc"
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div id="lisreclaclie">
                                    </div>
                                </div><!-- col-12 -->
                    </section>

                    <h3>Resumen del reporte</h3>
                    <section>
                        <h5>INGRESE EL RESUMEN</h5>
                        <br>
                        <div class="row mg-b-25">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label ">INGRESE UN DERSCRIPCION
                                        BREVE DEL REPORTE: <span class="tx-danger">*</span></label>
                                    <div id="clientenote" name="clientenote"></div>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div style="display:none;" name="repcliente" id="repcliente"></div>
                            <div class="col-lg-12">
                                <h5>REPORTE DE INCIDENCIAS LA PROVEEDOR</h5>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">FECHA: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="datesegu" id="datesegu"
                                        placeholder="Departamento" type="date" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="departseg" id="departseg"
                                        placeholder="Departamento" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">ENVIO A: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="departevio" id="departevio"
                                        placeholder="Departamento" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">TELEFONO: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="teldep" id="teldep"
                                        placeholder="TELEFONO" type="number" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">E-MAIL: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="" class="form-control" name="email" id="email" placeholder="E-MAIL"
                                        type="mail" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">MEDIO POR EL QUE SE NOTIFICA:</label>
                                    <div id="medionot"></div>
                                </div><!-- col-4 -->
                            </div><!-- col-8 -->
                            <div style="display:none;" name="repjlm" id="repjlm"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">SEGUIMIENTO: <span
                                            class="tx-danger">*</span></label>
                                    <div id="seguimientonote"></div>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div style="display:none;" name="repseguimiento" id="repseguimiento"></div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">RESULTADO: <span
                                            class="tx-danger">*</span></label>
                                    <div id="conclicionnote"></div>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div style="display:none;" name="repconclu" id="repconclu"></div>
                            </form>
                            <div class="col-lg-12">
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
                                            <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                    <div style="display:none;" id="errcla2" name="errcla2" class="alert alert-danger"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-24"></i>
                                            <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte
                                                tecnico o levantar un ticket</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                </div>
                            </div><!-- col-12 -->
                        </div>
                    </section>
                </div>
                <br>
                <a onclick="cancealmemo()" class="btn btn-danger" style="float:right; color:white">CANCELAR</a>
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
    <script src="../template/lib/select2/js/select2.min.js"></script>
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
    <script src="../template/lib/jquery-toggles/toggles.min.js"></script>
    <script src="../template/lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    <script src="../template/lib/jt.timepicker/jquery.timepicker.js"></script>
    <script src="../template/lib/spectrum/spectrum.js"></script>
    <script src="../template/lib/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="../template/lib/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="../controller/js/reclamospro.js"></script>
    <script src="../template/lib/summernote/summernote-bs4.min.js"></script>
    <script src="../template/lib/medium-editor/medium-editor.js"></script>

    <?php include('../administrador/modal/mreporte.php');?>

    <script src="../template/js/bracket.js"></script>
    <script>
    openrepclient();
    $(function() {
        // Inline editor
        var editor = new MediumEditor('.editable');
        $('#clientenote').summernote({
            height: 150,
            tooltip: false
        });
        $('#jlmnote').summernote({
            height: 150,
            tooltip: false
        });
        $('#seguimientonote').summernote({
            height: 150,
            tooltip: false
        });
        $('#conclicionnote').summernote({
            height: 150,
            tooltip: false
        });
    });
    </script>


</body>

</html>
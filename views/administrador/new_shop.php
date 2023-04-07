<!DOCTYPE html>
<?php include ("../controller/conexion.php");
      $sql = "SELECT MAX(folio) AS id_foliovp FROM folios where tipo ='COMPRAS' AND estado_f=0";
      $foliovale_p = mysqli_query($conexion,$sql);
      $folio = mysqli_fetch_row($foliovale_p);

      $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
      $articulo = mysqli_query($conexion,$sql);

      $sql3 = "SELECT * FROM proveedores WHERE estado = 0";
      $cliente = mysqli_query($conexion,$sql3);
?>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <!-- Meta -->
    <meta name="author" content="Jessica Soto">
    <title>JLM|Agregar_mat_defectuoso</title>
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
                <a class="breadcrumb-item" href="../administrador/compras.php" onclick="cancelar();">Lista de
                    Compras</a>
                <span class="breadcrumb-item active">Alta de Orden de Compra</span>
            </nav>
        </div><!-- br-pageheader -->

        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">ALTA DE COMPRAS</h4>
            <input value="COMPRAS" id="tipe" name="tipe" style="display:none" type="text">
        </div>
        <div class="br-pagebody">
            <div style="float: right;">
                <a href="../administrador/compras.php" id="closememo" onclick="cancelar();"
                    title="Dar clic para cancelar el memo" type="button" class="btn btn-secondary"><i
                        class="fa fa-times"></i></a>
            </div>
            <div class="br-section-wrapper">
                <div id="wizard5">
                    <h3>Infromación de la compra</h3>
                    <section>
                        <form id="valeoficina" method="POST">
                            <div class="row mg-b-25">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FOLIO OC#:
                                            <span class="tx-danger">*</span></label>
                                        <input onkeyup="mayus(this);" style="font-size:18px; color:#1F618D"
                                            class="form-control" type="text" id="cmfolio" name="cmfolio" readonly
                                            placeholder="" value="<?php echo $folio[0]?>">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FECHA OC: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" id="cmfecha" name="cmfecha" value=""
                                            placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">FECHA DE ENTREGA:<span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" id="cmfechaent" name="cmfechaent" value=""
                                            placeholder="">
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-12" id="departamento">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">PROVEEDOR: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control" id="cmprovedd" name="cmprovedd">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <?php while($clie = mysqli_fetch_row($cliente)):?>
                                            <option value="<?php echo $clie[1]?>"><?php echo $clie[2]?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">USO DEL CFDI:<span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control" id="cmusocfdi" name="cmusocfdi">
                                            <option value="G01 ADQUISICIÓN DE MERCANCÍAS">G01 ADQUISICIÓN DE MERCANCÍAS
                                            </option>
                                            <option value="G02 DEVOLUCIONES, DESCUENTOS O BONIFICACIONES">G02
                                                DEVOLUCIONES, DESCUENTOS O BONIFICACIONES</option>
                                            <option value="G03 GASTOS EN GENERAL">G03 GASTOS EN GENERAL</option>
                                            <option value="I01 CONSTRUCCIONES">I01 CONSTRUCCIONES</option>
                                            <option value="I02 MOBILARIO Y EQUIPO DE OFICINA POR INVERSIONES">I02
                                                MOBILARIO Y EQUIPO DE OFICINA POR INVERSIONES</option>
                                            <option value="I03 EQUIPO DE TRANSPORTE">I03 EQUIPO DE TRANSPORTE</option>
                                            <option value="I04 EQUIPO DE COMPUTO Y ACCESORIOS">I04 EQUIPO DE COMPUTO Y
                                                ACCESORIOS</option>
                                            <option value="I05 DADOS, TROQUELES, MOLDES, MATRICES Y HERRAMENTAL">I05
                                                DADOS, TROQUELES, MOLDES, MATRICES Y HERRAMENTAL</option>
                                            <option value="I06 DADOS, COMUNICACIONES TELEFÓNICAS<">I06 DADOS,
                                                COMUNICACIONES TELEFÓNICAS</option>
                                            <option value="I07 COMUNICACIONES SATELITALES">I07 COMUNICACIONES
                                                SATELITALES</option>
                                            <option value="I08 OTRA MAQUINARIA Y EQUIPO">I08 OTRA MAQUINARIA Y EQUIPO
                                            </option>
                                            <option value="D01 HONORARIOS MÉDICOS, DENTALES Y GASTOS HOSPITALARIOS">D01
                                                HONORARIOS MÉDICOS, DENTALES Y GASTOS HOSPITALARIOS</option>
                                            <option value="D02 GASTOS MÉDICOS POR INCAPACIDAD O DISCAPACIDAD">D02 GASTOS
                                                MÉDICOS POR INCAPACIDAD O DISCAPACIDAD</option>
                                            <option value="D03 GASTOS FUNERALES">D03 GASTOS FUNERALES</option>
                                            <option value="D04 DONATIVOS">D04 DONATIVOS</option>
                                            <option
                                                value="D05 INTERESES REALES EFECTIVAMENTE PAGADOS POR CRÉDITOS HIPOTECARIOS (CASA HABITACIÓN)">
                                                D05 INTERESES REALES EFECTIVAMENTE PAGADOS POR CRÉDITOS HIPOTECARIOS
                                                (CASA HABITACIÓN)</option>
                                            <option value="D06 APORTACIONES VOLUNTARIAS AL SAR">D06 APORTACIONES
                                                VOLUNTARIAS AL SAR</option>
                                            <option value="D07 PRIMAS POR SEGUROS DE GASTOS MÉDICOS">D07 PRIMAS POR
                                                SEGUROS DE GASTOS MÉDICOS</option>
                                            <option value="D08 GASTOS DE TRANSPORTACIÓN ESCOLAR OBLIGATORIA">D08 GASTOS
                                                DE TRANSPORTACIÓN ESCOLAR OBLIGATORIA</option>
                                            <option
                                                value="D09 DEPÓSITOS EN CUENTAS PARA EL AHORRO, PRIMAS QUE TENGAN COMO BASE PLANES DE PENSIONES">
                                                D09 DEPÓSITOS EN CUENTAS PARA EL AHORRO, PRIMAS QUE TENGAN COMO BASE
                                                PLANES DE PENSIONES</option>
                                            <option value="D10 PAGOS POR SERVICIOS EDUCATIVOS (COLEGIATURAS)">D10 PAGOS
                                                POR SERVICIOS EDUCATIVOS (COLEGIATURAS)</option>
                                            <option value="P01 POR DEFINIR">P01 POR DEFINIR</option>
                                        </select>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">CONDICIONES DE PAGO:<span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control inputalta" id="condi_pago" name="condi_pago">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="NO APLICA">NO APLICA</option>
                                            <option value="CONTADO">CONTADO</option>
                                            <option value="7 DIAS">7 DIAS</option>
                                            <option value="8 DIAS">8 DIAS</option>
                                            <option value="15 DIAS">15 DIAS</option>
                                            <option value="30 DIAS">30 DIAS</option>
                                            <option value="45 DIAS">45 DIAS</option>
                                            <option value="60 DIAS">60 DIAS</option>
                                        </select>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label style="font-size:16px" class="form-control-label">CONSIGNADO A:<span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control inputalta" id="cmasing" name="cmasing">
                                            <option value="">SELECCIONA UNA OPCIÓN</option>
                                            <option value="CONSIGNADO">CONSIGNADO</option>
                                        </select>
                                    </div><!-- form-group -->
                                </div><!-- form-group -->
                            </div>
                    </section>
                    <h3>Material de compra</h3>
                    <section>
                        <h5>INGRESE LOS ARTICULOS</h5>
                        <br>
                        <div class="row mg-b-25">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CODIGO INTERNO: <span
                                            class="tx-danger">*</span></label>
                                    <div id="buscarticulos"></div>
                                    <!-- <div id="busccodigtrasns"></div> -->
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN INTERNA: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" readonly name="mdecriptr"
                                        id="mdecriptr" placeholder="" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CODIGO PROVEEDOR: <span
                                            class="tx-danger">*</span></label>
                                    <div id="buscarticulosprv"></div>
                                    <!-- <div id="busccodigtrasns"></div> -->
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DESCRIPCIÓN PROVEEDOR: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" readonly name="mdecripprvvd"
                                        id="mdecripprvvd" placeholder="" type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">CANTIDAD: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="vpcantidad" id="vpcantidad"
                                        placeholder="Ingrese la cantidad" type="number" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label style="font-size:16px" class="form-control-label">DEPARTAMENTO: <span
                                            class="tx-danger">*</span></label>
                                    <input onkeyup="mayus(this);" class="form-control" name="mdepart" id="mdepart"
                                        placeholder="Departamento" readonly type="text" required>
                                </div><!-- form-group -->
                            </div><!-- form-group -->
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label label2">OBSERVACIONES:<span
                                            class="tx-danger"></span></label>
                                    <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="dfbservo"
                                        id="dfbservo" placeholder="Ingresa alguna observación"></textarea>
                                </div>
                            </div><!-- col-12 -->
                            </form>
                            <br>
                            <br>
                            <div class="col-lg-12">
                                <div class="form-layout-footer">
                                    <button class="btn btn-primary" onclick="addartcompr()">AGREGAR</button>
                                </div><!-- form-layout-footer -->
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="col-lg-12">
                                <br>
                                <div class="form-group">
                                    <br>
                                    <div style="display:none;" id="cmdublidf" name="cmdublidf" class="alert alert-warning"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                    <div style="display:none;" id="cmvaciosdf" name="cmvaciosdf" class="alert alert-info"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                            <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                    <div style="display:none;" id="cmerrdf" name="cmerrdf" class="alert alert-danger"
                                        role="alert">
                                        <div class="d-flex align-items-center justify-content-start">
                                            <i class="icon ion-ios-close alert-icon tx-24"></i>
                                            <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte
                                                tecnico o levantar un ticket</span>
                                        </div><!-- d-flex -->
                                    </div><!-- alert -->
                                </div>
                            </div><!-- col-12 -->
                            <!-- <h5 style="text-align: center"></h5> -->
                            <h5 class="tx-gray-700 mg-b-5" style="text-align:center">ARTICULOS</h5>
                            <div class="col-lg-12">
                                <div id="listarcomprs"></div><!-- col-12 -->
                            </div><!-- form-layout -->
                    </section>
                    <a onclick="cancelar()" class="btn btn-danger" style="float:right; color:white">CANCELAR</a>
                </div>
                <br>
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
    <script src="../controller/js/compras.js"></script>
    <?php include('../administrador/modal/entradassalidas.php');?>
    <script src="../template/js/bracket.js"></script>
    <script>
    openew();
    </script>
</body>

</html>
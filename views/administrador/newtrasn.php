<!DOCTYPE html>

<?php 
include ("../controller/conexion.php");
    $sql = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
    $articulo = mysqli_query($conexion,$sql);

    $sql2 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
    $articulo2 = mysqli_query($conexion,$sql2);

    $sql3 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
    $articulo3 = mysqli_query($conexion,$sql3);

    $sql4 = "SELECT artcodigo,artdescrip,artubicac FROM articulos WHERE estado = 0";
    $articulo4 = mysqli_query($conexion,$sql4);

    

?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />

    <title>JLM|Agregar Articulo</title>

    <!--  css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <link href="../template/css/diseno.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
    <!-- <link rel="stylesheet" href="../template/css/card.css"> -->
</head>
<style>
.swal-wide {
    width: 500px !important;
    font-size: 16px !important;
}

.a-alert {
    outline: none;
    text-decoration: none;
    padding: 2px 1px 0;
}

.a-alert:link {
    color: white;
}

.a-alert:visited {
    color: white;
}
</style>

<body class="collapsed-menu">
    <?php
  include('header.php');
?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader pd-y-15 pd-l-20">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="../administrador/transformacion.php">Transformación</a>
                <span class="breadcrumb-item active">Alta de Transformación</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">ALTA DE TRANSFORMACIÓN</h4>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form id="altarticulos" method="POST">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo articulo Final: <span
                                        class="tx-danger">*</span></label>
                                <div id="bsfinal" name="bsfinal"></div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">Descripción:</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="descripfin" id="descripfin" placeholder="Ingresa la Descripción" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <label class="ckbox">
                                <input style="size:25px" onchange="addplus()" id="pluscolor" name="pluscolor"
                                    type="checkbox"><span class="tx-purple" style="font-size: 20px">Selecciona si tiene
                                    mas de un color</span>
                            </label>
                        </div>
                        <div id="line" name="line" style="display:none" class="col-lg-12">
                        <hr style="color: black; background-color:#D7D6D6; width:100%;" />
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo articulo Extendido: <span
                                        class="tx-danger">*</span></label>
                                <div id="bscodigoext" name="bscodigoext"></div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">Descripción:</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="descripext" id="descripext" placeholder="Ingresa la Descripción" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12" id="addpluscolor" name="addpluscolor" style="display:none">
                            <div class="col-lg-12" style="color:#03925C">
                                AGREGAR LOS DETALLES DE LOS COLORES
                                <div
                                    class="d-flex align-items-center justify-content-end bg-gray-100 ht-md-80 bd pd-x-20 mg-t-10">
                                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                                        <input id="multiplicadd" name="multiplicadd" type="number" class="form-control" placeholder="Multiplicaciones">
                                        <input id="divicionesadd" name="divicionesadd" type="number" class="form-control mg-md-l-10 mg-t-10 mg-md-t-0"
                                            placeholder="Diviviones">
                                        <button onclick="saveaddplus()" type="button"
                                            class="btn btn-success  pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <p>COLORES AGREGADOS A LA TRANSFORMACIÓN</p>
                                <div id="datepluscolor" name="datepluscolor"></div>
                            </div>
                            <hr style="color: black; background-color:#D7D6D6; width:100%;" />
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo articulo Etiquetas: <span
                                        class="tx-danger">*</span></label>
                                <div id="bscodigoetiq" name="bscodigoetiq"></div>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label class="form-control-label label2">Descripción:</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="descripeti" id="descripeti" placeholder="Ingresa la Descripción" disabled>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Hojas: <span class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="artdescriphojas" id="artdescriphojas"
                                    placeholder="Ingresa el numero de hojas">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">División: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="division" id="division" placeholder="Ingresa la cantidad a dividir">
                            </div>
                        </div><!-- col-4 -->
                        <br>
                        <br>
                        <label class="ckbox">
                            <input style="size:25px" onchange="artextra()" id="artxtra" name="artxtra"
                                type="checkbox"><span class="tx-purple" style="font-size: 20px">Selecciona si tiene
                                articulos extra esta trasfromación</span>
                        </label>
                        <div class="col-lg-12">
                            <h4 style="display:none" id="xtra" name="xtra" class="tx-primary">Articulos extra</h4>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartontex" name="cartontex" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary"
                                    style="font-size:20px">Cartón</label>
                                <select class="form-control select2" data-placeholder="Elija si aplioca o no"
                                    onchange="carton()" id="cartonapl" name="cartonapl" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0" selected>SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="carton" name="carton" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de Carton:</label>
                                <select onchange="carton()" class="form-control select2-show-search" data-placeholder="Seleccione"
                                    id="codcarton" name="codcarton" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0" selected>CODIGO</option>
                                    <?php while($idpst = mysqli_fetch_row($articulo)):?>
                                    <option value="<?php echo $idpst[0]?>"><?php echo $idpst[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartondes" name="cartondes" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">División carton</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="descarton" id="descarton" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonmilt" name="cartonmilt" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica carton</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcarton" id="multcarton" placeholder="Ingresa">
                            </div>
                        </div><!-- col-3 -->
                        <!-- cartonsillo -->
                        <div class="col-lg-3" id="cartonsitex" name="cartonsitex" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary" style="font-size:20px">Cartonsillo
                                    <span class="tx-danger">*</span></label>
                                <select class="form-control select2" data-placeholder="Elija si aplioca o no"
                                    onchange="cartonsillo()" id="cartaplic" name="cartaplic" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0" selected>SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonsillo" name="cartonsillo" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de Cartonsillo:</label>
                                <select onchange="" class="form-control select2-show-search" data-placeholder="Seleccione"
                                    id="codcartonsillo" name="codcartonsillo" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0" selected>CODIGO</option>
                                    <?php while($idpst2 = mysqli_fetch_row($articulo2)):?>
                                    <option value="<?php echo $idpst2[0]?>"><?php echo $idpst2[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonsillodes" name="cartonsillodes" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">División cartonsillo</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="descartonsillo" id="descartonsillo" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="cartonsillomilt" name="cartonsillomilt" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica cartonsillo</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcartonsillo" id="multcartonsillo" placeholder="Ingresa">
                            </div>
                        </div><!-- col-3 -->
                        <!-- caple -->
                        <div class="col-lg-3" id="caplearex" name="caplearex" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary" style="font-size:20px">Caple</label>
                                <select class="form-control select2" data-placeholder="Elija si aplioca o no" 
                                    onchange="caple()" id="capleaplic" name="capleaplic" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0" selected>SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="caple" name="caple" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de Caple:</label>
                                <select onchange="" class="form-control select2-show-search" data-placeholder="Seleccione" id="codcaple"
                                    name="codcaple" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0" selected>CODIGO</option>
                                    <?php while($idpst3 = mysqli_fetch_row($articulo3)):?>
                                    <option value="<?php echo $idpst3[0]?>"><?php echo $idpst3[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="capledes" name="capledes" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">División caple</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="descaple" id="descaple" placeholder="Ingresa">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="caplemilt" name="caplemilt" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica caple</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multcaple" id="multcaple" placeholder="Ingresa">
                            </div>
                        </div><!-- col-3 -->
                        <!-- liston/cordon -->
                        <div class="col-lg-3" id="listonarex" name="listonarex" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2 tx-primary"
                                    style="font-size:20px">Listón/Cordon</label>
                                <select class="form-control select2" data-placeholder="Elija si aplioca o no"
                                    onchange="liston()" id="listonaplic" name="listonaplic" type="text"
                                    data-live-search="true" style="width: 100%">
                                    <option value="0" selected>SELECCIONE</option>
                                    <option value="APLICA">APLICA</option>
                                    <option value="NO APLICA">NO APLICA</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-3" id="liston" name="liston" style="display:none">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo de listón:</label>
                                <select onchange="" class="form-control select2-show-search" data-placeholder="Seleccione" id="codliston"
                                    name="codliston" type="text" data-live-search="true" style="width: 100%">
                                    <option value="0" selected>CODIGO</option>
                                    <?php while($idpst4 = mysqli_fetch_row($articulo4)):?>
                                    <option value="<?php echo $idpst4[0]?>"><?php echo $idpst4[0]?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <!-- col-4 -->
                        <div class="col-lg-3" id="listonmilt" name="listonmilt" style="display:none">
                            <div class="form-group" style="display:">
                                <label class=" form-control-label label2">multiplica listón</label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="multliston" id="multliston" placeholder="Ingresa">
                            </div>
                        </div><!-- col-3 -->
                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size 14px;"
                            onclick="addtransform()">AGREGAR</button>
                    </div><!-- form-layout-footer -->
            </div><!-- row -->
            </form>
            <br>
            <div style="display:none;" id="dubliartras" name="dubliartras" class="alert alert-warning" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="vaciosartras" name="vaciosartras" class="alert alert-info" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
            <div style="display:none;" id="errartras" name="errartras" class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte tecnico o levantar
                        un ticket</span>
                </div><!-- d-flex -->
            </div><!-- alert -->
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
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../controller/js/catalogos.js"></script>

    <script src="../template/js/bracket.js"></script>
    <script>
    //$('#Tcodigo1').select2();
    $(document).ready(function() {
        $('#bsfinal').load('select/final.php');
        $('#bscodigoetiq').load('select/etiquetas.php');
        $('#bscodigoext').load('select/extendido.php');
        $('#codcarton').select2();
    });
    </script>

</body>

</html>
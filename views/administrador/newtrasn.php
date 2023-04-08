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
                        <div id="line" name="line" class="col-lg-12">
                            <hr style="color: black; background-color:#D7D6D6; width:100%;" />
                        </div>
                        <div class="col-lg-12">
                            <label class="form-control-label label2 tx-primary" style="font-size:20px">Articulos para la
                                trasformación</label>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Selecciona el articulo: <span
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
                        <div class="col-lg-12" id="addpluscolor" name="addpluscolor">
                            <div class="" style="color:#03925C">
                                AGREGAR LOS DETALLES DE LOS COLORES
                                <div
                                    class="d-flex align-items-center justify-content-end bg-gray-100 ht-md-80 bd pd-x-20 mg-t-10">
                                    <div class="d-md-flex pd-y-20 pd-md-y-0">
                                        <select class="form-control select" name="type_art" id="type_art">
                                            <option value="">Seleccionar</option>
                                            <option value="EXTENDIDO">EXTENDIDO</option>
                                            <option value="ETIQUETAS">ETIQUETAS</option>
                                            <option value="CARTON">CARTON</option>
                                            <option value="CARTONSILLO">CARTONSILLO</option>
                                            <option value="CAPLE">CAPLE</option>
                                            <option value="LISTON_CORDÓN">LISTON/CORDÓN</option>
                                            <option value="MINAGRIS">MINAGRIS</option>
                                        </select>
                                        <input id="multiplicadd" name="multiplicadd" type="number" class="form-control mg-md-l-10 mg-t-10 mg-md-t-0"
                                            placeholder="Multiplicación">
                                        <input id="divicionesadd" name="divicionesadd" type="number"
                                            class="form-control mg-md-l-10 mg-t-10 mg-md-t-0" placeholder="Divición">
                                        <button onclick="saveaddplus()" type="button"
                                            class="btn btn-success  pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0 tx-uppercase tx-11 tx-spacing-2">Agregar</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="col-lg-12">
                                <p>LISTA DE ARTICULOS AGREGADOS A LA TRANSFORMACIÓN</p>
                                <div id="datepluscolor" name="datepluscolor"></div>
                            </div>
                        </div><!-- col-4 -->
                        <br>
                        <br>
                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="button" id="214none" name="214none" class="btn btn-info" style="background-color:#1774D8; font-size:14px;display:none"
                            onclick="addtransform()">FINALIZAR</button>
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
        $('#mingrisid').select2();
    });
    </script>

</body>

</html>
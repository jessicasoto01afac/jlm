<!DOCTYPE html>
<?php 
include ("../controller/conexion.php");

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
  .swal-wide{
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

<body>
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
                                    name="artdescriphojas" id="artdescriphojas" placeholder="Ingresa el numero de hojas">
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

                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size 14px;"
                            onclick="addtransform()">AGREGAR</button>
                    </div><!-- form-layout-footer -->
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
    $(document).ready(function(){
        $('#bsfinal').load('select/final.php');
        $('#bscodigoetiq').load('select/etiquetas.php');
        $('#bscodigoext').load('select/extendido.php');
    });

    </script>
    
</body>

</html>
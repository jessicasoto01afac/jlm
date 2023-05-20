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
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
    <!-- librerias anexas -->
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/demo.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>

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
                <a class="breadcrumb-item" href="../administrador/articulos.php">Articulos</a>
                <span class="breadcrumb-item active">Alta de Articulo</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
            <h4 class="tx-gray-800 mg-b-5">ALTA DE ARTICULOS</h4>
        </div>
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <form id="altarticulos" method="POST">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Codigo: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="artcodigo" id="artcodigo" placeholder="Ingresar el codigo">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">Stock Inicial: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="number"
                                    name="stockini" id="stockini" placeholder="Ingresar el stock inicial">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label label2">Descripción: <span
                                        class="tx-danger">*</span></label>
                                <input onkeyup="mayus(this);" class="form-control inputalta" type="text"
                                    name="artdescrip" id="artdescrip" placeholder="Ingresa la Descripción">
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-4-force">
                                <label class="form-control-label label2">UBICACIÓN: <span
                                        class="tx-danger">*</span></label>
                                <select class="form-control inputalta" id="artubicac" name="artubicac">
                                    <option value="">SELECCIONA UNA OPCIÓN</option>
                                    <option value="ALMACEN">ALMACEN</option>
                                    <option value="BODEGA">BODEGA</option>
                                    <option value="EMPAQUE">EMPAQUE</option>
                                    <option value="COMPRAS">COMPRAS</option>
                                    <option value="TALLER DE CORTE">TALLER DE CORTE</option>
                                    <option value="TALLER DE CORTE">TALLER DE MEDICIÓN</option>
                                </select>
                            </div>
                        </div><!-- col-8 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label label2">UNIDAD:<span class="tx-danger">*</span></label>
                                <select type="text" class="form-control inputalta" name="artunidad" id="artunidad"
                                    data-placeholder="Eliga una opción">
                                    <option value="">ELEGIR UNA OPCIÓN</option>
                                    <option value="BOLSA">BOLSA</option>
                                    <option value="CAJA">CAJA</option>
                                    <option value="FCO.">FCO.</option>
                                    <option value="HOJAS">HOJAS</option>
                                    <option value="JUEGO">JUEGO</option>
                                    <option value="KILO">KILO</option>
                                    <option value="METRO">METRO</option>
                                    <option value="MILLAR">MILLAR</option>
                                    <option value="PAQUETE">PAQUETE</option>
                                    <option value="PIEZA">PIEZA</option>
                                    <option value="ROLLO">ROLLO</option>
                                    <option value="OTROS">OTROS</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group mg-b-4-force">
                                <label class="form-control-label label2">Grupo: <span class="tx-danger">*</span></label>
                                <select class="form-control inputalta" id="artgrupo" name="artgrupo">
                                    <option value="">SELECCIONA UNA OPCIÓN</option>
                                    <option value="P.TERMINADO">P.TERMINADO</option>
                                    <option value="EXTENDIDO">EXTENDIDO</option>
                                    <option value="INSUMOS">INSUMOS</option>
                                </select>
                            </div>
                        </div><!-- col-4 -->
                        
                    </div><!-- row -->
                    <div class="form-layout-footer">
                        <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size:14px;"
                            onclick="addarticull()">ACEPTAR</button>
                    </div><!-- form-layout-footer -->
                </form>
                <br>
                <div style="display:none;" id="dubliar" name="dubliar" class="alert alert-warning" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="vaciosar" name="vaciosar" class="alert alert-info" role="alert">
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                    </div><!-- d-flex -->
                </div><!-- alert -->
                <div style="display:none;" id="errar" name="errar" class="alert alert-danger" role="alert">
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
    $(function() {
        'use strict'

        $('.form-layout .form-control').on('focusin', function() {
            $(this).closest('.form-group').addClass('form-group-active');
        });

        $('.form-layout .form-control').on('focusout', function() {
            $(this).closest('.form-group').removeClass('form-group-active');
        });

        // Select2
        $('#select2-a, #select2-b').select2({
            minimumResultsForSearch: Infinity
        });

        $('#select2-a').on('select2:opening', function(e) {
            $(this).closest('.form-group').addClass('form-group-active');
        });

        $('#select2-a').on('select2:closing', function(e) {
            $(this).closest('.form-group').removeClass('form-group-active');
        });

    });
    
    </script>
</body>

</html>
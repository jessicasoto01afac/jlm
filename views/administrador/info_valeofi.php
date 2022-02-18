<!DOCTYPE html>
<?php 
include ("../controller/conexion.php");
?>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png"/>

    <!-- Meta -->
    <meta name="author" content="Jessica Soto">

    <title>JLM|Info vale oficina</title>

    <!--  css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet"> 
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
    <!-- js -->
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script src="../controller/js/vales.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="../controller/js/catalogos.js"></script>
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/card.css">
  </head>
  <body>
  

<?php
  include('header.php');
?>
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
            <h6 class="">INFORMACIÓN DEL VALE</h6>
                <div class="br-section-wrapper">
                    <form id="info-valofi" method="POST">
                        <div class="form-layout form-layout-2">
                            <div class="row no-gutters"> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="infid" id="infid">
                                        <label class="form-control-label">FOLIO: <span class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingresa el Folio"> -->
                                        <label class="form-control-label" id="fvofi" name="fvofi" style="font-size: 24px;px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label">Fecha: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="date" name="lastname" value="McDoe" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force">TIPO DE VALE: <span class="tx-danger">*</span></label>
                                        <select id="select2-a" class="form-control" data-placeholder="Choose country">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="INTERNO">INTERNO</option>
                                            <option value="VENTA">VENTA</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label">SOLICITANTE: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="address" value="Market St., San Francisco" placeholder="Enter address">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-4">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force">ESTATUS: <span class="tx-danger">*</span></label>
                                        <select id="select2-a" style="font-size:14px; color:#14128F" class="form-control">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="SURTIDO">SURTIDO</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <br>
                            </div><!-- row -->
                            <br> 
                                <h6 class="col-md-4 mg-t--1 mg-md-t-0">ARTICULOS</h6>
                                <br> 
                                <div id="listvalofi">
                        </div><!-- form-layout -->
                    </form>
                    
                </div>
        </div><!-- br-pagebody -->
      <footer class="br-footer">
        <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2022. Derechos reservados a JLM.</div>
          <div>Jose Luis Mondragon y CIA.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <a target="_blank" class="pd-x-5" href="http://www.facebook.com/JLMPAPELERA"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i class="fa fa-globe tx-20"></i></a>
        </div>
      </footer>
    </div><!-- br-mainpanel -->
    </section>
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
    <script src="../template/lib/datatables/jquery.dataTables.js"></script>
    <script src="../template/lib/datatables-responsive/dataTables.responsive.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../template/js/bracket.js"></script>
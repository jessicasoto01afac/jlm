<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png"/>


    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>JLM|Memos</title>

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
    <script src="../controller/js/memos.js"></script>

  </head>

  <body>

  <body>
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
        <h4 class="tx-gray-800 mg-b-5">MEMOS</h4>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <a class="btn btn-primary" href="../administrador/newmemo.php" style="float:right"><i class="fa fa-list-alt mg-r-10"></i>Agregar memo</a>
          <br>   
          <br> 
          <br> 
          <table class="display table table-striped dataTable responsive no-footer dtr-inline" id="example"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width:5%;">ID</th>
                                                <th>FOLIO</th>
                                                <th>FECHA</th>
                                                <th>DEPARTAMENTO</th>
                                                <th>PEDIDO</th>
                                                <th>ESTATUS</th>
                                                <th>ACCIONES</th>
                                                <!-- <th>ESTATUS</th> -->
                                                <!-- <th style="width:15%; display: none;">ACCIÓN</th> -->
                                            </tr>
                                        </thead>
                                    </table>
        </div><!-- br-section-wrapper -->
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
<!------------------------------- ########## DETALLES DEL VALE ########## -------------------------->
<section class="content" id="detamemos" style="display: none;">
    <!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="../administrador/memos.php">Lista de memos</a>
          <span class="breadcrumb-item active">Info de memo</span>
        </nav>
    </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div  style="float: right;">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button onclick="editvaleof()" id="openedimem1" title="Dar clic para editar" type="button" class="btn btn-secondary btn btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="closedithvo()" id="closememo" title="Dar clic para cerrar edición" type="button" style="display:none;" class="btn btn-secondary btn-danger"><i class="fa fa-times"></i></button>
                <button title="Imprimir" type="button" class="btn btn-secondary"><i class="fa fa-file-pdf-o"></i></button>
              </div>
            </div><!-- col-5 -->
          <div class="br-section-wrapper">

                <h6 class="">INFORMACIÓN DEL MEMO</h6>
                    <form id="info-memo" method="POST">
                      
                        <div class="form-layout form-layout-2">
                          
                            <div class="row no-gutters">
                               
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="infid" id="infid">
                                        <label class="form-control-label">FOLIO: <span class="tx-danger">*</span></label>
                                        <!-- <input class="form-control" type="text" id="folio" name="folio" placeholder="Ingresa el Folio"> -->
                                        <label class="form-control-label" id="folmemo" name="folmemo" style="font-size: 24px;px; color:#14128F"></label>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label">Fecha: <span class="tx-danger">*</span></label>
                                        <input class="form-control" readonly type="date" id="infecmem" name="infecmem" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label mg-b-0-force">TIPO DE MEMO: <span class="tx-danger">*</span></label>
                                        <select id="intipomemo" disabled="" name="intipomemo" class="form-control" data-placeholder="Choose country">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="TRASPASO">TRASPASO</option>
                                            <option value="TRANSFORMACIÓN">TRANSFORMACIÓN</option>
                                        </select>
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-8">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label">DEPARTAMENTO SOLICITANTE: <span class="tx-danger">*</span></label>
                                        <input class="form-control" readonly id="infsolimem" name="infsolimem" type="text" name="address" placeholder="Enter address">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-4">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force">ESTATUS: <span class="tx-danger">*</span></label>
                                        <select id="infestamem" disabled="" name="infestamem" style="font-size:18px; color:#14128F" class="form-control">
                                            <option value="" selected>SELECCIONA UNA OPCIÓN</option>
                                            <option value="PENDIENTE">PENDIENTE</option>
                                            <option value="SURTIDO">SURTIDO</option>
                                            <option value="FINALIZADO">FINALIZADO</option>
                                            <option value="CANCELADO">CANCELADO</option>
                                            <option value="AUTORIZADO">AUTORIZADO</option>
                                        </select>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                          <button id="btnautoriz" name="btnautoriz" type="button" style="display:none;" onclick="autorizarm()" class="btn btn-info pd-x-30">Autorizar</button>
                                          <button title="Dar click para liberar" id="btnliberar" name="btnliberar" type="button" style="display:none;" onclick="" class="btn btn-dark pd-x-25">Liberar</button>
                                          <button id="btnsurtir" name="btnsurtir" type="button" style="display:none;" onclick="surtirme()" class="btn btn-indigo pd-x-25">Surtir</button>
                                          <button id="btnfinaliz" name="btnfinaliz" type="button" style="display:none;" onclick="finalimemo()" class="btn btn-success pd-x-25">Finalizar</button>
                                        </div>
                                    </div>
                                    
                                </div><!-- col-4 -->
                                <br>
                            </div><!-- row -->
                            <div class="modal-footer">
                              <button type="button" onclick="savevofic()" id="voedith" style="display:none;" class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium">GUARDAR CAMBIOS</button>
                            </div>
                            <br>
                            <div style="display:none;" id="edthvoiexi" name="edthvoiexi" class="alert alert-warning" role="alert">
                              <div class="d-flex align-items-center justify-content-start">
                                <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                              </div><!-- d-flex -->
                            </div><!-- alert --> 
                            <div style="display:none;" id="edthvoivacios" name="edthvoivacios" class="alert alert-info" role="alert">
                              <div class="d-flex align-items-center justify-content-start">
                                <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                                <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                              </div><!-- d-flex -->
                            </div><!-- alert --> 
                            <div style="display:none;" id="edthvoierror" name="edthvoierror" class="alert alert-danger" role="alert">
                              <div class="d-flex align-items-center justify-content-start">
                                <i class="icon ion-ios-close alert-icon tx-24"></i>
                                <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un ticket</span>
                              </div><!-- d-flex -->
                            </div><!-- alert --> 
                            <div >
                              <button type="button" onclick="masarticvo()" data-toggle='modal' style="display:none; background-color: #009C28;" data-target='#modal-editavo1' onclick="" id="voagartic" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-plus"></i>  AGREGAR ARTICULO</button>
                            </div>
                            <div class="col-lg-12">
                              <div id="listmemo1">
                              </div><!-- col-12 -->
                            </div><!-- form-layout -->
                            <h5 id="trans" name="trans" style="text-align: center"></h5>  
                            <div class="col-lg-12">
                              <div id="listmemo2">
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
    var table = $('#example').DataTable({

"language": {
    "searchPlaceholder": "Buscar datos...",
    "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
},
"order": [
    [6, "DESC"]
],
"ajax": "../controller/php/infmemos.php",
"columnDefs": [{
  //  "targets": -1,
   // "data": null,
    //"defaultContent": ""

}]
});


      

    </script>

    
  </body>

</html>


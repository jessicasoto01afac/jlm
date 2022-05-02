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

    <title>JLM|Info de pedido</title>

    <!-- vendor css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/datatables/jquery.dataTables.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
    <script src="../controller/js/pedidos.js"></script>
  </head>
  <style>


  </style>

<body class="collapsed-menu">

  <?php

include('header.php');
?>
<section class="content" id="listaped">
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Pedidos</h4>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <a class="btn btn-primary" href="infpedido.php" style="float:right"><i class="fa fa-user-plus mg-r-10"></i>Agregar Pedido</a>
          <br>   
          <br> 
          <br> 
            <div id="lispedidos">
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
    <!------------------------------- ########## DETALLES DEL PEDIDO ########## -------------------------->
<section class="content" id="dettpedido" style="display: none;">
    <!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="../administrador/listpedido.php">Lista de pedidos</a>
          <span class="breadcrumb-item active">Info de pedido</span>
        </nav>
    </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div  style="float: right;">
              <div class="btn-group" role="group" aria-label="Basic example">
                <button onclick="editpediinf()" id="openedipi" title="Dar clic para editar" type="button" class="btn btn-secondary btn btn-warning"><i class="fa fa-edit"></i></button>
                <button onclick="closedithpin()" id="closepedi" title="Dar clic para cerrar edición" type="button" style="display:none;" class="btn btn-secondary btn-danger"><i class="fa fa-times"></i></button>
              </div>
            </div><!-- col-5 -->
                        <div class="br-section-wrapper">
                          <h6 class="">INFORMACIÓN DEL PEDIDO:</h6>
                          <form id="info-valofi" method="POST">
                          <div class="form-group">
                            <div class="col-md-4 mg-t--1 mg-md-t-0">
                              
                            </div>
                            <div class="row mg-b-25">  
                                        <div class="col-sm-9">
                                        <h3><label for="" id="idinped" name="idinped" style="color:#14128F"></label></h3>
                                        </div>
                                        <div class="col-sm-3">
                                          <button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PENDIENTE</button>
                                        </div>
                                        <div class="col-sm-12">
                                        <label for="" id="" name="" style="">CLIENTE:</label>
                                        <input class="form-control" readonly id="infclinte" name="infclinte" type="text" name="address" placeholder="">

                                        </div>
                                        <div class="col-sm-4">
                                        
                                        </div>
                                                                              
                                        </div>
                                        </div>
                                    
                            <div class="form-layout form-layout-1">      
                              <div class="row mg-b-25">     
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <input style="display:none;" disabled="" class="form-control inputalta" type="text" name="infid" id="infid">
                                    <label class="form-control-label">REMISIÓN: <span class="tx-danger">*</span></label>   
                                    <input class="form-control" disabled="" type="text" name="inforemision" id="inforemision" placeholder="Ingrese la Remisión">
                                </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label">FECHA DE INGRESO: <span class="tx-danger">*</span></label>
                                        <input class="form-control" disabled="" type="date" id="inffcingr" name="inffcingr" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group mg-md-l--1">
                                        <label class="form-control-label">FECHA DE ENTREGA: <span class="tx-danger">*</span></label>
                                        <input class="form-control" disabled="" type="date" id="inffecentre" name="inffecentre" placeholder="Enter lastname">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-md-8 mg-t--1 mg-md-t-0">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label">ANTENDIO: <span class="tx-danger">*</span></label>
                                        <input class="form-control" disabled="" id="infaten" name="infaten" type="text"placeholder="Enter address">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-4 mg-t--1 mg-md-t-0">
                                    <div class="form-group bd-t-0-force">
                                        <label class="form-control-label">LUGAR: <span class="tx-danger">*</span></label>
                                        <input class="form-control" disabled="" id="influgar" name="influgar" type="text" placeholder="Enter address">
                                    </div>
                                </div><!-- col-8 -->
                                <div class="col-md-12">
                                    <div class="form-group mg-md-l--1 bd-t-0-force">
                                        <label class="form-control-label mg-b-0-force">DIRECCIÓN: <span class="tx-danger">*</span></label>
                                        <textarea class="form-control" id="infdirec" name="infdirec" disabled="" rows="2"></textarea>
                                    </div>
                                </div><!-- col-4 -->
                            </div><!-- row -->
                            <div class="form-layout-footer">
                              <button class="btn btn-info">Finalizar</button>
                              <button id="cancelpe" style="display:none;" class="btn btn-secondary">Cancelar pedido</button>
                              <button type="button" onclick="masarticvo()" data-toggle='modal' style="display:none; background-color: #08D876;" data-target='#modal-editavo1' onclick="" id="addarticp" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-plus"></i>  Agregar Articulo</button>
                            </div><!-- form-layout-footer -->
                          </div>
                    </form>
                    <br>
                            <h6 class="col-md-4 mg-t--1 mg-md-t-0">ARTICULOS</h6>
                            <br> 
                            <div class="col-lg-12">
                              <div id="listpedidinf"></div><!-- col-12 -->
                            </div><!-- form-layout -->  
                
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

    <?php include('../administrador/modal.php');?>
    <script>
       $.ajax({
        url: '../controller/php/pedidoslist.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="table-wrapper"><table style="width:100%" id="datapedido" name="datapedido" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>ID</th><th><i></i>NOMBRE DEL CLIENTE</th><th style="width:100px;"><i></i>RFC</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {  
                x++;

                id_per = "este es la person" //indentificacion de la person
                
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].refe_1 + "</td><td>" + obj.data[U].proveedor_cliente + "</td><td>" + obj.data[U].status +"</td><td>" + "<a onclick='infpedido()' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";            
        }
        html += '</div></tbody></table></div></div>';
        $("#lispedidos").html(html);
        'use strict';
        $('#datapedido').DataTable({
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

    $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
    
      $(function(){
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
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });

      

    </script>

    
  </body>

</html>

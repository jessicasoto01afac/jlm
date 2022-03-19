<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png"/>
    <title>JLM|Historial</title>

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
  </head>

  <body>

  <body>
  <?php

include('header.php');
?>
<style>
table tr td {
    width: 1%;
    white-space: nowrap;
}
    
    
</style>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">HISTORIAL DE CAMBIOS</h4>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <br>   

            <div id="listhisc">
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
    <script src="../controller/js/catalogos.js"></script>
    <script src="../template/js/bracket.js"></script>

    <?php include('../administrador/modal.php');?>
    <script>
       $.ajax({
        url: '../controller/php/historia.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="table-wrapper"><table style="width:100%;" name="hicambios" id="hicambios" class="table display responsive nowrap dataTable no-footer dtr-inline" style="width:100%; display:block; overflow-x:auto; white-space:nowrap;"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>USUARIO</th><th style="width:100px;"><i></i>PROCESO</th><th><i></i>REGISTRO</th><th><i></i>FECHA</th></tr></thead><tbody>';
        for (V = 0; V < res.length; V++) {  
                x++;
                html += "<tr><td>" + obj.data[V].id_his + "</td><td>" + obj.data[V].id_usu + "</td><td>" + obj.data[V].proceso + "</td><td>" + obj.data[V].registro + "</td><td>" + obj.data[V].fecha + "</td></tr>";            
        }
        html += '</div></tbody></table></div>';
        $("#listhisc").html(html);
        'use strict';
        $('#hicambios').DataTable({
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

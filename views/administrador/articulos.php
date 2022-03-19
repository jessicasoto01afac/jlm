<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png"/>
    <title>JLM|Articulos</title>

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

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">ARTICULOS</h4>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <a class="btn btn-primary" href="../administrador/newarticul.php" style="float:right"><i class="fa fa-plus mg-r-10"></i>Agregar Articulo</a>
          <br>   
          <br> 
          <br> 
            <div id="listartic">
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
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="table-wrapper"><table style="width:100%" name="arttable" id="arttable" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:100px;"><i></i>DESCRIPCIÓN</th><th><i></i>UBICACION</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (V = 0; V < res.length; V++) {  
                x++;
                html += "<tr><td>" + obj.data[V].id_art + "</td><td>" + obj.data[V].artcodigo + "</td><td>" + obj.data[V].artdescrip + "</td><td>" + obj.data[V].artubicac + "</td><td>" + "<a style='cursor:pointer;' onclick='artedith()' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editarticul'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletart()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleteart'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";            
        }
        html += '</div></tbody></table></div></div>';
        $("#listartic").html(html);
        'use strict';
        $('#arttable').DataTable({
            responsive: true,
            language: {
              searchPlaceholder: 'Buscar...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
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

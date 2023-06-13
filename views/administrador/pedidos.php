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

    <title>JLM|Pedidos</title>

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

  <body class="collapsed-menu">


      <style>
          .formulario__grupo-terminos,
.formulario__mensaje,
.formulario__grupo-btn-enviar {
    grid-column: span 2;
}

.formulario__mensaje {
    height: 45px;
    line-height: 45px;
    background: #F66060;
    padding: 0 15px;
    border-radius: 3px;
    display: none;
}

.formulario__mensaje-activo {
    display: block;
}

.formulario__mensaje p {
    margin: 0;
}

.formulario__grupo-btn-enviar {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.formulario__btn {
    height: 45px;
    line-height: 45px;
    width: 30%;
    background: #000;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: .1s ease all;
}

.formulario__btn:hover {
    box-shadow: 3px 0px 30px rgba(163, 163, 163, 1);
}

.formulario__mensaje-exito {
    font-size: 14px;
    color: #119200;
    display: none;
}

.formulario__mensaje-exito-activo {
    display: block;
}


/* ----- -----  Estilos para Validacion ----- ----- */

.formulario__grupo-correcto .formulario__validacion-estado {
    color: #1ed12d;
    opacity: 1;
}

.formulario__grupo-incorrecto .formulario__label {
    color: #bb2929;
}

.formulario__grupo-incorrecto .formulario__validacion-estado {
    color: #bb2929;
    opacity: 1;
}

.formulario__grupo-incorrecto .formulario__input {
    border: 3px solid #bb2929;
}


/* ----- -----  Mediaqueries ----- ----- */

@media screen and (max-width: 800px) {
    .formulario {
        grid-template-columns: 1fr;
    }
    .formulario__grupo-terminos,
    .formulario__mensaje,
    .formulario__grupo-btn-enviar {
        grid-column: 1;
    }
    .formulario__btn {
        width: 100%;
    }
}


      </style>
  <?php

include('header.php');
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="listpedido.php">Lista de Pedidos</a>
          <span class="breadcrumb-item active">Importacion de layout</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Importacion de Layout pedidos</h4>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
        <div class="box">
           <div class="box-header">
           
              <a href="../../docs/layout_pedidos.csv" download="Layout_masivo" class="btn btn-primary" style="float:right"><i class="fa fa-download mg-r-10"></i>Descargar archivo cvs</a>
             
                <div class="col-md-8 col-md-offset-0">
                    <h5>IMPORTA EL DOCUMENTO</h5>
                    <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data"/>
	                <!-- COMPONENT START -->
	                    <div class="">
                            <input  type="file" accept=".csv" name="dataCliente" id="file-input" class=""/>
                        </div>
                        <br>
                        <a href="" class="btn btn-primary btn-with-icon">
                            <div class="ht-40 justify-content-between">
                                <input type="submit" name="subir" class="btn-enviar pd-x-15" value="IMPORTAR ARCHIVO "/>
                                <span class="icon wd-40"><i class="fa fa-send"></i></span>
                            </div>
                        </a>
                        <!-- <div class="mt-5">
                            <input type="submit" name="subir" class="btn-enviar pd-x-15" value="IMPORTAR ARCHIVO "/>
                       </div> -->
                    </form>
                </div>
                <hr/>
                <br>
                <br>
                <button id="exportar" style="display:none">Exportar</button>
            </div>
        </div>
        <div class="row">
           <div class="col-md-12">
          <!-- Custom Tabs -->
               <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <h4>Contenido del archivo:</h4>
                        <div id="tablares"></div>
                    </div>
              <!-- /.tab-pane -->
                </div>
            </div>

        <!-- /.col -->
    </section>
</div>

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
    $('#masivo').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior",
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"         
        },
    },
});     

function exportar (data, fileName) {
      const a = document.createElement("a");
      const contenido = data,
      blob = new Blob([contenido], {type: "octet/stream"}),
          url = window.URL.createObjectURL(blob);
      a.href = url;
      a.download = fileName;
      a.click();
      window.URL.revokeObjectURL(url);
      
    };

    document.querySelector('#exportar').onclick = function () {
      const data = document.querySelector('#texto-archivo').value;
      const nombreArchivo = 'ejemplo.txt'
      exportar(data, nombreArchivo);
    }

    /**
    * Importar y operar con .csv
    **/
    function crearTabla(data) {
      const todasFilas = data.split(/\r?\n|\r/);
      let tabla = '<table class="table table-striped" style="width:100%; display:block; overflow-x:auto; white-space:nowrap;">';
      for (let fila = 0; fila < todasFilas.length; fila++) {
        if (fila === 0) {
          tabla += '<thead class="thead-colored thead-info">';
          tabla += '<tr>';
        } else {
          tabla += '<tr>';
        }
        const celdasFila = todasFilas[fila].split(',');
        for (let rowCell = 0; rowCell < celdasFila.length; rowCell++) {
          if (fila === 0) {
            tabla += '<th>';
            tabla += celdasFila[rowCell];
            tabla += '</th>';
          } else {
            tabla += '<td>';
            if (rowCell === 50) {
              tabla += '<img src="'+celdasFila[rowCell]+'">';
            } else {
              tabla += celdasFila[rowCell];
            }
            tabla += '</td>';
          }
        }
        if (fila === 0) {
          tabla += '</tr>';
          tabla += '</thead>';
          tabla += '<tbody>';
        } else {
          tabla += '</tr>';
        }
      } 
      tabla += '</tbody>';
      tabla += '</table>';
      document.querySelector('#tablares').innerHTML = tabla;
    }

    function leerArchivo2(evt) {
      let file = evt.target.files[0];
      let reader = new FileReader();
      reader.onload = (e) => {
        // Cuando el archivo se terminó de cargar
        crearTabla(e.target.result)
      };
      // Leemos el contenido del archivo seleccionado
      reader.readAsText(file);
    }
    document.querySelector('#file-input')
      .addEventListener('change', leerArchivo2, false);

    /**
     * Leer y mostrar contenido inmediatamente
    **/  
    function mostrarContenido(contenido) {
        const elemento = document.getElementById('contenido-archivo');
        elemento.innerHTML = contenido;
      }
    function leerArchivo(e) {
      const archivo = e.target.files[0];
      if (!archivo) {
        return;
      }
      const lector = new FileReader();
      lector.onload = function(e) {
        const contenido = e.target.result;
        mostrarContenido(contenido);
      };
      lector.readAsText(archivo);
    }

</script>

    
  </body>

</html>

<!DOCTYPE html><?php 
include ("../conexion/conexion.php");
session_start(); 
unset($_SESSION['consulta']);
?>
<html>
<head>
<link rel="shortcut icon" href="../dist/img/iconafac.ico" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Capacitación AFAC | Importar layout</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="../dist/css/card.css">
  <link rel="stylesheet" type="text/css" href="../dist/css/contra.css">
  <script src="../dist/js/sweetalert2.all.min.js"></script>
  <link href="../dist/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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
.btn-enviar{
  color: #fff;
  font-weight: 600;
  padding: 10px 45px;
  background-color: #0f3478;
  border: none;
  border-radius: 2px;
}
.btn-enviar:hover{
    background-color: #2b61c6;
}

</style>
      </head>
      <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">

<div class="wrapper">

<?php
include('header.php');
?> 
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >

        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="./persona.php">LISTA DE PERSONAS</a>
          <span class="breadcrumb-item active">IMPORTACIÓN MASIVA</span>
        </nav>

    
<!-- Content Header (Page header) -->

   <section class="content-header">
     
      <h1> 
         <i class="fa  ion-android-person"></i>
         CARGA MASIVA / PERSONAL
      </h1>
    </section>
    <section class="content"> 
        <div class="box">
           <div class="box-header" style="">
             <a href="../dist/img/layout_personal.csv" download="Layout_masivo" class="btn btn-default pull-right" style="margin-right: 5px;"> <i class="fa fa-download"></i>Descargar archivo</a>
                <div class="col-md-8 col-md-offset-0">
                    <h4>IMPORTA EL LAYOUT</h4>
              
                    <form action="recibe_excel_validando.php" method="POST" enctype="multipart/form-data"/>
	                <!-- COMPONENT START -->
	                    <div class="">
                            <input  type="file" accept=".csv" name="dataCliente" id="file-input" class=""/>
                        </div>
                        <br>
                        <div class="mt-5">
                            <input type="submit" name="subir" class="btn-enviar" value="IMPORTAR ARCHIVO "/>
                       </div>
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
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">LISTA A IMPORTAR</a></li>
                    <li><a href="#tab_2" data-toggle="tab">LISTA DE PERSONAL</a></li>
                </ul>
               <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <h4>Contenido del archivo:</h4>
                        <div id="tablares"></div>
                    </div>
              <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <?php include('../conexion/conexion.php');
                        $sqlClientes = ("SELECT * FROM personal WHERE estado='0' ORDER BY gstIdper ASC");
                        $queryData   = mysqli_query($conexion, $sqlClientes);
                        $total_client = mysqli_num_rows($queryData);
                        ?>
                        <table id="masivo" class="table table-bordered table-striped dataTable no-footer" style="width:100%" role="grid" aria-describedby="cursextper_info">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre(s)</th>
                                    <th>Apellidos</th>
                                    <th>Numero de Empleado</th>
                                    <th>Curp</th>
                                    <th>rfc</th>
                                    <th>Correo Institucional</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $i = 1;
                                while ($data = mysqli_fetch_array($queryData)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++; ?></th>
                                    <td><?php echo $data['gstNombr']; ?></td>
                                    <td><?php echo $data['gstApell']; ?></td>
                                    <td><?php echo $data['gstNmpld']; ?></td>
                                    <td><?php echo $data['gstCurp']; ?></td>
                                    <td><?php echo $data['gstRfc']; ?></td>
                                    <td><?php echo $data['gstCinst']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
          <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </section>
</div>


  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b>    <?php 
                                $query ="SELECT 
                                        *
                                        FROM
                                        controlvers";
                                $resultado = mysqli_query($conexion, $query);

                                $row = mysqli_fetch_assoc($resultado);
                                if(!$resultado) {
                                    var_dump(mysqli_error($conexion));
                                    exit;
                                }
                                ?>
                    <?php echo $row['version']?>
    </div>

    <strong>AFAC &copy; 2021 <a style="color:#3c8dbc"  href="https://www.gob.mx/afac">Agencia Federal de Aviación Cilvil</a>.</strong> Todos los derechos Reservados DDE

</footer>

<?php include('panel.html');?>

<div class="control-sidebar-bg"></div>


<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script src="../js/global.js"></script>

 
</body>
</html>
<link rel="stylesheet" type="text/css" href="../boots/bootstrap/css/select2.css">

<script src="../js/select2.js"></script>

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
      let tabla = '<table class="table table-bordered table-striped dataTable"  style="display: block;overflow-x: auto;white-space: nowrap;">';
      for (let fila = 0; fila < todasFilas.length; fila++) {
        if (fila === 0) {
          tabla += '<thead>';
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

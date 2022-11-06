<!DOCTYPE html>
<?php 
include ("../controller/conexion.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png" />
    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="Jessica Soto">
    <title>JLM|layout Result</title>
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
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Resultados de la importación
                    </h1>
                    <div class="br-pageheader pd-y-15 pd-l-20">
                        <nav class="breadcrumb pd-0 mg-0 tx-12">
                            <a class="breadcrumb-item" href="listpedido.php">Lista de Pedidos</a>
                            <span class="breadcrumb-item active">Importacion de layout</span>
                        </nav>
                    </div><!-- br-pageheader -->
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="box box-default">
                        <table class="table table-striped">
                            <tr>
                                <th>PEDIDO</th>
                                <th>CODIGO</th>
                                <th style="width:300px">PROGRESO</th>
                                <th>ESTATUS</th>
                                <th>OBSERVACIONES</th>
                            </tr>
                            <?php
                require('../controller/conexion.php');
                session_start();
                $usuario=$_SESSION['username'];
                    if(isset($_SESSION['usuario']['id_usu'])&&!empty($_SESSION['usuario']['id_usu'])){
                        $id = $_SESSION['usuario']['id_usu'];
                    }
                    $informacion = [];
                //CONDICIONES------------------------------------------------------------------------------    
                $tipo       = $_FILES['dataCliente']['type'];
                $tamanio    = $_FILES['dataCliente']['size'];
                $archivotmp = $_FILES['dataCliente']['tmp_name'];    
                $lineas     = file($archivotmp);      
                $i = 0;
                foreach ($lineas as $linea) {
                  $cantidad_registros = count($lineas);
                  $cantidad_regist_agregados =  ($cantidad_registros - 1);
                  if ($i != 0) {
                    $datos = explode(",", $linea);
                    $proveedor_cliente     = !empty($datos[0])  ? ($datos[0]) : '';
                    $refe_1                = !empty($datos[1])  ? ($datos[1]) : '';
                    $codigo_1              = !empty($datos[2])  ? ($datos[2]) : '';
                    //$descripcion_1         = !empty($datos[3])  ? ($datos[3]) : '';
                    $cantidad_real         = !empty($datos[3])  ? ($datos[3]) : '';
                    //$fecha                 = !empty($datos[5])  ? ($datos[5]) : '';
                    if( !empty($codigo_1) && !empty($refe_1) ){
                      $checkemail_duplicidad = ("SELECT codigo_1 FROM kardex WHERE codigo_1='$codigo_1' AND refe_1='$refe_1' AND tipo	='PEDIDO'");
                      $ca_dupli = mysqli_query($conexion, $checkemail_duplicidad);
                    }   
                    //No existe Registros Duplicados
                    if ( $ca_dupli->num_rows == 0 ) {
                      $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
                      $insertarData = "INSERT INTO kardex VALUES(0,'$refe_1','0','0','$fecha','$codigo_1','','PEDIDO','ARTICULO','$proveedor_cliente','PENDIENTE',$cantidad_real,'0',$cantidad_real,'0','0','0','NA','NA','AUTORIZADO','PENDIENTE','PENDIENTE','PENDIENTE','0')";
                      mysqli_query($conexion, $insertarData);
                      ini_set('date.timezone','America/Mexico_City');
                      $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
                      //inserta en historia
                      $query = "INSERT INTO historial(id_usu,proceso,registro,fecha) SELECT '$usuario','INSERTA MASIVAMENTE PEDIDO',concat('FOLIO:','$refe_1',' ',`codigo_1`,' ',' CANTIDAD: ',`cantidad_real`,' PEDIDO: ', `refe_1` ),'$fecha' FROM kardex ORDER BY `id_kax` DESC LIMIT 1";
                      mysqli_query($conexion,$query);
                      print "
                      <tr>
                        <td>$refe_1</td>
                        <td>$codigo_1</td>
                        <td>
                          <div class='progress progress-xs progress-striped active'>
                            <div class='progress-bar progress-bar-success' style='width: 100%'></div>
                          </div>
                        </td>
                        <td><span class='badge bg-green' style='color: #0b6a05; font-size:20px;'><i class='fa fa-check'></i></span></td>
                        <td>SE IMPORTA DE FORMA CORRECTA</td>
                      </tr>";
                      //echo "<div class='callout callout-success'><h4>$nombre $apellido</h4><p>SE IMPORTAN DE FORMA.</p></div>";
                      //redirecciona
                      //$url ="./implaoyut.php";
                      //$tiempo_espera = 1; // segundos hasta la actualización.
                      //header("refresh: $tiempo_espera; url=$url");
                      /**Caso Contrario actualizo el o los Registros ya existentes*/
                    }else{
                      print "
                      <tr>
                        <td>$refe_1</td>
                        <td>$codigo_1</td>
                        <td>
                          <div class='progress progress-xs progress-striped active'>
                            <div class='progress-bar progress-bar-danger' style='width: 100%; background-color: #c60868;'></div>
                          </div>
                        </td>
                        <td><span class='badge bg-red' style='background-color: #c60868; font-size:16px;'><i class='fa fa-times'></i></span></td>
                        <td>VERIFICAR / EL ARTICULO DEL PEDIDO YA ESTA INGRESADO</td>
                      </tr>
                      ";
                    }                    
                  }
                   $i++;
                }
                //INSERTA PRODUCTIVIDAD
                if ( $ca_dupli->num_rows == 0 ) {
                  $queryprod = "INSERT INTO productividad VALUES(0,(SELECT refe_1 FROM kardex WHERE refe_1='$refe_1' GROUP BY refe_1),'$usuario','$fecha','$usuario','$fecha','PENDIENTE','','PENDIENTE','','NORMAL',0)";
                  mysqli_query($conexion,$queryprod);
                }
                ?>
                        </table>
                        <!-- /.box-bdedededddddddddddddddddddddddddddody -->
                    </div>
                    <!-- /.box -->
                </section>
                <div class="col-md-2">
                    <a type="button" href="./pedidos.php" class="btn btn-block btn-primary">REGRESAR</a>
                </div>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->
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
        <!-- <?php include('panel.html');?> -->
    </div>
</body>
</html>
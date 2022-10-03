<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT k.*, p.* ,(select a.usunom FROM accesos a where a.usuario=p.id_person_autor) as usunom, (select a.usuapell FROM accesos a where a.usuario=p.id_person_autor) as usuapell FROM kardex k, productividad p where k.refe_1=p.referencia_1 AND k.estado='0' AND k.tipo='VALE_PRODUCCION' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    //CABECERA2
$cabec = "SELECT k.*, p.* ,(select a.usunom FROM accesos a where a.usuario=p.id_person_autor) as usunom, (select a.usuapell FROM accesos a where a.usuario=p.id_person_autor) as usuapell FROM kardex k, productividad p where k.refe_1=p.referencia_1 AND k.estado='0' AND k.tipo='VALE_PRODUCCION' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resul = mysqli_query($conexion, $cabec);

//TABLA DE EXTENDIDO
$query1 = "SELECT * FROM historial WHERE registro LIKE '%$folio%' AND proceso LIKE '%VALE DE PRODUCCIÓN%' ORDER BY id_his ASC";
      $resultado1 = mysqli_query($conexion, $query1);
    //$data1 = mysqli_fetch_array($resultado1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE DE HSITORIAL <?php echo $data['refe_1']?></title>
    <link rel="shortcut icon" href="../template/img/logo.png" />
</head>
<style>
.line2 {
    border-top: 1.5px solid black;
    height: 2px;
    max-width: 235px;
    padding: 0;
    padding-top: 2%;
    margin-left: 28%;
}

.surtio {
    padding: 0;
    padding-top: 2%;
    margin-left: 60%;
}

.entrego2 {
    padding: 0;
    padding-top: 2%;
    margin-left: 66%;
}

.entrego {
    padding: 0;
    padding-top: 2%;
}

.nproduccion {
    padding: 0;
    padding-top: 2%;
    margin-left: 63%;
}

.nproduccion2 {
    padding: 0;
    padding-top: 2%;
    margin-left: 65%;
}

.urgente {
    padding: 0;
    margin-left: 91%;
}

.prelacion {
    padding: 0;
    padding-top: 2%;
    margin-left: 50%;
}

.line3 {
    border-top: 1.5px solid black;
    height: 2px;
    max-width: 360px;
    padding: 0;
    padding-top: 0%;
    margin-left: 20%;
}

.recibio {
    padding: 0;
    padding-top: 0%;
    margin-left: 60%;
}

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:white;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:20px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom-: 1px solid #C1C3D1;
  color:#676767;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}


</style>

<body>
    <img src="../template/img/logo1.jpg" style="" width="200" height="65" alt="">
  
    <p style="font-weight:bold; font-size:28px; text-align:center;padding-top:-6%;">REPORTE DE HISTORIAL</p> 
    
    <p style="font-weight:bold; font-size:23px; text-align:;padding-top:1.5%;">VALE DE PRODUCCIÓN FOLIO: <?php echo $data['refe_1']?></p>

    <!-- MATERIAL SOLICITADO-->
    <?php               
            echo '<table style="width:100%" class="table display responsive nowrap dataTable no-footer dtr-inline" id="TabLisClientes">';
                echo '<thead>';
                    echo '<tr style="background-color:#e6e6e6;">';
                        echo '<th>USUARIO</th>';
                        echo '<th>ACCIÓN</th>';
                        echo '<th>REGISTRO</th>';
                        echo '<th>FECHA</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($row = mysqli_fetch_assoc($resultado1)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row['id_usu'].'</td>';
                        echo '<td>'.$row['proceso'].'</td>';
                        echo '<td>'.$row['registro'].'</td>';
                        echo '<td>'.$row['fecha'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
            ?>
    
    
    <?php
            //require_once '../dist/dompdf/autoload.inc.php';
            require_once '../public/dompdf/autoload.inc.php';
            use Dompdf\Dompdf;
            $dompdf = new DOMPDF('1.0', 'utf-8');
            $dompdf->set_paper('letter', 'portrait');
            $dompdf->load_html(ob_get_clean());
            $dompdf->render();
            $dompdf->stream("Evaluación de Nivel I", array("Attachment" => 0));
            $pdf = $dompdf->output();
        ?>
</body>
</html>
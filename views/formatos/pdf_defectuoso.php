<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT k.*,DATE_FORMAT(fecha,'%d-%m-%Y')as date FROM kardex k where k.estado='0' AND k.tipo='MATERIAL_DEFECTUOSO' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    
    //CARCTERES SELECT LEN(MyColumna) FROM MyTabla
   $querycar = "SELECT CHAR_LENGTH(refe_1) as caracter, refe_1 FROM kardex k where k.estado='0' AND k.tipo='MATERIAL_DEFECTUOSO' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
    $resucar = mysqli_query($conexion, $querycar);

//TABLA DE EXTENDIDO
$query1 = "SELECT * FROM kardex k, articulos a where k.tipo='MATERIAL_DEFECTUOSO' AND a.artcodigo=k.codigo_1 AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
      $resultado1 = mysqli_query($conexion, $query1);
    //$data1 = mysqli_fetch_array($resultado1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMATO DE MATRIAL DEFECTUOSO <?php echo $data['refe_1']?></title>
    <link rel="shortcut icon" href="../template/img/logo.png" />
</head>
<style>
.line2 {
    border-top: 1.5px solid white;
    height: 2px;
    max-width: 235px;
    padding: 0;
    padding-top: 2%;
    margin-left: 28%;
}
.line4 {
    border-top: 1.5px solid white;
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
    margin-left: 82%;
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
    border-top: 1.5px solid white;
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

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    border-color: gray;
    width: 100%;
    border: black 1px solid;
    margin-left: auto;
    margin-right: auto;
}

tbody {
    border: black 1px solid;
}

tr {
    border: black 1px solid;
    width: 100px;
}

th {
    border: black 1px solid;
    text-align: center;
    padding: 9px;
    font-size: 18px;
    background-color: white;
}

td {
    border: black 1px solid;
    text-align: center;
    padding: 9px;
    font-size: 17px;
}
</style>

<body>
    <img src="../template/img/logo1.jpg" style="" width="200" height="65" alt="">
    <p style="font-weight:bold; font-size:32px; text-align:center; padding-top: -7.5%;"><b> JOSE LUIS MONDRAGON Y CIA SA
            DE CV
        </b></p>
    <p style="font-weight:bold; font-size:23px; text-align:center;padding-top:-2.3%;">MATERIAL DEFECTUOSO</p>

    <div class="nproduccion" style="padding-top:0%;">
        <label style="font-size:24px;">FOLIO:</label>
        <?php               
        while($row = mysqli_fetch_assoc($resucar)) {
            $active = '';
            if($row['caracter'] >= '1') {
                $active = '<label style="font-size:38px;color:blue">000' . $row['refe_1'] . '</label>';
            }else if ($row['caracter'] < '1') {
                $active = '<label style="font-size:38px;color:blue">00' . $row['refe_1'] . '</label>';
                
            }
            echo $active;
        } // Fin while 
        mysqli_close($conexion);
    ?>
        
    </div>
   
    <!-- PARTE LATERAL -->


    <!-- DESPUES DE LA LINEA -->

    <div style="padding-top:0.7%;">
        <label style="font-size:18px;">DEPARTAMENTO:</label>
        <label style="font-size:21px;"><?php echo $data['refe_2']?></label>
    </div>
    <div class="line4" style="margin-top:-.2%"></div>
    <div style="padding-top:-1.3%;">
        <label style="font-size:18px;">MOTIVO DE LA DEVOLUCIÓN:</label>
        <label style="font-size:20px;"><?php echo $data['descripcion_1']?></label>
    </div>
    <div class="line2" style="margin-top:-.2%"></div>
    <div class="surtio" style="padding-top:-7%;">
        <label style="font-size:18px;">FECHA:</label>
        <label style="font-size:24px;"><?php echo $data['date']?></label>
        <div class="line3" style="margin-top:0%"></div>
    </div>
   
    <p style="font-weight:bold; font-size:25px; text-align:center;padding-top:-.5%;">MATERIAL</p>
    <!-- MATERIAL SOLICITADO-->
    <?php               
            echo '<table class="table table-striped table-hover table-responsive cell-border" id="TabLisClientes">';
                echo '<thead>';
                    echo '<tr style="background-color:#e6e6e6;">';
                        echo '<th>CODIGO</th>';
                        echo '<th>CANTIDAD</th>';
                        echo '<th>DESCRIPCIÓN</th>';
                        echo '<th>OBSERVACIONES</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($row = mysqli_fetch_assoc($resultado1)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row['codigo_1'].'</td>';
                        echo '<td>'.$row['salida'].'</td>';
                        echo '<td>'.$row['artdescrip'].'</td>';
                        echo '<td>'.$row['observa'].'</td>';
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
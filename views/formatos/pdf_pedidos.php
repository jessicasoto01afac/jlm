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
$query1 = "SELECT * FROM kardex k, articulos a where k.tipo='VALE_PRODUCCION' AND a.artcodigo=k.codigo_1 AND k.tipo_ref='EXTENDIDO' AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
      $resultado1 = mysqli_query($conexion, $query1);
    //$data1 = mysqli_fetch_array($resultado1);
//TABLA DE ETIQUETAS
$query2 = "SELECT * FROM kardex k, articulos a where k.tipo='VALE_PRODUCCION' AND a.artcodigo=k.codigo_1 AND k.tipo_ref='ETIQUETAS' AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
      $resultado2 = mysqli_query($conexion, $query2);
    //$data2 = mysqli_fetch_array($resultado2);
//TABLA DE FINAL
$query3 = "SELECT * FROM kardex k, articulos a where k.tipo='VALE_PRODUCCION' AND a.artcodigo=k.codigo_1 AND k.tipo_ref='PRODUCTO_TERMINADO' AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
      $resultado3 = mysqli_query($conexion, $query3);
    //$data3 = mysqli_fetch_array($resultado3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMATO DE VALE DE PRODUCCIÓN <?php echo $data['refe_1']?></title>
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
    <p style="font-weight:bold; font-size:23px; text-align:center;padding-top:-2.3%;">ORDEN DE PRODUCCIÓN</p>

    <?php               
        while($row = mysqli_fetch_assoc($resul)) {
        $active = '';
        if($row['caracter_vale'] == 'URGENTE') {
            $active = '<p class="urgente" style="font-weight:bold; font-size:20px; padding-top:-2%;">URGENTE</p>';
        } else {
           $active = '';
        }
        
        $ref3 = '';
        if($row['caracter_vale'] == 'OPERADORA') {
            $ref3 = '<p class="urgente" style="font-weight:bold; font-size:20px; padding-top:-4%;">OMX</p>';
        } else {
           $ref3 = '';
        }
        
        echo $active;
        echo $ref3;
        } // Fin while 
        // Cierra la Conexión con la BD.
        mysqli_close($conexion);
    ?>



    <div>
        <label style="font-size:18px;">DEPTO.SOLICITANTE:</label>
        <label style="font-size:19px;"><?php echo $data['refe_2']?></label>
    </div>
    <div style="padding-top:0.5%;">
        <label style="font-size:18px;">FECHA DE REQUISICION:</label>
        <label style="font-size:19px;"><?php echo $data['fecha']?></label>
    </div>
    <div style="padding-top:0.5%;">
        <label style="font-size:18px;">FORMULA:</label>
        <label style="font-size:19px;"><?php echo $data['id_person_creacion']?></label>
    </div>
    <div style="padding-top:0.5%;">
        <label style="font-size:18px;">AUTORIZA:</label>
        <label style="font-size:22px;"><?php echo $data['usunom'].' '.$data['usuapell']?></label>
    </div>
    <div class="nproduccion" style="padding-top:-10.1%;">
        <label style="font-size:18px;">ORDEN DE PRODUCCIÓN No:</label>
        <label style="font-size:38px;"><?php echo $data['referencia_1']?></label>
    </div>
    <div class="nproduccion2" style="padding-top:-7%;">
        <label style="font-size:18px;">VALE DE REQUISICIÓN No:</label>
        <label style="font-size:38px;"><?php echo $data['referencia_1']?></label>
    </div>
    <div class="prelacion" style="padding-top:-2%;">
        <label style="font-size:18px;">PEDIDOS RELACIONADOS:</label>
        <label style="font-size:18px;"><?php echo $data['ubicacion']?></label>
    </div>
    <!-- PARTE LATERAL -->


    <!-- DESPUES DE LA LINEA -->
    <hr style="border: 1.5px solid #000;">
    <div style="padding-top:-0.3%;">
        <label style="font-size:18px;">MATERIAL SOLICITADO AL DEPARTAMENTO:</label>
        <label style="font-size:21px;"><?php echo $data['proveedor_cliente']?></label>
    </div>
    <div style="padding-top:0.7%;">
        <label style="font-size:18px;">FECHA DE SOICITUD DE MATERIAL:</label>
        <label style="font-size:21px;"></label>
    </div>
    <div class="line2" style="margin-top:-.2%"></div>
    <div style="padding-top:-1.3%;">
        <label style="font-size:18px;">FECHA DE ENTREGA DE MATERIAL:</label>
        <label style="font-size:21px;"></label>
    </div>
    <div class="line2" style="margin-top:-.2%"></div>
    <div class="surtio" style="padding-top:-7%;">
        <label style="font-size:18px;">SURTIO:</label>
        <label style="font-size:21px;"></label>
        <div class="line3" style="margin-top:0%"></div>
    </div>
    <div class="recibio" style="padding-top:-3.9%;">
        <label style="font-size:18px;">RECIBIO:</label>
        <label style="font-size:21px;"></label>
        <div class="line3" style="margin-top:-0.5%"></div>
    </div>
    <p style="font-weight:bold; font-size:25px; text-align:center;padding-top:-.5%;">MATERIAL SOLICITADO</p>
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
    <!-- MATERIAL ETIQUETAS-->
    <p style="font-weight:bold; font-size:25px; text-align:center;padding-top:-.5%;">ETIQUETAS</p>
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

                    while($row2 = mysqli_fetch_assoc($resultado2)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row2['codigo_1'].'</td>';
                        echo '<td>'.$row2['salida'].'</td>';
                        echo '<td>'.$row2['artdescrip'].'</td>';
                        echo '<td>'.$row2['observa'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
            ?>

    <!-- MATERIAL FINAL-->
    <p style="font-weight:bold; font-size:25px; text-align:center;padding-top:-.5%;">PRODUCTO TERMINADO</p>
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

                    while($row3 = mysqli_fetch_assoc($resultado3)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row3['codigo_1'].'</td>';
                        echo '<td>'.$row3['entrada'].'</td>';
                        echo '<td>'.$row3['artdescrip'].'</td>';
                        echo '<td>'.$row3['observa'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
            ?>
    <div class="entrego">
        <p>ENTREGO:</p>
        <p>AL DEPTO:</p>
    </div>
    <div class="entrego2" style="padding-top:-9.05%;">
        <p>FECHA:</p>
        <p>RECIBIDO:</p>
    </div>
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
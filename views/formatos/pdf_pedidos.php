<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT *,DATE_FORMAT(fecha,'%d/%m/%Y')as date FROM kardex where estado='0' AND tipo='PEDIDO' AND refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    
    
    //CABECERA2
$cabec = "SELECT k.*, p.* ,(select a.usunom FROM accesos a where a.usuario=p.id_person_autor) as usunom, (select a.usuapell FROM accesos a where a.usuario=p.id_person_autor) as usuapell FROM kardex k, productividad p where k.refe_1=p.referencia_1 AND k.estado='0' AND k.tipo='VALE_PRODUCCION' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resul = mysqli_query($conexion, $cabec);

//TABLA DE EXTENDIDO
$query1 = "SELECT * FROM kardex k, articulos a where k.tipo='PEDIDO' AND a.artcodigo=k.codigo_1 AND k.tipo_ref='ARTICULO' AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
      $resultado1 = mysqli_query($conexion, $query1);
    //$data1 = mysqli_fetch_array($resultado1);

//NOMBRE DEL CLIENTE
$querycli = "SELECT c.nombre FROM kardex k, clientes c where k.estado='0' AND k.codigo_clie=c.proveedor_cliente AND k.refe_1='$folio' GROUP BY k.refe_1 ORDER BY k.id_kax ASC";
$resultadocl = mysqli_query($conexion, $querycli);
$datacl = mysqli_fetch_array($resultadocl);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEDIDO <?php echo $data['refe_1']?></title>
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
footer {
    position: fixed; 
    bottom: -60px; 
    left: 0px; 
    right: 0px;
    height: 50px; 
    /** Extra personal styles **/
    color: black;
    text-align: center;
    line-height: 35px;
}
.pagenum:before {
    content: counter(page);
}
.vertical {
    width: 60%;
    height: 1px;
    border-top: solid black 1px;
    margin-left:20%;
    margin-top:-1%;

}
    

</style>

<body>
<header>
    <p style="font-weight:bold; font-size:24px; text-align:center; padding-top: -5%;"><b> JOSE LUIS MONDRAGON Y COMPAÑIA, S.A. DE C.V.
        </b></p>
    <p style="font-weight:bold; font-size:20px; text-align:center;padding-top:-2.3%;">FABRICANTES, IMPORTADORES Y DISTRIBUIDORES DE PAPELERIA</p>
    <div>
        <label style="font-size:18px;">Alfonso Herrera No. 43</label>
        <label style="font-size:18px; padding-left:20%;">Tels. 5566-3619</label>
        <label style="font-size:18px; padding-left:4%;">5535-9673</label>
        <label style="font-size:18px; padding-left:25%;">Reg. Fed. de Caus.</label>
    </div>
    <div style="padding-top:-0.2%;">
        <label style="font-size:18px;">Col. San Rafael C.P. 06470</label>
        <label style="font-size:18px; padding-left:20.5%;">5535-2386</label>
        <label style="font-size:18px; padding-left:4.2%;">5591-0347</label>
        <label style="font-size:18px; padding-left:27%;">JLM830707FD0</label>
    </div>
    <div style="padding-top:-0.2%;">
        <label style="font-size:18px;">Apartado Postal 1520</label>
        <label style="font-size:18px; padding-left:24.5%;">5535-2344</label>
        <label style="font-size:18px; padding-left:4.3%;">5535-4316</label>
        <label style="font-size:18px; padding-left:20%;">Ced. de Emp. No. 774518</label>
    </div>
    <div style="padding-top:0.1%;">
        <label style="font-size:18px;">06000 Ciudad de México</label>
        <label style="font-size:18px; padding-left:20%;">e-mail: jlmycia@jlmycia.com.mx</label>
        <label style="font-size:18px; padding-left:19%;">Registro Canaco No. 11111</label>
    </div>
    <!-- DESPUES DEL ENCABEZADO -->
    <p style="font-weight:bold; font-size:35px; text-align:center;padding-top:0.5%;">PEDIDO No. <?php echo $data['refe_1']?></p>
    <p style="font-size:20px; text-align:left;padding-top:-1%;margin-left:13%">FECHA: <?php echo $data['date']?></p> <div class="vertical"></div>
    <p style="font-size:20px; text-align:left;padding-top:-1%;margin-left:13%">PEDIDO: <?php echo $datacl['nombre']?></p> <div class="vertical"></div>
    <p style="font-size:20px; text-align:left;padding-top:-1%;margin-left:13%">FORMULADO POR: </p> <div style="margin-left:29%;width:51%;" class="vertical"></div>
    <p style="font-size:20px; text-align:left;padding-top:-1%;margin-left:13%">ATENDIDO POR: </p> <div style="margin-left:28%;width:52%;" class="vertical"></div>
    
    <p style="font-size:18px; text-align:left;padding-top:0.5%;">CODIGO CLIENTE: <?php echo $data['proveedor_cliente']?> </p>
    <p style="font-size:18px; text-align:left;padding-top:-1%;">NOMBRE: <?php echo $datacl['nombre']?> </p><div style="margin-left:8%;width:92%;" class="vertical"></div>
    <p style="font-size:18px; text-align:left;padding-top:-1%;">DIRECCIÓN: <?php echo $data['descripcion_1']?> </p><div style="margin-left:9%;width:91%;" class="vertical"></div>
    <p style="font-size:18px; text-align:left;padding-top:-1%;">LUGAR: <?php echo $data['ubicacion']?> </p><div style="margin-left:6%;width:94%;" class="vertical"></div>
    <br>
    </header>

    
    <!-- MATERIAL SOLICITADO-->
    <?php               
            echo '<table class="table table-striped table-hover table-responsive cell-border" id="TabLisClientes">';
                echo '<thead>';
                    echo '<tr style="background-color:#e6e6e6;">';
                        echo '<th>CODIGO</th>';
                        echo '<th>CANTIDAD</th>';
                        echo '<th>DESCRIPCIÓN DEL ARTICULO</th>';
                        echo '<th>PRECIO</th>';
                        echo '<th>% DESC.</th>';
                        echo '<th>IMPORTE</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($row = mysqli_fetch_assoc($resultado1)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row['codigo_1'].'</td>';
                        echo '<td>'.$row['salida'].'</td>';
                        echo '<td>'.$row['artdescrip'].'</td>';
                        echo '<td>'.$row['costo'].'</td>';
                        echo '<td>'.$row['descuento'].'</td>';
                        echo '<td>'.$row['total'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
            ?>
            <footer>
            PEDIDO No. <?php echo $data['refe_1']?> pagina <span class="pagenum"></span>

        </footer>
   
    <?php
            //require_once '../dist/dompdf/autoload.inc.php';
            require_once '../public/dompdf/autoload.inc.php';
            use Dompdf\Dompdf;
            $dompdf = new DOMPDF('1.0', 'utf-8');
            $dompdf->set_paper('letter', 'portrait');
            $dompdf->load_html(ob_get_clean());
            $dompdf->render();
            $dompdf->stream("PEDIDO", array("Attachment" => 0));
            $pdf = $dompdf->output();
            
        ?>
</body>
</html>
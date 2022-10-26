<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT k.*, p.* ,(select CONCAT(a.usunom, ' ',a.usuapell) FROM accesos a where a.usuario=p.id_person_autor) as autoriza, (select CONCAT(a.usunom, ' ',a.usuapell)FROM accesos a where a.usuario=p.id_person_creacion)as crea, (select CONCAT(a.usunom, ' ',a.usuapell)FROM accesos a where a.usuario=p.id_person_surtio)as surtio, DATE_FORMAT(k.fecha,'%d/%m/%Y')as date FROM kardex k, productividad p where k.refe_1=p.referencia_1 AND k.estado='0' AND k.tipo='VALE_OFICINA' AND k.refe_1='$folio' GROUP BY refe_1 ORDER BY id_kax ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    
    //TABLA DE MATERIAL PARA TRASFORMACIÓN
$query1 = "SELECT * FROM kardex k,articulos a where tipo='VALE_OFICINA' AND a.artcodigo=k.codigo_1 AND tipo_ref='ARTICULO' AND refe_1='$folio' ORDER BY id_kax ASC";
      $resultado1 = mysqli_query($conexion, $query1);
      
          //TABLA DE MATERIAL TRANSFROMADO
$query22 = "SELECT * FROM kardex k,articulos a where tipo='VALE_OFICINA' AND a.artcodigo=k.codigo_1 AND tipo_ref='ARTICULO' AND refe_1='$folio' ORDER BY id_kax ASC";
      $resultado2 = mysqli_query($conexion, $query22);
      
      $query3 = "SELECT * FROM kardex k,articulos a where tipo='VALE_OFICINA' AND a.artcodigo=k.codigo_1 AND tipo_ref='ARTICULO' AND refe_1='$folio' GROUP BY refe_1";
      $resultado3 = mysqli_query($conexion, $query3);

//TABLA DE MATERIAL PARA TRASFORMACIÓN
$query4 = "SELECT * FROM kardex k,articulos a where tipo='VALE_OFICINA' AND a.artcodigo=k.codigo_1 AND tipo_ref='ARTICULO' AND refe_1='$folio' ORDER BY id_kax ASC";
      $resultado4 = mysqli_query($conexion, $query4);
      
          //TABLA DE MATERIAL TRANSFROMADO
$query5 = "SELECT * FROM kardex k,articulos a where tipo='VALE_OFICINA' AND a.artcodigo=k.codigo_1 AND tipo_ref='ARTICULO' AND refe_1='$folio' ORDER BY id_kax ASC";
      $resultado5 = mysqli_query($conexion, $query5);      
      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMATO DE VALE DE OFICINA <?php echo $data['refe_1']?></title>
    <link rel="shortcut icon" href="../template/img/logo.png" />
</head>
<style>
@page {
	margin-top: 0.2cm;
    margin-bottom: 0.2cm;
    margin-left: 1cm;
    margin-right:  1cm;
}

.memonum {
    padding: 0;
    padding-top: -3%;
    margin-left: 80%;
}

.solicita{
    
    padding-top: -3.3%;
    margin-left: 60%;
}

.material{
    padding-top: -2.0%;
}

table {
    font-family: arial, sans-serif;

    width: 100%;
    margin-left: auto;
    margin-right: auto;
}

.linecorte {
    top:810px;
 position: absolute;
}
.fecha{
    top: 60px;
    margin-left:25%;

}
.fechaesp{
    top: 1530px;
    position: absolute;
}

.fecha4{
    top: 750px;
    position: absolute;
}
.fecha4esp{
    top: 1580px;
    position: absolute;
}
.fecha5{
    top: 750px;
    position: absolute;
     left:750px;
}
.fecha5esp{
    top: 1580px;
    position: absolute;
     left:750px;
}

.fecha2{
    top: 700px;
    position: absolute;
     left:750px;
}
.fechaesp2{
    top: 1530px;
    position: absolute;
     left:750px;
}
tr {

    width: 100px;
    margin-top: -1%;
}

th {

    text-align: center;
    padding: 9px;
    font-size: 18px;
    background-color: white;
}

td {

    text-align: center;
    padding: 2px;
    font-size: 15px;
}
.secondtitle{
     top: 440px;
     left:505px;
     display: block;
     font-weight:bold; 
     font-size:25px; 
     text-align:center;
     padding-top:-.5%;
     position: absolute;
}
.tabla2{
     top: 470px;
     left:8px;
position: absolute;
}
.image2{
    top: 860px;
    position: absolute;
}
.title2{
    top: 810px;
    left:290px;
    font-weight:bold; 
    font-size:32px; 
    text-align:center; 
    position: absolute;
}
.memonum2 {
    top: 846px;
    margin-left: 80%;
    position: absolute;
}
.solicitante2{
    top: 905px;
    left:20px;
    position: absolute;
}
.solicita2{
    top: 905px;
    left:695px;
    position: absolute;
}
.material2{
    top: 1005px;
    left:430px;
    position: absolute;
}
.tabla11{
    top: 970px;
    position: absolute;
}
.tabla1{
    top: 140px;
    position: absolute;
}
.secondtitle2{
     top: 1261px;
     left:505px;
     display: block;
     font-weight:bold; 
     font-size:25px; 
     text-align:center;
     padding-top:-.5%;
     position: absolute;
}
.tabla22{
    top: 1314px;
    position: absolute;
    
}

</style>

<body>
    <br>
    <img src="../template/img/logo1.jpg" style="" width="200" height="65" alt="">FECHA:<?php echo $data['date']?>
    <p style="font-weight:bold; font-size:32px; text-align:center; padding-top: -7.5%; margin-left: 5%;"><b> JOSE LUIS MONDRAGON Y CIA SA
            DE CV
        </b></p>
    <p class="memonum" style="font-weight:bold; font-size:25px;"><b>VALE NO.<label style="font-weight:bold; font-size:35px;"><?php echo $data['referencia_1']?></label>
    </b></p>
      <p class="" style="font-size:18px; padding-top: -1%;"><b>DEPTO.SOLICITANTE: <label style="font-weight:bold; font-size:18px;"><?php echo $data['proveedor_cliente']?></label>
      <p class="solicita" style="font-size:18px;"><b>PERSONA: <label style="font-weight:bold; font-size:18px;"><?php echo $data['proveedor_cliente']?></label></p>
       <!-- <center class="material">MATERIAL SOLICITANTE</center>-->
      <!-- MATERIAL SOLICITADO PARA TRANSFORMACION-->
      <div class="tabla1">
      <?php               
            echo '<table class="table table-striped table-hover table-responsive" id="Tabmaterial">';
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
            </div>
         <!-- LINEA DE LA MITAD-->
      <hr class='linecorte' style="border-width: 1px; border-style: dashed solid; border-color: grey;  width:100%" />
      
      <!-- INICIO DE EL MODO ESPEJO-->
      <div class="image2">
         <img class="" src="../template/img/logo1.jpg" width="200" height="65" alt="">FECHA:<?php echo $data['date']?>
      </div>
      <p class="title2"><b> JOSE LUIS MONDRAGON Y CIA SA
            DE CV
        </b></p>
        <p class="memonum2" style="font-weight:bold; font-size:25px;"><b>VALE NO.<label style="font-weight:bold; font-size:35px;"><?php echo $data['referencia_1']?></label>
    </b></p>
    <p class="solicitante2" style="font-size:18px;"><b>DEPTO.SOLICITANTE: <label style="font-weight:bold; font-size:18px;"><?php echo $data['proveedor_cliente']?></label>
     <p class="solicita2" style="font-size:18px;"><b>PERSONA: <label style="font-weight:bold; font-size:18px;"><?php echo $data['proveedor_cliente']?></label></p>
     <!--<center class="material2">MATERIAL SOLICITANTE</center>-->
     <!-- MATERIAL SOLICITADO PARA TRANSFORMACION-->
     <div class="tabla11">
         <?php               
            echo '<table class="table table-striped table-hover table-responsive" id="Tabmaterial2">';
                echo '<thead>';
                    echo '<tr style="background-color:#e6e6e6;">';
                        echo '<th>CODIGO</th>';
                        echo '<th>CANTIDAD</th>';
                        echo '<th>DESCRIPCIÓN</th>';
                        echo '<th>OBSERVACIONES</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($row4 = mysqli_fetch_assoc($resultado4)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row4['codigo_1'].'</td>';
                        echo '<td>'.$row4['salida'].'</td>';
                        echo '<td>'.$row4['artdescrip'].'</td>';
                        echo '<td>'.$row4['observa'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
            ?>
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
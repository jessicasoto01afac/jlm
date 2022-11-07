<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT *,DATE_FORMAT(r.fecha_recl,'%d-%m-%Y')as date FROM reclamoclient r, clientes c WHERE r.codigo_cliente=c.codigo_clie AND folio_recl='$folio' GROUP BY folio_recl ORDER BY folio_recl ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    
    //TABLA DE MATERIAL PARA TRASFORMACIÓN
$query1 = "SELECT * FROM artreclamos k,articulos a where a.artcodigo=k.id_articulo AND k.tipo='CLIENTE' AND k.folio='$folio' AND k.estado='0' ORDER BY id_reclamo ASC";
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
      //ELABORO
      $queryela = "SELECT * FROM reclamoclient r, accesos a WHERE r.elaboro=a.usuario AND r.folio_recl='$folio' GROUP BY r.folio_recl ORDER BY r.folio_recl ASC";
      $resultadoel = mysqli_query($conexion, $queryela);
      $dataela = mysqli_fetch_array($resultadoel);
      
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECLAMO DE CLIENTE <?php echo $data['folio_recl']?></title>
    <link rel="shortcut icon" href="../template/img/logo.png" />
</head>
<style>
@page {
	margin-top: 0.2cm;
    margin-bottom: 0.2cm;
    margin-left: 1cm;
    margin-right:  1cm;
}

.reclamotitle {
    padding: 0;
    padding-top: 0%;
    margin-left: 78%;
}


.fechaesp{
    top: 150px;
    margin-left: 2%;
    position: absolute;
     font-size:22px;
}
.inf{
    top: 200px;
    margin-left: 2%;
    position: absolute;
    font-size:20px;
}
.inf2{
    top: 230px;
    margin-left: 2%;
    position: absolute;
    font-size:20px;

}
.inf3{
    top: 260px;
    margin-left: 2%;
    position: absolute;
    font-size:20px;

}
.inf4{
    top: 290px;
    margin-left: 2%;
    position: absolute;
    font-size:20px;

}
table {
    font-family: arial, sans-serif;
    font-size:18px;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
}

.tabla1{
    top: 350px;
    margin-left: 2%;
    position: absolute;
}
.cuadrado-1 {
    position: relative;
     width: 1130px; 
     margin-left: 2%;
     height: auto;
     border: 2px solid #000000;
     word-wrap:break-word;
}
.cuadrado {
     width: 1129px; 
     height: 32px; 
     background: #428bca;
}
.pruenas{
    max-width: 500px;
    margin:0 auto;
}
.correctwrap{
margin-left:10px;     /*To create a margin from border. When you put display inline, text broke weird. */
}

</style>

<body>
    <br>
    <img src="../template/img/logo1.jpg" style="" width="240" height="75" alt="">
    <p style="font-weight:bold; font-size:30px; text-align:center; padding-top: -6%; margin-left: 5%;"><b> REPORTE DE RECLAMO Ó DEVOLUCIÓN
        </b><br>CLIENTES</p>
    <p class="reclamotitle" style="font-weight:bold; font-size:28px;color:#063787"><b>FOLIO No: <label style="font-weight:bold; font-size:35px;color:red">000<?php echo $data['folio_recl']?></label>
    <p class="fechaesp"><b>FECHA: <label style="font-weight:bold; font-size:22px;margin-left: 3.5%;"><?php echo $data['date']?></label></p>
    <p class="inf">CLIENTE: <label style="font-weight:bold; font-size:20px;margin-left: 2.8%;"><?php echo $data['nombre']?></label></p>
    <p class="inf2">PEDIDO: <label style="font-weight:bold; font-size:20px;margin-left: 3.3%;"><?php echo $data['pedido']?></label></p>
    <p class="inf3">REMISION: <label style="font-weight:bold; font-size:20px;margin-left: 1.4%;"><?php echo $data['remision']?></label></p>
    <p class="inf4">FACTURA: <label style="font-weight:bold; font-size:20px;margin-left: 2%;"><?php echo $data['factura']?></label></p>
    <br>
     <!-- TABLA DE ARTICULOS -->
    <div class="tabla1">
      <?php               
            echo '<table class="table table-striped table-hover table-responsive" id="Tabmaterial">';
                echo '<thead>';
                    echo '<tr style="background-color:#e6e6e6;">';
                        echo '<th>MATERIAL</th>';
                        echo '<th>CANTIDAD</th>';
                        echo '<th>OBSERVACIONES</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while($row = mysqli_fetch_assoc($resultado1)) {
                    
                    echo '<tr>';
                        echo '<td>'.$row['id_articulo'].' / '.$row['artdescrip'].'</td>';
                        echo '<td>'.$row['cantidad'].'</td>';
                        echo '<td>'.$row['observ_recl'].'</td>';
                    echo '</tr>';                       
                    } // Fin while 

                    // Cierra la Conexión con la BD.
                    mysqli_close($conexion);

                    echo '</tbody>';
                echo '</table>';
        ?>
    </div>
    <div style="padding-top:15%;">
        <div class="cuadrado-1">
            <div class="cuadrado" style="text-align:center;">REPORTE DE CLIENTE</div>
            <p style="margin-left: 2%;" class="correctwrap"><?php echo $data['code_cliente']?></p>
        </div>
        <br>

         <div class="cuadrado-1">
            <div class="cuadrado" style="text-align:center;">REPORTE DE JLM</div>
            <p style="margin-left: 2%;"><?php echo $data['code_jlm']?></p>
        </div>
        <br>

         <div class="cuadrado-1">
            <div class="cuadrado" style="text-align:center;">CONCLUSIÓN</div>
            <p style="margin-left: 2%;"><?php echo $data['code_conclucion']?></p>
        </div>
        <br>
        <div>
             <label style="margin-left: 2%;font-size:21px">Elabóro: <?php echo $dataela['usunom'].' '.$dataela['usuapell']?></label>
        </div>
        <div>
            <label style="margin-left: 2%;font-size:21px">Depto: <?php echo $dataela['privilegios']?></label>
        </div>
        <br>
        <center style="font-size:20px;color:#404040">Este documento es de uso informativo por parte Jose Luis Mondragon</center>
    </div>
    

      
      <!-- MATERIAL SOLICITADO PARA TRANSFORMACION-->
     
     
    <?php
            //require_once '../dist/dompdf/autoload.inc.php';
            require_once '../public/dompdf/autoload.inc.php';
            use Dompdf\Dompdf;
            $dompdf = new DOMPDF('1.0', 'utf-8');
            $dompdf->set_paper('letter', 'portrait');
            $dompdf->load_html(ob_get_clean());
            $dompdf->render();
            $dompdf->stream("VALE DE OFICINA", array("Attachment" => 0));
            $pdf = $dompdf->output();
        ?>
</body>
</html>
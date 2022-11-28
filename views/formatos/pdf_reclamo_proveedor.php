<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
$query = "SELECT *,DATE_FORMAT(r.fecha_recl,'%d-%m-%Y')as date FROM reclamoproveedor r, proveedores c WHERE r.proveedor=c.codigo_pro AND r.folio_recl='$folio' GROUP BY r.folio_recl ORDER BY r.folio_recl ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
    
    //TABLA DE MATERIAL DE RECLAMOS
      $query1 = "SELECT * FROM artreclamos k,articulos a where a.artcodigo=k.id_articulo AND k.tipo='PROVEEDOR' AND k.folio='$folio' AND k.estado='0' ORDER BY id_reclamo ASC";
      $resultado1 = mysqli_query($conexion, $query1);
      
          //TREPORTE DE JLM code_jlm
      $query22 = "SELECT * FROM reclamoproveedor where folio_recl='$folio' ORDER BY folio_recl ASC";
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
      $queryela = "SELECT * FROM reclamoproveedor r, accesos a WHERE r.elaboro=a.usuario AND r.folio_recl='$folio' GROUP BY r.folio_recl ORDER BY r.folio_recl ASC";
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
    margin-left: 55%;
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
    top: 210px;
    margin-left: 2%;
    position: absolute;
    font-size:20px;

}
.inf3{
    top: 240px;
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
    top: -10px;
    margin-left: 2%;
    position: relative;
}
.cuadrado-1 {
    position: relative;
     width: 1146px; 
     margin-left: 1%;
     height: auto;
     border: 2px solid #000000;
     word-wrap:break-word;
}
.cuadrado2 {
    margin-left: 1%;
     width: 1150px; 
     height: 32px; 
     background: #8699B4;
     position: relative;
}
.pruenas{
    max-width: 500px;
    margin:0 auto;
}
.correctwrap{
margin-left:10px;     /*To create a margin from border. When you put display inline, text broke weird. */
}
.inf2{
    margin-left: 2%;
    font-size:20px;
}
.cuadrado3 {
    margin-left: 1%;
     width: 1150px; 
     height: 32px; 
     background: #DCE0E7;
     position: relative;
}
.inf7{
    margin-left: 2%;
    font-size:20px;
}
</style>

<body>
    <br>
    <img src="../template/img/logo1.jpg" style="" width="240" height="75" alt="">
    <p style="font-weight:bold; font-size:30px; text-align:center; padding-top: -6%; margin-left: 5%;"><b> REPORTE DE RECLAMACION Ó DEVOLUCIÓN
        </b><br>PROVEEDOR</p>
    <p class="reclamotitle" style="font-weight:bold; font-size:28px;color:#063787"><b>FOLIO No: <label style="font-weight:bold; font-size:35px;color:red">000<?php echo $data['folio_recl']?></label>
    <p class="inf">PROVEEDOR: <label style="font-weight:bold; font-size:20px;margin-left: 2.8%;"><?php echo $data['nom_pro']?></label></p>
    <p class="inf2">FACTURA: <label style="font-weight:bold; font-size:20px;margin-left: 2%;"><?php echo $data['factura']?></label></p>
    <p class="inf3">ORDEN DE COMPRA No: <label style="font-weight:bold; font-size:20px;margin-left: 1.4%;"><?php echo $data['orden_compra']?></label></p>
    <p class="fechaesp" style="margin-top:-0.3%"><b>FECHA: <label style="font-weight:bold; font-size:22px;margin-left: 3.5%;"><?php echo $data['date']?></label></p>
    <br><br><br>
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

    <div style="">
       <div class="cuadrado2" style="text-align:center;font-size:22px;position: ;">REPORTE DE INCIDENCIAS DE JLM</div>
    </div>
    <div style="padding-top:-14%;">
       <p class="inf2">DEPARTAMENTO: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['dep_resport']?></label></p>
    </div>
    <div style="padding-top:-12.5%;">
       <p class="inf2">REPORTA: <label style="font-weight:bold; font-size:20px;margin-left: 7.5%;"><?php echo $data['dep_resport']?></label></p>
    </div>
    <div style="padding-top:3.5%">
       <div class="cuadrado3" style="text-align:left;font-size:22px;">DEDESCRIPCION BREVE DEL REPORTE:</div>
    </div>
    <div style="padding-top:0%;">
        <div class="cuadrado-1">
            <p style="margin-left: 0%;" class="correctwrap"><?php echo $data['code_jlm']?></p>
        </div>
        <br>
        <div style="">
       <div class="cuadrado2" style="text-align:center;font-size:22px;position: ;">REPORTE DE INCIDENCIAS AL PROVEEDOR </div>
    </div>
    <p class="inf7" style="margin-top:1%">DEPARTAMENTO: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['dept_provee']?></label></p>
    <p class="inf7" style="margin-top:-1.5%">ENVIAO A: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['evio_a']?></label></p>
    <p class="inf7" style="margin-top:-1.5%">E-MAIL: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['e_mail']?></label></p>
    <p class="inf7" style="margin-top:-1.5%">TELEFONO: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['tel']?></label></p>
    <p class="inf7" style="margin-top:-1.5%">MEDIO DE NOTIFICACIÓN: <label style="font-weight:bold; font-size:20px;margin-left: 1.5%;"><?php echo $data['medio']?></label></p>
     <div style="padding-top:-.5%">
       <div class="cuadrado3" style="text-align:left;font-size:22px;">SEGUIMIENTO:</div>
    </div>
         <div class="cuadrado-1">
            <p style="margin-left: 2%;"><?php echo $data['code_seguimiento']?></p>
        </div>
        <br>
<div class="cuadrado2" style="text-align:center;font-size:22px;position: ;">RESULTADO</div>
         <div class="cuadrado-1">
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
        <center style="font-size:20px;color:#404040">Si JLM no recibe respuesta a este comunicado durante los 4 dias hábiles siguientes, se dara por entendido que el proveedor, acepta la reclamación y no se aceptara desacuerdo alguno por parte del mismo despues de ese tiempo.
</center>
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
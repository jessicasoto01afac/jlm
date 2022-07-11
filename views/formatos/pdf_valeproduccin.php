<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
$query = "SELECT * FROM kardex where estado='0' AND tipo='VALE_PRODUCCION' AND refe_1='$folio' GROUP BY refe_1  ORDER BY id_kax ASC";
      $resultado = mysqli_query($conexion, $query);
    $data = mysqli_fetch_array($resultado);
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
<!-- <img src="../template/img/logo.png" style="opacity: 0.5;" width="300" height="50" alt=""> -->

<body>
    <p style="font-weight:bold; font-size:30px; text-align:center; padding-top: -2%;">JOSE LUIS MONDRAGON Y CIA <?php echo $data['refe_1']?></p>
    
<?php
            //require_once '../dist/dompdf/autoload.inc.php';
            require_once '../public/dompdf/autoload.inc.php';
            use Dompdf\Dompdf;
            $dompdf = new DOMPDF('1.0', 'utf-8');
            $dompdf->set_paper('A4', 'portrait');
            $dompdf->load_html(ob_get_clean());
            $dompdf->render();
            $dompdf->stream("Evaluación de Nivel I", array("Attachment" => 0));
            $pdf = $dompdf->output();
        ?>
<script>



</script>
   

</body>

</html>
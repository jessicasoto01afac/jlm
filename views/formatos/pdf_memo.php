<?php
ob_start();
$folio = $_GET['data'];
include ("../controller/conexion.php");
//CABECERA
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

    
</body>
</html>
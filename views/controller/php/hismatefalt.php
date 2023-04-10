<?php
	include("../conexion.php");
	session_start();
    $folio = $_POST['folio'];
	$query = "SELECT * FROM historial WHERE proceso LIKE '%MATERIAL FALTANTE%' AND registro LIKE '%$folio%' ORDER BY id_his";
	$resultado = mysqli_query($conexion, $query);
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){

			$arreglo["data"][] = $data; 
		}
		if(isset($arreglo)&&!empty($arreglo)){

			echo json_encode($arreglo);
		}else{

			echo $arreglo='0';
		}
	}
		mysqli_free_result($resultado);
		mysqli_close($conexion);

?>
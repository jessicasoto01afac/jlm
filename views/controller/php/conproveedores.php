<?php
	include("../conexion.php");
	session_start();
	$folio = $_POST['folio'];
	$query = "SELECT * FROM proveedores where estado='0' AND id_prov =$folio ORDER BY codigo_pro ASC";
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
<?php
	include("../conexion.php");
	session_start();
	$folio = $_GET["folio"];
	$query = "SELECT * FROM kardex k, articulos a where k.codigo_1=a.artcodigo AND k.estado='0' AND k.tipo='MEMO' AND k.id_kax=$folio ORDER BY k.id_kax ASC";
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
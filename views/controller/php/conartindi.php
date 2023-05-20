<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT * FROM articulos a, inventario i where a.artcodigo=i.id_articulos and a.estado='0' and i.estado='0' AND a.id_art='$folio' ORDER BY artcodigo ASC";
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
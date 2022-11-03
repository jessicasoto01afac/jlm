<?php
	include("../conexion.php");
	session_start();
	$id_artic = $_GET["id_artic"];
	$query = "SELECT *, concat((select SUM(salida) from kardex where codigo_1 = i.id_articulos and estado=0)) AS RESTA, concat((select SUM(entrada) from kardex where codigo_1 = i.id_articulos and estado=0)) AS SUMA, concat((SELECT count(salida) FROM kardex where codigo_1 = i.id_articulos and salida>0 and estado=0)) AS CUENTA_SALIDA, concat((SELECT count(entrada) FROM kardex where codigo_1 = i.id_articulos and entrada > 0 and estado=0)) AS CUENTA_ENTRADA FROM inventario i, articulos a where a.artcodigo=i.id_articulos AND a.artcodigo='$id_artic' ORDER BY a.id_art ASC";
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
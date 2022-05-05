<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT *, concat((select SUM(salida) from kardex where codigo_1 = i.id_articulos)) AS RESTA, concat((select SUM(entrada) from kardex where codigo_1 = i.id_articulos)) AS SUMA FROM inventario i, articulos a where a.artcodigo=i.id_articulos ORDER BY a.id_art ASC";
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
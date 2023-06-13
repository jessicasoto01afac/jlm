<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT * FROM prepedidos p, articulos a where a.artcodigo=p.codigo AND p.estado='0' AND p.id_pre ='$folio' ";
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
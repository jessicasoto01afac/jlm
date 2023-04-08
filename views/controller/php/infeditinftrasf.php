<?php
	include("../conexion.php");
	session_start();
    $id = $_GET["id"];
	//$query = "SELECT * FROM transforma t, articulos a where t.estado='0' and t.id_extendido=a.artcodigo and t.id_articulo_final='$id' ORDER BY a.artcodigo ASC";
	$query = "SELECT * FROM transformation t, articulos a where t.estado='0' and t.id_articulo=a.artcodigo and t.id_articfial='$id' ORDER BY a.artcodigo ASC";
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
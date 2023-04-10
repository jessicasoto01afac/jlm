<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT *,(SELECT entrada from kardex k WHERE k.refe_1=c.folio_oc and k.refe_1='16' and k.codigo_1=c.id_articulo and k.tipo='COMPRAS') AS cantidads FROM compras c, articulos a where c.estado='0' AND c.folio_oc='16' and c.id_articulo=a.artcodigo ORDER BY id_comp ASC";
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
<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT *,(SELECT entrada from kardex k WHERE k.refe_1=c.folio_oc and k.refe_2='$folio' and k.codigo_1=c.id_articulo and k.tipo='COMPRAS') AS entradarel,(SELECT cantidad_real from kardex k WHERE k.refe_1=c.folio_oc and k.refe_2='$folio' and k.codigo_1=c.id_articulo and k.tipo='COMPRAS') AS cantidadreal FROM compras c, articulos a, artproveedor p where c.estado='0' AND a.artcodigo=c.id_articulo AND p.codigo_proveedor=c.id_artprove AND c.id_comp ='$folio' ORDER BY c.id_comp ASC";
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
<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT * FROM kardex k, articulos a where k.estado='0' AND a.artcodigo=k.codigo_1 AND k.tipo='VALE_PRODUCCION' AND k.refe_1='$folio' ORDER BY k.id_kax ASC";
	//$query = "SELECT k.id_kax,k.refe_1,k.refe_2,k.refe_3,k.fecha,k.codigo_1,k.descripcion_1,k.tipo,k.tipo_ref,k.proveedor_cliente,k.ubicacion,SUM(k.cantidad_real) as cantidad_real,SUM(k.entrada) as entrada,SUM(k.salida) as salida,k.costo,k.descuento,k.total,k.observa,k.observa_dep,k.status,k.status_2,k.entrega,k.revision,k.estado,a.id_art,a.artcodigo,a.artdescrip,a.artubicac,a.artunidad,a.artgrupo, a.estado FROM kardex k, articulos a where k.estado='0' AND a.artcodigo=k.codigo_1 AND k.tipo='VALE_PRODUCCION' AND k.refe_1='$folio' GROUP BY codigo_1 ORDER BY k.id_kax ASC";
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
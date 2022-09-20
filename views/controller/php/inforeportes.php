<?php
	include("../conexion.php");
	session_start();
	$folio = $_GET["folio"];
	$query = "SELECT * FROM reclamoclient r, clientes c, accesos a where r.estado='0' and r.codigo_cliente=c.codigo_clie and r.elaboro=a.usuario and r.folio_recl=$folio ORDER BY r.id_reclamo ASC";
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
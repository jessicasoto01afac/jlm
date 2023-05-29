<?php
	include("../conexion.php");
	session_start();
    $folio = $_GET["folio"];
	$query = "SELECT *,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_creacion)AS FORMULO,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_autor)AS AUTORIZA,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_surtio)AS SURTIO FROM kardex k, articulos a where a.artcodigo=k.codigo_1 AND k.estado='0' AND k.tipo='VALE_OFICINA' AND k.refe_1='$folio' GROUP BY k.refe_1 ORDER BY k.id_kax ASC";
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
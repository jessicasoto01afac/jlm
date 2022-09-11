<?php
	include("../conexion.php");
	session_start();
	$folio = $_GET["folio"];
	$query = "SELECT k.*,a.*,(SELECT caracter_vale from productividad WHERE referencia_1= k.refe_1) as caracter,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_creacion)as creacion,(SELECT fecha_creacion from productividad WHERE referencia_1= k.refe_1) as fec_creacion,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_autor)as autoriza,(SELECT fecha_autorizacion from productividad WHERE referencia_1= k.refe_1) as fec_autoriza,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_surtio)as surtio,(SELECT fecha_surtido from productividad WHERE referencia_1= k.refe_1) as fec_surtio,(SELECT concat(c.usunom,' ',c.usuapell) from productividad p, accesos c WHERE p.referencia_1= k.refe_1 and c.usuario = p.id_person_final)as finaliza,(SELECT fecha_finalizacion from productividad WHERE referencia_1= k.refe_1) as fec_finaliza FROM kardex k, articulos a where k.estado='0' AND a.artcodigo=k.codigo_1 AND k.tipo='PEDIDO' AND  k.refe_1='$folio' GROUP BY k.refe_1 ORDER BY k.refe_1 ASC";
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
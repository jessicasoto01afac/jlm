<?php
	include("../conexion.php");
	session_start();
	//$query = "SELECT a.*,k.*, p.* ,(select CONCAT(a.usunom, ' ',a.usuapell)FROM accesos a where a.usuario=p.id_person_autor)as autoriza, (select CONCAT(a.usunom, ' ',a.usuapell)FROM accesos a where a.usuario=p.id_person_creacion)as crea,(select CONCAT(a.usunom, ' ',a.usuapell)FROM accesos a where a.usuario=p.id_person_surtio)as surtio FROM kardex k, productividad p, articulos a where k.refe_1=p.referencia_1 AND a.artcodigo=k.codigo_1 AND k.estado='0' AND k.tipo='MEMO' ORDER BY id_kax ASC";
	$query = "SELECT * FROM kardex where estado='0' AND tipo='MEMO' ORDER BY id_kax ASC";
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
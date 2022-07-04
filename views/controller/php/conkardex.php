<?php
	include("../conexion.php");
	session_start();
	$id_artinv = $_GET["id_artinv"];
	$fec_inicio = $_GET["fec_inicio"];
	$fec_fin = $_GET["fec_fin"];
	$query = "SELECT * FROM kardex where estado='0' AND codigo_1='$id_artinv' and fecha between '$fec_inicio' and '$fec_fin' ORDER BY id_kax ASC";
	$resultado = mysqli_query($conexion, $query);
	$item = 0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$item++;
			$fecha = date("d-m-Y",strtotime($data["fecha"]));
			$cursos[] = [ 
                $item,
                $data["codigo_1"], 
                $fecha,
                $data["refe_1"],
				$data["refe_2"],
                $data["tipo"],
                $data["tipo_ref"],
                $data["proveedor_cliente"],
                $data["salida"],
                $data["entrada"]
            ]; 
		}
	}
		if(isset($cursos)&&!empty($cursos )){
			$json_string = json_encode(array( 'data' => $cursos ));
			echo $json_string;
			}else{
			echo $cursos ='0';
			}
		mysqli_free_result($resultado);
		mysqli_close($conexion);
		
?>
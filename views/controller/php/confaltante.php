<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * from kardex k, clientes c where k.tipo='MATERIAL_FALTANTE' AND k.estado=0  AND c.codigo_clie=k.proveedor_cliente group by k.refe_1 ORDER BY k.id_kax DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
				$id_kardex=$data["id_kax"];
				$refe_1=$data["refe_1"];
				$proceso = "<a onclick='infofalt($refe_1)' style='cursor:pointer;' title='Ver detalles' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdefc($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["refe_1"], 
					$data["fecha"],
					$data["nombre"],
					$data["refe_2"],
					$data["revision"],  
					$proceso
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
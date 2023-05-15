<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT e.*, (SELECT c.nombre from clientes c where e.id_proveedor=c.codigo_clie) AS nombre FROM entregas e WHERE e.estado=0 ORDER BY id_entregas DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			if ($data["estatus"] == "PENDIENTE") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>PENDIENTE</td>";
				$proceso = "<button type='button' onclick='encamino($refe_1)' class='btn btn-primary'><i class='fa fa-truck mg-r-10'></i>En camio</button> <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["pedido"], 
					$data["fecha"],
					$data["nombre"],
					$data["rastreo"],
					$estatus,  
					$proceso
				];
			}else if ($data["estatus"] == "COMPLETADO") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$folio=$data["pedido"];
				$estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>COMPLETADO</td>";
				$proceso = "<a href='' onclick='hisentrega($folio)' class='btn btn-success btn-icon rounded-circle mg-b-10' data-toggle='modal' data-target='#modal-finish'><div><i class='fa  fa-check'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["pedido"], 
					$data["fecha"],
					$data["nombre"],
					$data["rastreo"],
					$estatus,  
					$proceso
				];
			}else if ($data["estatus"] == "ENVIANDO") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$estatus="<td class='tx-12'><span class='square-8 bg-indigo mg-r-5 rounded-circle'></span>EN CAMINO</td>";
				$proceso = "<button type='button' onclick='entregado($refe_1)' class='btn btn-indigo'><i class='fa  fa-check-circle mg-r-10'></i>Entregado</button>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["pedido"], 
					$data["fecha"],
					$data["nombre"],
					$data["rastreo"],
					$estatus,  
					$proceso
				];
			}
				
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
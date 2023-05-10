<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT *,DATE_FORMAT(fechaentrega,'%d-%m-%Y')as date, e.estatus as statusentr FROM kardex k, clientes p, entregas e WHERE k.estado=0 and p.nombre =k.proveedor_cliente and e.pedido=k.refe_1 group by k.refe_1 ORDER BY fechaentrega DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			if ($data["statusentr"] == "PENDIENTE") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>PENDIENTE</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["refe_1"], 
					$data["date"],
					$data["nombre"],
					$estatus,  
					$proceso
				];
			}else if ($data["statusentr"] == "COMPLETADO") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>FINALIZADO</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["refe_1"], 
					$data["date"],
					$data["nombre"],
					$estatus,  
					$proceso
				];
			}else if ($data["statusentr"] == "ENVIANDO") {
				//$id_kardex=$data["id_proveedor"];
				$refe_1=$data["id_entregas"];
				$estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>FINALIZADO</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["refe_1"], 
					$data["date"],
					$data["nombre"],
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
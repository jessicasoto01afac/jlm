<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT *,DATE_FORMAT(fecha,'%d-%m-%Y')as date FROM compras c, proveedores p WHERE c.estado=0 and p.codigo_pro =c.id_proveedor group by folio_oc ORDER BY id_comp DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			if ($data["estatus"] == "PENDIENTE") {
				$id_kardex=$data["id_proveedor"];
				$refe_1=$data["folio_oc"];
				$estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>PENDIENTE</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["folio_oc"], 
					$data["date"],
					$data["nom_pro"],
					$estatus,  
					$proceso
				];
			}else if ($data["estatus"] == "COMPLETADO") {
				$id_kardex=$data["id_proveedor"];
				$refe_1=$data["folio_oc"];
				$estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>FINALIZADO</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["folio_oc"], 
					$data["date"],
					$data["nom_pro"],
					$estatus,  
					$proceso
				];
			}else if ($data["estatus"] == "AUTORIZADO") {
				$id_kardex=$data["id_proveedor"];
				$refe_1=$data["folio_oc"];
				$estatus="<td class='tx-12'><span class='square-8 bg-info mg-r-5 rounded-circle'></span>AUTORIZADO</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["folio_oc"], 
					$data["date"],
					$data["nom_pro"],
					$estatus,  
					$proceso
				];
			}else if ($data["estatus"] == "ENTREGA PARCIAL") {
				$id_kardex=$data["id_proveedor"];
				$refe_1=$data["folio_oc"];
				$estatus="<td class='tx-12'><span class='square-8 bg-purple mg-r-5 rounded-circle'></span>ENTREGA PARCIAL</td>";
				$proceso = "<a onclick='dettcompras($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletdevolu($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["folio_oc"], 
					$data["date"],
					$data["nom_pro"],
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
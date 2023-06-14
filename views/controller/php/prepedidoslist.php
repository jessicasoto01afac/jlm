<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT *, (SELECT usunom FROM accesos  a WHERE a.id_per=p.atendio) as atendid, (SELECT nombre FROM clientes c WHERE c.codigo_clie=p.cliente) as empress FROM prepedidos p where p.estado='0' GROUP BY p.referencia ORDER BY p.id_pre DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;

		ini_set('date.timezone','America/Mexico_City');

    if ($data["status"] == "PENDIENTE") {
		$id_kardex=$data["id_pre"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["referencia"];
		$proceso = "<a onclick='infpredido($refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>PREPEDIDO</td>";
        $pedidos[] = [ 
            $contador,
            $data["referencia"], 
            $data["atendid"], 
            $newDate,
            $data["empress"], 
            $estatus,
            $proceso
		];
	}else if($data["status"] == "PEDIDO") {
		$id_kardex=$data["id_pre"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["referencia"];
		$proceso = "<a onclick='infpredido($refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="<td class='tx-12'><span class='square-8 bg-info mg-r-5 rounded-circle'></span>PEDIDO</td>";
        $pedidos[] = [ 
            $contador,
            $data["referencia"], 
            $data["atendid"], 
            $newDate,
            $data["empress"],
            $estatus,
            $proceso
		];
	}
}
	}
			if(isset($pedidos)&&!empty($pedidos )){

			$json_string = json_encode(array( 'data' => $pedidos ));
			echo $json_string;
			}else{

			echo $pedidos ='0';
			}

		mysqli_free_result($resultado);
		mysqli_close($conexion);
?>
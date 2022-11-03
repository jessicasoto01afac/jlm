<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1 ORDER BY id_kax DESC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;

		ini_set('date.timezone','America/Mexico_City');

    if ($data["status"] == "PENDIENTE") {
		$id_kardex=$data["id_kax"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infpedido(+$refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>POR AUTORIZAR</td>";
        $pedidos[] = [ 
            $contador,
            $data["refe_1"], 
            $newDate,
            $data["proveedor_cliente"], 
            $estatus,
            $proceso
		];
	}else if($data["status"] == "AUTORIZADO") {
		$id_kardex=$data["id_kax"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="<td class='tx-12'><span class='square-8 bg-info mg-r-5 rounded-circle'></span>AUTORIZADO</td>";
        $pedidos[] = [ 
            $contador,
            $data["refe_1"], 
            $newDate,
            $data["proveedor_cliente"],
            $estatus,
            $proceso
		];
	}else if($data["status"] == "SURTIDO") {
		$id_kardex=$data["id_kax"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
		$estatus="<td class='tx-12'><span class='square-8 bg-purple mg-r-5 rounded-circle'></span>SURTIDO</td>";
        $pedidos[] = [ 
            $contador,
            $data["refe_1"], 
            $newDate,
            $data["proveedor_cliente"],
            $estatus,
            $proceso
		];
	}else if($data["status"] == "FINALIZADO") {
		$id_kardex=$data["id_kax"];
		$originalDate=$data["fecha"];
		$newDate = date("d/m/Y", strtotime($originalDate));
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Ver detalles del pedido' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>FINALIZADO</td>";
        $pedidos[] = [ 
            $contador,
            $data["refe_1"], 
            $newDate,
            $data["proveedor_cliente"],
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
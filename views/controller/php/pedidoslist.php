<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM kardex where estado='0' AND tipo ='PEDIDO' GROUP BY refe_1 ORDER BY refe_1 DESC";
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
		$proceso = "<a onclick='infpedido(+$refe_1)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="POR AUTORIZAR";
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
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="AUTORIZADO";
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
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
		$estatus="SURTIDO";
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
		$proceso = "<a onclick='infpedido($refe_1)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="FINALIZADO";
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
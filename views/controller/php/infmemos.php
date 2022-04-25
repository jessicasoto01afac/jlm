<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM kardex where estado='0' AND tipo='MEMO' GROUP BY refe_1 ORDER BY id_kax ASC	";
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
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infmemo($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delememos($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-delmemo'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="POR AUTORIZAR";
        $cursos[] = [ 
            $contador,
            $data["refe_1"], 
            $data["fecha"],
            $data["proveedor_cliente"],
            $data["refe_2"],
            $estatus,
            $proceso
		];
	}else if($data["status"] == "AUTORIZADO") {
		$id_kardex=$data["id_kax"];
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infmemo($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delememos($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-delmemo'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="AUTORIZADO";
        $cursos[] = [ 
            $contador,
            $data["refe_1"], 
            $data["fecha"],
            $data["proveedor_cliente"],
            $data["refe_2"],
            $estatus,
            $proceso
		];
	}else if($data["status"] == "SURTIDO") {
		$id_kardex=$data["id_kax"];
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infmemo($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delememos($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-delmemo'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="SURTIDO";
        $cursos[] = [ 
            $contador,
            $data["refe_1"], 
            $data["fecha"],
            $data["proveedor_cliente"],
            $data["refe_2"],
            $estatus,
            $proceso
		];
	}else if($data["status"] == "FINALIZADO") {
		$id_kardex=$data["id_kax"];
		$refe_1=$data["refe_1"];
		$proceso = "<a onclick='infmemo($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delememos($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-delmemo'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
        $estatus="FINALIZADO";
        $cursos[] = [ 
            $contador,
            $data["refe_1"], 
            $data["fecha"],
            $data["proveedor_cliente"],
            $data["refe_2"],
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
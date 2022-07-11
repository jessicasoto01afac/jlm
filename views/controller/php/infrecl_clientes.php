<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * FROM reclamoclient where estado='0' GROUP BY folio_recl ORDER BY id_reclamo ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
            ini_set('date.timezone','America/Mexico_City');
            if ($data["estatus_recl"] == "PENDIENTE") {
                $id_kardex=$data["id_reclamo"];
                $refe_1=$data["folio_recl"];
                $proceso = "<a onclick='valproduct($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="POR AUTORIZAR";
                $cursos[] = [ 
                    $contador,
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["codigo_cliente"],
                    $data["remision"],
                    $data["factura"],
                    $estatus,
                    $proceso
                ];
            }else if($data["estatus_recl"] == "AUTORIZADO") {
                $id_kardex=$data["id_reclamo"];
                $refe_1=$data["folio_recl"];
                $proceso = "<a onclick='valproduct($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="AUTORIZADO";
                $cursos[] = [ 
                    $contador,
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["codigo_cliente"],
                    $data["remision"],
                    $data["factura"],
                    $estatus,
                    $proceso
                ];
            }else if($data["estatus_recl"] == "SURTIDO") {
                $id_kardex=$data["id_reclamo"];
                $refe_1=$data["folio_recl"];
                $proceso = "<a onclick='valproduct($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="SURTIDO";
                $cursos[] = [ 
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["codigo_cliente"],
                    $data["remision"],
                    $data["factura"],
                    $estatus,
                    $proceso
                ];
            }else if($data["estatus_recl"] == "FINALIZADO") {
                $id_kardex=$data["id_reclamo"];
                $refe_1=$data["folio_recl"];
                $proceso = "<a onclick='valproduct($refe_1)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="FINALIZADO";
                $cursos[] = [ 
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["codigo_cliente"],
                    $data["remision"],
                    $data["factura"],
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
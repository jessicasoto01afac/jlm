<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * FROM reclamoclient r, clientes c where r.estado='0' and r.codigo_cliente=c.codigo_clie ORDER BY id_reclamo ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
            ini_set('date.timezone','America/Mexico_City');
            if ($data["estatus_recl"] == "PENDIENTE") {
                $id_reclamo=$data["id_reclamo"];
                $folio=$data["folio_recl"];
                $proceso = "<a onclick='reclamocliente($folio)' style='cursor:pointer;' title='Ver detalles del reporte' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($id_reclamo)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="<td class='tx-12'><span class='square-8 bg-warning mg-r-5 rounded-circle'></span>PENDIENTE</td>";
                $cursos[] = [ 
                    $contador,
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["nombre"],
                    $data["remision"],
                    $data["factura"],
                    $estatus,
                    $proceso
                ];
            }else if($data["estatus_recl"] == "FINALIZADO") {
                $id_reclamo=$data["id_reclamo"];
                $folio=$data["folio_recl"];
                $proceso = "<a onclick='reclamocliente($folio)' style='cursor:pointer;' title='Ver detalles del reporte' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delevpro($id_reclamo)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
                $estatus="<td class='tx-12'><span class='square-8 bg-success mg-r-5 rounded-circle'></span>FINALIZADO</td>";
                $cursos[] = [
                    $contador,
                    $data["folio_recl"], 
                    $data["fecha_recl"],
                    $data["nombre"],
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
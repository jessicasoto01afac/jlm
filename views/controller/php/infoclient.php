<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM clientes where estado='0' ORDER BY id_cliente  ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			ini_set('date.timezone','America/Mexico_City');
			if ($data["estado"] == "0") {
				$id_cliente=$data["id_cliente"];
				$proceso = "<a onclick='clienedith($id_cliente)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editclient'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletclient($id_cliente)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletecli'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["codigo_clie"], 
					$data["nombre"],
					$data["rfc"],
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
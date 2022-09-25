<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * FROM proveedores where estado='0' ORDER BY id_prov ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			ini_set('date.timezone','America/Mexico_City');
			if ($data["estado"] == "0") {
				$id_prov=$data["id_prov"];
				$proceso = "<a onclick='proveedith($id_prov)' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editprov'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletprov($id_prov)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleprov'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["codigo_pro"], 
					$data["nom_pro"],
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
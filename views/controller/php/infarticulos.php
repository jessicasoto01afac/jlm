<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM articulos where estado='0' ORDER BY id_art ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			ini_set('date.timezone','America/Mexico_City');
			if ($data["estado"] == "0") {
				$id_trans=$data["id_art"];
				$proceso = "<a style='cursor:pointer;' onclick='artedith($id_trans)' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editarticul'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletart($id_trans)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleteart'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["artcodigo"], 
					$data["artdescrip"],
					$data["artubicac"],
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
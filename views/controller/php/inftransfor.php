<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT * FROM transforma t, articulos a where t.estado='0' and t.id_articulo_final = a.artcodigo ORDER BY id_trans ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
			ini_set('date.timezone','America/Mexico_City');
			if ($data["estado"] == "0") {
				$id_trans=$data["id_trans"];
				$proceso = "<a onclick='infmemo($id_trans)' style='cursor:pointer;' title='Ver detalles de memo' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='delememos($id_trans)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-delmemo'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["id_articulo_final"], 
					$data["artdescrip"],
					$data["hojas"],
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
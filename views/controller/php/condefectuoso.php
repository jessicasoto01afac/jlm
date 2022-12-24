<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * FROM kardex where tipo='MATERIAL_DEFECTUOSO' AND estado=0 group by refe_1  ";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
			$contador++;
				$id_kardex=$data["id_kax"];
				$refe_1=$data["refe_1"];
				$proceso = "<a onclick='infodefect($refe_1)' style='cursor:pointer;' title='Ver detalles del vale' class='btn btn-primary btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-list-ul'></i></div></a>  <a onclick='deletvolis($refe_1)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deletevproduc'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";
				$cursos[] = [ 
					$contador,
					$data["refe_1"], 
					$data["fecha"],
					$data["proveedor_cliente"],
					$data["refe_2"], 
					$proceso
				];
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
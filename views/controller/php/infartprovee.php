<?php
	include("../conexion.php");
	session_start();
	$query = "SELECT * FROM artproveedor t,articulos a,proveedores p where t.id_articulo = a.artcodigo and p.codigo_pro =t.proveedor and t.estado=0 ORDER BY id_arprov ASC";
	$resultado = mysqli_query($conexion, $query);
	$contador=0;
	if(!$resultado){
		die("error");
	}else{
		while($data = mysqli_fetch_assoc($resultado)){
            $id_arprov = $data["id_arprov"];
			$contador++;
			ini_set('date.timezone','America/Mexico_City');
			if ($data["estado"] == "0") {
				$proceso = "<a style='cursor:pointer;' onclick='infoartraf($id_arprov)' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-edithartprovee'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletartprvv($id_arprov)' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleteartprv'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["nom_pro"],
					$data["id_articulo"], 
					$data["codigo_proveedor"],
					$data["artdescrip"],
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
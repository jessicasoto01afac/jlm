<?php
	include("../conexion.php");
	session_start();
	
	$query = "SELECT *, concat((select SUM(salida) from kardex where codigo_1 = i.id_articulos)) AS RESTA, concat((select SUM(entrada) from kardex where codigo_1 = i.id_articulos)) AS SUMA FROM inventario i, articulos a where a.artcodigo=i.id_articulos ORDER BY a.id_art ASC";
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
				$id_codigo=$data["artcodigo"];
				$existencias=$data["stock_inicial"] + $data["SUMA"] - $data["RESTA"];
				$solicitar ="PENDIENTE";
				$proceso = "<a onclick='opende($id_codigo)' title='ver detalles' style='hover:color:white' class='btn btn-outline-primary btn-icon rounded-circle mg-r-5'><div><i class='icon ion-share tx-20 tx-sm-bold tx-primary'></i></div></a>";	
				$cursos[] = [ 
					$contador,
					$data["id_articulos"], 
					$data["artdescrip"],
					$data["artunidad"],
					$data["stock_minimo"],
					$data["stock_maximo"],
					$data["stock_inicial"],
					$existencias,
					$solicitar,
					$data["costo"], 
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

<?php 
	//Conexion a la base de datos temporal
	//$conexion = new mysqli('localhost','u683645102_root','Agencia.SCT2021.','u683645102_gestor');
	            $conexion = new mysqli('localhost','root','','jlm');
	//si mustra un errro al momento de querer conectarse 
	if ($conexion->connect_error):
			echo "Error de Conexión".$conexion->connect_error;
	endif;
?>
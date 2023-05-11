<?php 
	//Conexion a la base de datos temporal
	$conexion = new mysqli('localhost','u213238046_jlmycia','Jlm2018+','u213238046_jlm');
	           // $conexion = new mysqli('localhost','root','','jlm');
	//si mustra un errro al momento de querer conectarse 
	if ($conexion->connect_error):
			echo "Error de Conexión".$conexion->connect_error;
	endif;
?>
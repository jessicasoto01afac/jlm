<?php 
	//Conexion a la base de datos temporal
	//$conexion = new mysqli('localhost','id18480647_jlmcia','Jlm2018+database','id18480647_jlm');
	            $conexion = new mysqli('localhost','root','','jlm');
	//si mustra un errro al momento de querer conectarse 
	if ($conexion->connect_error):
			echo "Error de Conexión".$conexion->connect_error;
	endif;
?>
<?php 
	include ('../conexion/conexion.php');
    $id_per=$_POST['id_per'];
    $usunom=$_POST['usunom'];
    $usuapell=$_POST['usuapell'];
    $correo=$_POST['correo'];
    $usuario=$_POST['usuario'];
    $password=$_POST['password'];
    $privilegios=$_POST['privilegios'];
    $activo=$_POST['activo'];
    $aviso=$_POST['aviso']; 

    $sql = "INSERT INTO accesos VALUES(0,'$usunom','$usuapell','$correo','$usuario','$password','0','0')";


    echo mysqli_query($conexion,$sql);

 ?>
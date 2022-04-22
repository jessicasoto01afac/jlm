<?php 

require'conexion.php';

session_start();

$usuario=$_POST['usuario'];
$clave=$_POST['password'];
$contador=0;

$query="SELECT *  FROM accesos where usuario='$usuario' and estado=0 and activo=0";


$consulta=mysqli_query($conexion,$query);
$array=mysqli_fetch_array($consulta);
$passhash = $array['password'];

if (password_verify($clave, $passhash)){

    $contador++;
    //echo $contador;
    if($array['privilegios']=== 'ADMINISTRADOR'){
        $_SESSION['username']=$usuario;
        header("location: ../views/administrador/inicio.php");
    
    }else if ($array['privilegios']=== 'ALMACEN') {
        $_SESSION['username']=$usuario;
        $_SESSION['persona']=$array;
        header("location: ../views/almacen/inicio.php");
    
    }else if ($array['privilegios']=== 'VENTAS') {
        $_SESSION['username']=$usuario;
        $_SESSION['persona']=$array;
        header("location: ../views/ventas/inicio.php");
    
    }else{
        echo  $passhash ,$clave ;
    }
}else{
    echo("error");
}




?>
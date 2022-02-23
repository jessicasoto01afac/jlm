<?php 
	include ('../conexion.php');
    $opcion = $_POST["opcion"];
    $informacion = [];

//CONDICIONES------------------------------------------------------------------------------

    //Condición donde registra al ciente
    if($opcion === 'registrar'){
        $codigo_clie = $_POST['codigo_clie'];
        $nombre = $_POST['nombre'];
    
        if (comprobacion ($codigo_clie,$nombre,$conexion)){
            $rfc = $_POST['rfc'];
            $email = $_POST['email'];
            if (registrar($codigo_clie,$nombre,$rfc,$email,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                historial($usuario,$codigo_clie,$nombre,$rfc,$email,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza cliente
    }else if($opcion === 'actualizar'){
        $codigo_clie = $_POST['codigo_clie'];
        $nombre = $_POST['nombre'];
        $rfc = $_POST['rfc'];        
        $email = $_POST['email'];
        $id_cliente = $_POST['id_cliente'];

            if (actualizar($codigo_clie,$nombre,$rfc,$email,$id_cliente,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                $realizo = 'ACTUALIZO DAT. DEL CLIENTE';
                histedith($usuario,$realizo,$codigo_clie,$nombre,$rfc,$email,$id_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'eliminar'){
        $id_cliente = $_POST['id_cliente'];
        $nombre = $_POST['nombre'];

            if (eliminar($id_cliente,$conexion)){
                echo "0";
                $realizo = 'ELIMINA A USUARIO';
                $usuario='PRUEBAS';
                histdelete($usuario,$realizo,$id_cliente,$nombre,$conexion);
            }else{
                echo "1";
            }
    }

//FUNCIONES-----------------------------------------------------------------------------------

//funcion de comprobación para ver si el cliente ya se encuentra en la base
function comprobacion ($codigo_clie,$nombre,$conexion){
    $query="SELECT * FROM clientes WHERE codigo_clie = '$codigo_clie' AND nombre = '$nombre' AND estado = 0 OR nombre = '$nombre' AND estado = 0 OR codigo_clie = '$codigo_clie' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar articulo
function registrar ($codigo_clie,$nombre,$rfc,$email,$conexion){
    $query="INSERT INTO clientes VALUES(0,'$codigo_clie','$nombre','$rfc','$email', 0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function actualizar ($codigo_clie,$nombre,$rfc,$email,$id_cliente,$conexion){
    $query="UPDATE clientes SET codigo_clie='$codigo_clie', nombre='$nombre', rfc='$rfc', email='$email' WHERE id_cliente = '$id_cliente'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para actualizar el registro
function eliminar ($id_cliente,$conexion){
    $query="UPDATE clientes SET estado='1' WHERE id_cliente= '$id_cliente'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para registra cambios
function historial($usuario,$codigo_clie,$nombre,$rfc,$email,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN NUEVO CLIENTE', ' CODIGO:' ' $codigo_clie ' ' NOMBRE:' ' $nombre' ' RFC:' ' $rfc' ' CORREO:' '$email' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($usuario,$realizo,$codigo_clie,$nombre,$rfc,$email,$id_cliente,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', '$id_cliente' ' CODIGO:' '$codigo_clie'  ' NOMBRE: '  ' $nombre' ' RFC:' ' $rfc' ' CORREO:' ' $email' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_cliente,$nombre,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_cliente' ' NOMBRE:' ' $nombre' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para cerrar laa conexion
function cerrar($conexion){
    mysqli_close($conexion);
}

?>
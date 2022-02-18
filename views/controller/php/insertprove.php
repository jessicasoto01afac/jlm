<?php 
	include ('../conexion.php');
    $opcion = $_POST["opcion"];
    $informacion = [];

//CONDICIONES------------------------------------------------------------------------------

    //Condición donde registra al ciente
    if($opcion === 'registrar'){
        $codigo_pro = $_POST['codigo_pro'];
        $nom_pro = $_POST['nom_pro'];
    
        if (comprobacion ($codigo_pro,$nom_pro,$conexion)){
            $domi_fisc = $_POST['domi_fisc'];
            $condi_pago = $_POST['condi_pago'];
            $cont_1 = $_POST['cont_1'];
            $tel_c1 = $_POST['tel_c1'];
            $tel_c2	= $_POST['tel_c2'];
            $email_c1 = $_POST['email_c1'];
            $email_c2 = $_POST['email_c2'];
            $cont_2 = $_POST['cont_2'];
            $tel_c3 = $_POST['tel_c3'];
            $tel_c4 = $_POST['tel_c4'];
            $email_c3 = $_POST['email_c3'];
            $email_c4 = $_POST['email_c4'];
            $obser_prov = $_POST['obser_prov'];

            if (registrar($codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$tel_c1,$tel_c2,$email_c1,$email_c2,$cont_2,$tel_c3,$tel_c4,$email_c3,$email_c4,$obser_prov,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                historial($usuario,$codigo_pro,$nom_pro,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza cliente
    }else if($opcion === 'actualizar'){
        $codigo_pro = $_POST['codigo_pro'];
        $nom_pro = $_POST['nom_pro'];
        $domi_fisc = $_POST['domi_fisc'];
        $condi_pago = $_POST['condi_pago'];
        $cont_1 = $_POST['cont_1'];
        $tel_c1 = $_POST['tel_c1'];
        $tel_c2	= $_POST['tel_c2'];
        $email_c1 = $_POST['email_c1'];
        $email_c2 = $_POST['email_c2'];
        $cont_2 = $_POST['cont_2'];
        $tel_c3 = $_POST['tel_c3'];
        $tel_c4 = $_POST['tel_c4'];
        $email_c3 = $_POST['email_c3'];
        $email_c4 = $_POST['email_c4'];
        $obser_prov = $_POST['obser_prov'];
        $id_prov = $_POST['id_prov'];

    if (actualizar($codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$tel_c1,$tel_c2,$email_c1,$email_c2,$cont_2,$tel_c3,$tel_c4,$email_c3,$email_c4,$obser_prov,$id_prov,$conexion)){
        echo "0";
        $usuario='PRUEBAS';
        $realizo = 'ACTUALIZO DAT. DEL PROVEEDOR';
        histedith($usuario,$realizo,$codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$id_prov,$conexion);
    }else{
        echo "1";
    }
//Condición donde elimina usuario
}else if($opcion === 'eliminar'){
    $id_prov = $_POST['id_prov'];
    $nom_pro = $_POST['nom_pro'];

        if (eliminar($id_prov,$conexion)){
            echo "0";
            $realizo = 'ELIMINA A PROVEEDOR';
            $usuario='PRUEBAS';
            histdelete($usuario,$realizo,$id_prov,$nom_pro,$conexion);
        }else{
            echo "1";
        }
}


//FUNCIONES-----------------------------------------------------------------------------------

//funcion de comprobación para ver si el cliente ya se encuentra en la base
function comprobacion ($codigo_pro,$nom_pro,$conexion){
    $query="SELECT * FROM proveedores WHERE codigo_pro = '$codigo_pro' AND nom_pro = '$nom_pro' AND estado = 0 OR codigo_pro = '$codigo_pro' AND estado = 0 OR nom_pro = '$nom_pro' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar articulo
function registrar ($codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$tel_c1,$tel_c2,$email_c1,$email_c2,$cont_2,$tel_c3,$tel_c4,$email_c3,$email_c4,$obser_prov,$conexion){
    $query="INSERT INTO proveedores VALUES(0,'$codigo_pro','$nom_pro','$domi_fisc','$condi_pago','$cont_1','$tel_c1','$tel_c2','$email_c1','$email_c2','$cont_2','$tel_c3','$tel_c4','$email_c3','$email_c4','$obser_prov',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function actualizar ($codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$tel_c1,$tel_c2,$email_c1,$email_c2,$cont_2,$tel_c3,$tel_c4,$email_c3,$email_c4,$obser_prov,$id_prov,$conexion){
    $query="UPDATE proveedores SET codigo_pro='$codigo_pro', nom_pro='$nom_pro', domi_fisc='$domi_fisc', condi_pago='$condi_pago', cont_1='$cont_1', tel_c1='$tel_c1', tel_c2='$tel_c2', email_c1='$email_c1', email_c2='$email_c2', cont_2='$cont_2', tel_c3='$tel_c3', tel_c4='$tel_c4', email_c3='$email_c3', email_c4='$email_c4', obser_prov='$obser_prov' WHERE id_prov = '$id_prov'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para actualizar el registro
function eliminar ($id_prov,$conexion){
    $query="UPDATE proveedores SET estado='1' WHERE id_prov= '$id_prov'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para registra cambios
function historial($usuario,$codigo_pro,$nom_pro,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN NUEVO PROVEEDOR', ' CODIGO:'' $codigo_pro ' ' NOMBRE:' ' $nom_pro','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($usuario,$realizo,$codigo_pro,$nom_pro,$domi_fisc,$condi_pago,$cont_1,$id_prov,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_prov' ' CODIGO:' '$codigo_pro'  ' NOMBRE: '  ' $nom_pro' ' DOMICILIO:' ' $domi_fisc' ' PAGO:' ' $condi_pago' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_prov,$nom_pro,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_prov' ' NOMBRE:' ' $nom_pro' ,'$fecha')";
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
<?php 
	include ('../conexion.php');
    $opcion = $_POST["opcion"];
    $informacion = [];

//CONDICIONES------------------------------------------------------------------------------

    //Condición donde registra al ciente
    if($opcion === 'regismemo'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $refe_2 = $_POST['refe_2'];
            
            
            if (registrar($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde agrega los articulos transformados del memo
    }else if($opcion === 'regmemofin'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
        if (comprobacion2 ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $refe_2 = $_POST['refe_2'];
            
            if (registrar_2($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde autoriza el memo
    }else if($opcion === 'autorizarmem'){
        $folio = $_POST['folio'];
            if (autorizar($folio,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                histedith($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
     //Condición donde surte el memo
    }else if($opcion === 'surtirmem'){
        $folio = $_POST['folio'];
            if (surtir($folio,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                hisurtir($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //condicion para finalizar el memo finalmem
    }else if($opcion === 'finalmem'){
        $folio = $_POST['folio'];
            if (finalizar ($folio,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                hisfinal($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    }
    

//FUNCIONES-----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion2 ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el vale de oficina
function registrar ($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','MEMO','ARTICULO_TRANSFORMACION','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el vale de oficina
function registrar_2 ($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','MEMO','ARTICULO_TRANSFORMADO','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para autorizar
function autorizar ($folio,$conexion){
    $query="UPDATE kardex SET status='AUTORIZADO' WHERE refe_1 = '$folio' AND tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para surtir
function surtir ($folio,$conexion){
    $query="UPDATE kardex SET status='SURTIDO' WHERE refe_1 = '$folio' AND tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para finalizar
function finalizar ($folio,$conexion){
    $query="UPDATE kardex SET status='FINALIZADO' WHERE refe_1 = '$folio' AND tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//-------------------------------------------------------------------------------------------------------------------
//funcion para registra cambios
function historial($usuario,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA MEMO', 'CODIGO:' ' $refe_1' ' ARTICULO PARA TRANSFORMACIÓN:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'AUTORIZA MEMO', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico SURTIDO
function hisurtir($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE MEMO', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico FINALIZADO
function hisfinal($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'FINALIZA MEMO', 'FOLIO:' '$folio','$fecha1')";
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
<?php 
	include ('../conexion.php');
    $opcion = $_POST["opcion"];
    $informacion = [];

//CONDICIONES------------------------------------------------------------------------------

    //Condición donde registra al ciente
    if($opcion === 'registrar'){
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
            $costo = $_POST['costo'];
            $total = $_POST['total'];
            $ubicacion = $_POST['ubicacion'];
            
            if (registrar($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$costo,$total,$ubicacion,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza vale de oficina
    }else if($opcion === 'actualizar'){
        $codigo_1 = $_POST['codigo_1'];
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];
        $id_kax = $_POST['id_kax'];
        

            if (actualizar($codigo_1,$descripcion_1,$salida,$observa,$id_kax,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //Condición donde actualiza desde vista previa lka cabecera del vale de oficina
    }else if($opcion === 'cambio'){
        $fecha = $_POST['fecha'];
        $refe_3 = $_POST['refe_3'];
        $status = $_POST['status'];
        $refe_1 = $_POST['refe_1'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
    
            if (cambio($fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                histedith($usuario,$fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'actualiza'){
        $codigo_1 = $_POST['codigo_1'];
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $costo = $_POST['costo'];
        $total = $_POST['total'];
        $observa = $_POST['observa'];
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];

            if (edicion($codigo_1,$descripcion_1,$salida,$costo,$total,$observa,$id_kax,$refe_1,$conexion)){
                echo "0";
                $usuario='PRUEBAS';
                histcambio($usuario,$codigo_1,$salida,$costo,$total,$refe_1,$id_kax,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina articulo de vale de oficina
    }else if($opcion === 'eliminar'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
            if (eliminar($id_kax,$conexion)){
                echo "0";
                $realizo = 'ELIMINA ARTICULO DE VALE DE OFICINA';
                $usuario='PRUEBAS';
                histdelete($usuario,$realizo,$id_kax,$codigo_1,$refe_1,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina vale de oficina
    }else if($opcion === 'deletevolis'){
        $refe_1 = $_POST['refe_1'];
            if (deletevo($refe_1,$conexion)){
                echo "0";
                $realizo = 'ELIMINA VALE DE OFICINA';
                $usuario='PRUEBAS';
                histelimi($usuario,$realizo,$refe_1,$conexion);
            }else{
                echo "1";
            }
    //Condición donde marca sin exitencia
    }else if($opcion === 'sinexistencia'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];

            if (sinexistencia($id_kax,$conexion)){
                echo "0";
                $realizo = 'MARCA ARTICULO SIN EXISTENCIA';
                $usuario='PRUEBAS';
                hisinexist($usuario,$realizo,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
    }
    


//FUNCIONES-----------------------------------------------------------------------------------

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
//funcion para guardar el vale de oficina
function registrar ($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$costo,$total,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','NA','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_OFICINA','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',$costo,0,$total,'$observa','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function actualizar ($codigo_1,$descripcion_1,$salida,$observa,$id_kax,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', salida='$salida', observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro desde la vista previa del vale de oficina
function cambio ($fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', refe_3='$refe_3', status='$status', proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function edicion ($codigo_1,$descripcion_1,$salida,$costo,$total,$observa,$id_kax,$refe_1,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', salida='$salida', costo='$costo', total='$total', observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//función para surtir
function sinexistencia ($id_kax,$conexion){
    $query="UPDATE kardex SET status_2='SIN EXISTENCIAS', salida=0 WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function eliminar ($id_kax,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE id_kax= '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para eliminar vale de oficina
function deletevo ($refe_1,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE refe_1= '$refe_1' AND tipo='VALE_OFICINA' ";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE OFICINA', 'CODIGO:' ' $refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($usuario,$fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'EDITA INFORMACIÓN DE VALE DE OFICINA', '$refe_1' ' FECHA:' '$fecha'  ' TIPO: '  ' $refe_3' ' status:' ' $status' ' SOLICITANTE:' ' $proveedor_cliente' ,'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histcambio($usuario,$codigo_1,$salida,$costo,$total,$refe_1,$id_kax,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'EDITA ARTUCULO VALE OFICINA', 'ID: ' '$id_kax ' '$refe_1' ' CODIGO:' '$codigo_1'  ' SALIDA: '  ' $salida' ' COSTO:' ' $costo' ' TOTAL:' ' $total' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_kax,$codigo_1,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'VALE FOLIO:' '$refe_1' ' ID:' '$id_kax' ' CODIGO:' ' $codigo_1' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histelimi($usuario,$realizo,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$refe_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function hisinexist($usuario,$realizo,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'VALE DE OFICINA FOLIO:' '$refe_1' ' ARTICULO: ' '$codigo_1','$fecha')";
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
<?php 
    include ('../conexion.php');
    session_start();

$usuario=$_SESSION['username'];

if(!isset($usuario)){
  header("location: ./../../");
}
    $opcion = $_POST["opcion"];
    $informacion = [];

//CONDICIONES------------------------------------------------------------------------------
    //Condición donde registra al ciente
    if($opcion === 'registrar'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $caracter = $_POST['caracter'];
            
            if (registrar($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion)){
                echo "0";
                //poductividad($refe_1,$caracter,$usuario,$conexion);
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'updateartnew'){
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];
        if (actualizarnew($id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion)){
            echo "0";
            $realizo = 'EDITA EL ARTICULO AGREGADO';
            // $usuario='pruebas';
            histedith($usuario,$realizo,$id_kax,$conexion);
        }else{
            echo "1";
        }
    
    }else if($opcion === 'deleartnew'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DEL PEDIDO';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'cancelar'){
        $refe_1 = $_POST['refe_1'];
            if (cancelar($refe_1,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //Condición donde agrega un articulo individualmente
    }else if($opcion === 'updateartnewinfo'){
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];
        if (actualizarnew2($id_kax,$codigo_1,$salida,$observa,$conexion)){
            echo "0";
            $realizo = 'EDITA EL ARTICULO AGREGADO DEL PEDIDO';
            // $usuario='pruebas';
            histedith2($usuario,$realizo,$id_kax,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    
    }else if($opcion === 'deleartnew'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DEL PEDIDO';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'registrarind'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (registrarind($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialinv($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde autoriza
    }else if($opcion === 'autorizarped'){
        $folio = $_POST['folio'];
            if (autorizar1($folio,$conexion)){
                echo "0";
                autorizar2($usuario,$folio,$conexion);
                histautoriza($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
     //Condición donde libera pedido
    }else if($opcion === 'liberarped'){
        $foliovp = $_POST['foliovp'];
            if (liberarvpro ($foliovp,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                hisliber($usuario,$foliovp,$conexion); 
            }else{
                echo "1";
            }
    }else if($opcion === 'surtirped'){
        $folio = $_POST['folio'];
            if (surtir1($folio,$conexion)){
                echo "0";
                surtir2($usuario,$folio,$conexion);
                histsurt($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    }else if($opcion === 'finalped'){
        $folio = $_POST['folio'];
            if (finalizar1($folio,$conexion)){
                echo "0";
                finalizar2($usuario,$folio,$conexion);
                histfinal($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //Actualiza la informacion de no surtir extendido y etiqueta
    }if($opcion === 'registrarfin'){
        $refe_1 = $_POST['refe_1'];
        if (comprobacionfin ($refe_1,$usuario,$conexion)){
            $caracter = $_POST['caracter'];
            
            if (poductividad($refe_1,$caracter,$usuario,$conexion)){
                echo "0";
                //finaliadd ($refe_1,$conexion);
                //historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'surtir'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        if (surtirart ($id_kax,$refe_1,$codigo_1,$cantidad,$observa_dep,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisurtir2($usuario,$refe_1,$codigo_1,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //editar surtir 
    }else if($opcion === 'sinexistencia'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $observa_dep = $_POST['observa_dep'];
        if (sinexiste ($id_kax,$refe_1,$codigo_1,$observa_dep,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            histnoexist($usuario,$refe_1,$codigo_1,$conexion); 
        }else{
            echo "1";
        }
        //finalizar1
    }else if($opcion === 'edthsurtir'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];
        
        if (surtirartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    }else if($opcion === 'edthsinexis'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];
        
        if (sinexistartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //Actualiza la informacion de no surtir producto final
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

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
function comprobacionfin ($refe_1,$usuario,$conexion){
    $query="SELECT * FROM productividad WHERE referencia_1 = '$refe_1' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el articulo de producción
function registrar ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','PEDIDO','ARTICULO','$proveedor_cliente','$ubicacion','$cantidad_real',0,$salida,'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para registrar la productividad
function poductividad ($refe_1,$caracter,$usuario,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="INSERT INTO productividad VALUES(0,'$refe_1','$usuario','$fecha','PENDIENTE','','PENDIENTE','','PENDIENTE','','$caracter',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function finaliadd ($refe_1,$conexion){
    $query="UPDATE kardex SET estado=0 WHERE refe_1= '$refe_1' AND estado=1 ";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function actualizarnew ($id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', cantidad_real=$salida,entrada=0,salida=$salida,observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function eliminar ($id_kardex,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE id_kax= '$id_kardex'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para cancelar el vale de producción
function cancelar ($refe_1,$conexion){
    $query="UPDATE kardex SET estado=2, status='CANCELADO', status_2='CANCELADO' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function actualizarnew2 ($id_kax,$codigo_1,$salida,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1',cantidad_real=$salida,entrada=0,salida=$salida,observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el vale de produccion individualmente
function registrarind ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','PEDIDO','$tipo_ref','$proveedor_cliente','$ubicacion',$cantidad_real,0,$salida,0,0,0,'$observa','','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para autorizar+++++++++++++++++++++++++++++++++++++++++
function autorizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='AUTORIZADO' WHERE refe_1 = '$folio' AND tipo='PEDIDO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function autorizar2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_autorizacion='$fecha', id_person_autor='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para LIBERAR
function liberarvpro($foliovp,$conexion){
    $query="UPDATE kardex SET status='PENDIENTE' WHERE refe_1 = '$foliovp' AND tipo='PEDIDO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);

}
//funcion para surtir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function surtir1 ($folio,$conexion){
    $query="UPDATE kardex SET status='SURTIDO' WHERE refe_1 = '$folio' AND tipo='PEDIDO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function surtir2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_surtido='$fecha', id_person_surtio='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function surtirart ($id_kax,$refe_1,$codigo_1,$cantidad,$observa_dep,$conexion){
    $query="UPDATE kardex SET status_2 ='SURTIDO',salida='$cantidad',codigo_1='$codigo_1',observa_dep='$observa_dep' WHERE refe_1 = '$refe_1' AND tipo='PEDIDO' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar sin existencia extendido y etiquetas
function sinexistartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET salida='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='PEDIDO' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//FINALIZA+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
//funcion para finalizar
function finalizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='FINALIZADO' WHERE refe_1 = '$folio' AND tipo='PEDIDO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//FINALIZAR2
function finalizar2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_finalizacion='$fecha', id_person_final='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion que marca sin existencia 
function sinexiste ($id_kax,$refe_1,$codigo_1,$observa_dep,$conexion){
    $query="UPDATE kardex SET salida=0,entrada=0,observa_dep='$observa_dep',status_2='SIN EXISTENCIAS' WHERE refe_1 = '$refe_1' AND tipo='PEDIDO' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar surtido
function surtirartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET salida='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='PEDIDO' AND id_kax =$id_kax";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN PEDIDO', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico 
function histedith($usuario,$realizo,$id_kax,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', concat('FOLIO:',(select refe_1 from kardex where id_kax  = '$id_kax')),'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

function histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', concat('FOLIO:',(select refe_1 from kardex where id_kax= '$id_kardex'), ' CODIGO: ' '$codigo_1'),'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico 
function histedith2($usuario,$realizo,$id_kax,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', concat('FOLIO:',(select refe_1 from kardex where id_kax  = '$id_kax'),' COIGO:', '$codigo_1'),'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra articulo individual
function historialinv($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN ARTICULO AL PEDIDO', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1' ' CANTIDAD:' ' $cantidad_real','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra historial de autorización
function histautoriza($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AUTORIZA PEDIDO', 'FOLIO:' '$folio','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisliber($usuario,$foliovp,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'LIBERA PEDIDO', 'FOLIO:' '$foliovp','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function histsurt($usuario,$foliovp,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE PEDIDO', 'FOLIO:' '$foliovp','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function histfinal($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'FINALIZA EL PEDIDO', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico de surtir
function hisurtir2($usuario,$refe_1,$codigo_1,$cantidad,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE ARTICULO DEL PEDIDO', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1 ' 'CANTIDAD: ' '$cantidad' ,'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico sin existencias
function histnoexist($usuario,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'MARCA QUE NO HAY EXISTENCIAS AL ARTICULO DEL PEDIDO', 'FOLIO:' '$refe_1' ' ARTICULO: ' '$codigo_1','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ACTUALIZA ARTICULO YA SURTIDO', 'FOLIO:' '$refe_1 ' 'ARTICULO: ' ' $descrip' ' CANTIDAD:' '$cantidad','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

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
               // $usuario='PRUEBAS';
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
                //$usuario='PRUEBAS';
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
                //$usuario='PRUEBAS';
                histedith($usuario,$folio,$conexion);
                autorizar2($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
     //Condición donde surte el memo
    }else if($opcion === 'surtirmem'){
        $folio = $_POST['folio'];
            if (surtir($folio,$conexion)){
                echo "0";
               // $usuario='PRUEBAS';
                hisurtir($usuario,$folio,$conexion);
                surtir2($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //condicion para finalizar el memo finalmem
    }else if($opcion === 'finalmem'){
        $folio = $_POST['folio'];
            if (finalizar ($folio,$conexion)){
                echo "0";
               // $usuario='PRUEBAS';
                hisfinal($usuario,$folio,$conexion);
                finalizar2 ($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //Elimar memo
    }else if($opcion === 'deletememo'){
        $pedido = $_POST['pedido'];
            if (elimemo ($pedido,$conexion)){
                echo "0";
               // $usuario='PRUEBAS';
                hisdelme($usuario,$pedido,$conexion); 
            }else{
                echo "1";
            }
    }else if($opcion === 'liberarmem'){
        $memo = $_POST['memo'];
            if (liberarmem ($memo,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                hisliber($usuario,$memo,$conexion); 
            }else{
                echo "1";
            }
    }else if($opcion === 'actualizainf'){
        $refe_1 = $_POST['refe_1'];
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];        
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];

        if (actualizar($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO';
           // $usuario='pruebas';
            histedithme($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
    }else if($opcion === 'delinfarm'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        if (eliminarinf($id_kax,$refe_1,$conexion)){
            echo "0";
            $realizo = 'ELIMINACIÓN DE ARTICULO EN MEMO';
            // $usuario='pruebas';
            histdeinf($id_kax,$refe_1,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'registar3'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $refe_3 = $_POST['refe_3'];
        $fecha = $_POST['fecha'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
        $descripcion_1 = $_POST['descripcion_1'];
        $cantidad_real = $_POST['cantidad_real'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];
        $ubicacion = $_POST['ubicacion'];
        $refe_2 = $_POST['refe_2'];
        if (registrar_3($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion)){
            echo "0";
            $realizo = 'AGREGA ARTICULO EN MEMO';
            historial($usuario,$refe_1,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'registar4'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $refe_3 = $_POST['refe_3'];
        $fecha = $_POST['fecha'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
        $descripcion_1 = $_POST['descripcion_1'];
        $cantidad_real = $_POST['cantidad_real'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];
        $ubicacion = $_POST['ubicacion'];
        $refe_2 = $_POST['refe_2'];
        if (registrar_4($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion)){
            echo "0";
            $realizo = 'AGREGA ARTICULO EN MEMO';
            historial($usuario,$refe_1,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'cambiocab'){
        $fecha = $_POST['fecha'];
        $refe_3 = $_POST['refe_3'];
        $status = $_POST['status'];
        $refe_1 = $_POST['refe_1'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
    
            if (cambio($fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                histedith2($usuario,$fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'cancelar'){
        $refe_1 = $_POST['refe_1'];
        
            if (cancelar($refe_1,$conexion)){
                echo "0";
                //cancfolio ($refe_1,$conexion);
            }else{
                echo "1";
            }
    //Condición para generar codigo
    }else if($opcion === 'gefolio'){
        $tipo = $_POST['tipo'];
        if (addfolio ($tipo,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //edthsinexisfin
    }else if ($opcion === 'addmemo'){
        $refe_1 = $_POST['refe_1'];
        if (histoaltmem ($usuario,$refe_1,$conexion)){
            echo "0";
            poductividad ($usuario,$refe_1,$conexion);
        }else{
            echo "1";
        }
    //ACTUALIZA LA RELACION DE JLM
    }else if($opcion === 'revisionac'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //guarda edicion de entrada
    }else if($opcion === 'actualizainfv2'){
        $refe_1 = $_POST['refe_1'];
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];        
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];

        if (actualizarv2($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO';
           // $usuario='pruebas';
            histedithme($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
    }else if($opcion === 'actualizainfv2'){
        $refe_1 = $_POST['refe_1'];
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];        
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $observa = $_POST['observa'];

        if (actualizarv2($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO';
           // $usuario='pruebas';
            histedithme($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
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
//Agregar folio
function addfolio ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='MEMO' AND estado_f=0";
    $foliomemo = mysqli_query($conexion,$folios);
    $folio = mysqli_fetch_row($foliomemo);
    $query="INSERT INTO folios VALUES(0,'$folio[0]','$tipo',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para registrar la productividad
function poductividad ($usuario,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="INSERT INTO productividad VALUES(0,'$refe_1','$usuario','$fecha','PENDIENTE','','PENDIENTE','','PENDIENTE','','NORMAL',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
function cancfolio ($refe_1,$conexion){
    $query="UPDATE folios SET estado_f=1 WHERE folio = '$refe_1' and tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el ARTICULO PARA TRASFORMACION EN LATA DE MEO 
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
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','MEMO','ARTICULO_TRANSFORMADO','$proveedor_cliente','$ubicacion','$cantidad_real','$salida',0,0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el ARTICULO TRASFORMADO EN ALTA MEMO
function registrar_3 ($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','MEMO','ARTICULO_TRANSFORMACION','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el ARTICULO TRASFORMADO EN ALTA MEMO
function registrar_4 ($refe_1,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$refe_2,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','MEMO','ARTICULO_TRANSFORMADO','$proveedor_cliente','$ubicacion','$cantidad_real','$salida',0,0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para cancelar el registro
function cancelar ($refe_1,$conexion){
    $query="UPDATE kardex SET estado=2, status='CANCELADO', status_2='CANCELADO' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera desde la vista previa del memo
function cambio ($fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', refe_3='$refe_3', status='$status', proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
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
//funcion para surtir
function surtir ($folio,$conexion){
    $query="UPDATE kardex SET status='SURTIDO', status_2='SURTIDO' WHERE refe_1 = '$folio' AND tipo='MEMO'";
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
//funcion para elimar memo
function elimemo ($pedido,$conexion){
    $query="UPDATE kardex SET estado=1 WHERE refe_1 = '$pedido' AND tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para LIBERAR memo
function liberarmem ($memo,$conexion){
    $query="UPDATE kardex SET status='PENDIENTE' WHERE refe_1 = '$memo' AND tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);

}
///funcion para actualizar aticulo de memo en vista previa
function actualizar ($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1',salida='$salida',observa='$observa' WHERE refe_1 = '$refe_1' AND id_kax='$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
///funcion para actualizar aticulo de memo en vista previa
function actualizarv2 ($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1',entrada='$salida',observa='$observa' WHERE refe_1 = '$refe_1' AND id_kax='$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
///funcion para actualizar aticulo de memo en vista previa
function eliminarinf ($id_kax,$refe_1,$conexion){
    $query="UPDATE kardex SET estado=1 WHERE id_kax='$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1' and tipo='MEMO'";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA ARTICULO A MEMO', 'FOLIO:' '$refe_1' ' ARTICULO PARA TRANSFORMACIÓN:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function histoaltmem($usuario,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA MEMO', 'FOLIO:' '$refe_1','$fecha')";
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
//funciones para guardar el historico de la edicion de cabecra de memo
function histedith2($usuario,$fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'EDITA INFORMACIÓN DE LA CABECERA DE MEMO', '$refe_1' ' FECHA:' '$fecha'  ' TIPO: '  ' $refe_3' ' status:' ' $status' ' SOLICITANTE:' ' $proveedor_cliente' ,'$fecha1')";
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
//funciones para guardar eliminar
function hisdelme($usuario,$pedido,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ELIMINA MEMO', 'FOLIO:' '$pedido','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para liberar memo
function hisliber($usuario,$memo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'LIBERA MEMO', 'FOLIO:' '$memo','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar historial de guardad edicion de articulo vista previa memo
function histedithme($refe_1,$id_kax,$codigo_1,$descripcion_1,$salida,$observa,$usuario,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO: ' '$refe_1' ' ID: ' '$id_kax ' 'CODIGO: ' '$codigo_1' ' SALIDA: ' '$salida' ' OBSERVACIONES ' '$observa','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

function histdeinf($id_kax,$refe_1,$usuario,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO: ' '$refe_1' ' ID: ' '$id_kax' ,'$fecha1')";
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
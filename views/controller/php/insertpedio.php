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
    }else if($opcion === 'surmasivo'){
        $valor = $_POST['array1'];
        $varray1 = json_decode($valor, true);
        $valor = count($varray1);
        $array2 = $_POST['array2'];
        $array2 = json_decode($array2, true);
        $array3 = $_POST['array3'];
        $array3 = json_decode($array3, true);
        $folio = $_POST['folio'];
        for($i=0; $i<$valor; $i++){
            $idcurs = $varray1[$i]["idperon"];
            if($idcurs==''){
            }else{
                $evaluacion = $array2[$i]["evaluacion"];
                $observaciones = $array3[$i]["observaciones"];
                if($evaluacion >= 1){
                    $estatus='SURTIDO';
                }else if($evaluacion == 0){
                    $estatus='SIN EXISTENCIAS';
                }else if($evaluacion == ''){
                    $estatus='PENDIENTE';
                }
                //llamada al guardo
                if(masivosurtir($idcurs,$evaluacion,$estatus,$observaciones,$conexion)){	
                    echo "0";
                    hisurtmasiv($usuario,$folio,$conexion);	
                }else{	
                    echo "1";	
                }
            }
        }
    }else if($opcion === 'savecabez'){
        $refe_1 = $_POST['refe_1'];
        $refe_2 = $_POST['refe_2'];
        $fecha = $_POST['fecha'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
        $refe_3 = $_POST['refe_3'];
        $ubicacion = $_POST['ubicacion'];
        $descripcion_1 = $_POST['descripcion_1'];
        $pedidcaracter = $_POST['pedidcaracter'];
        if (updatehader($refe_1,$refe_2,$fecha,$proveedor_cliente,$refe_3,$ubicacion,$descripcion_1,$pedidcaracter,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            updatehadercar($refe_1,$pedidcaracter,$conexion);
            histhader($usuario,$refe_1,$conexion); 
        }else{
            echo "1";
        }
    //Actualiza la informacion de no surtir producto final
    }else if ($opcion === 'registrarpre'){
        $referencia = $_POST['referencia'];
        $codigo = $_POST['codigo'];
        if (comprobacionpre ($referencia,$codigo,$conexion)){
            $fecha = $_POST['fecha'];
            $atendio = $_POST['atendio'];
            $cliente = $_POST['cliente'];
            $caracter = $_POST['caracter'];
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $observa = $_POST['observa'];
            $lugar = $_POST['lugar'];
            $direccion = $_POST['direccion'];
            
            if (registrarpre($referencia,$fecha,$atendio,$cliente,$caracter,$codigo,$cantidad,$observa,$lugar,$direccion,$conexion)){
                echo "0";
                //poductividad($refe_1,$caracter,$usuario,$conexion);
                historialpre($usuario,$referencia,$codigo,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el prepedido
    }else if($opcion === 'cancelarpre'){
        $refe_1 = $_POST['refe_1'];
            if (cancelar($refe_1,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //Condición donde se actualiza articulo de prepedido
    }else if($opcion === 'updatearprepinfo'){
        $id_pre = $_POST['id_pre'];
        $codigo = $_POST['codigo'];
        $cantidad = $_POST['cantidad'];
        $observa = $_POST['observa'];

            if (updateprepedido($id_pre,$codigo,$cantidad,$observa,$conexion)){
                echo "0";
                $realizo = 'ACTUALIZA ARTICULO DEL PREPEDIDO';
                histcambiospre($usuario,$realizo,$id_pre,$codigo,$conexion);
            }else{
                echo "1";
            }
    //Condición donde agrega un articulo  
    }else if($opcion === 'deleartprenew'){
        $id_pre = $_POST['id_pre'];
        $codigo = $_POST['codigo'];
            if (eliminarpreart($id_pre,$conexion)){
                echo "0";
                $realizo = 'ELIMINA ARTICULO DEL PEDIDO';
                histcambiospre($usuario,$realizo,$id_pre,$codigo,$conexion);
            }else{
                echo "1";
            }
    //Condición donde agrega un articulo deleartprenew 
    }else if($opcion === 'registrarindpre'){
        $referencia = $_POST['referencia'];
        $codigo = $_POST['codigo'];
    
        if (comprobacionpre ($referencia,$codigo,$conexion)){
            $fecha = $_POST['fecha'];
            $atendio = $_POST['atendio'];
            $cliente = $_POST['cliente'];
            $caracter = $_POST['caracter'];
            $codigo = $_POST['codigo'];
            $cantidad = $_POST['cantidad'];
            $observa = $_POST['observa'];
            $lugar = $_POST['lugar'];
            $direccion = $_POST['direccion'];
            
            if (registrarpre($referencia,$fecha,$atendio,$cliente,$caracter,$codigo,$cantidad,$observa,$lugar,$direccion,$conexion)){
                echo "0";
                //poductividad($refe_1,$caracter,$usuario,$conexion); 
                historialpre($usuario,$referencia,$codigo,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    }else if($opcion === 'conpedido'){
        $folio = $_POST['folio'];
            if (converpedido($folio,$conexion)){
                echo "0";
                $realizo = 'SE CONVIERTE EN PEDIDO';
                histcambiospre($usuario,$realizo,$id_pre,$codigo,$conexion);
            }else{
                echo "1";
            }
    //Condición donde agrega un articulo   
    }else if($opcion === 'savecabezpre'){
        $referencia = $_POST['referencia'];
        $atendio = $_POST['atendio'];
        $fecha = $_POST['fecha'];
        $cliente = $_POST['cliente'];
        $lugar = $_POST['lugar'];
        $direccion = $_POST['direccion'];
        $pedidcaracter = $_POST['pedidcaracter'];
        if (updatehaderpre($referencia,$atendio,$fecha,$cliente,$lugar,$direccion,$pedidcaracter,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';

        }else{
            echo "1";
        }
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
    cerrar($conexion);
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
    cerrar($conexion);
}
//funcion para guardar el articulo de producción
function registrar ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','PEDIDO','ARTICULO','$proveedor_cliente','$ubicacion','$cantidad_real',0,$salida,'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
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
    cerrar($conexion);
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
    cerrar($conexion);
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
function masivosurtir($idcurs,$evaluacion,$estatus,$observaciones,$conexion){
    $query="UPDATE kardex SET salida = '$evaluacion',status_2='$estatus', observa_dep='$observaciones' WHERE id_kax=$idcurs";
    if(mysqli_query($conexion,$query)){
		return true;
	}else{
		return false;
	}
	cerrar($conexion);
}
function updatehader($refe_1,$refe_2,$fecha,$proveedor_cliente,$refe_3,$ubicacion,$descripcion_1,$pedidcaracter,$conexion){
    $query="UPDATE kardex SET refe_2='$refe_2', fecha='$fecha',proveedor_cliente='$proveedor_cliente',refe_3='$refe_3',ubicacion='$ubicacion',descripcion_1='$descripcion_1' WHERE refe_1='$refe_1' AND tipo='PEDIDO'";
    if(mysqli_query($conexion,$query)){
		return true;
	}else{
		return false;
	}
	cerrar($conexion);
}

function updatehadercar($refe_1,$pedidcaracter,$conexion){
    $query="UPDATE productividad SET caracter_vale='$pedidcaracter' WHERE referencia_1='$refe_1'";
    if(mysqli_query($conexion,$query)){
		return true;
	}else{
		return false;
	}
	cerrar($conexion);
}

//FUNCIONES PARA PREPEDIDOS
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacionpre ($referencia,$codigo,$conexion){
    $query="SELECT * FROM prepedidos WHERE referencia = '$referencia' AND  codigo='$codigo' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para guardar el articulo de producción
function registrarpre($referencia,$fecha,$atendio,$cliente,$caracter,$codigo,$cantidad,$observa,$lugar,$direccion,$conexion){
    $query="INSERT INTO prepedidos VALUES(0,'$referencia','$fecha','$cliente','$atendio','$caracter','$codigo','$cantidad','$observa','$lugar','$direccion','PENDIENTE',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para cancelar el vale de producción
function cancelarpre ($refe_1,$conexion){
    $query="UPDATE prepedidos SET estado=1 WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el articulo de prepedidos
function updateprepedido($id_pre,$codigo,$cantidad,$observa,$conexion){
    $query="UPDATE prepedidos SET codigo='$codigo', cantidad='$cantidad', observa='$observa' WHERE id_pre='$id_pre'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function eliminarpreart($id_pre,$conexion){
    $query="UPDATE prepedidos SET estado=1 WHERE id_pre='$id_pre'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function converpedido($folio,$conexion){
    $query="UPDATE prepedidos SET status='PEDIDO' WHERE referencia='$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function updatehaderpre($referencia,$atendio,$fecha,$cliente,$lugar,$direccion,$pedidcaracter,$conexion){
    $query="UPDATE prepedidos SET referencia='$referencia', fecha='$fecha',atendio='$atendio',cliente='$cliente',lugar='$lugar',direccion='$direccion',caracter='$pedidcaracter' WHERE referencia='$referencia'";
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
//funciones para guardar el historico liberar
function histhader($usuario,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ACTUALIZA LA CABEZERA DEL PEDIDO', 'FOLIO:' '$refe_1 ','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico liberar
function hisurtmasiv($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE MASIVAMENTE PEDIDO', 'FOLIO:' '$folio',' $fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funcion para registra cambios
function historialpre($usuario,$referencia,$codigo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN PREPEDIDO', 'FOLIO:' '$referencia' ' ARTICULO:' ' $codigo','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funcion para registra cambios
function histcambiospre($usuario,$realizo,$id_pre,$codigo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','$realizo', 'ID REGISTRO:' '$id_pre' ' ARTICULO:' ' $codigo','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}





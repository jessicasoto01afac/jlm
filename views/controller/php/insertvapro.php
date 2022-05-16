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
            
            if (registrar($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion)){
                echo "0";
                extendido($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                etiqueta($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'cancelar'){
        $refe_1 = $_POST['refe_1'];
        
            if (cancelar($refe_1,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //Condición donde agrega un articulo individualmente
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
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica 
    }else if($opcion === 'regcarton'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocart = $_POST['codigocart'];
    
        if (comprobacion2 ($refe_1,$codigocart,$conexion)){
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
            
            if (carton($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocart,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcar($usuario,$refe_1,$codigocart,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el cartonsillo si aplica 
    }else if($opcion === 'regcartonsillo'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocartons = $_POST['codigocartons'];
    
        if (comprobacion3 ($refe_1,$codigocartons,$conexion)){
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
            
            if (cartonsillo($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocartons,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcarsll($usuario,$refe_1,$codigocartons,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica 
    }else if($opcion === 'regcaple'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocaple = $_POST['codigocaple'];
    
        if (comprobacion4 ($refe_1,$codigocaple,$conexion)){
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
            
            if (caple($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocaple,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcaple($usuario,$refe_1,$codigocaple,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica regcaple
    }else if($opcion === 'regliston'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigolist = $_POST['codigolist'];
    
        if (comprobacion5 ($refe_1,$codigolist,$conexion)){
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
            
            if (liston($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigolist,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialist($usuario,$refe_1,$codigolist,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    }//Condición donde se agrega el carton si aplica regcaple
    


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
function comprobacion2 ($refe_1,$codigocart,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocart' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion3 ($refe_1,$codigocartons,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocartons' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion4 ($refe_1,$codigocaple,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocaple' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion5 ($refe_1,$codigolist,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigolist' AND estado = 0 ";
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
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_PRODUCCION','PRODUCTO_TERMINADO','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida','0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el vale de produccion individualmente
function registrarind ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_PRODUCCION','$tipo_ref','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida','0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el exendido de articulo de trasformación
function extendido ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha',concat((select id_extendido from transforma where id_articulo_final = '$codigo_1')),concat((select artdescrip from articulos where artcodigo = (select id_extendido from transforma where id_articulo_final = '$codigo_1'))),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente','$ubicacion',concat((select $cantidad_real * hojas / divicion from transforma where id_articulo_final = '$codigo_1')),0,concat((select $cantidad_real * hojas / divicion from transforma where id_articulo_final = '$codigo_1')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar la etiqueta de articulo de trasformación
function etiqueta ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha',concat((select id_etiquetas from transforma where id_articulo_final = '$codigo_1')),concat((select artdescrip from articulos where artcodigo = (select id_etiquetas from transforma where id_articulo_final = '$codigo_1'))),'VALE_PRODUCCION','ETIQUETAS','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida','0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el carton de articulo de trasformación
function carton ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocart,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocart',concat((select artdescrip from articulos where artcodigo = '$codigocart')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocart')),concat((select $cantidad_real * multi_carton / div_carton from transforma where id_articulo_final = '$codigo_1')),0,concat((select $cantidad_real * multi_carton / div_carton from transforma where id_articulo_final = '$codigo_1')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el cartonsillo de articulo de trasformación
function cartonsillo ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocartons,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocartons',concat((select artdescrip from articulos where artcodigo = '$codigocartons')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocartons')),concat((select $cantidad_real * multi_cartonsillo / div_cartonsillo from transforma where id_articulo_final = '$codigo_1')),0,concat((select $cantidad_real * multi_cartonsillo / div_cartonsillo from transforma where id_articulo_final = '$codigo_1')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el caple de articulo de trasformación
function caple ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocaple,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocaple',concat((select artdescrip from articulos where artcodigo = '$codigocaple')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocaple')),concat((select $cantidad_real * multi_caple / div_caple from transforma where id_articulo_final = '$codigo_1')),0,concat((select $cantidad_real * multi_caple / div_caple from transforma where id_articulo_final = '$codigo_1')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el liston de articulo de trasformación
function liston ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigolist,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigolist',concat((select artdescrip from articulos where artcodigo = '$codigolist')),'VALE_PRODUCCION','ETIQUETAS','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigolist')),concat((select $cantidad_real * multi_liston from transforma where id_articulo_final = '$codigo_1')),0,concat((select $cantidad_real * multi_liston from transforma where id_articulo_final = '$codigo_1')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
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
function actualizar ($codigo_1,$descripcion_1,$salida,$observa,$id_kax,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', salida='$salida', observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro desde la vista previa del vale de vale de producción
function cambio ($fecha,$refe_3,$status,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', refe_3='$refe_3', status='$status', proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function edicion ($codigo_1,$descripcion_1,$salida,$costo,$total,$observa,$id_kax,$refe_1,$estatus2,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', salida='$salida', costo='$costo', total='$total', observa='$observa', status_2='$estatus2' WHERE id_kax = '$id_kax'";
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
//función para surtir con existencias
function existencia ($id_kax,$cantidad,$codigo_1,$descripcion,$conexion){
    $query="UPDATE kardex SET status_2='SURTIDO', salida='$cantidad', codigo_1='$codigo_1', descripcion_1='$descripcion' WHERE id_kax = '$id_kax'";
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

//funcion para autorizar
function autorizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='AUTORIZADO' WHERE refe_1 = '$folio' AND tipo='VALE_OFICINA'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para surtir
function surtir1 ($folio,$conexion){
    $query="UPDATE kardex SET status='SURTIDO' WHERE refe_1 = '$folio' AND tipo='VALE_OFICINA'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para finalizar
function finalizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='FINALIZADO' WHERE refe_1 = '$folio' AND tipo='VALE_OFICINA'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para LIBERAR vale
function liberarvo ($valeof,$conexion){
    $query="UPDATE kardex SET status='PENDIENTE' WHERE refe_1 = '$valeof' AND tipo='VALE_OFICINA'";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'CODIGO:' ' $refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcar($usuario,$refe_1,$codigocart,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'CODIGO:' ' $refe_1' ' ARTICULO:' ' $codigocart','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcarsll($usuario,$refe_1,$codigocartons,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'CODIGO:' ' $refe_1' ' ARTICULO:' '$codigocartons','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcaple($usuario,$refe_1,$codigocaple,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'CODIGO:' ' $refe_1' ' ARTICULO: ' '$codigocaple','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialist($usuario,$refe_1,$codigolist,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'CODIGO:' ' $refe_1' ' ARTICULO:' ' $codigolist','$fecha')";
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
function hisexist($usuario,$realizo,$cantidad,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'VALE DE OFICINA FOLIO:' '$refe_1' ' ARTICULO: ' '$codigo_1' ' CANTIDAD: ' '$cantidad' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico
function histaut($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'AUTORIZA VALE DE OFICINA', 'FOLIO:' '$folio','$fecha1')";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE VALE DE OFICINA', 'FOLIO:' '$folio','$fecha1')";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'FINALIZA VALE DE OFICINA', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisliber($usuario,$valeof,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'LIBERA VALE DE OFICINA', 'FOLIO:' '$valeof','$fecha1')";
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
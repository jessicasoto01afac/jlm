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
        $folio_oc = $_POST['folio_oc'];
        $id_artprove = $_POST['id_artprove'];
        if (comprobacion ($folio_oc,$id_artprove,$conexion)){
            $fecha = $_POST['fecha'];
            $fecha_entrga = $_POST['fecha_entrga'];
            $id_proveedor = $_POST['id_proveedor'];
            $uso_CFDI = $_POST['uso_CFDI'];
            $cond_pago = $_POST['cond_pago'];
            $asignado = $_POST['asignado'];
            $id_articulo = $_POST['id_articulo'];
            $cantidad = $_POST['cantidad'];
            $observación = $_POST['observación'];

            if (registrar($folio_oc,$fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$id_articulo,$id_artprove,$cantidad,$observación,$conexion)){
                echo "0";
                //historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'gefolio'){
        $tipo = $_POST['tipo'];
            if (addfolio ($tipo,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //CANCELAR
    }else if($opcion === 'cancelar'){
        $folio_oc = $_POST['folio_oc'];
        
            if (cancelar($folio_oc,$conexion)){
                echo "0";
                cancfolio ($folio_oc,$conexion);
                historialcanl($usuario,$folio_oc,$conexion);
            }else{
                echo "1";
            }
    //Condición para generar codigo
    }else if($opcion === 'updateart'){
        $folio_oc = $_POST['folio_oc'];
        $idarti = $_POST['idarti'];
        $id_articulo = $_POST['id_articulo'];
        $id_artprove = $_POST['id_artprove'];
        $cantidad = $_POST['cantidad'];
        $observación = $_POST['observación'];
        
            if (actualizar($folio_oc,$idarti,$id_articulo,$id_artprove,$cantidad,$observación,$conexion)){
                echo "0";
                $realizo = 'ACTUALIZO EL ARTICULO DE LA ORDEN DE COMPRA';
                histedartshop($usuario,$idarti,$id_articulo,$id_artprove,$cantidad,$observación,$folio_oc,$realizo,$conexion);
            }else{
                echo "1";
            }
    //Condición para generar codigo
    }else if($opcion === 'deleartnew'){
        $idarti = $_POST['idarti'];
        $id_articulo = $_POST['id_articulo'];
        $folio_oc = $_POST['folio_oc'];
        if (eliminar($idarti,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DE LA ORDEN DE COMPRA';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$idarti,$id_articulo,$folio_oc,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'revisionac'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //guarda edicion de entrada
    }else if($opcion === 'cambiocabdv'){
        $fecha = $_POST['fecha'];
        $fecha_entrga  = $_POST['fecha_entrga'];
        $id_proveedor = $_POST['id_proveedor'];
        $uso_CFDI = $_POST['uso_CFDI'];
        $cond_pago = $_POST['cond_pago'];
        $asignado = $_POST['asignado'];
        $refe_1= $_POST['refe_1'];
            if (cambiocmp($fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$refe_1,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                $realizo = 'EDITA INFORMACIÓN DE LA CABECERA DE COMPRAS';
                histedith2($usuario,$realizo,$fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$refe_1,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario  
    }else if($opcion === 'autorizarcm'){
        $folio = $_POST['folio'];
        if (autorizar($folio,$conexion)){
            echo "0";
            $realizo='AUTORIZA ORDEN DE COMPRAS';
            histautorizar($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'liberarcm'){
        $folio = $_POST['folio'];
        if (liberar($folio,$conexion)){
            echo "0";
            $realizo='LIBERA ORDEN DE COMPRAS';
            histautorizar($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'entrada'){
        $folio = $_POST['folio'];
        $fecha = $_POST['fecha'];
        $fecha_entrga = $_POST['fecha_entrga'];
        $id_proveedor = $_POST['id_proveedor'];
        $uso_CFDI = $_POST['uso_CFDI'];
        $cond_pago = $_POST['cond_pago'];
        $asignado = $_POST['asignado'];
        $id_articulo = $_POST['id_articulo'];
        $id_artprove = $_POST['id_artprove'];
        $cantidad = $_POST['cantidad'];
        $observación = $_POST['observación'];
        $id_comp = $_POST['id_comp'];
        $comparcant = $_POST['comparcant'];
        $estadokardex=0;
        $estadok='';
        $realizo='';
        if ($cantidad < $comparcant){
            $estadokardex=2;
            $estadok='ENTRADA PARCIAL';
            $realizo='INGRESA ENTRADA PARCIAL DE LA ORDEN DE COMPRA';
        }else{
            $estadokardex=1;
            $estadok='ENTRADA';
            $realizo='INGRESA ENTRADA DE LA ORDEN DE COMPRA';
        }

        if (entrada($id_comp,$id_proveedor,$id_articulo,$id_artprove,$estadokardex,$conexion)){
            echo "0";
            inserkardex($folio,$fecha,$fecha_entrga,$id_articulo,$cantidad,$observación,$id_comp,$id_proveedor,$estadok,$comparcant,$conexion);
            histautorizar($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
        
    }else if($opcion === 'entradaeth'){
        $refe_2 = $_POST['refe_2'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $cantidadreal = $_POST['cantidadreal'];
        $estadok='0';
        if ($cantidad < $cantidadreal){
            $estadok='ENTRADA PARCIAL';
            $estadokardex=2;
        }else{
            $estadokardex=1;
            $estadok='ENTRADA';
            $realizo='INGRESA ENTRADA DE LA ORDEN DE COMPRA'.' '.$refe_1;
        }
        $folio=$_POST['refe_1'];
        if (edisurtid($refe_2,$refe_1,$cantidad,$observa_dep,$estadok,$conexion)){
            echo "0";
            $realizo='EDITA ENTRADA EN ORDEN DE COMPRA'.' '.$refe_1;
            confentrada($refe_2,$refe_1,$estadokardex,$conexion);
            histautorizar($usuario,$realizo,$cantidad,$conexion);
        }else{
            echo "1";
        }
    }else if ($opcion === 'entradaparcial'){
        $folio = $_POST['folio'];
        $id_articulo = $_POST['id_articulo'];
        $id_artprove = $_POST['id_artprove'];
        $cantidad = $_POST['cantidad'];
        $observación = $_POST['observación'];
        $id_comp = $_POST['id_comp'];
        $total = $_POST['total'];
        $estatukardex=$_POST['estatukardex'];
       
        if ($estatukardex ==='2'){
            $estadok='ENTRADA PARCIAL';
            $realizo='INGRESA ENTRADA PARCIAL DE LA ORDEN DE COMPRA';
        }else{
            $estadok='ENTRADA';
            $realizo='INGRESA ENTRADA DE LA ORDEN DE COMPRA';
        }

        if (entradaparc($id_comp,$estatukardex,$conexion)){
            echo "0";
            inserkardexpar($folio,$id_articulo,$id_artprove,$cantidad,$observación,$id_comp,$estatukardex,$conexion);
            histautorizar($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }

    }else if($opcion === 'finalizarcm'){
        $folio = $_POST['folio'];
        if (finalizar($folio,$conexion)){
            echo "0";
            $realizo='FINALIZA ORDEN DE COMPRAS';
            histautorizar($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------


//Agregar folio
function addfolio ($tipo,$conexion){
    $folios="SELECT count(folio) + 1 AS id_foliovp FROM folios where tipo ='COMPRAS' AND estado_f=0";
    $foliomatdef = mysqli_query($conexion,$folios);
    $folio = mysqli_fetch_row($foliomatdef);
    $query="INSERT INTO folios VALUES(0,'$folio[0]','$tipo',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($folio_oc,$id_artprove,$conexion){
    $query="SELECT * FROM compras WHERE id_artprove = '$id_artprove' AND folio_oc='$folio_oc' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el ARTICULO PARA TRASFORMACION EN LATA DE MEO 
function registrar ($folio_oc,$fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$id_articulo,$id_artprove,$cantidad,$observación,$conexion){
    $query="INSERT INTO compras VALUES(0,'$folio_oc','$fecha','$fecha_entrga','$id_proveedor','$uso_CFDI','$cond_pago','$asignado','$id_articulo','$id_artprove','$cantidad','$observación','PENDIENTE',0,0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para cancelar el registro
function cancelar ($folio_oc,$conexion){
    $query="DELETE FROM compras WHERE folio_oc = '$folio_oc'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function cancfolio ($folio_oc,$conexion){
    $query="DELETE FROM folios WHERE folio = '$folio_oc' and tipo='COMPRAS'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function actualizar ($folio_oc,$idarti,$id_articulo,$id_artprove,$cantidad,$observación,$conexion){
    $query="UPDATE compras SET id_articulo='$id_articulo', id_artprove='$id_artprove',cantidad='$cantidad',observación='$observación' WHERE id_comp = '$idarti' AND folio_oc='$folio_oc'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar aticulo de memo en vista previa
function eliminar ($idarti,$conexion){
    $query="UPDATE compras SET estado=1 WHERE id_comp ='$idarti'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1' and tipo='COMPRAS'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera desde la vista DE MATERIAL DEFECTUOSO
function cambiocmp ($fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$refe_1,$conexion){
    $query="UPDATE compras SET fecha='$fecha', fecha_entrga='$fecha_entrga', id_proveedor='$id_proveedor',uso_CFDI='$uso_CFDI',cond_pago='$cond_pago',asignado='$asignado' WHERE folio_oc = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para autorizar
function autorizar ($folio,$conexion){
    $query="UPDATE compras SET estatus='AUTORIZADO' WHERE folio_oc = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para liberar
function liberar ($folio,$conexion){
    $query="UPDATE compras SET estatus='PENDIENTE' WHERE folio_oc = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para surtir
function entrada($id_comp,$id_proveedor,$id_articulo,$id_artprove,$estadokardex,$conexion){
    $query="UPDATE compras SET id_proveedor='$id_proveedor',id_artprove='$id_artprove',id_articulo='$id_articulo',estatuskardex='$estadokardex' WHERE id_comp = '$id_comp'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para entrada
function inserkardex($folio,$fecha,$fecha_entrga,$id_articulo,$cantidad,$observación,$id_comp,$id_proveedor,$estadok,$comparcant,$conexion){
    $query="INSERT INTO kardex VALUES (0,'$folio','$id_comp','0','$fecha','$id_articulo','0','COMPRAS','ARTICULO','$id_proveedor','0','$comparcant','$cantidad','0','0','0','0','$observación','NA','$estadok','PENDIENTE','NO','','0')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function edisurtid($refe_2,$refe_1,$cantidad,$observa_dep,$estadok,$conexion){
    $query="UPDATE kardex SET entrada='$cantidad', observa_dep='$observa_dep',status='$estadok' WHERE refe_2 = '$refe_2' and refe_1='$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//entradaparc($id_comp,$folio,$id_articulo,$id_artprove,$estatukardex,$conexion)

//funcion para surtir
function confentrada($refe_2,$refe_1,$estadokardex,$conexion){
    $query="UPDATE compras SET estatuskardex='$estadokardex' WHERE id_comp = '$refe_2' and folio_oc='$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para surtir parcial
function entradaparc($id_comp,$estatukardex,$conexion){
    $query="UPDATE compras SET estatuskardex='$estatukardex' WHERE id_comp = '$id_comp'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//inserkardexpar
function inserkardexpar($folio,$id_articulo,$id_artprove,$cantidad,$observación,$id_comp,$estatukardex,$conexion){
    $query="UPDATE kardex SET entrada='$cantidad', observa_dep='$observación',status='$estatukardex' WHERE refe_2 = '$id_comp' and refe_1='$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para finalizar
function finalizar ($folio,$conexion){
    $query="UPDATE compras SET estatus='FINALIZADO' WHERE folio_oc = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//--------------------FUNCIÓN DE HISTORIAL
function histedartshop($usuario,$idarti,$id_articulo,$id_artprove,$cantidad,$observación,$folio_oc,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO: ' '$folio_oc' ' ID: ' '$idarti ' 'CODIGO: ' '$id_articulo' 'CODIGO PROVEEDOR: ' '$id_artprove' ' CANTIDAD: ' '$cantidad' ' OBSERVACIONES ' '$observación','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

function historialcanl($usuario,$folio_oc,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'CANCELA ORDEN DE COMPRA', 'FOLIO: ' '$folio_oc','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

function histdelete($usuario,$realizo,$idarti,$id_articulo,$folio_oc,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO: ' '$folio_oc' ' ID: ' '$idarti ' 'CODIGO: ' '$id_articulo','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico de la edicion de cabecra de COMPRAS
function histedith2($usuario,$realizo,$fecha,$fecha_entrga,$id_proveedor,$uso_CFDI,$cond_pago,$asignado,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$refe_1' ' FECHA:' '$fecha'  ' FECHA DE ENTRAGA: '  ' $fecha_entrga' ' PROVEEEDOR:' ' $id_proveedor' ' USO DEL CFDI:' ' $uso_CFDI' ' CONDICION DE PAGO:' ' $cond_pago' ' ASIGNADA:' ' $asignado' ,'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funcion para guarda el historico de autorización
function histautorizar($usuario,$realizo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

function histsurt($usuario,$realizo,$cantidad,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'CANTIDAD:' '$cantidad','$fecha1')";
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
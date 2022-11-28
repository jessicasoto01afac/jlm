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
            $folio = $_POST['folio'];
            $id_articulo = $_POST['id_articulo'];
        if (comprobacion ($folio,$id_articulo,$conexion)){
            $cantidad = $_POST['cantidad'];
            $observ_recl = $_POST['observ_recl'];
            if (registrar($folio,$id_articulo,$cantidad,$observ_recl,$conexion)){
                echo "0";
                historial($usuario,$folio,$id_articulo,$conexion);
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
                cancfolio($refe_1,$conexion);

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
    }else if($opcion === 'actualizainf'){
        $folio = $_POST['folio'];
        $id_articulo = $_POST['id_articulo'];
        $cantidad = $_POST['cantidad'];        
        $observ_recl = $_POST['observ_recl'];
        $id_reclamo = $_POST['id_reclamo'];

        if (actualizar($folio,$id_articulo,$cantidad,$observ_recl,$id_reclamo,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO DEL REPORTE DE PROVEEDOR';
            historialup($folio,$id_articulo,$cantidad,$observ_recl,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
    }else if($opcion === 'savereport'){
            $folio = $_POST['folio'];
        if (comprobacion2 ($folio,$conexion)){
            $fecha_recl = $_POST['fecha_recl'];
            $tipo_reporte = $_POST['tipo_reporte'];
            $tipo_incidencia = $_POST['tipo_incidencia'];
            $orden_compra = $_POST['orden_compra'];
            $factura = $_POST['factura'];
            $proveedor = $_POST['proveedor'];
            $dep_report = $_POST['dep_report'];
            $pers_report = $_POST['pers_report'];
            $rep_jlm = $_POST['rep_jlm'];
            $code_jlm = $_POST['code_jlm'];
            $date_send = $_POST['date_send']; 
            $dept_provee = $_POST['dept_provee'];
            $evio_a = $_POST['evio_a'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $medios = $_POST['medios'];
            $seguimiento = $_POST['seguimiento'];
            $code_seguimiento = $_POST['code_seguimiento'];
            $conclusion = $_POST['conclusion'];
            $code_conclucion = $_POST['code_conclucion'];

            if (registrarprove($folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$orden_compra,$factura,$proveedor,$dep_report,$pers_report,$rep_jlm,$code_jlm,$date_send,$dept_provee,$evio_a,$email,$telefono,$medios,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$usuario,$conexion)){
                echo "0";
                historialclie($usuario,$folio,$tipo_reporte,$tipo_incidencia,$conexion);
            }else{
                echo "1";
            }
        }else{
            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'deleartnew'){
        $id_reclamo = $_POST['id_reclamo'];
        $folio = $_POST['folio'];
        if (eliminar($id_reclamo,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DEL REPORTE DE PROVEEDOR';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_reclamo,$folio,$conexion);
        }else{
            echo "1";
        }
    //ACTUALIZA LOS REPORTES
    }else if($opcion === 'updatesavereport'){
        $folio = $_POST['folio'];
        $rep_jlm = $_POST['rep_jlm'];
        $code_jlm = $_POST['code_jlm'];
        $date_send = $_POST['date_send']; 
        $dept_provee = $_POST['dept_provee'];
        $evio_a = $_POST['evio_a'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $medios = $_POST['medios'];
        $seguimiento = $_POST['seguimiento'];
        $code_seguimiento = $_POST['code_seguimiento'];
        $conclusion = $_POST['conclusion'];
        $code_conclucion = $_POST['code_conclucion'];
        if (updatereports($folio,$rep_jlm,$code_jlm,$date_send,$dept_provee,$evio_a,$telefono,$email,$medios,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZA EL REPORTE DE PROVEEDOR';
            // $usuario='pruebas';
            histuprep($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
    //ACTUALIZA EL HEADER DEL REPORTE  
    }else if($opcion === 'cambioheader'){
        $folio = $_POST['folio'];
        $fecha_recl=$_POST['fecha_recl'];
        $tipo_reporte=$_POST['tipo_reporte'];
        $tipo_incidencia=$_POST['tipo_incidencia'];
        $orden_compra=$_POST['orden_compra'];
        $factura=$_POST['factura'];
        $dep_resport=$_POST['dep_resport'];
        $pers_report=$_POST['pers_report'];
        $proveedor=$_POST['proveedor'];
        $estatus_recl=$_POST['estatus_recl'];
        if (updaheaderrep($folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$orden_compra,$factura,$dep_resport,$pers_report,$proveedor,$estatus_recl,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZA LOS DATOS DEL REPORTE DE PROVEEDOR';
            // $usuario='pruebas';
            histuprep($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción cambioheader  
    }else if($opcion === 'finalrep'){
        $folio = $_POST['folio'];
            if (finalizar1($folio,$conexion)){
                echo "0";
                histfinal($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //Actualiza la informacion de no surtir extendido y etiqueta
    }else if($opcion === 'liberarrep'){
        $folio = $_POST['folio'];
            if (liberar ($folio,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                hisliber($usuario,$folio,$conexion); 
            }else{
                echo "1";
            }
    }else if($opcion === 'deleterpcli'){
        $folio = $_POST['folio'];
            if (deleterepcl ($folio,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                histrecldete($usuario,$folio,$conexion); 
            }else{
                echo "1";
            }
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($folio,$id_articulo,$conexion){
    $query="SELECT * FROM artreclamos WHERE folio = '$folio' AND  id_articulo='$id_articulo' AND estado = 0 AND tipo='PROVEEDOR'";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion2 ($folio,$conexion){
    $query="SELECT * FROM reclamoclient WHERE folio_recl = '$folio' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//Agregar folio para nuevo reporte
function addfolio ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='$tipo' AND estado_f=0";
    $foliovale_p = mysqli_query($conexion,$folios);
    $folio = mysqli_fetch_row($foliovale_p);
    $query="INSERT INTO folios VALUES(0,'$folio[0]','$tipo',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el articulo de nuevo reporte
function registrar ($folio,$id_articulo,$cantidad,$observ_recl,$conexion){
    $query="INSERT INTO artreclamos VALUES(0,'$folio','$id_articulo','$cantidad','$observ_recl','PROVEEDOR',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el articulo de nuevo reporte ***OK
function registrarprove ($folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$orden_compra,$factura,$proveedor,$dep_report,$pers_report,$rep_jlm,$code_jlm,$date_send,$dept_provee,$evio_a,$email,$telefono,$medios,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$usuario,$conexion){
    $query="INSERT INTO reclamoproveedor VALUES(0,'$folio','$fecha_recl','$tipo_reporte','$tipo_incidencia','$orden_compra','$factura','$proveedor','$dep_report','$pers_report','$rep_jlm','$code_jlm','$date_send','$dept_provee','$evio_a','$email','$telefono','$medios','$seguimiento','$code_seguimiento','$conclusion','$code_conclucion','$usuario','PENDIENTE',0)";
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

//funcion para actualizar aticulo de memo en vista previa
function actualizar ($folio,$id_articulo,$cantidad,$observ_recl,$id_reclamo,$conexion){
    $query="UPDATE artreclamos SET id_articulo='$id_articulo', cantidad='$cantidad',observ_recl='$observ_recl' WHERE folio = '$folio' AND id_reclamo='$id_reclamo'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function eliminar ($id_reclamo,$conexion){
    $query="UPDATE artreclamos SET estado='1' WHERE id_reclamo= '$id_reclamo'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar los reportes
function updatereports ($folio,$rep_jlm,$code_jlm,$date_send,$dept_provee,$evio_a,$telefono,$email,$medios,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$conexion){
    $query="UPDATE reclamoproveedor SET rep_jlm='$rep_jlm', code_jlm='$code_jlm',date_send='$date_send',dept_provee='$dept_provee',evio_a='$evio_a',e_mail='$email',tel='$telefono',medio='$medios',seguimiento='$seguimiento',code_seguimiento='$code_seguimiento',conclusion='$conclusion',code_conclucion='$code_conclucion' WHERE folio_recl = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera de reporte
function updaheaderrep ($folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$orden_compra,$factura,$dep_resport,$pers_report,$proveedor,$estatus_recl,$conexion){
    $query="UPDATE reclamoproveedor SET fecha_recl='$fecha_recl', tipo_reporte='$tipo_reporte',tipo_incidencia='$tipo_incidencia',orden_compra='$orden_compra',pers_report='$pers_report',factura='$factura',dep_resport='$dep_resport',proveedor='$proveedor', estatus_recl='$estatus_recl' WHERE folio_recl = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para finalizar
function finalizar1 ($folio,$conexion){
    $query="UPDATE reclamoproveedor SET estatus_recl='FINALIZADO' WHERE folio_recl = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para liberar
function liberar ($folio,$conexion){
    $query="UPDATE reclamoproveedor SET estatus_recl='PENDIENTE' WHERE folio_recl = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para liberar
function deleterepcl ($folio,$conexion){
    $query="UPDATE reclamoclient SET estado='1' WHERE folio_recl = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function cancfolio ($refe_1,$conexion){
    $query="DELETE FROM folios WHERE folio = '$refe_1' and tipo='MEMO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//-------------------------------------------------------------------------------------------------------------------
//funcion para registra cambios
function historial($usuario,$folio,$id_articulo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN ARTICULO EN EL REPORTE DE PROVEEDOR', 'FOLIO:' '$folio' ' ARTICULO:' ' $id_articulo','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialup($folio,$id_articulo,$cantidad,$observ_recl,$usuario,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','$realizo', 'FOLIO:' '$folio' ' ARTICULO:' ' $id_articulo' ' CANTIDAD:' ' $cantidad' ' OBSERBACIONES' ' $observ_recl' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialclie($usuario,$folio,$tipo_reporte,$tipo_incidencia,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','GENERA UN ' '$tipo_reporte' ' PROVEEDOR', 'FOLIO:' '$folio' ' TIPO DE INCIDENCIA:' ' $tipo_incidencia','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function histdelete($usuario,$realizo,$id_reclamo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','$realizo', 'FOLIO:' '$folio' 'ARTICULO: ' (select id_articulo from id_reclamo = $id_reclamo) ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}


//funcion para registra cambios
function histuprep($usuario,$realizo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','$realizo', 'FOLIO:' '$folio','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico FINALIZAR
function histfinal($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'FINALIZA EL REPORTE DE PROVEEDOR', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisliber($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'LIBERA REPORTE DE PROVEEDOR', 'FOLIO:' '$folio','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function histrecldete($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ELIMINA UN REPORTE DE PROVEEDOR', 'FOLIO:' '$folio','$fecha')";
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
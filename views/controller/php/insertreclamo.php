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
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO';
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
            $remision = $_POST['remision'];
            $factura = $_POST['factura'];
            $deprechaclie = $_POST['deprechaclie'];
            $dep_responsa = $_POST['dep_responsa'];
            $rep_cliente = $_POST['rep_cliente'];
            $code_cliente = $_POST['code_cliente'];
            $rep_jlm = $_POST['rep_jlm'];
            $code_jlm = $_POST['code_jlm']; 
            $seguimiento = $_POST['seguimiento'];
            $code_seguimiento = $_POST['code_seguimiento'];
            $conclusion = $_POST['conclusion'];
            $code_conclucion = $_POST['code_conclucion'];
            $pedido2 = $_POST['pedido2'];
            
            if (registrarclie($usuario,$folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$remision,$factura,$deprechaclie,$dep_responsa,$rep_cliente,$code_cliente,$rep_jlm,$code_jlm,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$pedido2,$conexion)){
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
            $realizo = 'ELIMINA ARTICULO DEL REPORTE';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_reclamo,$folio,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($folio,$id_articulo,$conexion){
    $query="SELECT * FROM artreclamos WHERE folio = '$folio' AND  id_articulo='$id_articulo' AND estado = 0 ";
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
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='RECLAMO_CLIENTE' AND estado_f=0";
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
    $query="INSERT INTO artreclamos VALUES(0,'$folio','$id_articulo','$cantidad','$observ_recl','CLIENTE',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar el articulo de nuevo reporte
function registrarclie ($usuario,$folio,$fecha_recl,$tipo_reporte,$tipo_incidencia,$remision,$factura,$deprechaclie,$dep_responsa,$rep_cliente,$code_cliente,$rep_jlm,$code_jlm,$seguimiento,$code_seguimiento,$conclusion,$code_conclucion,$pedido2,$conexion){
    $query="INSERT INTO reclamoclient VALUES(0,'$folio','$fecha_recl','$deprechaclie','$pedido2','$remision','$factura','$rep_cliente','$code_cliente','$rep_jlm','$code_jlm','$seguimiento','$code_seguimiento','$conclusion','$code_conclucion','$usuario','0','PENDIENTE','$dep_responsa','$tipo_incidencia','$tipo_reporte',0)";
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
//-------------------------------------------------------------------------------------------------------------------
//funcion para registra cambios
function historial($usuario,$folio,$id_articulo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN ARTICULO EN EL REPORTE', 'FOLIO:' '$folio' ' ARTICULO:' ' $id_articulo','$fecha')";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','GENERA UN ' '$tipo_reporte' ' CLIENTE', 'FOLIO:' '$folio' ' TIPO DE INCIDENCIA:' ' $tipo_incidencia','$fecha')";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','$realizo', 'FOLIO :' ' $folio' 'ARTICULO: ' (select id_articulo from id_reclamo = $id_reclamo) ,'$fecha')";
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
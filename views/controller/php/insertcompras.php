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
            }else{
                echo "1";
            }
    //Condición para generar codigo
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
    $query="INSERT INTO compras VALUES(0,'$folio_oc','$fecha','$fecha_entrga','$id_proveedor','$uso_CFDI','$cond_pago','$asignado','$id_articulo','$id_artprove','$cantidad','$observación','PENDIENTE',0)";
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



//funcion para cerrar laa conexion
function cerrar($conexion){
    mysqli_close($conexion);
}

?>
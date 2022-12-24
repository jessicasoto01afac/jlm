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
            $fecha = $_POST['fecha'];
            $descripcion_1 = $_POST['descripcion_1'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            //$refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $ubicacion = $_POST['ubicacion'];
            if (registrar($refe_1,$codigo_1,$fecha,$descripcion_1,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$ubicacion,$conexion)){
                echo "0";
                historial($usuario,$refe_1,$codigo_1,$conexion);
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
        $refe_1 = $_POST['refe_1'];
        
            if (cancelar($refe_1,$conexion)){
                echo "0";
                cancfolio($refe_1,$conexion);

            }else{
                echo "1";
            }
    //Condición donde agrega un articulo individualmente
    }else if($opcion === 'updateartnew'){
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $tipo_ref = $_POST['tipo_ref'];
        $observa = $_POST['observa'];
        if (actualizarnew($id_kax,$codigo_1,$descripcion_1,$salida,$tipo_ref,$observa,$conexion)){
            echo "0";
            $realizo = 'EDITA EL ARTICULO AGREGADO';
            // $usuario='pruebas';
            histedith($usuario,$realizo,$id_kax,$conexion);
        }else{
            echo "1";
        }
    
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 AND tipo='MATERIAL_DEFECTUOSO'";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar un material defectuoso
function registrar ($refe_1,$codigo_1,$fecha,$descripcion_1,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','0','$fecha','$codigo_1','$descripcion_1','MATERIAL_DEFECTUOSO','ARTICULO','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','FINALIZADO','FINALIZADO','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//Agregar folio
function addfolio ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='MATERIAL_DEFECTUOSO' AND estado_f=0";
    $foliomatdef = mysqli_query($conexion,$folios);
    $folio = mysqli_fetch_row($foliomatdef);
    $query="INSERT INTO folios VALUES(0,'$folio[0]','$tipo',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//FUNCION PARA CANCELAR EL FOLIO
function cancelar ($refe_1,$conexion){
    $query="DELETE FROM kardex WHERE refe_1 = '$refe_1' AND tipo='MATERIAL_DEFECTUOSO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//CANCELA EL FOLIO
function cancfolio ($refe_1,$conexion){
    $query="DELETE FROM folios WHERE folio = '$refe_1' and tipo='MATERIAL_DEFECTUOSO'";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA MATERIAL DEFECTUOSO', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
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
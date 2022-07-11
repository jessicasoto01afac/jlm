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
    if($opcion === 'regisrepcl'){
        $folio_recl = $_POST['folio_recl'];
        $codigo_art = $_POST['codigo_art'];
        if (comprobacion ($folio_recl,$codigo_art,$conexion)){ //aquime quede 11072022
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
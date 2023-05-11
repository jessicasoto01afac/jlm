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
    if($opcion === 'insert'){
        $folio = $_POST['folio'];
        if (comprobacion ($folio,$conexion)){
            $date = $_POST['date'];
            $obserba= $_POST['obserba'];
            $uuid=$_POST['uuid'];
            if (registrar($folio,$date,$obserba,$uuid,$conexion)){
                echo "0";
                $realizo="PROGRAMA ENTREGA";
                historial1($usuario,$realizo,$folio,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'encamino'){
        $identregas = $_POST['identregas'];

        if (camino($identregas,$conexion)){
            echo "0";
            $realizo = 'EN CAMINO A ENTREGA DE PEDIDO';
           // $usuario='pruebas';
           historial($usuario,$realizo,$identregas,$conexion);
        }else{
            echo "1";
        }
    //Condición donde finaliza
    }else if($opcion === 'finalizado'){
        $identregas = $_POST['identregas'];

        if (finalizado($identregas,$conexion)){
            echo "0";
            $realizo = 'FINALIZA ENTREGA PEDIDO';
           // $usuario='pruebas';
           historial($usuario,$realizo,$identregas,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
    }

    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($folio,$conexion){
    $query="SELECT * FROM entregas WHERE pedido = '$folio' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el ARTICULO PARA TRASFORMACION EN LATA DE MEO 
function registrar ($folio,$date,$obserba,$uuid,$conexion){
    $query="INSERT INTO entregas VALUES(0,'$folio',(SELECT fecha FROM kardex WHERE refe_1='$folio' AND tipo='PEDIDO' GROUP BY refe_1),'$date',(SELECT proveedor_cliente FROM kardex WHERE refe_1='$folio' AND tipo='PEDIDO' GROUP BY refe_1),'$obserba','PENDIENTE','$uuid',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para guardar el ARTICULO PARA TRASFORMACION EN LATA DE MEO 
function camino ($identregas,$conexion){
    $query="UPDATE entregas SET estatus='ENVIANDO' WHERE id_entregas='$identregas'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para guardar el ARTICULO PARA TRASFORMACION EN LATA DE MEO 
function finalizado ($identregas,$conexion){
    $query="UPDATE entregas SET estatus='COMPLETADO' WHERE id_entregas='$identregas'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//--------------------FUNCIÓN DE HISTORIAL
function historial($usuario,$realizo,$identregas,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', CONCAT ('FOLIO:',(SELECT pedido FROM entregas WHERE id_entregas='$identregas')),'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function historial1($usuario,$realizo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo','FOLIO: ' '$folio','$fecha1')";
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
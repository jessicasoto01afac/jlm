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

    //Condición donde registra al transformación
    if($opcion === 'registrar'){
        //se pone los valores que se van a comparar
        $id_articulo_final = $_POST['id_articulo_final'];
        $id_extendido = $_POST['id_extendido'];
        $id_etiquetas = $_POST['id_etiquetas'];
        
        if (comprobacion ($id_articulo_final,$id_extendido,$id_etiquetas,$conexion)){
            $hojas = $_POST['hojas'];
            $divicion = $_POST['divicion'];
            if (registrar($id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion)){
                echo "0";
               // $usuario='pruebas';
                historial($usuario,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza usuario
    }else if($opcion === 'actualizara'){
        $id_transformacion = $_POST['id_transformacion'];
        $id_articulo_final = $_POST['id_articulo_final'];
        $id_extendido = $_POST['id_extendido'];        
        $id_etiquetas = $_POST['id_etiquetas'];
        $hojas = $_POST['hojas'];
        $divicion = $_POST['divicion'];
        if (actualizar($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion)){
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO DE TRASFORMACIÓN';
           // $usuario='pruebas';
            histedith($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
}else if($opcion === 'eliminar'){
    $id_transformacion = $_POST['id_transformacion'];
        if (eliminar($id_transformacion,$conexion)){
            echo "0";
            $realizo = 'ELIMINA A ARTICULO DE TRANSFORMACIÓN';
           // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_transformacion,$conexion);
        }else{
            echo "1";
        }
}

//FUNCIONES-----------------------------------------------------------------------------------

//funcion de comprobación para ver si la persona ya se encuentra con acceso
function comprobacion ($id_articulo_final,$id_extendido,$id_etiquetas,$conexion){
    $query="SELECT * FROM transforma WHERE id_articulo_final = '$id_articulo_final' AND id_extendido = '$id_extendido' AND id_etiquetas = '$id_etiquetas' AND estado = 0";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para guardar articulo
function registrar ($id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion){
    $query="INSERT INTO transforma VALUES(0,'$id_articulo_final','$id_extendido','$id_etiquetas','$hojas','$divicion', 0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function actualizar ($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion){
    $query="UPDATE transforma SET id_articulo_final='$id_articulo_final', id_extendido='$id_extendido', id_etiquetas='$id_etiquetas', hojas='$hojas', divicion='$divicion' WHERE id_trans = '$id_transformacion'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para eliminar el registro
function eliminar ($id_transformacion,$conexion){
    $query="UPDATE transforma SET estado='1' WHERE id_trans = '$id_transformacion'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para registra el agregar articulo de trasformación
function historial($usuario,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN NUEVO ARTICULO DE TRANSFORMACION',' ARTICULO FINAL: ' '$id_articulo_final ' 'ARTICULO EXTENDIDO: ' ' $id_extendido' ' ETIQUETAS:' ' $id_etiquetas' ' HOJAS:' '$hojas' ' DIVISION:' '$divicion' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$usuario,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_transformacion' 'ARTICULO FINAL: ' ' $id_articulo_final' ':'  ' EXTENDIDO' ' $id_extendido' ' ETQUETAS' ' $id_etiquetas' ' HOJAS:' ' $hojas' ' DIVISION','$divicion')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_transformacion,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_transformacion' ,'$fecha')";
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
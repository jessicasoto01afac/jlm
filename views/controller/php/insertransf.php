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
            $carton = $_POST['carton'];
            $id_carton = $_POST['id_carton'];
            $div_carton = $_POST['div_carton'];
            $multi_carton = $_POST['multi_carton'];
            $cartonsillo = $_POST['cartonsillo'];
            $id_cortonsillo = $_POST['id_cortonsillo'];
            $div_cartonsillo = $_POST['div_cartonsillo'];
            $multi_cartonsillo = $_POST['multi_cartonsillo'];
            $caple = $_POST['caple'];

            $id_caple = $_POST['id_caple'];
            $div_caple = $_POST['div_caple'];
            $multi_caple = $_POST['multi_caple'];
            $liston_cordon = $_POST['liston_cordon'];
            $id_cordliston = $_POST['id_cordliston'];
            $multi_liston = $_POST['multi_liston'];
            if (registrar($id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$carton,$id_carton,$div_carton,$multi_carton,$cartonsillo,$id_cortonsillo,$div_cartonsillo,$multi_cartonsillo,$caple,$id_caple,$div_caple,$multi_caple,$liston_cordon,$id_cordliston,$multi_liston,$conexion)){
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
        $carton = $_POST['carton'];
        $id_carton = $_POST['id_carton'];
        $div_carton = $_POST['div_carton'];
        $multi_carton = $_POST['multi_carton'];
        $cartonsillo = $_POST['cartonsillo'];
        $id_cortonsillo = $_POST['id_cortonsillo'];
        $div_cartonsillo = $_POST['div_cartonsillo'];
        $multi_cartonsillo = $_POST['multi_cartonsillo'];
        $caple = $_POST['caple'];
        $id_caple = $_POST['id_caple'];
        $div_caple = $_POST['div_caple'];
        $multi_caple = $_POST['multi_caple'];
        $liston_cordon = $_POST['liston_cordon'];
        $id_cordliston = $_POST['id_cordliston'];
        $multi_liston = $_POST['multi_liston'];

        if (actualizar($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$carton,$id_carton,$div_carton,$multi_carton,$cartonsillo,$id_cortonsillo,$div_cartonsillo,$multi_cartonsillo,$caple,$id_caple,$div_caple,$multi_caple,$liston_cordon,$id_cordliston,$multi_liston,$conexion)){
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
function registrar ($id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$carton,$id_carton,$div_carton,$multi_carton,$cartonsillo,$id_cortonsillo,$div_cartonsillo,$multi_cartonsillo,$caple,$id_caple,$div_caple,$multi_caple,$liston_cordon,$id_cordliston,$multi_liston,$conexion){
    $query="INSERT INTO transforma VALUES(0,'$id_articulo_final','$id_extendido','$id_etiquetas','$hojas','$divicion','$carton','$id_carton','$div_carton','$multi_carton','$cartonsillo','$id_cortonsillo','$div_cartonsillo','$multi_cartonsillo','$caple','$id_caple','$div_caple','$multi_caple','$liston_cordon','$id_cordliston','$multi_liston',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    $this->conexion->cerrar();
}
//funcion para actualizar el registro
function actualizar ($id_transformacion,$id_articulo_final,$id_extendido,$id_etiquetas,$hojas,$divicion,$carton,$id_carton,$div_carton,$multi_carton,$cartonsillo,$id_cortonsillo,$div_cartonsillo,$multi_cartonsillo,$caple,$id_caple,$div_caple,$multi_caple,$liston_cordon,$id_cordliston,$multi_liston,$conexion){
    $query="UPDATE transforma SET id_articulo_final='$id_articulo_final', id_extendido='$id_extendido', id_etiquetas='$id_etiquetas', hojas='$hojas', divicion='$divicion', carton='$carton', id_carton='$id_carton', div_carton='$div_carton', multi_carton='$multi_carton', cartonsillo='$cartonsillo', id_cortonsillo='$id_cortonsillo', div_cartonsillo='$div_cartonsillo', multi_cartonsillo='$multi_cartonsillo', caple='$caple', id_caple='$id_caple', div_caple='$div_caple', multi_caple='$multi_caple', liston_cordon='$liston_cordon', id_cordliston='$id_cordliston', multi_liston='$multi_liston' WHERE id_trans = '$id_transformacion'";
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
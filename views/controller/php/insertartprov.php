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

    //Condición donde registra al usuario
    if($opcion === 'registrar'){
        //se pone los valores que se van a comparar
        $id_articulo = $_POST['id_articulo'];
        $proveedor = $_POST['proveedor'];
        $codigo_proveedor = $_POST['codigo_proveedor'];
        
        if (comprobacion ($id_articulo,$proveedor,$codigo_proveedor,$conexion)){
            $descrip_proveedor = $_POST['descrip_proveedor'];
            $largo = $_POST['largo'];
            $ancho = $_POST['ancho'];
            $gramaje = $_POST['gramaje'];
            $peso_x_millar = $_POST['peso_x_millar'];
            $peso_x_hoja = $_POST['peso_x_hoja'];
            $presentacion = $_POST['presentacion'];
            $peso_paq_cerrado = $_POST['peso_paq_cerrado'];
            $unidad = $_POST['unidad'];
            $precio_anterior = $_POST['precio_anterior'];
            $precio_actual = $_POST['precio_actual'];
            $des1 = $_POST['des1'];
            $des2 = $_POST['des2'];
            $des3 = $_POST['des3'];
            $des4 = $_POST['des4'];
            $des5 = $_POST['des5'];
            $des6 = $_POST['des6'];
            $observ1 = $_POST['observ1'];
            $observ2 = $_POST['observ2'];

            if (registrar($id_articulo,$proveedor,$codigo_proveedor,$descrip_proveedor,$largo,$ancho,$gramaje,$peso_x_millar,$peso_x_hoja,$presentacion,$peso_paq_cerrado,$unidad,$precio_anterior,$precio_actual,$des1,$des2,$des3,$des4,$des5,$des6,$observ1,$observ2,$conexion)){
                echo "0";
               // $usuario='pruebas';
                historial($usuario,$id_articulo,$proveedor,$codigo_proveedor,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza usuario
    }if($opcion === 'actarprv'){
        $id_arprov = $_POST['id_arprov'];
        $id_articulo = $_POST['id_articulo'];
        $proveedor = $_POST['proveedor'];
        $codigo_proveedor = $_POST['codigo_proveedor'];
        $descrip_proveedor = $_POST['descrip_proveedor'];
        $largo = $_POST['largo'];
        $ancho = $_POST['ancho'];
        $gramaje = $_POST['gramaje'];
        $peso_x_millar = $_POST['peso_x_millar'];
        $peso_x_hoja = $_POST['peso_x_hoja'];
        $presentacion = $_POST['presentacion'];
        $peso_paq_cerrado = $_POST['peso_paq_cerrado'];
        $unidad = $_POST['unidad'];
        $precio_anterior = $_POST['precio_anterior'];
        $precio_actual = $_POST['precio_actual'];
        $des1 = $_POST['des1'];
        $des2 = $_POST['des2'];
        $des3 = $_POST['des3'];
        $des4 = $_POST['des4'];
        $des5 = $_POST['des5'];
        $des6 = $_POST['des6'];
        $observ1 = $_POST['observ1'];
        $observ2 = $_POST['observ2'];
        if (editar($id_arprov,$id_articulo,$proveedor,$codigo_proveedor,$descrip_proveedor,$largo,$ancho,$gramaje,$peso_x_millar,$peso_x_hoja,$presentacion,$peso_paq_cerrado,$unidad,$precio_anterior,$precio_actual,$des1,$des2,$des3,$des4,$des5,$des6,$observ1,$observ2,$conexion)){
            echo "0";
           // $usuario='pruebas';
           histedith($usuario,$id_arprov,$id_articulo,$proveedor,$codigo_proveedor,$conexion);
        }else{
            echo "1";
        }
        //id_arprov

    }if($opcion === 'eliminarartic'){
        $id_arprov = $_POST['id_arprov'];
        if (eliminar($id_arprov,$conexion)){
            echo "0";
           // $usuario='pruebas';
           histdelet($usuario,$id_arprov,$conexion);
        }else{
            echo "1";
        }
    }

//FUNCIONES-----------------------------------------------------------------------------------

//funcion de comprobación para ver si la persona ya se encuentra con acceso
function comprobacion ($id_articulo,$proveedor,$codigo_proveedor,$conexion){
    $query="SELECT * FROM artproveedor WHERE id_articulo = '$id_articulo' AND proveedor = '$proveedor' AND codigo_proveedor = '$codigo_proveedor' AND estado = 0";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar articulo
function registrar ($id_articulo,$proveedor,$codigo_proveedor,$descrip_proveedor,$largo,$ancho,$gramaje,$peso_x_millar,$peso_x_hoja,$presentacion,$peso_paq_cerrado,$unidad,$precio_anterior,$precio_actual,$des1,$des2,$des3,$des4,$des5,$des6,$observ1,$observ2,$conexion){
    $query="INSERT INTO artproveedor VALUES(0,'$id_articulo','$proveedor','$codigo_proveedor','$descrip_proveedor','$largo','$ancho','$gramaje','$peso_x_millar','$peso_x_hoja','$presentacion','$peso_paq_cerrado','$unidad','$precio_anterior','$precio_actual','$des1','$des2','$des3','$des4','$des5','$des6','$observ1','$observ2',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para editar articulo
function editar ($id_arprov,$id_articulo,$proveedor,$codigo_proveedor,$descrip_proveedor,$largo,$ancho,$gramaje,$peso_x_millar,$peso_x_hoja,$presentacion,$peso_paq_cerrado,$unidad,$precio_anterior,$precio_actual,$des1,$des2,$des3,$des4,$des5,$des6,$observ1,$observ2,$conexion){
    $query="UPDATE artproveedor SET id_articulo='$id_articulo',proveedor='$proveedor',codigo_proveedor='$codigo_proveedor',descrip_proveedor='$descrip_proveedor',largo='$largo',ancho='$ancho',gramaje='$gramaje',peso_x_millar='$peso_x_millar',peso_x_hoja='$peso_x_hoja',presentacion='$presentacion',peso_paq_cerrado='$peso_paq_cerrado',unidad='$unidad',precio_anterior='$precio_anterior',precio_actual='$precio_actual',des1='$des1',des2='$des2',des3='$des3',des4='$des4',des5='$des5',des6='$des6',observ1='$observ1',observ2='$observ2' WHERE id_arprov='$id_arprov'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para editar articulo
function eliminar ($id_arprov,$conexion){
    $query="UPDATE artproveedor SET estado='1' WHERE id_arprov='$id_arprov'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}


//funcion para registra cambios
function historial($usuario,$id_articulo,$proveedor,$codigo_proveedor,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN NUEVO ARTICULO DE PROVEEDOR','ARTICULO: ' '$id_articulo ' ' CODIGO PROVEEDOR::' ' $codigo_proveedor' ' PROVEEDOR:' '$proveedor' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico
function histedith($usuario,$id_arprov,$id_articulo,$proveedor,$codigo_proveedor,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ACTUALIZA ARTICULO DE PROVEEDOR', ' ID:' '$id_arprov' ' PROVEEDOR: ' ' $proveedor' ' ARTICULO: ' '$id_articulo' ' CODIGO_PROVEEDOR:' '$codigo_proveedor','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico
function histdelet($usuario,$id_arprov,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ELIMINA ARTICULO DE PROVEEDOR', ' ID:' '$id_arprov','$fecha')";
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
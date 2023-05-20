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
        $artcodigo = $_POST['artcodigo'];
        $artdescrip = $_POST['artdescrip'];
        $stockinici = $_POST['stockinici'];
        
        
        if (comprobacion ($artcodigo,$artdescrip,$conexion)){
            $artubicac = $_POST['artubicac'];
            $artunidad = $_POST['artunidad'];
            $artgrupo = $_POST['artgrupo'];
            if (registrar($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$conexion)){

                inventario($artcodigo,$stockinici,$artubicac,$artunidad,$artgrupo,$conexion);
                echo "0";
               // $usuario='pruebas';
                historial($usuario,$artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza usuario
    }else if($opcion === 'actualizara'){
        $artcodigo = $_POST['artcodigo'];
        $artdescrip = $_POST['artdescrip'];
        $artubicac = $_POST['artubicac'];        
        $artunidad = $_POST['artunidad'];
        $artgrupo = $_POST['artgrupo'];
        $id_art = $_POST['id_art'];
        $edistockini = $_POST['edistockini'];
        if (actualizar($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$id_art,$conexion)){
            actinvent($artcodigo,$edistockini,$conexion);
            echo "0";
            $realizo = 'ACTUALIZO INFORMACION DEL ARTICULO';
           // $usuario='pruebas';
            histedith($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$id_art,$usuario,$realizo,$conexion);
        }else{
            echo "1";
        }
    //Condición donde elimina usuario
}else if($opcion === 'eliminar'){
    $id_art = $_POST['id_art'];
        if (eliminar($id_art,$conexion)){
            eliminarinv ($id_art,$conexion);
            echo "0";
            $realizo = 'ELIMINA A ARTICULO';
           // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_art,$conexion);
        }else{
            echo "1";
        }
}

//FUNCIONES-----------------------------------------------------------------------------------

//funcion de comprobación para ver si la persona ya se encuentra con acceso
function comprobacion ($artcodigo,$artdescrip,$conexion){
    $query="SELECT * FROM articulos WHERE artcodigo = '$artcodigo' AND estado = 0 OR artdescrip = '$artdescrip' AND estado = 0";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar articulo
function registrar ($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$conexion){
    $query="INSERT INTO articulos VALUES(0,'$artcodigo','$artdescrip','$artubicac','$artunidad','$artgrupo', 0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar articulo inventario
function inventario ($artcodigo,$stockinici,$artubicac,$artunidad,$artgrupo,$conexion){
    $query="INSERT INTO inventario VALUES(0,'$artcodigo','$stockinici',0,0,0,0,0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function actualizar ($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$id_art,$conexion){
    $query="UPDATE articulos SET artcodigo='$artcodigo', artdescrip='$artdescrip', artubicac='$artubicac', artunidad='$artunidad', artgrupo='$artgrupo' WHERE id_art = '$id_art'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function actinvent($artcodigo,$edistockini,$conexion){
    $query="UPDATE inventario SET stock_inicial='$edistockini' WHERE id_articulos = '$artcodigo' and estado=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function eliminar ($id_art,$conexion){
    $query="UPDATE articulos SET estado='1' WHERE id_art = '$id_art'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function eliminarinv ($id_art,$conexion){
    $query="UPDATE inventario SET estado='1' WHERE id_articulos = '$id_art'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para registra cambios
function historial($usuario,$artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN NUEVO ARTICULO','$artcodigo ' ' $artdescrip' ' UBICACIÓN:' ' $artubicac' ' UNIDAD:' '$artunidad' ' GRUPO:' '$artgrupo' ,'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico
function histedith($artcodigo,$artdescrip,$artubicac,$artunidad,$artgrupo,$id_art,$usuario,$realizo,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_art' ' $artcodigo' ':'  ' $artdescrip' ' UBICACION:' ' $artubicac' ' UNIDAD:' '$artunidad' ' GRUPO:' '$artgrupo','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_art,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', ' ID:' '$id_art' ,'$fecha')";
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
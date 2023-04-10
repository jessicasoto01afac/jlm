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
        $entrada = $_POST['entrada'];
        $observa = $_POST['observa'];
        if (actualizarnew($id_kax,$codigo_1,$descripcion_1,$salida,$entrada,$observa,$conexion)){
            echo "0";
            if ($entrada>0){
                $realizo = 'EDITA EL ARTICULO AGREGADO DEVOLUCIÓN';
            }else{
                $realizo = 'EDITA EL ARTICULO AGREGADO MATERIAL DEFECTUOSO';
            }
            // $usuario='pruebas';
            histedith($usuario,$realizo,$id_kax,$conexion);
        }else{
            echo "1";
        }
    
    }else if($opcion === 'deleartnew'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DEL MATERIAL DEFCTUOSO';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'revisionac'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //guarda edicion de entrada
    }else if($opcion === 'cambiocab'){
        $fecha = $_POST['fecha'];
        $descripcion_1  = $_POST['descripcion_1'];
        $ubicacion = $_POST['ubicacion'];
        $refe_2 = $_POST['refe_2'];
        $refe_1 = $_POST['refe_1'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
            if (cambio($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                $realizo = 'EDITA INFORMACIÓN DE LA CABECERA DE MATERIAL DEFECTUSO';
                histedith2($usuario,$fecha,$realizo,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'gefoliodv'){
        $tipo = $_POST['tipo'];
            if (addfoliodv ($tipo,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    //CANCELAR
    }else if($opcion === 'registrardv'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        if (comprobaciondv ($refe_1,$codigo_1,$conexion)){
            $fecha = $_POST['fecha'];
            $descripcion_1 = $_POST['descripcion_1'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            //$refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $ubicacion = $_POST['ubicacion'];
            if (registrardv($refe_1,$codigo_1,$fecha,$descripcion_1,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$ubicacion,$conexion)){
                echo "0";
                historialdv($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'cambiocabdv'){
        $fecha = $_POST['fecha'];
        $descripcion_1  = $_POST['descripcion_1'];
        $ubicacion = $_POST['ubicacion'];
        $refe_2 = $_POST['refe_2'];
        $refe_1 = $_POST['refe_1'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
            if (cambiodv($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                $realizo = 'EDITA INFORMACIÓN DE LA CABECERA DE DEVOLUCIÓN';
                histedith2($usuario,$fecha,$realizo,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'deleartnewdv'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DE DEVOLUCIÓN';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'revisionac2'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion2 ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //guarda edicion de entrada
    }else if($opcion === 'deletedefc'){
        $folio = $_POST['folio'];
        $tipo = $_POST['tipo'];
        if (deletedefc($folio,$tipo,$conexion)){
            echo "0";
            $realizo = 'ELIMINA REPORTE DE '.$tipo;
            // $usuario='pruebas';
            hisdetedefc($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        } 
    //EDICION DE CABECERA
    }else if($opcion === 'gefolioflt'){
        $tipo = $_POST['tipo'];
            if (addfolioflt ($tipo,$conexion)){
                echo "0";
            }else{
                echo "1";
            }
    }if($opcion === 'registrarflt'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        if (comprobacionftl ($refe_1,$codigo_1,$conexion)){
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $refe_2 = $_POST['refe_2'];
            if (registrarftl($refe_1,$codigo_1,$fecha,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$conexion)){
                echo "0";
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{
    
            echo "2";
        }
    //Condición donde cancela el vale de producción 
    }else if($opcion === 'deleartnewftt'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO MATERIAL FALTANTE';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'revisionac3'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion3 ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //guarda edicion de entrada 
    }else if($opcion === 'cambiocabfalt'){
        $fecha = $_POST['fecha'];
        $descripcion_1  = $_POST['descripcion_1'];
        $ubicacion = $_POST['ubicacion'];
        $refe_2 = $_POST['refe_2'];
        $refe_1 = $_POST['refe_1'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
            if (cambioflt($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                $realizo = 'EDITA INFORMACIÓN DE LA CABECERA DE MATERIAL FALTANTE';
                histedith2($usuario,$fecha,$realizo,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
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
    cerrar($conexion);
}
//funcion para guardar un material defectuoso
function registrar ($refe_1,$codigo_1,$fecha,$descripcion_1,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','0','$fecha','$codigo_1','$descripcion_1','MATERIAL_DEFECTUOSO','ARTICULO','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','FINALIZADO','FINALIZADO','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
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
    cerrar($conexion);
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

//funcion para actualizar el registro
function actualizarnew ($id_kax,$codigo_1,$descripcion_1,$salida,$entrada,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', cantidad_real=$salida,entrada=$entrada,salida=$salida,observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function eliminar ($id_kardex,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE id_kax= '$id_kardex'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1' and tipo='MATERIAL_DEFECTUOSO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion2 ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1' and tipo='DEVOLUCIÓN'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion3 ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1' and tipo='MATERIAL_FALTANTE'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera desde la vista DE MATERIAL DEFECTUOSO
function cambio ($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', descripcion_1='$descripcion_1', ubicacion='$ubicacion',refe_2='$refe_2',proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1' AND tipo='MATERIAL_DEFECTUOSO'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//Agregar folio DEVOLCIÓN
function addfoliodv ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='DEVOLUCIÓN' AND estado_f=0";
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
function comprobaciondv ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 AND tipo='DEVOLUCIÓN'";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar un material defectuoso
function registrardv ($refe_1,$codigo_1,$fecha,$descripcion_1,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','0','$fecha','$codigo_1','$descripcion_1','DEVOLUCIÓN','ARTICULO','$proveedor_cliente','$ubicacion','$cantidad_real','$salida','0',0,0,0,'$observa','NA','FINALIZADO','FINALIZADO','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera desde la vista DE MATERIAL DEFECTUOSO
function cambiodv ($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', descripcion_1='$descripcion_1', ubicacion='$ubicacion',refe_2='$refe_2',proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1' AND tipo='DEVOLUCIÓN'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar la cabecera desde la vista DE MATERIAL DEFECTUOSO
function cambioflt ($fecha,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', descripcion_1='$descripcion_1', ubicacion='$ubicacion',refe_2='$refe_2',proveedor_cliente='$proveedor_cliente' WHERE refe_1 = '$refe_1' AND tipo='MATERIAL_FALTANTE'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function deletedefc ($folio,$tipo,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE refe_1= '$folio' AND tipo='$tipo'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//Agregar folio DEVOLCIÓN
function addfolioflt ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='$tipo' AND estado_f=0";
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
function comprobacionftl ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 AND tipo='MATERIAL_FALTANTE'";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar un material defectuoso
function registrarftl ($refe_1,$codigo_1,$fecha,$proveedor_cliente,$cantidad_real,$salida,$observa,$refe_2,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','0','$fecha','$codigo_1','0','MATERIAL_FALTANTE','ARTICULO','$proveedor_cliente','0','$cantidad_real',0,'$salida',0,0,0,'$observa','NA','FINALIZADO','FINALIZADO','NO','NO',0)";
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
//funciones para guardar el historico 
function histedith($usuario,$realizo,$id_kax,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', concat('FOLIO:',(select refe_1 from kardex where id_kax  = '$id_kax')),'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', concat('FOLIO:',(select refe_1 from kardex where id_kax= '$id_kardex'), ' CODIGO: ' '$codigo_1'),'$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico de la edicion de cabecra de matyerial defectuoso
function histedith2($usuario,$fecha,$realizo,$descripcion_1,$ubicacion,$refe_2,$refe_1,$proveedor_cliente,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$refe_1' ' FECHA:' '$fecha'  ' MOTIVO: '  ' $descripcion_1' ' DEPARTAMENTO:' ' $refe_2' ' PEDIDOS:' ' $ubicacion' ,'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialdv($usuario,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA DEVOLUCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function hisdetedefc($usuario,$realizo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$folio','$fecha')";
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
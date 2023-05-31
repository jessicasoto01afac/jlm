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
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $caracter = $_POST['caracter'];
            
            if (registrar($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion)){
                echo "0";
                extendido($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                etiqueta($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                //poductividad($refe_1,$caracter,$conexion);
                //minagriss1($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                historial($usuario,$refe_1,$codigo_1,$conexion);
                registrarcolors ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde cancela el vale de producción
    }else if($opcion === 'registrarp'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $caracter = $_POST['caracter'];
            
            if (registrar($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion)){
                echo "0";
                registrarnew ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                registrarnewetiq ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion); 
                //el bueno actualiza minagris
                registrarminagris ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion);
                //si el minagris es 0 se actualiza a 1
                //actualizarmina($refe_1,$refe_2,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde agrega un articulo individualmente
    }else if($opcion === 'cancelar'){
        $refe_1 = $_POST['refe_1'];
        
            if (cancelar($refe_1,$conexion)){
                echo "0";
                cancfolio($refe_1,$conexion);

            }else{
                echo "1";
            }
    //Condición donde agrega un articulo individualmente
    }else if($opcion === 'registrarind'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (registrarind($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialinv($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica 
    }else if($opcion === 'regcarton'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocart = $_POST['codigocart'];
    
        if (comprobacion2 ($refe_1,$codigocart,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (carton($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocart,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcar($usuario,$refe_1,$codigocart,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el cartonsillo si aplica 
    }else if($opcion === 'regcartonsillo'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocartons = $_POST['codigocartons'];
    
        if (comprobacion3 ($refe_1,$codigocartons,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (cartonsillo($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocartons,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcarsll($usuario,$refe_1,$codigocartons,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica 
    }else if($opcion === 'regcaple'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigocaple = $_POST['codigocaple'];
    
        if (comprobacion4 ($refe_1,$codigocaple,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (caple($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocaple,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialcaple($usuario,$refe_1,$codigocaple,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica regcaple
    }else if($opcion === 'regliston'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $codigolist = $_POST['codigolist'];
    
        if (comprobacion5 ($refe_1,$codigolist,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (liston($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigolist,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialist($usuario,$refe_1,$codigolist,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
        //Condición donde se agrega el carton si aplica regcaple
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
    
    }else if($opcion === 'updateexten'){
        $id_kax = $_POST['id_kax'];
        $codigo_1 = $_POST['codigo_1'];
        $descripcion_1 = $_POST['descripcion_1'];
        $salida = $_POST['salida'];
        $tipo_ref = $_POST['tipo_ref'];
        $observa = $_POST['observa'];
        if (actualizarnewext($id_kax,$codigo_1,$descripcion_1,$salida,$tipo_ref,$observa,$conexion)){
            echo "0";
            $realizo = 'EDITA EL ARTICULO AGREGADO DEL VALE DE PRODUCCIÓN';
            // $usuario='pruebas';
            histedith($usuario,$realizo,$id_kax,$conexion);
        }else{
            echo "1";
        }
        //updateexten
    }else if($opcion === 'deleartnew'){
        $id_kardex = $_POST['id_kardex'];
        $codigo_1 = $_POST['codigo_1'];
        if (eliminar($id_kardex,$conexion)){
            echo "0";
            $realizo = 'ELIMINA ARTICULO DEL VALE DE PRODUCCIÓN';
            // $usuario='pruebas';
            histdelete($usuario,$realizo,$id_kardex,$codigo_1,$conexion);
        }else{
            echo "1";
        }
    //elimina vales de producción 
    }else if($opcion === 'deletevale'){
        $folio = $_POST['folio'];
        if (deletevp($folio,$conexion)){
            echo "0";
            $realizo = 'ELIMINA VALE DE PRODUCCIÓN';
            // $usuario='pruebas';
            histelimi($usuario,$realizo,$folio,$conexion);
        }else{
            echo "1";
        } 
    //EDICION DE CABECERA
    }else if($opcion === 'cambio'){
        $refe_1 = $_POST['refe_1'];
        $fecha = $_POST['fecha'];
        $refe_3 = $_POST['refe_3'];
        $refe_2 = $_POST['refe_2'];
        $proveedor_cliente = $_POST['proveedor_cliente'];
        $caracter_vale = $_POST['caracter_vale'];
        $ubicacion = $_POST['ubicacion'];
        $id_person_creacion = $_POST['id_person_creacion'];
        $id_person_autor = $_POST['id_person_autor'];
        $id_person_surtio = $_POST['id_person_surtio'];
        $fecha_surtido = $_POST['fecha_surtido'];
        $id_person_final = $_POST['id_person_final'];
        $fecha_finalizacion = $_POST['fecha_finalizacion'];
        $estado = $_POST['estado'];
        if (actualizacabe($refe_1,$fecha,$refe_3,$refe_2,$proveedor_cliente,$ubicacion,$estado,$conexion)){
            echo "0";
            actucabez2($refe_1,$caracter_vale,$id_person_creacion,$id_person_autor,$id_person_surtio,$fecha_surtido,$id_person_final,$fecha_finalizacion,$conexion);
            $realizo = 'EDITA LA CABECERA DEL VALE DE PRODUCIÓN';
            histecabe($usuario,$realizo,$refe_1,$conexion);
        }else{
            echo "1";
        }
    }else if($opcion === 'regisinind'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
    
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            
            if (registrarind($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historial($usuario,$refe_1,$codigo_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega el carton si aplica  
    }else if($opcion === 'regiarindfinal'){
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        if (comprobacion ($refe_1,$codigo_1,$conexion)){
            $refe_3 = $_POST['refe_3'];
            $refe_2 = $_POST['refe_2'];
            $fecha = $_POST['fecha'];
            $proveedor_cliente = $_POST['proveedor_cliente'];
            $descripcion_1 = $_POST['descripcion_1'];
            $cantidad_real = $_POST['cantidad_real'];
            $salida = $_POST['salida'];
            $observa = $_POST['observa'];
            $ubicacion = $_POST['ubicacion'];
            $tipo_ref = $_POST['tipo_ref'];
            if (regstindpf($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion)){
                echo "0";
                historialinvfin($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion);
            }else{
                echo "1";
            }
        }else{
            echo "2";
        }
    //Condición donde se autoriza el vale
    }else if($opcion === 'autorizarvp'){
        $folio = $_POST['folio'];
            if (autorizar1($folio,$conexion)){
                echo "0";
                autorizar2($usuario,$folio,$conexion);
                histautoriza($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
     //Condición donde libera el vale de produccción 
    }else if($opcion === 'liberarvp'){
        $foliovp = $_POST['foliovp'];
            if (liberarvpro ($foliovp,$conexion)){
                echo "0";
                //$usuario='PRUEBAS';
                hisliber($usuario,$foliovp,$conexion); 
            }else{
                echo "1";
            }
    }else if($opcion === 'surtir'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $observa_dep = $_POST['observa_dep'];
        if (surtirart ($id_kax,$refe_1,$codigo_1,$cantidad,$descripcion,$observa_dep,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisurtir2($usuario,$refe_1,$codigo_1,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //editar surtir 
    }else if($opcion === 'edthsurtir'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];
        
        if (surtirartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    }else if($opcion === 'surtirfin'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $cantidad = $_POST['cantidad'];
        $descripcion = $_POST['descripcion'];
        $observa_dep = $_POST['observa_dep'];
        if (surtirartfn ($id_kax,$refe_1,$codigo_1,$cantidad,$descripcion,$observa_dep,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisurtir2($usuario,$refe_1,$codigo_1,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //editar surtir producto fin
    }else if($opcion === 'edthsurtirfin'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];

        if (surtirartupdafin ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    }else if($opcion === 'surtirvp'){
        $folio = $_POST['folio'];
            if (surtir1($folio,$conexion)){
                echo "0";
                surtir2($usuario,$folio,$conexion);
                histsurt($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    }else if($opcion === 'sinexistencia'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $codigo_1 = $_POST['codigo_1'];
        $observa_dep = $_POST['observa_dep'];
        if (sinexiste ($id_kax,$refe_1,$codigo_1,$observa_dep,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            histnoexist($usuario,$refe_1,$codigo_1,$conexion); 
        }else{
            echo "1";
        }
        //finalizar1
    }else if($opcion === 'finalvp'){
        $folio = $_POST['folio'];
            if (finalizar1($folio,$conexion)){
                echo "0";
                finalizar2($usuario,$folio,$conexion);
                histfinal($usuario,$folio,$conexion);
            }else{
                echo "1";
            }
    //Actualiza la informacion de no surtir extendido y etiqueta
    }else if($opcion === 'edthsinexis'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];
        
        if (sinexistartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //Actualiza la informacion de no surtir producto final
    }else if($opcion === 'edthsinexisfin'){
        $id_kax = $_POST['id_kax'];
        $refe_1 = $_POST['refe_1'];
        $cantidad = $_POST['cantidad'];
        $observa_dep = $_POST['observa_dep'];
        $descrip = $_POST['descrip'];
        $status2 = $_POST['status2'];
        
        if (snextartupdafn ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion)){
            echo "0";
            //$usuario='PRUEBAS';
            hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion); 
        }else{
            echo "1";
        }
    //Actualiza la relacion de sistema JML
    }else if($opcion === 'revisionac'){
        $revision = $_POST['revision'];
        $refe_1 = $_POST['refe_1'];
        if (jlmrelacion ($revision,$refe_1,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //edthsinexisfin
    }else if($opcion === 'gefolio'){
        $tipo = $_POST['tipo'];
        if (addfolio ($tipo,$conexion)){
            echo "0";
        }else{
            echo "1";
        }
        //edthsinexisfin
    }if($opcion === 'registrarfin'){
        $refe_1 = $_POST['refe_1'];
        if (comprobacionfin ($refe_1,$usuario,$conexion)){
            $caracter = $_POST['caracter'];
            
            if (poductividad($refe_1,$caracter,$usuario,$conexion)){
                echo "0";
                //finaliadd ($refe_1,$conexion);
                historialadd($usuario,$refe_1,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde se agrega mas de un calor
    }
    
//FUNCIONES  -----------------------------------------------------------------------------------------------------------------------------------------

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion ($refe_1,$codigo_1,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigo_1' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//Agregar folio
function addfolio ($tipo,$conexion){
    $folios="SELECT MAX(folio) + 1 AS id_foliovp FROM folios where tipo ='VALE_PRODUCCION' AND estado_f=0";
    $foliovale_p = mysqli_query($conexion,$folios);
    $folio = mysqli_fetch_row($foliovale_p);
    $query="INSERT INTO folios VALUES(0,'$folio[0]','$tipo',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacionfin ($refe_1,$usuario,$conexion){
    $query="SELECT * FROM productividad WHERE referencia_1 = '$refe_1' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion2 ($refe_1,$codigocart,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocart' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion3 ($refe_1,$codigocartons,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocartons' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function finaliadd ($refe_1,$conexion){
    $query="UPDATE kardex SET estado=0 WHERE refe_1= '$refe_1' AND estado=0 ";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion4 ($refe_1,$codigocaple,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigocaple' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion de comprobación para ver si el vale ya se encuentra en la base
function comprobacion5 ($refe_1,$codigolist,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1 = '$refe_1' AND  codigo_1='$codigolist' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el articulo de producción
function registrar ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_PRODUCCION','PRODUCTO_TERMINADO','$proveedor_cliente','$ubicacion','$cantidad_real',$salida,0,'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//comprobación de colores
function compracolors ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="SELECT * FROM transforma WHERE id_articulo_final = '$codigo_1' AND  id_etiquetas='GRUPO_TRANSF' AND estado = 0 ";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        return false;
    }else{
        $query2="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_extendido,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),('$cantidad_real'),(hojas*$salida/divicion),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
        FROM
            transforma 
        WHERE
            id_articulo_final = '$codigo_1' and id_etiquetas='GRUPO_TRANSF'";
    }
    cerrar($conexion);
}
//funcion para guardar los colores del articulo
function registrarcolors ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_extendido,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),('$cantidad_real'),(hojas*$salida/divicion),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
    FROM
        transforma 
    WHERE
        id_articulo_final = '$codigo_1' and id_etiquetas='GRUPO_TRANSF'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar los colores del articulo
function registrarnew ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),(hojas*$salida/division),(hojas*$salida/division),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
    FROM
    transformation 
    WHERE
    id_articfial = '$codigo_1' AND type_art='EXTENDIDO' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CARTONSILLO' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CARTON' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CAPLE' AND estado=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function minagris ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),(hojas*$salida/division),(hojas*$salida/division),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
    FROM
    transformation 
    WHERE
    id_articfial = '$codigo_1' AND type_art='EXTENDIDO' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CARTONSILLO' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CARTON' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='CAPLE' AND estado=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para guardar minagris
function registrarminagris ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="SELECT * FROM kardex WHERE refe_1='$refe_1' AND tipo='VALE_PRODUCCIÓN' AND tipo_ref='EXTENDIDO' AND codigo_1='2000' OR refe_1='$refe_1' AND tipo='VALE_PRODUCCIÓN' AND tipo_ref='EXTENDIDO' AND codigo_1='2005'";
    $resultado= mysqli_query($conexion,$query);
    if($resultado->num_rows==0){
        //INSERTER SI NO HAY ARTICULO
        $busc="select (hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division) as resultt FROM transformation WHERE id_articfial = '$codigo_1' AND type_art='MINAGRIS' AND estado=0";
        $resul = mysqli_query($conexion, $busc);
        if(!$resul){
            die("error");
        }else{
            while($data = mysqli_fetch_assoc($resul)){
                if ($data["resultt"] < 0) {
                    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),('1'),('1'),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
                    FROM
                    transformation 
                    WHERE
                    id_articfial = '$codigo_1' AND type_art='MINAGRIS' AND estado=0";
                    if(mysqli_query($conexion,$query)){
                        return true;
                    }else{
                        return false;
                    }
                    cerrar($conexion);
                }else{
                    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),(hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division),(hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
                    FROM
                    transformation 
                    WHERE
                    id_articfial = '$codigo_1' AND type_art='MINAGRIS' AND estado=0";
                    if(mysqli_query($conexion,$query)){
                        return true;
                    }else{
                        return false;
                    }
                    cerrar($conexion);
                }

            }
        }
       
    }else{
        $query2="UPDATE kardex SET salida = salida+(select hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division FROM transformation WHERE id_articfial = '$codigo_1' AND type_art='MINAGRIS' AND estado=0)";
        if(mysqli_query($conexion,$query2)){
            return true;
        }else{
            return false;
        }
        cerrar($conexion);
    }
    cerrar($conexion);
}

function registrarnewetiq ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'ETIQUETAS' ),('$proveedor_cliente'),('0'),('$cantidad_real'),(hojas*$salida/division),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
    FROM
    transformation 
    WHERE
    id_articfial = '$codigo_1' AND type_art='ETIQUETAS' AND estado=0 OR id_articfial = '$codigo_1' AND type_art='LISTON_CORDÓN' AND estado=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para registrar la productividad
function poductividad ($refe_1,$caracter,$usuario,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="INSERT INTO productividad VALUES(0,'$refe_1','$usuario','$fecha','PENDIENTE','','PENDIENTE','','PENDIENTE','','$caracter',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el vale de produccion individualmente
function registrarind ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_PRODUCCION','$tipo_ref','$proveedor_cliente','$ubicacion',$cantidad_real,0,$salida,0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//add producto final iformacion del vale de produccion
function regstindpf ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex VALUES(0,'$refe_1','$refe_2','$refe_3','$fecha','$codigo_1','$descripcion_1','VALE_PRODUCCION','$tipo_ref','$proveedor_cliente','$ubicacion',$cantidad_real,$salida,0,0,0,0,'$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0)";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el exendido de articulo de trasformación
function extendido ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha',concat((select id_extendido from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),concat((select artdescrip from articulos where artcodigo = (select id_extendido from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' ))),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente','$ubicacion',concat((select $cantidad_real * hojas / divicion from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF')),0,concat((select $cantidad_real * hojas / divicion from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF')),'0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//minagirssss 
function actualizarmina($refe_1,$refe_2,$conexion){
    $query="UPDATE kardex SET salida='1' where refe_1='$refe_1' and codigo_1 in ('2000','2005') AND salida=0 AND tipo='VALE_PRODUCCIÓN' AND tipo_ref='EXTENDIDO' AND estatus=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);

}

//funcion para guardar el minagriss de articulo de trasformación
function minagriss1 ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex (refe_1,refe_2,refe_3,fecha, codigo_1, tipo, tipo_ref,proveedor_cliente,ubicacion,cantidad_real,salida,costo,descuento,total,observa,observa_dep,status,status_2,entrega,revision, estado ) SELECT ('$refe_1'),('$refe_2'),('$refe_3'),('$fecha'), id_articulo,( 'VALE_PRODUCCIÓN' ),( 'EXTENDIDO' ),('$proveedor_cliente'),('0'),(hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division),(hojas*(SELECT (t.hojas*$salida/t.division) from transformation t where t.id_articfial = '$codigo_1' AND t.type_art='EXTENDIDO' AND t.estado=0)/division),('0'),('0'),('0'),('$observa'), ('NA'),('PENDIENTE'),('PENDIENTE'),('NO'),('NO'),('0')
    FROM
    transformation 
    WHERE
    id_articfial = '$codigo_1' AND type_art='MINAGRIS' AND estado=0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}


//funcion para guardar la etiqueta de articulo de trasformación
function etiqueta ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha',concat((select id_etiquetas from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),concat((select artdescrip from articulos where artcodigo = (select id_etiquetas from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF'))),'VALE_PRODUCCION','ETIQUETAS','$proveedor_cliente','$ubicacion','$cantidad_real',0,'$salida','0',0,'0','','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para guardar el carton de articulo de trasformación
function carton ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocart,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocart',concat((select artdescrip from articulos where artcodigo = '$codigocart')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocart')),concat((select $cantidad_real * multi_carton / div_carton from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),0,concat((select $cantidad_real * multi_carton / div_carton from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el cartonsillo de articulo de trasformación
function cartonsillo ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocartons,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocartons',concat((select artdescrip from articulos where artcodigo = '$codigocartons')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocartons')),concat((select $cantidad_real * multi_cartonsillo / div_cartonsillo from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF')),0,concat((select $cantidad_real * multi_cartonsillo / div_cartonsillo from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el caple de articulo de trasformación
function caple ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigocaple,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigocaple',concat((select artdescrip from articulos where artcodigo = '$codigocaple')),'VALE_PRODUCCION','EXTENDIDO','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigocaple')),concat((select $cantidad_real * multi_caple / div_caple from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),0,concat((select $cantidad_real * multi_caple / div_caple from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para guardar el liston de articulo de trasformación
function liston ($refe_1,$refe_2,$refe_3,$fecha,$proveedor_cliente,$codigo_1,$codigolist,$descripcion_1,$cantidad_real,$salida,$observa,$ubicacion,$tipo_ref,$conexion){
    $query="INSERT INTO kardex SELECT 0,'$refe_1','$refe_2','$refe_3','$fecha','$codigolist',concat((select artdescrip from articulos where artcodigo = '$codigolist')),'VALE_PRODUCCION','ETIQUETAS','$proveedor_cliente',concat((select artubicac from articulos where artcodigo = '$codigolist')),concat((select $cantidad_real * multi_liston from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),0,concat((select $cantidad_real * multi_liston from transforma where id_articulo_final = '$codigo_1' and id_etiquetas != 'GRUPO_TRANSF' )),'0',0,'0','$observa','NA','PENDIENTE','PENDIENTE','NO','NO',0";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para cancelar el vale de producción SE COMENTA 
/*function cancelar ($refe_1,$conexion){
    $query="UPDATE kardex SET estado=2, status='CANCELADO', status_2='CANCELADO' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}*/
//funcion para cancelar el vale de producción
function cancelar ($refe_1,$conexion){
    $query="DELETE FROM kardex WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
/*function cancfolio ($refe_1,$conexion){
    $query="UPDATE folios SET estado_f=1 WHERE folio = '$refe_1' and tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}*/
function cancfolio ($refe_1,$conexion){
    $query="DELETE FROM folios WHERE folio = '$refe_1' and tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar JLM relacion
function jlmrelacion ($revision,$refe_1,$conexion){
    $query="UPDATE kardex SET revision='$revision' WHERE refe_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar el registro
function actualizarnew ($id_kax,$codigo_1,$descripcion_1,$salida,$tipo_ref,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', cantidad_real=$salida,entrada=0,salida=$salida,tipo_ref='$tipo_ref' ,observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar cabecera----------------------------------
function actualizacabe($refe_1,$fecha,$refe_3,$refe_2,$proveedor_cliente,$ubicacion,$estado,$conexion){
    $query="UPDATE kardex SET fecha='$fecha', refe_3='$refe_3',refe_2='$refe_2',proveedor_cliente='$proveedor_cliente',ubicacion='$ubicacion',estado='$estado' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function actucabez2($refe_1,$caracter_vale,$id_person_creacion,$id_person_autor,$id_person_surtio,$fecha_surtido,$id_person_final,$fecha_finalizacion,$conexion){
    $query="UPDATE productividad SET  id_person_creacion='$id_person_creacion',id_person_autor='$id_person_autor',id_person_surtio='$id_person_surtio',fecha_surtido='$fecha_surtido',id_person_final='$id_person_final',fecha_finalizacion='$fecha_finalizacion',caracter_vale='$caracter_vale' WHERE referencia_1 = '$refe_1'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//FIN DE CABECERA-------------------------------------------------------------------------------

//funcion para actualizar el registro desde nuevo  vale de producción
function actualizarnewext ($id_kax,$codigo_1,$descripcion_1,$salida,$tipo_ref,$observa,$conexion){
    $query="UPDATE kardex SET codigo_1='$codigo_1', descripcion_1='$descripcion_1', cantidad_real=$salida ,entrada=$salida, salida='0',tipo_ref='$tipo_ref' ,observa='$observa' WHERE id_kax = '$id_kax'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para actualizar el registro (DESCOMNETAR EN CASO DE USAR SE COMENTA POR QUE SE ELIMINA) 25092022
function eliminar ($id_kardex,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE id_kax= '$id_kardex'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
/*function eliminar ($id_kardex,$conexion){
    $query="DELETE FROM kardex WHERE id_kax= '$id_kardex'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}*/

//funcion para actualizar el registro
function deletevp ($folio,$conexion){
    $query="UPDATE kardex SET estado='1' WHERE refe_1= '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}


//funcion para autorizar+++++++++++++++++++++++++++++++++++++++++
function autorizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='AUTORIZADO' WHERE refe_1 = '$folio' AND tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function autorizar2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_autorizacion='$fecha', id_person_autor='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}


//funcion para surtir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function surtir1 ($folio,$conexion){
    $query="UPDATE kardex SET status='SURTIDO' WHERE refe_1 = '$folio' AND tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function surtir2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_surtido='$fecha', id_person_surtio='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

function surtirart ($id_kax,$refe_1,$codigo_1,$cantidad,$descripcion,$observa_dep,$conexion){
    $query="UPDATE kardex SET status_2 ='SURTIDO',salida='$cantidad',codigo_1='$codigo_1',descripcion_1='$descripcion',observa_dep='$observa_dep' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function surtirartfn ($id_kax,$refe_1,$codigo_1,$cantidad,$descripcion,$observa_dep,$conexion){
    $query="UPDATE kardex SET status_2 ='SURTIDO',entrada='$cantidad',codigo_1='$codigo_1',descripcion_1='$descripcion',observa_dep='$observa_dep' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar surtido
function surtirartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET salida='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar sin existencia extendido y etiquetas
function sinexistartupda ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET salida='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para actualizar sin existencia articulo final
function snextartupdafn ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET entrada='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
function surtirartupdafin ($id_kax,$refe_1,$cantidad,$observa_dep,$status2,$conexion){
    $query="UPDATE kardex SET entrada='$cantidad',observa_dep='$observa_dep',status_2='$status2' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion que marca sin existencia 
function sinexiste ($id_kax,$refe_1,$codigo_1,$observa_dep,$conexion){
    $query="UPDATE kardex SET salida=0,entrada=0,observa_dep='$observa_dep',status_2='SIN EXISTENCIAS' WHERE refe_1 = '$refe_1' AND tipo='VALE_PRODUCCION' AND id_kax =$id_kax";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}

//funcion para finalizar
function finalizar1 ($folio,$conexion){
    $query="UPDATE kardex SET status='FINALIZADO' WHERE refe_1 = '$folio' AND tipo='VALE_PRODUCCION'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//FINALIZAR2
function finalizar2 ($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query="UPDATE productividad SET fecha_finalizacion='$fecha', id_person_final='$usuario' WHERE referencia_1 = '$folio'";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
    cerrar($conexion);
}
//funcion para LIBERAR vale surtirvpf(593);
function liberarvpro($foliovp,$conexion){
    $query="UPDATE kardex SET status='PENDIENTE' WHERE refe_1 = '$foliovp' AND tipo='VALE_PRODUCCION'";
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
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra articulo individual
function historialinv($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN ARTICULO AL VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1' ' CANTIDAD:' ' $cantidad_real','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra articulo individual ARTICULO FINAL
function historialinvfin($usuario,$refe_1,$codigo_1,$cantidad_real,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN ARTICULO AL VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1' ' CANTIDAD:' ' $cantidad_real','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra historial de autorización
function histautoriza($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AUTORIZA VALE DE PRODUCCIÓN', 'FOLIO:' '$folio','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcar($usuario,$refe_1,$codigocart,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigocart','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcarsll($usuario,$refe_1,$codigocartons,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' '$codigocartons','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialcaple($usuario,$refe_1,$codigocaple,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO: ' '$codigocaple','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialist($usuario,$refe_1,$codigolist,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigolist','$fecha')";
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
//funciones para guardar el historico de la edicion de la cabecera
function histecabe($usuario,$realizo,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$refe_1','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
function histcambio($usuario,$codigo_1,$salida,$costo,$total,$refe_1,$id_kax,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'EDITA ARTICULO VALE OFICINA', 'FOLIO:' '$id_kax ' '$refe_1' ' CODIGO:' '$codigo_1'  ' SALIDA: '  ' $salida' ' COSTO:' ' $costo' ' TOTAL:' ' $total' ,'$fecha')";
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
function histelimi($usuario,$realizo,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'FOLIO:' '$folio','$fecha')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico de surtir
function hisurtir2($usuario,$refe_1,$codigo_1,$cantidad,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE ARTICULO DEL VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO:' ' $codigo_1 ' 'CANTIDAD: ' '$cantidad' ,'$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisupdasurtir($usuario,$refe_1,$descrip,$cantidad,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'ACTUALIZA ARTICULO YA SURTIDO', 'FOLIO:' '$refe_1 ' 'ARTICULO: ' ' $descrip' ' CANTIDAD:' '$cantidad','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function hisliber($usuario,$foliovp,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'LIBERA VALE DE PRODUCCIÓN', 'FOLIO:' '$foliovp','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico liberar
function histsurt($usuario,$foliovp,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'SURTE EL VALE DE PRODUCCIÓN', 'FOLIO:' '$foliovp','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funciones para guardar el historico sin existencias
function histnoexist($usuario,$refe_1,$codigo_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'MARCA QUE NO HAY EXISTENCIAS AL ARTICULO DEL VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1' ' ARTICULO: ' '$codigo_1','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}

//funciones para guardar el historico liberar
function histfinal($usuario,$folio,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha1 = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario', 'FINALIZA EL VALE', 'FOLIO:' '$folio','$fecha1')";
    if(mysqli_query($conexion,$query)){
        return true;
    }else{
        return false;
    }
}
//funcion para registra cambios
function historialadd($usuario,$refe_1,$conexion){
    ini_set('date.timezone','America/Mexico_City');
    $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
    $query = "INSERT INTO historial VALUES (0,'$usuario','AGREGA UN VALE DE PRODUCCIÓN', 'FOLIO:' '$refe_1','$fecha')";
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
<?php 
    include ('../controller/conexion.php');
    session_start();

$usuario1=$_SESSION['username'];

if(!isset($usuario1)){
  header("location: ./../../");
}
    $opcion = $_POST["opcion"];
    $informacion = [];
    
//CONDICIONES------------------------------------------------------------------------------

    //Condición donde registra al usuario
    if($opcion === 'registrar'){
        //se pone los valores que se van a comparar
        $usunom = $_POST['usunom'];
        $usuapell = $_POST['usuapell'];        
        $usuario = $_POST['usuario'];

        if (comprobacion ($usunom,$usuapell,$usuario,$conexion)){
            $correo = $_POST['correo'];
            $contrasenia = $_POST['password'];
            $privilegios = $_POST['privilegios'];
            $password=password_hash($contrasenia,PASSWORD_DEFAULT); //CIFRADO DE CONTRASEÑA

            if (registrar($usunom,$usuapell,$correo,$usuario,$password,$privilegios,$conexion)){
                echo "0";
                historial($usuario1,$usuario,$usunom,$usuapell,$password,$privilegios,$conexion);
            }else{
                echo "1";
            }
        }else{

            echo "2";
        }
    //Condición donde actualiza usuario
    }else if($opcion === 'actualizar'){
        $usunom = $_POST['usunom'];
        $usuapell = $_POST['usuapell'];
        $correo = $_POST['correo'];        
        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['password'];
        $privilegios = $_POST['privilegios'];
        $id_per = $_POST['id_per'];
        $password=password_hash($contrasenia,PASSWORD_DEFAULT); //CIFRADO DE CONTRASEÑA


            if (actualizar($usunom,$usuapell,$correo,$usuario,$password,$privilegios,$id_per,$conexion)){
                echo "0";
                $realizo = 'ACTUALIZO DAT. DEL USUARIO';
                histedith($usuario1,$usuario,$realizo,$usunom,$usuapell,$password,$privilegios,$id_per,$conexion);
            }else{
                echo "1";
            }
    //Condición donde elimina usuario
    }else if($opcion === 'eliminar'){
        $id_per = $_POST['del_per'];
        $persona = $_POST['persona'];

            if (eliminar($id_per,$conexion)){
                echo "0";
                $realizo = 'ELIMINA A USUARIO';
                $usuario='pruebas';
                histdelete($usuario1,$usuario,$realizo,$id_per,$persona,$conexion);
            }else{
                echo "1";
            }
    }else if($opcion === 'actpassword'){
        $contase = $_POST['contase'];
        $password = password_hash($contase,PASSWORD_DEFAULT); //CIFRADO DE CONTRASEÑA
        $confir = $_POST['confir'];
        $idusu = $_POST['idusu'];
            if (updatepassword($password,$idusu,$conexion)){
                echo "0";
                $realizo = 'ACTUALIZA CONTRASEÑA';
                $usuario='pruebas';
                hisupdatepass($usuario,$realizo,$idusu,$conexion);
            }else{
                echo "1";
            }
    }//insertusu


//FUNCIONES-----------------------------------------------------------------------------------

    //funcion de comprobación para ver si la persona ya se encuentra con acceso
    function comprobacion ($usunom,$usuapell,$usuario,$conexion){
        $query="SELECT * FROM accesos WHERE usunom = '$usunom' AND usuapell = '$usuapell' AND estado = 0 OR usuario = '$usuario' AND estado = 0";
        $resultado= mysqli_query($conexion,$query);
        if($resultado->num_rows==0){
            return true;
        }else{
            return false;
        }
        $this->conexion->cerrar();
    }
    //funcion para guardar el registro
    function registrar ($usunom,$usuapell,$correo,$usuario,$password,$privilegios,$conexion){
        $query="INSERT INTO accesos VALUES(0,'$usunom','$usuapell','$correo','$usuario','$password','$privilegios','0','0','0')";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
        $this->conexion->cerrar();
    }
    //funcion para actualizar el registro
    function actualizar ($usunom,$usuapell,$correo,$usuario,$password,$privilegios,$id_per,$conexion){
        $query="UPDATE accesos SET usunom='$usunom', usuapell='$usuapell', correo='$correo', usuario='$usuario', password='$password', privilegios='$privilegios' WHERE id_per = '$id_per'";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
        cerrar($conexion);
    }

    //funcion para actualizar el registro
    function eliminar ($id_per,$conexion){
        $query="UPDATE accesos SET estado=1 WHERE id_per = '$id_per'";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
        cerrar($conexion);
    }
    //funcion para actualizar el registro
    function updatepassword($password,$idusu,$conexion){
        $query="UPDATE accesos SET password='$password' WHERE id_per = '$idusu'";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
        cerrar($conexion);
    }

    //funcion para registra cambios
    function historial($usuario1,$usuario,$usunom,$usuapell,$password,$privilegios,$conexion){
        ini_set('date.timezone','America/Mexico_City');
        $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
        $query = "INSERT INTO historial VALUES (0,'$usuario1','AGREGA UN NUEVO ACCESO','$usunom ' ' $usuapell' ' USUARIO:' ' $usuario' ' CONTASEÑA:' '$password' ' PRIVILEGIOS:' '$privilegios' ,'$fecha')";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
    }
    //funciones para guardar el historico
    function histedith($usuario1,$usuario,$realizo,$usunom,$usuapell,$password,$privilegios,$id_per,$conexion){
        ini_set('date.timezone','America/Mexico_City');
        $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
        $query = "INSERT INTO historial VALUES (0,'$usuario1', '$realizo', ' ID:' '$id_per' ' $usunom '  ' $usuapell' ' USUARIO:' ' $usuario' ' CONTASEÑA:' '$password' ' PRIVILEGIOS:' '$privilegios','$fecha')";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
    }
    function histdelete($usuario1,$usuario,$realizo,$id_per,$persona,$conexion){
        ini_set('date.timezone','America/Mexico_City');
        $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
        $query = "INSERT INTO historial VALUES (0,'$usuario1', '$realizo', ' ID:' '$id_per' ' $persona' ,'$fecha')";
        if(mysqli_query($conexion,$query)){
            return true;
        }else{
            return false;
        }
    }
    function hisupdatepass($usuario,$realizo,$idusu,$conexion){
        ini_set('date.timezone','America/Mexico_City');
        $fecha = date('Y').'/'.date('m').'/'.date('d').' '.date('H:i:s'); //fecha de realización
        $query = "INSERT INTO historial VALUES (0,'$usuario', '$realizo', 'USUARIO:' '$usuario','$fecha')";
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



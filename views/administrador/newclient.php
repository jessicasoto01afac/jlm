<!DOCTYPE html>
<?php 
include ("../controller/conexion.php");
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../template/img/logo.png"/>

    <!-- Meta -->
    <meta name="author" content="Jessica Soto">

    <title>JLM|Agregar Cliente</title>

    <!--  css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/lib/select2/css/select2.min.css" rel="stylesheet"> 
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
    <!-- js -->
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="../controller/js/catalogos.js"></script>


    <!-- Bracket CSS -->

    <link rel="stylesheet" href="../template/css/card.css">
    
  </head>
  <style>
   .swal-wide{
    width: 500px !important;
    font-size: 16px !important;
}
.a-alert {
  outline: none;
  text-decoration: none;
  padding: 2px 1px 0;
}

.a-alert:link {
  color: white;
}

.a-alert:visited {
  color: white;
}
</style>
  <body>
<?php
  include('header.php');
?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="../administrador/clientes.php">Clientes</a>
          <span class="breadcrumb-item active">Alta de Clientes</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">ALTA DE CLIENTES</h4>
      </div>
        <div class="br-pagebody">
          <div class="br-section-wrapper">
              <form id="cientes-alt" method="POST">
                <div class="row mg-b-25">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label label2">Codigo:<span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="number" name="clicodgo" id="clicodgo" placeholder="Ingresar Codigo">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-8">
                    <div class="form-group">
                      <label class="form-control-label label2">Nombre: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="cliennom" id="cliennom" placeholder="Ingresa los Nombre">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label label2">RFC <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="text" name="clierfc" id="clierfc" placeholder="ingresar el RFC">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">Correo: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="cliencorr" id="cliencorr" placeholder="ingresa@hotmail.com">
                    </div>
                  </div><!-- col-8 -->
                </div><!-- row -->
                <div class="form-layout-footer">
                  <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size 14px;" onclick="addclient()">ACEPTAR</button>
                </div><!-- form-layout-footer -->
              </form>
              <br>
                <div style="display:none;" id="dubliclie" name="dubliclie" class="alert alert-warning" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El cliente ya existe ó el codigo a usar ya se ncuentra registrado</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="vacioscli" name="vacioscli" class="alert alert-info" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="errcli" name="errcli" class="alert alert-danger" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar contactar a soporte tecnico o levantar un ticket</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
          </div>
        </div><!-- br-pagebody -->
      <footer class="br-footer">
        <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2017. Derechos reservados a JLM.</div>
          <div>Jose Luis Mondragon y CIA.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <a target="_blank" class="pd-x-5" href="http://www.facebook.com/JLMPAPELERA"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="http://www.jlmycia.com.mx"><i class="fa fa-globe tx-20"></i></a>
        </div>
      </footer>
    </div><!-- br-mainpanel -->
    
    <!-- ########## END: MAIN PANEL ########## -->
    <script src="../template/lib/jquery/jquery.js"></script>
    <script src="../template/lib/popper.js/popper.js"></script>
    <script src="../template/lib/bootstrap/bootstrap.js"></script>
    <script src="../template/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="../template/lib/moment/moment.js"></script>
    <script src="../template/lib/jquery-ui/jquery-ui.js"></script>
    <script src="../template/lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="../template/lib/peity/jquery.peity.js"></script>
    <script src="../template/lib/highlightjs/highlight.pack.js"></script>
    <script src="../template/lib/select2/js/select2.min.js"></script>
    <script src="../template/js/bracket.js"></script>
    <script>
//FUNCION PARA AGREGAR UN USUARIO NUEVO
    function addclient(){
        alert("entra");
        var codigo_clie = document.getElementById('clicodgo').value;
        var nombre = document.getElementById('cliennom').value;
        var rfc = document.getElementById('clierfc').value;
        var email = document.getElementById('cliencorr').value;
        var datos= 'codigo_clie=' + codigo_clie + '&nombre=' + nombre + '&rfc=' + rfc + '&email=' + email + '&opcion=registrar';
        alert(datos);
      if (document.getElementById('clicodgo').value == '' || document.getElementById('cliennom').value == '' || document.getElementById('clierfc').value == '' || document.getElementById('cliencorr').value == '') { 
        document.getElementById('vacioscli').style.display=''
        setTimeout(function(){
          document.getElementById('vacioscli').style.display='none';
        }, 2000);
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertclient.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                    type: 'success',
                    title: 'JLM INFORMA',
                    text: 'SUS DATOS FUERON GUARDADOS CORRECTAMENTE',
                    showCloseButton: false,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonColor: "#1774D8",
                    customClass: 'swal-wide',
                    confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newacces">¿Deseas agregar otro cliente?</a></span>',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<a  class="a-alert" href="clientes"><span style="color: white;">Cerrar</span></a>',
                    cancelButtonAriaLabel: 'Thumbs down'
                        // timer: 2900
                });
          }else if (respuesta == 2) {
            document.getElementById('dubliclie').style.display=''
            setTimeout(function(){
              document.getElementById('dubliclie').style.display='none';
            }, 1000);
            //alert("datos repetidos");
          }else{
            document.getElementById('errcli').style.display=''
            setTimeout(function(){
              document.getElementById('errcli').style.display='none';
            }, 1000);
          }
        });

      }
    } 
//FIN DE LA FUNCIÓN
$(function(){
        'use strict'

        $('.form-layout .form-control').on('focusin', function(){
          $(this).closest('.form-group').addClass('form-group-active');
        });

        $('.form-layout .form-control').on('focusout', function(){
          $(this).closest('.form-group').removeClass('form-group-active');
        });

        // Select2
        $('#select2-a, #select2-b').select2({
          minimumResultsForSearch: Infinity
        });

        $('#select2-a').on('select2:opening', function (e) {
          $(this).closest('.form-group').addClass('form-group-active');
        });

        $('#select2-a').on('select2:closing', function (e) {
          $(this).closest('.form-group').removeClass('form-group-active');
        });

      });
    </script>
  </body>
  
</html>

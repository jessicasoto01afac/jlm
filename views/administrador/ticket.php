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

    <title>JLM|Levantar ticket</title>

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
          <a class="breadcrumb-item" href="../administrador/soporte.php">Soporte Tecnico</a>
          <span class="breadcrumb-item active">Levantar ticket</span>
        </nav>
    </div><!-- br-pageheader -->

    <div class="br-pagebody">
          <div class="br-section-wrapper">
          <div class="pd-x-20 pd-sm-x-10 pd-t-20 pd-sm-t-10">
        <h4 class="tx-gray-800 mg-b-5">LEVANTAR TICKET</h4>
      </div>
              <form id="ticket-alt" method="POST">
       <div class="row mg-t-20">
            <div class="col-xl-12">
              <div class="form-layout form-layout-4">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Datos del ticket</h6>
                <p class="mg-b-30 tx-gray-600">Recuerda enviarnos todos los datos necesarios para la resolución del ticket.</p>
                <div class="row">
                  <label class="col-sm-4 form-control-label">Asunto: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select id="asunto" class="form-control select2" data-placeholder="SELECCIONE ASUNTO">
                        <option value="">SELECCIONE ASUNTO</option>
                        <option value="FALLA">FALLA</option>
                        <option value="ERROR">ERROR</option>
                        <option value="REQUISICIÓN">REQUISICIÓN</option>
                    </select>
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Modulo: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select id="modutick" class="form-control select2" data-placeholder="SELECCIONE MODULO">
                        <option value="">SELECCIONE MODULO</option>
                        <option value="DASHBOARD">DASHBOARD</option>
                        <option value="ACCESOS">ACCESOS</option>
                        <option value="ARTICULOS">ARTICULOS</option>
                        <option value="TRANSFORMACIÓN">TRANSFORMACIÓN</option>
                        <option value="CLIENTES">CLIENTES</option>
                        <option value="PROVEEDORES">PROVEEDORES</option>
                        <option value="PRODUCCIÓN">PRODUCCIÓN</option>
                        <option value="MEMOS">MEMOS</option>
                        <option value="VALE DE OFICIA">VALE DE OFICIA</option>
                        <option value="PEDIDOS">PEDIDOS</option>
                        <option value="COMPRAS">COMPRAS</option>
                        <option value="EXISTENCIA">EXISTENCIA</option>
                        <option value="MOVIMIENTOS">MOVIMIENTOS</option>
                        <option value="REPORTES">REPORTES</option>
                        <option value="REPORTES">ARTICULOS DE PROVEEDOR</option>
                    </select>
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Prioridad: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select id="prioridad" class="form-control select2" data-placeholder="SELECCIONE PRIORIDAD">
                        <option value="">SELECCIONE PRIORIDAD</option>
                        <option value="ALTA">ALTA</option>
                        <option value="MEDIA">MEDIA</option>
                        <option value="BAJA">BAJA</option>
                    </select>
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Mensaje: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <textarea rows="3" class="form-control" placeholder="INGRESE LA DESCRIPCIÓN"></textarea>
                  </div>
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Adjunto Evidencias: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-12 mg-sm-t-0">   
                           <label class="custom-file">
                                <input type="file" class="custom-file-input">
                                <span class="custom-file-control custom-file-control-inverse"></span> 
                           </label>
                        </div><!-- col -->
                </div>
                <div class="row mg-t-20">
                    <label class="col-sm-4 form-control-label">Adjunto Evidencias 2:</label>
                        <div class="col-sm-8 mg-t-12 mg-sm-t-0">   
                           <label class="custom-file">
                                <input type="file" class="custom-file-input">
                                <span class="custom-file-control custom-file-control-inverse"></span> 
                           </label>
                        </div><!-- col -->
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Nombre: <span class="tx-danger">*</span></label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" placeholder="Ingresa tu nombre">
                  </div>
                </div>
                <div class="form-layout-footer mg-t-30">
                  <button class="btn btn-info">Guardar Ticket</button>
                  <button class="btn btn-secondary">Cancelar</button>
                </div><!-- form-layout-footer -->
              </div><!-- form-layout -->
            </div><!-- col-6 -->
        </div><!-- col-6 -->
        </div><!-- col-6 -->
        </div><!-- col-6 -->
      <footer class="br-footer">
        <div class="footer-left">
        <div class="mg-b-2">Copyright &copy; 2022. Derechos reservados a JLM.</div>
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
       // alert("entra agregar articulos");
        var codigo_clie = document.getElementById('clicodgo').value;
        var nombre = document.getElementById('cliennom').value;
        var rfc = document.getElementById('clierfc').value;
        var email = document.getElementById('cliencorr').value;
        var datos= 'codigo_clie=' + codigo_clie + '&nombre=' + nombre + '&rfc=' + rfc + '&email=' + email + '&opcion=registrar';
        //alert(datos);
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
                    cancelButtonText: '<a  class="a-alert" href="clientes.php"><span style="color: white;">Cerrar</span></a>',
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

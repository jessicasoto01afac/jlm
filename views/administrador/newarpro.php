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

    <title>JLM|Add Articulo Proveedor</title>

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

    <!-- <link rel="stylesheet" href="../template/css/card.css"> -->
    
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
<body class="collapsed-menu">
<?php
  include('header.php');
?>
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="../administrador/artiprove.php">Articulos proveedor</a>
          <span class="breadcrumb-item active">Alta de Articulos/proveedor</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">ALTA DE ARTICULO PROVEEDOR</h4>
      </div>
        <div class="br-pagebody">
          <div class="br-section-wrapper">
              <form id="personal-ext" method="POST">
                <div class="row mg-b-25">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label style="font-size:16px" class="form-control-label">SELECCIONE EL PROVEEDOR: <span class="tx-danger">*</span></label>
                        <div id="buscpro"></div>
                    </div><!-- form-group -->
                </div><!-- form-group -->
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label style="font-size:16px" class="form-control-label">SELECCIONE EL ARTICULO: <span class="tx-danger">*</span></label>
                        <div id="busarti"></div>
                    </div><!-- form-group -->
                    </div><!-- form-group -->
                  <div class="col-lg-9">
                    <div class="form-group">
                      <label class="form-control-label label2">DESCRIPCIÓN: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" disabled="" class="form-control inputalta" type="text" name="vdescrip" id="vdescrip" placeholder="">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label label2">CODIGO DEL PROVEEDOR: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="cprove" id="cprove" placeholder="ingresa el codigo del proveedor">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-8">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCRIPCIÓN DEL PROVEEDOR: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="desprov" id="desprov" placeholder="">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">LARGO: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="text" name="largo" id="largo"  placeholder="Ingresa el largo">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">ANCHO: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="text" name="ancho" id="ancho"  placeholder="Ingresa el ancho">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">GRAMAJE: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="text" name="gramaje" id="gramaje"  placeholder="Ingresa Contraseña">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">PESO X MILLAR (KGS): <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="paso_millar" id="paso_millar"  placeholder="Ingresa el peso">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">PESO X HOJA: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="peso_hoja" id="peso_hoja"  placeholder="Ingresa el peso por hoja">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                    <label class="form-control-label label2">PRESENTACIÓN: <span class="tx-danger">*</span></label>
                      <select class="form-control select2 inputalta" id="prensent" name="prensent" data-placeholder="Eliga una opción">
                        <option label="Choose country"></option>
                        <option value="ROLLO">ROLLO</option>
                        <option value="PQT CON HOJAS">PQT CON HOJAS</option>
                        <option value="A GRANE">A GRANEL</option>
                        <option value="PAQ. C/100 HOJAS">PAQ. C/100 HOJAS</option>
                     </select>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">PESO KGS PQT CERRADO: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="kgs_paqcerr" id="kgs_paqcerr"  placeholder="Ingresa el peso">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">UNIDAD: <span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="text" name="unidad" id="unidad"  placeholder="Ingresa la unidad">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-12">
                    <div class="form-group mg-b-10-force">
                        <h5 for="">COSTO</h5>
                    </div>
                  </div><!-- col-8 -->
                  <br>
                  <br>
                  <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">PRECIO ANTERIOR:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="price_antr" id="price_antr"  placeholder="Ingresa precio anterior">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">PRECIOS ACTUAL:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="price_actl" id="price_actl"  placeholder="Ingresa precio actual">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 1:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des1" id="des1"  placeholder="Ingresa Descuento1">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 2:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des2" id="des2"  placeholder="Ingresa Descuento2">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 3:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des3" id="des3"  placeholder="Ingresa Descuento3">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 4:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des4" id="des4"  placeholder="Ingresa Descuento4">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 5:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des5" id="des5"  placeholder="Ingresa Descuento5">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-2">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">DESCUENTO 6:<span class="tx-danger">*</span></label>
                      <input class="form-control inputalta" type="number" name="des6" id="des6"  placeholder="Ingresa Descuento6">
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">OBSERVACION:<span class="tx-danger">*</span></label>
                      <textarea class="col-sm-12" name="comentarios1" id="comentarios1" rows="2" cols="10" onkeyup="mayus(this);" style="font-size: 14px; border-radius: 5px;" placeholder="Comentarios Adicionales"></textarea>
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-6">
                    <div class="form-group mg-b-10-force">
                      <label class="form-control-label label2">OBSERVACION 2:<span class="tx-danger">*</span></label>
                      <textarea class="col-sm-12" name="comentarios2" id="comentarios2" rows="2" cols="10" onkeyup="mayus(this);" style="font-size: 14px; border-radius: 5px;" placeholder="Comentarios Adicionales"></textarea>
                    </div>
                  </div><!-- col-8 -->
                </div><!-- row -->
                <div class="form-layout-footer">
                  <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size:14px;" onclick="savearprove()">ACEPTAR</button>
                </div><!-- form-layout-footer -->
              </form>
              <br>
                <div style="display:none;" id="dubli" name="dubli" class="alert alert-warning" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="vacios" name="vacios" class="alert alert-info" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="err" name="err" class="alert alert-danger" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-24"></i>
                    <span><strong>Advertencia!</strong>No se puedo guardar coontactar a soporte tecnico o levantar un ticket</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
          </div>
        </div><!-- br-pagebody -->
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
    function savearprove(){
        //alert("entra");
        let id_articulo = String(document.getElementById('vcodigo').value);
        let proveedor = document.getElementById('vprov').value;
        let codigo_proveedor = document.getElementById('cprove').value;
        let descrip_proveedor = document.getElementById('desprov').value;
        let largo = document.getElementById('largo').value;
        let ancho = document.getElementById('ancho').value;
        let gramaje = document.getElementById('gramaje').value;
        let peso_x_millar = document.getElementById('paso_millar').value;
        let peso_x_hoja = document.getElementById('peso_hoja').value;
        let presentacion = document.getElementById('prensent').value;
        let peso_paq_cerrado = document.getElementById('kgs_paqcerr').value;
        let unidad = document.getElementById('unidad').value;
        let precio_anterior = document.getElementById('price_antr').value;
        let precio_actual = document.getElementById('price_actl').value;
        let des1 = document.getElementById('des1').value;
        let des2 = document.getElementById('des2').value;
        let des3 = document.getElementById('des3').value;
        let des4 = document.getElementById('des4').value;
        let des5 = document.getElementById('des5').value;
        let des6 = document.getElementById('des6').value;
        let observ1 = document.getElementById('comentarios1').value;
        let observ2 = document.getElementById('comentarios2').value;


        let datos= 'id_articulo=' + id_articulo + '&proveedor=' + proveedor + '&codigo_proveedor=' + codigo_proveedor + '&descrip_proveedor=' + descrip_proveedor + '&largo=' + largo 
        + '&ancho=' + ancho + '&gramaje=' + gramaje + '&peso_x_millar=' + peso_x_millar + '&peso_x_hoja=' + peso_x_hoja + '&presentacion=' + presentacion + '&peso_paq_cerrado=' + peso_paq_cerrado + '&unidad=' + unidad + '&precio_anterior=' + precio_anterior + '&precio_actual=' + precio_actual + '&des1=' + des1 + '&des2=' + des2 + '&des3=' + des3
        + '&des4=' + des4 + '&des5=' + des5 + '&des6=' + des6 + '&observ1=' + observ1 + '&observ2=' + observ2 + '&opcion=registrar';
        //var datos =$('#personal-ext').serialize();
      //alert(datos);
      if (id_articulo.value == '' ||proveedor.value == '' || codigo_proveedor.value == '' || descrip_proveedor.value == '' || precio_actual.value == '') { 
        document.getElementById('vacios').style.display=''
        setTimeout(function(){
          document.getElementById('vacios').style.display='none';
        }, 2000);
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertartprov.php",
          data:datos
        }).done(function(respuesta){
          //alert(respuesta);
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
                    confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newarpro">¿Deseas agregar otro registro?</a></span>',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<a  class="a-alert" href="artiprove.php"><span style="color: white;">Cerrar</span></a>',
                    cancelButtonAriaLabel: 'Thumbs down'
                        // timer: 2900
                });
          }else if (respuesta == 2) {
            document.getElementById('dubli').style.display=''
            setTimeout(function(){
              document.getElementById('dubli').style.display='none';
            }, 1000);
            //alert("datos repetidos");
          }else{
            document.getElementById('err').style.display=''
            setTimeout(function(){
              document.getElementById('err').style.display='none';
            }, 1000);
          }
        });

      }
    } 
    $(document).ready(function(){
$('#buscpro').load('./select/buspro.php');
$('#busarti').load('./select/buscar.php');

});
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

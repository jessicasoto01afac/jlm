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

    <title>JLM | Agregar proveedor</title>

    <!--  css -->
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../template/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="../template/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="../template/lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="../template/lib/highlightjs/github.css" rel="stylesheet">
    <link href="../template/css/sweetalert2.min.css" type="text/css" rel="stylesheet">
    <!-- librerias anexas -->
    <script type="text/javascript" language="javascript" src="../datas/jquery-3.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/jquery.js"></script>
    <script type="text/javascript" async="" src="../datas/ga.js"></script>
    <script type="text/javascript" language="javascript" src="../datas/demo.js"></script>
    <script src="../template/js/sweetalert2.all.min.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../template/css/bracket.css">
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
          <a class="breadcrumb-item" href="../administrador/provedores.php">Proveedores</a>
          <span class="breadcrumb-item active">Alta de Proveedor</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">ALTA DE PROVEEDORES</h4>
      </div>
        <div class="br-pagebody">
          <div class="br-section-wrapper">
              <form id="altarticulos" method="POST">
                <div class="row mg-b-25">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label label2">Codigo: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="codigo_pro" id="codigo_pro" placeholder="Ingresar el codigo">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group mg-b-4-force">
                    <label class="form-control-label label2">CONDICIONES DE PAGO: <span class="tx-danger">*</span></label>
                      <select class="form-control inputalta" id="condi_pago" name="condi_pago">
                        <option value="">SELECCIONA UNA OPCIÓN</option>
                        <option value="NO APLICA">NO APLICA</option>
                        <option value="CONTADO">CONTADO</option>
                        <option value="7 DIAS">7 DIAS</option>
                        <option value="8 DIAS">8 DIAS</option>
                        <option value="15 DIAS">15 DIAS</option>
                        <option value="30 DIAS">30 DIAS</option>
                        <option value="45 DIAS">45 DIAS</option>
                        <option value="60 DIAS">60 DIAS</option>
                      </select>
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label label2">Nombre de proveedores: <span class="tx-danger">*</span></label>
                      <input onkeyup="mayus(this);" class="form-control inputalta" type="text" name="nom_pro" id="nom_pro" placeholder="Ingresa la Descripción">
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label label2">Domicilio Fiscal: <span class="tx-danger">*</span></label>
                      <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="domi_fisc" id="domi_fisc" placeholder="Ingresa el domicilio fiscal"></textarea>
                    </div>
                  </div><!-- col-12 -->
                  <div class="col-lg-12">
                    <div class="form-group mg-b-4-force">
                    <label style="font-size:16px;" class="form-control-label label2">CONTACTO 1<span class="tx-danger">*</span></label>
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
                        <input onkeyup="mayus(this);" type="text" class="form-control " name="cont_1" id="cont_1" placeholder="Nombre de contacto 1">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" title="ingresar el telefono" name="tel_c1" id="tel_c1" class="form-control inputalta" placeholder="(999) 999-9999">
                    </div>
                  </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" name="tel_c2" id="tel_c2" class="form-control inputalta" placeholder="(999) 999-9999">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta" name="email_c1" id="email_c1" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta"  name="email_c2" id="email_c2" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-12">
                    <div class="form-group mg-b-4-force">
                    <label style="font-size:16px;" class="form-control-label label2">CONTACTO 2<span class="tx-danger"></span></label>
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="text" class="form-control" name="cont_2" id="cont_2" placeholder="Nombre de contacto 2">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" title="ingresar el telefono" name="tel_c3" id="tel_c3" class="form-control inputalta" placeholder="(999) 999-9999">
                    </div>
                  </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" class="form-control inputalta" name="tel_c4" id="tel_c4" placeholder="(999) 999-9999">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta" name="email_c3" id="email_c3" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta" name="email_c4" id="email_c4" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-12">
                    <div class="form-group mg-b-4-force">
                    <label style="font-size:16px;" class="form-control-label label2">CONTACTO 3<span class="tx-danger"></span></label>
                    </div>
                  </div><!-- col-8 -->
                  <div class="col-lg-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-person tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="text" class="form-control" name="cont_3" id="cont_3" placeholder="Nombre de contacto 3">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                    <div class="form-group">
                      <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" title="ingresar el telefono" name="tel_c5" id="tel_c5" class="form-control inputalta" placeholder="(999) 999-9999">
                    </div>
                  </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-4">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-phone tx-16 lh-0 op-6"></i></span>
                      <input onkeyup="mayus(this);" type="number" class="form-control inputalta" name="tel_c6" id="tel_c6" placeholder="(999) 999-9999">
                    </div>
                    </div>
                  </div><!-- col-4 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta" name="email_c5" id="email_c5" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-6">
                  <div class="form-group">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-envelope tx-16 lh-0 op-6"></i></span>
                      <input type="email" class="form-control inputalta" name="email_c6" id="email_c6" placeholder="ingresar@correo">
                    </div>
                    </div>
                  </div><!-- col-6 -->
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label class="form-control-label label2">OBSERBACIONES: <span class="tx-danger"></span></label>
                      <textarea onkeyup="mayus(this);" rows="3" class="form-control" name="obser_prov" id="obser_prov" placeholder="Ingresa alguna observación"></textarea>
                    </div>
                  </div><!-- col-12 -->
                </div><!-- row -->
                <div class="form-layout-footer">
                  <button type="button" class="btn btn-info" style="background-color:#1774D8; font-size 14px;" onclick="addProvee()">ACEPTAR</button>
                </div><!-- form-layout-footer -->
              </form>
              <br>
                <div style="display:none;" id="dublipro" name="dublipro" class="alert alert-warning" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> El resgistro ya existe</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="vaciosprov" name="vaciosprov" class="alert alert-info" role="alert">
                  <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-information alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                    <span><strong>Advertencia!</strong> Llenar todos los campos</span>
                  </div><!-- d-flex -->
                </div><!-- alert --> 
                <div style="display:none;" id="errpro" name="errpro" class="alert alert-danger" role="alert">
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
//agrega a base de datos de articulos
      function addProvee() {
        //alert("entra agregar proveedores");
        var codigo_pro = document.getElementById('codigo_pro').value; 
        var nom_pro = document.getElementById('nom_pro').value;
        var domi_fisc = document.getElementById('domi_fisc').value;
        var condi_pago = document.getElementById('condi_pago').value;
        var cont_1 = document.getElementById('cont_1').value;
        var tel_c1 = document.getElementById('tel_c1').value;
        var tel_c2 = document.getElementById('tel_c2').value;
        var email_c1 = document.getElementById('email_c1').value;
        var email_c2 = document.getElementById('email_c2').value;
        var cont_2 = document.getElementById('cont_2').value;
        var tel_c3 = document.getElementById('tel_c3').value;
        var tel_c4 = document.getElementById('tel_c4').value;
        var email_c3 = document.getElementById('email_c3').value;
        var email_c4 = document.getElementById('email_c4').value;
        var cont_3 = document.getElementById('cont_3').value;
        var tel_c5 = document.getElementById('tel_c5').value;
        var tel_c6 = document.getElementById('tel_c6').value;
        var email_c5 = document.getElementById('email_c5').value;
        var email_c6 = document.getElementById('email_c6').value;
        var obser_prov = document.getElementById('obser_prov').value;

        var datos= 'codigo_pro=' + codigo_pro + '&nom_pro=' + nom_pro + '&domi_fisc=' + domi_fisc + '&condi_pago=' + condi_pago + '&cont_1=' + cont_1 + '&tel_c1=' + tel_c1 + '&tel_c2=' + tel_c2 + '&email_c1=' + email_c1 + '&email_c2=' + email_c2 + '&cont_2=' + cont_2 + '&tel_c3=' + tel_c3 + '&tel_c4=' + tel_c4 + '&email_c3=' + email_c3 + '&email_c4=' + email_c4 + '&cont_3=' + cont_3 + '&tel_c5=' + tel_c5 + '&tel_c6=' + tel_c6 + '&email_c5=' + email_c5 + '&email_c6=' + email_c6 + '&obser_prov=' + obser_prov +  '&opcion=registrar';
        //alert(datos);
        if (document.getElementById('codigo_pro').value == '' || document.getElementById('nom_pro').value == '' || document.getElementById('domi_fisc').value == '' || document.getElementById('condi_pago').value == '' || document.getElementById('cont_1').value == '' || document.getElementById('tel_c1').value == '' || document.getElementById('email_c1').value == '' ) {
          document.getElementById('vaciosprov').style.display=''
          setTimeout(function(){
          document.getElementById('vaciosprov').style.display='none';
        }, 1500);
          return;
        } else {
          $.ajax({
            type:"POST",
            url:"../controller/php/insertprove.php",
            data:datos
          }).done(function(respuesta){
            if (respuesta==0){
              Swal.fire({
                    type: 'success',
                    title: 'JLM INFORMA',
                    text: 'EL ARTICULO SE AGREGO CORRECTAMENTE',
                    showCloseButton: false,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonColor: "#1774D8",
                    customClass: 'swal-wide',
                    confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newarticul">¿Deseas agregar otro articulo?</a></span>',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<a  class="a-alert" href="provedores.php"><span style="color: white;">Cerrar</span></a>',
                    cancelButtonAriaLabel: 'Thumbs down'
                        // timer: 2900
                });
            }else if (respuesta == 2) {
              document.getElementById('dublipro').style.display='';
              setTimeout(function(){
              document.getElementById('dublipro').style.display='none';
              }, 1000);
            }else{
              document.getElementById('errpro').style.display='';
              setTimeout(function(){
              document.getElementById('errpro').style.display='none';
              }, 2000);
            alert(respuesta);
            }
          });//FIN DE AJAX
        }
      }
    </script>
  </body>
</html>

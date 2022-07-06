"use strict";

$(document).ready(function () {
  'use strict';

  $('#wizard2').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    enableFinishButton: false,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    onStepChanging: function onStepChanging(event, currentIndex, newIndex) {
      if (currentIndex < newIndex) {
        // Step 1 form validation
        if (currentIndex === 0) {
          var fname = $('#vfolio').parsley();
          var lname = $('#vfecha').parsley();

          if (fname.isValid() && lname.isValid()) {
            return true;
          } else {
            fname.validate();
            lname.validate();
          }
        } // Step 2 form validation


        if (currentIndex === 1) {
          var email = $('#vcodigo').parsley();

          if (email.isValid()) {
            return true;
          } else {
            email.validate();
          }
        } // Always allow step back to the previous step even if the current step is not valid.

      } else {
        return true;
      }
    }
  });
  $('#wizard3').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    stepsOrientation: 1
  });
  $('#wizard4').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    cssClass: 'wizard step-equal-width'
  });
  $('#wizard5').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    enableFinishButton: true,
    transitionEffect: "fade",
    autoFocus: true,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    cssClass: 'wizard wizard-style-1',
    labels: {
      cancel: "Cancelar",
      current: "current step:",
      pagination: "Pagination",
      finish: "Finalizar",
      next: "Siguiente",
      previous: "Anterior",
      loading: "Cargando ..."
    },
    onFinished: function onFinished(event, currentIndex) {
      //alert("Form submitted.");
      var refe_1 = document.getElementById('vpfolio').value;
      var fecha = document.getElementById('vpfecha').value;
      var refe_2 = document.getElementById('vpdepsoli').value;
      var refe_3 = document.getElementById('vptipo').value;
      var proveedor_cliente = document.getElementById('vpdepentr').value;

      if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || refe_2 == '') {
        document.getElementById('vaciosvp').style.display = '';
        setTimeout(function () {
          document.getElementById('vaciosvp').style.display = 'none';
        }, 2000);
        return;
      } else {
        Swal.fire({
          type: 'success',
          text: 'Se finaliza de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'vale_produccion.php';", 1500);
      }
    }
  });
  $('#wizard6').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    errorSteps: [],
    next: 'Siguiente',
    previous: 'Anterior',
    finish: 'Finalizar',
    enableFinishButton: false,
    loadingTemplate: '<span class="spinner"></span> #text#',
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    cssClass: 'wizard wizard-style-2',
    labels: {
      cancel: "Cancelar",
      current: "current step:",
      pagination: "Pagination",
      finish: "Cerrar",
      next: "Siguiente",
      previous: "Anterior",
      loading: "Cargando ..."
    }
  });
  $('#wizard7').steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    cssClass: 'wizard wizard-style-3'
  });
});
$(document).ready(function () {
  $('#busccodimem').load('./select/buscarttras.php');
  $('#busccodigomem2').load('./select/buscarme2.php');
  $('#buscpedido').load('./select/buspedi.php');
}); //LLAMADO DE DATOS

function updatedvp() {
  //alert("entro el update");
  //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
  document.getElementById('mcodigotr').value = "";
  document.getElementById('mdecriptr').value = "";
  document.getElementById('vpcantidad').value = "";
  document.getElementById('vpcantidad').value = "";
  document.getElementById('vpbservo').value = "";
  document.getElementById('pedidomem').value = ""; //INFORMACION DE LAS TBLAS

  var id_valeproduc = document.getElementById('vpfolio').value;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref == 'EXTENDIDO') {
        x++;
        var id_valepro = obj.data[U].id_kax;
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearvpnew'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#listextent").html(html);
    'use strict';

    $('#lisextendid').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Buscar...',
        sSearch: '',
        lengthMenu: 'mostrando _MENU_ paginas',
        sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
        sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
        sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
        oPaginate: {
          sFirst: 'Primero',
          sLast: 'Último',
          sNext: 'Siguiente',
          sPrevious: 'Anterior'
        }
      }
    });
  }); //LLAMADA DE ETIQUETAS

  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref == 'ETIQUETAS') {
        x++;
        var id_valepro = obj.data[U].id_kax;
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart(" + id_valepro + ");'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#listetiquetas").html(html);
    'use strict';

    $('#etiquetasvp').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Buscar...',
        sSearch: '',
        lengthMenu: 'mostrando _MENU_ paginas',
        sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
        sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
        sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
        oPaginate: {
          sFirst: 'Primero',
          sLast: 'Último',
          sNext: 'Siguiente',
          sPrevious: 'Anterior'
        }
      }
    });
  }); //LLAMADA DE PRODUCTO TERMINADO

  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
        x++;
        valprd = obj.data[U].id_kax; //alert(id_valepro);

        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(" + valprd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a href='' class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart(" + valprd + ");'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#listproducfinal").html(html);
    'use strict';

    $('#produfinalvp').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Buscar...',
        sSearch: '',
        lengthMenu: 'mostrando _MENU_ paginas',
        sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
        sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
        sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
        oPaginate: {
          sFirst: 'Primero',
          sLast: 'Último',
          sNext: 'Siguiente',
          sPrevious: 'Anterior'
        }
      }
    });
  });
} //FUNCIÓN QUE SIRVE PARA AGREGAR UN ARTICULO AL VALE DE PRODUCCIÓN 05062022


function addvaleprodu() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('vpfolio').value;
  var fecha = document.getElementById('vpfecha').value;
  var refe_2 = document.getElementById('vpdepsoli').value;
  var refe_3 = document.getElementById('vptipo').value;
  var proveedor_cliente = document.getElementById('vpdepentr').value;
  var codigo_1 = document.getElementById('mcodigotr').value;
  var descripcion_1 = document.getElementById('mdecriptr').value;
  var cantidad_real = document.getElementById('vpcantidad').value;
  var salida = document.getElementById('vpcantidad').value;
  var observa = document.getElementById('vpbservo').value;
  var ubicacion = document.getElementById('pedidomem').value;
  var caracter = document.getElementById('vpcaracter').value;
  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&caracter=' + caracter + '&opcion=registrar'; //alert(datos);

  if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
    document.getElementById('vaciosvp').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosvp').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updatedvp();
      } else if (respuesta == 2) {
        document.getElementById('dublivp').style.display = '';
        setTimeout(function () {
          document.getElementById('dublivp').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('errvp').style.display = '';
        setTimeout(function () {
          document.getElementById('errvp').style.display = 'none';
        }, 1000);
      }
    }); //ARTICULOS EXTRA--------------------------------------------------------

    $.ajax({
      url: '../controller/php/contrasforma.php',
      type: 'POST'
    }).done(function (respuesta) {
      obj = JSON.parse(respuesta);
      var res = obj.data;
      var x = 0;

      for (D = 0; D < res.length; D++) {
        if (obj.data[D].id_articulo_final == codigo_1) {
          //SI APLICA CARTON
          if (obj.data[D].carton == "APLICA") {
            codigocart = obj.data[D].id_carton;
            var datoscart = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocart=' + codigocart + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcarton'; //alert(datoscart);

            $.ajax({
              type: "POST",
              url: "../controller/php/insertvapro.php",
              data: datoscart
            }).done(function (respuesta) {
              if (respuesta == 0) {
                updatedvp();
              } else if (respuesta == 2) {
                document.getElementById('dublivp').style.display = '';
                setTimeout(function () {
                  document.getElementById('dublivp').style.display = 'none';
                }, 1000); //alert("datos repetidos");
              } else {
                  /*document.getElementById('errvp').style.display='';
                  setTimeout(function(){
                      document.getElementById('errvp').style.display='none';
                  }, 1000);*/
                }
            });
          } //SI APLICA CARTONSILLO


          if (obj.data[D].cartonsillo == "APLICA") {
            codigocartons = obj.data[D].id_cortonsillo;
            var datoscasill = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocartons=' + codigocartons + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcartonsillo'; //alert(datoscasill);

            $.ajax({
              type: "POST",
              url: "../controller/php/insertvapro.php",
              data: datoscasill
            }).done(function (respuesta) {
              if (respuesta == 0) {
                updatedvp();
              } else if (respuesta == 2) {
                document.getElementById('dublivp').style.display = '';
                setTimeout(function () {
                  document.getElementById('dublivp').style.display = 'none';
                }, 1000); //alert("datos repetidos");
              } else {
                  /*document.getElementById('errvp').style.display='';
                   setTimeout(function(){
                       document.getElementById('errvp').style.display='none';
                   }, 1000);*/
                }
            });
          } //SI APLICA CAPLE


          if (obj.data[D].caple == "APLICA") {
            codigocaple = obj.data[D].id_caple;
            var datoscaple = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocaple=' + codigocaple + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcaple'; //alert(datoscasill);

            $.ajax({
              type: "POST",
              url: "../controller/php/insertvapro.php",
              data: datoscaple
            }).done(function (respuesta) {
              if (respuesta == 0) {
                updatedvp();
              } else if (respuesta == 2) {
                document.getElementById('dublivp').style.display = '';
                setTimeout(function () {
                  document.getElementById('dublivp').style.display = 'none';
                }, 1000); //alert("datos repetidos");
              } else {
                  /*document.getElementById('errvp').style.display='';
                  setTimeout(function(){
                      document.getElementById('errvp').style.display='none';
                  }, 1000);*/
                }
            });
          } //SI APLICA LISTON/CORDON


          if (obj.data[D].liston_cordon == "APLICA") {
            codigolist = obj.data[D].id_cordliston;
            var datoslist = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigolist=' + codigolist + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regliston'; //alert(datoscasill);

            $.ajax({
              type: "POST",
              url: "../controller/php/insertvapro.php",
              data: datoslist
            }).done(function (respuesta) {
              if (respuesta == 0) {
                updatedvp();
              } else if (respuesta == 2) {
                document.getElementById('dublivp').style.display = '';
                setTimeout(function () {
                  document.getElementById('dublivp').style.display = 'none';
                }, 1000); //alert("datos repetidos");
              } else {
                  /*document.getElementById('errvp').style.display='';
                   setTimeout(function(){
                       document.getElementById('errvp').style.display='none';
                   }, 1000);*/
                }
            });
          }
        }
      }
    });
  }
} //ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN


function editarinsvp(valprd) {
  //alert(valprd);
  document.getElementById('id_exedith').value = valprd;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == valprd) {
        //alert("entro");
        document.getElementById('cdnewvpedith').value = obj.data[C].codigo_1;
        document.getElementById('vpednewtcantid').value = obj.data[C].salida;
        document.getElementById('vpobsaddnew').value = obj.data[C].observa;
        document.getElementById('posicionextnew').value = obj.data[C].tipo_ref;
      }
    }
  }); //informacion del articulos

  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vpnewedithdes").val(o[1]);
        $("#vpedthdeparnew").val(o[2]);
      }
    }
  });
} //LLAMADO DE DATOS


function cancelar() {
  //alert("entra cancelar");
  var refe_1 = document.getElementById('vpfolio').value;
  var datos = 'refe_1=' + refe_1 + '&opcion=cancelar';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se cancelelo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'vale_produccion.php';", 1500);
    } else if (respuesta == 2) {
      document.getElementById('dublivp').style.display = '';
      setTimeout(function () {
        document.getElementById('dublivp').style.display = 'none';
      }, 1000); //alert("datos repetidos");
    } else {
      document.getElementById('errvp').style.display = '';
      setTimeout(function () {
        document.getElementById('errvp').style.display = 'none';
      }, 1000);
    }
  });
} //cambio de descripcion articulo indivual


function edithextnewvp() {
  //alert("eentraarticulo")
  var codivo = document.getElementById('vpcodetiqnew').value;
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vpnewedithdes").val(o[1]);
        $("#vpedthdeparnew").val(o[2]);
      }
    }
  });
} //GUARDAR EL ARTICLO INDIVIDUAL


function addarinpro() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('vpfolio').value;
  var fecha = document.getElementById('vpfecha').value;
  var refe_2 = document.getElementById('vpdepsoli').value;
  var refe_3 = document.getElementById('vptipo').value;
  var proveedor_cliente = document.getElementById('vpdepentr').value;
  var codigo_1 = document.getElementById('codindiv').value;
  var descripcion_1 = document.getElementById('vindescrip').value;
  var cantidad_real = document.getElementById('vincantid').value;
  var salida = document.getElementById('vincantid').value;
  var observa = document.getElementById('vinfbsertras').value;
  var ubicacion = document.getElementById('vindepar').value;
  var tipo_ref = document.getElementById('psiciont').value;
  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind'; //alert(datos);

  if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '') {
    document.getElementById('edthvaincios1').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvaincios1').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updatedvp();
        $("#modal-artinviprod").modal('hide'); //ocultamos el modal

        codigo_1 = "";
        descripcion_1 = "";
        cantidad_real = "";
        tipo_ref = "0";
        observa = "";
      } else if (respuesta == 2) {
        document.getElementById('edthvinbli1').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvinbli1').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvinperr1').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvinperr1').style.display = 'none';
        }, 1000);
      }
    });
  }
} //funcion para ver la informacion de vale de producción 12062022


function valproduct(id_produc) {
  //alert(id_produc);
  $("#detaproduccion").toggle(250); //Muestra contenedor de detalles

  $("#lista").toggle("fast"); //Oculta lista

  document.getElementById('vpfolio').value = id_produc;
  var autorizar = document.getElementById('btnvpautoriz');
  var liberar = document.getElementById('btnvpliberar');
  var surtir = document.getElementById('btnvpsurtir');
  var finalizado = document.getElementById('btnvpfinaliz');
  var editar = document.getElementById('openedivpinf');
  $.ajax({
    url: '../controller/php/infvale_produc.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].refe_1 == id_produc) {
        datos = obj.data[D].fecha + '*' + obj.data[D].refe_2 + '*' + obj.data[D].refe_3 + '*' + obj.data[D].proveedor_cliente + '*' + obj.data[D].ubicacion + '*' + obj.data[D].caracter_vale + '*' + obj.data[D].id_person_creacion + '*' + obj.data[D].id_person_autor + '*' + obj.data[D].id_person_surtio + '*' + obj.data[D].id_person_final + '*' + obj.data[D].status + '*' + obj.data[D].fecha_surtido + '*' + obj.data[D].estado;
        var o = datos.split("*");
        $("#infvpdate").val(o[0]);
        $("#infvpdepat").val(o[1]);
        $("#infvptipo").val(o[2]);
        $("#infvpsolicita").val(o[3]);
        $("#infvppedidos").val(o[4]);
        $("#infvpcaracter").val(o[5]);
        $("#infvpformula").val(o[6]);
        $("#infvpautoriza").val(o[7]);
        $("#infvpsutio").val(o[8]);
        $("#infvprecibio").val(o[9]);
        $("#infvpestatus").val(o[10]);
        $("#infvpdatesurt").val(o[11]); //alert(obj.data[D].refe_1);

        document.getElementById('folprod').innerHTML = obj.data[D].refe_1; //PENDIENTE-----------------------------------------------------------------------------------------------

        if (obj.data[D].status == 'PENDIENTE') {
          var _autorizar = document.getElementById('btnvpautoriz');

          _autorizar.style.display = '';
          editar.style.display = '';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a class='nav-link' onclick='deletedettart(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearvpdett'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="etiquetas" name="etiquetas" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a class='nav-link' data-toggle='modal' data-target='#modal-delearvpdett' onclick='deletedettart(" + id_valepro + ");'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //alert(id_valepro);

                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + valprd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a href='' class='nav-link' data-toggle='modal' data-target='#modal-delearvpdett' onclick='deletedettart(" + valprd + ");'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          }); //AUTORIZADO 29062022-----------------------------------------------------------------------------------------------------------
        } else if (obj.data[D].status == 'AUTORIZADO') {
          surtir.style.display = '';
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpf(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpf(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpfin(" + valprd + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtprterm'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        } else if (obj.data[D].status == 'SURTIDO') {
          finalizado.style.display = '';
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        } else if (obj.data[D].status == 'FINALIZADO') {
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        }
      }
    }
  });
} //actualizar todo


function updatedvpdett() {
  var id_produc = document.getElementById('folprod').innerHTML;
  var status = document.getElementById('infvpestatus').value;
  var autorizar = document.getElementById('btnvpautoriz');
  var liberar = document.getElementById('btnvpliberar');
  var surtir = document.getElementById('btnvpsurtir');
  var finalizado = document.getElementById('btnvpfinaliz');
  var editar = document.getElementById('openedivpinf'); //alert(id_produc);

  $.ajax({
    url: '../controller/php/infvale_produc.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].refe_1 == id_produc) {
        //alert(status);
        datos = obj.data[D].fecha + '*' + obj.data[D].refe_2 + '*' + obj.data[D].refe_3 + '*' + obj.data[D].proveedor_cliente + '*' + obj.data[D].ubicacion + '*' + obj.data[D].caracter_vale + '*' + obj.data[D].id_person_creacion + '*' + obj.data[D].id_person_autor + '*' + obj.data[D].id_person_surtio + '*' + obj.data[D].id_person_final + '*' + obj.data[D].status + '*' + obj.data[D].fecha_surtido + '*' + obj.data[D].estado;
        var o = datos.split("*");
        $("#infvpdate").val(o[0]);
        $("#infvpdepat").val(o[1]);
        $("#infvptipo").val(o[2]);
        $("#infvpsolicita").val(o[3]);
        $("#infvppedidos").val(o[4]);
        $("#infvpcaracter").val(o[5]);
        $("#infvpformula").val(o[6]);
        $("#infvpautoriza").val(o[7]);
        $("#infvpsutio").val(o[8]);
        $("#infvprecibio").val(o[9]);
        $("#infvpestatus").val(o[10]);
        $("#infvpdatesurt").val(o[11]);

        if (status == 'PENDIENTE') {
          var _autorizar2 = document.getElementById('btnvpautoriz');

          _autorizar2.style.display = '';
          editar.style.display = '';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a class='nav-link' onclick='deletedettart(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearvpdett'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="etiquetas" name="etiquetas" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a class='nav-link' data-toggle='modal' data-target='#modal-delearvpdett' onclick='deletedettart(" + id_valepro + ");'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //alert(id_valepro);

                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvpdett(" + valprd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetvp'>Editar</a><a href='' class='nav-link' data-toggle='modal' data-target='#modal-delearvpdett' onclick='deletedettart(" + valprd + ");'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          }); //AUTORIZADO-----------------------------------------------------------------------------------------------------------
        } else if (status == 'AUTORIZADO') {
          surtir.style.display = '';
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpf(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpf(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<button type='button' onclick='surtirvpfin(" + valprd + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtprterm'>SURTIR</button>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        } else if (status == 'SURTIDO') {
          finalizado.style.display = '';
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        } else if (status == 'FINALIZADO') {
          liberar.style.display = '';
          editar.style.display = 'none';
          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'EXTENDIDO') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listextent").html(html);
            'use strict';
          }); //LLAMADA DE ETIQUETAS

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'ETIQUETAS') {
                x++;
                var id_valepro = obj.data[U].id_kax; //==================================================================================26062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + id_valepro + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listetiquetas").html(html);
            'use strict';
          }); //LLAMADA DE PRODUCTO TERMINADO

          $.ajax({
            url: '../controller/php/convale_pro.php',
            type: 'POST'
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="display table table-striped dataTable responsive no-footer dtr-inline"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SUTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref == 'PRODUCTO_TERMINADO') {
                x++;
                valprd = obj.data[U].id_kax; //==================================================================================30062022

                if (obj.data[U].status_2 == "PENDIENTE") {
                  estatus = "<span title='Pendiente por surtir' onclick='infonosur()' data-toggle='modal' data-target='#modal-sinexivp' class='pendiente tx-center' style='font-size:12px; cursor:pointer;'>NO SE SURIO</span>";
                } else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtifin(" + valprd + ")' data-toggle='modal' data-target='#modal-surtidofin' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 == "SIN EXISTENCIAS") {
                  estatus = "<span title='Ver detalles' onclick='infsiexvp(" + valprd + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td>" + estatus + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listproducfinal").html(html);
            'use strict';
          });
        }
      }
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SURTIDO


function infsurti(id_valeprodu) {
  //alert("entro");
  //alert(id_valeprodu);
  document.getElementById('idsurt').value = id_valeprodu;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_valeprodu) {
        if (document.getElementById('infvpestatus').value == "SURTIDO") {
          //alert("entro");
          document.getElementById('descsurt').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsur').innerHTML = obj.data[C].salida;
          document.getElementById('opstsur').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurt').value = obj.data[C].salida;
          document.getElementById('obdepinf').value = obj.data[C].observa_dep; //oculta la edición

          document.getElementById('opesurt1').style.display = "none";
        } else {
          //alert("entro");
          document.getElementById('descsurt').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsur').innerHTML = obj.data[C].salida;
          document.getElementById('opstsur').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurt').value = obj.data[C].salida;
          document.getElementById('obdepinf').value = obj.data[C].observa_dep; //muestra la edición

          document.getElementById('opesurt1').style.display = "";
        }
      }
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SURTIDO ARTICUO FINAL


function infsurtifin(id_valeprodu) {
  //alert("entro");
  //alert(id_valeprodu);
  document.getElementById('idsurtfin').value = id_valeprodu;
  var estatus = document.getElementById('infvpestatus').value;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_valeprodu) {
        if (document.getElementById('infvpestatus').value == "SURTIDO") {
          //alert("entro");
          document.getElementById('descsurtfin').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsurfn').innerHTML = obj.data[C].entrada;
          document.getElementById('opstsurfn').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurtfin').value = obj.data[C].entrada;
          document.getElementById('obdepinfin').value = obj.data[C].observa_dep; //oculta la edición

          document.getElementById('opesurt1').style.display = "none";
        } else {
          //alert("entro");
          document.getElementById('descsurtfin').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsurfn').innerHTML = obj.data[C].entrada;
          document.getElementById('opstsurfn').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurtfin').value = obj.data[C].entrada;
          document.getElementById('obdepinfin').value = obj.data[C].observa_dep; //muestra la edición

          document.getElementById('opesurt1').style.display = "";
        }
      }
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SURTIDO ARTICUO FINAL


function infsiexvp(id_valeprodu) {
  //alert("entro");
  //alert(id_valeprodu);
  document.getElementById('idsinexvp').value = id_valeprodu;
  var estatus = document.getElementById('infvpestatus').value;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_valeprodu) {
        if (document.getElementById('infvpestatus').value == "SURTIDO") {
          //alert("entro");
          document.getElementById('descsinvp').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsinvp').innerHTML = obj.data[C].salida;
          document.getElementById('obdepsinvp').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsinvp').value = obj.data[C].salida;
          document.getElementById('obdepsinvp').value = obj.data[C].observa_dep; //oculta la edición

          document.getElementById('opesurt1sn').style.display = "none";
        } else {
          //alert("entro");
          document.getElementById('descsinvp').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].descripcion_1;
          document.getElementById('cartsinvp').innerHTML = obj.data[C].salida;
          document.getElementById('obdepsinvp').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsinvp').value = obj.data[C].salida;
          document.getElementById('obdepsinvp').value = obj.data[C].observa_dep; //muestra la edición

          document.getElementById('opesurt1sn').style.display = "";
        }
      }
    }
  });
} //ABRE EDICION DE MODAL SURTIDO


function openedithsurt() {
  document.getElementById('editarsur').style.display = "";
  document.getElementById('infsur').style.display = "none";
  document.getElementById('opesurt1').style.display = "none";
  document.getElementById('clossurt1').style.display = "";
} //ABRE EDICION DE MODAL SURTIDO PRODUCTO FINAL


function openedithsurtfin() {
  document.getElementById('editarsurfn').style.display = "";
  document.getElementById('infsurfn').style.display = "none";
  document.getElementById('opesurt1fn').style.display = "none";
  document.getElementById('clossurt1fn').style.display = "";
} //CIERRA EDICION DE MODAL SURTIDO


function closedithsurt() {
  document.getElementById('editarsur').style.display = "none";
  document.getElementById('infsur').style.display = "";
  document.getElementById('opesurt1').style.display = "";
  document.getElementById('clossurt1').style.display = "none";
} //CIERRA EDICION DE MODAL SURTIDO PRODUCTO FINAL


function closedithsurtfin() {
  document.getElementById('editarsurfn').style.display = "none";
  document.getElementById('infsurfn').style.display = "";
  document.getElementById('opesurt1fn').style.display = "";
  document.getElementById('clossurt1fn').style.display = "none";
} //ABRE EDICION DE MODAL SIN EXISTENCIA


function openedithsnex() {
  document.getElementById('editarsinvp').style.display = "";
  document.getElementById('infsursn').style.display = "none";
  document.getElementById('opesurt1sn').style.display = "none";
  document.getElementById('clossurt1sn').style.display = "";
} //CIERRA EDICION DE MODAL SIN EXISTENCIA


function closedithsnex() {
  document.getElementById('editarsinvp').style.display = "none";
  document.getElementById('infsursn').style.display = "";
  document.getElementById('opesurt1sn').style.display = "";
  document.getElementById('clossurt1sn').style.display = "none";
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN


function editarextalta() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithext').style.display = "";
  document.getElementById('openedithext').style.display = "none";
  document.getElementById('saveedithext').style.display = "";
  document.getElementById('cdnewvpedith').disabled = false;
  document.getElementById('vpednewtcantid').disabled = false;
  document.getElementById('posicionextnew').disabled = false;
  document.getElementById('vpobsaddnew').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN


function closeditextalta() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithext').style.display = "none";
  document.getElementById('openedithext').style.display = "";
  document.getElementById('saveedithext').style.display = "none";
  document.getElementById('cdnewvpedith').disabled = true;
  document.getElementById('vpednewtcantid').disabled = true;
  document.getElementById('posicionextnew').disabled = true;
  document.getElementById('vpobsaddnew').disabled = true;
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO ALTA TRASPASO 01052022


function saveedithnewvp() {
  //alert("entra guardar cambios valeproducción");
  var id_kax = document.getElementById('id_exedith').value;
  var codigo_1 = document.getElementById('cdnewvpedith').value;
  var descripcion_1 = document.getElementById('vpnewedithdes').value;
  var salida = document.getElementById('vpednewtcantid').value;
  var tipo_ref = document.getElementById('posicionextnew').value;
  var observa = document.getElementById('vpobsaddnew').value;

  if (tipo_ref == 'EXTENDIDO') {
    var _datos = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextnewlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextnewlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvp();
          closeditextalta();
          $('#modal-edithvpextendido').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {
          document.getElementById('edthdmminf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthdmminf').style.display = 'none';
          }, 1000); //alert(respuesta);
          //alert("datos repetidos");
        } else {
          document.getElementById('erraetiqnew').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqnew').style.display = 'none';
          }, 2000);
          alert(respuesta);
        }
      });
    }
  }

  if (tipo_ref == 'ETIQUETAS') {
    var _datos2 = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextnewlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextnewlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos2
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvp();
          closeditextalta();
          $('#modal-edithvpextendido').modal('hide'); //cierra el modal
          // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {
          document.getElementById('edthdmminf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthdmminf').style.display = 'none';
          }, 1000); //alert(respuesta);
          //alert("datos repetidos");
        } else {
          document.getElementById('erraetiqnew').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqnew').style.display = 'none';
          }, 2000);
          alert(respuesta);
        }
      });
    }
  }

  if (tipo_ref == 'PRODUCTO_TERMINADO') {
    var _datos3 = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateexten'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextnewlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextnewlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos3
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvp();
          closeditextalta();
          $('#modal-edithvpextendido').modal('hide'); //cierra el modal
          // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {
          document.getElementById('edthdmminf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthdmminf').style.display = 'none';
          }, 1000); //alert(respuesta);
          //alert("datos repetidos");
        } else {
          document.getElementById('erraetiqnew').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqnew').style.display = 'none';
          }, 2000); //alert(respuesta);
        }
      });
    }
  }
} //LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN ALTA DE PRODUCCIÓN


function deletenewart(id_delete) {
  //alert(id_delete);
  document.getElementById('id_exedith').value = id_delete;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_delete) {
        //alert("entro");
        document.getElementById('deartvpnew').value = obj.data[C].codigo_1;
      }
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION


function savdelevpart() {
  var id_kardex = document.getElementById('id_exedith').value;
  var datos = 'id_kardex=' + id_kardex + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updatedvp();
      $('#modal-delearvpnew').modal('hide'); //cierra el modal
      // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
    } else {
      document.getElementById('delerarvpnew').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvpnew').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
} //LLAMA EL FOLIO DE VALE DE PRODUCCIÓN


function delevpro() {
  $("#example tr").on('click', function () {
    var id_vale = "";
    id_vale += $(this).find('td:eq(1)').html(); //Toma el id de la persona 

    document.getElementById('devaproduc').value = id_vale; //alert(id_vale)
  });
} //GUARDAR LA ELIMINACION DE VALE DE PRODUCCIÓN


function savedeprodu() {
  //alert("entro guardar eliminar");
  var folio = document.getElementById('devaproduc').value;
  var datos = 'folio=' + folio + '&opcion=deletevale'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'vale_produccion.php';", 1500);
    } else {
      document.getElementById('delerrvprv').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrvprv').style.display = 'none';
      }, 2000);
    }
  });
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN DETALLES DE VALE DE PRODUCCIÓN


function editarvpdett() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithextdetalle').style.display = "";
  document.getElementById('openedithextdetalle').style.display = "none";
  document.getElementById('saveedithextdett').style.display = "";
  document.getElementById('cdedttvpedith').disabled = false;
  document.getElementById('vpeddettcantid').disabled = false;
  document.getElementById('posicionextdell').disabled = false;
  document.getElementById('vpobsadddetll').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN DETALLES DE VALE DE PRODUCCIÓN


function closedithvpdett() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithextdetalle').style.display = "none";
  document.getElementById('openedithextdetalle').style.display = "";
  document.getElementById('saveedithextdett').style.display = "none";
  document.getElementById('cdedttvpedith').disabled = true;
  document.getElementById('vpeddettcantid').disabled = true;
  document.getElementById('posicionextdell').disabled = true;
  document.getElementById('vpobsadddetll').disabled = true;
} //cambio de descripcion articulo indivual detalles de vale de producción


function edithextdettvp() {
  //alert("eentraarticulo")
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('cdedttvpedith').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vpdettedithdes").val(o[1]);
        $("#vpedthdepardell").val(o[2]);
      }
    }
  });
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO ALTA TRASPASO 01052022


function saveedithdettvp() {
  //alert("entra guardar cambios valeproducción");
  var id_kax = document.getElementById('id_exedithdett').value;
  var codigo_1 = document.getElementById('cdedttvpedith').value;
  var descripcion_1 = document.getElementById('vpdettedithdes').value;
  var salida = document.getElementById('vpeddettcantid').value;
  var tipo_ref = document.getElementById('posicionextdell').value;
  var observa = document.getElementById('vpobsadddetll').value;

  if (tipo_ref == 'EXTENDIDO') {
    var _datos4 = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextdettlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextdettlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos4
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvpdett();
          closedithvpdett();
          $('#modal-edithdetvp').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {} else {
          document.getElementById('erraetiqdett').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqdett').style.display = 'none';
          }, 2000);
          alert(respuesta);
        }
      });
    }
  }

  if (tipo_ref == 'ETIQUETAS') {
    var _datos5 = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextdettlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextdettlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos5
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvpdett();
          closedithvpdett();
          $('#modal-edithdetvp').modal('hide'); //cierra el modal
          // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {//alert(respuesta);
          //alert("datos repetidos");
        } else {
          document.getElementById('erraetiqdett').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqdett').style.display = 'none';
          }, 2000);
          alert(respuesta);
        }
      });
    }
  }

  if (tipo_ref == 'PRODUCTO_TERMINADO') {
    var _datos6 = 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateexten'; //alert(datos);


    if (codigo_1 == '' || salida == '' || tipo_ref == '') {
      document.getElementById('edithextdettlle').style.display = '';
      setTimeout(function () {
        document.getElementById('edithextdettlle').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos6
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se actualizo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          updatedvpdett();
          closedithvpdett();
          $('#modal-edithdetvp').modal('hide'); //cierra el modal
          // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else if (respuesta == 2) {//alert(respuesta);
          //alert("datos repetidos");
        } else {
          document.getElementById('erraetiqdett').style.display = '';
          setTimeout(function () {
            document.getElementById('erraetiqdett').style.display = 'none';
          }, 2000); //alert(respuesta);
        }
      });
    }
  }
} //ABRIR EDITAR ARTICULO EN DETALLES DE PRODUCCIÓN


function editarinsvpdett(valprd) {
  //alert(valprd);
  document.getElementById('id_exedithdett').value = valprd;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == valprd) {
        //alert("entro");
        document.getElementById('cdedttvpedith').value = obj.data[C].codigo_1;
        document.getElementById('vpeddettcantid').value = obj.data[C].salida;
        document.getElementById('vpobsadddetll').value = obj.data[C].observa;
        document.getElementById('posicionextdell').value = obj.data[C].tipo_ref;
      }
    }
  }); //informacion del articulos

  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('cdedttvpedith').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vpdettedithdes").val(o[1]);
        $("#vpedthdepardell").val(o[2]);
      }
    }
  });
} //LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN DETALLES DE PRODUCCIÓN


function deletedettart(id_delete) {
  //alert(id_delete);
  document.getElementById('del_artvpdetts').value = id_delete;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_delete) {
        //alert("entro");
        document.getElementById('deartvpdett').value = obj.data[C].codigo_1;
      }
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN DETALLES DE PRODUCCION


function savdelevpartdet() {
  var id_kardex = document.getElementById('del_artvpdetts').value;
  var datos = 'id_kardex=' + id_kardex + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updatedvpdett();
      $('#modal-delearvpdett').modal('hide'); //cierra el modal
      // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
    } else {
      document.getElementById('delerarvpdett').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvpdett').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
} //FUNCION PARA EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function editvaleproinf() {
  //alert("EDITAR VALE");
  $("#infvpdate").removeAttr("readonly");
  $("#infvpdatesurt").removeAttr("readonly");
  document.getElementById('saveinfvp').style.display = "";
  document.getElementById('infvptipo').disabled = false;
  document.getElementById('infvpdepat').disabled = false;
  document.getElementById('infvpsolicita').disabled = false;
  document.getElementById('infvpcaracter').disabled = false;
  $("#infvprecibio").removeAttr("readonly");
  $("#infvppedidos").removeAttr("readonly");
  $("#infvpformula").removeAttr("readonly");
  $("#infvpautoriza").removeAttr("readonly");
  $("#infvpsutio").removeAttr("readonly");
  document.getElementById('infvpestatus').disabled = false;
  document.getElementById('vpaddartinf').style.display = "";
  document.getElementById('closedvp').style.display = "";
  document.getElementById('openedivpinf').style.display = "none";
  $("#infvpdaterecibio").removeAttr("readonly");
} //FUNCION PARA CERRAR VALE DE OFICINA EN VISTA DE INFORMACION


function closevaleproinf() {
  //alert("EDITAR VALE");
  $("#infvpdate").attr("readonly", "readonly");
  $("#infvpdatesurt").attr("readonly", "readonly");
  document.getElementById('saveinfvp').style.display = "none";
  document.getElementById('infvptipo').disabled = true;
  document.getElementById('infvpdepat').disabled = true;
  document.getElementById('infvpsolicita').disabled = true;
  document.getElementById('infvpcaracter').disabled = true;
  $("#infvprecibio").attr("readonly", "readonly");
  $("#infvppedidos").attr("readonly", "readonly");
  $("#infvpformula").attr("readonly", "readonly");
  $("#infvpautoriza").attr("readonly", "readonly");
  $("#infvpsutio").attr("readonly", "readonly");
  document.getElementById('infvpestatus').disabled = true;
  document.getElementById('vpaddartinf').style.display = "none";
  document.getElementById('closedvp').style.display = "none";
  document.getElementById('openedivpinf').style.display = "";
  $("#infvpdaterecibio").attr("readonly", "readonly");
} //FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DEL VALE DE PRODCCIÓN EN VISTA PREVIA 


function savevpcabe() {
  var refe_1 = document.getElementById('folprod').innerHTML;
  var fecha = document.getElementById('infvpdate').value;
  var refe_3 = document.getElementById('infvptipo').value;
  var refe_2 = document.getElementById('infvpdepat').value;
  var proveedor_cliente = document.getElementById('infvpsolicita').value;
  var caracter_vale = document.getElementById('infvpcaracter').value;
  var ubicacion = document.getElementById('infvppedidos').value;
  var id_person_creacion = document.getElementById('infvpformula').value;
  var id_person_autor = document.getElementById('infvpautoriza').value;
  var id_person_surtio = document.getElementById('infvpsutio').value;
  var fecha_surtido = document.getElementById('infvpdatesurt').value;
  var id_person_final = document.getElementById('infvprecibio').value;
  var fecha_finalizacion = document.getElementById('infvpdaterecibio').value;
  var estado = document.getElementById('infvpestatus').value;
  var datos = 'fecha=' + fecha + '&fecha_finalizacion=' + fecha_finalizacion + '&id_person_final=' + id_person_final + '&fecha_surtido=' + fecha_surtido + '&id_person_surtio=' + id_person_surtio + '&id_person_autor=' + id_person_autor + '&id_person_creacion=' + id_person_creacion + '&ubicacion=' + ubicacion + '&caracter_vale=' + caracter_vale + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&estado=' + estado + '&refe_1=' + refe_1 + '&proveedor_cliente=' + proveedor_cliente + '&opcion=cambio'; //alert(datos);

  if (fecha == '' || refe_3 == '' || refe_2 == '' || proveedor_cliente == '' || caracter_vale == '' || id_person_creacion == '') {
    document.getElementById('edthvpivacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvpivacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closevaleproinf();
      } else if (respuesta == 2) {
        document.getElementById('edthvpexi').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvpexi').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvpierror').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvpierror').style.display = 'none';
        }, 2000); //alert(respuesta);
      }
    });
  }
} //AGEGAR ARTICULO INDIVIDUAL EN AGRGAR ARTICULO


function indivudual() {
  //alert("eentraarticulo")
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('codindiv').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vindescrip").val(o[1]);
        $("#vindepar").val(o[2]);
      }
    }
  });
} //AGEGAR ARTICULO INDIVIDUAL EN AGRGAR ARTICULO


function indivudualinf() {
  //alert("eentraarticulo")
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('codindivinf').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#vindescripinf").val(o[1]);
        $("#vindeparinnf").val(o[2]);
      }
    }
  });
} //GUARDAR EL ARTICLO INDIVIDUAL EN DETALLES DE VALE DE PRODUCCIÓN


function addarinproinfo() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('folprod').innerHTML;
  var fecha = document.getElementById('infvpdate').value;
  var refe_2 = document.getElementById('infvpdepat').value;
  var refe_3 = document.getElementById('infvptipo').value;
  var proveedor_cliente = document.getElementById('infvpsolicita').value;
  var codigo_1 = document.getElementById('codindivinf').value;
  var descripcion_1 = document.getElementById('vindescripinf').value;
  var cantidad_real = document.getElementById('vincantidinf').value;
  var salida = document.getElementById('vincantidinf').value;
  var observa = document.getElementById('vpinfbsertrass').value;
  var ubicacion = document.getElementById('infvppedidos').value;
  var tipo_ref = document.getElementById('psiciontinf').value; //let datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind';

  if (document.getElementById('psiciontinf').value === "EXTENDIDO") {
    var _datos7 = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind'; //alert(datos);


    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '') {
      document.getElementById('edthinfvcp').style.display = '';
      setTimeout(function () {
        document.getElementById('edthinfvcp').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos7
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          codigo_1 = "";
          descripcion_1 = "";
          cantidad_real = "";
          tipo_ref = "0";
          observa = "";
          updatedvpdett(); //$("#modal-addartvpinfo").modal('hide');//ocultamos el modal
        } else if (respuesta == 2) {
          document.getElementById('edthvinbli1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinbli1inf').style.display = 'none';
          }, 1000); //alert("datos repetidos");
        } else {
          document.getElementById('edthvinperr1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinperr1inf').style.display = 'none';
          }, 1000);
        }
      });
    }
  }

  if (document.getElementById('psiciontinf').value === "ETIQUETAS") {
    var _datos8 = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind'; //alert(datos);


    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '') {
      document.getElementById('edthinfvcp').style.display = '';
      setTimeout(function () {
        document.getElementById('edthinfvcp').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos8
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          codigo_1 = "0";
          descripcion_1 = "";
          cantidad_real = "";
          tipo_ref = "0";
          observa = "";
          updatedvpdett(); // $("#modal-addartvpinfo").modal('hide');//ocultamos el modal
        } else if (respuesta == 2) {
          document.getElementById('edthvinbli1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinbli1inf').style.display = 'none';
          }, 1000); //alert("datos repetidos");
        } else {
          document.getElementById('edthvinperr1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinperr1inf').style.display = 'none';
          }, 1000);
        }
      });
    }
  }

  if (document.getElementById('psiciontinf').value === "PRODUCTO_TERMINADO") {
    var _datos9 = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=regiarindfinal'; //alert(datos);


    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '') {
      document.getElementById('edthinfvcp').style.display = '';
      setTimeout(function () {
        document.getElementById('edthinfvcp').style.display = 'none';
      }, 2000);
      return;
    } else {
      $.ajax({
        type: "POST",
        url: "../controller/php/insertvapro.php",
        data: _datos9
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          codigo_1 = "";
          descripcion_1 = "";
          cantidad_real = "";
          tipo_ref = "0";
          observa = "";
          updatedvpdett(); //$("#modal-addartvpinfo").modal('hide');//ocultamos el modal
        } else if (respuesta == 2) {
          document.getElementById('edthvinbli1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinbli1inf').style.display = 'none';
          }, 1000); //alert("datos repetidos");
        } else {
          document.getElementById('edthvinperr1inf').style.display = '';
          setTimeout(function () {
            document.getElementById('edthvinperr1inf').style.display = 'none';
          }, 1000);
        }
      });
    }
  }
} //FUNCIÓN DE AUTORIZAR MEMO 


function autorizavp() {
  //alert("entra memo");
  var status = 'AUTORIZADO';
  var folio = document.getElementById('folprod').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=autorizarvp'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'No hay folio ingresar',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se AUTORIZO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'vale_produccion.php';", 1500);
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'ya esta duplicado',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          text: 'Error contactar a soporte tecnico o levantar un ticket',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIÓN DE SURTIR


function surtidovp() {
  //alert("entra memo");
  var status = 'SURTIDO';
  var folio = document.getElementById('folprod').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=surtirvp'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'No hay folio ingresar',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se SURTIO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'vale_produccion.php';", 1500);
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'ya esta duplicado',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          text: 'Error contactar a soporte tecnico o levantar un ticket',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIÓN DE FINALIZAR


function finalizarvp() {
  //alert("entra memo");
  var status = 'FINALIZADO';
  var folio = document.getElementById('folprod').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=finalvp'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'No hay folio ingresar',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvapro.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se FINALIZO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'vale_produccion.php';", 1500);
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'ya esta duplicado',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'error',
          text: 'Error contactar a soporte tecnico o levantar un ticket',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIONES DE LIBERAR VALE DE PRODUCCIÓN


function liberarm() {
  //alert("memos"); 
  var foliovp = document.getElementById('folprod').innerHTML;
  var datos = 'foliovp=' + foliovp + '&opcion=liberarvp'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE LIBERO FORMA CORRECTA',
        showConfirmButton: false,
        timer: 2500
      });
      setTimeout("location.href = 'vale_produccion.php';", 2500);
    } else {
      Swal.fire({
        type: 'error',
        text: 'Error contactar a soporte tecnico o levantar un ticket',
        showConfirmButton: false,
        timer: 2500
      });
    }
  });
} //AGEGAR ARTICULO INDIVIDUAL EN AGRGAR ARTICULO


function indivsurtinf() {
  //alert("eentraarticulo")
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('codisurtvp').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#descripsurvp").val(o[1]);
      }
    }
  });
} //AGEGAR ARTICULO INDIVIDUAL EN AGRGAR ARTICULO PRODUCTO TEMINADO


function indivsurtfin() {
  //alert("eentraarticulo")
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == document.getElementById('codisurvpfin').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#dessurvpfn").val(o[1]);
      }
    }
  });
} //FUNCION QUE MUESTRA LA INFORMACIÓN DEL ARTICULO A ASURTIR 


function surtirvpf(id_kardex) {
  //alert(id_kardex);
  document.getElementById('id_surtvpif').value = id_kardex;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_kardex) {
        //alert("entro");
        document.getElementById('codisurtvp').value = obj.data[C].codigo_1;
        document.getElementById('surtavprinf').value = obj.data[C].salida;
        document.getElementById('descripsurvp').value = obj.data[C].descripcion_1;
      }
    }
  });
} //FUNCION QUE MUESTRA LA INFORMACIÓN DEL ARTICULO A ASURTIR PRODUCTO TERMINADO


function surtirvpfin(id_kardex) {
  //alert(id_kardex);
  document.getElementById('id_surtvpfin').value = id_kardex;
  $.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_kardex) {
        //alert("entro");
        document.getElementById('codisurvpfin').value = obj.data[C].codigo_1;
        document.getElementById('surtvpfn').value = obj.data[C].entrada;
        document.getElementById('dessurvpfn').value = obj.data[C].descripcion_1;
        document.getElementById('surbservpfn').value = obj.data[C].observa;
      }
    }
  });
} //FUNCION DE EDITAR SURTIR


function edithsurvpif() {
  //alert("edit articulo infovale");
  document.getElementById('codisurtvp').disabled = false;
  document.getElementById('surtavprinf').disabled = false;
  document.getElementById('closeditvprinf').style.display = "";
  document.getElementById('surtirvprf').style.display = "none";
} //FUNCION DE EDITAR SURTIR PRODUCTO TERMINADO


function edithsurvpfin() {
  //alert("edit articulo infovale");
  document.getElementById('codisurvpfin').disabled = false;
  document.getElementById('surtvpfn').disabled = false;
  document.getElementById('closeditvpfin').style.display = "";
  document.getElementById('surtirvpfin').style.display = "none";
} //FUNCION DE CERRAR EDITAR SURTIR


function closedisurvpif() {
  //alert("edit articulo infovale");
  document.getElementById('codisurtvp').disabled = true;
  document.getElementById('surtavprinf').disabled = true;
  document.getElementById('closeditvprinf').style.display = "none";
  document.getElementById('surtirvprf').style.display = "";
} //FUNCION DE CERRAR EDITAR SURTIR PRODUCTO TERMINADO


function closesurvpfn() {
  //alert("edit articulo infovale");
  document.getElementById('codisurtvp').disabled = false;
  document.getElementById('surtavprinf').disabled = false;
  document.getElementById('closeditvprinf').style.display = "";
  document.getElementById('surtirvprf').style.display = "none";
} //FUNCION PARA MARCAR SURTIR


function acsurtirvpf() {
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvpif').value;
  var refe_1 = document.getElementById('folprod').innerHTML;
  var codigo_1 = document.getElementById('codisurtvp').value;
  var cantidad = document.getElementById('surtavprinf').value;
  var descripcion = document.getElementById('descripsurvp').value;
  var observa_dep = document.getElementById('surbserevp').value;
  var datos = 'id_kax=' + id_kax + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&cantidad=' + cantidad + '&descripcion=' + descripcion + '&opcion=surtir'; //alert(datos)

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtirvprod').modal('hide');
      updatedvpdett();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION PARA MARCAR SIN EXISTENCIAS 


function sinexisten() {
  //alert("sinexisten");
  var id_kax = document.getElementById('id_surtvpif').value;
  var refe_1 = document.getElementById('folprod').innerHTML;
  var codigo_1 = document.getElementById('codisurtvp').value;
  var observa_dep = document.getElementById('surbserevp').value;
  var datos = 'id_kax=' + id_kax + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=sinexistencia'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtirvprod').modal('hide');
      updatedvpdett();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  });
} //FUNCION PARA MARCAR SURTIR pendiente 29062022


function acsurtirvpfin() {
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvpfin').value;
  var refe_1 = document.getElementById('folprod').innerHTML;
  var codigo_1 = document.getElementById('codisurvpfin').value;
  var cantidad = document.getElementById('surtvpfn').value;
  var descripcion = document.getElementById('dessurvpfn').value;
  var observa_dep = document.getElementById('surbservpfn').value;
  var datos = 'id_kax=' + id_kax + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&cantidad=' + cantidad + '&descripcion=' + descripcion + '&opcion=surtirfin'; //alert(datos)

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtprterm').modal('hide');
      updatedvpdett();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION PARA GUARDAR EDITAR SURTIR


function savesurtvp() {
  //alert("entro vales");
  var id_kax = document.getElementById('idsurt').value;
  var refe_1 = document.getElementById('folprod').innerHTML;
  var cantidad = document.getElementById('cnsurt').value;
  var observa_dep = document.getElementById('obdepinf').value;
  var descrip = document.getElementById('descsurt').innerHTML; //alert("entro vales2");

  var datos = 'id_kax=' + id_kax + '&descrip=' + descrip + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&opcion=edthsurtir'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtido').modal('hide');
      updatedvpdett();
      closedithsurt();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION PARA GUARDAR EDITAR SURTIR PRODUCTO FINAL


function savesurtvpfin() {
  //alert("entro vales");
  var id_kax = document.getElementById('idsurtfin').value;
  var refe_1 = document.getElementById('folprod').innerHTML;
  var cantidad = document.getElementById('cnsurtfin').value;
  var observa_dep = document.getElementById('obdepinfin').value;
  var descrip = document.getElementById('descsurtfin').innerHTML; //alert("entro vales2");

  var datos = 'id_kax=' + id_kax + '&descrip=' + descrip + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&opcion=edthsurtirfin'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvapro.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtidofin').modal('hide');
      updatedvpdett();
      closedithsurtfin();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
}

function histvalepro() {
  var folio = document.getElementById('folprod').innerHTML; //alert(folio);

  $.ajax({
    url: '../controller/php/historia.php',
    type: 'POST'
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0; //alert("folio");

    html = '<div class="table-wrapper"><table style="width:100%" id="hisvale" name="hisvale" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>Usuario</th><th><i></i>Acción</th><th><i></i>Registro</th><th><i></i>fecha</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      x++;

      if (obj.data[U].registro == "FOLIO:" + folio) {
        x++;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_usu + "</td><td>" + obj.data[U].proceso + "</td><td>" + obj.data[U].registro + "</td><td>" + obj.data[U].fecha + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#tabhisto").html(html);
  });
}
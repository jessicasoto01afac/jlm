"use strict";

//MUESTRA EL DISEÑO DE NUEVO REPORTE CLIENTE
function openrepclient() {
  $(document).ready(function () {
    'use strict';

    $('#wizard7').steps({
      headerTag: 'h3',
      bodyTag: 'section',
      autoFocus: true,
      titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
      cssClass: 'wizard wizard-style-3',
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
        //traspaso de texto a divs
        document.getElementById('repcliente').innerHTML = $('#clientenote').summernote('code'); //cliente

        document.getElementById('repjlm').innerHTML = $('#jlmnote').summernote('code'); //JLM

        document.getElementById('repseguimiento').innerHTML = $('#seguimientonote').summernote('code'); //SEGUIMIENTO

        document.getElementById('repconclu').innerHTML = $('#conclicionnote').summernote('code'); //SEGUIMIENTO
        //Datos para inserttar en al atabla de reclamoclient

        var rep_cliente = document.getElementById('repcliente').innerText;
        var folio = document.getElementById('folioreclie').value; //FOLIO    

        var fecha_recl = document.getElementById('fecharepclie').value; //FECHA

        var tipo_reporte = document.getElementById('tiporeclit').value; //TIPO DE REPORTE

        var tipo_incidencia = document.getElementById('tipoincclit').value; //TIPO DE INCIDENCIA

        var remision = document.getElementById('remisreclam').value; //REMISION

        var factura = document.getElementById('factreclam').value; //FACTURA

        var deprechaclie = document.getElementById('deprechaclie').value; //CODIGO CLIENTE

        var dep_responsa = document.getElementById('acrediclien').value;
        var code_cliente = $('#clientenote').summernote('code'); //CODIGO CLIENTE (tomar el codigo para la base de datos)

        var rep_jlm = document.getElementById('repjlm').innerText; //REPORTE JLM (Tomamos el texto para la base de datos )

        var code_jlm = $('#jlmnote').summernote('code'); //CODIGO JLM (tomar el codigo para la base de datos)

        var seguimiento = document.getElementById('repseguimiento').innerText; //REPORTE seguimiento (Tomamos el texto para la base de datos )

        var code_seguimiento = $('#seguimientonote').summernote('code'); //CODIGO seguimiento (tomar el codigo para la base de datos)

        var conclusion = document.getElementById('repconclu').innerText; //REPORTE conclusion (Tomamos el texto para la base de datos )

        var code_conclucion = $('#conclicionnote').summernote('code'); //CODIGO conclusion (tomar el codigo para la base de datos)
        //multiselect de pedido-----

        var tPrfil = '';
        var selectObject = document.getElementById("pedidorec");

        for (var i = 0; i < selectObject.options.length; i++) {
          if (selectObject.options[i].selected == true) {
            tPrfil += ',' + selectObject.options[i].value;
          }
        }

        var pedido2 = tPrfil.substr(1); //--------------------------

        var datos = 'folio=' + folio + '&fecha_recl=' + fecha_recl + '&tipo_reporte=' + tipo_reporte + '&tipo_incidencia=' + tipo_incidencia + '&remision=' + remision + '&factura=' + factura + '&deprechaclie=' + deprechaclie + '&dep_responsa=' + dep_responsa + '&rep_cliente=' + rep_cliente + '&code_cliente=' + code_cliente + '&rep_jlm=' + rep_jlm + '&code_jlm=' + code_jlm + '&seguimiento=' + seguimiento + '&code_seguimiento=' + code_seguimiento + '&conclusion=' + conclusion + '&code_conclucion=' + code_conclucion + '&pedido2=' + pedido2 + '&opcion=savereport'; //alert(datos);

        if (folio == '' || fecha_recl == '' || code_cliente == '' || factura == '' || remision == '' || rep_cliente == '') {
          Swal.fire({
            type: 'info',
            text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
            showConfirmButton: false,
            timer: 1500
          });
          return;
        } else {
          $.ajax({
            type: "POST",
            url: "../controller/php/insertreclamo.php",
            data: datos
          }).done(function (respuesta) {
            if (respuesta == 0) {
              Swal.fire({
                type: 'success',
                text: 'Se agrega de fora correcta',
                showConfirmButton: false,
                timer: 1500
              });
              setTimeout("location.href = 'rec_rech_clientes.php';", 1500);
            } else if (respuesta == 2) {
              Swal.fire({
                type: 'warning',
                text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
                showConfirmButton: false,
                timer: 1500
              }); //alert("datos repetidos");
            } else {
              Swal.fire({
                type: 'danger',
                text: 'No se puedo guardar coontactar a soporte tecnico o levantar un ticke',
                showConfirmButton: false,
                timer: 1500
              }); //alert(respuesta);
            }
          });
        }
      }
    });
  });
  $(document).ready(function () {
    $('#busccodimem').load('./select/buscarme.php');
    $('#busccodigomem2').load('./select/buscarme2.php');
    $('#buscpedido').load('./select/buspedirec.php');
  });
} //ABRE EL FORMULARIO DE CLIENTES


function openreclientes() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#recliente2').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE VALE DE PRODUCCIÓN',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      },
      download: 'open',
      header: true,
      title: '',
      customize: function customize(doc) {
        doc.defaultStyle.fontSize = 12;
        doc.styles.tableHeader.fontSize = 12;

        doc['footer'] = function (page, pages) {
          return {
            columns: [datetime, {
              alignment: 'right',
              text: [{
                text: page.toString(),
                italics: false
              }, ' de ', {
                text: pages.toString(),
                italics: false
              }]
            }],
            margin: [25, 0]
          };
        };
      }
    }, {
      extend: 'excel',
      text: 'Generar Excel',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }],
    "language": {
      buttons: {
        copyTitle: 'Registros copiados',
        copySuccess: {
          _: '%d registros copiados',
          1: '1 registro copiado'
        }
      },
      "searchPlaceholder": "Buscar datos...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/infrecl_clientes.php"
  });
} //FUNCION PARA AGREGAR UN NUEVO FOLIO


function foliovp() {
  //alert("entra folios");
  var tipo = "RECLAMO_CLIENTE";
  var datos = 'tipo=' + tipo + '&opcion=gefolio'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertreclamo.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      setTimeout("location.href = 'new_reclacliente.php';", 1500); //alert(respuesta);
    } else if (respuesta == 2) {} else {
      Swal.fire({
        type: 'danger',
        text: 'Contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
} //FUNCIONES PARA GUARDAR ARTICULOS DE REPORTE DE CLIENTE


function addartrepclt() {
  //alert("entro reclamo");
  //Datos para inserttar en al atabla de reclamoclient
  var folio = document.getElementById('folioreclie').value; //FOLIO    

  var tipo_incidencia = document.getElementById('tipoincclit').value;
  var tipo_reporte = document.getElementById('tiporeclit').value;
  var cantidad = document.getElementById('cantidadrecl').value;
  var id_articulo = document.getElementById('mcodigotr').value;
  var observ_recl = document.getElementById('pedobservo').value; //datos para validad agregar

  var fecha_recl = document.getElementById('fecharepclie').value;
  var remision = document.getElementById('remisreclam').value;
  var factura = document.getElementById('factreclam').value;
  var cliente = document.getElementById('deprechaclie').value;
  var datos = 'folio=' + folio + '&tipo_incidencia=' + tipo_incidencia + '&tipo_reporte=' + tipo_reporte + '&cantidad=' + cantidad + '&id_articulo=' + id_articulo + '&observ_recl=' + observ_recl + '&opcion=registrar'; //alert(datos);

  if (folio == '' || fecha_recl == '' || cliente == '' || factura == '' || remision == '') {
    document.getElementById('vaciosrec2').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosrec2').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        var folio2 = document.getElementById('folioreclie').value; //FOLIO    

        document.getElementById('mcodigotr').value = '';
        document.getElementById('cantidadrecl').value = '';
        document.getElementById('pedobservo').value = '';
        document.getElementById('mdecriptr').value = '';
        document.getElementById('vdepart').value = '';
        $.ajax({
          url: '../controller/php/articurep.php',
          type: 'GET',
          data: 'folio=' + folio2
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

          for (U = 0; U < res.length; U++) {
            if (obj.data[U].folio == folio2 && obj.data[U].tipo == 'CLIENTE') {
              x++;
              $id_reclamo = obj.data[U].id_reclamo;
              html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editararclienalt(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-editararclalta'>Editar</a> <a onclick='delartaltpedart(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal'>Eliminar</a>" + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div></div>';
          $("#lisreclaclie").html(html);
          'use strict';

          $('#datareclamo').DataTable({
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
      } else if (respuesta == 2) {
        document.getElementById('dublirec2').style.display = '';
        setTimeout(function () {
          document.getElementById('dublirec2').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('errcla2').style.display = '';
        setTimeout(function () {
          document.getElementById('errcla2').style.display = 'none';
        }, 1000);
      }
    });
  }
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS REPORTE CLIENTE


function editartrecliente() {
  //alert("edit articulo infovalesds");
  document.getElementById('closediarclie').style.display = "";
  document.getElementById('openeditarclie').style.display = "none";
  document.getElementById('guardarreclie').style.display = "";
  document.getElementById('editcaclien').disabled = false;
  document.getElementById('obserclien').disabled = false;
  document.getElementById('codiclieth').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS MEMO ALTA MEMO


function closeditclient() {
  //alert("edit articulo infovalesds");
  document.getElementById('closediarclie').style.display = "none";
  document.getElementById('openeditarclie').style.display = "";
  document.getElementById('guardarreclie').style.display = "none";
  document.getElementById('editcaclien').disabled = true;
  document.getElementById('obserclien').disabled = true;
  document.getElementById('codiclieth').disabled = true;
} //FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE ALTA DE RECLAMO DE CLIENTE


function editararclienalt(idreclamo) {
  //alert("entrta editar alata");
  //alert(idreclamo);
  var folio2 = document.getElementById('folioreclie').value; //FOLIO    

  document.getElementById('openeditarclie').style.display = '';
  document.getElementById('closediarclie').style.display = 'none';
  $.ajax({
    url: '../controller/php/articurep.php',
    type: 'GET',
    data: 'folio=' + folio2
  }).done(function (respuesta) {
    //alert("respuesta");
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_reclamo == idreclamo) {
        //alert();
        document.getElementById('codiclieth').value = obj.data[U].id_articulo;
        document.getElementById('desclientrep').value = obj.data[U].artdescrip;
        document.getElementById('editcaclien').value = obj.data[U].cantidad;
        document.getElementById('editdeplien').value = obj.data[U].artubicac;
        document.getElementById('obserclien').value = obj.data[U].observ_recl;
        document.getElementById('id_artclien').value = obj.data[U].id_reclamo;
      }
    }
  });
} //FUNCIONES PARA GUARDAR ARTICULOS DE REPORTE DE CLIENTE


function updatearticul() {
  //Datos para inserttar en al atabla de reclamoclient
  var folio = document.getElementById('folioreclie').value; //FOLIO    
  //alert(folio);

  $.ajax({
    url: '../controller/php/articurep.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
        x++;
        $id_reclamo = obj.data[U].id_reclamo;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editararclienalt(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-editararclalta'>Editar</a> <a onclick='delartaltpedart(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#lisreclaclie").html(html);
    'use strict';

    $('#datareclamo').DataTable({
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
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS ALTA D REPORTE CLIENTE


function savealtrepclie() {
  //Datos para inserttar en al atabla de reclamoclient
  var folio = document.getElementById('folioreclie').value; //FOLIO    

  var cantidad = document.getElementById('editcaclien').value;
  var id_articulo = document.getElementById('codiclieth').value; //codigo

  var observ_recl = document.getElementById('obserclien').value; //observaciones
  //datos para validad agregar

  var fecha_recl = document.getElementById('fecharepclie').value;
  var remision = document.getElementById('remisreclam').value;
  var factura = document.getElementById('factreclam').value;
  var cliente = document.getElementById('deprechaclie').value;
  var id_reclamo = document.getElementById('id_artclien').value;
  var datos = 'folio=' + folio + '&id_reclamo=' + id_reclamo + '&cantidad=' + cantidad + '&id_articulo=' + id_articulo + '&observ_recl=' + observ_recl + '&opcion=actualizainf'; //alert(datos);

  if (folio == '' || fecha_recl == '' || cliente == '' || factura == '' || remision == '') {
    document.getElementById('edthmmciosal').style.display = '';
    setTimeout(function () {
      document.getElementById('edthmmciosal').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closeditclient2();
        updatearticul(); //llama a la función para actualizar la tabla

        $('#modal-editararclalta').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {
        document.getElementById('edthclieciosal').style.display = '';
        setTimeout(function () {
          document.getElementById('edthclieciosal').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthclieinfr').style.display = '';
        setTimeout(function () {
          document.getElementById('edthclieinfr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS ALTA D REPORTE CLIENTE


function savealtrepclie2() {
  //Datos para inserttar en al atabla de reclamoclient
  var folio = document.getElementById('folioreclie').value; //FOLIO    

  var cantidad = document.getElementById('editcaclien2').value;
  var id_articulo = document.getElementById('codiclieth2').value; //codigo

  var observ_recl = document.getElementById('obserclien2').value; //observaciones
  //datos para validad agregar

  var fecha_recl = document.getElementById('infrepdate').value;
  var remision = document.getElementById('infpedremisi').value;
  var factura = document.getElementById('infpedfac').value;
  var cliente = document.getElementById('infrepxlientes').value;
  var id_reclamo = document.getElementById('id_artclien2').value;
  var datos = 'folio=' + folio + '&id_reclamo=' + id_reclamo + '&cantidad=' + cantidad + '&id_articulo=' + id_articulo + '&observ_recl=' + observ_recl + '&opcion=actualizainf'; //alert(datos);

  if (folio == '' || fecha_recl == '' || cliente == '' || factura == '' || remision == '') {
    document.getElementById('edthmmciosal').style.display = '';
    setTimeout(function () {
      document.getElementById('edthmmciosal').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closeditclient();
        updatearticul2(); //llama a la función para actualizar la tabla

        $('#modal-editararclalta2').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {
        document.getElementById('edthclieciosal').style.display = '';
        setTimeout(function () {
          document.getElementById('edthclieciosal').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthclieinfr').style.display = '';
        setTimeout(function () {
          document.getElementById('edthclieinfr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR ALTA DE MEMO


function delartaltpedart(id_delete) {
  ; //alert(id_delete);

  var folio2 = document.getElementById('folioreclie').value;
  $.ajax({
    url: '../controller/php/articurep.php',
    type: 'GET',
    data: 'folio=' + folio2
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_reclamo == id_delete) {
        document.getElementById('del_artrecli').value = obj.data[U].id_reclamo;
        document.getElementById('deartrepcli').value = obj.data[U].id_articulo + "/" + obj.data[U].artdescrip;
      }
    }
  });
} //FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR ALTA DE MEMO


function delartaltpedart2(id_delete) {
  ; //alert(id_delete);

  var folio2 = document.getElementById('folioreclie').value;
  $.ajax({
    url: '../controller/php/articurep.php',
    type: 'GET',
    data: 'folio=' + folio2
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_reclamo == id_delete) {
        document.getElementById('del_artrecli2').value = obj.data[U].id_reclamo;
        document.getElementById('deartrepcli2').value = obj.data[U].id_articulo + "/" + obj.data[U].artdescrip;
      }
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION


function savdelercliart() {
  var id_reclamo = document.getElementById('del_artrecli').value;
  var folio = document.getElementById('folioreclie').value;
  var datos = 'id_reclamo=' + id_reclamo + '&folio=' + folio + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertreclamo.php",
    data: datos
  }).done(function (respuesta) {
    //alert(respuesta);
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updatearticul(); //llama a la función para actualizar la tabla

      $('#modal-deleteartal').modal('hide'); //cierra el modal
    } else {
      document.getElementById('deartrepclie').style.display = '';
      setTimeout(function () {
        document.getElementById('deartrepclie').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION


function savdelercliart2() {
  var id_reclamo = document.getElementById('del_artrecli2').value;
  var folio = document.getElementById('folioreclie').value;
  var datos = 'id_reclamo=' + id_reclamo + '&folio=' + folio + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertreclamo.php",
    data: datos
  }).done(function (respuesta) {
    //alert(respuesta);
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updatearticul2(); //llama a la función para actualizar la tabla

      $('#modal-deleteartal2').modal('hide'); //cierra el modal
    } else {
      document.getElementById('deartrepclie2').style.display = '';
      setTimeout(function () {
        document.getElementById('deartrepclie2').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
}

function reclamocliente(id_reclaclient) {
  //alert(id_reclaclient);
  $("#detareport").toggle(250); //Muestra contenedor de detalles

  $("#lista").toggle("fast"); //Oculta lista

  document.getElementById('rclietfolio').value = id_reclaclient;
  var liberar = document.getElementById('btnrclitliberar'); //LIBERAR

  var finalizado = document.getElementById('btnrclitfinaliz'); //FINALIZACION

  var editar = document.getElementById('openedipcliinf'); //EDITAR

  var pdfvp = document.getElementById('pdfrpclient'); //PDF

  var folio = id_reclaclient; //FOLIO
  //INFORMACIÓN 

  $.ajax({
    url: '../controller/php/inforeportes.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].folio_recl == id_reclaclient) {
        document.getElementById('folreport').innerHTML = obj.data[D].folio_recl;
        document.getElementById('folioreclie').value = obj.data[D].folio_recl; //folio oculto

        document.getElementById('infrepdate').value = obj.data[D].fecha_recl;
        document.getElementById('infreptipo').value = obj.data[D].tipo_reporte;
        document.getElementById('infrepincid').value = obj.data[D].tipo_incidencia;
        document.getElementById('infvppedidos').value = obj.data[D].pedido;
        document.getElementById('infpedremisi').value = obj.data[D].remision;
        document.getElementById('infpedfac').value = obj.data[D].factura;
        document.getElementById('infrepxlientes').value = obj.data[D].codigo_cliente;
        document.getElementById('infrepacred').value = obj.data[D].dep_responsa;
        document.getElementById('infrepformul').value = obj.data[D].usunom + " " + obj.data[D].usuapell;
        document.getElementById('infrpestatus').value = obj.data[D].estatus_recl; //mejor codigo para html

        $('#clientenote').summernote('code', obj.data[D].code_cliente);
        $('#jlmnote').summernote('code', obj.data[D].code_jlm);
        $('#seguimientonote').summernote('code', obj.data[D].code_seguimiento);
        $('#conclicionnote').summernote('code', obj.data[D].code_conclucion); // To disable

        $('#clientenote').summernote('disable');
        $('#jlmnote').summernote('disable');
        $('#seguimientonote').summernote('disable');
        $('#conclicionnote').summernote('disable'); //PENDIENTE-----------------------------------------------------------------------------------------------

        if (obj.data[D].estatus_recl == 'PENDIENTE') {
          finalizado.style.display = '';
          editar.style.display = '';
          pdfvp.style.display = '';
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editararclienalt2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-editararclalta2'>Editar</a> <a onclick='delartaltpedart2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal2'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          }); //FINALIZADO 19092022 -----------------------------------------------------------------------------------------------------------
        } else if (obj.data[D].estatus_recl == 'FINALIZADO') {
          var _liberar = document.getElementById('btnrclitliberar');

          _liberar.style.display = '';
          editar.style.display = 'none';
          pdfvp.style.display = '';
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-info"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          });
        }
      }
    }
  });
} //FUNCIONES PARA GUARDAR ARTICULOS DE REPORTE DE CLIENTE


function updatearticul2() {
  var liberar = document.getElementById('btnrclitliberar'); //LIBERAR

  var finalizado = document.getElementById('btnrclitfinaliz'); //FINALIZACION

  var editar = document.getElementById('openedipcliinf'); //EDITAR

  var pdfvp = document.getElementById('pdfrpclient'); //PDF

  var folio = document.getElementById('folreport').innerHTML; //FOLIO 
  //INFORMACIÓN 

  $.ajax({
    url: '../controller/php/inforeportes.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].folio_recl == folio) {
        //PENDIENTE-----------------------------------------------------------------------------------------------
        if (obj.data[D].estatus_recl == 'PENDIENTE') {
          finalizado.style.display = '';
          editar.style.display = '';
          pdfvp.style.display = 'none';
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editararclienalt2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-editararclalta2'>Editar</a> <a onclick='delartaltpedart2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal2'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          }); //FINALIZADO 19092022 -----------------------------------------------------------------------------------------------------------
        } else if (obj.data[D].estatus_recl == 'FINALIZADO') {
          var _liberar2 = document.getElementById('btnrclitliberar');

          _liberar2.style.display = '';
          editar.style.display = 'none';
          pdfvp.style.display = '';
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-info"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          });
        }
      }
    }
  });
} //FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE ALTA DE RECLAMO DE CLIENTE


function editararclienalt2(idreclamo) {
  //alert("entrta editar alata");
  //alert(idreclamo);
  var folio2 = document.getElementById('folioreclie').value; //FOLIO    

  document.getElementById('openeditarclie2').style.display = '';
  document.getElementById('closediarclie2').style.display = 'none';
  $.ajax({
    url: '../controller/php/articurep.php',
    type: 'GET',
    data: 'folio=' + folio2
  }).done(function (respuesta) {
    //alert("respuesta");
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_reclamo == idreclamo) {
        //alert();
        document.getElementById('codiclieth2').value = obj.data[U].id_articulo;
        document.getElementById('desclientrep2').value = obj.data[U].artdescrip;
        document.getElementById('editcaclien2').value = obj.data[U].cantidad;
        document.getElementById('editdeplien2').value = obj.data[U].artubicac;
        document.getElementById('obserclien2').value = obj.data[U].observ_recl;
        document.getElementById('id_artclien2').value = obj.data[U].id_reclamo;
      }
    }
  });
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS REPORTE CLIENTE


function editartrecliente2() {
  //alert("edit articulo infovalesds");
  document.getElementById('closediarclie2').style.display = "";
  document.getElementById('openeditarclie2').style.display = "none";
  document.getElementById('guardarreclie2').style.display = "";
  document.getElementById('editcaclien2').disabled = false;
  document.getElementById('obserclien2').disabled = false;
  document.getElementById('codiclieth2').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS MEMO ALTA MEMO


function closeditclient2() {
  //alert("edit articulo infovalesds");
  document.getElementById('closediarclie2').style.display = "none";
  document.getElementById('openeditarclie2').style.display = "";
  document.getElementById('guardarreclie2').style.display = "none";
  document.getElementById('editcaclien2').disabled = true;
  document.getElementById('obserclien2').disabled = true;
  document.getElementById('codiclieth2').disabled = true;
} //cambio de descripcion articulo traspaspaso en alta de memo


function destrasmemalt2() {
  //alert("eentraarticulo")
  var codivo = document.getElementById('codiclieth2').value;
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == codivo) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#desclientrep2").val(o[1]);
        $("#editdeplien2").val(o[2]);
      }
    }
  });
} //cambio de descripcion articulo traspaspaso en alta de memo


function destrasmemalt() {
  //alert("eentraarticulo")
  var codivo = document.getElementById('codiclieth').value;
  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].artcodigo == codivo) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#desclientrep").val(o[1]);
        $("#editdeplien").val(o[2]);
      }
    }
  });
}

function edithrep() {
  // encendidos para actualizar
  $('#clientenote').summernote('enable');
  $('#jlmnote').summernote('enable');
  $('#seguimientonote').summernote('enable');
  $('#conclicionnote').summernote('enable');
  document.getElementById('edithreportclose').style.display = '';
  document.getElementById('edithreport').style.display = 'none';
  document.getElementById('saverepoinf').style.display = '';
}

function closeedithrep() {
  // encendidos para actualizar
  $('#clientenote').summernote('disable');
  $('#jlmnote').summernote('disable');
  $('#seguimientonote').summernote('disable');
  $('#conclicionnote').summernote('disable');
  document.getElementById('edithreportclose').style.display = 'none';
  document.getElementById('edithreport').style.display = '';
  document.getElementById('saverepoinf').style.display = 'none';
} //FUNCION PARA EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function editreportinf() {
  //alert("EDITAR VALE");
  $("#infrepdate").removeAttr("readonly");
  document.getElementById('infreptipo').disabled = false;
  document.getElementById('infrepincid').disabled = false;
  $("#infvppedidos").removeAttr("readonly");
  document.getElementById('infrepacred').disabled = false;
  document.getElementById('infrpestatus').disabled = false;
  $("#infpedremisi").removeAttr("readonly");
  $("#infpedfac").removeAttr("readonly");
  document.getElementById('closedrcliet').style.display = '';
  document.getElementById('openedipcliinf').style.display = 'none';
  document.getElementById('savehadearrep').style.display = '';
  document.getElementById('repaddartinf').style.display = '';
  document.getElementById('infrepxlientes').disabled = false;
}

function closereporinf() {
  //alert("EDITAR VALE");
  $("#infrepdate").attr("readonly", "readonly");
  ;
  document.getElementById('infreptipo').disabled = true;
  document.getElementById('infrepincid').disabled = true;
  $("#infvppedidos").attr("readonly", "readonly");
  ;
  document.getElementById('infrepacred').disabled = false;
  document.getElementById('infrpestatus').disabled = false;
  $("#infpedremisi").attr("readonly", "readonly");
  ;
  $("#infpedfac").attr("readonly", "readonly");
  ;
  document.getElementById('closedrcliet').style.display = 'none';
  document.getElementById('openedipcliinf').style.display = '';
  document.getElementById('savehadearrep').style.display = 'none';
  document.getElementById('repaddartinf').style.display = 'none';
  document.getElementById('infrepxlientes').disabled = true;
}

function saveupdatereport() {
  //alert("pruebas");
  var folio = document.getElementById('folioreclie').value;
  var rep_cliente = document.getElementById('repcliente').innerText;
  var code_cliente = $('#clientenote').summernote('code'); //CODIGO CLIENTE (tomar el codigo para la base de datos)

  var rep_jlm = document.getElementById('repjlm').innerText; //REPORTE JLM (Tomamos el texto para la base de datos )

  var code_jlm = $('#jlmnote').summernote('code'); //CODIGO JLM (tomar el codigo para la base de datos)

  var seguimiento = document.getElementById('repseguimiento').innerText; //REPORTE seguimiento (Tomamos el texto para la base de datos )

  var code_seguimiento = $('#seguimientonote').summernote('code'); //CODIGO seguimiento (tomar el codigo para la base de datos)

  var conclusion = document.getElementById('repconclu').innerText; //REPORTE conclusion (Tomamos el texto para la base de datos )

  var code_conclucion = $('#conclicionnote').summernote('code'); //CODIGO conclusion (tomar el codigo para la base de datos)

  var datos = 'folio=' + folio + '&rep_cliente=' + rep_cliente + '&code_cliente=' + code_cliente + '&rep_jlm=' + rep_jlm + '&code_jlm=' + code_jlm + '&seguimiento=' + seguimiento + '&code_seguimiento=' + code_seguimiento + '&conclusion=' + conclusion + '&code_conclucion=' + code_conclucion + '&opcion=updatesavereport'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'info',
      text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualiza de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closeedithrep();
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
          showConfirmButton: false,
          timer: 1500
        }); //alert(respuesta);
      } else {
        Swal.fire({
          type: 'danger',
          text: 'No se puedo guardar coontactar a soporte tecnico o levantar un ticke',
          showConfirmButton: false,
          timer: 1500
        }); //alert(respuesta);
      }
    });
  }
}

function savehadearrep() {
  var folio = document.getElementById('folioreclie').value; //FOLIO    

  var fecha_recl = document.getElementById('infrepdate').value; //FECHA

  var tipo_reporte = document.getElementById('infreptipo').value; //TIPO DE REPORTE

  var tipo_incidencia = document.getElementById('infrepincid').value; //TIPO DE INCIDENCIA

  var remision = document.getElementById('infpedremisi').value; //REMISION

  var factura = document.getElementById('infpedfac').value; //FACTURA

  var dep_responsa = document.getElementById('infrepacred').value;
  var estatus = document.getElementById('infrpestatus').value; //CODIGO CLIENTE

  var pedido = document.getElementById('infvppedidos').value; //CODIGO CLIENTE

  var datos = 'folio=' + folio + '&fecha_recl=' + fecha_recl + '&tipo_reporte=' + tipo_reporte + '&tipo_incidencia=' + tipo_incidencia + '&remision=' + remision + '&factura=' + factura + '&estatus=' + estatus + '&dep_responsa=' + dep_responsa + '&pedido=' + pedido + '&opcion=svrepheader'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'info',
      text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrega de fora correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closeedithrep();
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'LLENAR LOS CAMPOS OBLIGOTARIOS',
          showConfirmButton: false,
          timer: 1500
        }); //alert(respuesta);
      } else {
        Swal.fire({
          type: 'danger',
          text: 'No se puedo guardar coontactar a soporte tecnico o levantar un ticke',
          showConfirmButton: false,
          timer: 1500
        }); //alert(respuesta);
      }
    });
  }
} //FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DEL VALE DE PRODCCIÓN EN VISTA PREVIA 


function saverepcabe() {
  var folio = document.getElementById('folioreclie').value; //FOLIO

  var fecha_recl = document.getElementById('infrepdate').value; //FECHA

  var tipo_reporte = document.getElementById('infreptipo').value; //TIPO DE REPORTE

  var tipo_incidencia = document.getElementById('infrepincid').value; //TIPO DE INCIDENCIA

  var pedido = document.getElementById('infvppedidos').value; //PEDIDO

  var remision = document.getElementById('infpedremisi').value; //REMISION

  var factura = document.getElementById('infpedfac').value; //FACTURA

  var code_cliente = document.getElementById('infrepxlientes').value; //CLIENTES

  var dep_responsa = document.getElementById('infrepacred').value; //DEPARTAMENTO RESPONSABLE

  var estatus_recl = document.getElementById('infrpestatus').value; //ESTATUS RECLAMO

  var datos = 'folio=' + folio + '&fecha_recl=' + fecha_recl + '&tipo_reporte=' + tipo_reporte + '&tipo_incidencia=' + tipo_incidencia + '&pedido=' + pedido + '&remision=' + remision + '&factura=' + factura + '&code_cliente=' + code_cliente + '&dep_responsa=' + dep_responsa + '&estatus_recl=' + estatus_recl + '&opcion=cambioheader'; //alert(datos);

  if (fecha_recl == '' || tipo_reporte == '' || tipo_incidencia == '' || code_cliente == '' || estatus_recl == '') {
    document.getElementById('edthrepvacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthrepvacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closereporinf();
      } else if (respuesta == 2) {
        document.getElementById('edthrepexi').style.display = '';
        setTimeout(function () {
          document.getElementById('edthrepexi').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthreierror').style.display = '';
        setTimeout(function () {
          document.getElementById('edthreierror').style.display = 'none';
        }, 2000); //alert(respuesta);
      }
    });
  }
} //FUNCIONES PARA ACTUALIZAR LA TABLA DE ARTICULOS EN INFO REPORTE


function updatearticul3() {
  var folio = document.getElementById('folreport').innerHTML; //FOLIO 
  //INFORMACIÓN 

  $.ajax({
    url: '../controller/php/inforeportes.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].folio_recl == folio) {
        //PENDIENTE-----------------------------------------------------------------------------------------------
        if (obj.data[D].estatus_recl == 'PENDIENTE') {
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editararclienalt2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-editararclalta2'>Editar</a> <a onclick='delartaltpedart2(" + $id_reclamo + ");' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal2'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          }); //FINALIZADO 19092022 -----------------------------------------------------------------------------------------------------------
        } else if (obj.data[D].estatus_recl == 'FINALIZADO') {
          $.ajax({
            url: '../controller/php/articurep.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datareclamo" name="datareclamo" class="table display dataTable"><thead class="thead-colored thead-info"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].folio == folio && obj.data[U].tipo == 'CLIENTE') {
                x++;
                $id_reclamo = obj.data[U].id_reclamo;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observ_recl + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div>';
            $("#listarticlien").html(html);
            'use strict';
          });
        }
      }
    }
  });
} //FUNCIONES PARA GUARDAR ARTICULOS DE REPORTE DE CLIENTE EN VISTA


function editaddreport() {
  //alert("entro reclamo");
  //Datos para inserttar en al atabla de reclamoclient
  var folio = document.getElementById('folioreclie').value; //FOLIO  

  var tipo_incidencia = document.getElementById('infrepincid').value;
  var tipo_reporte = document.getElementById('infreptipo').value;
  var id_articulo = document.getElementById('codindivinf').value; //cantida

  var cantidad = document.getElementById('vincantidinf').value;
  var observ_recl = document.getElementById('vpinfbsertrass').value; //datos para validad agregar

  var fecha_recl = document.getElementById('infrepdate').value;
  var remision = document.getElementById('infpedremisi').value;
  var factura = document.getElementById('infpedfac').value;
  var cliente = document.getElementById('infrepxlientes').value;
  var datos = 'folio=' + folio + '&tipo_incidencia=' + tipo_incidencia + '&tipo_reporte=' + tipo_reporte + '&cantidad=' + cantidad + '&id_articulo=' + id_articulo + '&observ_recl=' + observ_recl + '&opcion=registrar'; //alert(datos);

  if (folio == '' || fecha_recl == '' || cliente == '' || factura == '' || remision == '' || id_articulo == '0' || cantidad == '') {
    document.getElementById('addrepinflle').style.display = '';
    setTimeout(function () {
      document.getElementById('addrepinflle').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        document.getElementById('codindivinf').value = '';
        document.getElementById('vincantidinf').value = '';
        document.getElementById('vindescripinf').value = '';
        document.getElementById('vindeparinnf').value = '';
        document.getElementById('vpinfbsertrass').value = '';
        updatearticul3(); //llama a la función para actualizar la tabla
      } else if (respuesta == 2) {
        document.getElementById('addrepinfrep').style.display = '';
        setTimeout(function () {
          document.getElementById('addrepinfrep').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('addrepoinerr').style.display = '';
        setTimeout(function () {
          document.getElementById('addrepoinerr').style.display = 'none';
        }, 1000);
      }
    });
  }
} //FUNCIÓN DE FINALIZAR


function finalizarep() {
  //alert("entra memo");
  var status = 'FINALIZADO';
  var folio = document.getElementById('folioreclie').value; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=finalrep'; //finalped
  //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'Ingresar el folio',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertreclamo.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se FINALIZO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'rec_rech_clientes.php';", 1500);
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
} //FUNCION PARA LLAMAR LA DESCRIPCION Y DEPARTAMENTO EN ADD INDIVIDIAL INFO REPORTE


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
} //FUNCIÓN DE FINALIZAR


function liverarreprt() {
  //alert("memos"); 
  var folio = document.getElementById('folioreclie').value;
  var datos = 'folio=' + folio + '&opcion=liberarrep'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertreclamo.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE LIBERO FORMA CORRECTA',
        showConfirmButton: false,
        timer: 2500
      });
      setTimeout("location.href = 'rec_rech_clientes.php';", 1500);
    } else {
      Swal.fire({
        type: 'error',
        text: 'Error contactar a soporte tecnico o levantar un ticket',
        showConfirmButton: false,
        timer: 2500
      });
    }
  });
} //LLAMA EL FOLIO 


function delerepcl(foliorp) {
  //alert(foliorp);
  document.getElementById('del_reportclien').value = foliorp;
  document.getElementById('delrepclient').value = foliorp;
} //GUARDAR LA ELIMINACION DE VALE DE PRODUCCIÓN


function savedelrec() {
  //alert("entro guardar eliminar");
  var folio = document.getElementById('del_reportclien').value;
  var datos = 'folio=' + folio + '&opcion=deleterpcli'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertreclamo.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'rec_rech_clientes.php';", 1500);
    } else {
      document.getElementById('delerpclierr').style.display = '';
      setTimeout(function () {
        document.getElementById('delerpclierr').style.display = 'none';
      }, 2000);
    }
  });
}

function histvalepro() {
  var folio = document.getElementById('folioreclie').value;
  var folio2 = "FOLIO:" + folio; //alert(folio);
  //Tabla de historial del vale de producción

  $.ajax({
    url: '../controller/php/hisvaleprod.php',
    type: 'POST',
    data: 'folio=' + folio2
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0; //alert("folio");

    html = '<div class="table-responsive"><table style="width:100%" id="hisvalevp" name="hisvalevp" class="table display dataTable no-footer"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>Usuario</th><th><i></i>Acción</th><th><i></i>Registro</th><th><i></i>fecha</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      x++;
      html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_usu + "</td><td>" + obj.data[U].proceso + "</td><td>" + obj.data[U].registro + "</td><td>" + obj.data[U].fecha + "</td></tr>";
    }

    html += '</div></tbody></table></div></div>';
    $("#tabhisto").html(html);
  }); //Historial del vale en productividad

  $.ajax({
    url: '../controller/php/productiv.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0; //alert("folio");

    for (D = 0; D < res.length; D++) {
      document.getElementById('fcreacion').innerHTML = obj.data[D].fecha_creacion1;
      document.getElementById('fautoriz').innerHTML = obj.data[D].fecha_autorizacion1;
      document.getElementById('fsurtido').innerHTML = obj.data[D].fecha_surtido1;
      document.getElementById('ffinaliz').innerHTML = obj.data[D].fecha_finalizacion1; //DIAS

      if (obj.data[D].dias_totales > 0) {
        document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
        document.getElementById('dias2').innerHTML = obj.data[D].dias_asurtdo + " dias Autorización/Surtido";
        document.getElementById('dias3').innerHTML = obj.data[D].dias_totales + " dias trascurridos para finalización ";
      }

      if (obj.data[D].dias_totales == null) {
        document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
        document.getElementById('dias2').innerHTML = obj.data[D].dias_asurtdo + " dias Autorización/Surtido";
        document.getElementById('dias3').innerHTML = "Sin finalizar";
      }

      if (obj.data[D].dias_asurtdo == null) {
        document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
        document.getElementById('dias2').innerHTML = "Sin surtir";
        document.getElementById('dias3').innerHTML = "Sin finalizar";
      }

      if (obj.data[D].dias_autorizacion == null) {
        document.getElementById('dias1').innerHTML = "Sin autorizar";
        document.getElementById('dias2').innerHTML = "Sin surtir";
        document.getElementById('dias3').innerHTML = "Sin finalizar";
      }
    }
  });
}

function pdfvp() {
  var folio = document.getElementById('folreport').innerHTML; //alert(folio);

  url = '../formatos/pdf_reclamo_cliente.php';
  window.open(url + "?data=" + folio, '_black');
}
"use strict";

$(document).ready(function () {
  'use strict';

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
      var refe_1 = document.getElementById('pedfolio').value;
      var fecha = document.getElementById('pedfecha').value;
      var refe_2 = document.getElementById('pedremision').value;
      var refe_3 = document.getElementById('pedidcaracter').value;
      var proveedor_cliente = document.getElementById('pedicliente').value;

      if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || refe_2 == '') {
        document.getElementById('vaciosped').style.display = '';
        setTimeout(function () {
          document.getElementById('vaciosped').style.display = 'none';
        }, 2000);
        return;
      } else {
        Swal.fire({
          type: 'success',
          text: 'Se finaliza de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'listpedido.php';", 1500);
      }
    }
  });
});
$(document).ready(function () {
  $('#busccodimem').load('./select/buscarttras.php');
  $('#busccodigomem2').load('./select/buscarme2.php');
  $('#buscpedido').load('./select/buspedi.php');
});

function openpedidos() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#pedidosdata').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE PEDIDOS',
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
        copyTitle: 'Pedidos copiados',
        copySuccess: {
          _: '%d Pedidos copiados',
          1: '1 Pedidos copiado'
        }
      },
      "searchPlaceholder": "Buscar pedidos...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/pedidoslist.php"
  });
} //FUNCIÓN QUE SIRVE PARA AGREGAR PPEDIDO


function addpedidoind() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('pedfolio').value;
  var fecha = document.getElementById('pedfecha').value;
  var refe_2 = document.getElementById('pedremision').value;
  var refe_3 = document.getElementById('pedidatentio').value;
  var proveedor_cliente = document.getElementById('pedicliente').value;
  var caracter = document.getElementById('pedidcaracter').value;
  var codigo_1 = document.getElementById('mcodigotr').value;
  var salida = document.getElementById('pedcantidad').value;
  var cantidad_real = document.getElementById('pedcantidad').value;
  var observa = document.getElementById('pedbservo').value;
  var descripcion_1 = document.getElementById('adddireccion').value;
  var ubicacion = document.getElementById('addlugar').value; //--------------------------

  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&caracter=' + caracter + '&opcion=registrar'; //alert(datos);

  if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || cantidad_real == '') {
    document.getElementById('vaciosped').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosped').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updatepedid();
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
  }
} //LLAMADO DE DATOS


function updatepedid() {
  //alert("entro el update");
  //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
  document.getElementById('mcodigotr').value = "";
  document.getElementById('mdecriptr').value = "";
  document.getElementById('pedcantidad').value = "";
  document.getElementById('pedbservo').value = ""; //INFORMACION DE LAS TBLAS

  var id_pedid = document.getElementById('pedfolio').value;
  var folio = id_pedid; //alert(folio);

  $.ajax({
    url: '../controller/php/infpedido.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="pedadd" name="pedadd" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == id_pedid) {
        x++;
        var id_pedidd = obj.data[U].id_kax;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsped(" + id_pedidd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithaddpedit'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_pedidd + ");' data-toggle='modal' data-target='#modal-delearpednew'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#listpedidoss").html(html);
    'use strict';

    $('#pedadd').DataTable({
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
} //funcion para traer la informacion del pedido


function infpedido(pruebas) {
  //alert(pruebas);
  $("#pedidosdata tr").on('click', function () {
    var id_vofi = "";
    var id_cli = "";
    id_vofi += $(this).find('td:eq(1)').html(); //Toma el numero de pedido

    id_cli += $(this).find('td:eq(3)').html(); //Toma el cliente
    //alert(id_vofi);

    document.getElementById('idinped').innerHTML = id_vofi;
    document.getElementById('infclinte').value = id_cli;
    $("#dettpedido").toggle(250); //Muestra contenedor 

    $("#listaped").toggle("fast"); //Oculta lista

    var folio = id_vofi;
    $.ajax({
      url: '../controller/php/infpedigrup.php',
      type: 'GET',
      data: 'folio=' + folio
    }).done(function (respuesta) {
      obj = JSON.parse(respuesta);
      var res = obj.data;
      var x = 0;

      for (D = 0; D < res.length; D++) {
        if (obj.data[D].refe_1 == id_vofi) {
          document.getElementById('estatus2').value = obj.data[D].status;
          datos = obj.data[D].fecha + '*' + obj.data[D].refe_2;
          var o = datos.split("*");
          $("#inffcingr").val(o[0]);
          $("#inforemision").html(o[1]);

          if (obj.data[D].status == 'AUTORIZADO') {
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
            $("#button_estatus").html(html);
            $.ajax({
              url: '../controller/php/infpedido.php',
              type: 'GET',
              data: 'folio=' + folio
            }).done(function (resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

              for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                  var id_pedido = obj.data[U].id_kax;
                  x++; //==================================================================================30062022

                  if (obj.data[U].status_2 === "PENDIENTE") {
                    var status = "<button type='button' onclick='surtirvpf(" + id_pedido + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                  } else if (obj.data[U].status_2 === "SURTIDO") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                  } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                  } //===================================================================================


                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                }
              }

              html += '</div></tbody></table></div></div>';
              $("#listpedidinf").html(html);
            });
          } else if (obj.data[D].status == 'PENDIENTE') {
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PENDIDENTE</button>';
            $("#button_estatus").html(html);
            $.ajax({
              url: '../controller/php/infpedido.php',
              type: 'GET',
              data: 'folio=' + folio
            }).done(function (resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th style=""><i></i>ACCIONES</th></tr></thead><tbody>';

              for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                  x++;
                  var id_kardex = obj.data[U].id_kax;
                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='infartpedid(" + id_kardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetpedi'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";
                }
              }

              html += '</div></tbody></table></div></div>';
              $("#listpedidinf").html(html);
            });
          } else if (obj.data[D].status == 'SURTIDO') {
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
            $("#button_estatus").html(html);
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
            $("#button_estatus").html(html);
            $.ajax({
              url: '../controller/php/infpedido.php',
              type: 'GET',
              data: 'folio=' + folio
            }).done(function (resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

              for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                  var id_pedido = obj.data[U].id_kax;
                  x++; //==================================================================================30062022

                  if (obj.data[U].status_2 === "PENDIENTE") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                  } else if (obj.data[U].status_2 === "SURTIDO") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                  } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                  } //===================================================================================


                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                }
              }

              html += '</div></tbody></table></div></div>';
              $("#listpedidinf").html(html);
            });
          } else if (obj.data[D].status == 'FINALIZADO') {
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
            $("#button_estatus").html(html);
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
            $("#button_estatus").html(html);
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
            $("#button_estatus").html(html);
            $.ajax({
              url: '../controller/php/infpedido.php',
              type: 'GET',
              data: 'folio=' + folio
            }).done(function (resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

              for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                  var id_pedido = obj.data[U].id_kax;
                  x++; //==================================================================================30062022

                  if (obj.data[U].status_2 === "PENDIENTE") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                  } else if (obj.data[U].status_2 === "SURTIDO") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                  } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                  } //===================================================================================


                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                }
              }

              html += '</div></tbody></table></div></div>';
              $("#listpedidinf").html(html);
            });
          } else if (obj.data[D].status == 'ENTREGADO') {
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
            $("#button_estatus").html(html);
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
            $("#button_estatus").html(html);
            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
            $("#button_estatus").html(html);
            $.ajax({
              url: '../controller/php/infpedido.php',
              type: 'GET',
              data: 'folio=' + folio
            }).done(function (resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

              for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                  var id_pedido = obj.data[U].id_kax;
                  x++; //==================================================================================30062022

                  if (obj.data[U].status_2 === "PENDIENTE") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                  } else if (obj.data[U].status_2 === "SURTIDO") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                  } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                  } //===================================================================================


                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                }
              }

              html += '</div></tbody></table></div></div>';
              $("#listpedidinf").html(html);
            });
          }
        }
      }
    });
  });
}

function updateinfped() {
  var folio = document.getElementById('idinped').innerHTML;
  alert(folio);
  $.ajax({
    url: '../controller/php/infpedigrup.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].refe_1 == folio) {
        document.getElementById('estatus2').value = obj.data[D].status;
        datos = obj.data[D].fecha + '*' + obj.data[D].refe_2;
        var o = datos.split("*");
        $("#inffcingr").val(o[0]);
        $("#inforemision").html(o[1]);

        if (obj.data[D].status == 'AUTORIZADO') {
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
          $("#button_estatus").html(html);
          $.ajax({
            url: '../controller/php/infpedido.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == folio) {
                var id_pedido = obj.data[U].id_kax;
                x++; //==================================================================================30062022

                if (obj.data[U].status_2 === "PENDIENTE") {
                  var status = "<button type='button' onclick='surtirvpf(" + id_pedido + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>";
                } else if (obj.data[U].status_2 === "SURTIDO") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                  var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
          });
        } else if (obj.data[D].status == 'PENDIENTE') {
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PENDIDENTE</button>';
          $("#button_estatus").html(html);
          $.ajax({
            url: '../controller/php/infpedido.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th style=""><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == folio) {
                x++;
                var id_kardex = obj.data[U].id_kax;
                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='infartpedid(" + id_kardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetpedi'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
          });
        } else if (obj.data[D].status == 'SURTIDO') {
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
          $("#button_estatus").html(html);
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
          $("#button_estatus").html(html);
          $.ajax({
            url: '../controller/php/infpedido.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == folio) {
                var id_pedido = obj.data[U].id_kax;
                x++; //==================================================================================30062022

                if (obj.data[U].status_2 === "PENDIENTE") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                } else if (obj.data[U].status_2 === "SURTIDO") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                  var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
          });
        } else if (obj.data[D].status == 'FINALIZADO') {
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
          $("#button_estatus").html(html);
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
          $("#button_estatus").html(html);
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
          $("#button_estatus").html(html);
          $.ajax({
            url: '../controller/php/infpedido.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == folio) {
                var id_pedido = obj.data[U].id_kax;
                x++; //==================================================================================30062022

                if (obj.data[U].status_2 === "PENDIENTE") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                } else if (obj.data[U].status_2 === "SURTIDO") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                  var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
          });
        } else if (obj.data[D].status == 'ENTREGADO') {
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
          $("#button_estatus").html(html);
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
          $("#button_estatus").html(html);
          html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
          $("#button_estatus").html(html);
          $.ajax({
            url: '../controller/php/infpedido.php',
            type: 'GET',
            data: 'folio=' + folio
          }).done(function (resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              if (obj.data[U].refe_1 == folio) {
                var id_pedido = obj.data[U].id_kax;
                x++; //==================================================================================30062022

                if (obj.data[U].status_2 === "PENDIENTE") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                } else if (obj.data[U].status_2 === "SURTIDO") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                  var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
          });
        }
      }
    }
  });
} //ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN


function editarinsped(idped) {
  //alert(idped);
  var folio = idped;
  document.getElementById('id_edithpe').value = idped;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == idped) {
        //alert("entro");
        document.getElementById('cdnewvpedith').value = obj.data[C].codigo_1;
        document.getElementById('pedednewtcantid').value = obj.data[C].salida;
        document.getElementById('pepidobsaddnew').value = obj.data[C].observa;
        document.getElementById('pednewedithdes').value = obj.data[C].artdescrip;
        document.getElementById('pediedthdeparnew').value = obj.data[C].artubicac;
      }
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION


function savdelevpartped() {
  var id_kardex = document.getElementById('del_artpednew').value;
  var codigo_1 = document.getElementById('deartpednew').value;
  var datos = 'id_kardex=' + id_kardex + '&codigo_1=' + codigo_1 + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedio.php",
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
      $('#modal-delearpednew').modal('hide'); //cierra el modal

      updatepedid();
    } else {
      document.getElementById('delerarpednew').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarpednew').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS ALTA DE PEDIDOS


function editaraddartic() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithped').style.display = "";
  document.getElementById('openediaddped').style.display = "none";
  document.getElementById('saveedithped').style.display = "";
  document.getElementById('cdnewvpedith').disabled = false;
  document.getElementById('pedednewtcantid').disabled = false;
  document.getElementById('pepidobsaddnew').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN


function closeaddarped() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithped').style.display = "none";
  document.getElementById('openediaddped').style.display = "";
  document.getElementById('saveedithped').style.display = "none";
  document.getElementById('cdnewvpedith').disabled = true;
  document.getElementById('pedednewtcantid').disabled = true;
  document.getElementById('pepidobsaddnew').disabled = true;
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO ALTA TRASPASO 01052022


function saveeditharped() {
  //alert("entra guardar cambios valeproducción");
  var id_kax = document.getElementById('id_edithpe').value;
  var codigo_1 = document.getElementById('cdnewvpedith').value;
  var descripcion_1 = document.getElementById('pednewedithdes').value;
  var salida = document.getElementById('pedednewtcantid').value;
  var observa = document.getElementById('pepidobsaddnew').value;
  var datos = 'descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew'; //alert(datos);

  if (codigo_1 == '' || salida == '') {
    document.getElementById('edithpednewlle').style.display = '';
    setTimeout(function () {
      document.getElementById('edithpednewlle').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updatepedid();
        closeaddarped();
        $('#modal-edithaddpedit').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {} else {
        document.getElementById('errpedqnew').style.display = '';
        setTimeout(function () {
          document.getElementById('errpedqnew').style.display = 'none';
        }, 2000);
        alert(respuesta);
      }
    });
  }
} //FUNCION PARA EDITAR PEDIDO EN VISTA DE INFORMACION


function editpediinf() {
  //alert("EDITAR PEDIDO");
  //muestra el boton de cerrar editar
  document.getElementById('closepedi').style.display = "";
  document.getElementById('openedipi').style.display = "none"; //muestra los botones

  document.getElementById('addarticp').style.display = "";
  document.getElementById('cancelpe').style.display = ""; //campos

  $("#infvpdate").removeAttr("readonly");
  $("#infclinte").removeAttr("readonly");
  $("#auropedid").removeAttr("readonly");
  $("#feautoped").removeAttr("readonly");
  $("#fesurtped").removeAttr("readonly");
  $("#fecentrega").removeAttr("readonly");
  $("#remisioninf").removeAttr("readonly");
  document.getElementById('atendioinf').disabled = false;
} //FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function closedithpin() {
  //alert("cierra pedido");
  //muestra los botones
  document.getElementById('addarticp').style.display = "none";
  document.getElementById('cancelpe').style.display = "none"; //muestra el boton de cerrar editar

  document.getElementById('closepedi').style.display = "none";
  document.getElementById('openedipi').style.display = "";
  $("#infvpdate").attr("readonly", "readonly");
  $("#infclinte").attr("readonly", "readonly");
  $("#auropedid").attr("readonly", "readonly");
  $("#feautoped").attr("readonly", "readonly");
  $("#fesurtped").attr("readonly", "readonly");
  $("#fecentrega").attr("readonly", "readonly");
  $("#remisioninf").attr("readonly", "readonly");
  document.getElementById('atendioinf').disabled = true;
} //FUNCION PARA ABRIR EDICION DE ARTICULO DE PEDIDO EN VISTA DE INFORMACION


function opeinpedf() {
  //alert("cierra pedido");
  document.getElementById('ediinfpe').disabled = false;
  document.getElementById('editcavoinf').disabled = false;
  document.getElementById('pprecioinf').disabled = false;
  document.getElementById('editcapeinf').disabled = false;
  document.getElementById('infobserep').disabled = false; //muestra el boton de cerrar editar

  document.getElementById('openedipeinf').style.display = "none";
  document.getElementById('closeditpeinf').style.display = "";
} //FUNCION PARA CERRAR EDICION DE ARTICULO DE PEDIDO EN VISTA DE INFORMACION


function closeinpedf() {
  //alert("cierra pedido");
  document.getElementById('ediinfpe').disabled = true;
  document.getElementById('editcavoinf').disabled = true;
  document.getElementById('pprecioinf').disabled = true;
  document.getElementById('editcapeinf').disabled = true;
  document.getElementById('infobserep').disabled = true; //muestra el boton de cerrar editar

  document.getElementById('openedipeinf').style.display = "";
  document.getElementById('closeditpeinf').style.display = "none";
} //funcion para traer la informacion del pedido a edicion de articulos


function infartpedid(id_kardex) {
  //alert("entra pedido");
  //alert("entro el pedido");
  //alert(id_kardex);
  document.getElementById('id_pededithdett').value = id_kardex;
  var folio = id_kardex;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0; //alert(respuesta);

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_kax == id_kardex) {
        datos = obj.data[D].codigo_1 + '*' + obj.data[D].salida + '*' + //obj.data[D].costo; 
        obj.data[D].costo + '*' + obj.data[D].artubicac + '*' + obj.data[D].artdescrip + '*' + obj.data[D].observa;
        var o = datos.split("*");
        $("#modal-edithdetpedi #cdedttpededith").val(o[0]);
        $("#modal-edithdetpedi #pededdettcantid").val(o[1]);
        $("#modal-edithdetpedi #pededthdepardell").val(o[3]);
        $("#modal-edithdetpedi #peddettedithdes").val(o[4]);
        $("#modal-edithdetpedi #pedobsadddetll").val(o[5]);
      }
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SIN EXISTENCIA


function infsiexpedid(id_pedido) {
  //alert("entro");
  //alert(id_pedido);
  var folio = id_pedido;
  document.getElementById('idsinexpedi').value = id_pedido;
  var estatus = document.getElementById('estatus2').value;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_pedido) {
        if (document.getElementById('estatus2').value == "SURTIDO" || document.getElementById('estatus2').value == "FINALIZADO") {
          //alert("entro");
          document.getElementById('descsinpedi').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsinped').innerHTML = obj.data[C].salida; //listo vista sin editar

          document.getElementById('opstsinped').innerHTML = obj.data[C].observa_dep; //listo vista sin editar
          //inpus e edición

          document.getElementById('cnsinped').value = obj.data[C].salida; //listo vista para editar

          document.getElementById('obdepsinped').value = obj.data[C].observa_dep; //listo vista para editar
          //oculta la edición

          document.getElementById('opesurt1sn').style.display = "none";
        } else {
          //alert("entro"); 
          document.getElementById('descsinpedi').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsinped').innerHTML = obj.data[C].salida; //listo vista sin editar

          document.getElementById('opstsinped').innerHTML = obj.data[C].observa_dep; //listo vista sin editar
          //inpus e edición

          document.getElementById('cnsinped').value = obj.data[C].salida; //listo vista para editar

          document.getElementById('obdepsinped').value = obj.data[C].observa_dep; //listo vista para editar
          //muestra la edición

          document.getElementById('opesurt1sn').style.display = "";
        }
      }
    }
  });
} //ABRE EDICION DE MODAL SIN EXISTENCIA


function openedithsnex() {
  document.getElementById('editarsinped').style.display = "";
  document.getElementById('infsursnp').style.display = "none";
  document.getElementById('opesurt1snp').style.display = "none";
  document.getElementById('clossurt1snp').style.display = "";
} //CIERRA EDICION DE MODAL SIN EXISTENCIA


function closedithsnex() {
  document.getElementById('editarsinped').style.display = "none";
  document.getElementById('infsursnp').style.display = "";
  document.getElementById('opesurt1snp').style.display = "";
  document.getElementById('clossurt1snp').style.display = "none";
} //FUNCION PARA GUARDAR CAMBIOS EDITAR SIN EXISTENCIAS 


function savesinextped() {
  //alert("savesinextvp");
  var id_kax = document.getElementById('idsinexpedi').value;
  var refe_1 = document.getElementById('idinped').innerHTML;
  var cantidad = document.getElementById('cnsinped').value;
  var observa_dep = document.getElementById('obdepsinped').value;
  var descrip = document.getElementById('descsinpedi').innerHTML;
  var status2 = "SURTIDO"; //Condición de cambiar status2 si es mayor a 0

  if (document.getElementById('cnsinped').value > 0) {
    status2 = "SURTIDO";
  }

  if (document.getElementById('cnsinped').value == 0) {
    status2 = "SIN EXISTENCIAS";
  }

  var datos = 'id_kax=' + id_kax + '&descrip=' + descrip + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&status2=' + status2 + '&opcion=edthsinexis'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedio.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-sinexivp').modal('hide');
      updatepedid();
      closedithsnex();
    } else {
      Swal.fire({
        type: 'info',
        text: 'Contactar a Soporte tecnico o levantar un ticket',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
} //LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN ALTA DE PRODUCCIÓN


function deletenewart(id_delete) {
  //alert(id_delete);
  var folio = id_delete;
  document.getElementById('del_artpednew').value = id_delete;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_delete) {
        //alert("entro");
        document.getElementById('deartpednew').value = obj.data[C].codigo_1;
      }
    }
  });
} //LLAMADO DE DATOS


function cancelar() {
  //alert("entra cancelar");
  var refe_1 = document.getElementById('pedfolio').value;
  var datos = 'refe_1=' + refe_1 + '&opcion=cancelar';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedio.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se cancelelo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'listpedido.php';", 1500);
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
} //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS PEDIDO EN DETALLES


function editarpeddett() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithpedido').style.display = "";
  document.getElementById('openedithpedido').style.display = "none";
  document.getElementById('saveedithpedidett').style.display = "";
  document.getElementById('cdedttpededith').disabled = false;
  document.getElementById('pededdettcantid').disabled = false;
  document.getElementById('pedobsadddetll').disabled = false;
} //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS PEDIDO EN DETALLES


function closedithpeddett() {
  //alert("edit articulo infovalesds");
  document.getElementById('closedithpedido').style.display = "none";
  document.getElementById('openedithpedido').style.display = "";
  document.getElementById('saveedithpedidett').style.display = "none";
  document.getElementById('cdedttpededith').disabled = true;
  document.getElementById('pededdettcantid').disabled = true;
  document.getElementById('pedobsadddetll').disabled = true;
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS EN PEDIDOS


function saveedithdettped() {
  //alert("entra guardar cambios valeproducción");
  var id_kax = document.getElementById('id_pededithdett').value;
  var codigo_1 = document.getElementById('cdedttpededith').value;
  var salida = document.getElementById('pededdettcantid').value;
  var observa = document.getElementById('pedobsadddetll').value;
  var datos = 'salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnewinfo';
  alert(datos);

  if (codigo_1 == '' || salida == '') {
    document.getElementById('edithpdidettlle').style.display = '';
    setTimeout(function () {
      document.getElementById('edithpdidettlle').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updateinfped();
        closedithpeddett();
        $('#modal-edithdetpedi').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {} else {
        document.getElementById('errpedidett').style.display = '';
        setTimeout(function () {
          document.getElementById('errpedidett').style.display = 'none';
        }, 2000);
        alert(respuesta);
      }
    });
  }
}
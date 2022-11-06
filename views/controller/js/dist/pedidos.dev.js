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
      var refe_3 = document.getElementById('pedidatentio').value;
      var proveedor_cliente = document.getElementById('pedicliente').value;
      var caracter = document.getElementById('pedidcaracter').value; //--------------------------

      var datos = 'refe_1=' + refe_1 + '&caracter=' + caracter + '&opcion=registrarfin';

      if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || refe_2 == '') {
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
              text: 'Se AGREGO el pedido de forma correcta',
              showConfirmButton: false,
              timer: 2000
            });
            setTimeout("location.href = 'listpedido.php';", 1500);
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
    }
  });
});
$(document).ready(function () {
  $('#busccodimem').load('./select/busartped.php'); //$('#busccodigomem2').load('./select/buscarme2.php');
  //$('#buscpedido').load('./select/buspedi.php');
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

    $("#listaped").toggle("fast"); //Oculta lista idinped infclinte

    var folio = id_vofi; //BOTONES -----------------------------------------------

    var autorizar = document.getElementById('btnpedautoriz');
    var liberar = document.getElementById('btnpedliberar');
    var surtir = document.getElementById('btnpedsurtir');
    var finalizado = document.getElementById('btnpedfinaliz');
    var editar = document.getElementById('openedipi');
    var pdf = document.getElementById('pdfpedrod'); //let masivo = document.getElementById('masivo');
    //fin botones -------------------------------------------

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
          //auropedid
          document.getElementById('estatus2').value = obj.data[D].status;
          document.getElementById('infpeddirect').value = obj.data[D].descripcion_1;
          document.getElementById('infpedlugar').value = obj.data[D].ubicacion;
          document.getElementById('atendioinf').value = obj.data[D].refe_3;
          document.getElementById('pedidcaracter').value = obj.data[D].caracter;
          document.getElementById('creapedid').value = obj.data[D].creacion;
          document.getElementById('fecreaped').value = obj.data[D].fec_creacion;
          document.getElementById('auropedid').value = obj.data[D].autoriza;
          document.getElementById('feautoped').value = obj.data[D].fec_autoriza;
          document.getElementById('sutpedid').value = obj.data[D].surtio;
          document.getElementById('fesurtped').value = obj.data[D].fec_surtio;
          document.getElementById('finalizpedid').value = obj.data[D].finaliza;
          document.getElementById('fecentrega').value = obj.data[D].fec_finaliza;
          datos = obj.data[D].fecha + '*' + obj.data[D].refe_2;
          var o = datos.split("*");
          $("#infvpdate").val(o[0]);
          $("#remisioninf").val(o[1]);

          if (obj.data[D].status == 'AUTORIZADO') {
            autorizar.style.display = 'none';
            liberar.style.display = '';
            surtir.style.display = '';
            finalizado.style.display = 'none';
            editar.style.display = '';
            pdf.style.display = '';
            var masivo = $("#masivo").removeClass("d-none");
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
                    var status = "<button type='button' onclick='surtirvpf(" + id_pedido + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirpedrod'>SURTIR</button>";
                  } else if (obj.data[U].status_2 === "SURTIDO") {
                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                  } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                  } //===================================================================================


                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                }
              }

              html += '</tbody></table></div>';
              $("#listpedidinf").html(html);
              $('#lispedidoinf').DataTable({
                pageLength: 100,
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
          } else if (obj.data[D].status == 'PENDIENTE') {
            autorizar.style.display = '';
            liberar.style.display = 'none';
            surtir.style.display = 'none';
            finalizado.style.display = 'none';
            editar.style.display = '';
            pdf.style.display = 'none';

            var _masivo = $("#masivo").addClass("d-none");

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
                  html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='infartpedid(" + id_kardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetpedi'>Editar</a><a href='' onclick='delartpedinf(" + id_kardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleartped'>Eliminar</a>" + "</td></tr>";
                }
              }

              html += '</tbody></table></div>';
              $("#listpedidinf").html(html);
              $('#lispedidoinf').DataTable({
                pageLength: 100,
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
          } else if (obj.data[D].status == 'SURTIDO') {
            autorizar.style.display = 'none';
            liberar.style.display = 'none';
            surtir.style.display = 'none';
            finalizado.style.display = '';
            editar.style.display = 'none';
            pdf.style.display = '';

            var _masivo2 = $("#masivo").addClass("d-none");

            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
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

              html += '</tbody></table></div>';
              $("#listpedidinf").html(html);
              $('#lispedidoinf').DataTable({
                pageLength: 100,
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
          } else if (obj.data[D].status == 'FINALIZADO') {
            autorizar.style.display = 'none';
            liberar.style.display = 'none';
            surtir.style.display = 'none';
            finalizado.style.display = 'none';
            editar.style.display = 'none';
            pdf.style.display = '';

            var _masivo3 = $("#masivo").addClass("d-none");

            html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
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

              html += '</tbody></table></div>';
              $("#listpedidinf").html(html);
              $('#lispedidoinf').DataTable({
                pageLength: 100,
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
          } else if (obj.data[D].status == 'ENTREGADO') {
            var _masivo4 = $("#masivo").addClass("d-none");

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

              html += '</tbody></table></div>';
              $("#listpedidinf").html(html);
              $('#lispedidoinf').DataTable({
                pageLength: 100,
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
          }
        }
      }
    });
  });
}

function updateinfped() {
  var folio = document.getElementById('idinped').innerHTML; //alert(folio);
  //BOTONES -----------------------------------------------

  var autorizar = document.getElementById('btnpedautoriz');
  var liberar = document.getElementById('btnpedliberar');
  var surtir = document.getElementById('btnpedsurtir');
  var finalizado = document.getElementById('btnpedfinaliz');
  var editar = document.getElementById('openedipi');
  var pdf = document.getElementById('pdfpedrod'); //let masivo = document.getElementById('masivo');

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
          autorizar.style.display = 'none';
          liberar.style.display = '';
          surtir.style.display = '';
          finalizado.style.display = 'none';
          editar.style.display = '';
          pdf.style.display = '';
          var masivo = $("#masivo").removeClass("d-none");
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
                  var status = "<button type='button' onclick='surtirvpf(" + id_pedido + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirpedrod'>SURTIR</button>";
                } else if (obj.data[U].status_2 === "SURTIDO") {
                  var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                  var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                } //===================================================================================


                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
              }
            }

            html += '</tbody></table></div>';
            $("#listpedidinf").html(html);
            $('#lispedidoinf').DataTable({
              pageLength: 100,
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
        } else if (obj.data[D].status == 'PENDIENTE') {
          autorizar.style.display = '';
          liberar.style.display = 'none';
          surtir.style.display = 'none';
          finalizado.style.display = 'none';
          editar.style.display = '';
          pdf.style.display = 'none';

          var _masivo5 = $("#masivo").addClass("d-none");

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
                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='infartpedid(" + id_kardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetpedi'>Editar</a><a href='' onclick='delartpedinf(" + id_kardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleartped'>Eliminar</a>" + "</td></tr>";
              }
            }

            html += '</tbody></table></div>';
            $("#listpedidinf").html(html);
            $('#lispedidoinf').DataTable({
              pageLength: 100,
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
        } else if (obj.data[D].status == 'SURTIDO') {
          autorizar.style.display = 'none';
          liberar.style.display = 'none';
          surtir.style.display = 'none';
          finalizado.style.display = '';
          editar.style.display = 'none';
          pdf.style.display = '';

          var _masivo6 = $("#masivo").addClass("d-none");

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

            html += '</tbody></table></div>';
            $("#listpedidinf").html(html);
            $('#lispedidoinf').DataTable({
              pageLength: 100,
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
        } else if (obj.data[D].status == 'FINALIZADO') {
          autorizar.style.display = 'none';
          liberar.style.display = 'none';
          surtir.style.display = 'none';
          finalizado.style.display = 'none';
          editar.style.display = 'none';
          pdf.style.display = '';

          var _masivo7 = $("#masivo").addClass("d-none");

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

            html += '</tbody></table></div>';
            $("#listpedidinf").html(html);
            $('#lispedidoinf').DataTable({
              pageLength: 100,
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
        } else if (obj.data[D].status == 'ENTREGADO') {
          var _masivo8 = $("#masivo").addClass("d-none");

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

            html += '</tbody></table></div>';
            $("#listpedidinf").html(html);
            $('#lispedidoinf').DataTable({
              pageLength: 100,
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
  var descripcion_1 = document.getElementById('adddireccion').value;
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
  document.getElementById('openedipi').style.display = "none";
  document.getElementById('saveinped').style.display = ""; //muestra los botones

  document.getElementById('addarticp').style.display = ""; //document.getElementById('cancelpe').style.display = "";
  //campos 

  $("#infvpdate").removeAttr("readonly");
  $("#auropedid").removeAttr("readonly");
  $("#feautoped").removeAttr("readonly");
  $("#fesurtped").removeAttr("readonly");
  $("#fecentrega").removeAttr("readonly");
  $("#remisioninf").removeAttr("readonly");
  $("#infpedlugar").removeAttr("readonly");
  $("#infpeddirect").removeAttr("readonly");
  document.getElementById('atendioinf').disabled = false;
  document.getElementById('infclinte').disabled = false;
  document.getElementById('pedidcaracter').disabled = false;
} //FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function closedithpin() {
  //alert("cierra pedido");
  //muestra los botones
  document.getElementById('addarticp').style.display = "none"; //muestra el boton de cerrar editar

  document.getElementById('closepedi').style.display = "none";
  document.getElementById('openedipi').style.display = "";
  document.getElementById('saveinped').style.display = "none";
  $("#infvpdate").attr("readonly", "readonly");
  $("#auropedid").attr("readonly", "readonly");
  $("#feautoped").attr("readonly", "readonly");
  $("#fesurtped").attr("readonly", "readonly");
  $("#fecentrega").attr("readonly", "readonly");
  $("#remisioninf").attr("readonly", "readonly");
  $("#infpedlugar").attr("readonly", "readonly");
  $("#infpeddirect").attr("readonly", "readonly");
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

          document.getElementById('opesurt1snp').style.display = "none";
        } else {
          //alert("entro"); 
          document.getElementById('descsinpedi').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsinped').innerHTML = obj.data[C].salida; //listo vista sin editar

          document.getElementById('opstsinped').innerHTML = obj.data[C].observa_dep; //listo vista sin editar
          //inpus e edición

          document.getElementById('cnsinped').value = obj.data[C].salida; //listo vista para editar

          document.getElementById('obdepsinped').value = obj.data[C].observa_dep; //listo vista para editar
          //muestra la edición

          document.getElementById('opesurt1snp').style.display = "";
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
      $('#modal-sinexipedido').modal('hide');
      updateinfped();
      clossurt1snp();
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
  var datos = 'salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnewinfo'; //alert(datos);

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
} //FUNCION PARA QUE TRAIGA LA INFOMACION DE EL ARTICULO EN DETALLES DEL PEDIDO


function delartpedinf(id_articulo) {
  ; //alert(id_articulo);

  document.getElementById('del_artpeddetts').value = id_articulo;
  var folio = id_articulo;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_articulo) {
        //alert("entro");
        document.getElementById('deartpedidett').value = obj.data[C].codigo_1 + "/" + obj.data[C].artdescrip;
      }
    }
  });
} //GUARDA LA ELIMINACION POR ARTICULO EN DETALLES EN PEDIDOS


function savdelepediartdet() {
  var id_kardex = document.getElementById('del_artpeddetts').value;
  var codigo_1 = document.getElementById('deartpedidett').value;
  var datos = 'id_kardex=' + id_kardex + '&codigo_1=' + codigo_1 + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedio.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updateinfped();
      $('#modal-deleartped').modal('hide'); //cierra el modal
      // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
    } else {
      document.getElementById('delerarvpdett').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvpdett').style.display = 'none';
      }, 2000); //alert(respuesta);
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
        $("#pindescripinf").val(o[1]);
        $("#pindeparinnf").val(o[2]);
      }
    }
  });
} //GUARDAR EL ARTICLO INDIVIDUAL EN DETALLES DE VALE DE PRODUCCIÓN


function addarinpedinfo() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('idinped').innerHTML;
  var fecha = document.getElementById('infvpdate').value;
  var refe_2 = document.getElementById('remisioninf').value;
  var refe_3 = document.getElementById('atendioinf').value;
  var proveedor_cliente = document.getElementById('infclinte').value;
  var codigo_1 = document.getElementById('codindivinf').value;
  var cantidad_real = document.getElementById('pincantidinf').value;
  var salida = document.getElementById('pincantidinf').value;
  var observa = document.getElementById('ppinfbsertrass').value;
  var tipo_ref = "ARTICULO";
  var ubicacion = document.getElementById('infpedlugar').value; //lugar

  var descripcion_1 = document.getElementById('infpeddirect').value; //DIRECCION

  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind'; //alert(datos);

  if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '') {
    document.getElementById('edthinfvcp').style.display = '';
    setTimeout(function () {
      document.getElementById('edthinfvcp').style.display = 'none';
    }, 2000);
    alert("VACIS");
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
        document.getElementById('codindivinf').value = "";
        document.getElementById('pindescripinf').value = "";
        document.getElementById('pincantidinf').value = "";
        document.getElementById('ppinfbsertrass').value = "";
        updateinfped();
        $("#modal-addartpedinfo").modal('hide'); //ocultamos el modal
      } else if (respuesta == 2) {
        document.getElementById('edthvinbli1inf').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvinbli1inf').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvinperr1inf').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvinperr1inf').style.display = 'none';
        }, 1000); //alert("ERRs");
      }
    });
  }
} //INFORMACIÓN DE HISTORIAL DE PEDIDOS


function histvalepro() {
  var folio = document.getElementById('idinped').innerHTML;
  var folio2 = "FOLIO:" + folio; //alert(folio);
  //Tabla de historial del vale de producción

  $.ajax({
    url: '../controller/php/hispedidos.php',
    type: 'POST',
    data: 'folio=' + folio2
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0; //alert("folio");

    html = '<div class="rounded table-responsive"><table style="width:100%" id="hisvalevp" name="hisvalevp" class="table display dataTable no-footer"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>Usuario</th><th><i></i>Acción</th><th><i></i>Registro</th><th><i></i>fecha</th></tr></thead><tbody>';

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
    var x = 0; //alert(resp);

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
} //FUNCIÓN DE AUTORIZAR PEDIDOS 


function autorizaped() {
  //alert("entra memo");
  var status = 'AUTORIZADO';
  var folio = document.getElementById('idinped').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=autorizarped'; //alert(datos);

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
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se AUTORIZO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'listpedido.php';", 1500);
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
} //FUNCIONES DE LIBERAR PEDIDOS


function liberarped() {
  //alert("memos"); 
  var foliovp = document.getElementById('idinped').innerHTML;
  var datos = 'foliovp=' + foliovp + '&opcion=liberarped'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedio.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE LIBERO FORMA CORRECTA',
        showConfirmButton: false,
        timer: 2500
      });
      setTimeout("location.href = 'listpedido.php';", 2500);
    } else {
      Swal.fire({
        type: 'error',
        text: 'Error contactar a soporte tecnico o levantar un ticket',
        showConfirmButton: false,
        timer: 2500
      });
    }
  });
} //FUNCIÓN DE SURTIR


function surtidoped() {
  //alert("entra memo");
  var status = 'SURTIDO';
  var folio = document.getElementById('idinped').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=surtirped'; //alert(datos);

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
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se SURTIO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'listpedido.php';", 1500);
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
  var folio = document.getElementById('idinped').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=finalped'; //alert(datos);

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
      url: "../controller/php/insertpedio.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se FINALIZO de forma correcta',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout("location.href = 'listpedido.php';", 1500);
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
} //FUNCION QUE MUESTRA LA INFORMACIÓN DEL ARTICULO A ASURTIR 


function surtirvpf(id_kardex) {
  //alert(id_kardex);
  var folio = id_kardex;
  document.getElementById('id_surtpedif').value = id_kardex;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_kardex) {
        //alert("entro");
        document.getElementById('codisurtped').value = obj.data[C].codigo_1;
        document.getElementById('surtapedrinf').value = obj.data[C].salida;
        document.getElementById('descripsurped').value = obj.data[C].artdescrip;
      }
    }
  });
} //FUNCION DE EDITAR SURTIR


function edithsurpedif() {
  //alert("edit articulo infovale");
  document.getElementById('codisurtped').disabled = false;
  document.getElementById('surtapedrinf').disabled = false;
  document.getElementById('closeditpedrinf').style.display = "";
  document.getElementById('surtirpedrf').style.display = "none";
} //FUNCION DE EDITAR SURTIR PRODUCTO TERMINADO


function edithsurvpfin() {
  //alert("edit articulo infovale");
  document.getElementById('codisurpedfin').disabled = false;
  document.getElementById('surtpedfn').disabled = false;
  document.getElementById('closeditpedfin').style.display = "";
  document.getElementById('surtirpedfin').style.display = "none";
} //FUNCION DE CERRAR EDITAR SURTIR


function closedisurvpif() {
  //alert("edit articulo infovale");
  document.getElementById('codisurtped').disabled = true;
  document.getElementById('surtapedrinf').disabled = true;
  document.getElementById('closeditpedrinf').style.display = "none";
  document.getElementById('surtirpedrf').style.display = "";
} //FUNCION PARA MARCAR SURTIR ARTICULO INDIVIDUAL DETALLE DEL VALE


function acsurtirpedf() {
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtpedif').value;
  var refe_1 = document.getElementById('idinped').innerHTML;
  var codigo_1 = document.getElementById('codisurtped').value;
  var cantidad = document.getElementById('surtapedrinf').value;
  var observa_dep = document.getElementById('surbsereped').value;
  var datos = 'id_kax=' + id_kax + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&cantidad=' + cantidad + '&opcion=surtir'; //alert(datos)

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
      $('#modal-surtirpedrod').modal('hide');
      updateinfped();
      closedisurvpif();
    } else {
      document.getElementById('edthpederrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthpederrinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION PARA MARCAR SIN EXISTENCIAS 


function sinexisten() {
  //alert("sinexisten");
  var id_kax = document.getElementById('id_surtpedif').value;
  var refe_1 = document.getElementById('idinped').innerHTML;
  var codigo_1 = document.getElementById('codisurtped').value;
  var observa_dep = document.getElementById('surbsereped').value;
  var datos = 'id_kax=' + id_kax + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=sinexistencia'; //alert(datos);

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
      $('#modal-surtirpedrod').modal('hide');
      updateinfped();
      closedisurvpif();
    } else {
      document.getElementById('edthpederrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthpederrinf').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SURTIDO


function infsurtiped(id_valeprodu) {
  //alert("entro");
  var folio = id_valeprodu;
  document.getElementById('idsurt').value = id_valeprodu;
  $.ajax({
    url: '../controller/php/conpedidios.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_valeprodu) {
        if (document.getElementById('estatus').innerHTML == "SURTIDO" || document.getElementById('estatus').innerHTML == "FINALIZADO") {
          //alert("entro");
          document.getElementById('descsurt').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsur').innerHTML = obj.data[C].salida;
          document.getElementById('opstsur').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurt').value = obj.data[C].salida;
          document.getElementById('obdepinf').value = obj.data[C].observa_dep; //oculta la edición

          document.getElementById('opesurt1').style.display = "none";
        } else {
          //alert("entro");
          document.getElementById('descsurt').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsur').innerHTML = obj.data[C].salida;
          document.getElementById('opstsur').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurt').value = obj.data[C].salida;
          document.getElementById('obdepinf').value = obj.data[C].observa_dep; //muestra la edición

          document.getElementById('opesurt1').style.display = "";
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
} //FUNCION PARA GUARDAR EDITAR SURTIR


function savesurtped() {
  //alert("entro vales");
  var id_kax = document.getElementById('idsurt').value;
  var refe_1 = document.getElementById('idinped').innerHTML;
  var cantidad = document.getElementById('cnsurt').value;
  var observa_dep = document.getElementById('obdepinf').value;
  var descrip = document.getElementById('descsurt').innerHTML; //alert("entro vales2");

  var status2 = "SURTIDO"; //Condición de cambiar status2 si es mayor a 0

  if (document.getElementById('cnsurt').value > 0) {
    status2 = "SURTIDO";
  }

  if (document.getElementById('cnsurt').value == 0) {
    status2 = "SIN EXISTENCIAS";
  }

  var datos = 'id_kax=' + id_kax + '&descrip=' + descrip + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&status2=' + status2 + '&opcion=edthsurtir'; //alert(datos);

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
      $('#modal-surtido').modal('hide');
      updateinfped();
      closedisurvpif();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
} //CIERRA EDICION DE MODAL SURTIDO


function closedithsurt() {
  document.getElementById('editarsur').style.display = "none";
  document.getElementById('infsur').style.display = "";
  document.getElementById('opesurt1').style.display = "";
  document.getElementById('clossurt1').style.display = "none";
} //FUNCIÓN PARA CREAR PDF


function pdfvp() {
  var folio = document.getElementById('idinped').innerHTML; //alert("entro");

  url = '../formatos/pdf_pedidos.php';
  window.open(url + "?data=" + folio, '_black');
}

function masive() {
  //alert("entra masivo");
  var folio = document.getElementById('idinped').innerHTML;
  $.ajax({
    url: '../controller/php/infpedido.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="rounded table-responsive"><table style="width:100%" id="lismasive" name="lismasive" class="table table-bordered"><thead class="thead-colored thead-primary"><tr><th class="d-none"><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == folio) {
        var id_pedido = obj.data[U].id_kax;
        x++;
        var status = "<button type='button' onclick='surtirvpf(" + id_pedido + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirpedrod'>SURTIR</button>";
        html += "<tr><td class='d-none'> <input class='d-none' id='idperon' name='idperon' value='" + obj.data[U].id_kax + "'></td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td><input type='number'  max='99999' title='confima la cantidad' name='cantidadmasv' min='' id='cantidadmasv' value='" + obj.data[U].salida + "' >" + "</td><td><input type='text' title='ingresa observaciones' name='obsevmasv' min='0' id='obsevmasv' value='" + obj.data[U].observa_dep + "'>" + "</td></tr>";
      }
    }

    html += '</tbody></table></div>';
    $("#masive").html(html);
    $('#lismasive').DataTable({
      pageLength: 100,
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
} //funciones para guardar masivamente la información


function savemasive() {
  var idperon = new Array();
  /*Agrupamos todos los input con name=cbxEstudiante*/

  $('input[name="idperon"]').each(function (element) {
    var item = {};
    item.idperon = this.value;
    idperon.push(item);
  });
  var evaluacion = new Array();
  /*Agrupamos todos los input con name=cbxEstudiante*/

  $('input[name="cantidadmasv"]').each(function (element) {
    var item = {};
    item.evaluacion = this.value;
    evaluacion.push(item);
  });
  var observaciones = new Array();
  /*Agrupamos todos los input con name=cbxEstudiante*/

  $('input[name="obsevmasv"]').each(function (element) {
    var item = {};
    item.observaciones = this.value;
    observaciones.push(item);
  });
  var array1 = JSON.stringify(idperon);
  var array2 = JSON.stringify(evaluacion);
  var array3 = JSON.stringify(observaciones);
  var folio = document.getElementById('idinped').innerHTML;
  datos = 'array1=' + array1 + '&array2=' + array2 + '&array3=' + array3 + '&folio=' + folio + '&opcion=surmasivo'; //alert(datos);

  $.ajax({
    url: '../controller/php/insertpedio.php',
    type: 'POST',
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtirmasivo').modal('hide');
      updateinfped();
    } else {
      //alert("error");
      Swal.fire({
        type: 'danger',
        text: 'Contactar a soporte tecnico o levantar un ticket',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
}

function savepedcabe() {
  var refe_1 = document.getElementById('idinped').innerHTML;
  var refe_2 = document.getElementById('remisioninf').value;
  var fecha = document.getElementById('infvpdate').value;
  var proveedor_cliente = document.getElementById('infclinte').value;
  var refe_3 = document.getElementById('atendioinf').value;
  var ubicacion = document.getElementById('infpedlugar').value;
  var descripcion_1 = document.getElementById('infpeddirect').value;
  var pedidcaracter = document.getElementById('pedidcaracter').value;
  var datos = 'refe_1=' + refe_1 + '&refe_2=' + refe_2 + '&fecha=' + fecha + '&proveedor_cliente=' + proveedor_cliente + '&refe_3=' + refe_3 + '&ubicacion=' + ubicacion + '&descripcion_1=' + descripcion_1 + '&pedidcaracter=' + pedidcaracter + '&opcion=savecabez'; //alert(datos);

  if (fecha == '' || refe_3 == '' || proveedor_cliente == '' || pedidcaracter == '') {
    document.getElementById('edthpedvacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthpedvacios').style.display = 'none';
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
        closedithpin();
      } else if (respuesta == 2) {
        document.getElementById('edthpedexi').style.display = '';
        setTimeout(function () {
          document.getElementById('edthpedexi').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthpedierror').style.display = '';
        setTimeout(function () {
          document.getElementById('edthpedierror').style.display = 'none';
        }, 2000); //alert(respuesta);
      }
    });
  }
}
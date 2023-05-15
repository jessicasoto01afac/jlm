"use strict";

function openentregas() {
  //AQUI EMPIEZA 
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5, 6]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE MEMOS',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5, 6]
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
        columns: [0, 1, 2, 3, 4, 5, 6]
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
    "ajax": "../controller/php/conentregas.php"
  }); // CON ESTO FUNCIONA EL MULTIFILTRO//

  /*$('#inventario thead tr').clone(true).appendTo('#inventario thead');
      $('#inventario thead tr:eq(1) th').each(function(i) {
       var title = $(this).text(); //es el nombre de la columna
       $(this).html('<input type="text"  placeholder="Buscar" />');
          $('input', this).on('keyup change', function() {
           if (table.column(i).search() !== this.value) {
               table
                   .column(i)
                   .search(this.value)
                   .draw();
           }
       });
   });*/

  $(document).ready(function () {
    $('#cliente1').select2();
  });
}

function updatepickup() {
  var table1 = $('#example').DataTable({
    paging: false
  });
  table1.destroy();
  var table = $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5, 6]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE MEMOS',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5, 6]
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
        columns: [0, 1, 2, 3, 4, 5, 6]
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
    "ajax": "../controller/php/conentregas.php"
  });
}

function saveentregas() {
  //alert("saveentregas");
  var folio = document.getElementById('cliente1').value;
  var date = document.getElementById('dateentrega').value;
  var obserba = document.getElementById('obserentr').value;
  var d = new Date().getTime();
  var uuid = folio + 'xxxyxxxxxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
    var r = (d + Math.random() * 16) % 16 | 0;
    d = Math.floor(d / 16);
    return (c == 'x' ? r : r & 0x3 | 0x8).toString(16);
  });
  var datos = 'folio=' + folio + '&date=' + date + '&uuid=' + uuid + '&obserba=' + obserba + '&opcion=insert'; //alert(datos);

  if (folio == '' || date == '') {
    Swal.fire({
      type: 'info',
      text: 'llenar los campos obligatorios',
      showConfirmButton: false,
      timer: 1500
    });
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertpedidos.php",
      data: datos
    }).done(function (respuesta) {
      //alert(respuesta);
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrega entrega de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        $('#example').DataTable().clear().destroy();
        openentregas();
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'EL pedido ya esta ingresado',
          showConfirmButton: false,
          timer: 1500
        });
      } else {
        Swal.fire({
          type: 'warning',
          text: 'Error contactar a soporte tecnico',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
}

function encamino(id_entregas) {
  //alert(id_entregas);
  var identregas = id_entregas;
  var datos = 'identregas=' + identregas + '&opcion=encamino'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedidos.php",
    data: datos
  }).done(function (respuesta) {
    //alert(respuesta);
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'El pedido esta en camino',
        showConfirmButton: false,
        timer: 1500
      });
      $('#example').DataTable().clear().destroy();
      openentregas();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Error contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
}

function entregado(id_entregas) {
  var identregas = id_entregas;
  var datos = 'identregas=' + identregas + '&opcion=finalizado'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertpedidos.php",
    data: datos
  }).done(function (respuesta) {
    // alert(respuesta);
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Pedido completado',
        showConfirmButton: false,
        timer: 1500
      }); // $("#example").dataTable().fnDestroy()
      //table = $("#example").DataTable({ responsive: true });

      $('#example').DataTable().clear().destroy();
      openentregas();
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Error contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
}

function hisentrega(folio) {
  //alert(folio);
  $.ajax({
    url: '../controller/php/hisentrega.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0; //alert("folio");

    html = '';

    for (U = 0; U < res.length; U++) {
      x++;
      html += "<div><div class='media-list bg-white rounded shadow-base'><div class='media pd-10 pd-xs-20'><div class='media-body mg-l-20'><div class='d-flex justify-content-between mg-b-10'><div><h6 class='mg-b-2 tx-inverse tx-14'>" + obj.data[U].id_usu + "</h6></div><span class='tx-12'>" + obj.data[U].fecha + "</span></div>" + obj.data[U].proceso + "<p class = 'mg-b-20'></p></div></div></div></div>"; //html = "<div class='media align-items-center pd-b-10'><img src='http://via.placeholder.com/280x280' class='wd-45 rounded-circle' alt=''><div class='media-body mg-x-15 mg-xs-x-20'><h6 class='mg-b-2 tx-inverse tx-14'>" + obj.data[U].id_usu + "</h6><p class='mg-b-0 tx-12'>" + obj.data[U].proceso + "</p></div>";
      //html += "<div class='col-lg-12'>" + obj.data[U].id_usu;
    }

    html += '<br>';
    $("#hsentr").html(html);
  });
}
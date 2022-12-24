"use strict";

//Funciones para convertir miniscula en mayuscula
function mayus(e) {
  e.value = e.value.toUpperCase();
}

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
    onFinished: function onFinished(event, currentIndex) {}
  });
});

function opendefectuoso() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#datadefctuoso').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4, 5]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE VALE DE OFICINA',
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
    "ajax": "../controller/php/condefectuoso.php"
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
}

$(document).ready(function () {
  $('#busccodimem').load('./select/buscarttras.php');
  $('#busccodigomem2').load('./select/buscarme2.php');
  $('#buspedidodef').load('./select/buscpedef.php');
});

function addmatdefctuoso() {
  //alert("entro agregar vale de producción");
  var refe_1 = document.getElementById('dffolio').value;
  var fecha = document.getElementById('dffecha').value;
  var descripcion_1 = document.getElementById('dfmotivo').value;
  var proveedor_cliente = document.getElementById('dfcliente').value;
  var codigo_1 = document.getElementById('mcodigotr').value;
  var cantidad_real = document.getElementById('vpcantidad').value;
  var salida = document.getElementById('vpcantidad').value;
  var observa = document.getElementById('dfbservo').value;
  var refe_3 = document.getElementById('estadodef').value;
  var refe_2 = document.getElementById('dffdeped').value; //let ubicacion = document.getElementById('pedidomem').value;
  //let caracter = document.getElementById('vpcaracter').value;
  //multiselect de pedido-----

  var tPrfil = '';
  var selectObject = document.getElementById("dfmotivo");

  for (var i = 0; i < selectObject.options.length; i++) {
    if (selectObject.options[i].selected == true) {
      tPrfil += ',' + selectObject.options[i].value;
    }
  }

  ubicacion = tPrfil.substr(1);
  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&descripcion_1=' + descripcion_1 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_3=' + refe_3 + '&opcion=registrar'; //alert(datos);

  if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
    document.getElementById('vaciosvp').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosvp').style.display = 'none';
    }, 2000);
    return;
  } else {}
}
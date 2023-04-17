"use strict";

function opencompras() {
  //alert("pruebas");
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
      messageTop: 'RESUMEN DE COMPRAS',
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
    "ajax": "../controller/php/concompras.php"
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

function foliocompras() {
  var tipo = "COMPRAS"; //--------------------------

  var datos = 'tipo=' + tipo + '&opcion=gefolio'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertcompras.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      setTimeout("location.href = 'new_shop.php';", 1500);
    } else if (respuesta == 2) {} else {
      //alert(respuesta);
      Swal.fire({
        type: 'warning',
        text: 'Contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
} //Funciones para convertir miniscula en mayuscula


function mayus(e) {
  e.value = e.value.toUpperCase();
}

function openew() {
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
        // alert("entro");
        var refe_1 = document.getElementById('cmfolio').value;
        var fecha = document.getElementById('cmfecha').value;
        var fecha2 = document.getElementById('cmfechaent').value;
        var proveedor = document.getElementById('cmprovedd').value; //alert(datos);

        if (refe_1 == '' || fecha == '' || fecha2 == '' || proveedor == '') {
          document.getElementById('cmvaciosdf').style.display = '';
          setTimeout(function () {
            document.getElementById('cmvaciosdf').style.display = 'none';
          }, 2000);
          return;
        } else {
          //alert(respuesta);
          Swal.fire({
            type: 'success',
            text: 'Se AGREGO la orden de compra de forma correcta',
            showConfirmButton: false,
            timer: 2000
          });
          setTimeout("location.href = 'compras.php';", 1500);
        }
      }
    });
  });
  $(document).ready(function () {
    $('#buscarticulos').load('./select/busartped.php');
    $('#buscarticulosprv').load('./select/buscarartshop.php');
    $('#busccodigomem2').load('./select/buscarme2.php');
    $('#buspedidodef').load('./select/buscpedef.php');
    $('#dffdeped').select2();
    $('#dfcliente').select2(); //$('#pedmatdef').load('./select/buscpedef.php');
  });
}

function updacompras() {
  //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
  document.getElementById('mcodigotr').value = "";
  document.getElementById('mdecriptr').value = "";
  document.getElementById('vpcantidad').value = "";
  document.getElementById('dfbservo').value = "";
  document.getElementById('mprvedd').value = ""; //INFORMACION DE LAS TBLAS

  var folio = document.getElementById('cmfolio').value; //alert(folio);

  $.ajax({
    url: '../controller/php/infshop.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    //alert(resp);
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      x++;
      var id_compras = obj.data[U].id_comp;
      html += "<tr><td>" + obj.data[U].id_comp + "</td><td>" + obj.data[U].artcodigo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observación + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarartcm(" + id_compras + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithcompas'>Editar</a><a class='nav-link' onclick='deletenewartcm(" + id_compras + ");' data-toggle='modal' data-target='#modal-delearcmnew'>Eliminar</a>" + "</td></tr>";
    }

    html += '</div></tbody></table></div></div>';
    $("#listarcomprs").html(html);
  });
} //AGREGA ARTICULOS


function addartcompr() {
  //alert("entro agregar vale de producción");
  var folio_oc = document.getElementById('cmfolio').value;
  var fecha = document.getElementById('cmfecha').value;
  var fecha_entrga = document.getElementById('cmfechaent').value;
  var id_proveedor = document.getElementById('cmprovedd').value;
  var uso_CFDI = document.getElementById('cmusocfdi').value;
  var cond_pago = document.getElementById('condi_pago').value;
  var asignado = document.getElementById('cmasing').value;
  var id_articulo = document.getElementById('mcodigotr').value;
  var id_artprove = document.getElementById('mprvedd').value;
  var cantidad = document.getElementById('vpcantidad').value;
  var observación = document.getElementById('dfbservo').value;
  var datos = 'folio_oc=' + folio_oc + '&fecha=' + fecha + '&fecha_entrga=' + fecha_entrga + '&id_proveedor=' + id_proveedor + '&uso_CFDI=' + uso_CFDI + '&cond_pago=' + cond_pago + '&asignado=' + asignado + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=registrar'; //alert(datos);

  if (folio_oc == '' || fecha == '' || id_proveedor == '' || uso_CFDI == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
    document.getElementById('vaciosdf').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosdf').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertcompras.php",
      data: datos
    }).done(function (respuesta) {
      //alert(respuesta);
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updacompras();
      } else if (respuesta == 2) {
        document.getElementById('cmdublidf').style.display = '';
        setTimeout(function () {
          document.getElementById('cmdublidf').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('cmerrdf').style.display = '';
        setTimeout(function () {
          document.getElementById('cmerrdf').style.display = 'none';
        }, 1000);
        alert(respuesta);
      }
    });
  }
} //CANCELADO


function cancelar() {
  var folio_oc = document.getElementById('cmfolio').value;
  var datos = 'folio_oc=' + folio_oc + '&opcion=cancelar';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertcompras.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se cancelelo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'compras.php';", 1500);
    } else if (respuesta == 2) {
      document.getElementById('dublidf').style.display = '';
      setTimeout(function () {
        document.getElementById('dublidf').style.display = 'none';
      }, 1000); //alert("datos repetidos");
    } else {
      document.getElementById('cmerrdf').style.display = '';
      setTimeout(function () {
        document.getElementById('cmerrdf').style.display = 'none';
      }, 1000);
    }
  });
} //ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN 


function editarartcm(idedimp) {
  //alert(idedimp);
  var folio = idedimp;
  document.getElementById('id_cmedith1').value = idedimp;
  $.ajax({
    url: '../controller/php/compartinf.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    //alert(respuesta);
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_comp == idedimp) {
        //alert("entro");
        document.getElementById('cmpnewvpedi').value = obj.data[C].id_articulo;
        document.getElementById('cmedithdes').value = obj.data[C].artdescrip;
        document.getElementById('cmprovcod').value = obj.data[C].id_artprove; //codigo2

        document.getElementById('cmedithprvdes').value = obj.data[C].descrip_proveedor; //descripción

        document.getElementById('cmedithcant').value = obj.data[C].cantidad;
        document.getElementById('cmedithobsv').value = obj.data[C].observación;
        document.getElementById('cmedithdept').value = obj.data[C].artubicac;
      }
    }
  });
}

function dettcompras(id_produc) {
  //alert(id_produc);
  $("#detalles").toggle(250); //Muestra contenedor de detalles

  $("#lista").toggle("fast"); //Oculta lista

  document.getElementById('ordncompras').innerHTML = id_produc; //INFO CABECERA DE ORDEN DE COMPRAS

  $.ajax({
    url: '../controller/php/infcabeshop.php',
    type: 'GET',
    data: 'folio=' + id_produc
  }).done(function (respuesta) {
    //alert(respuesta);
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].folio_oc == id_produc) {
        alert("respuesta");
        document.getElementById('datecomp').value = obj.data[C].fecha;
        document.getElementById('datentrega').value = obj.data[C].fecha_entrga;
        document.getElementById('proveedcm').value = obj.data[C].id_proveedor;
      }
    }
  }); //INFO DE ARTICULOS 

  $.ajax({
    url: '../controller/php/infcompras.php',
    type: 'GET',
    data: 'folio=' + id_produc
  }).done(function (resp) {
    //alert(resp);
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      x++;
      var id_valepro = obj.data[U].id_kax;
      html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observación + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsmt1(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithmtdefc1'>Editar</a><a class='nav-link' onclick='deletenewart1(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearmtnew1'>Eliminar</a>" + "</td></tr>";
    }

    html += '</div></tbody></table></div></div>';
    $("#listcompras").html(html);
  });
}

function deletenewartcm(id_delete) {
  //alert(id_delete);
  //alert(id_delete);
  var folio = id_delete;
  document.getElementById('del_artcmnew').value = id_delete;
  $.ajax({
    url: '../controller/php/compartinf.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_comp == id_delete) {
        //alert("entro");
        document.getElementById('deartcmnew').value = obj.data[C].id_articulo + ' / ' + obj.data[C].id_artprove;
      }
    }
  });
}

function editartcompr() {
  document.getElementById('closedithcomp').style.display = "";
  document.getElementById('openedithcomp').style.display = "none";
  document.getElementById('saveedithshop').style.display = "";
  document.getElementById('cmprovcod').disabled = false;
  document.getElementById('cmpnewvpedi').disabled = false;
  document.getElementById('cmedithcant').disabled = false;
  document.getElementById('cmedithobsv').disabled = false;
}

function closeditartcompr() {
  document.getElementById('closedithcomp').style.display = "none";
  document.getElementById('openedithcomp').style.display = "";
  document.getElementById('saveedithshop').style.display = "none";
  document.getElementById('cmprovcod').disabled = true;
  document.getElementById('cmpnewvpedi').disabled = true;
  document.getElementById('cmedithcant').disabled = true;
  document.getElementById('cmedithobsv').disabled = true;
} //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS EN PEDIDOS


function saveedithshop() {
  var folio_oc = document.getElementById('cmfolio').value;
  var idarti = document.getElementById('id_cmedith1').value;
  var id_articulo = document.getElementById('cmpnewvpedi').value;
  var id_artprove = document.getElementById('cmprovcod').value;
  var cantidad = document.getElementById('cmedithcant').value;
  var observación = document.getElementById('cmedithobsv').value;
  var datos = 'folio_oc=' + folio_oc + '&idarti=' + idarti + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=updateart'; //alert(datos);

  if (folio_oc == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
    document.getElementById('vaciosdf').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosdf').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertcompras.php",
      data: datos
    }).done(function (respuesta) {
      //alert(respuesta);
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego el articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updacompras();
        closeditartcompr();
        $('#modal-edithcompas').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {
        document.getElementById('cmdublidf').style.display = '';
        setTimeout(function () {
          document.getElementById('cmdublidf').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('cmerrdf').style.display = '';
        setTimeout(function () {
          document.getElementById('cmerrdf').style.display = 'none';
        }, 1000);
        alert(respuesta);
      }
    });
  }
} //GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION


function savadeleartcm() {
  var idarti = document.getElementById('del_artcmnew').value;
  var id_articulo = document.getElementById('cmpnewvpedi').value;
  var folio_oc = document.getElementById('cmfolio').value;
  var datos = 'idarti=' + idarti + '&id_articulo=' + id_articulo + '&folio_oc=' + folio_oc + '&opcion=deleartnew'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertcompras.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se elimino de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      updacompras();
      $('#modal-delearcmnew').modal('hide'); //cierra el modal
      // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
    } else {
      document.getElementById('delerarcmnew').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarcmnew').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
}
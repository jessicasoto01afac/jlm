"use strict";

//Funciones para convertir miniscula en mayuscula
function mayus(e) {
  e.value = e.value.toUpperCase();
} //fucnion que cambia a elegir el tipo de vale_oficina


function openvalofic() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#datavaleofi').DataTable({
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
    "ajax": "../controller/php/convaleoficin.php"
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

function tipevale() {
  //alert("entro el vale");
  tipo = document.getElementById("vtipo").value;
  interno = document.getElementById("personal");
  ventas = document.getElementById("departamento");
  precio = document.getElementById("precio");
  total = document.getElementById("total");

  if (tipo == 'INTERNO') {
    //alert(tipo);
    interno.style.display = 'none';
    precio.style.display = 'none';
    total.style.display = 'none';
    ventas.style.display = '';
  }

  if (tipo == 'VENTA') {
    interno.style.display = '';
    total.style.display = '';
    precio.style.display = '';
    ventas.style.display = 'none';
  }
} //funcion para agregar el total


function totalvo() {
  cantidad1 = document.getElementById("vcantidad").value;
  precio1 = document.getElementById("vprecio").value;
  total1 = document.getElementById("vtotal");
  total1.value = cantidad1 * precio1;
} //funcion para agregar vale


function addvaleofi() {
  //alert("entra");
  var refe_1 = document.getElementById('vfolio').value; //FOLIO DEL VALE

  var fecha = document.getElementById('vfecha').value;
  var refe_3 = document.getElementById('vtipo').value;
  var proveedor_cliente = document.getElementById('vdep').value + document.getElementById('vprove').value;
  var codigo_1 = document.getElementById('vcodigo').value;
  var descripcion_1 = document.getElementById('vdescrip').value;
  var cantidad_real = document.getElementById('vcantidad').value;
  var salida = document.getElementById('vcantidad').value;
  var observa = document.getElementById('observo').value;
  var costo = document.getElementById('vprecio').value;
  var total = document.getElementById('vtotal').value;
  var ubicacion = document.getElementById('vdepart').value;
  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&costo=' + costo + '&total=' + total + '&ubicacion=' + ubicacion + '&opcion=registrar'; //var datos =$('#personal-ext').serialize();
  //alert(datos);

  if (document.getElementById('vfolio').value == '' || document.getElementById('vfecha').value == '' || document.getElementById('vtipo').value == '' || proveedor_cliente == '' || document.getElementById('vcodigo').value == '' || document.getElementById('vdescrip').value == '' || document.getElementById('vcantidad').value == '' || document.getElementById('vprecio').value == '') {
    document.getElementById('vaciosvo').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosvo').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego articulo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updateadd();
        limpiaradd();
      } else if (respuesta == 2) {
        document.getElementById('dublivo').style.display = '';
        setTimeout(function () {
          document.getElementById('dublivo').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('errvo').style.display = '';
        setTimeout(function () {
          document.getElementById('errvo').style.display = 'none';
        }, 1000);
      }
    });
  }
} //funcion de limpiar datos


function limpiaradd() {
  document.getElementById('vcodigo').value = "";
  document.getElementById('vdescrip').value = "";
  document.getElementById('vcantidad').value = "";
  document.getElementById('observo').value = "";
  document.getElementById('vdepart').value = "";
} //función actualizar al agregar articulo en alta de vales de oficina


function updateadd() {
  var folio = document.getElementById('vfolio').value; //alert(folio);

  $.ajax({
    url: '../controller/php/valeofi.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper"><table style="width:100%" id="datavaofi1" name="datavaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].refe_1 == folio) {
        x++;
        $id_valeofi = obj.data[U].id_kax;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo(" + $id_valeofi + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavo'>Editar</a><a onclick='delartvalofiadd(" + $id_valeofi + ");' class='nav-link' data-toggle='modal' data-target='#modal-deletevalofi'>Eliminar</a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#listvaleofi").html(html);
    'use strict';

    $('#datavaofi1').DataTable({
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
} //FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR ALTA DE VALE DE OFICINA


function delartvalofiadd(id_valeofic) {
  ; //alert("entra ELIMINAR articulo");

  document.getElementById('del_artvoalt').value = id_valeofic; //alert(memfi);

  var folio = id_valeofic;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == id_valeofic) {
        datos = obj.data[U].codigo_1;
        var d = datos.split("*");
        $("#modal-deletevalofi #deartvoal").val(d[0]);
      }
    }
  });
} //FUNCION QUE GUARDA LA ELIMINACIÓN DEL ARTICULO EN ALTA DE VALES DE OFICINA


function savdelevoal() {
  ; //alert("entra ELIMINAR articulo");

  var id_kax = document.getElementById('del_artvoalt').value;
  var refe_1 = document.getElementById('vfolio').value;
  var datos = '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=delinfarm'; //alert(datos);

  if (id_kax == '') {
    document.getElementById('edthmemaciosin').style.display = '';
    setTimeout(function () {
      document.getElementById('edthmemaciosin').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se elimino de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updateadd(); //llama a la función para actualizar la tabla

        $('#modal-deletevalofi').modal('hide'); //cierra el modal
      } else {
        document.getElementById('delerarvoal').style.display = '';
        setTimeout(function () {
          document.getElementById('delerarvoal').style.display = 'none';
        }, 2000);
      }
    });
  }
} //--------------------------------VALE DE OFICINA---------------------------------------------------------------------
//Funcion para habilitar los input de edición de algun articulo


function editvo() {
  //alert("editusuarios");
  document.getElementById('openedivo').style.display = "none";
  document.getElementById('closeditvo').style.display = "";
  document.getElementById('edicovo').disabled = false;
  document.getElementById('edithdesvo').disabled = true;
  document.getElementById('editcavo').disabled = false;
  document.getElementById('ediobservo').disabled = false;
  document.getElementById('voguardar').style.display = "";
}

function closedthvo() {
  //alert("cerrarusu");
  document.getElementById('openedivo').style.display = "";
  document.getElementById('closeditvo').style.display = "none";
  document.getElementById('edicovo').disabled = true;
  document.getElementById('edithdesvo').disabled = true;
  document.getElementById('editcavo').disabled = true;
  document.getElementById('ediobservo').disabled = true;
  document.getElementById('voguardar').style.display = "none";
} //FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS


function editarvo(id_valeofi) {
  //alert(id_valeofi);
  document.getElementById('id_vo').value = id_valeofi;
  var folio = id_valeofi;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == id_valeofi) {
        datos = obj.data[U].codigo_1 + '*' + obj.data[U].artdescrip + '*' + obj.data[U].salida + '*' + obj.data[U].id_kax + '*' + obj.data[U].observa;
        var d = datos.split("*");
        $("#modal-editavo #edicovo").val(d[0]);
        $("#modal-editavo #edithdesvo").val(d[1]);
        $("#modal-editavo #editcavo").val(d[2]);
        $("#modal-editavo #id_vo").val(d[3]);
        $("#modal-editavo #ediobservo").val(d[4]);
      }
    }
  });
} //FUNCION QUE GUARDA LA EDICIÓN DE VALES DE OFICINA EN AGREGAR ARTICULOS 


function savearvo() {
  var codigo_1 = document.getElementById('edicovo').value;
  var descripcion_1 = document.getElementById('edithdesvo').value;
  var salida = document.getElementById('editcavo').value;
  var observa = document.getElementById('ediobservo').value;
  var id_kax = document.getElementById('id_vo').value;
  var datos = 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&opcion=actualizar'; //alert(datos);

  if (document.getElementById('edicovo').value == '' || document.getElementById('edithdesvo').value == '' || document.getElementById('editcavo').value == '' || document.getElementById('id_vo').value == '') {
    document.getElementById('edthvovacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvovacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updateadd();
        closedthvo();
        $('#modal-editavo').modal('hide'); //cierra el modal
      } else if (respuesta == 2) {
        document.getElementById('edthdvobli').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdvobli').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvoerr').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvoerr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //funcion para traer la informacion del vale 10102022


function infvale(foliovale) {
  //alert("entra vale");
  var autorizar = document.getElementById('btnautorizv');
  var liberar = document.getElementById('btnliberarv');
  var surtir = document.getElementById('btnsurtirv');
  var finalizado = document.getElementById('btnfinalizv');
  var autorizado = document.getElementById('openedivo1');
  var editar = document.getElementById('openedivo1'); //alert(foliovale);
  //alert(id_vofi);

  document.getElementById('fvofi').innerHTML = foliovale;
  $("#detalles").toggle(250); //Muestra contenedor 

  $("#lista").toggle("fast"); //Oculta lista

  var folio = foliovale;
  $.ajax({
    url: '../controller/php/valepofigruop.php',
    type: 'GET',
    data: 'folio=' + foliovale
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      document.getElementById('relajlvof').value = obj.data[U].revision;
      datos = obj.data[U].fecha + '*' + obj.data[U].refe_3 + '*' + obj.data[U].proveedor_cliente + '*' + obj.data[U].status + '*' + obj.data[U].codigo_1;
      var o = datos.split("*");
      $("#detalles #infecvo").val(o[0]);
      $("#detalles #inftipevo").val(o[1]);
      $("#detalles #infsolivo").val(o[2]);
      $("#detalles #infestavo").val(o[3]); //---------------------------------ESTATUS-------------------------

      if (obj.data[U].status == 'PENDIENTE') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + foliovale
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th style="width:20%;"><i></i>ESTATUS</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            autorizar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = '';
            document.getElementById('openedivo1').style.display = '';
            document.getElementById('pdfvofi').style.display = 'none';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Pendiente de autorizar' class=''>PENDIENTES</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex = obj.data[D].id_kax;
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'AUTORIZADO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + foliovale
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            surtir.style.display = '';
            liberar.style.display = '';
            autorizado.style.display = 'none';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              idkardex = obj.data[D].id_kax;
              estatus = "<button onclick='surtirvof(" + idkardex + ");' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' style='font-size:12px;cursor: pointer;' class='btn btn-info mg-b-10'>SURTIR</button>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' style='font-size:12px;cursor: pointer;' data-target='#modal-surtido'>SURTIDO</span>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex2 = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex2 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'SURTIDO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + foliovale
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            finalizado.style.display = '';
            liberar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              estatus = "<span title='ya fue surtido no puede hacer ninguna accion' class=''>PENDIENTE</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex3 = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex3 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'FINALIZADO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + foliovale
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            liberar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              estatus = "<span title='ya fue finalizado no puede hacer ninguna accion' class=''>PENDIENTE</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex4 = obj.data[D].id_kax;
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex4 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      }
    }
  });
} //FUNCION PARA EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function editvaleof() {
  //alert("EDITAR VALE");
  var fecha = $("#infecvo").removeAttr("readonly");
  var tipo = $("#infsolivo").removeAttr("readonly");
  document.getElementById('inftipevo').disabled = false;
  document.getElementById('infestavo').disabled = false;
  document.getElementById('voagartic').style.display = "";
  document.getElementById('voedith').style.display = "";
  document.getElementById('closevoed').style.display = "";
  document.getElementById('openedivo1').style.display = "none";
} //FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION


function closedithvo() {
  //alert("cierra VALE");
  var fecha1 = $("#infecvo").attr("readonly", "readonly");
  var tipo1 = $("#infsolivo").attr("readonly", "readonly");
  document.getElementById('inftipevo').disabled = true;
  document.getElementById('infestavo').disabled = true;
  document.getElementById('voagartic').style.display = "none";
  document.getElementById('voedith').style.display = "none";
  document.getElementById('closevoed').style.display = "none";
  document.getElementById('openedivo1').style.display = "";
} //FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DEL VALE DE OFICINA EN VISTA PREVIA 


function savevofic() {
  var fecha = document.getElementById('infecvo').value;
  var refe_3 = document.getElementById('inftipevo').value;
  var status = document.getElementById('infestavo').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var proveedor_cliente = document.getElementById('infsolivo').value;
  var datos = 'fecha=' + fecha + '&refe_3=' + refe_3 + '&status=' + status + '&refe_1=' + refe_1 + '&proveedor_cliente=' + proveedor_cliente + '&opcion=cambio'; //alert(datos);

  if (document.getElementById('infecvo').value == '' || document.getElementById('inftipevo').value == '' || document.getElementById('infestavo').value == '' || document.getElementById('fvofi').value == '' || document.getElementById('infsolivo').value == '') {
    document.getElementById('edthvoivacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvoivacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
      } else if (respuesta == 2) {
        document.getElementById('edthvoiexi').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvoiexi').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvoierror').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvoierror').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE ACTIVA LOS INPUTS DEPENDIENTO DE TIPO DE VALE VISTA PREVIA


function masarticvo() {
  //alert("entro el vale");
  tipo = document.getElementById("inftipevo").value;
  precio = document.getElementById("precio");
  total = document.getElementById("total");

  if (tipo == 'INTERNO') {
    //alert(tipo);
    precio.style.display = 'none';
    total.style.display = 'none';
  }

  if (tipo == 'VENTA') {
    total.style.display = '';
    precio.style.display = '';
  }
} //FUNCION PARA AGREAGR ARTICULO A UN VALE DE OFICINA YA CREADO VUISTA PREVIA


function addartivo() {
  //alert("entra");
  var refe_1 = document.getElementById('fvofi').innerHTML; //FOLIO DEL VALE

  var fecha = document.getElementById('infecvo').value;
  var refe_3 = document.getElementById('inftipevo').value;
  var proveedor_cliente = document.getElementById('infsolivo').value;
  var codigo_1 = document.getElementById('vcodigo1').value;
  var descripcion_1 = document.getElementById('vdescrip1').value;
  var cantidad_real = document.getElementById('vcantidad1').value;
  var salida = document.getElementById('vcantidad1').value;
  var observa = document.getElementById('observo1').value;
  var costo = document.getElementById('vprecio1').value;
  var total = document.getElementById('vtotal1').value;
  var ubicacion = document.getElementById('vdepart1').value;
  var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&costo=' + costo + '&total=' + total + '&ubicacion=' + ubicacion + '&opcion=registrar'; //var datos =$('#personal-ext').serialize();
  //alert(datos);

  if (document.getElementById('fvofi').value == '' || document.getElementById('infecvo').value == '' || document.getElementById('inftipevo').value == '' || proveedor_cliente == '' || document.getElementById('vcodigo1').value == '' || document.getElementById('vdescrip1').value == '' || document.getElementById('vcantidad1').value == '' || document.getElementById('vprecio1').value == '') {
    //alert("vacios");
    document.getElementById('edthvovacios1').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvovacios1').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        reloout();
        document.getElementById('vcodigo1').value = '';
        document.getElementById('vcantidad1').value = '';
        document.getElementById('observo1').value = '';
        document.getElementById('vdescrip1').value = '';
        document.getElementById('vdepart1').value = '';
      } else if (respuesta == 2) {
        document.getElementById('edthdvobli1').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdvobli1').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvoerr1').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvoerr1').style.display = 'none';
        }, 1000);
      }
    });
  }
} //funcion para agregar el total en vista previa de vale oficina


function agtotalvo() {
  cantidad1 = document.getElementById("vcantidad1").value;
  precio1 = document.getElementById("vprecio1").value;
  total1 = document.getElementById("vtotal1");
  total1.value = cantidad1 * precio1;
} //funcion para activar edición de articulos en vista previa de vale de oficina


function editvoinf1() {
  //alert("edit articulo infovale");
  document.getElementById('openedivoinf').style.display = "none";
  document.getElementById('closeditvoinf').style.display = "";
  document.getElementById('edicovoinf').disabled = false;
  document.getElementById('vprecioinf').disabled = false;
  document.getElementById('infobsere').disabled = false;
  document.getElementById('edithdesvoinf').disabled = false;
  document.getElementById('editcavoinf').disabled = false;
  document.getElementById('voguardarinf').style.display = "";
  document.getElementById('editdepinf').disabled = false;
  document.getElementById('vtotalinf').disabled = false;
} //funcion para cerrar edición de articulos en vista previa de vale de oficina


function closedthvoinf1() {
  //alert("cerrar articulo info vale");
  document.getElementById('openedivoinf').style.display = "";
  document.getElementById('closeditvoinf').style.display = "none";
  document.getElementById('edicovoinf').disabled = true;
  document.getElementById('vprecioinf').disabled = true;
  document.getElementById('edithdesvoinf').disabled = true;
  document.getElementById('infobsere').disabled = true;
  document.getElementById('editcavoinf').disabled = true;
  document.getElementById('voguardarinf').style.display = "none";
  document.getElementById('editdepinf').disabled = true;
  document.getElementById('vtotalinf').disabled = true;
} //FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS


function editarvoinf(idkardex) {
  ; //alert(idkardex);
  //trae los input dependiendo si es venta o interno

  tipo = document.getElementById("inftipevo").value;
  precio = document.getElementById("precioinf");
  total = document.getElementById("totalinf");

  if (tipo == 'INTERNO') {
    //alert(tipo);
    precio.style.display = 'none';
    total.style.display = 'none';
  }

  if (tipo == 'VENTA') {
    // alert(tipo);
    total.style.display = '';
    precio.style.display = '';
  } //alert("entra editar articulo");


  document.getElementById('id_voin').value = idkardex; //alert(valofi1);

  var folio = idkardex;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == idkardex) {
        datos = obj.data[U].codigo_1 + '*' + obj.data[U].descripcion_1 + '*' + obj.data[U].cantidad_real + '*' + obj.data[U].ubicacion + '*' + obj.data[U].costo + '*' + obj.data[U].total + '*' + obj.data[U].observa;
        var d = datos.split("*");
        $("#modal-editavoinf #edicovoinf").val(d[0]);
        $("#modal-editavoinf #edithdesvoinf").val(d[1]);
        $("#modal-editavoinf #editcavoinf").val(d[2]);
        $("#modal-editavoinf #editdepinf1").val(d[3]);
        $("#modal-editavoinf #vprecioinf").val(d[4]);
        $("#modal-editavoinf #vtotalinf").val(d[5]);
        $("#modal-editavoinf #infobsere").val(d[6]);
      }
    }
  });
} //FUNCION PARA AGREGAR TOTAL EN EDICIÓN EN VISTA PREVIA VALE DE OFICINA


function totalvoinfe() {
  cantidad1 = document.getElementById("editcavoinf").value;
  precio1 = document.getElementById("vprecioinf").value;
  total1 = document.getElementById("vtotalinf");
  total1.value = cantidad1 * precio1;
} //FUNCION QUE GUARDA LA EDICIÓN DE VALES DE OFICINA EN INFORMACION DE VALE DE OFICINA


function savecamvo() {
  var codigo_1 = document.getElementById('edicovoinf').value;
  var descripcion_1 = document.getElementById('edithdesvoinf').value;
  var salida = document.getElementById('editcavoinf').value;
  var cantidad_real = document.getElementById('editcavoinf').value;
  var costo = document.getElementById('vprecioinf').value;
  var total = document.getElementById('vtotalinf').value;
  var observa = document.getElementById('infobsere').value;
  var id_kax = document.getElementById('id_voin').value;
  var refe_1 = document.getElementById('fvofi').innerHTML; //CONDICIÓN PARA SABER SI SE SURTIO O NO HAY EXISTENCIAS EN LA EDICIÓN

  if (salida > "0") {
    var estatus2 = "SURTIDO";
  } else if (salida == "0") {
    var estatus2 = "SIN EXISTENCIAS";
  }

  var datos = 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + +'&cantidad_real=' + cantidad_real + '&costo=' + costo + '&total=' + total + '&observa=' + observa + '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&estatus2=' + estatus2 + '&opcion=actualiza'; //alert(datos);

  if (document.getElementById('edicovoinf').value == '' || document.getElementById('edithdesvoinf').value == '' || document.getElementById('editcavoinf').value == '' || document.getElementById('vprecioinf').value == '' || document.getElementById('vtotalinf').value == '') {
    document.getElementById('edthvovaciosin').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvovaciosin').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        reloout(); //llama a la función para actualizar la tabla

        $('#modal-editavoinf').modal('hide'); //cierra el modal

        closedthvoinf1();
      } else if (respuesta == 2) {
        document.getElementById('edthdvoblinf').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdvoblinf').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthvoerrinf').style.display = '';
        setTimeout(function () {
          document.getElementById('edthvoerrinf').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION LLAMR DE NUEVO A LA TABLA  11102022


function reloout() {
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var folio = document.getElementById('fvofi').innerHTML;
  var autorizar = document.getElementById('btnautorizv');
  var liberar = document.getElementById('btnliberarv');
  var surtir = document.getElementById('btnsurtirv');
  var finalizado = document.getElementById('btnfinalizv');
  var autorizado = document.getElementById('openedivo1');
  var editar = document.getElementById('openedivo1');
  $.ajax({
    url: '../controller/php/valepofigruop.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      document.getElementById('relajlvof').value = obj.data[U].revision;
      datos = obj.data[U].fecha + '*' + obj.data[U].refe_3 + '*' + obj.data[U].proveedor_cliente + '*' + obj.data[U].status + '*' + obj.data[U].codigo_1;
      var o = datos.split("*");
      $("#detalles #infecvo").val(o[0]);
      $("#detalles #inftipevo").val(o[1]);
      $("#detalles #infsolivo").val(o[2]);
      $("#detalles #infestavo").val(o[3]); //---------------------------------ESTATUS-------------------------

      if (obj.data[U].status == 'PENDIENTE') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + folio
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th style="width:20%;"><i></i>ESTATUS</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            autorizar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = '';
            document.getElementById('openedivo1').style.display = '';
            document.getElementById('pdfvofi').style.display = 'none';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Pendiente de autorizar' class=''>PENDIENTES</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex5 = obj.data[D].id_kax;
              idkardex = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex5 + ")' data-toggle='modal' data-target='#modal-sinexivp class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf(" + idkardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf(" + idkardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + estatus + "</td><td class='dropdown hidden-xs-down'>" + acciones + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'AUTORIZADO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + folio
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            surtir.style.display = '';
            liberar.style.display = '';
            autorizado.style.display = 'none';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              idkardex = obj.data[D].id_kax;
              estatus = "<button onclick='surtirvof(" + idkardex + ");' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex6 = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex6 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"; //acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>"

              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'SURTIDO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + folio
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            finalizado.style.display = '';
            liberar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              estatus = "<span title='ya fue surtido no puede hacer ninguna accion' class=''>PENDIENTE</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              var _id_kardex7 = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex7 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      } else if (obj.data[U].status == 'FINALIZADO') {
        $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'GET',
          data: 'folio=' + folio
        }).done(function (resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th style=""><i></i>ESTATUS</th></tr></thead><tbody>';

          for (D = 0; D < res.length; D++) {
            liberar.style.display = '';
            autorizado.style.display = '';
            editar.style.display = 'none';
            document.getElementById('openedivo1').style.display = 'none';
            document.getElementById('pdfvofi').style.display = '';
            x++;

            if (obj.data[D].status_2 == "PENDIENTE") {
              estatus = "<span title='ya fue finalizado no puede hacer ninguna accion' class=''>PENDIENTE</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SURTIDO') {
              var id_kardex = obj.data[D].id_kax;
              estatus = "<span title='Ya fue surtido' onclick='infsurti(" + id_kardex + ")' title='Ya fue surtido' class='spandis' data-toggle='modal' data-target='#modal-surtido'>SURTIDO</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            } else if (obj.data[D].status_2 == 'SIN EXISTENCIAS') {
              idkardex = obj.data[D].id_kax;
              var _id_kardex8 = obj.data[D].id_kax;
              estatus = "<span title='Ver detalles' onclick='infonosur(" + _id_kardex8 + ")' data-toggle='modal' data-target='#modal-sinexivp' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
              acciones = "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>";
              html += "<tr><td>" + x + "</td><td>" + obj.data[D].codigo_1 + "</td><td>" + obj.data[D].descripcion_1 + "</td><td>" + obj.data[D].observa + "</td><td>" + obj.data[D].cantidad_real + "</td><td>" + obj.data[D].salida + "</td><td>" + estatus + "</td></tr>";
            }
          }

          html += '</div></tbody></table></div>';
          $("#listvaleofi1").html(html);
          'use strict';
        });
      }
    }
  });
} //FUNCION PARA QUE TRAIGA LA INFOMACION DE EL ARTICULO EN VALE DE OFICINA INFO


function delartvoinf(idkardex) {
  ; //alert(idkardex);

  document.getElementById('del_artvo').value = idkardex; //alert(valofi1);

  var folio = idkardex;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == idkardex) {
        datos = obj.data[U].codigo_1;
        var d = datos.split("*");
        $("#modal-deleteartvo #deartvo").val(d[0]);
      }
    }
  });
} //FUNCION QUE GUARDA LA ELIMINACION DEL ARTICULOS DE VALE DE OFICINA


function savedelarvo() {
  var id_kax = document.getElementById('del_artvo').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('deartvo').value;
  var datos = 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-deleteartvo').modal('hide');
      reloout(); //llama a la función para actualizar la tabla
    } else {
      document.getElementById('delerarvoinf').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvoinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION QUE TOMAR EL FOLIO DE EL VALE DE OFIINA


function deletvolis() {
  $("#datavaleofi tr").on('click', function () {
    var id_vale = "";
    id_vale += $(this).find('td:eq(1)').html(); //Toma el id de la persona 

    document.getElementById('devaofi').value = id_vale; //alert(id_vale)
  });
} //FUNCION QUE GUARDA LA ELIMINACIÓN DE VALE DE OFICINA


function savedevol() {
  var refe_1 = document.getElementById('devaofi').value;
  var datos = 'refe_1=' + refe_1 + '&opcion=deletevolis'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'vale_oficina.php';", 1500);
    } else {
      document.getElementById('delerrvo').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrvo').style.display = 'none';
      }, 2500);
    }
  });
} //FUNCION QUE GUARDA 


function surtirvof(idkardex) {
  //alert("sie entro");
  document.getElementById('id_surtvof').value = idkardex; //alert(valofi1);

  var folio = idkardex;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == idkardex) {
        datos = obj.data[U].codigo_1 + '*' + obj.data[U].descripcion_1 + '*' + obj.data[U].salida;
        var d = datos.split("*");
        $("#modal-surtirvof #arsurvof").val(d[0]);
        $("#modal-surtirvof #edithsertg").val(d[1]);
        $("#modal-surtirvof #surtavoinf").val(d[2]);
      }
    }
  });
} //FUNCION DE EDITAR SURTIR


function survof() {
  //alert("edit articulo infovale");
  document.getElementById('arsurvof').disabled = false;
  document.getElementById('edithdesvoinf').disabled = false;
  document.getElementById('surtavoinf').disabled = false;
  document.getElementById('surbsere').disabled = false; //document.getElementById('codigosur').disabled= false;

  document.getElementById('surtirvof').style.display = "none";
  document.getElementById('closeditvoinf4').style.display = ""; // document.getElementById('voguardarsur').style.display="";
} //FUNCION PARA CERRAR SURTIR


function closesurvof() {
  //alert("edit articulo infovale");
  document.getElementById('arsurvof').disabled = true;
  document.getElementById('edithdesvoinf').disabled = true;
  document.getElementById('surtavoinf').disabled = true;
  document.getElementById('surbsere').disabled = true; //document.getElementById('codigosur').disabled= true;

  document.getElementById('surtirvof').style.display = "";
  document.getElementById('closeditvoinf4').style.display = "none";
} //FUNCION PARA MARCAR SIN EXISTENCIAS 


function sinexisten() {
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvof').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('arsurvof').value;
  var datos = 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=sinexistencia';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtirvof').modal('hide');
      reloout();
    } else {
      document.getElementById('delerarvoinf').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvoinf').style.display = 'none';
      }, 2000);
    }
  });
} //FUNCION PARA MARCAR SURTIR


function acsurtirvof() {
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvof').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('arsurvof').value;
  var cantidad = document.getElementById('surtavoinf').value;
  var descripcion = document.getElementById('edithsertg').value;
  var datos = 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&cantidad=' + cantidad + '&descripcion=' + descripcion + '&opcion=surtir'; //alert(datos)

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se actualizo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      $('#modal-surtirvof').modal('hide'); //08052022

      reloout();
    } else {
      document.getElementById('delerarvoinf').style.display = '';
      setTimeout(function () {
        document.getElementById('delerarvoinf').style.display = 'none';
      }, 2000);
    }
  });
}

function infonosur(id_kardex) {
  //  alert(id_kardex);
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + id_kardex
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      if (obj.data[U].id_kax == id_kardex) {
        if (document.getElementById('infestavo').value == "SURTIDO" || document.getElementById('infestavo').value == "FINALIZADO") {
          document.getElementById('descsinvp').innerHTML = obj.data[U].codigo_1 + " / " + obj.data[U].descripcion_1;
          document.getElementById('cartsinvp').innerHTML = obj.data[U].salida;
          document.getElementById('opstsinvp').innerHTML = obj.data[U].observa_dep;
          document.getElementById('idsinexvp').value = obj.data[U].id_kax; //inpus e edición

          document.getElementById('cnsinvp').value = obj.data[U].salida;
          document.getElementById('obdepsinvp').value = obj.data[U].observa_dep; //oculta la edición

          document.getElementById('opesurt1sn').style.display = "none";
        } else {
          document.getElementById('descsinvp').innerHTML = obj.data[U].codigo_1 + " / " + obj.data[U].descripcion_1;
          document.getElementById('cartsinvp').innerHTML = obj.data[U].salida;
          document.getElementById('opstsinvp').innerHTML = obj.data[U].observa_dep;
          document.getElementById('idsinexvp').value = obj.data[U].id_kax; //inpus e edición

          document.getElementById('cnsinvp').value = obj.data[U].salida;
          document.getElementById('obdepsinvp').value = obj.data[U].observa_dep; //oculta la edición

          document.getElementById('opesurt1sn').style.display = "";
        }
      }
    }
  });
}

function closemodnosui() {
  $('#modal-nosurtido').modal('hide');
} //FUNCIÓN DE AUTORIZAR VALE 


function autorizarvo() {
  //alert("entra memo");
  var folio = document.getElementById('fvofi').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=autorizarval'; //alert(datos);

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
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'vale_oficina.php';", 1500);
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
          text: 'Error contactar a soporte tecnico',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIÓN DE SURTIR MEMO 


function surtirvo() {
  //alert("entra surtir ememo");
  var folio = document.getElementById('fvofi').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=surtirval'; // alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'No hay folio',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'vale_oficina.php';", 1500);
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
          text: 'Error contactar a soporte tecnico',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIÓN DE FINALIZAR MEMO 


function finalivo() {
  //alert("entra finalizar ememo");
  var folio = document.getElementById('fvofi').innerHTML; //FOLIO DEL MEMO

  var datos = 'folio=' + folio + '&opcion=finalmem'; //alert(datos);

  if (folio == '') {
    Swal.fire({
      type: 'warning',
      text: 'No hay folio',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertvaleofi.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'vale_oficina.php';", 1500);
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
          text: 'Error contactar a soporte tecnico',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
} //FUNCIONES DE GUARDAR ELIMINAR


function libervo() {
  //alert("memos"); 
  var valeof = document.getElementById('fvofi').innerHTML;
  var datos = 'valeof=' + valeof + '&opcion=liberarvof'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE LIBERO FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'vale_oficina.php';", 1500);
    } else {
      document.getElementById('delerrvo').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrvo').style.display = 'none';
      }, 2500);
    }
  });
} //CANCELAR ALTA DE MEMOS


function cancelarvo() {
  //alert("entra cancelar");
  var refe_1 = document.getElementById('vfolio').value;
  var datos = 'refe_1=' + refe_1 + '&opcion=cancelar';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'Se cancelelo de forma correcta',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'vale_oficina.php';", 1500);
    } else if (respuesta == 2) {//alert("datos repetidos");
    } else {
      Swal.fire({
        type: 'warning',
        text: 'Contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
} //FUNCION PARA AGREGAR UN NUEVO FOLIO EN ALTA DE VALE DE OFICINA


function foliovalofi() {
  //alert("entra folios");
  var tipo = "VALE_OFICINA";
  var datos = 'tipo=' + tipo + '&opcion=gefolio'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      setTimeout("location.href = 'newvaleofi.php';", 1500);
    } else {
      alert(respuesta);
      Swal.fire({
        type: 'warning',
        text: 'Contactar a soporte tecnico',
        showConfirmButton: false,
        timer: 1500
      });
    }
  });
} //FUNCION QUE GUARDA LA RELACCION JLM


function saverevicionvof() {
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var revision = document.getElementById('relajlvof').value;
  var datos = 'revision=' + revision + '&refe_1=' + refe_1 + '&opcion=revisionac'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
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
      document.getElementById('edthmmvacios').style.display = '';
      setTimeout(function () {
        document.getElementById('edthmmvacios').style.display = 'none';
      }, 1000); //alert("datos repetidos");
    } else {
      document.getElementById('edthmmerror').style.display = '';
      setTimeout(function () {
        document.getElementById('edthmmerror').style.display = 'none';
      }, 2000); //alert(respuesta);
    }
  });
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
      if (obj.data[D].artcodigo == document.getElementById('edicovo').value) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip + '*' + obj.data[D].artubicac;
        var o = datos.split("*");
        $("#edithdesvo").val(o[1]);
      }
    }
  });
} //FUNCIÓN PARA REVISAR EL ARTICULO SURTIDO


function infsurti(id_valeprodu) {
  //alert("entro");
  //alert(id_valeprodu);
  var folio = id_valeprodu;
  document.getElementById('idsurt').value = id_valeprodu;
  $.ajax({
    url: '../controller/php/valeofinfo.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_kax == id_valeprodu) {
        if (document.getElementById('infestavo').value == "SURTIDO" || document.getElementById('infestavo').value == "FINALIZADO") {
          //alert("entro");
          document.getElementById('descsurt').innerHTML = obj.data[C].codigo_1 + " / " + obj.data[C].artdescrip;
          document.getElementById('cartsur').innerHTML = obj.data[C].salida;
          document.getElementById('opstsur').innerHTML = obj.data[C].observa_dep; //inpus e edición

          document.getElementById('cnsurt').value = obj.data[C].salida;
          document.getElementById('obdepinf').value = obj.data[C].observa_dep; //oculta la edición

          document.getElementById('opesurt1').style.display = "none";
        } else {
          //alert("entro2");
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
} //FUNCION PARA GUARDAR EDITAR SURTIR


function savesurtvp() {
  //alert("entro vales");
  var id_kax = document.getElementById('idsurt').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
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
    url: "../controller/php/insertvaleofi.php",
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
      reloout();
      closedithsurt();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
} //ABRE EDICION DE MODAL SIN EXISTENCIA


function openedithsnex() {
  document.getElementById('editarsinvp').style.display = "";
  document.getElementById('infsursn').style.display = "none";
  document.getElementById('opesurt1sn').style.display = "none";
  document.getElementById('clossurt1sn').style.display = ""; //document.getElementById('cnsinvp').value = 0;
} //CIERRA EDICION DE MODAL SIN EXISTENCIA


function closedithsnex() {
  document.getElementById('editarsinvp').style.display = "none";
  document.getElementById('infsursn').style.display = "";
  document.getElementById('opesurt1sn').style.display = "";
  document.getElementById('clossurt1sn').style.display = "none";
} //FUNCION PARA GUARDAR EDITAR SIN EXISTENCIAS EXTENDIDO Y ETIQUETAS


function savesinextvp() {
  //alert("savesinextvp");
  var id_kax = document.getElementById('idsinexvp').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var cantidad = document.getElementById('cnsinvp').value;
  var observa_dep = document.getElementById('obdepsinvp').value;
  var descrip = document.getElementById('descsinvp').innerHTML; //alert("entro vales2");

  var status2 = "SURTIDO"; //Condición de cambiar status2 si es mayor a 0

  if (document.getElementById('cnsinvp').value > 0) {
    status2 = "SURTIDO";
  }

  if (document.getElementById('cnsinvp').value == 0) {
    status2 = "SIN EXISTENCIAS";
  }

  var datos = 'id_kax=' + id_kax + '&descrip=' + descrip + '&observa_dep=' + observa_dep + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&status2=' + status2 + '&opcion=edthsurtir'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertvaleofi.php",
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
      reloout();
      closedithsurt();
      closedithsnex();
    } else {
      document.getElementById('edthvperrinf').style.display = '';
      setTimeout(function () {
        document.getElementById('edthvperrinf').style.display = 'none';
      }, 2000);
    }
  });
}

function histvaleofi() {
  var folio = document.getElementById('fvofi').innerHTML;
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
  var folio = document.getElementById('fvofi').innerHTML;
  alert(folio);
  url = '../formatos/pdf_valeoficina.php';
  window.open(url + "?data=" + folio, '_black');
}

function pdfhistory() {
  var folio = document.getElementById('fvofi').innerHTML; //alert("entro");

  url = '../formatos/pdf_reporthistoryvaleofi.php';
  window.open(url + "?data=" + folio, '_black');
}
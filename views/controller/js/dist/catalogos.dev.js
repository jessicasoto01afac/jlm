"use strict";

//Funciones para convertir miniscula en mayuscula
function mayus(e) {
  e.value = e.value.toUpperCase();
} //--------------------------------USUARIOS---------------------------------------------------------------------
//Funcion para abrir formulario de usuarios


function usuarios() {
  $.ajax({
    url: '../controller/php/conusuarios.php',
    type: 'POST'
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="rounded table-responsive"><table style="width:100%;" id="datausuarios" name="datausuarios" class="table display dataTable no-footer"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>NOMBRE</th><th style="width:100px;"><i></i>CORREO</th><th><i></i>USUARIO</th><th><i></i>PRIVILEGIOS</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      x++;
      id_per = "este es la person"; //indentificacion de la person

      html += "<tr><td>" + obj.data[U].id_per + "</td><td>" + obj.data[U].usunom + " " + obj.data[U].usuapell + "</td><td>" + obj.data[U].correo + "</td><td>" + obj.data[U].usuario + "</td><td>" + obj.data[U].privilegios + "</td><td>" + "<a onclick='editar()' style='cursor:pointer;' title='Editar' class='btn btn-primary btn-icon' data-toggle='modal' data-target='#modal-editusu'><div><i style='color:white;' class='fa fa-pencil-square-o'></i></div></a>  <a onclick='deletusu()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target='#modal-deleteusu'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";
    }

    html += '</div></tbody></table></div></div>';
    $("#listusu").html(html);
    'use strict';

    $('#datausuarios').DataTable({
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
        },
        dom: 'Bfrtip',
        buttons: ['print']
      }
    });
  });
  $('.dataTables_length select').select2({
    minimumResultsForSearch: Infinity
  });
  $(function () {
    'use strict';

    $('#datatable1').DataTable({
      responsive: true,
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page'
      }
    });
    $('#datatable2').DataTable({
      bLengthChange: false,
      searching: false,
      responsive: true
    }); // Select2

    $('.dataTables_length select').select2({
      minimumResultsForSearch: Infinity
    });
  });
} //Funcion para habilitar los input de edición de usuarios


function editusuarios() {
  //alert("editusuarios");
  document.getElementById('openedius').style.display = "none";
  document.getElementById('closeditus').style.display = "";
  document.getElementById('edinom').disabled = false;
  document.getElementById('ediapell').disabled = false;
  document.getElementById('editcorre').disabled = false;
  document.getElementById('editusu1').disabled = false;
  document.getElementById('editcontra').disabled = false;
  document.getElementById('editprivi').disabled = false;
  document.getElementById('usuguardar').style.display = "";
}

function closeusu() {
  //alert("cerrarusu");
  document.getElementById('openedius').style.display = "";
  document.getElementById('closeditus').style.display = "none";
  document.getElementById('edinom').disabled = true;
  document.getElementById('ediapell').disabled = true;
  document.getElementById('editcorre').disabled = true;
  document.getElementById('editusu1').disabled = true;
  document.getElementById('editcontra').disabled = true;
  document.getElementById('editprivi').disabled = true;
  document.getElementById('usuguardar').style.display = "none";
} //FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS


function editar() {
  $("#datausuarios tr").on('click', function () {
    var id_persona = "";
    id_persona += $(this).find('td:eq(0)').html(); //Toma el id de la persona 

    document.getElementById('id_per').value = id_persona;
    $.ajax({
      url: '../controller/php/conusuarios.php',
      type: 'POST'
    }).done(function (respuesta) {
      obj = JSON.parse(respuesta);
      var res = obj.data;
      var x = 0;

      for (U = 0; U < res.length; U++) {
        if (obj.data[U].id_per == id_persona) {
          // alert(id_persona);
          datos = obj.data[U].usunom + '*' + obj.data[U].usuapell + '*' + obj.data[U].correo + '*' + obj.data[U].usuario + '*' + obj.data[U].password + '*' + obj.data[U].privilegios + '*' + obj.data[U].activo;
          var d = datos.split("*");
          $("#modal-editusu #edinom").val(d[0]);
          $("#modal-editusu #ediapell").val(d[1]);
          $("#modal-editusu #editcorre").val(d[2]);
          $("#modal-editusu #editusu1").val(d[3]);
          $("#modal-editusu #editcontra").val(d[4]);
          $("#modal-editusu #editprivi").val(d[5]);
        }
      }
    });
  });
} //FUNCION QUE GUARDA LA EDICIÓN DE USUARIOS


function saveusuedit() {
  var usunom = document.getElementById('edinom').value;
  var usuapell = document.getElementById('ediapell').value;
  var correo = document.getElementById('editcorre').value;
  var usuario = document.getElementById('editusu1').value;
  var password = document.getElementById('editcontra').value;
  var privilegios = document.getElementById('editprivi').value;
  var id_per = document.getElementById('id_per').value;
  var datos = 'usunom=' + usunom + '&usuapell=' + usuapell + '&correo=' + correo + '&usuario=' + usuario + '&password=' + password + '&privilegios=' + privilegios + '&id_per=' + id_per + '&opcion=actualizar'; //alert(datos);

  if (document.getElementById('edinom').value == '' || document.getElementById('ediapell').value == '' || document.getElementById('editusu1').value == '' || document.getElementById('editcontra').value == '' || document.getElementById('editprivi').value == '') {
    document.getElementById('edthvacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/insertusu.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'usuarios.php';", 1500);
      } else if (respuesta == 2) {
        document.getElementById('edthdubli').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdubli').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edtherr').style.display = '';
        setTimeout(function () {
          document.getElementById('edtherr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE ELIMINAR A UN USUARIO


function deletusu() {
  $("#datausuarios tr").on('click', function () {
    var id_persona = "";
    id_persona += $(this).find('td:eq(0)').html(); //Toma el id de la persona 

    document.getElementById('del_per').value = id_persona; //alert(id_persona)

    $.ajax({
      url: '../controller/php/conusuarios.php',
      type: 'POST'
    }).done(function (respuesta) {
      obj = JSON.parse(respuesta);
      var res = obj.data;
      var x = 0;

      for (D = 0; D < res.length; D++) {
        if (obj.data[D].id_per == id_persona) {
          // alert(id_persona);
          datos = obj.data[D].usunom + '*' + obj.data[D].usuapell;
          var o = datos.split("*");
          $("#modal-deleteusu #deusu").val(o[0] + ' ' + o[1]);
        }
      }
    });
  });
} //FUNCION QUE GUARDA LA EDICIÓN DE USUARIOS


function savedelusu() {
  var del_per = document.getElementById('del_per').value;
  var persona = document.getElementById('deusu').value;
  var datos = 'del_per=' + del_per + '&persona=' + persona + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/insertusu.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'usuarios.php';", 1500);
    } else {
      document.getElementById('delerr').style.display = '';
      setTimeout(function () {
        document.getElementById('delerr').style.display = 'none';
      }, 2500);
    }
  });
} //--------------------------------ARTICULOS---------------------------------------------------------------------
//agrega a base de datos de articulos


function addarticull() {
  // alert("entra agregar articulos");
  var artcodigo = document.getElementById('artcodigo').value;
  var artdescrip = document.getElementById('artdescrip').value;
  var artubicac = document.getElementById('artubicac').value;
  var artunidad = document.getElementById('artunidad').value;
  var artgrupo = document.getElementById('artgrupo').value;
  var stockinici = document.getElementById('stockini').value;
  var datos = 'artcodigo=' + artcodigo + '&stockinici=' + stockinici + '&artdescrip=' + artdescrip + '&artubicac=' + artubicac + '&artunidad=' + artunidad + '&artgrupo=' + artgrupo + '&opcion=registrar'; //alert(datos);

  if (document.getElementById('artcodigo').value == '' || document.getElementById('artdescrip').value == '' || document.getElementById('artubicac').value == '' || document.getElementById('artunidad').value == '' || document.getElementById('artgrupo').value == '' || document.getElementById('stockini').value == '') {
    document.getElementById('vaciosar').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosar').style.display = 'none';
    }, 1500);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertarticul.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
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
          cancelButtonText: '<a  class="a-alert" href="articulos.php"><span style="color: white;">Cerrar</span></a>',
          cancelButtonAriaLabel: 'Thumbs down' // timer: 2900

        });
      } else if (respuesta == 2) {
        document.getElementById('dubliar').style.display = '';
        setTimeout(function () {
          document.getElementById('dubliar').style.display = 'none';
        }, 1000);
      } else {
        document.getElementById('errar').style.display = '';
        setTimeout(function () {
          document.getElementById('errar').style.display = 'none';
        }, 2000);
        alert(respuesta);
      }
    }); //FIN DE AJAX
  }
} //Funcion para habilitar los input de edición de articulos


function editart() {
  //alert("editarticulos");
  document.getElementById('openedart').style.display = "none";
  document.getElementById('closeditar').style.display = "";
  document.getElementById('edicod').disabled = false;
  document.getElementById('edides').disabled = false;
  document.getElementById('editubi').disabled = false;
  document.getElementById('edituni').disabled = false;
  document.getElementById('editgrup').disabled = false;
  document.getElementById('edistockini').disabled = false;
  document.getElementById('artguardar').style.display = "";
} //Funcion para deshabilitar los input de edición de articulos


function closedthart() {
  //alert("close edith articul");
  document.getElementById('openedart').style.display = "";
  document.getElementById('closeditar').style.display = "none";
  document.getElementById('edicod').disabled = true;
  document.getElementById('edides').disabled = true;
  document.getElementById('editubi').disabled = true;
  document.getElementById('edituni').disabled = true;
  document.getElementById('editgrup').disabled = true;
  document.getElementById('edistockini').disabled = true;
  document.getElementById('artguardar').style.display = "none";
} //Funcion que trae los datos al modal editar articulo


function artedith(id_art) {
  //alert(id_art)
  document.getElementById('id_art').value = id_art;
  $.ajax({
    url: '../controller/php/conartindi.php',
    type: 'GET',
    data: 'folio=' + id_art
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (A = 0; A < res.length; A++) {
      if (obj.data[A].id_art == id_art) {
        document.getElementById('edistockini').value = obj.data[A].stock_inicial;
        datos = obj.data[A].artcodigo + '*' + obj.data[A].artdescrip + '*' + obj.data[A].artubicac + '*' + obj.data[A].artunidad + '*' + obj.data[A].artgrupo;
        var d = datos.split("*");
        $("#modal-editarticul #edicod").val(d[0]);
        $("#modal-editarticul #edides").val(d[1]);
        $("#modal-editarticul #editubi").val(d[2]);
        $("#modal-editarticul #edituni").val(d[3]);
        $("#modal-editarticul #editgrup").val(d[4]);
      }
    }
  });
} //Funcion que trae los datos al modal editar articulo


function savearedith() {
  //alert("deded");
  var artcodigo = document.getElementById('edicod').value;
  var artdescrip = document.getElementById('edides').value;
  var artubicac = document.getElementById('editubi').value;
  var artunidad = document.getElementById('edituni').value;
  var artgrupo = document.getElementById('editgrup').value;
  var id_art = document.getElementById('id_art').value;
  var edistockini = document.getElementById('edistockini').value;
  var datos = 'artcodigo=' + artcodigo + '&edistockini=' + edistockini + '&artdescrip=' + artdescrip + '&artubicac=' + artubicac + '&artunidad=' + artunidad + '&artgrupo=' + artgrupo + '&id_art=' + id_art + '&opcion=actualizara'; //alert(datos);

  if (document.getElementById('edicod').value == '' || document.getElementById('edides').value == '' || document.getElementById('editubi').value == '' || document.getElementById('edituni').value == '' || document.getElementById('editgrup').value == '' || document.getElementById('edistockini').value == '') {
    document.getElementById('edthvaciar').style.display = '';
    setTimeout(function () {
      document.getElementById('edthvaciar').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertarticul.php",
      data: datos
    }).done(function (respuesta) {
      //alert(respuesta);
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        closedthart();
        setTimeout("location.href = 'articulos.php';", 1500);
      } else if (respuesta == 2) {
        document.getElementById('edthdubli').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdubli').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edtherr').style.display = '';
        setTimeout(function () {
          document.getElementById('edtherr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE TRAE LOS DATOS A  ELIMINAR A UN ARTICULO


function deletart(id_art) {
  document.getElementById('del_art').value = id_art; //alert(id_art);

  $.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_art == id_art) {
        // alert(id_persona);
        datos = obj.data[D].artcodigo + '*' + obj.data[D].artdescrip;
        var o = datos.split("*");
        $("#modal-deleteart #deart").val(o[0]);
      }
    }
  });
} //FUNCION QUE GUARDA ELIMINAR ARTICULOS


function savedeart() {
  var id_art = document.getElementById('del_art').value;
  var codigo = document.getElementById('deart').value;
  var datos = 'id_art=' + id_art + '&codigo=' + codigo + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertarticul.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'articulos.php';", 1500);
    } else {
      document.getElementById('delerar').style.display = '';
      setTimeout(function () {
        document.getElementById('delerar').style.display = 'none';
      }, 2500);
    }
  });
} //--------------------------------CLIENTES---------------------------------------------------------------------
//Funcion para habilitar los input de edición de clientes


function editcli() {
  //alert("editarticulos");
  document.getElementById('openedicli').style.display = "none";
  document.getElementById('closeditcli').style.display = "";
  document.getElementById('edicocli').disabled = false;
  document.getElementById('edithnom').disabled = false;
  document.getElementById('editrfc').disabled = false;
  document.getElementById('editcorrc').disabled = false;
  document.getElementById('clieguardar').style.display = "";
} //Funcion para deshabilitar los input de edición de clientes


function closedthcli() {
  //alert("close edith articul");
  document.getElementById('openedicli').style.display = "";
  document.getElementById('closeditcli').style.display = "none";
  document.getElementById('edicocli').disabled = true;
  document.getElementById('edithnom').disabled = true;
  document.getElementById('editrfc').disabled = true;
  document.getElementById('editcorrc').disabled = true;
  document.getElementById('clieguardar').style.display = "none";
} //Funcion que trae los datos al modal editar cliente


function clienedith(id_cliente) {
  document.getElementById('id_cli').value = id_cliente;
  var folio = id_cliente; //alert(id_cliente);

  $.ajax({
    url: '../controller/php/conclientes.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (C = 0; C < res.length; C++) {
      if (obj.data[C].id_cliente == id_cliente) {
        datos = obj.data[C].codigo_clie + '*' + obj.data[C].nombre + '*' + obj.data[C].rfc + '*' + obj.data[C].email;
        var d = datos.split("*");
        $("#modal-editclient #edicocli").val(d[0]);
        $("#modal-editclient #edithnom").val(d[1]);
        $("#modal-editclient #editrfc").val(d[2]);
        $("#modal-editclient #editcorrc").val(d[3]);
      }
    }
  });
} //Funcion que trae los guarda los datos actulizados de clientes


function savecliedith() {
  var codigo_clie = document.getElementById('edicocli').value;
  var nombre = document.getElementById('edithnom').value;
  var rfc = document.getElementById('editrfc').value;
  var email = document.getElementById('editcorrc').value;
  var id_cliente = document.getElementById('id_cli').value;
  var datos = 'codigo_clie=' + codigo_clie + '&nombre=' + nombre + '&rfc=' + rfc + '&email=' + email + '&id_cliente=' + id_cliente + '&opcion=actualizar'; //alert(datos);

  if (document.getElementById('edicocli').value == '' || document.getElementById('edithnom').value == '' || document.getElementById('editrfc').value == '') {
    document.getElementById('edthclivacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthclivacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertclient.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'clientes.php';", 1500);
      } else if (respuesta == 2) {
        document.getElementById('edthdclibli').style.display = '';
        setTimeout(function () {
          document.getElementById('edthdclibli').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthclierr').style.display = '';
        setTimeout(function () {
          document.getElementById('edthclierr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE TRAE LOS DATOS PARA ELIMINAR AL CLIENTE 24092022


function deletclient(del_clie) {
  document.getElementById('del_clie').value = del_clie;
  var folio = del_clie; //alert(del_clie);

  $.ajax({
    url: '../controller/php/conclientes.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_cliente == del_clie) {
        // alert(id_persona);
        datos = obj.data[D].nombre;
        var o = datos.split("*");
        $("#modal-deletecli #decli").val(o[0]);
      }
    }
  });
} //FUNCION QUE GUARDA ELIMINAR CLIENTE


function savedecli() {
  var id_cliente = document.getElementById('del_clie').value; //alert(id_cliente);

  var nombre = document.getElementById('decli').value;
  var datos = 'id_cliente=' + id_cliente + '&nombre=' + nombre + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertclient.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'clientes.php';", 1500);
    } else {
      document.getElementById('delerrcli').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrcli').style.display = 'none';
      }, 2500);
    }
  });
} //--------------------------------PROVEEDORES---------------------------------------------------------------------
//Funcion para habilitar los input de edición de clientes


function editprov() {
  document.getElementById('openeditpro').style.display = "none";
  document.getElementById('closeditpro').style.display = "";
  document.getElementById('editcodigo_pro').disabled = false;
  document.getElementById('editcondi_pago').disabled = false;
  document.getElementById('editnom_pro').disabled = false;
  document.getElementById('edithdomi_fisc').disabled = false;
  document.getElementById('edtcont_1').disabled = false;
  document.getElementById('edthtel_c1').disabled = false;
  document.getElementById('edithtel_c2').disabled = false;
  document.getElementById('edithemail_c1').disabled = false;
  document.getElementById('edithemail_c2').disabled = false;
  document.getElementById('edithcont_2').disabled = false;
  document.getElementById('edithtel_c3').disabled = false;
  document.getElementById('edithtel_c4').disabled = false;
  document.getElementById('edithemail_c3').disabled = false;
  document.getElementById('edithemail_c4').disabled = false;
  document.getElementById('edithcont_3').disabled = false;
  document.getElementById('edithtel_c5').disabled = false;
  document.getElementById('edithtel_c6').disabled = false;
  document.getElementById('edithemail_c5').disabled = false;
  document.getElementById('edithemail_c6').disabled = false;
  document.getElementById('edithobser_prov').disabled = false;
  document.getElementById('provguardar').style.display = "";
} //Funcion para deshabilitar los input de edición de clientes


function closedthpro() {
  document.getElementById('openeditpro').style.display = "";
  document.getElementById('closeditpro').style.display = "none";
  document.getElementById('editcodigo_pro').disabled = true;
  document.getElementById('editcondi_pago').disabled = true;
  document.getElementById('editnom_pro').disabled = true;
  document.getElementById('edithdomi_fisc').disabled = true;
  document.getElementById('edtcont_1').disabled = true;
  document.getElementById('edthtel_c1').disabled = true;
  document.getElementById('edithtel_c2').disabled = true;
  document.getElementById('edithemail_c1').disabled = true;
  document.getElementById('edithemail_c2').disabled = true;
  document.getElementById('edithcont_2').disabled = true;
  document.getElementById('edithtel_c3').disabled = true;
  document.getElementById('edithtel_c4').disabled = true;
  document.getElementById('edithemail_c3').disabled = true;
  document.getElementById('edithemail_c4').disabled = true;
  document.getElementById('edithcont_3').disabled = true;
  document.getElementById('edithtel_c5').disabled = true;
  document.getElementById('edithtel_c6').disabled = true;
  document.getElementById('edithemail_c5').disabled = true;
  document.getElementById('edithemail_c6').disabled = true;
  document.getElementById('edithobser_prov').disabled = true;
  document.getElementById('clieguardar').style.display = "none";
} //Funcion que trae los datos al modal editar articulo


function proveedith(id_prov) {
  document.getElementById('id_prov').value = id_prov;
  var folio = id_prov; //alert(id_prov);

  $.ajax({
    url: '../controller/php/conproveedores.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (P = 0; P < res.length; P++) {
      if (obj.data[P].id_prov == id_prov) {
        datos = obj.data[P].codigo_pro + '*' + obj.data[P].condi_pago + '*' + obj.data[P].nom_pro + '*' + obj.data[P].domi_fisc + '*' + obj.data[P].cont_1 + '*' + obj.data[P].tel_c1 + '*' + obj.data[P].tel_c2 + '*' + obj.data[P].email_c1 + '*' + obj.data[P].email_c2 + '*' + obj.data[P].cont_2 + '*' + obj.data[P].tel_c3 + '*' + obj.data[P].tel_c4 + '*' + obj.data[P].email_c3 + '*' + obj.data[P].email_c4 + '*' + obj.data[P].cont_3 + '*' + obj.data[P].tel_c5 + '*' + obj.data[P].tel_c6 + '*' + obj.data[P].email_c5 + '*' + obj.data[P].email_c6 + '*' + obj.data[P].obser_prov;
        var d = datos.split("*");
        $("#modal-editprov #editcodigo_pro").val(d[0]);
        $("#modal-editprov #editcondi_pago").val(d[1]);
        $("#modal-editprov #editnom_pro").val(d[2]);
        $("#modal-editprov #edithdomi_fisc").val(d[3]);
        $("#modal-editprov #edtcont_1").val(d[4]);
        $("#modal-editprov #edthtel_c1").val(d[5]);
        $("#modal-editprov #edithtel_c2").val(d[6]);
        $("#modal-editprov #edithemail_c1").val(d[7]);
        $("#modal-editprov #edithemail_c2").val(d[8]);
        $("#modal-editprov #edithcont_2").val(d[9]);
        $("#modal-editprov #edithtel_c3").val(d[10]);
        $("#modal-editprov #edithtel_c4").val(d[11]);
        $("#modal-editprov #edithemail_c3").val(d[12]);
        $("#modal-editprov #edithemail_c4").val(d[13]);
        $("#modal-editprov #edithcont_3").val(d[14]);
        $("#modal-editprov #edithtel_c5").val(d[15]);
        $("#modal-editprov #edithtel_c6").val(d[16]);
        $("#modal-editprov #edithemail_c5").val(d[17]);
        $("#modal-editprov #edithemail_c6").val(d[18]);
        $("#modal-editprov #edithobser_prov").val(d[19]);
      }
    }
  });
} //Funcion que trae los guarda los datos actualizados de proveedores


function saveprovedith() {
  var codigo_pro = document.getElementById('editcodigo_pro').value;
  var nom_pro = document.getElementById('editnom_pro').value;
  var domi_fisc = document.getElementById('edithdomi_fisc').value;
  var condi_pago = document.getElementById('editcondi_pago').value;
  var cont_1 = document.getElementById('edtcont_1').value;
  var tel_c1 = document.getElementById('edthtel_c1').value;
  var tel_c2 = document.getElementById('edithtel_c2').value;
  var email_c1 = document.getElementById('edithemail_c1').value;
  var email_c2 = document.getElementById('edithemail_c2').value;
  var cont_2 = document.getElementById('edithcont_2').value;
  var tel_c3 = document.getElementById('edithtel_c3').value;
  var tel_c4 = document.getElementById('edithtel_c4').value;
  var email_c3 = document.getElementById('edithemail_c3').value;
  var email_c4 = document.getElementById('edithemail_c4').value;
  var cont_3 = document.getElementById('edithcont_3').value;
  var tel_c5 = document.getElementById('edithtel_c5').value;
  var tel_c6 = document.getElementById('edithtel_c6').value;
  var email_c5 = document.getElementById('edithemail_c5').value;
  var email_c6 = document.getElementById('edithemail_c6').value;
  var obser_prov = document.getElementById('edithobser_prov').value;
  var id_prov = document.getElementById('id_prov').value;
  var datos = 'codigo_pro=' + codigo_pro + '&nom_pro=' + nom_pro + '&domi_fisc=' + domi_fisc + '&condi_pago=' + condi_pago + '&cont_1=' + cont_1 + '&tel_c1=' + tel_c1 + '&tel_c2=' + tel_c2 + '&email_c1=' + email_c1 + '&email_c2=' + email_c2 + '&cont_2=' + cont_2 + '&tel_c3=' + tel_c3 + '&tel_c4=' + tel_c4 + '&email_c3=' + email_c3 + '&email_c4=' + email_c4 + '&cont_3=' + cont_3 + '&tel_c5=' + tel_c5 + '&tel_c6=' + tel_c6 + '&email_c5=' + email_c5 + '&email_c6=' + email_c6 + '&obser_prov=' + obser_prov + '&id_prov=' + id_prov + '&opcion=actualizar'; //alert(datos);

  if (document.getElementById('editcodigo_pro').value == '' || document.getElementById('editnom_pro').value == '' || document.getElementById('edithdomi_fisc').value == '' || document.getElementById('editcondi_pago').value == '' || document.getElementById('editcondi_pago').value == '' || document.getElementById('edtcont_1').value == '' || document.getElementById('edthtel_c1').value == '') {
    document.getElementById('edthprovacios').style.display = '';
    setTimeout(function () {
      document.getElementById('edthprovacios').style.display = 'none';
    }, 2000);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertprove.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        setTimeout("location.href = 'provedores.php';", 1500);
      } else if (respuesta == 2) {
        document.getElementById('edthprove').style.display = '';
        setTimeout(function () {
          document.getElementById('edthprove').style.display = 'none';
        }, 1000); //alert("datos repetidos");
      } else {
        document.getElementById('edthproerr').style.display = '';
        setTimeout(function () {
          document.getElementById('edthproerr').style.display = 'none';
        }, 2000);
      }
    });
  }
} //FUNCION QUE TRAE LOS DATOS PARA ELIMINAR AL PROVEEDOR


function deletprov(del_prov) {
  document.getElementById('del_prov').value = del_prov; //alert(del_prov);

  var folio = del_prov;
  $.ajax({
    url: '../controller/php/conproveedores.php',
    type: 'POST',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_prov == del_prov) {
        // alert(id_persona);
        datos = obj.data[D].nom_pro;
        var o = datos.split("*");
        $("#modal-deleprov #deprov").val(o[0]);
      }
    }
  });
} //FUNCION QUE GUARDA ELIMINAR PROVEEDOR


function savedeprov() {
  var id_prov = document.getElementById('del_prov').value; //alert(id_prov);

  var nom_pro = document.getElementById('deprov').value;
  var datos = 'id_prov=' + id_prov + '&nom_pro=' + nom_pro + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertprove.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
      setTimeout("location.href = 'provedores.php';", 1500);
    } else {
      document.getElementById('delerrprov').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrprov').style.display = 'none';
      }, 2500);
    }
  });
} //--------------------------------TRANSFORMACIÓN---------------------------------------------------------------------
//Funcion para habilitar los input de edición de usuarios

/*function addtransform() { //08052022 agregar
    //alert("entra transform");
    let id_articulo_final = document.getElementById('vppcodigo').value;
    let id_extendido = document.getElementById('vpcodigoext').value;
    let id_etiquetas = document.getElementById('vpcodigoetiq').value;
    let hojas = document.getElementById('artdescriphojas').value;
    let divicion = document.getElementById('division').value;
    let carton = document.getElementById('cartonapl').value;
    let id_carton = document.getElementById('codcarton').value;
    let div_carton = document.getElementById('descarton').value;
    let multi_carton = document.getElementById('multcarton').value;
    let cartonsillo = document.getElementById('cartaplic').value;
    let id_cortonsillo = document.getElementById('codcartonsillo').value;
    let div_cartonsillo = document.getElementById('descartonsillo').value;
    let multi_cartonsillo = document.getElementById('multcartonsillo').value;
    let caple = document.getElementById('capleaplic').value;
    let id_caple = document.getElementById('codcaple').value;
    let div_caple = document.getElementById('descaple').value;
    let multi_caple = document.getElementById('multcaple').value;
    let liston_cordon = document.getElementById('listonaplic').value;
    let id_cordliston = document.getElementById('codliston').value;
    let multi_liston = document.getElementById('multliston').value;
    let minagris = document.getElementById('mingrisid').value;
    let multiminagris = document.getElementById('acntminagr').value;
    let hjmini = document.getElementById('acntminagrhj').value;
    //Comprobar si esta esta seleccionado
    if (carton == 'NO APLICA') {
        document.getElementById('cartonapl').value = 'NO APLICA';
        id_carton = 0;
        div_carton = 0;
        multi_carton = 0;
    }
    if (cartonsillo == 'NO APLICA') {
        cartonsillo.value = 'NO APLICA';
        id_cortonsillo = 0;
        div_cartonsillo = 0;
        multi_cartonsillo = 0;
    }
    if (caple == 'NO APLICA') {
        caple.value = 'NO APLICA';
        id_caple = 0;
        div_caple = 0;
        multi_caple = 0;
    }
    if (liston_cordon == 'NO APLICA') {
        liston_cordon.value = 'NO APLICA';
        id_cordliston = 0;
        multi_liston = 0;
    }

    if (carton == 0) {
        carton = 'NO APLICA';
        id_carton = 0;
        div_carton = 0;
        multi_carton = 0;
    }
    if (cartonsillo == 0) {
        cartonsillo = 'NO APLICA';
        id_cortonsillo = 0;
        div_cartonsillo = 0;
        multi_cartonsillo = 0;
    }
    if (caple == 0) {
        caple = 'NO APLICA';
        id_caple = 0;
        div_caple = 0;
        multi_caple = 0;
    }
    if (liston_cordon == 0) {
        liston_cordon = 'NO APLICA';
        id_cordliston = 0;
        multi_liston = 0;
    }

    let datos = 'id_articulo_final=' + id_articulo_final + '&id_extendido=' + id_extendido + '&id_etiquetas=' + id_etiquetas + '&hojas=' + hojas + '&divicion=' + divicion + '&carton=' + carton + '&id_carton=' + id_carton + '&div_carton=' + div_carton + '&multi_carton=' + multi_carton + '&cartonsillo=' + cartonsillo + '&id_cortonsillo=' + id_cortonsillo + '&div_cartonsillo=' + div_cartonsillo + '&multi_cartonsillo=' + multi_cartonsillo + '&caple=' + caple + '&id_caple=' + id_caple + '&div_caple=' + div_caple + '&multi_caple=' + multi_caple + '&liston_cordon=' + liston_cordon + '&id_cordliston=' + id_cordliston + '&multi_liston=' + multi_liston + '&minagris=' + minagris + '&multiminagris=' + multiminagris + '&hjmini=' + hjmini + '&opcion=registrar';
    //alert(datos);

    if (id_articulo_final == '' || id_extendido == '' || id_etiquetas == '' || hojas == '' || divicion == '') {
        document.getElementById('vaciosartras').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosartras').style.display = 'none';
        }, 1500);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertransf.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    title: 'JLM INFORMA',
                    text: 'LA TRANSFORMACIÓN SE AGREGO CORRECTAMENTE',
                    showCloseButton: false,
                    showCancelButton: true,
                    focusConfirm: false,
                    confirmButtonColor: "#1774D8",
                    customClass: 'swal-wide',
                    confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newtrasn.php">¿Deseas agregar otro articulo?</a></span>',
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText: '<a  class="a-alert" href="transformacion.php"><span style="color: white;">Cerrar</span></a>',
                    cancelButtonAriaLabel: 'Thumbs down'
                        // timer: 2900
                });
            } else if (respuesta == 2) {
                document.getElementById('dubliartras').style.display = ''
                setTimeout(function() {
                    document.getElementById('dubliartras').style.display = 'none';
                }, 1000);
            } else {
                document.getElementById('errartras').style.display = ''
                setTimeout(function() {
                    document.getElementById('errartras').style.display = 'none';
                }, 2000);
                alert(respuesta);
            }
        }); //FIN DE AJAX
    }
}*/


function addtransform() {
  var id_articulo_final = document.getElementById('vppcodigo').value;
  var datos = 'id_articulo_final=' + id_articulo_final + '&opcion=registrar'; //alert(datos);

  if (id_articulo_final == '' || id_articulo_final == '0') {
    document.getElementById('vaciosartras').style.display = '';
    setTimeout(function () {
      document.getElementById('vaciosartras').style.display = 'none';
    }, 1500);
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertransf.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          title: 'JLM INFORMA',
          text: 'LA TRANSFORMACIÓN SE AGREGO CORRECTAMENTE',
          showCloseButton: false,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonColor: "#1774D8",
          customClass: 'swal-wide',
          confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newtrasn.php">¿Deseas agregar otro articulo?</a></span>',
          confirmButtonAriaLabel: 'Thumbs up, great!',
          cancelButtonText: '<a  class="a-alert" href="transformacion.php"><span style="color: white;">Cerrar</span></a>',
          cancelButtonAriaLabel: 'Thumbs down' // timer: 2900

        });
      } else if (respuesta == 2) {
        document.getElementById('dubliartras').style.display = '';
        setTimeout(function () {
          document.getElementById('dubliartras').style.display = 'none';
        }, 1000);
      } else {
        document.getElementById('errartras').style.display = '';
        setTimeout(function () {
          document.getElementById('errartras').style.display = 'none';
        }, 2000);
        alert(respuesta);
      }
    }); //FIN DE AJAX
  }
} //FUNCION DONDE RECOLECTA LA INFORMACION DEL ARTICULO DE TRASFORMACION PARA EDITAR


function infolistrans(id_transform) {
  //alert(id_transform);
  document.getElementById('id_arttras').value = id_transform;
  $.ajax({
    url: '../controller/php/contrasforma.php',
    type: 'POST'
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_trans == id_transform) {
        (function () {
          // alert(id_persona)
          datos = obj.data[D].id_articfial + '*' + obj.data[D].id_extendido;
          var o = datos.split("*");
          $("#modal-edithtrans #edithartfin").val(o[0]);
          var id = document.getElementById('edithartfin').value; //alert(id);

          $.ajax({
            url: '../controller/php/infeditinftrasf.php',
            type: 'GET',
            data: 'id=' + id
          }).done(function (resp) {
            //alert(resp);
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="bd-gray-300 rounded table-responsive"><table disable style="width:100%; table-layout:" id="dateplusedith" name="dateplusedith" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>CLASE</th><th><i></i>MULTIPLICACION</th><th><i></i>DIVICIÓN</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

            for (U = 0; U < res.length; U++) {
              //estatus pendiente
              if (obj.data[U].id_articfial == id) {
                x++;
                $id_artic = obj.data[U].id_trans;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].type_art + "</td><td>" + obj.data[U].hojas + "</td><td>" + obj.data[U].division + "</td><td>" + "<a onclick='deletemascolor(" + $id_artic + ")' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";
              }
            }

            html += '</div></tbody></table></div></div>';
            $("#extraxcolortable").html(html);
          });
        })();
      }
    }
  });
} //FUNCION DE EDITAR ARTICULO DE RASFORMACION


function editrasnf() {
  //alert("editusuarios");
  document.getElementById('openeditrasfo').style.display = "none";
  document.getElementById('closetras').style.display = ""; // mas color 

  document.getElementById('masplus').style.display = "";
} //FUNCION DE CERRAR EDICIÓN ARTICULO DE RASFORMACION


function closetrans() {
  //alert("editusuarios");
  document.getElementById('openeditrasfo').style.display = "";
  document.getElementById('closetras').style.display = "none"; // mas color 

  document.getElementById('masplus').style.display = "none";
  document.getElementById('masplus').style.display = "none";
  document.getElementById('masplus2').style.display = "none";
  document.getElementById('masplus3').style.display = "none";
  document.getElementById('masplus4').style.display = "none";
  document.getElementById('masplusave').style.display = "none";
  document.getElementById('mastype').style.display = "none";
} //FUNCIÓN DE AGREGAR EN EDITAR


function addplusedit() {
  //alert("entra");
  document.getElementById('masplus').style.display = "";
  document.getElementById('masplus2').style.display = "";
  document.getElementById('masplus3').style.display = "";
  document.getElementById('masplus4').style.display = "";
  document.getElementById('masplusave').style.display = "";
  document.getElementById('mastype').style.display = "";
} //FUNCION DE ELIMINAR ARTICULO DE TRANSFORMACION


function deletransf(transf) {
  //alert(memos); 
  document.getElementById('detrasfor').value = transf;
  $("#transfomacion tr").on('click', function () {
    var articulo_termin = "";
    articulo_termin += $(this).find('td:eq(1)').html(); //Toma el id de la persona 

    document.getElementById('artras_dele').value = articulo_termin; //alert(id_persona)
  });
} //FUNCIONQUE GUARDA LA ELIMINACION DE ARTICULO DE TRASFORMACIÓN


function savdeletransf() {
  var id_transformacion = document.getElementById('artras_dele').value;
  var datos = 'id_transformacion=' + id_transformacion + '&opcion=eliminar'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertransf.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      setTimeout("location.href = 'transformacion.php';", 1000);
    } else {
      document.getElementById('delerrartras').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrartras').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  }); //FIN DE AJAX
} //FUNCIONQUE GUARDA LA EDICIÓN DE ARTICULO DE TRASFORMACIÓN


function savetraedit() {
  //alert("ENTRA GUARDAR EDICIÓN");
  var id_transformacion = document.getElementById('id_arttras').value;
  var id_articulo_final = document.getElementById('edithartfin').value;
  var id_extendido = document.getElementById('edithartext').value;
  var id_etiquetas = document.getElementById('editharetq').value;
  var hojas = document.getElementById('edithojas').value;
  var divicion = document.getElementById('editdivision').value;
  var carton = document.getElementById('cartonedt').value;
  var id_carton = document.getElementById('edthcarton').value;
  var div_carton = document.getElementById('eddivcarton').value;
  var multi_carton = document.getElementById('multcartonedt').value;
  var cartonsillo = document.getElementById('cartonsilledith').value;
  var id_cortonsillo = document.getElementById('edthcartonsillo').value;
  var div_cartonsillo = document.getElementById('eddivcartonsillo').value;
  var multi_cartonsillo = document.getElementById('multcartonsilloedt').value;
  var caple = document.getElementById('capleedith').value;
  var id_caple = document.getElementById('edthcaplecod').value;
  var div_caple = document.getElementById('eddivcaple').value;
  var multi_caple = document.getElementById('multcapleedt').value;
  var liston_cordon = document.getElementById('listonaplicedt').value;
  var id_cordliston = document.getElementById('codlistonedt').value;
  var multi_liston = document.getElementById('multlistonedt').value;
  var minagris1 = document.getElementById('mingriscd').value;
  var canminagras = document.getElementById('hjminag').value;
  var hojasmin = document.getElementById('catminagr').value; //27112022

  var datos = 'id_transformacion=' + id_transformacion + '&id_articulo_final=' + id_articulo_final + '&id_extendido=' + id_extendido + '&id_etiquetas=' + id_etiquetas + '&hojas=' + hojas + '&divicion=' + divicion + '&carton=' + carton + '&id_carton=' + id_carton + '&div_carton=' + div_carton + '&multi_carton=' + multi_carton + '&cartonsillo=' + cartonsillo + '&id_cortonsillo=' + id_cortonsillo + '&div_cartonsillo=' + div_cartonsillo + '&multi_cartonsillo=' + multi_cartonsillo + '&caple=' + caple + '&id_caple=' + id_caple + '&div_caple=' + div_caple + '&multi_caple=' + multi_caple + '&liston_cordon=' + liston_cordon + '&id_cordliston=' + id_cordliston + '&multi_liston=' + multi_liston + '&minagris1=' + minagris1 + '&canminagras=' + canminagras + '&hojasmin=' + hojasmin + '&opcion=actualizara'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertransf.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ACTUALIZO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      setTimeout("location.href = 'transformacion.php';", 1000);
    } else {
      document.getElementById('delerrartras').style.display = '';
      setTimeout(function () {
        document.getElementById('delerrartras').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  }); //FIN DE AJAX
}

function exportarusu() {
  con;
}

function carton() {
  //alert("entro el vale");
  var tipo = document.getElementById("cartonapl").value;
  var codigocart = document.getElementById("carton");
  var descricarton = document.getElementById("cartondes");
  var multicarton = document.getElementById("cartonmilt");

  if (tipo == 'NO APLICA') {
    //alert(tipo);
    codigocart.style.display = 'none';
    codigocart.style.value = '0';
    descricarton.style.display = 'none';
    descricarton.style.value = 'No aplica';
    multicarton.style.display = 'none';
  }

  if (tipo == 'APLICA') {
    codigocart.style.display = '';
    descricarton.style.display = '';
    multicarton.style.display = '';
  }
}

function cartonsillo() {
  //alert("entro el vale");
  var tipo = document.getElementById("cartaplic").value;
  var codigocartonsillo = document.getElementById("cartonsillo");
  var multiplic = document.getElementById("cartonsillomilt");
  var multicarton = document.getElementById("cartonsillodes");

  if (tipo == 'NO APLICA') {
    //alert(tipo);
    codigocartonsillo.style.display = 'none';
    multicarton.style.display = 'none';
    multiplic.style.display = 'none';
  }

  if (tipo == 'APLICA') {
    codigocartonsillo.style.display = '';
    multiplic.style.display = '';
    multicarton.style.display = '';
  }
} //funcion del Caple


function caple() {
  //alert("entro el vale");
  var tipo = document.getElementById("capleaplic").value;
  var codigocaple = document.getElementById("caple");
  var multiplic = document.getElementById("caplemilt");
  var multicaple = document.getElementById("capledes");

  if (tipo == 'NO APLICA') {
    //alert(tipo);
    codigocaple.style.display = 'none';
    codigocaple.style.value = '0';
    multicaple.style.display = 'none';
    multiplic.style.display = 'none';
  }

  if (tipo == 'APLICA') {
    codigocaple.style.display = '';
    multiplic.style.display = '';
    multicaple.style.display = '';
  }
} //funcion del liston


function liston() {
  //alert("entro el vale");
  var tipo = document.getElementById("listonaplic").value;
  var codigocaple = document.getElementById("liston");
  var multiplic = document.getElementById("listonmilt");

  if (tipo == 'NO APLICA') {
    //alert(tipo);
    codigocaple.style.display = 'none';
    codigocaple.style.value = '0';
    multiplic.style.display = 'none';
  }

  if (tipo == 'APLICA') {
    codigocaple.style.display = '';
    multiplic.style.display = '';
  }
} //FUNCIÓN QUE ACTIVA LOS ARTUCULOS EXTRA


function artextra() {
  //alert("entra articulo extra");
  var titulo = document.getElementById("xtra");
  var selecarton = document.getElementById("cartontex");
  var selecartonsillo = document.getElementById("cartonsitex");
  var selecaple = document.getElementById("caplearex");
  var seleliston = document.getElementById("listonarex");

  if ($('#artxtra').is(':checked')) {
    //alert("seleccionado");
    titulo.style.display = '';
    selecarton.style.display = '';
    selecartonsillo.style.display = '';
    selecaple.style.display = '';
    seleliston.style.display = '';
  } else {
    //alert("no seleccionado");
    titulo.style.display = 'none';
    selecarton.style.display = 'none';
    selecartonsillo.style.display = 'none';
    selecaple.style.display = 'none';
    seleliston.style.display = 'none';
  }
}

function addplus() {
  if ($('#pluscolor').is(':checked')) {
    //alert("seleccionado");
    document.getElementById("addpluscolor").style.display = "";
    document.getElementById("line").style.display = "";
  } else {
    //alert("no seleccionado");
    document.getElementById("addpluscolor").style.display = "none";
    document.getElementById("line").style.display = "none";
  }
}
/*function updateaddcolo() {
    let id = document.getElementById("vppcodigo").value;
    //data de colores
    $.ajax({
        url: '../controller/php/addtrasfo.php',
        type: 'GET',
        data: 'id=' + id
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;

        html = '<div class="bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="dateplus" name="dateplus" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>MULTIPLICACION</th><th><i></i>DIVICIÓN</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            //estatus pendiente
            if (obj.data[U].id_articulo_final == id) {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_extendido + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].hojas + "</td><td>" + obj.data[U].divicion + "</td><td>" + "<a onclick='deletemascolors()' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#datepluscolor").html(html);
    });
}*/


function updateaddcolo() {
  var id = document.getElementById("vppcodigo").value; //data de colores

  $.ajax({
    url: '../controller/php/addtrasfo.php',
    type: 'GET',
    data: 'id=' + id
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="dateplus" name="dateplus" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>CLASE</th><th><i></i>MULTIPLICACION</th><th><i></i>DIVICIÓN</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      //estatus pendiente
      if (obj.data[U].id_articfial == id) {
        x++;
        $id_artcfinl = obj.data[U].id_trans;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].type_art + "</td><td>" + obj.data[U].hojas + "</td><td>" + obj.data[U].division + "</td><td>" + "<a onclick='deletemascolors(" + $id_artcfinl + ")' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon' data-toggle='modal' data-target=''><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#datepluscolor").html(html);
  });
}
/*function saveaddplus() {
    //alert("agreagr");
    //alert("entra guardar cambios memeo");
    let final = document.getElementById('vppcodigo').value;
    let extendido = document.getElementById('vpcodigoext').value;
    let multiplic = document.getElementById('multiplicadd').value;
    let divicion = document.getElementById('divicionesadd').value;

    let datos = 'final=' + final + '&extendido=' + extendido + '&multiplic=' + multiplic + '&divicion=' + divicion + '&opcion=addcolors';
    //alert(datos);
    if (final == '' || extendido == '' || multiplic == '' || divicion == '') {
        Swal.fire({
            type: 'warning',
            text: 'LLENAR TODOS LOS CAMPOS OBLIGATORIOS',
            showConfirmButton: false,
            timer: 1500
        });
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertransf.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateaddcolo(); //llama a la función para actualizar la tabla ARREGLAR AQUI
                document.getElementById('multiplicadd').value = '';
                document.getElementById('divicionesadd').value = '';
            } else if (respuesta == 2) {
                Swal.fire({
                    type: 'warning',
                    text: 'EL ARTICULO YA ESTA AGREGADO A LA TRASFORMACIÓN',
                    showConfirmButton: false,
                    timer: 1500
                });
                //alert("datos repetidos");
            } else {
                Swal.fire({
                    type: 'danger',
                    text: 'Error contactar a Soporte tecnico o levantar un ticket',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    }

}*/


function saveaddplus() {
  //alert("agreagr");
  //alert("entra guardar cambios memeo");
  var _final = document.getElementById('vppcodigo').value;
  var extendido = document.getElementById('vpcodigoext').value;
  var multiplic = document.getElementById('multiplicadd').value;
  var divicion = document.getElementById('divicionesadd').value;
  var tipo = document.getElementById('type_art').value;
  var datos = 'final=' + _final + '&extendido=' + extendido + '&multiplic=' + multiplic + '&divicion=' + divicion + '&tipo=' + tipo + '&opcion=addarttrasf'; //alert(datos);

  if (_final == '' || extendido == '' || multiplic == '' || divicion == '' || tipo == '') {
    Swal.fire({
      type: 'warning',
      text: 'LLENAR TODOS LOS CAMPOS OBLIGATORIOS',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertransf.php",
      data: datos
    }).done(function (respuesta) {
      //alert(respuesta);
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updateaddcolo(); //llama a la función para actualizar la tabla ARREGLAR AQUI

        document.getElementById('multiplicadd').value = '';
        document.getElementById('divicionesadd').value = '';
        document.getElementById('214none').style.display = '';
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'EL ARTICULO YA ESTA AGREGADO A LA TRASFORMACIÓN',
          showConfirmButton: false,
          timer: 1500
        }); //alert("datos repetidos");
      } else {
        Swal.fire({
          type: 'danger',
          text: 'Error contactar a Soporte tecnico o levantar un ticket',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
}

function saveaddedith() {
  //alert("agreagr");
  //alert("entra guardar cambios memeo");
  var _final2 = document.getElementById('edithartfin').value;
  var extendido = document.getElementById('edithpusadd').value;
  var multiplic = document.getElementById('mltimascolor').value;
  var divicion = document.getElementById('divmasclo').value;
  var tipo = document.getElementById('type_artedth').value;
  var datos = 'final=' + _final2 + '&extendido=' + extendido + '&multiplic=' + multiplic + '&divicion=' + divicion + '&tipo=' + tipo + '&opcion=addarttrasedi'; //alert(datos);

  if (_final2 == '' || extendido == '' || multiplic == '' || divicion == '') {
    Swal.fire({
      type: 'warning',
      text: 'LLENAR TODOS LOS CAMPOS OBLIGATORIOS',
      showConfirmButton: false,
      timer: 1500
    });
    return;
  } else {
    $.ajax({
      type: "POST",
      url: "../controller/php/insertransf.php",
      data: datos
    }).done(function (respuesta) {
      if (respuesta == 0) {
        Swal.fire({
          type: 'success',
          text: 'Se agrego de forma correcta',
          showConfirmButton: false,
          timer: 1500
        });
        updatcoloredith(); //llama a la función para actualizar la tabla ARREGLAR AQUI

        document.getElementById('mltimascolor').value = '';
        document.getElementById('divmasclo').value = '';
      } else if (respuesta == 2) {
        Swal.fire({
          type: 'warning',
          text: 'EL ARTICULO YA ESTA AGREGADO A LA TRASFORMACIÓN',
          showConfirmButton: false,
          timer: 1500
        }); //alert("datos repetidos");
      } else {
        Swal.fire({
          type: 'danger',
          text: 'Error contactar a Soporte tecnico o levantar un ticket',
          showConfirmButton: false,
          timer: 1500
        });
      }
    });
  }
}

function updatcoloredith() {
  var id = document.getElementById("edithartfin").value; //data de colores

  $.ajax({
    url: '../controller/php/infeditinftrasf.php',
    type: 'GET',
    data: 'id=' + id
  }).done(function (resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="dateplusedith" name="dateplusedith" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>CLASE</th><th><i></i>MULTIPLICACION</th><th><i></i>DIVICIÓN</th><th><i></i>ACCIONES</th></tr></thead><tbody>';

    for (U = 0; U < res.length; U++) {
      //estatus pendiente
      if (obj.data[U].id_articfial == id) {
        x++;
        $id_artic = obj.data[U].id_trans;
        html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].type_art + "</td><td>" + obj.data[U].hojas + "</td><td>" + obj.data[U].division + "</td><td>" + "<a onclick='deletemascolor(" + $id_artic + ")' style='cursor:pointer;' title='Eliminar' class='btn btn-danger btn-icon'><div><i style='color:white;' class='fa fa-trash-o'></i></div></a>" + "</td></tr>";
      }
    }

    html += '</div></tbody></table></div></div>';
    $("#extraxcolortable").html(html);
  });
}

function deletemascolor($idcodiart) {
  //alert("BORRAR");
  //FUNCION DE ELIMINAR ARTICULO DE TRANSFORMACION
  var id_colorss = $idcodiart;
  var idtrans = document.getElementById('edithartfin').value;
  var datos = 'id_colorss=' + id_colorss + '&idtrans=' + idtrans + '&opcion=eliminarcolors'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertransf.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      updatcoloredith();
    } else {
      Swal.fire({
        type: 'danger',
        text: 'CONTACTAR A SOPORTE TECNICO O LEVANTAR UN TICKET',
        showConfirmButton: false,
        timer: 1000
      });
    }
  }); //FIN DE AJAX
}
/*function deletemascolors() {
    //alert("BORRAR");
    //FUNCION DE ELIMINAR ARTICULO DE TRANSFORMACION
    $("#datepluscolor tr").on('click', function() {
        let id_colorss = "";
        id_colorss += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
        //alert(id_colors);
        let idtrans = document.getElementById('vppcodigo').value;
        let datos = 'id_colorss=' + id_colorss + '&idtrans=' + idtrans + '&opcion=eliminarcolors';
        //alert(datos);
        $.ajax({
            type: "POST",
            url: "../controller/php/insertransf.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'SE ELIMINO DE FORMA CORRECTA',
                    showConfirmButton: false,
                    timer: 1000
                });
                updateaddcolo()
            } else {
                Swal.fire({
                    type: 'danger',
                    text: 'CONTACTAR A SOPORTE TECNICO O LEVANTAR UN TICKET',
                    showConfirmButton: false,
                    timer: 1000
                });
            }
        }); //FIN DE AJAX
    });
}*/


function deletemascolors($iddeletcols) {
  //alert("BORRAR");
  //FUNCION DE ELIMINAR ARTICULO DE TRANSFORMACION
  var id_colorss = $iddeletcols; //alert(id_colorss);

  var idtrans = document.getElementById('vppcodigo').value;
  var datos = 'id_colorss=' + id_colorss + '&idtrans=' + idtrans + '&opcion=eliminarcolors'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertransf.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      updateaddcolo();
    } else {
      Swal.fire({
        type: 'danger',
        text: 'CONTACTAR A SOPORTE TECNICO O LEVANTAR UN TICKET',
        showConfirmButton: false,
        timer: 1000
      });
    }
  }); //FIN DE AJAX
}

function canceladd() {
  document.getElementById('masplus').style.display = "";
  document.getElementById('masplus2').style.display = "none";
  document.getElementById('masplus3').style.display = "none";
  document.getElementById('masplus4').style.display = "none";
  document.getElementById('masplusave').style.display = "none";
  document.getElementById('mastype').style.display = "none";
}

function closeaddusu() {
  document.getElementById('usunom').value = "";
  document.getElementById('usuapell').value = "";
  document.getElementById('correo').value = "";
  document.getElementById('usuario').value = "";
  document.getElementById('password').value = "";
  document.getElementById('privilegios').value = "";
}

function openarticulo() {
  /*$('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
  // TABLA INSPECTORES EXTERNOS//
  let table = $('#arttable').DataTable({
        "language": {
          "searchPlaceholder": "Buscar datos...",
          "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
      },
      "order": [
          [4, "DESC"]
      ],
      "ajax": "../controller/php/infarticulos.php",
      "columnDefs": [{
          //  "targets": -1,
          // "data": null,
          //"defaultContent": ""
        }]
  });*/
  //--------------------------------------------------
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#arttable').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE ARTICULOS',
      exportOptions: {
        columns: [0, 1, 2, 3]
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
        columns: [0, 1, 2, 3]
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
      "searchPlaceholder": "Buscar articulos...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/infarticulos.php"
  });
}

function opentrans() {
  /*let table = $('#transfomacion').DataTable({
        "language": {
          "searchPlaceholder": "Buscar datos...",
          "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
      },
      "order": [
          [4, "DESC"]
      ],
      "ajax": "../controller/php/inftransfor.php",
      "columnDefs": [{
          //  "targets": -1,
          // "data": null,
          //"defaultContent": ""
        }]
  });*/
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#transfomacion').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE TRANSFORMACIÓN',
      exportOptions: {
        columns: [0, 1, 2]
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
        columns: [0, 1, 2]
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
      "searchPlaceholder": "Buscar transformación...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/inftransfor.php"
  });
}

function openclientes() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#listartic').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE CLIENTES',
      exportOptions: {
        columns: [0, 1, 2, 3]
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
        columns: [0, 1, 2, 3]
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
      "searchPlaceholder": "Buscar transformación...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/infoclient.php"
  });
}

function openproveedor() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#listpproveedor').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE PPROVEEDORES',
      exportOptions: {
        columns: [0, 1, 2]
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
        columns: [0, 1, 2]
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
      "searchPlaceholder": "Buscar transformación...",
      "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
    },
    // "order": [
    //     [5, "asc"]
    // ],
    "ajax": "../controller/php/tableprovee.php"
  });
}

function minagris() {
  var minagris = document.getElementById('mingrisid').value;
  document.getElementById('acntminagr').value = 500;
  document.getElementById('acntminagrhj').value = 1;
}

function openartprov() {
  var currentdate = new Date();
  var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" + (currentdate.getMonth() + 1) + "/" + currentdate.getFullYear() + " - " + currentdate.getHours() + ":" + currentdate.getMinutes();
  var table = $('#example2').DataTable({
    dom: 'Bfrtip',
    buttons: [{
      extend: 'copy',
      exportOptions: {
        columns: [0, 1, 2, 3, 4]
      }
    }, {
      extend: 'pdfHtml5',
      text: 'Generar PDF',
      messageTop: 'RESUMEN DE ARTICULOS DE PROVEEDOR',
      exportOptions: {
        columns: [0, 1, 2, 3, 4]
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
        columns: [0, 1, 2, 3, 4]
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
    "ajax": "../controller/php/infartprovee.php"
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
} //FUNCION DONDE RECOLECTA LA INFORMACION DEL ARTICULO DE PROVEEDOR 


function infoartraf(id_arprovee) {
  //alert(id_arprovee);
  document.getElementById('id_artprov').value = id_arprovee;
  var folio = id_arprovee;
  $.ajax({
    url: '../controller/php/conartrprve.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_arprov == id_arprovee) {
        $("#modal-edithartprovee #editprovee1").val(obj.data[D].proveedor);
        $("#modal-edithartprovee #edithcidprv").val(obj.data[D].id_articulo);
        $("#modal-edithartprovee #edithdesprvv").val(obj.data[D].id_articulo);
        $("#modal-edithartprovee #codprvar").val(obj.data[D].codigo_proveedor);
        $("#modal-edithartprovee #desprvar").val(obj.data[D].descrip_proveedor);
        $("#modal-edithartprovee #edithlargo").val(obj.data[D].largo);
        $("#modal-edithartprovee #edithancho").val(obj.data[D].ancho);
        $("#modal-edithartprovee #edithgram").val(obj.data[D].gramaje);
        $("#modal-edithartprovee #edithpeso_mill").val(obj.data[D].peso_x_millar);
        $("#modal-edithartprovee #edithpeso_hoja").val(obj.data[D].peso_x_hoja);
        $("#modal-edithartprovee #edithpresent").val(obj.data[D].presentacion);
        $("#modal-edithartprovee #edithpescerr").val(obj.data[D].peso_paq_cerrado);
        $("#modal-edithartprovee #edithunidad").val(obj.data[D].unidad);
        $("#modal-edithartprovee #edithprecio").val(obj.data[D].precio_anterior);
        $("#modal-edithartprovee #edithprecioac").val(obj.data[D].precio_actual);
        $("#modal-edithartprovee #edithsec1").val(obj.data[D].des1);
        $("#modal-edithartprovee #edithsec2").val(obj.data[D].des2);
        $("#modal-edithartprovee #edithsec3").val(obj.data[D].des3);
        $("#modal-edithartprovee #edithsec4").val(obj.data[D].des4);
        $("#modal-edithartprovee #edithsec5").val(obj.data[D].des5);
        $("#modal-edithartprovee #edithsec6").val(obj.data[D].des6);
        $("#modal-edithartprovee #edithobs1").val(obj.data[D].observ1);
        $("#modal-edithartprovee #edithobs2").val(obj.data[D].observ2);
      }
    }
  });
} //FUNCION DE EDITAR ARTICULO DE PROVEEDOR


function edithartprov() {
  //alert("editusuarios");
  document.getElementById('openarprov').style.display = "none";
  document.getElementById('closearprov').style.display = "";
  document.getElementById('editprovee1').disabled = false;
  document.getElementById('edithcidprv').disabled = false;
  document.getElementById('codprvar').disabled = false;
  document.getElementById('desprvar').disabled = false;
  document.getElementById('edithlargo').disabled = false;
  document.getElementById('edithancho').disabled = false;
  document.getElementById('edithgram').disabled = false;
  document.getElementById('edithpeso_mill').disabled = false;
  document.getElementById('edithpeso_hoja').disabled = false;
  document.getElementById('edithpresent').disabled = false;
  document.getElementById('edithpescerr').disabled = false;
  document.getElementById('edithunidad').disabled = false;
  document.getElementById('edithprecio').disabled = false;
  document.getElementById('edithprecioac').disabled = false;
  document.getElementById('edithsec1').disabled = false;
  document.getElementById('edithsec2').disabled = false;
  document.getElementById('edithsec3').disabled = false;
  document.getElementById('edithsec4').disabled = false;
  document.getElementById('edithsec5').disabled = false;
  document.getElementById('edithsec6').disabled = false;
  document.getElementById('edithobs1').disabled = false;
  document.getElementById('edithobs2').disabled = false;
  document.getElementById('edthprvart').style.display = "";
} //FUNCION DE CERRAR EDICIÓN ARTICULO DE PROVEEDOR


function closeartprov() {
  //alert("cerrarusu");
  document.getElementById('openarprov').style.display = "";
  document.getElementById('closearprov').style.display = "none";
  document.getElementById('editprovee1').disabled = true;
  document.getElementById('edithcidprv').disabled = true;
  document.getElementById('codprvar').disabled = true;
  document.getElementById('desprvar').disabled = true;
  document.getElementById('edithlargo').disabled = true;
  document.getElementById('edithancho').disabled = true;
  document.getElementById('edithgram').disabled = true;
  document.getElementById('edithpeso_mill').disabled = true;
  document.getElementById('edithpeso_hoja').disabled = true;
  document.getElementById('edithpresent').disabled = true;
  document.getElementById('edithpescerr').disabled = true;
  document.getElementById('edithunidad').disabled = true;
  document.getElementById('edithprecio').disabled = true;
  document.getElementById('edithprecioac').disabled = true;
  document.getElementById('edithsec1').disabled = true;
  document.getElementById('edithsec2').disabled = true;
  document.getElementById('edithsec3').disabled = true;
  document.getElementById('edithsec4').disabled = true;
  document.getElementById('edithsec5').disabled = true;
  document.getElementById('edithsec6').disabled = true;
  document.getElementById('edithobs1').disabled = true;
  document.getElementById('edithobs2').disabled = true;
  document.getElementById('edthprvart').style.display = "none";
} //FUNCIONQUE GUARDA LA EDICIÓN DE ARTICULO DE TRASFORMACIÓN


function savethiarprvv() {
  //alert("ENTRA GUARDAR EDICIÓN");
  var id_arprov = document.getElementById('id_artprov').value;
  var id_articulo = document.getElementById('edithcidprv').value;
  var proveedor = document.getElementById('editprovee1').value;
  var codigo_proveedor = document.getElementById('codprvar').value;
  var descrip_proveedor = document.getElementById('desprvar').value;
  var largo = document.getElementById('edithlargo').value;
  var ancho = document.getElementById('edithancho').value;
  var gramaje = document.getElementById('edithgram').value;
  var peso_x_millar = document.getElementById('edithpeso_mill').value;
  var peso_x_hoja = document.getElementById('edithpeso_hoja').value;
  var presentacion = document.getElementById('edithpresent').value;
  var peso_paq_cerrado = document.getElementById('edithpescerr').value;
  var unidad = document.getElementById('edithunidad').value;
  var precio_anterior = document.getElementById('edithprecio').value;
  var precio_actual = document.getElementById('edithprecioac').value;
  var des1 = document.getElementById('edithsec1').value;
  var des2 = document.getElementById('edithsec2').value;
  var des3 = document.getElementById('edithsec3').value;
  var des4 = document.getElementById('edithsec4').value;
  var des5 = document.getElementById('edithsec5').value;
  var des6 = document.getElementById('edithsec6').value;
  var observ1 = document.getElementById('edithobs1').value;
  var observ2 = document.getElementById('edithobs2').value;
  var datos = 'id_arprov=' + id_arprov + '&id_articulo=' + id_articulo + '&proveedor=' + proveedor + '&codigo_proveedor=' + codigo_proveedor + '&descrip_proveedor=' + descrip_proveedor + '&largo=' + largo + '&ancho=' + ancho + '&gramaje=' + gramaje + '&peso_x_millar=' + peso_x_millar + '&peso_x_hoja=' + peso_x_hoja + '&presentacion=' + presentacion + '&peso_paq_cerrado=' + peso_paq_cerrado + '&unidad=' + unidad + '&precio_anterior=' + precio_anterior + '&precio_actual=' + precio_actual + '&des1=' + des1 + '&des2=' + des2 + '&des3=' + des3 + '&des4=' + des4 + '&des5=' + des5 + '&des6=' + des6 + '&observ1=' + observ1 + '&observ2=' + observ2 + '&opcion=actarprv'; //alert(datos);

  $.ajax({
    type: "POST",
    url: "../controller/php/insertartprov.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ACTUALIZO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      setTimeout("location.href = 'artiprove.php';", 1000);
    } else {
      document.getElementById('edtherrartprvv').style.display = '';
      setTimeout(function () {
        document.getElementById('edtherrartprvv').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  }); //FIN DE AJAX
} //FUNCION QUE TRAE LOS DATOS A  ELIMINAR A UN ARTICULO DE PROVEEDOR


function deletartprvv(id_art) {
  document.getElementById('del_artpvv').value = id_art; //alert(id_art);

  var folio = id_art;
  $.ajax({
    url: '../controller/php/conartrprve.php',
    type: 'GET',
    data: 'folio=' + folio
  }).done(function (respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (D = 0; D < res.length; D++) {
      if (obj.data[D].id_arprov == id_art) {
        // alert(id_persona);
        datos = obj.data[D].codigo_proveedor + '*' + obj.data[D].artdescrip;
        var o = datos.split("*");
        $("#modal-deleteartprv #deart").val(o[0]);
      }
    }
  });
}

function savedeartprv() {
  var id_arprov = document.getElementById('del_artpvv').value;
  var datos = 'id_arprov=' + id_arprov + '&opcion=eliminarartic';
  $.ajax({
    type: "POST",
    url: "../controller/php/insertartprov.php",
    data: datos
  }).done(function (respuesta) {
    if (respuesta == 0) {
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      setTimeout("location.href = 'artiprove.php';", 1000);
    } else {
      document.getElementById('edtherrartprvv').style.display = '';
      setTimeout(function () {
        document.getElementById('edtherrartprvv').style.display = 'none';
      }, 2000);
      alert(respuesta);
    }
  }); //FIN DE AJAX
}
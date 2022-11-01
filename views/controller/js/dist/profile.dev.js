"use strict";

function contrase() {
  //alert("pruebas");
  var contase = document.querySelector("#idcontra").value;

  if (contase.length >= 8) {
    //alert("CORRECTO");
    var alert = $("#non8").addClass("d-none");
    document.getElementById('confirmaa').disabled = false;
    document.getElementById(confirmaa).focus();
  } else {
    var fecha = $("#non8").removeClass("d-none");
    document.getElementById('confirmaa').disabled = true;
    setTimeout(function () {
      var alert = $("#non8").addClass("d-none");
    }, 1500);
    return;
  }
}

function conciden() {
  //alert("pruebas");saveup
  var contase = document.getElementById("#idcontra").value;
  var confir = document.getElementById("#confirmaa").value;

  if (contase == confir) {
    $("#saveup").removeClass("d-none");
  } else {
    //alert("no coinciden");
    //$("#saveup").addClass("d-none");
    var alert = $("#concid").removeClass("d-none");
    setTimeout(function () {
      var alert = $("#concid").addClass("d-none");
    }, 1500);
  }
}

function savenewpas() {
  //alert("pruebas");
  var contase = document.getElementById('idcontra').value;
  var confir = document.getElementById('confirmaa').value;
  var idusu = document.getElementById('id_usu').value;
  var datos = 'contase=' + contase + '&confir=' + confir + '&idusu=' + idusu + '&opcion=actpassword'; //alert(datos);

  if (contase == '' || confir == '') {
    document.getElementById('llenaod').style.display = '';
    setTimeout(function () {
      document.getElementById('llenaod').style.display = 'none';
    }, 2000);
    return;
  } else {
    if (contase == confir) {
      //alert("coinciden");
      $.ajax({
        type: "POST",
        url: "../controller/insertusu.php",
        data: datos
      }).done(function (respuesta) {
        if (respuesta == 0) {
          Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
          document.getElementById('idcontra').value = "";
          document.getElementById('confirmaa').value = "";
          document.getElementById('confirmaa').disabled = true;
        } else if (respuesta == 2) {
          Swal.fire({
            type: 'danger',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
          });
        } else {
          Swal.fire({
            type: 'danger',
            text: 'Contactar a soporte tecnico',
            showConfirmButton: false,
            timer: 1500
          });
        }
      });
    } else {
      //alert("no coinciden");
      var fecha = $("#concid").removeClass("d-none");
      setTimeout(function () {
        var alert = $("#concid").addClass("d-none");
      }, 1500); //$("#saveup").addClass("d-none");
    }
  }
}
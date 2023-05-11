"use strict";

function searchpickup() {
  //alert("entra");
  var id_pickup = document.getElementById('hero-search').value;
  $.ajax({
    type: "GET",
    url: "controller/searchpickup.php",
    data: 'id_pickup=' + id_pickup
  }).done(function (respuesta) {
    //alert(respuesta);
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;

    for (U = 0; U < res.length; U++) {
      //document.getElementById('del_vproduct').value = obj.data[U].refe_1;
      document.getElementById('number_p').innerHTML = "Pedido #" + obj.data[U].pedido;
      document.getElementById('status').value = obj.data[U].estatus;

      if (obj.data[U].estatus === 'COMPLETADO') {
        document.getElementById('dexcribe').innerHTML = "El pedido ya fue entregado el dia " + "<b>" + obj.data[U].fechaentrega + "</b>" + " si tuvo algun contratiempo con su pedido favor de comunicarse a el departamento de ventas.";
        $('#steps').removeClass('hidden').addClass("");
        $('#welcome').addClass("hidden");
        $('#number2').removeClass('bg-gray-500').addClass("bg-indigo-500");
        $('#number2icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
        $('#number3').removeClass('bg-gray-500').addClass("bg-green-500");
        $('#number3icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-green-100 text-green-500");
      } else if (obj.data[U].estatus === 'ENVIANDO') {
        document.getElementById('dexcribe').innerHTML = "Su pedido se encuentra en camino a su destino, cualquie duda ó aclaración comunicarse con el departamento de ventas";
        $('#steps').removeClass('hidden').addClass("");
        $('#welcome').addClass("hidden");
        $('#number2').removeClass('bg-gray-500').addClass("bg-indigo-500");
        $('#number2icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
        $('#number3').removeClass('bg-green-500').addClass("bg-gray-500");
        $('#number3icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
      } else if (obj.data[U].estatus === 'PENDIENTE') {
        document.getElementById('dexcribe').innerHTML = "Su pedido se encuentra en proceso de recolección, cualquie duda ó aclaración comunicarse con el departamento de ventas";
        $('#steps').removeClass('hidden').addClass("");
        $('#welcome').addClass("hidden");
        $('#number2').removeClass('bg-indigo-500').addClass("bg-gray-500");
        $('#number2icon').removeClass('bg-indigo-100 text-indigo-500').addClass("bg-gray-100 text-gray-500");
        $('#number3').removeClass('bg-green-500').addClass("bg-gray-500");
        $('#number3icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
      } //alert("entro2");

    }
  });
}
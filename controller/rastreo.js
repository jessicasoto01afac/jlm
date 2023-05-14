function searchpickup() {
    //alert("entra");
    let id_pickup = document.getElementById('hero-search').value
    if (id_pickup == '') {
        //alert("basio");
        document.getElementById('text').innerHTML = "Se necesita ingresar número de rastreo"
        $('#text').removeClass('text-gray-800').addClass("text-red-600");
    } else {
        //loading
        $('#loader').removeClass('hidden').addClass("show");

        $.ajax({
            type: "GET",
            url: "controller/searchpickup.php",
            data: 'id_pickup=' + id_pickup
        }).done(function(respuesta) {
            //alert(respuesta);
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            if (respuesta == 0) {
                loader();
                document.getElementById('text').innerHTML = "No se encuentran coincidencias con ese Número de Rastreo"
                $('#text').removeClass('text-gray-800').addClass("text-red-600");
                $('#steps').addClass("hidden");
                $('#welcome').removeClass("hidden");

            } else {
                for (U = 0; U < res.length; U++) {
                    loader();
                    //document.getElementById('del_vproduct').value = obj.data[U].refe_1;
                    document.getElementById('number_p').innerHTML = "Pedido #" + obj.data[U].pedido;
                    document.getElementById('number_p1').innerHTML = "Pedido #" + obj.data[U].pedido;
                    document.getElementById('status').value = obj.data[U].estatus;

                    if (obj.data[U].estatus === 'COMPLETADO') {
                        document.getElementById('dexcribe').innerHTML = "El pedido ya fue entregado el dia " + "<b>" + obj.data[U].fechaentrega + "</b>" + " si tuvo algun contratiempo con su pedido favor de comunicarse a el departamento de ventas.";
                        document.getElementById('dexcribe1').innerHTML = "El pedido ya fue entregado el dia " + "<b>" + obj.data[U].fechaentrega + "</b>" + " si tuvo algun contratiempo con su pedido favor de comunicarse a el departamento de ventas.";
                        $('#steps').removeClass('hidden').addClass("");
                        $('#welcome').addClass("hidden");
                        $('#number2').removeClass('bg-gray-500').addClass("bg-indigo-500");
                        $('#number2icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
                        $('#number3').removeClass('bg-gray-500').addClass("bg-green-500");
                        $('#number3icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-green-100 text-green-500");
                        $('#number22').removeClass('bg-gray-500').addClass("bg-indigo-500");
                        $('#number22icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
                        $('#number33').removeClass('bg-gray-500').addClass("bg-green-500");
                        $('#number3icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-green-100 text-green-500");
                        document.getElementById('text').innerHTML = "Ingresa el número de rastreo";
                        $('#text').removeClass('text-red-600').addClass("text-gray-800");
                        $('#finalizado').addClass("animate-pulse");
                        $('#finalizado1').addClass("animate-pulse");
                        $('#recoleccion').removeClass("animate-pulse");
                        $('#recoleccion1').removeClass("animate-pulse");
                        $('#camino').removeClass("animate-pulse");
                        $('#camino1').removeClass("animate-pulse");
                    } else if (obj.data[U].estatus === 'ENVIANDO') {
                        document.getElementById('dexcribe').innerHTML = "Su pedido se encuentra en camino a su destino, cualquie duda ó aclaración comunicarse con el departamento de ventas";
                        document.getElementById('dexcribe1').innerHTML = "Su pedido se encuentra en camino a su destino, cualquie duda ó aclaración comunicarse con el departamento de ventas";
                        $('#steps').removeClass('hidden').addClass("");
                        $('#welcome').addClass("hidden");
                        $('#number2').removeClass('bg-gray-500').addClass("bg-indigo-500");
                        $('#number2icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
                        $('#number3').removeClass('bg-green-500').addClass("bg-gray-500");
                        $('#number3icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
                        $('#number22').removeClass('bg-gray-500').addClass("bg-indigo-500");
                        $('#number22icon').removeClass('bg-gray-100 text-gray-500').addClass("bg-indigo-100 text-indigo-500");
                        $('#number33').removeClass('bg-green-500').addClass("bg-gray-500");
                        $('#number33icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
                        document.getElementById('text').innerHTML = "Ingresa el número de rastreo";
                        $('#text').removeClass('text-red-600').addClass("text-gray-800");
                        $('#camino').addClass("animate-pulse");
                        $('#camino1').addClass("animate-pulse");
                        $('#finalizado').removeClass("animate-pulse");
                        $('#finalizado1').removeClass("animate-pulse");
                        $('#recoleccion').removeClass("animate-pulse");
                        $('#recoleccion1').removeClass("animate-pulse");
                    } else if (obj.data[U].estatus === 'PENDIENTE') {
                        document.getElementById('dexcribe').innerHTML = "Su pedido se encuentra en proceso de recolección, cualquie duda ó aclaración comunicarse con el departamento de ventas";
                        document.getElementById('dexcribe1').innerHTML = "Su pedido se encuentra en proceso de recolección, cualquie duda ó aclaración comunicarse con el departamento de ventas";
                        $('#steps').removeClass('hidden').addClass("");
                        $('#welcome').addClass("hidden");
                        $('#number2').removeClass('bg-indigo-500').addClass("bg-gray-500");
                        $('#number2icon').removeClass('bg-indigo-100 text-indigo-500').addClass("bg-gray-100 text-gray-500");
                        $('#number3').removeClass('bg-green-500').addClass("bg-gray-500");
                        $('#number3icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
                        $('#number22').removeClass('bg-indigo-500').addClass("bg-gray-500");
                        $('#number22icon').removeClass('bg-indigo-100 text-indigo-500').addClass("bg-gray-100 text-gray-500");
                        $('#number33').removeClass('bg-green-500').addClass("bg-gray-500");
                        $('#number33icon').removeClass('bg-green-100 text-green-500').addClass("bg-gray-100 text-gray-500");
                        document.getElementById('text').innerHTML = "Ingresa el número de rastreo";
                        $('#recoleccion').addClass("animate-pulse");
                        $('#recoleccion1').addClass("animate-pulse");
                        $('#camino').removeClass("animate-pulse");
                        $('#camino1').addClass("animate-pulse");
                        $('#finalizado').removeClass("animate-pulse");
                        $('#finalizado1').removeClass("animate-pulse");
                        $('#text').removeClass('text-red-600').addClass("text-gray-800");
                    }
                    //alert("entro2");
                }
            }

        });
    }
}

function loader() {
    const contenedor_loader = document.querySelector('.contenedor_loader');
    contenedor_loader.style.opacity = 0
    contenedor_loader.style.visibility = 'hidden';
}
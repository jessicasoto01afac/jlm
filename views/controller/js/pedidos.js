function openpedidos() {
    var currentdate = new Date();
    var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear() + " - " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes();
    var table = $('#pedidosdata').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Generar PDF',
                messageTop: 'RESUMEN DE PEDIDOS',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                download: 'open',
                header: true,
                title: '',
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 12;
                    doc.styles.tableHeader.fontSize = 12;
                    doc['footer'] = (function(page, pages) {
                        return {
                            columns: [
                                datetime,
                                {
                                    alignment: 'right',
                                    text: [{
                                            text: page.toString(),
                                            italics: false
                                        },
                                        ' de ',
                                        {
                                            text: pages.toString(),
                                            italics: false
                                        }
                                    ]
                                }
                            ],
                            margin: [25, 0]
                        }
                    });
                }
            },
            {
                extend: 'excel',
                text: 'Generar Excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }
        ],
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
        "ajax": "../controller/php/pedidoslist.php",
    });
}
//funcion para traer la informacion del pedido
function infpedido(pruebas) {
    alert(pruebas);
    $("#pedidosdata tr").on('click', function() {
        var id_vofi = "";
        var id_cli = "";
        id_vofi += $(this).find('td:eq(1)').html(); //Toma el numero de pedido
        id_cli += $(this).find('td:eq(2)').html(); //Toma el cliente
        //alert(id_vofi);
        document.getElementById('idinped').innerHTML = id_vofi;
        document.getElementById('infclinte').value = id_cli;
        $("#dettpedido").toggle(250); //Muestra contenedor 
        $("#listaped").toggle("fast"); //Oculta lista

        $.ajax({
            url: '../controller/php/pedidoslist.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (D = 0; D < res.length; D++) {
                if (obj.data[D].refe_1 == id_vofi) {
                    datos =
                        obj.data[D].fecha + '*' +
                        obj.data[D].refe_2;
                    var o = datos.split("*");
                    $("#inffcingr").val(o[0]);
                    $("#inforemision").val(o[1]);
                }
            }
        });
        $.ajax({
            url: '../controller/php/conpedido.php',
            type: 'POST'
        }).done(function(resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="table-wrapper"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table table-striped" style="width:100%; display:block; overflow-x:auto; white-space:nowrap;"><thead class="thead-colored thead-info"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ESTATUS</th><th style=""><i></i>ACCIONES</th></tr></thead><tbody>';
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].refe_1 == id_vofi) {
                    x++;
                    html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].status_2 + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='infartpedid();' class='nav-link' data-toggle='modal' data-target='#modal-editpeinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a><a class='nav-link'>Surtir</a>" + "</td></tr>";
                }
            }
            html += '</div></tbody></table></div></div>';
            $("#listpedidinf").html(html);
            'use strict';
            $('lispedidoinf').DataTable({
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
                        sPrevious: 'Anterior',
                    },
                }

            });
        })





    })
}

//FUNCION PARA EDITAR PEDIDO EN VISTA DE INFORMACION
function editpediinf() {
    //alert("EDITAR PEDIDO");
    document.getElementById('inforemision').disabled = false;
    document.getElementById('inffcingr').disabled = false;
    document.getElementById('inffecentre').disabled = false;
    document.getElementById('infaten').disabled = false;
    document.getElementById('influgar').disabled = false;
    document.getElementById('infdirec').disabled = false;
    //muestra los botones
    document.getElementById('addarticp').style.display = "";
    document.getElementById('cancelpe').style.display = "";
    //muestra el boton de cerrar editar
    document.getElementById('closepedi').style.display = "";
    document.getElementById('openedipi').style.display = "none";

}

//FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function closedithpin() {
    //alert("cierra pedido");
    document.getElementById('inforemision').disabled = true;
    document.getElementById('inffcingr').disabled = true;
    document.getElementById('inffecentre').disabled = true;
    document.getElementById('infaten').disabled = true;
    document.getElementById('influgar').disabled = true;
    document.getElementById('infdirec').disabled = true;
    //muestra los botones
    document.getElementById('addarticp').style.display = "none";
    document.getElementById('cancelpe').style.display = "none";
    //muestra el boton de cerrar editar
    document.getElementById('closepedi').style.display = "none";
    document.getElementById('openedipi').style.display = "";
}
//FUNCION PARA ABRIR EDICION DE ARTICULO DE PEDIDO EN VISTA DE INFORMACION
function opeinpedf() {
    //alert("cierra pedido");
    document.getElementById('ediinfpe').disabled = false;
    document.getElementById('editcavoinf').disabled = false;
    document.getElementById('pprecioinf').disabled = false;
    document.getElementById('editcapeinf').disabled = false;
    document.getElementById('infobserep').disabled = false;
    //muestra el boton de cerrar editar
    document.getElementById('openedipeinf').style.display = "none";
    document.getElementById('closeditpeinf').style.display = "";
}
//FUNCION PARA CERRAR EDICION DE ARTICULO DE PEDIDO EN VISTA DE INFORMACION
function closeinpedf() {
    //alert("cierra pedido");
    document.getElementById('ediinfpe').disabled = true;
    document.getElementById('editcavoinf').disabled = true;
    document.getElementById('pprecioinf').disabled = true;
    document.getElementById('editcapeinf').disabled = true;
    document.getElementById('infobserep').disabled = true;
    //muestra el boton de cerrar editar
    document.getElementById('openedipeinf').style.display = "";
    document.getElementById('closeditpeinf').style.display = "none";
}
//funcion para traer la informacion del pedido a edicion de articulos
function infartpedid() {
    //alert("entra pedido");
    $("#lispedidoinf tr").on('click', function() {
        var id_arped = "";
        id_arped += $(this).find('td:eq(0)').html(); //Toma el numero de pedido
        //alert(id_arped);
        document.getElementById('id_arpedid').value = id_arped;


        $.ajax({
            url: '../controller/php/conpedido.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (D = 0; D < res.length; D++) {
                if (obj.data[D].id_kax == id_arped) {
                    datos =
                        obj.data[D].codigo_1 + '*' +
                        obj.data[D].salida + '*' +
                        //obj.data[D].costo; 
                        obj.data[D].costo + '*' +
                        obj.data[D].artubicac + '*' +
                        obj.data[D].descripcion_1;
                    var o = datos.split("*");
                    $("#modal-editpeinf #ediinfpe").val(o[0]);
                    $("#modal-editpeinf #editcapeinf").val(o[1]);
                    $("#modal-editpeinf #pprecioinf").val(o[2]);
                    $("#modal-editpeinf #editdepinpe").val(o[3]);
                    $("#modal-editpeinf #edithdeped").val(o[4]);

                }
            }
        });

    })
}
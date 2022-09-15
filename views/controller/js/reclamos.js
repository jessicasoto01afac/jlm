//MUESTRA EL DISEÑO DE NUEVO REPORTE CLIENTE
function openrepclient() {
    $(document).ready(function() {
        'use strict';
        $('#wizard7').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            cssClass: 'wizard wizard-style-3',
            labels: {
                cancel: "Cancelar",
                current: "current step:",
                pagination: "Pagination",
                finish: "Finalizar",
                next: "Siguiente",
                previous: "Anterior",
                loading: "Cargando ..."
            },
        });
    });
    $(document).ready(function() {
        $('#busccodimem').load('./select/buscarme.php');
        $('#busccodigomem2').load('./select/buscarme2.php');
        $('#buscpedido').load('./select/buspedirec.php');
    });
}




function openreclientes() {
    let currentdate = new Date();
    let datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear() + " - " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes();
    let table = $('#recliente').DataTable({
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
                messageTop: 'RESUMEN DE VALE DE PRODUCCIÓN',
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
        "ajax": "../controller/php/infrecl_clientes.php",
    });
}
//FUNCION PARA AGREGAR UN NUEVO FOLIO
function foliovp() {
    //alert("entra folios");
    let tipo = "RECLAMO_CLIENTE"
    let datos = 'tipo=' + tipo + '&opcion=gefolio';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertreclamo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            setTimeout("location.href = 'new_reclacliente.php';", 1500);
            alert(respuesta);
        } else if (respuesta == 2) {

        } else {
            Swal.fire({
                type: 'danger',
                text: 'Contactar a soporte tecnico',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
}
//FUNCIONES PARA GUARDAR ARTICULOS DE REPORTE DE CLIENTE
function addartrepclt() {
    alert("entro reclamo");
    let folio_recl = document.getElementById('folioreclie').value; //FOLIO
    let fecha_recl = document.getElementById('fecharepclie').value;
    let codigo_cliente = document.getElementById('deprechaclie').value;
    let pedido = document.getElementById('pedidorec').value;
    let remision = document.getElementById('remisreclam').value;
    let factura = document.getElementById('factreclam').value;
    let rep_cliente = document.getElementById('resmcliente').value;
    let rep_jlm = document.getElementById('resmjlm').value;
    let seguimiento = document.getElementById('seguiminto').value;
    let conclusion = document.getElementById('conclusioncli').value;
    let dep_responsa = document.getElementById('deprechaclie').value;
    let tipo_incidencia = document.getElementById('tipoincclit').value;
    let tipo_reporte = document.getElementById('tiporeclit').value;



    let cantidad = document.getElementById('cantidadrecl').value;
    let codigo_art = document.getElementById('mcodigotr').value;
    let datos = 'folio_recl=' + folio_recl + '&fecha_recl=' + fecha_recl + '&remision=' + remision + '&factura=' + factura + '&pedido=' + pedido + '&codigo_cliente=' + codigo_cliente + '&cantidad=' + cantidad + '&dep_responsa=' + dep_responsa + '&tipo_incidencia=' + tipo_incidencia + '&rep_cliente=' + rep_cliente + '&codigo_art=' + codigo_art + '&opcion=regisrepcl';
    alert(datos);
    if (folio_recl == '' || fecha_recl == '' || pedido == '' || codigo_cliente == '' || tipo_incidencia == '') {
        document.getElementById('vaciosrecc').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosrecc').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertmemo.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                cleanalttras();
                updatememoalt();
                let id_memo = document.getElementById('mfolio').value;
                $.ajax({
                    url: '../controller/php/memo1.php',
                    type: 'POST'
                }).done(function(resp) {
                    obj = JSON.parse(resp);
                    let res = obj.data;
                    let x = 0;
                    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datamemo" name="datamemo" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
                    for (U = 0; U < res.length; U++) {
                        if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION') {
                            x++;
                            $id_memo2 = obj.data[U].id_kax;
                            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemoalt();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemoalta'>Editar</a> <a onclick='delartmemalt();' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal'>Eliminar</a>" + "</td></tr>";
                        }
                    }
                    html += '</div></tbody></table></div></div>';
                    $("#lismemotras").html(html);
                    'use strict';
                    $('#datamemo').DataTable({
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
            } else if (respuesta == 2) {
                document.getElementById('dublivo').style.display = ''
                setTimeout(function() {
                    document.getElementById('dublivo').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('errvo').style.display = ''
                setTimeout(function() {
                    document.getElementById('errvo').style.display = 'none';
                }, 1000);
            }
        })
    }
}
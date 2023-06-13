$(document).ready(function() {
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
        onFinished: function(event, currentIndex) {
            //alert("Form submitted.");
            let refe_1 = document.getElementById('prepedfolio').value;
            let fecha = document.getElementById('predfecha').value;
            let refe_3 = document.getElementById('predpedidatentio').value;
            let proveedor_cliente = document.getElementById('predpedicliente').value;
            let caracter = document.getElementById('prepedidcaracter').value;

            //--------------------------
            let datos = 'refe_1=' + refe_1 + '&caracter=' + caracter + '&opcion=registrarfin';
            if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '') {
                document.getElementById('vaciosped').style.display = ''
                setTimeout(function() {
                    document.getElementById('vaciosped').style.display = 'none';
                }, 2000);
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "../controller/php/insertpedio.php",
                    data: datos
                }).done(function(respuesta) {
                    if (respuesta == 0) {
                        Swal.fire({
                            type: 'success',
                            text: 'Se AGREGO el pedido de forma correcta',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout("location.href = 'prepedidos.php';", 1500);
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
                            text: 'Error contactar a soporte tecnico o levantar un ticket',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });

            }
        }
    });

});
$(document).ready(function() {
    $('#busccodipreped').load('./select/buscarartpre.php');
});

function openprepedidos() {
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
                messageTop: 'RESUMEN DE PREPEDIDOS',
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
        "ajax": "../controller/php/prepedidoslist.php",
    });
}
//FUNCIÓN QUE SIRVE PARA AGREGAR PREPEDIDO
function addprepedido() {
    //alert("entro agregar vale de producción");
    let referencia = document.getElementById('prepedfolio').value;
    let fecha = document.getElementById('predfecha').value;
    let atendio = document.getElementById('predpedidatentio').value;
    let cliente = document.getElementById('predpedicliente').value;
    let caracter = document.getElementById('prepedidcaracter').value;
    let codigo = document.getElementById('mcodigotrpre').value;
    let cantidad = document.getElementById('prepedcantidad').value;
    let observa = document.getElementById('prepedbservo').value;
    let descripcion_1 = document.getElementById('mcodigotrpre').value;
    let lugar = document.getElementById('addlugarpre').value;
    let direccion = document.getElementById('adddireccionpre').value;
    //--------------------------
    let datos = 'referencia=' + referencia + '&fecha=' + fecha + '&atendio=' + atendio + '&cliente=' + cliente + '&caracter=' + caracter + '&codigo=' + codigo + '&cantidad=' + cantidad + '&descripcion_1=' + descripcion_1 + '&observa=' + observa + '&lugar=' + lugar + '&direccion=' + direccion + '&opcion=registrarpre';

    //alert(datos);
    if (referencia == '' || fecha == '' || atendio == '' || cliente == '' || codigo == '' || cantidad == '') {
        document.getElementById('vaciospredid').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciospredid').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertpedio.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateprepedido();
            } else if (respuesta == 2) {
                document.getElementById('dublipred').style.display = ''
                setTimeout(function() {
                    document.getElementById('dublipred').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('errprepedi').style.display = ''
                setTimeout(function() {
                    document.getElementById('errprepedi').style.display = 'none';
                }, 1000);
            }
        })

    }
}

//LLAMADO DE DATOS
function updateprepedido() {
    //alert("entro el update");
    //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
    document.getElementById('mcodigotrpre').value = "";
    document.getElementById('prepedcantidad').value = "";
    document.getElementById('prepedbservo').value = "";

    //INFORMACION DE LAS TBLAS
    let id_pedid = document.getElementById('prepedfolio').value;
    let folio = id_pedid;
    //alert(folio);
    $.ajax({
        url: '../controller/php/infprepedido.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="prepedadd" name="prepedadd" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            if (obj.data[U].referencia == id_pedid) {
                x++;
                let id_prepedidd = obj.data[U].id_pre;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarpreart(" + id_prepedidd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetprepedi'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_prepedidd + ");' data-toggle='modal' data-target='#modal-delearpednew'>Eliminar</a>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listprepedidoss").html(html);
        'use strict';
        $('#prepedadd').DataTable({
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
}

//LLAMADO DE DATOS
function cancelar() {
    //alert("entra cancelar");
    let refe_1 = document.getElementById('pedfolio').value;
    let datos = 'refe_1=' + refe_1 + '&opcion=cancelarpre';
    $.ajax({
        type: "POST",
        url: "../controller/php/insertpedio.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se cancelelo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'listpedido.php';", 1500);

        } else if (respuesta == 2) {
            document.getElementById('dublivp').style.display = ''
            setTimeout(function() {
                document.getElementById('dublivp').style.display = 'none';
            }, 1000);
            //alert("datos repetidos");
        } else {
            document.getElementById('errvp').style.display = ''
            setTimeout(function() {
                document.getElementById('errvp').style.display = 'none';
            }, 1000);
        }
    })
}
//ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN
function editarpreart(idped) {
    alert(idped);
    let folio = idped;
    document.getElementById('id_prededithdett').value = idped;
    $.ajax({
        url: '../controller/php/conprepedidos.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_pre == idped) {
                //alert("entro");
                document.getElementById('dedttprededith').value = obj.data[C].codigo;
                document.getElementById('prededettcant').value = obj.data[C].cantidad;
                document.getElementById('predettedith').value = obj.data[C].observa;

            }
        }
    });
}
//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS PREPEDIDO EN DETALLES
function editpreddett() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithpredido').style.display = "";
    document.getElementById('openedithpredido').style.display = "none";
    document.getElementById('savedithdettpred').style.display = "";
    document.getElementById('dedttprededith').disabled = false;
    document.getElementById('prededettcant').disabled = false;
    document.getElementById('predettedith').disabled = false;
}

function closedithpeddett() {
    document.getElementById('closedithpredido').style.display = "none";
    document.getElementById('openedithpredido').style.display = "";
    document.getElementById('savedithdettpred').style.display = "none";
    document.getElementById('dedttprededith').disabled = true;
    document.getElementById('prededettcant').disabled = true;
    document.getElementById('predettedith').disabled = true;

}
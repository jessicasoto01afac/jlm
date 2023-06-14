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
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarpreart(" + id_prepedidd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetprepedi'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_prepedidd + ");' data-toggle='modal' data-target='#modal-delearprednew'>Eliminar</a>" + "</td></tr>";
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
    let refe_1 = document.getElementById('prepedfolio').value;
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
    //alert(idped);
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
                document.getElementById('id_prededithdett').value = obj.data[C].id_pre;
                document.getElementById('dedttprededith').value = obj.data[C].codigo;
                document.getElementById('prededettcant').value = obj.data[C].cantidad;
                document.getElementById('pedobsadddetll').value = obj.data[C].observa;

            }
        }
    });
}
//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS PREPEDIDO EN DETALLES
function editpreddett() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithpredido').style.display = "";
    document.getElementById('openedithpredido').style.display = "none";
    document.getElementById('saveedithpredidett').style.display = "";
    document.getElementById('dedttprededith').disabled = false;
    document.getElementById('prededettcant').disabled = false;
    document.getElementById('pedobsadddetll').disabled = false;

}

function closedithpreddett() {
    document.getElementById('closedithpredido').style.display = "none";
    document.getElementById('openedithpredido').style.display = "";
    document.getElementById('saveedithpredidett').style.display = "none";
    document.getElementById('dedttprededith').disabled = true;
    document.getElementById('prededettcant').disabled = true;
    document.getElementById('pedobsadddetll').disabled = true;

}

function savedithdettpred() {
    let id_pre = document.getElementById('id_prededithdett').value;
    let codigo = document.getElementById('dedttprededith').value;
    let cantidad = document.getElementById('prededettcant').value;
    let observa = document.getElementById('pedobsadddetll').value;

    let datos = 'cantidad=' + cantidad + '&observa=' + observa + '&id_pre=' + id_pre + '&codigo=' + codigo + '&opcion=updatearprepinfo';
    //alert(datos);
    if (codigo == '' || cantidad == '') {
        document.getElementById('edithextdettlle').style.display = '';
        setTimeout(function() {
            document.getElementById('edithextdettlle').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateprepedido();
                closedithpreddett();
                $('#modal-edithdetprepedi').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {

            } else {
                document.getElementById('errpedidett').style.display = '';
                setTimeout(function() {
                    document.getElementById('errpedidett').style.display = 'none';
                }, 2000);
                alert(respuesta);
            }
        });
    }
}
//LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN ALTA DE PREPEDIDO
function deletenewart(id_delete) {
    //alert(id_delete);
    let folio = id_delete;
    document.getElementById('del_artprednew').value = id_delete;
    $.ajax({
        url: '../controller/php/conprepedidos.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_pre == id_delete) {
                //alert("entro");
                document.getElementById('deartprednew').value = obj.data[C].artdescrip;
            }
        }
    })
}
//GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PREPEDIDO
function savdelevpartpred() {
    let id_pre = document.getElementById('del_artprednew').value;
    let codigo = document.getElementById('deartprednew').value;
    let datos = 'id_pre=' + id_pre + '&codigo=' + codigo + '&opcion=deleartprenew';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertpedio.php",
        data: datos
    }).done(function(respuesta) {
        //alert(respuesta);
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se elimino de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            updateprepedido();
            $('#modal-delearprednew').modal('hide'); //cierra el modal

        } else {
            document.getElementById('delerarprednew').style.display = '';
            setTimeout(function() {
                document.getElementById('delerarprednew').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}
//funcion para traer la informacion del pedido
function infpredido(pruebas) {
    //alert(pruebas);
    document.getElementById('idinped').innerHTML = pruebas;
    $("#dettpredido").toggle(250); //Muestra contenedor 
    $("#listapred").toggle("fast"); //Oculta lista idinped infclinte
    let folio = pruebas;
    //BOTONES -----------------------------------------------
    let autorizar = document.getElementById('btnpedautoriz');
    let liberar = document.getElementById('btnpedliberar');
    let surtir = document.getElementById('btnpedsurtir');
    let finalizado = document.getElementById('btnpedfinaliz');
    let editar = document.getElementById('openedipi');
    let pdf = document.getElementById('pdfpedrod');
    //let masivo = document.getElementById('masivo');
    //fin botones -------------------------------------------
    $.ajax({
        url: '../controller/php/infoprepedi.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].referencia == pruebas) { //auropedid
                document.getElementById('atendioinf').value = obj.data[D].atendio;
                document.getElementById('infvpdate').value = obj.data[D].fecha;
                document.getElementById('infclinte').value = obj.data[D].cliente;
                document.getElementById('infpedlugar').value = obj.data[D].lugar;
                document.getElementById('infpeddirect').value = obj.data[D].direccion;
                document.getElementById('pedidcaracter').value = obj.data[D].caracter;


                if (obj.data[D].status == 'PENDIENTE') {
                    autorizar.style.display = 'none';
                    liberar.style.display = 'none';
                    finalizado.style.display = 'none';
                    editar.style.display = '';
                    pdf.style.display = 'none';
                    let masivo = $("#masivo").addClass("d-none");
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PRE-PEDIDO</button>';
                    $("#button_estatus").html(html);
                    $.ajax({
                        url: '../controller/php/infprepedido.php',
                        type: 'GET',
                        data: 'folio=' + folio
                    }).done(function(resp) {
                        obj = JSON.parse(resp);
                        var res = obj.data;
                        var x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th style=""><i></i>ACCIONES</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            if (obj.data[U].referencia == pruebas) {
                                x++;
                                let id_kardex = obj.data[U].id_pre;
                                html += "<tr><td style='display:none'>" + obj.data[U].id_pre + "</td><td>" + x + "</td><td>" + obj.data[U].codigo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observa + "</td><td class=''>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarpreartinf(" + id_kardex + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetprepedinf'>Editar</a><a href='' onclick='delartpedinf(" + id_kardex + ");'  class='nav-link' data-toggle='modal' data-target='#modal-delearpredinf'>Eliminar</a>" + "</td></tr>";
                            }
                        }
                        html += '</tbody></table></div>';
                        $("#listpedidinf").html(html);
                        $('#lispedidoinf').DataTable({
                            pageLength: 100,
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
                } else if (obj.data[D].status == 'SURTIDO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = 'none';
                    finalizado.style.display = '';
                    editar.style.display = 'none';
                    pdf.style.display = '';
                    let masivo = $("#masivo").addClass("d-none");
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-info btn-block mg-b-3">SURTIDO</button>';
                    $("#button_estatus").html(html);
                    $.ajax({
                        url: '../controller/php/infprepedido.php',
                        type: 'GET',
                        data: 'folio=' + folio
                    }).done(function(resp) {
                        obj = JSON.parse(resp);
                        var res = obj.data;
                        var x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>CANTIDAD_SURTIDA</th><th><i></i>OBSERVACIONES</th><th><i></i>ESTATUS</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            if (obj.data[U].refe_1 == id_vofi) {
                                let id_pedido = obj.data[U].id_kax;
                                x++;

                                //==================================================================================30062022
                                if (obj.data[U].status_2 === "PENDIENTE") {
                                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='pendiente'>PENDIENTE</span>";
                                } else if (obj.data[U].status_2 === "SURTIDO") {
                                    var status = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurtiped(" + id_pedido + ");' data-toggle='modal' data-target='#modal-surtido' class='spandis'>SURTIDO</span>";
                                } else if (obj.data[U].status_2 === "SIN EXISTENCIAS") {
                                    var status = "<span title='Ver detalles' onclick='infsiexpedid(" + id_pedido + ");' data-toggle='modal' data-target='#modal-sinexipedido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>";
                                }
                                //===================================================================================
                                html += "<tr><td style='display:none'>" + obj.data[U].id_kax + "</td><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td>" + status + "</td></tr>";
                            }
                        }
                        html += '</tbody></table></div>';
                        $("#listpedidinf").html(html);
                        $('#lispedidoinf').DataTable({
                            pageLength: 100,
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
            }
        }
    });
}
//LLAMADO DE DATOS
function updateprepedido2() {
    //alert("entro el update");
    //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
    document.getElementById('codindivinf').value = "";
    document.getElementById('pincantidinf').value = "";
    document.getElementById('ppinfbsertrass').value = "";

    //INFORMACION DE LAS TBLAS
    let id_pedid = document.getElementById('idinped').innerHTML;
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
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="lispedidoinf" name="lispedidoinf" class="table display dataTable" style="width:100%"><thead class="thead-colored thead-light"><tr><th style="display:none"><i></i>ID</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th style=""><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            if (obj.data[U].referencia == id_pedid) {
                x++;
                let id_prepedidd = obj.data[U].id_pre;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarpreartinf(" + id_prepedidd + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithdetprepedinf'>Editar</a><a class='nav-link' onclick='delartpedinf(" + id_prepedidd + ");' data-toggle='modal' data-target='#modal-delearpredinf'>Eliminar</a>" + "</td></tr>";
            }
        }
        html += '</tbody></table></div>';
        $("#listpedidinf").html(html);
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
//GUARDAR EL ARTICLO INDIVIDUAL EN DETALLES DE PREPRODUCCIÓN
function addarinpredinfo() {
    //alert("entro agregar vale de producción");
    let referencia = document.getElementById('idinped').innerHTML;
    let fecha = document.getElementById('infvpdate').value;
    let cliente = document.getElementById('infclinte').value;
    let atendio = document.getElementById('atendioinf').value;
    let lugar = document.getElementById('infpedlugar').value;
    let direccion = document.getElementById('infpeddirect').value;
    let caracter = document.getElementById('pedidcaracter').value;
    let codigo = document.getElementById('codindivinf').value;
    let cantidad = document.getElementById('pincantidinf').value;
    let observa = document.getElementById('ppinfbsertrass').value;

    let datos = 'referencia=' + referencia + '&fecha=' + fecha + '&cliente=' + cliente + '&atendio=' + atendio + '&lugar=' + lugar + '&direccion=' + direccion + '&caracter=' + caracter + '&codigo=' + codigo + '&cantidad=' + cantidad + '&observa=' + observa + '&opcion=registrarindpre';
    //alert(datos);
    if (referencia == '' || fecha == '' || cliente == '' || atendio == '' || codigo == '' || cantidad == '') {
        document.getElementById('edthinfvcp').style.display = ''
        setTimeout(function() {
            document.getElementById('edthinfvcp').style.display = 'none';
        }, 2000);
        alert("VACIS");
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
                updateprepedido2();
                document.getElementById('codindivinf').value = "";
                document.getElementById('pincantidinf').value = "";
                document.getElementById('ppinfbsertrass').value = "";
                $("#modal-addartpedinfo").modal('hide'); //ocultamos el modal
            } else if (respuesta == 2) {
                document.getElementById('edthvinbli1inf').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthvinbli1inf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthvinperr1inf').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthvinperr1inf').style.display = 'none';
                }, 1000);
                //alert("ERRs");
            }
        })
    }
}

function converpedido() {
    //alert("entra memo");
    let status = 'PEDIDO';
    let folio = document.getElementById('idinped').innerHTML; //FOLIO DEL MEMO
    let datos = 'folio=' + folio + '&opcion=conpedido';
    //alert(datos);
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
            url: "../controller/php/insertpedio.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se AUTORIZO de forma correcta',
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout("location.href = 'listpedido.php';", 1500);
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

//ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN
function editarpreartinf(idped) {
    //alert(idped);
    let folio = idped;
    document.getElementById('id_prededithinf').value = idped;
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
                document.getElementById('id_prededithinf').value = obj.data[C].id_pre;
                document.getElementById('deinfprededith').value = obj.data[C].codigo;
                document.getElementById('predeinfcant').value = obj.data[C].cantidad;
                document.getElementById('pedobsaddinf').value = obj.data[C].observa;

            }
        }
    });
}


function editpreddettinf() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithinfpredido').style.display = "";
    document.getElementById('openedithinfpredido').style.display = "none";
    document.getElementById('saveedithprediinf').style.display = "";
    document.getElementById('deinfprededith').disabled = false;
    document.getElementById('predeinfcant').disabled = false;
    document.getElementById('pedobsaddinf').disabled = false;

}

function closedithpreddeinf() {
    document.getElementById('closedithinfpredido').style.display = "none";
    document.getElementById('openedithinfpredido').style.display = "";
    document.getElementById('saveedithprediinf').style.display = "none";
    document.getElementById('deinfprededith').disabled = true;
    document.getElementById('predeinfcant').disabled = true;
    document.getElementById('pedobsaddinf').disabled = true;
}

function savedithinfpred() {
    let id_pre = document.getElementById('id_prededithinf').value;
    let codigo = document.getElementById('deinfprededith').value;
    let cantidad = document.getElementById('predeinfcant').value;
    let observa = document.getElementById('pedobsaddinf').value;

    let datos = 'cantidad=' + cantidad + '&observa=' + observa + '&id_pre=' + id_pre + '&codigo=' + codigo + '&opcion=updatearprepinfo';
    //alert(datos);
    if (codigo == '' || cantidad == '') {
        document.getElementById('edithextinflle').style.display = '';
        setTimeout(function() {
            document.getElementById('edithextinflle').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateprepedido2();
                closedithpreddeinf();
                $('#modal-edithdetprepedinf').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {

            } else {
                document.getElementById('errpediinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('errpediinf').style.display = 'none';
                }, 2000);
                alert(respuesta);
            }
        });
    }
}

function delartpedinf(id_delete) {
    let folio = id_delete;
    document.getElementById('del_artpredinf').value = id_delete;
    $.ajax({
        url: '../controller/php/conprepedidos.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_pre == id_delete) {
                //alert("entro");
                document.getElementById('deartpredinf').value = obj.data[C].artdescrip;
            }
        }
    })
}

//GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PREPEDIDO
function savdelevpartpredinf() {
    let id_pre = document.getElementById('del_artpredinf').value;
    let codigo = document.getElementById('deartpredinf').value;
    let datos = 'id_pre=' + id_pre + '&codigo=' + codigo + '&opcion=deleartprenew';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertpedio.php",
        data: datos
    }).done(function(respuesta) {
        //alert(respuesta);
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se elimino de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            updateprepedido2();
            $('#modal-delearpredinf').modal('hide'); //cierra el modal

        } else {
            document.getElementById('delerarpredinf').style.display = '';
            setTimeout(function() {
                document.getElementById('delerarpredinf').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}

function savepredcabe() {
    let referencia = document.getElementById('idinped').innerHTML;
    let atendio = document.getElementById('atendioinf').value;
    let fecha = document.getElementById('infvpdate').value;
    let cliente = document.getElementById('infclinte').value;
    let lugar = document.getElementById('infpedlugar').value;
    let direccion = document.getElementById('infpeddirect').value;
    let pedidcaracter = document.getElementById('pedidcaracter').value;
    let datos = 'referencia=' + referencia + '&atendio=' + atendio + '&fecha=' + fecha + '&cliente=' + cliente + '&lugar=' + lugar + '&direccion=' + direccion + '&pedidcaracter=' + pedidcaracter + '&opcion=savecabezpre';
    if (fecha == '' || referencia == '' || cliente == '') {
        document.getElementById('edthpedvacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthpedvacios').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                closedithpin();
            } else if (respuesta == 2) {
                document.getElementById('edthpedexi').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthpedexi').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthpedierror').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthpedierror').style.display = 'none';
                }, 2000);
                //alert(respuesta);
            }
        });
    }
}
//FUNCION PARA EDITAR PEDIDO EN VISTA DE INFORMACION
function editpediinf() {
    //alert("EDITAR PEDIDO");
    //muestra el boton de cerrar editar
    document.getElementById('closepedi').style.display = "";
    document.getElementById('openedipi').style.display = "none";
    document.getElementById('saveinped').style.display = "";
    //muestra los botones
    document.getElementById('addarticp').style.display = "";
    //document.getElementById('cancelpe').style.display = "";
    //campos 
    $("#infvpdate").removeAttr("readonly");
    $("#auropedid").removeAttr("readonly");
    $("#feautoped").removeAttr("readonly");
    $("#infpedlugar").removeAttr("readonly");
    $("#infpeddirect").removeAttr("readonly");
    document.getElementById('atendioinf').disabled = false;
    document.getElementById('infclinte').disabled = false;
    document.getElementById('pedidcaracter').disabled = false;
}
//FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function closedithpin() {
    //alert("cierra pedido");
    //muestra los botones
    document.getElementById('addarticp').style.display = "none";
    //muestra el boton de cerrar editar
    document.getElementById('closepedi').style.display = "none";
    document.getElementById('openedipi').style.display = "";
    document.getElementById('saveinped').style.display = "none";
    $("#infvpdate").attr("readonly", "readonly");
    $("#auropedid").attr("readonly", "readonly");
    $("#feautoped").attr("readonly", "readonly");
    $("#fesurtped").attr("readonly", "readonly");
    $("#fecentrega").attr("readonly", "readonly");
    $("#remisioninf").attr("readonly", "readonly");
    $("#infpedlugar").attr("readonly", "readonly");
    $("#infpeddirect").attr("readonly", "readonly");
    document.getElementById('atendioinf').disabled = true;
}

function histvalepro() {
    let folio = document.getElementById('idinped').innerHTML;
    let folio2 = "FOLIO:" + folio;
    //alert(folio);
    //Tabla de historial del vale de producción
    $.ajax({
        url: '../controller/php/hisprepedidos.php',
        type: 'POST',
        data: 'folio=' + folio2
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        //alert("folio");
        html = '<div class="rounded table-responsive"><table style="width:100%" id="hisvalevp" name="hisvalevp" class="table display dataTable no-footer"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>Usuario</th><th><i></i>Acción</th><th><i></i>Registro</th><th><i></i>fecha</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_usu + "</td><td>" + obj.data[U].proceso + "</td><td>" + obj.data[U].registro + "</td><td>" + obj.data[U].fecha + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#tabhisto").html(html);
    });

}
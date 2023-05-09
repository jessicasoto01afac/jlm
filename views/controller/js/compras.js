function opencompras() {
    //alert("pruebas");
    var currentdate = new Date();
    var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear() + " - " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes();
    var table = $('#datadefctuoso').DataTable({
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
                messageTop: 'RESUMEN DE COMPRAS',
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
        "ajax": "../controller/php/concompras.php",
    });
    // CON ESTO FUNCIONA EL MULTIFILTRO//
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
    let tipo = "COMPRAS"
        //--------------------------
    let datos = 'tipo=' + tipo + '&opcion=gefolio';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertcompras.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            setTimeout("location.href = 'new_shop.php';", 1500);
        } else if (respuesta == 2) {

        } else {
            //alert(respuesta);
            Swal.fire({
                type: 'warning',
                text: 'Contactar a soporte tecnico',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
}

//Funciones para convertir miniscula en mayuscula
function mayus(e) { e.value = e.value.toUpperCase(); }

function openew() {
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
                // alert("entro");
                let refe_1 = document.getElementById('cmfolio').value;
                let fecha = document.getElementById('cmfecha').value;
                let fecha2 = document.getElementById('cmfechaent').value;
                let proveedor = document.getElementById('cmprovedd').value;
                //alert(datos);
                if (refe_1 == '' || fecha == '' || fecha2 == '' || proveedor == '') {
                    document.getElementById('cmvaciosdf').style.display = ''
                    setTimeout(function() {
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
    $(document).ready(function() {
        $('#busccodigomem2').load('./select/buscarme2.php');
        $('#buspedidodef').load('./select/buscpedef.php');
        $('#dffdeped').select2();
        $('#dfcliente').select2();
        //$('#pedmatdef').load('./select/buscpedef.php');
        $('#cmprovedd').change(function() {
            let folio = document.getElementById('cmprovedd').value;
            //alert(folio);
            $('#buscarticulosprv').load('./select/buscarartshop.php?folio=' + folio);
            $('#buscarticulos').load('./select/busartcomp.php?folio=' + folio);
        });
    });
}

function updacompras() {
    //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
    document.getElementById('mcodigotr').value = "";
    document.getElementById('mdecriptr').value = "";
    document.getElementById('vpcantidad').value = "";
    document.getElementById('dfbservo').value = "";
    document.getElementById('mprvedd').value = "";
    //INFORMACION DE LAS TBLAS
    let folio = document.getElementById('cmfolio').value;
    //alert(folio);
    $.ajax({
        url: '../controller/php/infshop.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            let id_compras = obj.data[U].id_comp;
            html += "<tr><td>" + x + "</td><td>" + obj.data[U].artcodigo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observación + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarartcm(" + id_compras + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithcompas'>Editar</a><a class='nav-link' onclick='deletenewartcm(" + id_compras + ");' data-toggle='modal' data-target='#modal-delearcmnew'>Eliminar</a>" + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listarcomprs").html(html);
    })

}
//AGREGA ARTICULOS
function addartcompr() {
    //alert("entro agregar vale de producción");
    let folio_oc = document.getElementById('cmfolio').value;
    let fecha = document.getElementById('cmfecha').value;
    let fecha_entrga = document.getElementById('cmfechaent').value;
    let id_proveedor = document.getElementById('cmprovedd').value;
    let uso_CFDI = document.getElementById('cmusocfdi').value;
    let cond_pago = document.getElementById('condi_pago').value;
    let asignado = document.getElementById('cmasing').value;
    let id_articulo = document.getElementById('mcodigotr').value;
    let id_artprove = document.getElementById('mprvedd').value;
    let cantidad = document.getElementById('vpcantidad').value;
    let observación = document.getElementById('dfbservo').value;

    let datos = 'folio_oc=' + folio_oc + '&fecha=' + fecha + '&fecha_entrga=' + fecha_entrga + '&id_proveedor=' + id_proveedor + '&uso_CFDI=' + uso_CFDI + '&cond_pago=' + cond_pago + '&asignado=' + asignado + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=registrar';
    //alert(datos);
    if (folio_oc == '' || fecha == '' || id_proveedor == '' || uso_CFDI == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
        document.getElementById('cmvaciosdf').style.display = ''
        setTimeout(function() {
            document.getElementById('cmvaciosdf').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
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
                setTimeout(function() {
                    document.getElementById('cmdublidf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('cmerrdf').style.display = '';
                setTimeout(function() {
                    document.getElementById('cmerrdf').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}
//CANCELADO
function cancelar() {
    let folio_oc = document.getElementById('cmfolio').value;
    let datos = 'folio_oc=' + folio_oc + '&opcion=cancelar';
    $.ajax({
        type: "POST",
        url: "../controller/php/insertcompras.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se cancelelo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'compras.php';", 1500);
        } else if (respuesta == 2) {
            document.getElementById('dublidf').style.display = ''
            setTimeout(function() {
                document.getElementById('dublidf').style.display = 'none';
            }, 1000);
            //alert("datos repetidos");
        } else {
            document.getElementById('cmerrdf').style.display = ''
            setTimeout(function() {
                document.getElementById('cmerrdf').style.display = 'none';
            }, 1000);
        }
    })
}

//ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN 
function editarartcm(idedimp) {
    //alert(idedimp);
    let folio = idedimp;
    document.getElementById('id_cmedith1').value = idedimp;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
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
    $("#detalles").toggle(250); //Muestra contenedor de detalles 0508
    $("#lista").toggle("fast"); //Oculta lista
    document.getElementById('ordncompras').innerHTML = id_produc;
    //INFO CABECERA DE ORDEN DE COMPRAS
    $.ajax({
        url: '../controller/php/infcabeshop.php',
        type: 'GET',
        data: 'folio=' + id_produc
    }).done(function(respuesta) {
        //alert(respuesta);
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].folio_oc == id_produc) {
                document.getElementById('datecomp').value = obj.data[C].fecha;
                document.getElementById('datentrega').value = obj.data[C].fecha_entrga;
                document.getElementById('proveedcm').value = obj.data[C].id_proveedor;
                document.getElementById('uscfdicm').value = obj.data[C].uso_CFDI;
                document.getElementById('condcm').value = obj.data[C].cond_pago;
                document.getElementById('fact').value = obj.data[C].email_c1;

                let folio = obj.data[C].id_proveedor;
                // alert(folio);
                $('#buscarticulosprvm').load('./select/buscarartshop2.php?folio=' + folio);
                $('#buscarticulosjlm').load('./select/busartcomp2.php?folio=' + folio);
                $('#buscarticulosprvm3').load('./select/buscarartshop3.php?folio=' + folio);
                $('#buscarticulosjlm3').load('./select/busartcomp3.php?folio=' + folio);

                //BOTONES -----------------------------------------------
                let autorizar = document.getElementById('btncmautoriz');
                let liberar = document.getElementById('btncmliberar');
                let parcial = document.getElementById('btncmparcial');
                let finalizado = document.getElementById('btncmfinaliz');
                let enviar = document.getElementById('btncmenviar');
                let editar = document.getElementById('openedimt1');
                let pdf = document.getElementById('pdfvofi');
                //alert(obj.data[C].estatus);
                if (obj.data[C].estatus === 'AUTORIZADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    //parcial.style.display = '';
                    finalizado.style.display = 'none';
                    enviar.style.display = '';
                    editar.style.display = '';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
                    $("#button_estatus").html(html);
                    //INFO DE ARTICULOS 
                    $.ajax({
                        url: '../controller/php/infcompras.php',
                        type: 'GET',
                        data: 'folio=' + id_produc
                    }).done(function(resp) {
                        //alert(resp);
                        obj = JSON.parse(resp);
                        let res = obj.data;
                        let x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO JLM</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>ENTRADA</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            x++;
                            let id_valepro = obj.data[U].id_comp;
                            if (obj.data[U].estatuskardex == "0") {
                                accions = "<button type='button' onclick='edithsurcopr(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-entrada'>ENTRADA</button>"

                            } else if (obj.data[U].estatuskardex == "1") {
                                accions = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>COMPLETADO</span>"
                            } else if (obj.data[U].estatuskardex == "2") {
                                accions = "<button type='button' onclick='entradaparcial(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-entradaparcial'>ENTRADA PARCIAL</button>"
                            }
                            html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].cantidads + "</td><td>" + obj.data[U].observación + "</td><td>" + accions + "</td></tr>";
                        }
                        html += '</div></tbody></table></div></div>';
                        $("#listcompras").html(html);

                    })

                } else if (obj.data[C].estatus == 'PENDIENTE') {
                    autorizar.style.display = '';
                    liberar.style.display = 'none';
                    //parcial.style.display = 'none';
                    finalizado.style.display = 'none';
                    enviar.style.display = 'none';
                    editar.style.display = '';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PENDIDENTE</button>';
                    $("#button_estatus").html(html);
                    document.getElementById('rejlm').style.display = "none";
                    //INFO DE ARTICULOS 
                    $.ajax({
                        url: '../controller/php/infcompras.php',
                        type: 'GET',
                        data: 'folio=' + id_produc
                    }).done(function(resp) {
                        //alert(resp);
                        obj = JSON.parse(resp);
                        let res = obj.data;
                        let x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO JLM</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            x++;
                            let id_valepro = obj.data[U].id_comp;
                            html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observación + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarartcminf(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edith'>Editar</a><a class='nav-link' onclick='deletenewart1(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearcmdet'>Eliminar</a>" + "</td></tr>";
                        }
                        html += '</div></tbody></table></div></div>';
                        $("#listcompras").html(html);

                    })
                } else if (obj.data[C].estatus == 'FINALIZADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = 'none';
                    //parcial.style.display = 'none';
                    finalizado.style.display = '';
                    editar.style.display = 'none';
                    enviar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
                    $("#button_estatus").html(html);
                } else if (obj.data[C].estatus == 'ENTREGA PARCIAL') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    parcial.style.display = '';
                    finalizado.style.display = 'none';
                    enviar.style.display = 'none';
                    editar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">ENTREGA PARCIAL</button>';
                    $("#button_estatus").html(html);
                } else if (obj.data[C].estatus == 'ENVIADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    parcial.style.display = '';
                    finalizado.style.display = '';
                    editar.style.display = 'none';
                    enviar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
                    $("#button_estatus").html(html);
                }
            }
        }
    });



}

function deletenewartcm(id_delete) {
    //alert(id_delete);
    //alert(id_delete);
    let folio = id_delete;
    document.getElementById('del_artcmnew').value = id_delete;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == id_delete) {
                //alert("entro");
                document.getElementById('deartcmnew').value = obj.data[C].id_articulo + ' / ' + obj.data[C].id_artprove;
            }
        }
    })
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
}

//FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS EN PEDIDOS
function saveedithshop() {
    let folio_oc = document.getElementById('cmfolio').value;
    let idarti = document.getElementById('id_cmedith1').value;
    let id_articulo = document.getElementById('cmpnewvpedi').value;
    let id_artprove = document.getElementById('cmprovcod').value;
    let cantidad = document.getElementById('cmedithcant').value;
    let observación = document.getElementById('cmedithobsv').value;
    let datos = 'folio_oc=' + folio_oc + '&idarti=' + idarti + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=updateart';
    //alert(datos);
    if (folio_oc == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
        document.getElementById('vaciosdf').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosdf').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
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
                setTimeout(function() {
                    document.getElementById('cmdublidf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('cmerrdf').style.display = '';
                setTimeout(function() {
                    document.getElementById('cmerrdf').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}
//GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION
function savadeleartcm() {
    let idarti = document.getElementById('del_artcmnew').value;
    let id_articulo = document.getElementById('cmpnewvpedi').value;
    let folio_oc = document.getElementById('cmfolio').value;
    let datos = 'idarti=' + idarti + '&id_articulo=' + id_articulo + '&folio_oc=' + folio_oc + '&opcion=deleartnew';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertcompras.php",
        data: datos
    }).done(function(respuesta) {
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
            setTimeout(function() {
                document.getElementById('delerarcmnew').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}

function savejlmcm() {
    let refe_1 = document.getElementById('ordncompras').innerHTML;
    let revision = document.getElementById('relajlcmp').value;
    let datos = 'revision=' + revision + '&refe_1=' + refe_1 + '&opcion=revisionac';
    //alert("datos");
    $.ajax({
        type: "POST",
        url: "../controller/php/insertcompras.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            // closevaleproinf();
        } else if (respuesta == 2) {
            document.getElementById('edthmmvacios').style.display = '';
            setTimeout(function() {
                document.getElementById('edthmmvacios').style.display = 'none';
            }, 1000);
            //alert("datos repetidos");
        } else {
            document.getElementById('edthmmerror').style.display = '';
            setTimeout(function() {
                document.getElementById('edthmmerror').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}
//FUNCION PARA EDITAR MATERIAL DEFCTUOSO EN VISTA DE INFORMACION
function editmatcm() {
    //alert("EDITAR VALE");
    $("#datecomp").removeAttr("readonly");
    $("#datentrega").removeAttr("readonly");
    $("#fact").removeAttr("readonly");
    document.getElementById('proveedcm').disabled = false;
    document.getElementById('uscfdicm').disabled = false;
    document.getElementById('condcm').disabled = false;
    document.getElementById('closemted').style.display = "";
    document.getElementById('openedimt1').style.display = "none";
    document.getElementById('mtedith').style.display = "";
    document.getElementById('voagartic').style.display = "";
}
//FUNCION PARA CERRAR COMPRAS EN VISTA DE INFORMACION
function closedithmcm() {
    //alert("cierra VALE");
    $("#datecomp").attr("readonly", "readonly");
    $("#datentrega").attr("readonly", "readonly");
    $("#fact").attr("readonly", "readonly");
    document.getElementById('proveedcm').disabled = true;
    document.getElementById('uscfdicm').disabled = true;
    document.getElementById('condcm').disabled = true;
    document.getElementById('closemted').style.display = "none";
    document.getElementById('openedimt1').style.display = "";
    document.getElementById('mtedith').style.display = "none";
    document.getElementById('voagartic').style.display = "none";
}
//FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DE COMPRAS
function savecomhead() {
    let fecha = document.getElementById('datecomp').value;
    let fecha_entrga = document.getElementById('datentrega').value;
    let id_proveedor = document.getElementById('proveedcm').value;
    let uso_CFDI = document.getElementById('uscfdicm').value;
    let cond_pago = document.getElementById('condcm').value;
    let condcm = document.getElementById('consignada').value;
    let refe_1 = document.getElementById('ordncompras').innerHTML;
    let asignado = document.getElementById('consignada').value;
    let datos = 'fecha=' + fecha + '&fecha_entrga=' + fecha_entrga + '&id_proveedor=' + id_proveedor + '&uso_CFDI=' + uso_CFDI + '&cond_pago=' + cond_pago + '&condcm=' + condcm + '&refe_1=' + refe_1 + '&asignado=' + asignado + '&opcion=cambiocabdv';
    //alert(datos);
    if (fecha.value == '' || fecha_entrga.value == '' || id_proveedor.value == '' || uso_CFDI.value == '' || cond_pago.value == '' || condcm.value == '') {
        document.getElementById('edthvoivacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthvoivacios').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if (respuesta == 2) {
                document.getElementById('edthvoiexi').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoiexi').style.display = 'none';
                }, 1000);

            } else {
                document.getElementById('edthvoierror').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoierror').style.display = 'none';
                }, 2000);
                //alert(respuesta);
            }
        });

    }
}
//FUNCION DE COMPRAS AUTORIZAR
function autorizacm() {
    let folio = document.getElementById('ordncompras').innerHTML;
    let datos = 'folio=' + folio + '&opcion=autorizarcm';
    //alert(datos);
    if (folio == '') {
        document.getElementById('edthvoivacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthvoivacios').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se autoriza de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout("location.href = 'compras.php';", 1500);
            } else if (respuesta == 2) {
                document.getElementById('edthvoiexi').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoiexi').style.display = 'none';
                }, 1000);

            } else {
                document.getElementById('edthvoierror').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoierror').style.display = 'none';
                }, 2000);
                //alert(respuesta);
            }
        });
    }
}
//FUNCION DE COMPRAS LIBERAR
function liberarcm() {
    let folio = document.getElementById('ordncompras').innerHTML;
    let datos = 'folio=' + folio + '&opcion=liberarcm';
    //alert(datos);
    if (folio == '') {
        document.getElementById('edthvoivacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthvoivacios').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se autoriza de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout("location.href = 'compras.php';", 1500);
            } else if (respuesta == 2) {
                document.getElementById('edthvoiexi').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoiexi').style.display = 'none';
                }, 1000);

            } else {
                document.getElementById('edthvoierror').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoierror').style.display = 'none';
                }, 2000);
                //alert(respuesta);
            }
        });
    }
}
//AGREGA ARTICULOS DETALLES DEL CURSOS
function addartcomprdetll() {
    //alert("entro agregar vale de producción");
    let folio_oc = document.getElementById('ordncompras').innerHTML;
    let fecha = document.getElementById('datecomp').value;
    let fecha_entrga = document.getElementById('datentrega').value;
    let id_proveedor = document.getElementById('proveedcm').value;
    let uso_CFDI = document.getElementById('uscfdicm').value;
    let cond_pago = document.getElementById('condcm').value;
    let asignado = document.getElementById('consignada').value;
    let id_articulo = document.getElementById('mcodigotr').value;
    let id_artprove = document.getElementById('mprvedd').value;
    let cantidad = document.getElementById('editcacm').value;
    let observación = document.getElementById('ediobsercm').value;

    let datos = 'folio_oc=' + folio_oc + '&fecha=' + fecha + '&fecha_entrga=' + fecha_entrga + '&id_proveedor=' + id_proveedor + '&uso_CFDI=' + uso_CFDI + '&cond_pago=' + cond_pago + '&asignado=' + asignado + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=registrar';
    //alert(datos);
    if (folio_oc == '' || fecha == '' || id_proveedor == '' || uso_CFDI == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
        document.getElementById('edthvovacios').style.display = ''
        setTimeout(function() {
            document.getElementById('edthvovacios').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updatdetll();
            } else if (respuesta == 2) {
                document.getElementById('edthdvobli').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdvobli').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthvoerr').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoerr').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}
//FUNCION DE ACTUALIZAR TALA DE DETALLES 0508
function updatdetll() {
    //INFO DE ARTICULOS 
    let id_cmmpp = document.getElementById('ordncompras').innerHTML
    $.ajax({
        url: '../controller/php/infcompras.php',
        type: 'GET',
        data: 'folio=' + id_cmmpp
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].folio_oc == id_cmmpp) {
                document.getElementById('datecomp').value = obj.data[C].fecha;
                document.getElementById('datentrega').value = obj.data[C].fecha_entrga;
                document.getElementById('proveedcm').value = obj.data[C].id_proveedor;
                document.getElementById('uscfdicm').value = obj.data[C].uso_CFDI;
                document.getElementById('condcm').value = obj.data[C].cond_pago;
                document.getElementById('fact').value = obj.data[C].email_c1;

                let folio = obj.data[C].id_proveedor;
                // alert(folio);
                $('#buscarticulosprvm').load('./select/buscarartshop2.php?folio=' + folio);
                $('#buscarticulosjlm').load('./select/busartcomp2.php?folio=' + folio);
                $('#buscarticulosprvm3').load('./select/buscarartshop3.php?folio=' + folio);
                $('#buscarticulosjlm3').load('./select/busartcomp3.php?folio=' + folio);

                //BOTONES -----------------------------------------------
                let autorizar = document.getElementById('btncmautoriz');
                let liberar = document.getElementById('btncmliberar');
                let parcial = document.getElementById('btncmparcial');
                let finalizado = document.getElementById('btncmfinaliz');
                let enviar = document.getElementById('btncmenviar');
                let editar = document.getElementById('openedimt1');
                let pdf = document.getElementById('pdfvofi');
                //alert(obj.data[C].estatus);
                if (obj.data[C].estatus === 'AUTORIZADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    //parcial.style.display = '';
                    finalizado.style.display = 'none';
                    enviar.style.display = '';
                    editar.style.display = '';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-purple btn-block mg-b-3">AUTORIZADO</button>';
                    $("#button_estatus").html(html);
                    //INFO DE ARTICULOS 
                    $.ajax({
                        url: '../controller/php/infcompras.php',
                        type: 'GET',
                        data: 'folio=' + id_cmmpp
                    }).done(function(resp) {
                        //alert(resp);
                        obj = JSON.parse(resp);
                        let res = obj.data;
                        let x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO JLM</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>ENTRADA</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            x++;
                            let id_valepro = obj.data[U].id_comp;
                            if (obj.data[U].estatuskardex == "0") {
                                accions = "<button type='button' onclick='edithsurcopr(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-entrada'>ENTRADA</button>"

                            } else if (obj.data[U].estatuskardex == "1") {
                                accions = "<span style='cursor:pointer;' title='Ya fue surtido' onclick='infsurti(" + id_valepro + ")' data-toggle='modal' data-target='#modal-surtido' class='spandis'>COMPLETADO</span>"
                            } else if (obj.data[U].estatuskardex == "2") {
                                accions = "<button type='button' onclick='entradaparcial(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-entradaparcial'>ENTRADA PARCIAL</button>"
                            }
                            html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].cantidads + "</td><td>" + obj.data[U].observación + "</td><td>" + accions + "</td></tr>";
                        }
                        html += '</div></tbody></table></div></div>';
                        $("#listcompras").html(html);

                    })

                } else if (obj.data[C].estatus == 'PENDIENTE') {
                    autorizar.style.display = '';
                    liberar.style.display = 'none';
                    //parcial.style.display = 'none';
                    finalizado.style.display = 'none';
                    enviar.style.display = 'none';
                    editar.style.display = '';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">PENDIDENTE</button>';
                    $("#button_estatus").html(html);
                    document.getElementById('rejlm').style.display = "none";
                    //INFO DE ARTICULOS 
                    $.ajax({
                        url: '../controller/php/infcompras.php',
                        type: 'GET',
                        data: 'folio=' + id_cmmpp
                    }).done(function(resp) {
                        //alert(resp);
                        obj = JSON.parse(resp);
                        let res = obj.data;
                        let x = 0;
                        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO JLM</th><th><i></i>CODIGO PROV</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
                        for (U = 0; U < res.length; U++) {
                            x++;
                            let id_valepro = obj.data[U].id_comp;
                            html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_articulo + "</td><td>" + obj.data[U].id_artprove + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].cantidad + "</td><td>" + obj.data[U].observación + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarartcminf(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edith'>Editar</a><a class='nav-link' onclick='deletenewart1(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearcmdet'>Eliminar</a>" + "</td></tr>";
                        }
                        html += '</div></tbody></table></div></div>';
                        $("#listcompras").html(html);

                    })
                } else if (obj.data[C].estatus == 'FINALIZADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = 'none';
                    //parcial.style.display = 'none';
                    finalizado.style.display = '';
                    editar.style.display = 'none';
                    enviar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
                    $("#button_estatus").html(html);
                } else if (obj.data[C].estatus == 'ENTREGA PARCIAL') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    parcial.style.display = '';
                    finalizado.style.display = 'none';
                    enviar.style.display = 'none';
                    editar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-secondary btn-block mg-b-3">ENTREGA PARCIAL</button>';
                    $("#button_estatus").html(html);
                } else if (obj.data[C].estatus == 'ENVIADO') {
                    autorizar.style.display = 'none';
                    liberar.style.display = '';
                    parcial.style.display = '';
                    finalizado.style.display = '';
                    editar.style.display = 'none';
                    enviar.style.display = 'none';
                    pdf.style.display = '';
                    html = '<button type="button" id="estatus" name="estatus" class="btn btn-oblong btn-success btn-block mg-b-3">FINALIZADO</button>';
                    $("#button_estatus").html(html);
                }
            }
        }
    })
}

function editarartcminf(idedcmart) {
    //alert(idedcmart);
    let folio = idedcmart;
    document.getElementById('id_artincm').value = idedcmart;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        //alert(respuesta);
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == idedcmart) {
                //alert("entro");
                document.getElementById('mcodigotr3').value = obj.data[C].id_articulo;
                document.getElementById('mdecriptr3').value = obj.data[C].artdescrip;
                document.getElementById('mprvedd3').value = obj.data[C].id_artprove; //codigo2
                document.getElementById('mdecripprvvd3').value = obj.data[C].descrip_proveedor; //descripción
                document.getElementById('editcacmp').value = obj.data[C].cantidad;
                document.getElementById('ediobsercmp').value = obj.data[C].observación;
            }
        }
    });
}

function editcomp() {
    //alert("entra edicion");
    document.getElementById('openedicmpp').style.display = "none";
    document.getElementById('closeditcmpp').style.display = "";
    document.getElementById('mcodigotr3').disabled = false;
    document.getElementById('mprvedd3').disabled = false;
    document.getElementById('editcacmp').disabled = false;
    document.getElementById('ediobsercmp').disabled = false;
    document.getElementById('cmppguardar').style.display = "";
}

function closedthcomp() {
    //alert("entra fin edición");
    document.getElementById('openedicmpp').style.display = "";
    document.getElementById('closeditcmpp').style.display = "none";
    document.getElementById('mcodigotr3').disabled = true;
    document.getElementById('mprvedd3').disabled = true;
    document.getElementById('editcacmp').disabled = true;
    document.getElementById('ediobsercmp').disabled = true;
    document.getElementById('cmppguardar').style.display = "none";
}

function saveetharcmp() {
    //alert("enra");
    let folio_oc = document.getElementById('ordncompras').innerHTML;
    let idarti = document.getElementById('id_artincm').value;
    let id_articulo = document.getElementById('mcodigotr3').value;
    let id_artprove = document.getElementById('mprvedd3').value;
    let cantidad = document.getElementById('editcacmp').value;
    let observación = document.getElementById('ediobsercmp').value;
    let datos = 'folio_oc=' + folio_oc + '&idarti=' + idarti + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=updateart';
    //alert(datos);
    if (folio_oc == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
        document.getElementById('edthvovacioscm').style.display = ''
        setTimeout(function() {
            document.getElementById('edthvovacioscm').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updatdetll();
                closedthcomp();
                $('#modal-edith').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {
                document.getElementById('edthdvoblicm').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdvoblicm').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthvoerrcm').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthvoerrcm').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}

function deletenewart1(idedcmart) {
    //alert("entra");
    let folio = idedcmart;
    document.getElementById('del_artcmdtt').value = idedcmart;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == idedcmart) {
                //alert("entro");
                document.getElementById('deartcmdett').value = obj.data[C].id_articulo + ' / ' + obj.data[C].id_artprove;
            }
        }
    })
}

function edithsurcopr(idartprov) {
    //alert("etra");
    let folio = idartprov;
    document.getElementById('id_surtarcm').value = idartprov;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        //alert(respuesta);
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == idartprov) {
                //alert("entro");
                document.getElementById('codisurtjlm').value = obj.data[C].id_articulo;
                document.getElementById('codisurtprove').value = obj.data[C].id_artprove; //codigo2
                document.getElementById('surtartcm').value = obj.data[C].cantidad;
                document.getElementById('surbsereped').value = obj.data[C].observación;
                document.getElementById('surtartcm2').value = obj.data[C].cantidad;
            }
        }
    });
}

function edithsurcmp() {
    document.getElementById('surtircmpprf').style.display = "none";
    document.getElementById('closeditcmppinf').style.display = "";
    document.getElementById('codisurtjlm').disabled = false;
    document.getElementById('codisurtprove').disabled = false;
    document.getElementById('surtartcm').disabled = false;
}

function closefirmsurt() {
    document.getElementById('surtircmpprf').style.display = "";
    document.getElementById('closeditcmppinf').style.display = "none";
    document.getElementById('codisurtjlm').disabled = true;
    document.getElementById('codisurtprove').disabled = true;
    document.getElementById('surtartcm').disabled = true;
}

function confirmsurt() {
    //alert("pruebas");
    let folio = document.getElementById('ordncompras').innerHTML;
    let fecha = document.getElementById('datecomp').value;
    let fecha_entrga = document.getElementById('datentrega').value;
    let id_proveedor = document.getElementById('proveedcm').value;
    let uso_CFDI = document.getElementById('uscfdicm').value;
    let cond_pago = document.getElementById('condcm').value;
    let asignado = document.getElementById('consignada').value;
    let id_articulo = document.getElementById('codisurtjlm').value;
    let id_artprove = document.getElementById('codisurtprove').value;
    let cantidad = document.getElementById('surtartcm').value;
    let observación = document.getElementById('surbsereped').value;
    let id_comp = document.getElementById('id_surtarcm').value;
    let comparcant = document.getElementById('surtartcm2').value;

    let datos = 'folio=' + folio + '&id_comp=' + id_comp + '&fecha=' + fecha + '&comparcant=' + comparcant + '&fecha_entrga=' + fecha_entrga + '&id_proveedor=' + id_proveedor + '&uso_CFDI=' + uso_CFDI + '&cond_pago=' + cond_pago + '&asignado=' + asignado + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=entrada';
    //alert(datos);
    if (folio == '' || fecha == '' || id_proveedor == '' || uso_CFDI == '' || cantidad == '' || id_artprove == '' || id_articulo == '') {
        document.getElementById('edthcppvaciosin').style.display = ''
        setTimeout(function() {
            document.getElementById('edthcppvaciosin').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                closefirmsurt();
                updatdetll();
                $('#modal-entrada').modal('hide');
            } else if (respuesta == 2) {
                document.getElementById('edthdcppblinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdcppblinf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthcpperrinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthcpperrinf').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}

function infsurti(id_surtido) {
    //alert(id_surtido);
    let folio = id_surtido;
    document.getElementById('idsurt').value = id_surtido;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        //alert(respuesta);
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == id_surtido) {
                //alert("entro");
                document.getElementById('descsurt').innerHTML = obj.data[C].id_artprove + '/' + obj.data[C].id_articulo + '/' + obj.data[C].artdescrip;
                document.getElementById('cartsur').innerHTML = obj.data[C].entradarel;
                document.getElementById('cartsur2').innerHTML = obj.data[C].cantidadreal;
                document.getElementById('opstsur').innerHTML = obj.data[C].observación;
                //document.getElementById('cantidadreal').innerHTML = obj.data[C].cantidadreal;

            }
        }
    });
}
//ABRE EDICION DE MODAL SURTIDO
function openedithsurt() {
    document.getElementById('editarsur').style.display = "";
    document.getElementById('infsur').style.display = "none";
    document.getElementById('opesurt1').style.display = "none";
    document.getElementById('clossurt1').style.display = "";
}
//ABRE EDICION DE MODAL SURTIDO PRODUCTO FINAL
function closedithsurt() {
    document.getElementById('editarsur').style.display = "none";
    document.getElementById('infsur').style.display = "";
    document.getElementById('opesurt1').style.display = "";
    document.getElementById('clossurt1').style.display = "none";
}

function savesurtcm() {
    let refe_2 = document.getElementById('idsurt').value;
    let refe_1 = document.getElementById('ordncompras').innerHTML;
    let cantidad = document.getElementById('cnsurt').value;
    let cantidadreal = document.getElementById('cartsur2').innerHTML;
    let observa_dep = document.getElementById('obdepinf').value;

    let datos = 'refe_2=' + refe_2 + '&refe_1=' + refe_1 + '&cantidad=' + cantidad + '&cantidadreal=' + cantidadreal + '&observa_dep=' + observa_dep + '&opcion=entradaeth';
    alert(datos);
    if (refe_2 == '' || refe_1 == '' || cantidad == '') {
        document.getElementById('edthcppvaciosin').style.display = ''
        setTimeout(function() {
            document.getElementById('edthcppvaciosin').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                closedithsurt();
                updatdetll();
            } else if (respuesta == 2) {
                document.getElementById('edthdcppblinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdcppblinf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthcpperrinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthcpperrinf').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}

function entradaparcial(idartprov) {
    //alert("etra");
    let folio = idartprov;
    document.getElementById('id_surtarcm2').value = idartprov;
    $.ajax({
        url: '../controller/php/compartinf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        //alert(respuesta);
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_comp == idartprov) {
                //alert("entro");
                let total = obj.data[C].entradarel;
                document.getElementById('codisurtjlm2').value = obj.data[C].id_articulo;
                document.getElementById('codisurtprove2').value = obj.data[C].id_artprove; //codigo2
                document.getElementById('surtartcm4').value = obj.data[C].entradarel;
                document.getElementById('surbsereped2').value = obj.data[C].observación;
                document.getElementById('surtartcm3').value = obj.data[C].cantidadreal;
                document.getElementById('surtartcm5').value = obj.data[C].cantidadreal - obj.data[C].entradarel;
                document.getElementById('id_surtarcm2oc').value = Number(total) + Number(document.getElementById('surtartcm5').value);

                $('#surtartcm5').change(function() {
                    document.getElementById('id_surtarcm2oc').value = Number(total) + Number(document.getElementById('surtartcm5').value);
                });

            }
        }
    });
}

function confirmsurtparc() {
    //alert("confirmsurtparc");
    let folio = document.getElementById('ordncompras').innerHTML;
    let id_articulo = document.getElementById('codisurtjlm2').value;
    let id_artprove = document.getElementById('codisurtprove2').value;
    let cantidad = document.getElementById('id_surtarcm2oc').value;
    let observación = document.getElementById('surbsereped2').value;
    let id_comp = document.getElementById('id_surtarcm2').value;
    let total = document.getElementById('surtartcm3').value;
    let estatukardex = '';
    if (total > cantidad) {
        estatukardex = '2'
    } else {
        estatukardex = '1'
    }
    let datos = 'folio=' + folio + '&id_comp=' + id_comp + '&total=' + total + '&estatukardex=' + estatukardex + '&id_articulo=' + id_articulo + '&id_artprove=' + id_artprove + '&cantidad=' + cantidad + '&observación=' + observación + '&opcion=entradaparcial';
    //alert(datos);
    if (folio == '' || id_articulo == '' || id_artprove == '' || cantidad == '' || total == '') {
        document.getElementById('edthcppvaciosin2').style.display = ''
        setTimeout(function() {
            document.getElementById('edthcppvaciosin2').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertcompras.php",
            data: datos
        }).done(function(respuesta) {
            //alert(respuesta);
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se agrego el articulo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modal-entradaparcial').modal('hide');
                updatdetll();
            } else if (respuesta == 2) {
                document.getElementById('edthdcppblinf2').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdcppblinf2').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthcpperrinf2').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthcpperrinf2').style.display = 'none';
                }, 1000);
                alert(respuesta);
            }
        })
    }
}

function histmaterdv() {
    let folio = document.getElementById('ordncompras').innerHTML;
    let folio2 = "FOLIO:" + folio;
    //alert(folio);
    //Tabla de historial del vale de producción
    $.ajax({
        url: '../controller/php/histshop.php',
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
    //Historial del vale en productividad
}
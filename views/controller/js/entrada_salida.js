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
                let refe_1 = document.getElementById('dffolio').value;
                let fecha = document.getElementById('dffecha').value;
                let deptamt = document.getElementById('dffdeped').value;
                let cliente = document.getElementById('dfcliente').value;
                //alert(datos);
                if (refe_1 == '' || fecha == '' || deptamt == '' || cliente == '') {
                    document.getElementById('vaciosdf').style.display = ''
                    setTimeout(function() {
                        document.getElementById('vaciosdf').style.display = 'none';
                    }, 2000);
                    return;
                } else {
                    //alert(respuesta);
                    Swal.fire({
                        type: 'success',
                        text: 'Se AGREGO el vale de producción de forma correcta',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout("location.href = 'matdefectuoso.php';", 1500);
                }
            }
        });

    });
    $(document).ready(function() {
        $('#buscarticulos').load('./select/busartped.php');
        $('#busccodigomem2').load('./select/buscarme2.php');
        $('#buspedidodef').load('./select/buscpedef.php');
        $('#dffdeped').select2();
        $('#dfcliente').select2();
        //$('#pedmatdef').load('./select/buscpedef.php');
    });
}

function opendefectuoso() {

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
                messageTop: 'RESUMEN DE VALE DE OFICINA',
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
        "ajax": "../controller/php/condefectuoso.php",
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


function addmatdefctuoso() {
    //alert("entro agregar vale de producción");
    let refe_1 = document.getElementById('dffolio').value;
    let fecha = document.getElementById('dffecha').value;
    let descripcion_1 = document.getElementById('dfmotivo').value;
    let proveedor_cliente = document.getElementById('dfcliente').value;
    let codigo_1 = document.getElementById('mcodigotr').value;
    let cantidad_real = document.getElementById('vpcantidad').value;
    let salida = document.getElementById('vpcantidad').value;
    let observa = document.getElementById('dfbservo').value;
    //let refe_3 = document.getElementById('estadodef').value;
    let refe_2 = document.getElementById('dffdeped').value;
    //let ubicacion = document.getElementById('pedidomem').value;
    //let caracter = document.getElementById('vpcaracter').value;
    //multiselect de pedido-----
    var tPrfil = ''
    var selectObject = document.getElementById("pedidoensal");
    for (var i = 0; i < selectObject.options.length; i++) {
        if (selectObject.options[i].selected == true) {
            tPrfil += ',' + selectObject.options[i].value;
        }
    }
    ubicacion = tPrfil.substr(1);
    let datos = 'refe_1=' + refe_1 + '&refe_2=' + refe_2 + '&fecha=' + fecha + '&descripcion_1=' + descripcion_1 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=registrar';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || proveedor_cliente == '' || codigo_1 == '') {
        document.getElementById('vaciosdf').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosdf').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertsalidentra.php",
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
                updatedefect();
            } else if (respuesta == 2) {
                document.getElementById('dublidf').style.display = ''
                setTimeout(function() {
                    document.getElementById('dublidf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('errdf').style.display = ''
                setTimeout(function() {
                    document.getElementById('errdf').style.display = 'none';
                }, 1000);
            }
        })
    }
}

//FUNCION PARA AGREGAR UN NUEVO FOLIO
function foliomatdefect() {
    //alert("entra folios");
    let tipo = "MATERIAL_DEFECTUOSO"
        //--------------------------
    let datos = 'tipo=' + tipo + '&opcion=gefolio';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertsalidentra.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            setTimeout("location.href = 'newdefectuoso.php';", 1500);
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
//CANCELADO
function cancelar() {
    //alert("entra cancelar");
    let refe_1 = document.getElementById('dffolio').value;
    let datos = 'refe_1=' + refe_1 + '&opcion=cancelar';
    $.ajax({
        type: "POST",
        url: "../controller/php/insertsalidentra.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se cancelelo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'matdefectuoso.php';", 1500);
        } else if (respuesta == 2) {
            document.getElementById('dublidf').style.display = ''
            setTimeout(function() {
                document.getElementById('dublidf').style.display = 'none';
            }, 1000);
            //alert("datos repetidos");
        } else {
            document.getElementById('errdf').style.display = ''
            setTimeout(function() {
                document.getElementById('errdf').style.display = 'none';
            }, 1000);
        }
    })
}

function updatedefect() {
    //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
    document.getElementById('mcodigotr').value = "";
    document.getElementById('mdecriptr').value = "";
    document.getElementById('vpcantidad').value = "";
    document.getElementById('dfbservo').value = "";
    document.getElementById('mdepart').value = "";
    //INFORMACION DE LAS TBLAS
    let id_valeproduc = document.getElementById('dffolio').value;
    let folio = document.getElementById('dffolio').value;
    //alert(folio);
    $.ajax({
        url: '../controller/php/infdefctuoso.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            let id_valepro = obj.data[U].id_kax;
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsmt(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithmtdefc'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearmtnew'>Eliminar</a>" + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listartdef").html(html);
    })

}

//funcion para traer la informacion del material defectuoso 
function infodefect(foliodefc) {
    //alert(foliodefc);
    document.getElementById('fmdi').innerHTML = foliodefc;
    $("#detalles").toggle(250); //Muestra contenedor 
    $("#lista").toggle("fast"); //Oculta lista

    $.ajax({
        url: '../controller/php/condefe.php',
        type: 'GET',
        data: 'folio=' + foliodefc
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        for (D = 0; D < res.length; D++) {
            document.getElementById('infecdf').value = obj.data[D].fecha;
            document.getElementById('infdepmd').value = obj.data[D].refe_2;
            document.getElementById('motdf').value = obj.data[D].descripcion_1;
            document.getElementById('infclinte').value = obj.data[D].proveedor_cliente;
            document.getElementById('relajlmdf').value = obj.data[D].revision;
            document.getElementById('pedmatdef').value = obj.data[D].ubicacion
                //alert(datos);
                /*let area = obj.data[D].ubicacion; //area
                var data1 = area.split(',');
                $("#pedidoensal").val(data1).trigger('change.select2');*/
                //$('#pedmatdef').load('./select/buscpedef.php');
        }
    })


    $.ajax({
        url: '../controller/php/infdefctuoso.php',
        type: 'GET',
        data: 'folio=' + foliodefc
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            let id_valepro = obj.data[U].id_kax;
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsmt1(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithmtdefc1'>Editar</a><a class='nav-link' onclick='deletenewart1(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearmtnew1'>Eliminar</a>" + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listdefinf").html(html);

    })

}

//FUNCION PARA EDITAR MATERIAL DEFCTUOSO EN VISTA DE INFORMACION
function editmatdef() {
    //alert("EDITAR VALE");
    $("#infecdf").removeAttr("readonly");
    $("#infsolivo").removeAttr("readonly");
    $("#motdf").removeAttr("readonly");
    $("#pedmatdef").removeAttr("readonly");
    document.getElementById('infclinte').disabled = false;
    document.getElementById('infdepmd').disabled = false;
    document.getElementById('closemted').style.display = "";
    document.getElementById('openedimt1').style.display = "none";
    document.getElementById('mtedith').style.display = "";
    document.getElementById('voagartic').style.display = "";


}
//FUNCION PARA CERRAR MATERIAL DEFCTUOSO EN VISTA DE INFORMACION
function closedithmdef() {
    //alert("cierra VALE");
    $("#infecdf").attr("readonly", "readonly");
    $("#infsolivo").attr("readonly", "readonly");
    $("#motdf").removeAttr("readonly");
    $("#pedmatdef").removeAttr("readonly");
    document.getElementById('infclinte').disabled = true;
    document.getElementById('infdepmd').disabled = true;
    document.getElementById('closemted').style.display = "none";
    document.getElementById('openedimt1').style.display = "";
    document.getElementById('mtedith').style.display = "none";
    document.getElementById('voagartic').style.display = "none";
}

//ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN
function editarinsmt(idedimp) {
    //alert(idedimp);
    let folio = idedimp;
    document.getElementById('id_exedith').value = idedimp;
    $.ajax({
        url: '../controller/php/detallesdf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_kax == idedimp) {
                //alert("entro");
                document.getElementById('cdnewvpedith').value = obj.data[C].codigo_1;
                document.getElementById('vpednewtcantid').value = obj.data[C].salida;
                document.getElementById('vpobsaddnew').value = obj.data[C].observa;
                document.getElementById('vpnewedithdes').value = obj.data[C].artdescrip;
                document.getElementById('vpedthdeparnew').value = obj.data[C].artubicac;
                document.getElementById('id_exedith').value = obj.data[C].id_kax;
            }
        }
    });
}

//FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS EN ALTA DE VALE
function saveedithnewmf() {
    //alert("entra guardar cambios valeproducción");
    let id_kax = document.getElementById('id_exedith').value;
    let codigo_1 = document.getElementById('cdnewvpedith').value;
    let descripcion_1 = document.getElementById('dfmotivo').value;
    let salida = document.getElementById('vpednewtcantid').value;
    let observa = document.getElementById('vpobsaddnew').value;
    let datos = '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew';
    //alert(datos);
    if (codigo_1 == '' || salida == '') {
        document.getElementById('edithextnewlle').style.display = '';
        setTimeout(function() {
            document.getElementById('edithextnewlle').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertsalidentra.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateedinemt();
                closeditextalta();
                $('#modal-edithmtdefc').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {
                document.getElementById('edthdmminf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdmminf').style.display = 'none';
                }, 1000);
                //alert(respuesta);
                //alert("datos repetidos");
            } else {
                document.getElementById('erraetiqnew').style.display = '';
                setTimeout(function() {
                    document.getElementById('erraetiqnew').style.display = 'none';
                }, 2000);
                alert(respuesta);
            }
        });
    }
}

//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN
function editarextalta() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithext').style.display = "";
    document.getElementById('openedithext').style.display = "none";
    document.getElementById('saveedithext').style.display = "";
    document.getElementById('cdnewvpedith').disabled = false;
    document.getElementById('vpednewtcantid').disabled = false;
    document.getElementById('vpobsaddnew').disabled = false;
}
//FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN
function closeditextalta() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithext').style.display = "none";
    document.getElementById('openedithext').style.display = "";
    document.getElementById('saveedithext').style.display = "none";
    document.getElementById('cdnewvpedith').disabled = true;
    document.getElementById('vpednewtcantid').disabled = true;
    document.getElementById('vpobsaddnew').disabled = true;
}

function updateedinemt() {
    let folio = document.getElementById('dffolio').value;
    //alert(folio);
    $.ajax({
        url: '../controller/php/infdefctuoso.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            let id_valepro = obj.data[U].id_kax;
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsmt(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithmtdefc'>Editar</a><a class='nav-link' onclick='deletenewart(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearmtnew'>Eliminar</a>" + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listartdef").html(html);
    })
}
//LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN ALTA DE PRODUCCIÓN
function deletenewart(id_delete) {
    //alert(id_delete);
    let folio = id_delete;
    document.getElementById('del_artmtnew').value = id_delete;
    $.ajax({
        url: '../controller/php/detallesdf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_kax == id_delete) {
                //alert("entro");
                document.getElementById('deartmtnew').value = obj.data[C].codigo_1;
            }
        }
    })
}

//GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION
function savdelemtart() {
    let id_kardex = document.getElementById('del_artmtnew').value;
    let codigo_1 = document.getElementById('deartmtnew').value;
    let datos = 'id_kardex=' + id_kardex + '&codigo_1=' + codigo_1 + '&opcion=deleartnew';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertsalidentra.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se elimino de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            updatedefect();
            $('#modal-delearmtnew').modal('hide'); //cierra el modal
            // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else {
            document.getElementById('delerarmtnew').style.display = '';
            setTimeout(function() {
                document.getElementById('delerarmtnew').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}
//FUNCION QUE GUARDA LA RELACCION JLM
function saverevicionmdf() {
    let refe_1 = document.getElementById('fmdi').innerHTML;
    let revision = document.getElementById('relajlmdf').value;
    let datos = 'revision=' + revision + '&refe_1=' + refe_1 + '&opcion=revisionac';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertsalidentra.php",
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

//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN DETALLES DE MATERIAL DEFECTUOSO
function editarextalta1() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithext1').style.display = "";
    document.getElementById('openedithext1').style.display = "none";
    document.getElementById('saveedithext1').style.display = "";
    document.getElementById('cdnewvpedith1').disabled = false;
    document.getElementById('vpednewtcantid1').disabled = false;
    document.getElementById('vpobsaddnew1').disabled = false;
}
//FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN DETALLES DE MATERIAL DEFECTUOSO
function closeditextalta1() {
    //alert("edit articulo infovalesds");
    document.getElementById('closedithext1').style.display = "none";
    document.getElementById('openedithext1').style.display = "";
    document.getElementById('saveedithext1').style.display = "none";
    document.getElementById('cdnewvpedith1').disabled = true;
    document.getElementById('vpednewtcantid1').disabled = true;
    document.getElementById('vpobsaddnew1').disabled = true;
}
//LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN DETALLES DE MATERIAL DEFECTUOSO
function deletenewart1(id_delete) {
    //alert(id_delete);
    let folio = id_delete;
    document.getElementById('del_artmtnew1').value = id_delete;
    $.ajax({
        url: '../controller/php/detallesdf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_kax == id_delete) {
                //alert("entro");
                document.getElementById('deartmtnew1').value = obj.data[C].codigo_1;
            }
        }
    })
}
//ABRIR EDITAR EXTENDIDO EN DETALLES DE MATERIAL DEFECTUOSO
function editarinsmt1(idedimp) {
    //alert(idedimp);
    let folio = idedimp;
    document.getElementById('id_exedith1').value = idedimp;
    $.ajax({
        url: '../controller/php/detallesdf.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) {
            if (obj.data[C].id_kax == idedimp) {
                //alert("entro");
                document.getElementById('cdnewvpedith1').value = obj.data[C].codigo_1;
                document.getElementById('vpednewtcantid1').value = obj.data[C].salida;
                document.getElementById('vpobsaddnew1').value = obj.data[C].observa;
                document.getElementById('vpnewedithdes1').value = obj.data[C].artdescrip;
                document.getElementById('vpedthdeparnew1').value = obj.data[C].artubicac;
                document.getElementById('id_exedith1').value = obj.data[C].id_kax;
            }
        }
    });
}

//FUNIÓN PARA GUARDAR LA EDICIÓN EN DETALLES DE MATERIAL DEFECTUOSO
function saveedithnewmf1() {
    //alert("entra guardar cambios valeproducción");
    let id_kax = document.getElementById('id_exedith1').value;
    let codigo_1 = document.getElementById('cdnewvpedith1').value;
    let descripcion_1 = document.getElementById('motdf').value;
    let salida = document.getElementById('vpednewtcantid1').value;
    let observa = document.getElementById('vpobsaddnew1').value;
    let datos = '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew';
    //alert(datos);
    if (codigo_1 == '' || salida == '') {
        document.getElementById('edithextnewlle').style.display = '';
        setTimeout(function() {
            document.getElementById('edithextnewlle').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertsalidentra.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updateedinemt1();
                closeditextalta1();
                $('#modal-edithmtdefc1').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {
                document.getElementById('edthdmminf1').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdmminf1').style.display = 'none';
                }, 1000);
                //alert(respuesta);
                //alert("datos repetidos");
            } else {
                document.getElementById('erraetiqnew1').style.display = '';
                setTimeout(function() {
                    document.getElementById('erraetiqnew1').style.display = 'none';
                }, 2000);
                alert(respuesta);
            }
        });
    }
}

//funcion para traer la informacion del material defectuoso 
function updateedinemt1(foliodefc) {
    //alert(foliodefc);
    let folio = document.getElementById('fmdi').innerHTML;
    $(document).ready(function() {
        //$('#pedmatdef').load('./select/buscpedef.php');
    });
    $.ajax({
        url: '../controller/php/condefe.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        for (D = 0; D < res.length; D++) {
            document.getElementById('infecdf').value = obj.data[D].fecha;
            document.getElementById('infdepmd').value = obj.data[D].refe_2;
            document.getElementById('motdf').value = obj.data[D].descripcion_1;
            document.getElementById('infclinte').value = obj.data[D].proveedor_cliente;
            document.getElementById('relajlmdf').value = obj.data[D].revision;
            document.getElementById('pedmatdef').value = obj.data[D].ubicacion
                //alert(datos);
                /*let area = obj.data[D].ubicacion; //area
                var data1 = area.split(',');
                $("#pedidoensal").val(data1).trigger('change.select2');*/

        }
    });
    $.ajax({
        url: '../controller/php/infdefctuoso.php',
        type: 'GET',
        data: 'folio=' + folio
    }).done(function(resp) {
        //alert(resp);
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="defectuoso" name="defectuoso" class="table table-bordered""><thead class="thead-colored thead-purple"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            x++;
            let id_valepro = obj.data[U].id_kax;
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].artdescrip + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsmt1(" + id_valepro + ");' class='nav-link' data-toggle='modal' data-target='#modal-edithmtdefc1'>Editar</a><a class='nav-link' onclick='deletenewart1(" + id_valepro + ");' data-toggle='modal' data-target='#modal-delearmtnew1'>Eliminar</a>" + "</td></tr>";
        }
        html += '</div></tbody></table></div></div>';
        $("#listdefinf").html(html);

    })
}
//GUARDA LA ELIMINACION POR ARTICULO DE DETALLE MATERIAL DEFECTUOSO
function savdelemtart1() {
    let id_kardex = document.getElementById('del_artmtnew1').value;
    let codigo_1 = document.getElementById('deartmtnew1').value;
    let datos = 'id_kardex=' + id_kardex + '&codigo_1=' + codigo_1 + '&opcion=deleartnew';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertsalidentra.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se elimino de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            updateedinemt1();
            $('#modal-delearmtnew1').modal('hide'); //cierra el modal
            // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        } else {
            document.getElementById('delerarmtnew1').style.display = '';
            setTimeout(function() {
                document.getElementById('delerarmtnew1').style.display = 'none';
            }, 2000);
            //alert(respuesta);
        }
    });
}
//cambio de ARTICULO DE DETALLE MATERIAL DEFECTUOSO
function edithextnewmd1() {
    //alert("eentraarticulo")
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == document.getElementById('cdnewvpadd1').value) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#mddescrip1").val(o[1]);
                $("#mddepart1").val(o[2]);
            }
        }
    });
}
//cambio de ARTICULO DE DETALLE MATERIAL DEFECTUOSO
function edithextnewmd2() {
    //alert("eentraarticulo")
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith1').value) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#vpnewedithdes1").val(o[1]);
                $("#vpedthdeparnew1").val(o[2]);
            }
        }
    });
}

function addartimd() {
    //alert("entro agregar vale de producción");
    let refe_1 = document.getElementById('fmdi').innerHTML;
    let fecha = document.getElementById('infecdf').value;
    let descripcion_1 = document.getElementById('motdf').value;
    let proveedor_cliente = document.getElementById('infclinte').value;
    let codigo_1 = document.getElementById('cdnewvpadd1').value;
    let cantidad_real = document.getElementById('mtcantidad1').value;
    let salida = document.getElementById('mtcantidad1').value;
    let observa = document.getElementById('observo1').value;
    //let refe_3 = document.getElementById('estadodef').value;
    let refe_2 = document.getElementById('infdepmd').value;
    let ubicacion = document.getElementById('pedmatdef').value;
    //let caracter = document.getElementById('vpcaracter').value;
    //multiselect de pedido-----
    /* var tPrfil = ''
     var selectObject = document.getElementById("pedidoensal");
     for (var i = 0; i < selectObject.options.length; i++) {
         if (selectObject.options[i].selected == true) {
             tPrfil += ',' + selectObject.options[i].value;
         }
     }
     ubicacion = tPrfil.substr(1);*/
    let datos = 'refe_1=' + refe_1 + '&refe_2=' + refe_2 + '&fecha=' + fecha + '&descripcion_1=' + descripcion_1 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=registrar';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || proveedor_cliente == '' || codigo_1 == '') {
        document.getElementById('edthvovacios1').style.display = ''
        setTimeout(function() {
            document.getElementById('edthvovacios1').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertsalidentra.php",
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
                updateedinemt1();
                document.getElementById('cdnewvpadd1').value = "";
                document.getElementById('mddescrip1').value = "";
                document.getElementById('mddepart1').value = "";
                document.getElementById('mtcantidad1').value = "";
                document.getElementById('observo1').value = "";
            } else if (respuesta == 2) {
                document.getElementById('edthdvobli1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthdvobli1').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthvoerr1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthvoerr1').style.display = 'none';
                }, 1000);
            }
        })
    }
}

function histmaterdef() {
    let folio = document.getElementById('fmdi').innerHTML;
    let folio2 = "FOLIO:" + folio;
    //alert(folio);
    //Tabla de historial del vale de producción
    $.ajax({
        url: '../controller/php/hismaterdefe.php',
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
//FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DE MATERIAL DEFECTUOSO
function savevofic() {
    var fecha = document.getElementById('infecdf').value;
    var descripcion_1 = document.getElementById('motdf').value;
    var ubicacion = document.getElementById('pedmatdef').value;
    var refe_1 = document.getElementById('fmdi').innerHTML;
    var refe_2 = document.getElementById('infdepmd').value;
    var proveedor_cliente = document.getElementById('infclinte').value;
    var datos = 'fecha=' + fecha + '&descripcion_1=' + descripcion_1 + '&refe_2=' + refe_2 + '&ubicacion=' + ubicacion + '&refe_1=' + refe_1 + '&proveedor_cliente=' + proveedor_cliente + '&opcion=cambiocab';
    //alert(datos);
    if (document.getElementById('fmdi').value == '' || document.getElementById('infdepmd').value == '' || document.getElementById('infclinte').value == '') {
        document.getElementById('edthvoivacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthvoivacios').style.display = 'none';
        }, 2000);
        return;
    } else {
        $.ajax({
            type: "POST",
            url: "../controller/php/insertsalidentra.php",
            data: datos
        }).done(function(respuesta) {
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
//cambio de ARTICULO DE DETALLE MATERIAL DEFECTUOSO
function edithextnewmd() {
    //alert("eentraarticulo")
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith').value) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#vpnewedithdes").val(o[1]);
                $("#vpedthdeparnew").val(o[2]);
            }
        }
    });
}
//FUNCIÓN PARA CREAR PDF
function pdfvp() {
    var folio = document.getElementById('fmdi').innerHTML;
    //alert("entro");
    url = '../formatos/pdf_defectuoso.php'
    window.open(url + "?data=" + folio, '_black');
}
function pdfhistorymd() {
    var folio = document.getElementById('fmdi').innerHTML;
    //alert("entro");
    url = '../formatos/pdf_reporthistorydf.php'
    window.open(url + "?data=" + folio, '_black');
}
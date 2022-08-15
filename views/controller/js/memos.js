function openmemo() {
    $(document).ready(function() {
        'use strict';
        $('#wizard6').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            transitionEffect: "fade",
            autoFocus: true,
            errorSteps: [],
            next: 'Siguiente',
            previous: 'Anterior',
            finish: 'Finalizar',
            enableFinishButton: true,
            loadingTemplate: '<span class="spinner"></span> #text#',
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            cssClass: 'wizard wizard-style-2',
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
                let refe_1 = document.getElementById('mfolio').value;
                let fecha = document.getElementById('mfecha').value;
                let refe_2 = document.getElementById('mtipo').value;
                let refe_3 = document.getElementById('mdep').value;
                //--------------------------
                let datos = 'refe_1=' + refe_1 + '&opcion=addmemo';
                if (refe_1 == '' || fecha == '' || refe_3 == '' || refe_2 == '') {
                    Swal.fire({
                        type: 'warning',
                        text: 'Llenar todos los campos',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../controller/php/insertmemo.php",
                        data: datos
                    }).done(function(respuesta) {
                        if (respuesta == 0) {
                            setTimeout("location.href = 'memos.php';", 1500);
                        } else if (respuesta == 2) {

                        } else {
                            alert(respuesta);
                            Swal.fire({
                                type: 'warning',
                                text: 'Contactar a soporte tecnico',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                }
            }
        });
    });

}

//FUNCIONES PARA GUARDAR ARTICULOS PARA TRASPASO
function addmemo() {
    //alert("entro memo");
    var refe_1 = document.getElementById('mfolio').value; //FOLIO DEL MEMO
    var fecha = document.getElementById('mfecha').value;
    var refe_3 = document.getElementById('mtipo').value;
    var proveedor_cliente = document.getElementById('mdep').value;
    var codigo_1 = document.getElementById('mcodigotr').value;
    var descripcion_1 = document.getElementById('mdecriptr').value;
    var cantidad_real = document.getElementById('memocantidad').value;
    var salida = document.getElementById('memocantidad').value;
    var observa = document.getElementById('memobservo').value;
    var ubicacion = document.getElementById('mdepart').value;
    //var refe_2 = document.getElementById('pedidomem').value;
    //multiselect de pedidos-----
    var pedido = ''
    var selectObject = document.getElementById("pedidomem");
    for (var i = 0; i < selectObject.options.length; i++) {
        if (selectObject.options[i].selected == true) {
            pedido += ',' + selectObject.options[i].value;
        }
    }
    var refe_2 = pedido.substr(1);
    //--------------------------

    var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=regismemo';
    //var datos =$('#personal-ext').serialize();
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
        document.getElementById('vaciosme').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosme').style.display = 'none';
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
                var id_memo = document.getElementById('mfolio').value;
                $.ajax({
                    url: '../controller/php/infaltmemo.php',
                    type: 'POST'
                }).done(function(resp) {
                    obj = JSON.parse(resp);
                    var res = obj.data;
                    var x = 0;
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
//FUNCION PARA AGREGAR UN NUEVO FOLIO
function foliomemo() {
    //alert("entra folios");
    let tipo = "MEMO"
        //--------------------------
    let datos = 'tipo=' + tipo + '&opcion=gefolio';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertmemo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            setTimeout("location.href = 'newmemo.php';", 1500);
        } else if (respuesta == 2) {

        } else {
            alert(respuesta);
            Swal.fire({
                type: 'warning',
                text: 'Contactar a soporte tecnico',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
}
//FUNCION ACTUALIZA TABLAS DE MEMOS EN ALTA DE MEMOS
function updatememoalt() {
    var id_memo = document.getElementById('mfolio').value;
    $.ajax({
        url: '../controller/php/infaltmemo.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
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
}

function cleanalttras() {
    document.getElementById('mcodigotr').value = "";
    document.getElementById('mdecriptr').value = "";
    document.getElementById('memocantidad').value = "";
    document.getElementById('mdepart').value = "";
    document.getElementById('memobservo').value = "";
}

//FUNCION ACTUALIZA TABLAS DE MEMOS EN ALTA DE MEMOS
function updatememoaltf() {
    var id_memo = document.getElementById('mfolio').value;
    $.ajax({
        url: '../controller/php/infaltmemo.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datamemo2" name="datamemo2" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemoalt2();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemoalta'>Editar</a><a onclick='delartmemalt2();' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal'>Eliminar</a>" + "</td></tr>";

            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemotra").html(html);
        'use strict';
        $('#datamemo2').DataTable({
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

//FUNCIONES PARA GUARDAR ARTICULOS TRASPASADOS
function addmemofin() {
    //alert("entro memo2");
    //alert("entra");
    var refe_1 = document.getElementById('mfolio').value; //FOLIO DEL MEMO
    var fecha = document.getElementById('mfecha').value;
    var refe_3 = document.getElementById('mtipo').value;
    var proveedor_cliente = document.getElementById('mdep').value;
    var codigo_1 = document.getElementById('mcodigotsp').value;
    var descripcion_1 = document.getElementById('medescrip2').value;
    var cantidad_real = document.getElementById('mecantidad2').value;
    var ubicacion = document.getElementById('memdepart2').value;
    var observa = document.getElementById('memobservo2').value;
    var salida = document.getElementById('mecantidad2').value;
    //var refe_2 = document.getElementById('pedidomem').value;
    //multiselect de pedidos-----
    var pedido = ''
    var selectObject = document.getElementById("pedidomem");
    for (var i = 0; i < selectObject.options.length; i++) {
        if (selectObject.options[i].selected == true) {
            pedido += ',' + selectObject.options[i].value;
        }
    }
    var refe_2 = pedido.substr(1);
    //--------------------------

    var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=regmemofin';
    //var datos =$('#personal-ext').serialize();
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
        document.getElementById('vaciosme2').style.display = ''
        setTimeout(function() {
            document.getElementById('vaciosme2').style.display = 'none';
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

                var id_memo = document.getElementById('mfolio').value;
                $.ajax({
                    url: '../controller/php/infaltmemo.php',
                    type: 'POST'
                }).done(function(resp) {
                    obj = JSON.parse(resp);
                    var res = obj.data;
                    var x = 0;
                    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="datamemo2" name="datamemo2" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>SALIDA</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
                    for (U = 0; U < res.length; U++) {
                        if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO') {
                            x++;
                            $id_memo2 = obj.data[U].id_kax;
                            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemoalt2();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemoalta'>Editar</a><a onclick='delartmemalt2();' class='nav-link' data-toggle='modal' data-target='#modal-deleteartal'>Eliminar</a>" + "</td></tr>";

                        }
                    }
                    html += '</div></tbody></table></div></div>';
                    $("#listmemotra").html(html);
                    'use strict';
                    $('#datamemo2').DataTable({
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
                document.getElementById('dublime2').style.display = ''
                setTimeout(function() {
                    document.getElementById('dublime2').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('errme2').style.display = ''
                setTimeout(function() {
                    document.getElementById('errme2').style.display = 'none';
                }, 1000);
            }
        })
    }

}
//FUNCION QUE ABRE LOS DETALLES DEL MEMO EN ALTA DE MEMO
function infmemo(id_memo) {
    //alert(id_memo);
    $("#detamemos").toggle(250); //Muestra contenedor de detalles
    $("#lista").toggle("fast"); //Oculta lista
    document.getElementById('folmemo').innerHTML = id_memo;
    var autorizar = document.getElementById('btnautoriz');
    var liberar = document.getElementById('btnliberar');
    var surtir = document.getElementById('btnsurtir');
    var finalizado = document.getElementById('btnfinaliz');
    var editar = document.getElementById('openedimem1');
    var imprimir = document.getElementById('pdfmem');
    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].refe_1 == id_memo) {
                document.getElementById('memorefeped').value = obj.data[D].refe_2;
                document.getElementById('relajlmem').value = obj.data[D].revision;
                document.getElementById('memoform').value = obj.data[D].crea;
                document.getElementById('memoautor').value = obj.data[D].autoriza;
                document.getElementById('memosurt').value = obj.data[D].surtio;
                datos =
                    obj.data[D].fecha + '*' +
                    obj.data[D].refe_3 + '*' +
                    obj.data[D].proveedor_cliente + '*' +
                    obj.data[D].status + '*' +
                    obj.data[D].codigo_1 + '*' +
                    obj.data[D].refe_2;
                var o = datos.split("*");
                $("#infecmem").val(o[0]);
                $("#intipomemo").val(o[1]);
                $("#infsolimem").val(o[2]);
                $("#infestamem").val(o[3]);
                $("#trans").html(o[1]);
                //$("#memorefeped").val(o[5]);

                if (obj.data[D].status == 'PENDIENTE') {
                    autorizar.style.display = '';
                    editar.style.display = ''
                } else if (obj.data[D].status == 'AUTORIZADO') {
                    surtir.style.display = '';
                    liberar.style.display = '';
                    imprimir.style.display = '';
                    editar.style.display = 'none'
                } else if (obj.data[D].status == 'SURTIDO') {
                    finalizado.style.display = '';
                    liberar.style.display = '';
                    imprimir.style.display = '';
                    editar.style.display = 'none'
                } else if (obj.data[D].status == 'FINALIZADO') {
                    liberar.style.display = '';
                    imprimir.style.display = '';
                    editar.style.display = 'none'
                }
            }
        }
    });
    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;

        html = '<div class="bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvmemtras" name="infvmemtras" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            //estatus pendiente
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'PENDIENTE') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo($id_memo2);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartmeminf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartif'>Eliminar</a>" + "</td></tr>";
                //AUTORIZADO
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'AUTORIZADO' && obj.data[U].status_2 == 'PENDIENTE') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                //estatus = "<button type='button' onclick='surtirvpf(" + id_valepro + ");' class='btn btn-info mg-b-10' title='Dar click para surtir' data-toggle='modal' data-target='#modal-surtirvprod'>SURTIR</button>"
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td></tr>";
                //finalizado
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'FINALIZADO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td></tr>";
                //SURTIDO
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'SURTIDO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemo1").html(html);
    });

    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;

        html = '<div class="bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvmemtras1" name="infvmemtras1" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            //estatus pendiente 2
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'PENDIENTE') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo2($id_memo3);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartmeminf2();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartif'>Eliminar</a>" + "</td></tr>";
                //AUTORIZADO 2
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'AUTORIZADO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td></tr>";
                //finalizado 2
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'FINALIZADO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
                //PENDIENTE 2
            } else if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'SURTIDO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemo2").html(html);
    });
}
//FUNCIÓN DE AUTORIZAR MEMO 
function autorizarm() {
    //alert("entra memo");
    var status = 'AUTORIZADO';
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos = 'folio=' + folio + '&opcion=autorizarmem';
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
            url: "../controller/php/insertmemo.php",
            data: datos
        }).done(function(respuesta) {
            if (respuesta == 0) {
                Swal.fire({
                    type: 'success',
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout("location.href = 'memos.php';", 1500);
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
                    text: 'Error contactar a soporte tecnico',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

    }
}
//FUNCIÓN DE SURTIR MEMO 
function surtirme() {
    //alert("entra surtir ememo");
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos = 'folio=' + folio + '&opcion=surtirmem';
    // alert(datos);

    if (folio == '') {
        Swal.fire({
            type: 'warning',
            text: 'No hay folio',
            showConfirmButton: false,
            timer: 1500
        });
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout("location.href = 'memos.php';", 1500);
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
                    text: 'Error contactar a soporte tecnico',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

    }
}
//FUNCIÓN DE FINALIZAR MEMO 
function finalimemo() {
    //alert("entra finalizar ememo");
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos = 'folio=' + folio + '&opcion=finalmem';
    //alert(datos);

    if (folio == '') {
        Swal.fire({
            type: 'warning',
            text: 'No hay folio',
            showConfirmButton: false,
            timer: 1500
        });
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout("location.href = 'memos.php';", 1500);
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
                    text: 'Error contactar a soporte tecnico',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });

    }
}
//FUNCION DE ELIMINAR MEMO
function delememos(memos) {
    //alert(memos); 
    document.getElementById('devamemo').value = memos;
}
//FUNCIONES DE GUARDAR ELIMINAR
function savedemem() {
    //alert("memos"); 
    var pedido = document.getElementById('devamemo').value;
    var datos = 'pedido=' + pedido + '&opcion=deletememo';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertmemo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'SE ELIMINO MEMO DE FORMA CORRECTA',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
        } else {
            document.getElementById('delerrvo').style.display = '';
            setTimeout(function() {
                document.getElementById('delerrvo').style.display = 'none';
            }, 2500);
        }
    });
}

//FUNCIONES DE LIBERAR MEMO
function liberarm() {
    //alert("memos"); 
    var memo = document.getElementById('folmemo').innerHTML;
    var datos = 'memo=' + memo + '&opcion=liberarmem';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertmemo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'SE LIBERO FORMA CORRECTA',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
        } else {
            document.getElementById('delerrvo').style.display = '';
            setTimeout(function() {
                document.getElementById('delerrvo').style.display = 'none';
            }, 2500);
        }
    });
}
//FUNCION PARA EDITAR MEMO EN VISTA DE INFORMACION
function editmemo() {
    //alert("EDITAR memo");
    var fecha = $("#infecmem").removeAttr("readonly");
    var fecha = $("#memorefeped").removeAttr("readonly");
    document.getElementById('intipomemo').disabled = false;
    document.getElementById('infsolimem').disabled = false;
    document.getElementById('infestamem').disabled = false;
    document.getElementById('memedith').style.display = "";
    document.getElementById('memagartic').style.display = "";
    document.getElementById('memagartic2').style.display = "";
    document.getElementById('openedimem1').style.display = "none";
    document.getElementById('closememo1').style.display = "";
    document.getElementById('btnautoriz').style.display = "none";


}
//FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function closedithvmem() {
    //alert("cierra VALE");
    var fecha1 = $("#infecmem").attr("readonly", "readonly");
    var fecha1 = $("#memorefeped").attr("readonly", "readonly");
    document.getElementById('intipomemo').disabled = true;
    document.getElementById('infsolimem').disabled = true;
    document.getElementById('infestamem').disabled = true;
    document.getElementById('memedith').style.display = "none";
    document.getElementById('memagartic').style.display = "none";
    document.getElementById('memagartic2').style.display = "none";
    document.getElementById('closememo1').style.display = "none";
    document.getElementById('openedimem1').style.display = "";
    document.getElementById('btnautoriz').style.display = "";
}

function histvalepro() {
    let folio = document.getElementById('folmemo').innerHTML;
    let folio2 = "FOLIO:" + folio;
    //alert(folio);
    //Tabla de historial del vale de producción
    $.ajax({
        url: '../controller/php/hisvaleprod.php',
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
    $.ajax({
        url: '../controller/php/productiv.php',
        type: 'POST',
        data: 'folio=' + folio
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        //alert("folio");
        for (D = 0; D < res.length; D++) {
            document.getElementById('fcreacion').innerHTML = obj.data[D].fecha_creacion1;
            document.getElementById('fautoriz').innerHTML = obj.data[D].fecha_autorizacion1;
            document.getElementById('fsurtido').innerHTML = obj.data[D].fecha_surtido1;
            document.getElementById('ffinaliz').innerHTML = obj.data[D].fecha_finalizacion1;
            //DIAS
            if (obj.data[D].dias_totales > 0) {
                document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
                document.getElementById('dias2').innerHTML = obj.data[D].dias_asurtdo + " dias Autorización/Surtido";
                document.getElementById('dias3').innerHTML = obj.data[D].dias_totales + " dias trascurridos para finalización ";
            }
            if (obj.data[D].dias_totales == null) {
                document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
                document.getElementById('dias2').innerHTML = obj.data[D].dias_asurtdo + " dias Autorización/Surtido";
                document.getElementById('dias3').innerHTML = "Sin finalizar";
            }
            if (obj.data[D].dias_asurtdo == null) {
                document.getElementById('dias1').innerHTML = obj.data[D].dias_autorizacion + " dias Creación/Autorización";
                document.getElementById('dias2').innerHTML = "Sin surtir";
                document.getElementById('dias3').innerHTML = "Sin finalizar";
            }
            if (obj.data[D].dias_autorizacion == null) {
                document.getElementById('dias1').innerHTML = "Sin autorizar";
                document.getElementById('dias2').innerHTML = "Sin surtir";
                document.getElementById('dias3').innerHTML = "Sin finalizar";
            }
        }
    });
}
//FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE TRASFORMACION VISTA PREVIA
function editarmemo() {
    //alert("entrta");
    $("#infvmemtras tr").on('click', function() {
        let id_armemin1 = "";
        id_armemin1 += $(this).find('td:eq(1)').html();
        document.getElementById('id_meminf').value = id_armemin1;
        //alert(id_armemin1);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            let res = obj.data;
            let x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == id_armemin1) {
                    datos =
                        obj.data[U].codigo_1 + '*' +
                        obj.data[U].descripcion_1 + '*' +
                        obj.data[U].salida + '*' +
                        obj.data[U].ubicacion + '*' +
                        obj.data[U].observa;
                    let d = datos.split("*");
                    $("#modal-editarmemo #arsurmem").val(d[0]);
                    $("#modal-editarmemo #edithmeades").val(d[1]);
                    $("#modal-editarmemo #editcameminf").val(d[2]);
                    $("#modal-editarmemo #editdepinfme").val(d[3]);
                    $("#modal-editarmemo #infobsereme").val(d[4]);
                }
            }
        });
    })
}

//FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE ALTA DE MEMO EN EDITAR
function editarmemoalt() {
    // alert("entrta editar alata");
    $("#datamemo tr").on('click', function() {
        let id_armemin1 = "";
        id_armemin1 += $(this).find('td:eq(0)').html();
        document.getElementById('id_memtrass').value = id_armemin1;
        //alert(id_armemin1);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            let res = obj.data;
            let x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == id_armemin1) {
                    datos =
                        obj.data[U].codigo_1 + '*' +
                        obj.data[U].descripcion_1 + '*' +
                        obj.data[U].salida + '*' +
                        obj.data[U].ubicacion + '*' +
                        obj.data[U].observa;
                    let d = datos.split("*");
                    $("#modal-editarmemoalta #coditrasal").val(d[0]);
                    $("#modal-editarmemoalta #mdestrasp").val(d[1]);
                    $("#modal-editarmemoalta #editcamemalt").val(d[2]);
                    $("#modal-editarmemoalta #editdepmemal").val(d[3]);
                    $("#modal-editarmemoalta #bseremealt").val(d[4]);
                }
            }
        });
    })
}

//FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE ALTA DE MEMO EN EDITAR
function editarmemoalt2() {
    // alert("entrta editar alata");
    $("#datamemo2 tr").on('click', function() {
        let id_armemin1 = "";
        id_armemin1 += $(this).find('td:eq(0)').html();
        document.getElementById('id_memtrass').value = id_armemin1;
        //alert(id_armemin1);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            let res = obj.data;
            let x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == id_armemin1) {
                    datos =
                        obj.data[U].codigo_1 + '*' +
                        obj.data[U].descripcion_1 + '*' +
                        obj.data[U].salida + '*' +
                        obj.data[U].ubicacion + '*' +
                        obj.data[U].observa;
                    let d = datos.split("*");
                    $("#modal-editarmemoalta #coditrasal").val(d[0]);
                    $("#modal-editarmemoalta #mdestrasp").val(d[1]);
                    $("#modal-editarmemoalta #editcamemalt").val(d[2]);
                    $("#modal-editarmemoalta #editdepmemal").val(d[3]);
                    $("#modal-editarmemoalta #bseremealt").val(d[4]);
                }
            }
        });
    })
}
//FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE TRASFORMACION VISTA PREVIA
function edithartalta() {
    //alert("entrta");
    $("#datamemo tr").on('click', function() {
        let id_alttras = "";
        id_alttras += $(this).find('td:eq(1)').html();
        document.getElementById('id_meminf').value = id_alttras;
        //alert(id_alttras);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            let res = obj.data;
            let x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == id_alttras) {
                    datos =
                        obj.data[U].codigo_1 + '*' +
                        obj.data[U].descripcion_1 + '*' +
                        obj.data[U].salida + '*' +
                        obj.data[U].ubicacion + '*' +
                        obj.data[U].observa;
                    let d = datos.split("*");
                    $("#modal-editarmemoalta #arsurmem").val(d[0]);
                    $("#modal-editarmemoalta #edithmeades").val(d[1]);
                    $("#modal-editarmemoalta #editcameminf").val(d[2]);
                    $("#modal-editarmemoalta #editdepinfme").val(d[3]);
                    $("#modal-editarmemoalta #infobsereme").val(d[4]);
                }
            }
        });
    })
}
//FUCIÓN PARA LLENAR INFORMACIÓN DEL ARTICULO DE TRASPASO EN VISTA PREVIA
function editarmemo2() {
    //alert(id_artimem2);
    $("#infvmemtras1 tr").on('click', function() {
        let id_armemin2 = "";
        id_armemin2 += $(this).find('td:eq(1)').html();
        document.getElementById('id_meminf').value = id_armemin2;
        //alert(id_armemin2);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == id_armemin2) {
                    datos =
                        obj.data[U].codigo_1 + '*' +
                        obj.data[U].descripcion_1 + '*' +
                        obj.data[U].salida + '*' +
                        obj.data[U].ubicacion + '*' +
                        obj.data[U].observa;
                    var d = datos.split("*");
                    $("#modal-editarmemo #arsurmem").val(d[0]);
                    $("#modal-editarmemo #edithmeades").val(d[1]);
                    $("#modal-editarmemo #editcameminf").val(d[2]);
                    $("#modal-editarmemo #editdepinfme").val(d[3]);
                    $("#modal-editarmemo #infobsereme").val(d[4]);
                }
            }
        });
    })
}
//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS MEMO ALTA MEMO
function editartmemoal() {
    //alert("edit articulo infovalesds");
    document.getElementById('closeditras').style.display = "";
    document.getElementById('openeditras').style.display = "none";
    document.getElementById('memguardaral').style.display = "";
    document.getElementById('editcamemalt').disabled = false;
    document.getElementById('bseremealt').disabled = false;
    document.getElementById('coditrasal').disabled = false;
}
//FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS MEMO ALTA MEMO
function closeditmemal() {
    //alert("edit articulo infovalesds");
    document.getElementById('closeditras').style.display = "none";
    document.getElementById('openeditras').style.display = "";
    document.getElementById('memguardaral').style.display = "none";
    document.getElementById('editcamemalt').disabled = true;
    document.getElementById('bseremealt').disabled = true;
    document.getElementById('coditrasal').disabled = true;
}

//FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS MEMO VISTA DE INFORMACIÓN
function editartmemoinf() {
    //alert("edit articulo infovalesds");
    document.getElementById('closeditmemartinf').style.display = "";
    document.getElementById('openedimemarinf').style.display = "none";
    document.getElementById('memguardarinf').style.display = "";
    document.getElementById('editcameminf').disabled = false;
    document.getElementById('infobsereme').disabled = false;
    document.getElementById('arsurmem').disabled = false;
}
//FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS MEMO VISTA DE INFORMACIÓN
function closeditmeminf() {
    //alert("edit articulo infovalesds");
    document.getElementById('closeditmemartinf').style.display = "none";
    document.getElementById('openedimemarinf').style.display = "";
    document.getElementById('memguardarinf').style.display = "none";
    document.getElementById('editcameminf').disabled = true;
    document.getElementById('infobsereme').disabled = true;
    document.getElementById('arsurmem').disabled = true;
}
//FUNCION ACTUALIZA TABLAS DE MEMOS EN VISTA PREVIA
function updatememo() {
    let refe_1 = document.getElementById('folmemo').innerHTML;
    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;

        html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvmemtras" name="infvmemtras" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            //estatus pendiente
            if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'PENDIENTE') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo($id_memo2);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartmeminf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartif'>Eliminar</a>" + "</td></tr>";
                //finalizado
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'FINALIZADO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'AUTORIZADO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION' && obj.data[U].status == 'SURTIDO') {
                x++;
                $id_memo2 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down responsive'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10 responsive'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemo1").html(html);
    });

    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvmemtras1" name="infvmemtras1" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>#</th><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {
            //estatus pendiente
            if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'PENDIENTE') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo2($id_memo3);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartmeminf2();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartif'>Eliminar</a>" + "</td></tr>";
                //finalizado
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'FINALIZADO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'AUTORIZADO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            } else if (obj.data[U].refe_1 == refe_1 && obj.data[U].tipo == 'MEMO' && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO' && obj.data[U].status == 'SURTIDO') {
                x++;
                $id_memo3 = obj.data[U].id_kax;
                html += "<tr><td>" + x + "</td><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'>" + "</td></tr>";
            }
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemo2").html(html);
    });

}
//FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO VISTA DE INFORMACIÓN
function saveinfethmem() {
    //alert("entra guardar cambios memeo");
    let refe_1 = document.getElementById('folmemo').innerHTML;
    let id_kax = document.getElementById('id_meminf').value;
    let codigo_1 = document.getElementById('arsurmem').value;
    let descripcion_1 = document.getElementById('edithmeades').value;
    let salida = document.getElementById('editcameminf').value;
    let observa = document.getElementById('infobsereme').value;

    let datos = 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=actualizainf';
    //alert(datos);
    if (codigo_1 == '' || salida == '') {
        document.getElementById('edthmemaciosin').style.display = '';
        setTimeout(function() {
            document.getElementById('edthmemaciosin').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updatememo(); //llama a la función para actualizar la tabla ARREGLAR AQUI

                $('#modal-editarmemo').modal('hide'); //cierra el modal
                closeditmeminf();
            } else if (respuesta == 2) {
                document.getElementById('edthdmeminf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdmeminf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthmemerrinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthmemerrinf').style.display = 'none';
                }, 2000);
            }
        });
    }

}

//FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO ALTA TRASPASO 01052022
function savealtethmem() {
    //alert("entra guardar cambios memeo");
    let refe_1 = document.getElementById('mfolio').value;
    let id_kax = document.getElementById('id_memtrass').value;
    let codigo_1 = document.getElementById('coditrasal').value;
    let descripcion_1 = document.getElementById('mdestrasp').value;
    let salida = document.getElementById('editcamemalt').value;
    let observa = document.getElementById('bseremealt').value;

    let datos = 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=actualizainf';
    //alert(datos);
    if (codigo_1 == '' || salida == '') {
        document.getElementById('edthmmciosal').style.display = '';
        setTimeout(function() {
            document.getElementById('edthmmciosal').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                closeditmemal();
                updatememoalt(); //llama a la función para actualizar la tabla
                updatememoaltf();
                $('#modal-editarmemoalta').modal('hide'); //cierra el modal
            } else if (respuesta == 2) {
                document.getElementById('edthdmminf').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthdmminf').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthmmerinfr').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthmmerinfr').style.display = 'none';
                }, 2000);
            }
        });
    }
}
//FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR EN MEMO VISTA PREVIA
function delartmeminf() {;
    //alert("entra ELIMINAR articulo");
    $("#infvmemtras tr").on('click', function() {
        var memfi = "";
        memfi += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
        document.getElementById('del_artmeminf').value = memfi
            //alert(memfi);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == memfi) {
                    datos =
                        obj.data[U].codigo_1;
                    var d = datos.split("*");
                    $("#modal-deleteartif #deartmeinf").val(d[0]);
                }
            }
        });
    })
}
//FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR ALTA DE MEMO
function delartmemalt() {;
    //alert("entra ELIMINAR articulo");
    $("#datamemo tr").on('click', function() {
        var memfi = "";
        memfi += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
        document.getElementById('del_artmemalt').value = memfi
            //alert(memfi);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == memfi) {
                    datos =
                        obj.data[U].codigo_1;
                    var d = datos.split("*");
                    $("#modal-deleteartal #deartmeal").val(d[0]);
                }
            }
        });
    })
}
//FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR ALTA DE MEMO
function delartmemalt2() {;
    //alert("entra ELIMINAR articulo");
    $("#datamemo2 tr").on('click', function() {
        var memfi = "";
        memfi += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
        document.getElementById('del_artmemalt').value = memfi
            //alert(memfi);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == memfi) {
                    datos =
                        obj.data[U].codigo_1;
                    var d = datos.split("*");
                    $("#modal-deleteartal #deartmeal").val(d[0]);
                }
            }
        });
    })
}
//FUNCION QUE TRAE EL CODIGO DE EL ARTICULO A ELIMINAR EN MEMO VISTA PREVIA
function delartmeminf2() {;
    //alert("entra ELIMINAR articulo");
    $("#infvmemtras1 tr").on('click', function() {
        var memfi1 = "";
        memfi1 += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
        document.getElementById('del_artmeminf').value = memfi1
            //alert(memfi1);
        $.ajax({
            url: '../controller/php/memo1.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) {
                if (obj.data[U].id_kax == memfi1) {
                    datos =
                        obj.data[U].codigo_1;
                    var d = datos.split("*");
                    $("#modal-deleteartif #deartmeinf").val(d[0]);
                }
            }
        });
    })
}

//FUNCION QUE GUARDA LA ELIMINACIÓN DEL MEMO
function savdelemeinf() {;
    //alert("entra ELIMINAR articulo");
    let id_kax = document.getElementById('del_artmeminf').value;
    let refe_1 = document.getElementById('folmemo').innerHTML;

    let datos = '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=delinfarm';
    //alert(datos);
    if (id_kax == '') {
        document.getElementById('edthmemaciosin').style.display = '';
        setTimeout(function() {
            document.getElementById('edthmemaciosin').style.display = 'none';
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
                    text: 'Se elimino de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updatememo(); //llama a la función para actualizar la tabla

                $('#modal-deleteartif').modal('hide'); //cierra el modal
            } else {
                document.getElementById('delerarmeinf').style.display = '';
                setTimeout(function() {
                    document.getElementById('delerarmeinf').style.display = 'none';
                }, 2000);
            }
        });
    }

}

//FUNCION QUE GUARDA LA ELIMINACIÓN DEL MEMO EN ALTA DE MEMO
function savdelemeal() {;
    //alert("entra ELIMINAR articulo");
    let id_kax = document.getElementById('del_artmemalt').value;
    let refe_1 = document.getElementById('deartmeal').value;

    let datos = '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=delinfarm';
    //alert(datos);
    if (id_kax == '') {
        document.getElementById('edthmemaciosin').style.display = '';
        setTimeout(function() {
            document.getElementById('edthmemaciosin').style.display = 'none';
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
                    text: 'Se elimino de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                updatememoalt(); //llama a la función para actualizar la tabla
                updatememoaltf();

                $('#modal-deleteartal').modal('hide'); //cierra el modal
            } else {
                document.getElementById('delerarmeal').style.display = '';
                setTimeout(function() {
                    document.getElementById('delerarmeal').style.display = 'none';
                }, 2000);
            }
        });
    }

}
//cambio de descripcion articulo traspaspaso
function desartrasmem() {
    //alert("eentraarticulo")
    let codivo = document.getElementById('coditrasmem').value;
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == codivo) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#mdescriptras").val(o[1]);
                $("#mdepartras").val(o[2]);

            }
        }
    });
}
//cambio de descripcion articulo traspaspaso en alta de memo
function destrasmemalt() {
    //alert("eentraarticulo")
    let codivo = document.getElementById('coditrasal').value;
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == codivo) {
                // alert(id_persona);
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].artubicac;
                var o = datos.split("*");
                $("#mdestrasp").val(o[1]);
                $("#editdepmemal").val(o[2]);

            }
        }
    });
}
//GUARDAR ARTICULO EN TRASPASO
function addartimetras() {
    //alert("GUARDA CODIGO");
    var refe_1 = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var fecha = document.getElementById('infecmem').value;
    var refe_3 = document.getElementById('intipomemo').value;
    var proveedor_cliente = document.getElementById('infsolimem').value;
    var codigo_1 = document.getElementById('coditrasmem').value;
    var descripcion_1 = document.getElementById('mdescriptras').value;
    var cantidad_real = document.getElementById('mcantidtras').value;
    var salida = document.getElementById('mcantidtras').value;
    var observa = document.getElementById('mobsertras').value;
    var ubicacion = document.getElementById('mdepartras').value;
    var refe_2 = document.getElementById('memorefeped').value;
    var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=registar3';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
        document.getElementById('edthvmemacios1').style.display = ''
        setTimeout(function() {
            document.getElementById('edthvmemacios1').style.display = 'none';
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
                updatememo();
                limpiardatos();
            } else if (respuesta == 2) {
                document.getElementById('edthdmtbli1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthdmtbli1').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthmeerr1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthmeerr1').style.display = 'none';
                }, 1000);
            }
        })
    }
}
//LIMPIAR MODAL DE AGREGAR
function limpiardatos() {
    document.getElementById('coditrasmem').value = "0";
    document.getElementById('mdescriptras').value = "";
    document.getElementById('mcantidtras').value = "";
    document.getElementById('mdepartras').value = "";
    document.getElementById('mobsertras').value = "";
}
//GUARDAR ARTICULO EN TRASPASADO
function addartimetrasps() {
    //alert("GUARDA CODIGO traspasado");
    var refe_1 = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var fecha = document.getElementById('infecmem').value;
    var refe_3 = document.getElementById('intipomemo').value;
    var proveedor_cliente = document.getElementById('infsolimem').value;
    var codigo_1 = document.getElementById('coditrasmem').value;
    var descripcion_1 = document.getElementById('mdescriptras').value;
    var cantidad_real = document.getElementById('mcantidtras').value;
    var salida = document.getElementById('mcantidtras').value;
    var observa = document.getElementById('mobsertras').value;
    var ubicacion = document.getElementById('mdepartras').value;
    var refe_2 = document.getElementById('memorefeped').value;

    var datos = 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=registar4';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') {
        document.getElementById('edthvmemacios1').style.display = ''
        setTimeout(function() {
            document.getElementById('edthvmemacios1').style.display = 'none';
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
                updatememo();
                limpiardatos();
            } else if (respuesta == 2) {
                document.getElementById('edthdmtbli1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthdmtbli1').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthmeerr1').style.display = ''
                setTimeout(function() {
                    document.getElementById('edthmeerr1').style.display = 'none';
                }, 1000);
            }
        })
    }
}
//MOSTRAR EL BOTON DE GUARDAR ARTICULO PARA TRASPASO
function savetraspa() {
    //alert("entra boto1");
    document.getElementById('addtrasfor').style.display = "";
    document.getElementById('addtrasfor2').style.display = "none";
}
//MOSTRAR EL BOTON DE GUARDAR ARTICULO TRASPASADO
function savetrasfor() {
    //alert("entra boto2");
    document.getElementById('addtrasfor').style.display = "none";
    document.getElementById('addtrasfor2').style.display = "";
}
//FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DEL MEMO EN VISTA PREVIA 
function savecamem() {
    var refe_1 = document.getElementById('folmemo').innerHTML;
    var fecha = document.getElementById('infecmem').value;
    var refe_3 = document.getElementById('intipomemo').value;
    var proveedor_cliente = document.getElementById('infsolimem').value;
    var refe_2 = document.getElementById('memorefeped').value;
    var status = document.getElementById('infestamem').value;

    var datos = 'fecha=' + fecha + '&refe_3=' + refe_3 + '&status=' + status + '&refe_1=' + refe_1 + '&refe_2=' + refe_2 + '&proveedor_cliente=' + proveedor_cliente + '&opcion=cambiocab';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '') {
        document.getElementById('edthmmvacios').style.display = '';
        setTimeout(function() {
            document.getElementById('edthmmvacios').style.display = 'none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500
                });
                closedithvmem()
            } else if (respuesta == 2) {
                document.getElementById('edthmem1iexi').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthmem1iexi').style.display = 'none';
                }, 1000);
                //alert("datos repetidos");
            } else {
                document.getElementById('edthmmerror').style.display = '';
                setTimeout(function() {
                    document.getElementById('edthmmerror').style.display = 'none';
                }, 2000);
            }
        });
    }
}

//CANCELAR ALTA DE MEMOS
function cancealmemo() {
    //alert("entra cancelar");
    let refe_1 = document.getElementById('mfolio').value;
    let datos = 'refe_1=' + refe_1 + '&opcion=cancelar';
    $.ajax({
        type: "POST",
        url: "../controller/php/insertmemo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se cancelelo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
        } else if (respuesta == 2) {

            //alert("datos repetidos");
        } else {
            Swal.fire({
                type: 'warning',
                text: 'Contactar a soporte tecnico',
                showConfirmButton: false,
                timer: 1500
            });
        }
    })
}

function pdfmemo() {
    var folio = document.getElementById('folmemo').innerHTML;
    //alert("entro");
    url = '../formatos/pdf_memo.php'
    window.open(url + "?data=" + folio, '_black');
}

//FUNCION QUE GUARDA LA RELACCION JLM
function saverevicionmem() {
    let refe_1 = document.getElementById('folmemo').innerHTML;
    let revision = document.getElementById('relajlmem').value;
    let datos = 'revision=' + revision + '&refe_1=' + refe_1 + '&opcion=revisionac';
    //alert(datos);
    $.ajax({
        type: "POST",
        url: "../controller/php/insertmemo.php",
        data: datos
    }).done(function(respuesta) {
        if (respuesta == 0) {
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            closevaleproinf();
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
function cargainv() {
    let date = new Date();
    let output = String(date.getDate()).padStart(2, '0') + '/' + String(date.getMonth() + 1).padStart(2, '0') +
        '/' + date.getFullYear();
    //alert(output);
    document.getElementById('mayor').innerHTML = output;
    document.getElementById('menor').innerHTML = output;
    document.getElementById('entradas').innerHTML = output;
    var currentdate = new Date();
    var datetime = "Fecha de Impresion: " + currentdate.getDate() + "/" +
        (currentdate.getMonth() + 1) + "/" +
        currentdate.getFullYear() + " - " +
        currentdate.getHours() + ":" +
        currentdate.getMinutes();

    var table = $('#inventario').DataTable({

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
                messageTop: 'BASE DE ARTICULOS DE INVENTRIO',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                },
                download: 'open',
                header: true,
                title: '',
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 8;
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
        "ajax": "../controller/php/infinventario.php",

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
    // CON ESTO FUNCIONA EL MULTIFILTRO//
    // Datepicker
    $('.fc-datepicker').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true
    });
    $('#datepickerNoOfMonths').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        numberOfMonths: 2
    });
}
//ABRIR EL DETALLE DEL ARTICULO
function opende(id_artic) {
    //alert(id_artic);
    let id_artinv = id_artic;
    opendetllinv(id_artinv);
    //document.getElementById('id_cod').innerHTML = id_artic;
    $("#datalles").toggle(250); //Muestra contenedor de detalles
    $("#inventarios").toggle("fast");
    porarticulo(id_artic); //PORCENTAJES
}
//actualiza los detalles
function actualizar() {
    let codigo = document.getElementById('id_cod').innerHTML
    $.ajax({
        url: '../controller/php/condetallesart.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        let res = obj.data;
        let x = 0;
        for (D = 0; D < res.length; D++) {
            if (obj.data[D].artcodigo == codigo) {
                //existencia
                let suma = Number(obj.data[D].SUMA);
                let resta = Number(obj.data[D].RESTA);
                let inicio = Number(obj.data[D].stock_inicial);
                inventario = inicio + (suma - resta);
                document.getElementById('existe').innerHTML = inventario;
                //porcentaje
                let conteo_entradas = Number(obj.data[D].CUENTA_ENTRADA);
                let conteo_salidas = Number(obj.data[D].CUENTA_SALIDA);
                let totalmovimientos = conteo_entradas + conteo_salidas;
                let porentradas = conteo_entradas * 100 / totalmovimientos;
                let porsalidas = conteo_salidas * 100 / totalmovimientos;
                let porcentradas = porentradas.toFixed(0)
                let porcsalidas = porsalidas.toFixed(0)
                document.getElementById('porentradas').innerHTML = porcentradas + "%";
                document.getElementById('porsalidas').innerHTML = porcsalidas + "%";
                $('#porentradas').width(porentradas + "%").attr('aria-valuenow', porentradas); //movimiento de las barras de %
                $('#porsalidas').width(porsalidas + "%").attr('aria-valuenow', porsalidas); //movimiento de las barras de %
                // fin del porcentaje   
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].stock_inicial + '*' +
                    obj.data[D].RESTA + '*' +
                    obj.data[D].SUMA;
                let o = datos.split("*");
                $("#idartic").val(o[0]);
                $("#noartdell").html(o[1]);
                $("#stockini").html(o[2]);
                document.getElementById('entradas2').innerHTML = "ENTRADAS: " + obj.data[D].SUMA;
                document.getElementById('salidas2').innerHTML = "SALIDAS: " + obj.data[D].RESTA;
            }
        }
    });
}
//FUNCION PARA ABRIR LOS DETALLES DEL INVENTARIO
function opendetllinv(id_artinv) {
    //alert(id_artinv);
    let fec_inicio = document.getElementById('vpfechaini').value;
    let fec_fin = document.getElementById('vpfechafin').value;
    var table = $('#datakardex').DataTable({
        lengthMenu: [
            [20, 10, 20, -1],
            [20, 10, 20, 'Todos']
        ],
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Generar PDF',
                messageTop: 'KARDEX DEL ARTICULO: ' + id_artinv,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                },
                download: 'open',
                header: true,
                title: '',
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 8;
                    doc['footer'] = (function(page, pages) {
                        return {
                            columns: [{
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
                            }],
                            margin: [25, 0]
                        }
                    });


                }
            },
            {
                extend: 'excel',
                text: 'Generar Excel',
                messageTop: 'KARDEX DEL ARTICULO: ' + id_artinv,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
            "lengthMenu": "mostrando _MENU_ paginas",
            "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
        },
        // "order": [
        //     [5, "asc"]
        // ],
        "ajax": {
            "url": "../controller/php/conkardex.php",
            "type": "GET",
            "data": function(d) {
                d.id_artinv = id_artinv;
                d.fec_inicio = fec_inicio;
                d.fec_fin = fec_fin;
            }
        },
    });
    // CON ESTO FUNCIONA EL MULTIFILTRO//
    $('#inventario thead tr').clone(true).appendTo('#inventario thead');
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
    });
}
//FUNCION PARA ABRIR LOS DETALLES DEL INVENTARIO 2 ACTUALIZACIÓN
function recargarg2() {
    $("#datakardex").dataTable().fnDestroy();
    let id_artinv = document.getElementById('idartic').value;
    let fec_inicio = document.getElementById('vpfechaini').value;
    let fec_fin = document.getElementById('vpfechafin').value;
    //alert(id_artinv);
    var table = $('#datakardex').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                extend: 'pdfHtml5',
                text: 'Generar PDF',
                messageTop: 'KARDEX DEL ARTICULO: ' + id_artinv,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                },
                download: 'open',
                header: true,
                title: '',
                customize: function(doc) {
                    doc.defaultStyle.fontSize = 8;
                    doc.styles.tableHeader.fontSize = 8;
                    doc['footer'] = (function(page, pages) {
                        return {
                            columns: [{
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
                            }],
                            margin: [25, 0]
                        }
                    });


                }
            },
            {
                extend: 'excel',
                text: 'Generar Excel',
                messageTop: 'KARDEX DEL ARTICULO: ' + id_artinv,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
        "ajax": {
            "url": "../controller/php/conkardex.php",
            "type": "GET",
            "data": function(d) {
                d.id_artinv = id_artinv;
                d.fec_inicio = fec_inicio;
                d.fec_fin = fec_fin;
            }
        },
    });
    // CON ESTO FUNCIONA EL MULTIFILTRO//
    $('#inventario thead tr').clone(true).appendTo('#inventario thead');
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
    });
}
//FUNCION PARA HACER LOS PORCENTAJES DEL DETALLE DE ARTICULO
function porarticulo(id_artic) {
    //alert(id_artic);
    $.ajax({
        url: '../controller/php/condetallesart.php',
        type: 'GET',
        data: 'id_artic=' + id_artic
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        let res = obj.data;
        let x = 0;
        for (D = 0; D < res.length; D++) {
            //alert(respuesta);
            if (obj.data[D].id_art == id_artic) {
                //existencia
                document.getElementById('id_cod').innerHTML = obj.data[D].artcodigo;
                let suma = Number(obj.data[D].SUMA);
                let resta = Number(obj.data[D].RESTA);
                let inicio = Number(obj.data[D].stock_inicial);
                inventario = inicio + (suma - resta);
                document.getElementById('existe').innerHTML = inventario;
                //porcentaje
                let conteo_entradas = Number(obj.data[D].CUENTA_ENTRADA);
                let conteo_salidas = Number(obj.data[D].CUENTA_SALIDA);
                let totalmovimientos = conteo_entradas + conteo_salidas;
                let porentradas = conteo_entradas * 100 / totalmovimientos;
                let porsalidas = conteo_salidas * 100 / totalmovimientos;
                let porcentradas = porentradas.toFixed(0)
                let porcsalidas = porsalidas.toFixed(0)
                document.getElementById('porentradas').innerHTML = porcentradas + "%";
                document.getElementById('porsalidas').innerHTML = porcsalidas + "%";
                $('#porentradas').width(porentradas + "%").attr('aria-valuenow', porentradas); //movimiento de las barras de %
                $('#porsalidas').width(porsalidas + "%").attr('aria-valuenow', porsalidas); //movimiento de las barras de %
                // fin del porcentaje   
                datos =
                    obj.data[D].artcodigo + '*' +
                    obj.data[D].artdescrip + '*' +
                    obj.data[D].stock_inicial + '*' +
                    obj.data[D].RESTA + '*' +
                    obj.data[D].SUMA;
                let o = datos.split("*");
                $("#idartic").val(o[0]);
                $("#noartdell").html(o[1]);
                $("#stockini").html(o[2]);
                document.getElementById('entradas2').innerHTML = "ENTRADAS: " + obj.data[D].SUMA;
                document.getElementById('salidas2').innerHTML = "SALIDAS: " + obj.data[D].RESTA;
            }
        }
    });

}
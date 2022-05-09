
function opende(id_artic){
//alert(id_artic);
document.getElementById('id_cod').innerHTML =id_artic;
    $("#datalles").toggle(250); //Muestra contenedor de detalles
    $("#inventarios").toggle("fast");
    $.ajax({
        url: '../controller/php/condetallesart.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        let res = obj.data;
        let x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].artcodigo == id_artic){
                //existencia
                let suma = Number(obj.data[D].SUMA);
                let resta=Number (obj.data[D].RESTA);
                let inicio =Number(obj.data[D].stock_inicial);
                inventario=  inicio + (suma - resta);
                document.getElementById('existe').innerHTML=inventario;
                //porcentaje
                let conteo_entradas = Number (obj.data[D].CUENTA_ENTRADA);
                let conteo_salidas = Number (obj.data[D].CUENTA_SALIDA);
                let totalmovimientos= conteo_entradas + conteo_salidas;
                let porentradas=conteo_entradas*100/totalmovimientos;
                let porsalidas=conteo_salidas*100/totalmovimientos;
                document.getElementById('porentradas').innerHTML=porentradas + "%";
                document.getElementById('porsalidas').innerHTML=porsalidas + "%";
                $('#porentradas').width(porentradas + "%").attr('aria-valuenow', porentradas); //movimiento de las barras de %
                $('#porsalidas').width(porsalidas + "%").attr('aria-valuenow', porsalidas);//movimiento de las barras de %
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
                document.getElementById('entradas2').innerHTML="ENTRADAS: " + obj.data[D].SUMA;
                document.getElementById('salidas2').innerHTML="SALIDAS: " + obj.data[D].RESTA;
            }
        }
    });

    $.ajax({
        url: '../controller/php/conkardex.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="rounded table-responsive"><table style="width:100%;overflow:scroll;" id="datadatlles" name="datadatlles" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>FECHA</th><th><i></i>REFERENCIA_1</th><th><i></i>REFERENCIA_2</th><th><i></i>TIPO</th><th><i></i>REFERENCIA_3</th><th><i></i>CLASE</th><th><i></i>PROVEEDOR_CLIENTE</th><th><i></i>SALIDA</th><th><i></i>ENTRADA</th></tr></thead><tbody>';
        for (A = 0; A < res.length; A++) {  
            if (obj.data[A].codigo_1 == id_artic){
                x++;
                html += "<tr><td>" + x + "</td><td>" + obj.data[A].codigo_1 + "</td><td>" + obj.data[A].fecha + "</td><td>" + obj.data[A].refe_1 + "</td><td>" + obj.data[A].refe_2 + "</td><td>" + obj.data[A].tipo + "</td><td>" + obj.data[A].refe_3 + "</td><td>" + obj.data[A].tipo_ref + "</td><td>" + obj.data[A].proveedor_cliente + "</td><td>" + obj.data[A].salida + "</td><td>" + obj.data[A].entrada  + "</td></tr>";            
            }            
        }
        html += '</div></tbody></table></div></div>';
        $("#datakardex").html(html);
        'use strict';
        $('#datadatlles').DataTable({
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
//actualiza los detalles
function actualizar(){
    let codigo =document.getElementById('id_cod').innerHTML
    $.ajax({
        url: '../controller/php/condetallesart.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        let res = obj.data;
        let x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].artcodigo == codigo){
                //existencia
                let suma = Number(obj.data[D].SUMA);
                let resta=Number (obj.data[D].RESTA);
                let inicio =Number(obj.data[D].stock_inicial);
                inventario=  inicio + (suma - resta);
                document.getElementById('existe').innerHTML=inventario;
                //porcentaje
                let conteo_entradas = Number (obj.data[D].CUENTA_ENTRADA);
                let conteo_salidas = Number (obj.data[D].CUENTA_SALIDA);
                let totalmovimientos= conteo_entradas + conteo_salidas;
                let porentradas=conteo_entradas*100/totalmovimientos;
                let porsalidas=conteo_salidas*100/totalmovimientos;
                document.getElementById('porentradas').innerHTML=porentradas + "%";
                document.getElementById('porsalidas').innerHTML=porsalidas + "%";
                $('#porentradas').width(porentradas + "%").attr('aria-valuenow', porentradas); //movimiento de las barras de %
                $('#porsalidas').width(porsalidas + "%").attr('aria-valuenow', porsalidas);//movimiento de las barras de %
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
                document.getElementById('entradas2').innerHTML="ENTRADAS: " + obj.data[D].SUMA;
                document.getElementById('salidas2').innerHTML="SALIDAS: " + obj.data[D].RESTA;
            }
        }
    });

    $.ajax({
        url: '../controller/php/conkardex.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="rounded table-responsive"><table style="width:100%;overflow:scroll;" id="datadatlles" name="datadatlles" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>FECHA</th><th><i></i>REFERENCIA_1</th><th><i></i>REFERENCIA_2</th><th><i></i>TIPO</th><th><i></i>REFERENCIA_3</th><th><i></i>CLASE</th><th><i></i>PROVEEDOR_CLIENTE</th><th><i></i>SALIDA</th><th><i></i>ENTRADA</th></tr></thead><tbody>';
        for (A = 0; A < res.length; A++) {  
            if (obj.data[A].codigo_1 == codigo){
                x++;
                html += "<tr><td>" + x + "</td><td>" + obj.data[A].codigo_1 + "</td><td>" + obj.data[A].fecha + "</td><td>" + obj.data[A].refe_1 + "</td><td>" + obj.data[A].refe_2 + "</td><td>" + obj.data[A].tipo + "</td><td>" + obj.data[A].refe_3 + "</td><td>" + obj.data[A].tipo_ref + "</td><td>" + obj.data[A].proveedor_cliente + "</td><td>" + obj.data[A].salida + "</td><td>" + obj.data[A].entrada  + "</td></tr>";            
            }            
        }
        html += '</div></tbody></table></div></div>';
        $("#datakardex").html(html);
        'use strict';
        $('#datadatlles').DataTable({
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


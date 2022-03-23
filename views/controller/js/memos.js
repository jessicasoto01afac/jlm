//FUNCIONES PARA GUARDAR ARTICULOS PARA TRASPASO
function addmemo(){
    //alert("entro memo");
    //alert("entra");
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
    var refe_2 = document.getElementById('pedidomem').value;

    var datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=regismemo';
    //var datos =$('#personal-ext').serialize();
    //alert(datos);
if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') { 
    document.getElementById('vaciosme').style.display=''
    setTimeout(function(){
        document.getElementById('vaciosme').style.display='none';
    }, 2000);
      return;
} else {
    $.ajax({
      type:"POST",
      url:"../controller/php/insertmemo.php",
      data:datos
    }).done(function(respuesta){
        if (respuesta==0){
             Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
        });

        var id_memo = document.getElementById('mfolio').value;
        $.ajax({
          url: '../controller/php/memo1.php',
          type: 'POST'
        }).done(function(resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper"><table style="width:100%" id="datamemo" name="datamemo" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
          for (U = 0; U < res.length; U++) {  
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref =='ARTICULO_TRANSFORMACION'){
              x++;
              html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
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
        }else if (respuesta == 2) {
            document.getElementById('dublivo').style.display=''
            setTimeout(function(){
                document.getElementById('dublivo').style.display='none';
            }, 1000);
        //alert("datos repetidos");
        }else{
            document.getElementById('errvo').style.display=''
            setTimeout(function(){
                document.getElementById('errvo').style.display='none';
            }, 1000);
        }
    })
}
 var id_memo = document.getElementById('mfolio').value;
  $.ajax({
    url: '../controller/php/memo1.php',
    type: 'POST'
  }).done(function(resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper"><table style="width:100%" id="datamemo" name="datamemo" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
          for (U = 0; U < res.length; U++) {  
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref =='ARTICULO_TRANSFORMACION'){
              x++;
              html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
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

//FUNCIONES PARA GUARDAR ARTICULOS TRASPASADOS
function addmemofin(){
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
    var refe_2 = document.getElementById('pedidomem').value;

    var datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&refe_2=' + refe_2 + '&opcion=regmemofin';
    //var datos =$('#personal-ext').serialize();
   //alert(datos);
if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') { 
    document.getElementById('vaciosme2').style.display=''
    setTimeout(function(){
        document.getElementById('vaciosme2').style.display='none';
    }, 2000);
      return;
} else {
    $.ajax({
      type:"POST",
      url:"../controller/php/insertmemo.php",
      data:datos
    }).done(function(respuesta){
        if (respuesta==0){
             Swal.fire({
            type: 'success',
            text: 'Se agrego el articulo de forma correcta',
            showConfirmButton: false,
            timer: 1500
        });

        var id_memo = document.getElementById('mfolio').value;
        $.ajax({
          url: '../controller/php/memo1.php',
          type: 'POST'
        }).done(function(resp) {
          obj = JSON.parse(resp);
          var res = obj.data;
          var x = 0;
          html = '<div class="table-wrapper"><table style="width:100%" id="datamemo2" name="datamemo2" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
          for (U = 0; U < res.length; U++) {  
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref =='ARTICULO_TRANSFORMADO'){
              x++;
              html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
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
        }else if (respuesta == 2) {
            document.getElementById('dublime2').style.display=''
            setTimeout(function(){
                document.getElementById('dublime2').style.display='none';
            }, 1000);
        //alert("datos repetidos");
        }else{
            document.getElementById('errme2').style.display=''
            setTimeout(function(){
                document.getElementById('errme2').style.display='none';
            }, 1000);
        }
    })
}
 var id_memo = document.getElementById('mfolio').value;
  $.ajax({
    url: '../controller/php/memo1.php',
    type: 'POST'
  }).done(function(resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    html = '<div class="table-wrapper"><table style="width:100%" id="datamemo2" name="datamemo2" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
          for (U = 0; U < res.length; U++) {  
            if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref =='ARTICULO_TRANSFORMADO'){
              x++;
              html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
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
//FUNCION QUE ABRE LOS DETALLES DEL MEMO
function infmemo(id_memo){
    //alert(id_memo);

    $("#detamemos").toggle(250); //Muestra contenedor de detalles
    $("#lista").toggle("fast"); //Oculta lista

    document.getElementById('folmemo').innerHTML=id_memo;
    var autorizar = document.getElementById('btnautoriz');
    var liberar = document.getElementById('btnliberar');
    var surtir = document.getElementById('btnsurtir');
    var finalizado = document.getElementById('btnfinaliz');
    var editar = document.getElementById('openedimem1');
    

    $.ajax({
        url: '../controller/php/memo1.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].refe_1 == id_memo){
                datos = 
                obj.data[D].fecha + '*' +
                obj.data[D].refe_3 + '*' +
                obj.data[D].proveedor_cliente + '*' +
                obj.data[D].status + '*' +
                obj.data[D].codigo_1;    
                var o = datos.split("*");   
                $("#infecmem").val(o[0]);   
                $("#intipomemo").val(o[1]);   
                $("#infsolimem").val(o[2]);
                $("#infestamem").val(o[3]);
                $("#trans").html(o[1]);

                if (obj.data[D].status == 'PENDIENTE'){
                    autorizar.style.display = '';
                    editar.style.display= ''
                }else if (obj.data[D].status == 'AUTORIZADO'){
                    surtir.style.display = '';
                    liberar.style.display = '';
                    editar.style.display= 'none'
                }else if (obj.data[D].status == 'SURTIDO'){
                    finalizado.style.display = '';
                    liberar.style.display = '';
                    editar.style.display= ''
                }else if (obj.data[D].status == 'FINALIZADO'){
                    liberar.style.display = '';
                    editar.style.display= ''
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
      
      html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
      for (U = 0; U < res.length; U++) {  
        if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMACION'){
          x++;
        $id_memo=obj.data[U].id_kax;
          html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida  +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo($id_memo);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
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
        
        html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-light"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {  
          if (obj.data[U].refe_1 == id_memo && obj.data[U].tipo_ref == 'ARTICULO_TRANSFORMADO'){
            x++;
            $id_memo=obj.data[U].id_kax;
            html += "<tr><td>" + x + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarmemo($id_memo);' class='nav-link' data-toggle='modal' data-target='#modal-editarmemo'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
          }  
        }
        html += '</div></tbody></table></div></div>';
        $("#listmemo2").html(html);
      });
}
//FUNCIÓN DE AUTORIZAR MEMO 
function autorizarm(){
    //alert("entra memo");
    var status = 'AUTORIZADO';
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos= 'folio=' + folio  + '&opcion=autorizarmem';
    //alert(datos);
  
    if (folio == '' ) { 
        Swal.fire({
            type: 'warning',
            text: 'No hay folio ingresar',
            showConfirmButton: false,
            timer: 1500
        });
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertmemo.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
          }else if (respuesta == 2) {
            Swal.fire({
                type: 'warning',
                text: 'ya esta duplicado',
                showConfirmButton: false,
                timer: 1500
            });
          }else{
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
function surtirme(){
    //alert("entra surtir ememo");
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos= 'folio=' + folio  + '&opcion=surtirmem';
   // alert(datos);
  
    if (folio == '' ) { 
        Swal.fire({
            type: 'warning',
            text: 'No hay folio',
            showConfirmButton: false,
            timer: 1500
        });
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertmemo.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
          }else if (respuesta == 2) {
            Swal.fire({
                type: 'warning',
                text: 'ya esta duplicado',
                showConfirmButton: false,
                timer: 1500
            });
          }else{
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
function finalimemo(){
    //alert("entra finalizar ememo");
    var folio = document.getElementById('folmemo').innerHTML; //FOLIO DEL MEMO
    var datos= 'folio=' + folio  + '&opcion=finalmem';
    //alert(datos);
  
    if (folio == '' ) { 
        Swal.fire({
            type: 'warning',
            text: 'No hay folio',
            showConfirmButton: false,
            timer: 1500
        });
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertmemo.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'memos.php';", 1500);
          }else if (respuesta == 2) {
            Swal.fire({
                type: 'warning',
                text: 'ya esta duplicado',
                showConfirmButton: false,
                timer: 1500
            });
          }else{
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
function delememos(memos){
  //alert(memos); 
  document.getElementById('devamemo').value=memos;
}
//FUNCIONES DE GUARDAR ELIMINAR
function savedemem(){
  //alert("memos"); 
  var pedido = document.getElementById('devamemo').value;
  var datos= 'pedido=' + pedido + '&opcion=deletememo';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/php/insertmemo.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO MEMO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'memos.php';", 1500);
      }else{
          document.getElementById('delerrvo').style.display='';
          setTimeout(function(){
            document.getElementById('delerrvo').style.display='none';
          }, 2500);
        }
    });
}

//FUNCIONES DE GUARDAR ELIMINAR
function liberarm(){
  //alert("memos"); 
  var memo = document.getElementById('folmemo').innerHTML;
  var datos= 'memo=' + memo + '&opcion=liberarmem';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/php/insertmemo.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE LIBERO FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'memos.php';", 1500);
      }else{
          document.getElementById('delerrvo').style.display='';
          setTimeout(function(){
            document.getElementById('delerrvo').style.display='none';
          }, 2500);
        }
    });
}
//FUNCION PARA EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function editmemo(){
  //alert("EDITAR memo");
  var fecha = $("#infecmem").removeAttr("readonly");
  document.getElementById('intipomemo').disabled= false;
  document.getElementById('infsolimem').disabled= false;
  document.getElementById('memedith').style.display="";
  document.getElementById('memagartic').style.display="";
  document.getElementById('closememo').style.display="";
  document.getElementById('openedimem1').style.display="none";
  
}
//FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function closedithvmem(){
  //alert("cierra VALE");
  var fecha1 = $("#infecmem").attr("readonly","readonly");
  document.getElementById('intipomemo').disabled= true;
  document.getElementById('infsolimem').disabled= true;
  document.getElementById('memedith').style.display="none";
  document.getElementById('memagartic').style.display="none";
  document.getElementById('closememo').style.display="none";
  document.getElementById('openedimem1').style.display="";
}
function editarmemo(d){
//alert("entra");
alert(d);

}

function editvoinf1(){
  //alert("edit articulo infovale");

  
  }
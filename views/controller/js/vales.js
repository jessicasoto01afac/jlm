//Funciones para convertir miniscula en mayuscula
function mayus(e){ e.value=e.value.toUpperCase(); } 
//fucnion que cambia a elegir el tipo de vale_oficina
function tipevale(){
    //alert("entro el vale");
    tipo = document.getElementById("vtipo").value;
    interno = document.getElementById("personal");
    ventas = document.getElementById("departamento");
    precio = document.getElementById("precio");
    total = document.getElementById("total");
    if (tipo == 'INTERNO') {
        //alert(tipo);
        interno.style.display = 'none';
        precio.style.display = 'none';
        total.style.display = 'none';
        ventas.style.display = '';
    }if (tipo == 'VENTA') {
        interno.style.display = '';
        total.style.display = '';
        precio.style.display = '';
        ventas.style.display = 'none';
    }
}
//funcion para agregar el total
function totalvo(){
  cantidad1 = document.getElementById("vcantidad").value;
  precio1 = document.getElementById("vprecio").value;
  total1 = document.getElementById("vtotal");
  total1.value= cantidad1 * precio1;
}
//funcion para agregar vale
function addvaleofi(){
        //alert("entra");
        var refe_1 = document.getElementById('vfolio').value; //FOLIO DEL VALE
        var fecha = document.getElementById('vfecha').value; 
        var refe_3 = document.getElementById('vtipo').value;
        var proveedor_cliente = document.getElementById('vdep').value + document.getElementById('vprove').value ; 
        var codigo_1 = document.getElementById('vcodigo').value;
        var descripcion_1 = document.getElementById('vdescrip').value;
        var cantidad_real = document.getElementById('vcantidad').value;
        var salida = document.getElementById('vcantidad').value;
        var observa = document.getElementById('observo').value;
        var costo = document.getElementById('vprecio').value;
        var total = document.getElementById('vtotal').value;
        var ubicacion = document.getElementById('vdepart').value;

        var datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&costo=' + costo + '&total=' + total + '&ubicacion=' + ubicacion + '&opcion=registrar';
        //var datos =$('#personal-ext').serialize();
        //alert(datos);
    if (document.getElementById('vfolio').value == '' || document.getElementById('vfecha').value == '' || document.getElementById('vtipo').value == '' || proveedor_cliente == '' || document.getElementById('vcodigo').value == '' || document.getElementById('vdescrip').value == '' || document.getElementById('vcantidad').value == ''|| document.getElementById('vprecio').value == '') { 
        document.getElementById('vaciosvo').style.display=''
        setTimeout(function(){
            document.getElementById('vaciosvo').style.display='none';
        }, 2000);
          return;
    } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertvaleofi.php",
          data:datos
        }).done(function(respuesta){
            if (respuesta==0){
                 Swal.fire({
                type: 'success',
                text: 'Se agrego articulo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            var id_valeofi = document.getElementById('vfolio').value;
            $.ajax({
              url: '../controller/php/valeofi.php',
              type: 'POST'
            }).done(function(resp) {
              obj = JSON.parse(resp);
              var res = obj.data;
              var x = 0;
              html = '<div class="table-wrapper"><table style="width:100%" id="datavaofi1" name="datavaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
              for (U = 0; U < res.length; U++) {  
                if (obj.data[U].refe_1 == id_valeofi){
                  x++;
                  html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editavo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
                }  
              }
              html += '</div></tbody></table></div></div>';
              $("#listvaleofi").html(html);
              'use strict';
              $('#datavaofi1').DataTable({
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
     var id_valeofi = document.getElementById('vfolio').value;
      $.ajax({
        url: '../controller/php/valeofi.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="table-wrapper"><table style="width:100%" id="datavaofi1" name="datavaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {  
          if (obj.data[U].refe_1 == id_valeofi){
            x++;
                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvo();' class='nav-link' data-toggle='modal' data-target='#modal-editavo'>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
          }  
        }
        html += '</div></tbody></table></div></div>';
        $("#listvaleofi").html(html);
        'use strict';
        $('#datavaofi1').DataTable({
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

//--------------------------------VALE DE OFICINA---------------------------------------------------------------------
//Funcion para habilitar los input de edición de algun articulo
function editvo(){
    //alert("editusuarios");
    document.getElementById('openedivo').style.display="none";
    document.getElementById('closeditvo').style.display="";
    document.getElementById('edicovo').disabled= false;
    document.getElementById('edithdesvo').disabled= false;
    document.getElementById('editcavo').disabled= false;
    document.getElementById('ediobservo').disabled= false;
    document.getElementById('voguardar').style.display="";
}

function closedthvo(){
    //alert("cerrarusu");
        document.getElementById('openedivo').style.display="";
        document.getElementById('closeditvo').style.display="none";
        document.getElementById('edicovo').disabled= true;
        document.getElementById('edithdesvo').disabled= true;
        document.getElementById('editcavo').disabled= true;
        document.getElementById('ediobservo').disabled= true;
        document.getElementById('voguardar').style.display="none";
}
//FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS
function editarvo(){
    //alert("entra editar articulo");
    $("#datavaofi1 tr").on('click', function() {
        var id_valofi = "";
        id_valofi += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
        document.getElementById('id_vo').value=id_valofi
        //alert(id_valofi);
        $.ajax({
            url: '../controller/php/valeofi.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) { 
                if (obj.data[U].id_kax == id_valofi){
                    
                    datos = 
                    obj.data[U].codigo_1 + '*' +
                    obj.data[U].descripcion_1 + '*' +
                    obj.data[U].salida + '*' +
                    obj.data[U].id_kax + '*' +
                    obj.data[U].observa;    
                    var d = datos.split("*");   
                    $("#modal-editavo #edicovo").val(d[0]);   
                    $("#modal-editavo #edithdesvo").val(d[1]);            
                    $("#modal-editavo #editcavo").val(d[2]);
                    $("#modal-editavo #id_vo").val(d[3]);
                    $("#modal-editavo #ediobservo").val(d[4]);
                }
            }
        });
    }) 
}
//FUNCION QUE GUARDA LA EDICIÓN DE VALES DE OFICINA EN AGREGAR ARTICULOS 
function savearvo(){
    var codigo_1 = document.getElementById('edicovo').value;
    var descripcion_1 = document.getElementById('edithdesvo').value;
    var salida = document.getElementById('editcavo').value;
    var observa = document.getElementById('ediobservo').value;
    var id_kax = document.getElementById('id_vo').value;
    

    var datos= 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&opcion=actualizar';
    //alert(datos);

    if (document.getElementById('edicovo').value == '' || document.getElementById('edithdesvo').value == '' || document.getElementById('editcavo').value == '' || document.getElementById('ediobservo').value == '' || document.getElementById('id_vo').value == '') { 
        document.getElementById('edthvovacios').style.display='';
        setTimeout(function(){
          document.getElementById('edthvovacios').style.display='none';
        }, 2000);
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/php/insertvaleofi.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
          }else if (respuesta == 2) {
            document.getElementById('edthdvobli').style.display='';
            setTimeout(function(){
              document.getElementById('edthdvobli').style.display='none';
            }, 1000);
            //alert("datos repetidos");
          }else{
            document.getElementById('edthvoerr').style.display='';
            setTimeout(function(){
              document.getElementById('edthvoerr').style.display='none';
            }, 2000);
          }
        });

      }
}

//funcion para traer la informacion del vale
function infvale(){
  //alert("entra vale");
  $("#datavaleofi tr").on('click', function() {
    var id_vofi = "";
    id_vofi += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
    //alert(id_vofi);
    document.getElementById('fvofi').innerHTML=id_vofi;
    $("#detalles").toggle(250); //Muestra contenedor 
    $("#lista").toggle("fast"); //Oculta lista

    $.ajax({
      url: '../controller/php/convaleoficin.php',
      type: 'POST'
  }).done(function(respuesta) {
      obj = JSON.parse(respuesta);
      var res = obj.data;
      var x = 0;
      for (D = 0; D < res.length; D++) { 
          if (obj.data[D].refe_1 == id_vofi){
              datos = 
              obj.data[D].fecha + '*' +
              obj.data[D].refe_3 + '*' +
              obj.data[D].proveedor_cliente + '*' +
              obj.data[D].status + '*' +
              obj.data[D].codigo_1;    
              var o = datos.split("*");   
              $("#detalles #infecvo").val(o[0]);   
              $("#detalles #inftipevo").val(o[1]);   
              $("#detalles #infsolivo").val(o[2]);
              $("#detalles #infestavo").val(o[3]);
              
          }
      }
  });
  $.ajax({
    url: '../controller/php/valeofi.php',
    type: 'POST'
  }).done(function(resp) {
    obj = JSON.parse(resp);
    var res = obj.data;
    var x = 0;
    
    html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th style="width:20%;"><i></i>ESTATUS</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
    for (U = 0; U < res.length; U++) {  
      if (obj.data[U].refe_1 == id_vofi){
        x++;
        if (obj.data[U].status_2 == "PENDIENTE"){
          estatus="<button onclick='surtirvof();' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"
        }else if (obj.data[U].status_2 == "SURTIDO") {
          estatus="<span title='Ya fue surtido' class='spandis'>SURTIDO</span>"

        }else if (obj.data[U].status_2 == "SIN EXISTENCIAS")  {
          estatus="<span title='Ver detalles' onclick='infonosur()' data-toggle='modal' data-target='#modal-nosurtido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"
        }
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + estatus +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf();' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
      }  
    }
    html += '</div></tbody></table></div></div>';
    $("#listvaleofi1").html(html);
})
}) 
}

//FUNCION PARA EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function editvaleof(){
  //alert("EDITAR VALE");
  var fecha = $("#infecvo").removeAttr("readonly");
  var tipo = $("#infsolivo").removeAttr("readonly");
  document.getElementById('inftipevo').disabled= false;
  document.getElementById('infestavo').disabled= false;
  document.getElementById('voagartic').style.display="";
  document.getElementById('voedith').style.display="";
  document.getElementById('closevoed').style.display="";
  document.getElementById('openedivo1').style.display="none";
  
}
//FUNCION PARA CERRAR EDITAR VALE DE OFICINA EN VISTA DE INFORMACION
function closedithvo(){
  //alert("cierra VALE");
  var fecha1 = $("#infecvo").attr("readonly","readonly");
  var tipo1 = $("#infsolivo").attr("readonly","readonly");
  document.getElementById('inftipevo').disabled= true;
  document.getElementById('infestavo').disabled= true;
  document.getElementById('voagartic').style.display="none";
  document.getElementById('voedith').style.display="none";
  document.getElementById('closevoed').style.display="none";
  document.getElementById('openedivo1').style.display="";
}

//FUNCION QUE GUARDA LA EDICIÓN DE LA CABECERA DEL VALE DE OFICINA EN VISTA PREVIA 
function savevofic(){
  var fecha = document.getElementById('infecvo').value;
  var refe_3 = document.getElementById('inftipevo').value;
  var status = document.getElementById('infestavo').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var proveedor_cliente = document.getElementById('infsolivo').value;
  

  var datos= 'fecha=' + fecha + '&refe_3=' + refe_3 + '&status=' + status + '&refe_1=' + refe_1 + '&proveedor_cliente=' + proveedor_cliente + '&opcion=cambio';
  //alert(datos);

  if (document.getElementById('infecvo').value == '' || document.getElementById('inftipevo').value == '' || document.getElementById('infestavo').value == '' || document.getElementById('fvofi').value == '' || document.getElementById('infsolivo').value == '') { 
      document.getElementById('edthvoivacios').style.display='';
      setTimeout(function(){
        document.getElementById('edthvoivacios').style.display='none';
      }, 2000);
        return;
    } else {
      $.ajax({
        type:"POST",
        url:"../controller/php/insertvaleofi.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
        }else if (respuesta == 2) {
          document.getElementById('edthvoiexi').style.display='';
          setTimeout(function(){
            document.getElementById('edthvoiexi').style.display='none';
          }, 1000);
          //alert("datos repetidos");
        }else{
          document.getElementById('edthvoierror').style.display='';
          setTimeout(function(){
            document.getElementById('edthvoierror').style.display='none';
          }, 2000);
        }
      });

    }
}

//FUNCION QUE ACTIVA LOS INPUTS DEPENDIENTO DE TIPO DE VALE VISTA PREVIA
function masarticvo(){
 //alert("entro el vale");
 tipo = document.getElementById("inftipevo").value;
 precio = document.getElementById("precio");
 total = document.getElementById("total");
 if (tipo == 'INTERNO') {
     //alert(tipo);
     precio.style.display = 'none';
     total.style.display = 'none';
 }if (tipo == 'VENTA') {
     total.style.display = '';
     precio.style.display = '';
 }
}

//FUNCION PARA AGREAGR ARTICULO A UN VALE DE OFICINA YA CREADO VUISTA PREVIA
function addartivo(){
  //alert("entra");
  var refe_1 = document.getElementById('fvofi').innerHTML; //FOLIO DEL VALE
  var fecha = document.getElementById('infecvo').value; 
  var refe_3 = document.getElementById('inftipevo').value;
  var proveedor_cliente = document.getElementById('infsolivo').value; 
  
  var codigo_1 = document.getElementById('vcodigo1').value;
  var descripcion_1 = document.getElementById('vdescrip1').value;
  var cantidad_real = document.getElementById('vcantidad1').value;
  var salida = document.getElementById('vcantidad1').value;
  var observa = document.getElementById('observo1').value;
  var costo = document.getElementById('vprecio1').value;
  var total = document.getElementById('vtotal1').value;
  var ubicacion = document.getElementById('vdepart1').value;

  var datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&costo=' + costo + '&total=' + total + '&ubicacion=' + ubicacion + '&opcion=registrar';
  //var datos =$('#personal-ext').serialize();
  //alert(datos);
if (document.getElementById('fvofi').value == '' || document.getElementById('infecvo').value == '' || document.getElementById('inftipevo').value == '' || proveedor_cliente == '' || document.getElementById('vcodigo1').value == '' || document.getElementById('vdescrip1').value == '' || document.getElementById('vcantidad1').value == ''|| document.getElementById('vprecio1').value == '') { 
  //alert("vacios");
  document.getElementById('edthvovacios1').style.display=''
  setTimeout(function(){
      document.getElementById('edthvovacios1').style.display='none';
  }, 2000);
    return;
} else {
  $.ajax({
    type:"POST",
    url:"../controller/php/insertvaleofi.php",
    data:datos
  }).done(function(respuesta){
      if (respuesta==0){
           Swal.fire({
          type: 'success',
          text: 'Se actualizo de forma correcta',
          showConfirmButton: false,
          timer: 1500
      }); 
      $.ajax({
        url: '../controller/php/valeofi.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        var res = obj.data;
        var x = 0;
        html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead class="thead-colored thead-primary"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ESTATUS</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {  
          if (obj.data[U].refe_1 == refe_1){
            x++;
            if (obj.data[U].status_2 == "PENDIENTE"){
              estatus="<button onclick='surtirvof();' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"
            }else if (obj.data[U].status_2 == "SURTIDO") {
              estatus="<span class='spandis'>SURTIDO</span>"
    
            }else if (obj.data[U].status_2 == "SIN EXISTENCIAS")  {
              estatus="<span title='Ver detalles' onclick='infonosur()' data-toggle='modal' data-target='#modal-nosurtido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"
            }
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + estatus +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf();' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
          }    
        }
        html += '</div></tbody></table></div></div>';
        $("#listvaleofi1").html(html);
        'use strict';
        $('#datavaofi1').DataTable({
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
          document.getElementById('edthdvobli1').style.display=''
          setTimeout(function(){
              document.getElementById('edthdvobli1').style.display='none';
          }, 1000);
      //alert("datos repetidos");
      }else{
          document.getElementById('edthvoerr1').style.display=''
          setTimeout(function(){
              document.getElementById('edthvoerr1').style.display='none';
          }, 1000);
      }
  })
}
}

//funcion para agregar el total en vista previa de vale oficina
function agtotalvo(){
  cantidad1 = document.getElementById("vcantidad1").value;
  precio1 = document.getElementById("vprecio1").value;
  total1 = document.getElementById("vtotal1");
  total1.value= cantidad1 * precio1;
}

//funcion para activar edición de articulos en vista previa de vale de oficina
function editvoinf1(){
//alert("edit articulo infovale");
  document.getElementById('openedivoinf').style.display="none";
  document.getElementById('closeditvoinf').style.display="";
  document.getElementById('edicovoinf').disabled= false;
  document.getElementById('vprecioinf').disabled= false;
  document.getElementById('infobsere').disabled= false;
  document.getElementById('edithdesvoinf').disabled= false;
  document.getElementById('editcavoinf').disabled= false;
  document.getElementById('voguardarinf').style.display="";
  document.getElementById('editdepinf').disabled= false;
  document.getElementById('vtotalinf').disabled= false;

}
//funcion para cerrar edición de articulos en vista previa de vale de oficina
function closedthvoinf1(){
  //alert("cerrar articulo info vale");
      document.getElementById('openedivoinf').style.display="";
      document.getElementById('closeditvoinf').style.display="none";
      document.getElementById('edicovoinf').disabled= true;
      document.getElementById('vprecioinf').disabled= true;
      document.getElementById('edithdesvoinf').disabled= true;
      document.getElementById('infobsere').disabled= true;
      document.getElementById('editcavoinf').disabled= true;
      document.getElementById('voguardarinf').style.display="none";
      document.getElementById('editdepinf').disabled= true;
      document.getElementById('vtotalinf').disabled= true;

}
//FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS
function editarvoinf(){;
  //trae los input dependiendo si es venta o interno
  tipo = document.getElementById("inftipevo").value;
  precio = document.getElementById("precioinf");
  total = document.getElementById("totalinf");
  if (tipo == 'INTERNO') {
     //alert(tipo);
     precio.style.display = 'none';
     total.style.display = 'none';
  }if (tipo == 'VENTA') {
   // alert(tipo);
     total.style.display = '';
     precio.style.display = '';
  }
  //alert("entra editar articulo");
  $("#infvaofi1 tr").on('click', function() {
      var valofi1 = "";
      valofi1 += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('id_voin').value=valofi1
      //alert(valofi1);
      $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (U = 0; U < res.length; U++) { 
              if (obj.data[U].id_kax == valofi1){
                  datos = 
                  obj.data[U].codigo_1 + '*' +
                  obj.data[U].descripcion_1 + '*' +
                  obj.data[U].salida + '*' +
                  obj.data[U].ubicacion + '*' +
                  obj.data[U].costo + '*' +
                  obj.data[U].total;    
                  var d = datos.split("*");   
                  $("#modal-editavoinf #edicovoinf").val(d[0]);   
                  $("#modal-editavoinf #edithdesvoinf").val(d[1]);            
                  $("#modal-editavoinf #editcavoinf").val(d[2]);
                  $("#modal-editavoinf #editdepinf1").val(d[3]);
                  $("#modal-editavoinf #vprecioinf").val(d[4]);
                  $("#modal-editavoinf #vtotalinf").val(d[5]);
              }
          }
      });
  }) 
}
//FUNCION PARA AGREGAR TOTAL EN EDICIÓN EN VISTA PREVIA VALE DE OFICINA
function totalvoinfe(){
  cantidad1 = document.getElementById("editcavoinf").value;
  precio1 = document.getElementById("vprecioinf").value;
  total1 = document.getElementById("vtotalinf");
  total1.value= cantidad1 * precio1;
}
//FUNCION QUE GUARDA LA EDICIÓN DE VALES DE OFICINA EN INFORMACION DE VALE DE OFICINA
function savecamvo(){
  var codigo_1 = document.getElementById('edicovoinf').value;
  var descripcion_1 = document.getElementById('edithdesvoinf').value;
  var salida = document.getElementById('editcavoinf').value;
  var costo = document.getElementById('vprecioinf').value;
  var total = document.getElementById('vtotalinf').value;
  var observa = document.getElementById('infobsere').value;
  var id_kax = document.getElementById('id_voin').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  
  var datos= 'codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&costo=' + costo + '&total=' + total + '&observa=' + observa + '&id_kax=' + id_kax + '&refe_1=' + refe_1 + '&opcion=actualiza';
  //alert(datos);

  if (document.getElementById('edicovoinf').value == '' || document.getElementById('edithdesvoinf').value == '' || document.getElementById('editcavoinf').value == '' || document.getElementById('vprecioinf').value == '' || document.getElementById('vtotalinf').value == '') { 
      document.getElementById('edthvovaciosin').style.display='';
      setTimeout(function(){
        document.getElementById('edthvovaciosin').style.display='none';
      }, 2000);
        return;
    } else {
      $.ajax({
        type:"POST",
        url:"../controller/php/insertvaleofi.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
        }else if (respuesta == 2) {
          document.getElementById('edthdvoblinf').style.display='';
          setTimeout(function(){
            document.getElementById('edthdvoblinf').style.display='none';
          }, 1000);
          //alert("datos repetidos");
        }else{
          document.getElementById('edthvoerrinf').style.display='';
          setTimeout(function(){
            document.getElementById('edthvoerrinf').style.display='none';
          }, 2000);
        }
      });

    }
}
//FUNCION PARA QUE TRAIGA LA INFOMACION DE EL ARTICULO EN VALE DE OFICINA INFO
function delartvoinf(){;
  //alert("entra ELIMINAR articulo");
  $("#infvaofi1 tr").on('click', function() {
      var valofi1 = "";
      valofi1 += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('del_artvo').value=valofi1
      //alert(valofi1);
      $.ajax({
          url: '../controller/php/valeofi.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (U = 0; U < res.length; U++) { 
              if (obj.data[U].id_kax == valofi1){
                  datos = 
                  obj.data[U].codigo_1 ;    
                  var d = datos.split("*");   
                  $("#modal-deleteartvo #deartvo").val(d[0]);
              }
          }
      });
  }) 
}
//FUNCION QUE GUARDA LA ELIMINACION DEL ARTICULOS DE VALE DE OFICINA
function savedelarvo(){
  var id_kax = document.getElementById('del_artvo').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('deartvo').value;
  var datos= 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=eliminar';
  //alert(datos);
      $.ajax({
        type:"POST",
        url:"../controller/php/insertvaleofi.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
              
          });
          $('#modal-deleteartvo').modal('hide');
          

          $.ajax({
            url: '../controller/php/valeofi.php',
            type: 'POST'
          }).done(function(resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%" id="infvaofi1" name="infvaofi1" class="table display responsive nowrap dataTable no-footer dtr-inline"><thead class="thead-colored thead-primary"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th><i></i>ESTATUS</th><th style="width:100px;"><i></i>ACCIONES</th></tr></thead><tbody>';
            for (U = 0; U < res.length; U++) {  
              if (obj.data[U].refe_1 == refe_1){
                x++;
                if (obj.data[U].status_2 == "PENDIENTE"){
                  estatus="<button onclick='surtirvof();' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"
                }else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus="<span class='spandis'>SURTIDO</span>"
        
                }else if (obj.data[U].status_2 == "SIN EXISTENCIAS")  {
                  estatus="<span title='Ver detalles' onclick='infonosur()' data-toggle='modal' data-target='#modal-nosurtido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"
                }
                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + estatus +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf();' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
              }  
            }
            html += '</div></tbody></table></div></div>';
            $("#listvaleofi1").html(html);
            'use strict';
            $('#datavaofi1').DataTable({
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
        }else{
          document.getElementById('delerarvoinf').style.display='';
          setTimeout(function(){
            document.getElementById('delerarvoinf').style.display='none';
          }, 2000);
        }
      });

}

//FUNCION QUE TOMAR EL FOLIO DE EL VALE DE OFIINA
function deletvolis(){
  $("#datavaleofi tr").on('click', function() {
      var id_vale = "";
      id_vale += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
      document.getElementById('devaofi').value=id_vale;
      //alert(id_vale)
  }) 
}

//FUNCION QUE GUARDA LA ELIMINACIÓN DE VALE DE OFICINA
function savedevol(){
  var refe_1= document.getElementById('devaofi').value;
  var datos= 'refe_1=' + refe_1 + '&opcion=deletevolis';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/php/insertvaleofi.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'vale_oficina.php';", 1500);
      }else{
          document.getElementById('delerrvo').style.display='';
          setTimeout(function(){
            document.getElementById('delerrvo').style.display='none';
          }, 2500);
        }
    });

}

//FUNCION QUE GUARDA 
function surtirvof(){
  //alert("sie entro");
  $("#infvaofi1 tr").on('click', function() {
    var vaof12 = "";
    vaof12 += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
    document.getElementById('id_surtvof').value=vaof12
    //alert(valofi1);
    $.ajax({
        url: '../controller/php/valeofi.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (U = 0; U < res.length; U++) { 
            if (obj.data[U].id_kax == vaof12){
                datos = 
                obj.data[U].codigo_1 + '*' +
                obj.data[U].descripcion_1 + '*' +
                obj.data[U].salida;    
                var d = datos.split("*");   
                $("#modal-surtirvof #arsurvof").val(d[0]);   
                $("#modal-surtirvof #edithsertg").val(d[1]);            
                $("#modal-surtirvof #surtavoinf").val(d[2]);
            }
        }
    });
}) 
}

//FUNCION DE EDITAR SURTIR
function survof(){
  //alert("edit articulo infovale");
  document.getElementById('arsurvof').disabled= false;
  document.getElementById('edithdesvoinf').disabled= false;
  document.getElementById('surtavoinf').disabled= false;
  document.getElementById('surbsere').disabled= false;
  document.getElementById('codigosur').disabled= false;
  document.getElementById('surtirvof').style.display="none";
  document.getElementById('closeditvoinf1').style.display="";
  document.getElementById('voguardarsur').style.display="";

}
//FUNCION PARA CERRAR SURTIR
function closesurvof(){
  //alert("edit articulo infovale");
  document.getElementById('arsurvof').disabled= true;
  document.getElementById('edithdesvoinf').disabled= true;
  document.getElementById('surtavoinf').disabled= true;
  document.getElementById('surbsere').disabled= true;
  document.getElementById('codigosur').disabled= true;
  document.getElementById('surtirvof').style.display="";
  document.getElementById('closeditvoinf1').style.display="none";
}
//FUNCION PARA MARCAR SIN EXISTENCIAS 
function sinexisten(){
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvof').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('arsurvof').value;
  var datos= 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&opcion=sinexistencia';
      $.ajax({
        type:"POST",
        url:"../controller/php/insertvaleofi.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          $('#modal-surtirvof').modal('hide');
          
          $.ajax({
            url: '../controller/php/valeofi.php',
            type: 'POST'
          }).done(function(resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th style="width:20%;"><i></i>ESTATUS</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
            for (U = 0; U < res.length; U++) {  
              if (obj.data[U].refe_1 == refe_1){
                x++;
                if (obj.data[U].status_2 == "PENDIENTE"){
                  estatus="<button onclick='surtirvof();' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"
                }else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus="<span class='spandis'>SURTIDO</span>"
        
                }else if (obj.data[U].status_2 == "SIN EXISTENCIAS")  {
                  estatus="<span title='Ver detalles' onclick='infonosur()' data-toggle='modal' data-target='#modal-nosurtido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"
                }
                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + estatus +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf();' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
              }    
            }
            html += '</div></tbody></table></div></div>';
            $("#listvaleofi1").html(html);
            'use strict';
            $('#datavaofi1').DataTable({
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
        }else{
          document.getElementById('delerarvoinf').style.display='';
          setTimeout(function(){
            document.getElementById('delerarvoinf').style.display='none';
          }, 2000);
        }
      });
}
//FUNCION PARA MARCAR SURTIR
function acsurtirvof(){
  //alert("entro vales")
  var id_kax = document.getElementById('id_surtvof').value;
  var refe_1 = document.getElementById('fvofi').innerHTML;
  var codigo_1 = document.getElementById('arsurvof').value;
  var cantidad = document.getElementById('surtavoinf').value;
  var descripcion = document.getElementById('edithsertg').value;

  var datos= 'id_kax=' + id_kax + '&refe_1=' + refe_1 + '&codigo_1=' + codigo_1 + '&cantidad=' + cantidad + '&descripcion=' + descripcion + '&opcion=surtir';
  //alert(datos)
      $.ajax({
        type:"POST",
        url:"../controller/php/insertvaleofi.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          $('#modal-surtirvof').modal('hide');
          
          $.ajax({
            url: '../controller/php/valeofi.php',
            type: 'POST'
          }).done(function(resp) {
            obj = JSON.parse(resp);
            var res = obj.data;
            var x = 0;
            
            html = '<div class="bd bd-gray-300 rounded table-responsive"><table style="width:100%; table-layout:" id="infvaofi1" name="infvaofi1" class="table display dataTable"><thead class="thead-colored thead-primary"><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th style="width:500px"><i></i>DESCRIPCIÓN</th><th><i></i>OBSERVACIONES</th><th><i></i>CANTIDAD</th><th style="width:20%;"><i></i>ESTATUS</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
            for (U = 0; U < res.length; U++) {  
              if (obj.data[U].refe_1 == refe_1){
                x++;
                if (obj.data[U].status_2 == "PENDIENTE"){
                  estatus="<button onclick='surtirvof();' data-toggle='modal' data-target='#modal-surtirvof' type='button' title='Dar click para surtir' class='btn btn-info mg-b-10'>SURTIR</button>"
                }else if (obj.data[U].status_2 == "SURTIDO") {
                  estatus="<span class='spandis'>SURTIDO</span>"
        
                }else if (obj.data[U].status_2 == "SIN EXISTENCIAS")  {
                  estatus="<span title='Ver detalles' onclick='infonosur()' data-toggle='modal' data-target='#modal-nosurtido' class='sinexisten' style='font-size:12px;cursor: pointer;'>SIN EXISTENCIA</span>"
                }
                html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].observa + "</td><td>" + obj.data[U].salida + "</td><td>" + estatus +  "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarvoinf();' class='nav-link' data-toggle='modal' data-target='#modal-editavoinf'>Editar</a><a href='' onclick='delartvoinf();'  class='nav-link' data-toggle='modal' data-target='#modal-deleteartvo'>Eliminar</a>" + "</td></tr>";            
              }    
            }
            html += '</div></tbody></table></div></div>';
            $("#listvaleofi1").html(html);
            'use strict';
            $('#datavaofi1').DataTable({
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
        }else{
          document.getElementById('delerarvoinf').style.display='';
          setTimeout(function(){
            document.getElementById('delerarvoinf').style.display='none';
          }, 2000);
        }
      });
}

function infonosur(){
  //alert("sie entro");
  $("#infvaofi1 tr").on('click', function() {
    var vaof12 = "";
    vaof12 += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
    document.getElementById('id_nosur').value=vaof12
    //alert(valofi1);
    $.ajax({
        url: '../controller/php/valeofi.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (U = 0; U < res.length; U++) { 
            if (obj.data[U].id_kax == vaof12){
                datos = 
                obj.data[U].codigo_1 + '*' +
                obj.data[U].descripcion_1 + '*' +
                obj.data[U].cantidad_real;    
                var d = datos.split("*");   
                //$("#modal-nosurtido #arsurvof").val(d[0]);   
                $("#modal-nosurtido #descar").html(d[1]);            
                $("#modal-nosurtido #canreal").html(d[2]);
            }
        }
    });
}) 
}

function closemodnosui(){
  $('#modal-nosurtido').modal('hide');
}
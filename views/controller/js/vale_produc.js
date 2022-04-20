$(document).ready(function() {
    'use strict';

    $('#wizard2').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        enableFinishButton: false,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        onStepChanging: function(event, currentIndex, newIndex) {
            if (currentIndex < newIndex) {
                // Step 1 form validation
                if (currentIndex === 0) {
                    var fname = $('#vfolio').parsley();
                    var lname = $('#vfecha').parsley();

                    if (fname.isValid() && lname.isValid()) {
                        return true;
                    } else {
                        fname.validate();
                        lname.validate();
                    }
                }

                // Step 2 form validation
                if (currentIndex === 1) {
                    var email = $('#vcodigo').parsley();
                    if (email.isValid()) {
                        return true;
                    } else {
                        email.validate();
                    }
                }
                // Always allow step back to the previous step even if the current step is not valid.
            } else {
                return true;
            }
        }
    });
    $('#wizard3').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        stepsOrientation: 1
    });

    $('#wizard4').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        cssClass: 'wizard step-equal-width'
    });

    $('#wizard5').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        cssClass: 'wizard wizard-style-1'
    });

    $('#wizard6').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        errorSteps: [],
        next: 'Siguiente',
        previous: 'Anterior',
        finish: 'Finalizar',
        enableFinishButton: false,
        loadingTemplate: '<span class="spinner"></span> #text#',
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        cssClass: 'wizard wizard-style-2'
    });

    $('#wizard7').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
        cssClass: 'wizard wizard-style-3'
    });




});

$(document).ready(function() {
    $('#busccodimem').load('./select/buscarme.php');
    $('#busccodigomem2').load('./select/buscarme2.php');
    $('#buscpedido').load('./select/buspedi.php');


});
//LLAMADO DE DATOS
function updatedvp() {
        //alert("entro el update");
    //BORRA LA INFORMACIÓN DE PRODUCTO FINAL
    document.getElementById('mcodigotr').value ="";
    document.getElementById('mdecriptr').value ="";
    document.getElementById('vpcantidad').value ="";
    document.getElementById('vpcantidad').value ="";
    document.getElementById('vpbservo').value ="";
    document.getElementById('pedidomem').value ="";
    //INFORMACION DE LAS TBLAS
    let id_valeproduc = document.getElementById('vpfolio').value;
    $.ajax({
      url: '../controller/php/convale_pro.php',
      type: 'POST'
    }).done(function(resp) {
      obj = JSON.parse(resp);
      let res = obj.data;
      let x = 0;
      html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
      for (U = 0; U < res.length; U++) {  
        if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref =='EXTENDIDO'){
          x++;
          let id_valepro=obj.data[U].id_kax;
          html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(valprd);' class='nav-link' data-toggle='modal' data-target=''>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
        }  
      }
      html += '</div></tbody></table></div></div>';
      $("#listextent").html(html);
      'use strict';
      $('#lisextendid').DataTable({
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
    //LLAMADA DE ETIQUETAS
    $.ajax({
        url: '../controller/php/convale_pro.php',
        type: 'POST'
    }).done(function(resp) {
        obj = JSON.parse(resp);
    let res = obj.data;
    let x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
    for (U = 0; U < res.length; U++) {  
      if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref =='ETIQUETAS'){
        x++;
        let id_valepro=obj.data[U].id_kax;
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(valprd);' class='nav-link' data-toggle='modal' data-target=''>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
    }  
    }
    html += '</div></tbody></table></div></div>';
    $("#listetiquetas").html(html);
    'use strict';
    $('#etiquetasvp').DataTable({
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
//LLAMADA DE PRODUCTO TERMINADO
$.ajax({
    url: '../controller/php/convale_pro.php',
    type: 'POST'
  }).done(function(resp) {
    obj = JSON.parse(resp);
    let res = obj.data;
    let x = 0;
    html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="produfinalvp" name="produfinalvp" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
    for (U = 0; U < res.length; U++) {  
      if (obj.data[U].refe_1 == id_valeproduc && obj.data[U].tipo_ref =='PRODUCTO_TERMINADO'){
        x++;
        valprd=obj.data[U].codigo_1;
        //alert(id_valepro);
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].cantidad_real + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp(valprd);' class='nav-link' data-toggle='modal' data-target=''>Editar</a><a href='' class='nav-link'>Eliminar</a>" + "</td></tr>";            
      }  
    }
    html += '</div></tbody></table></div></div>';
    $("#listproducfinal").html(html);
    'use strict';
    $('#produfinalvp').DataTable({
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
//FUNCIÓN QUE SIRVE PARA AGREGAR UN ARTICULO AL VALE DE PRODUCCIÓN
function addvaleprodu() {
    //alert("entro agregar vale de producción");
    let refe_1 = document.getElementById('vpfolio').value; 
    let fecha = document.getElementById('vpfecha').value; 
    let refe_2 = document.getElementById('vpdepsoli').value;
    let refe_3 = document.getElementById('vptipo').value;
    let proveedor_cliente = document.getElementById('vpdepentr').value; 
    let codigo_1 = document.getElementById('mcodigotr').value;
    let descripcion_1 = document.getElementById('mdecriptr').value;
    let cantidad_real = document.getElementById('vpcantidad').value;
    let salida = document.getElementById('vpcantidad').value;
    let observa = document.getElementById('vpbservo').value;
    let ubicacion = document.getElementById('pedidomem').value;
    let datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=registrar';
   
    //alert(datos);

    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '') { 
        document.getElementById('vaciosvp').style.display=''
        setTimeout(function(){
            document.getElementById('vaciosvp').style.display='none';
        }, 2000);
          return;
    }else{
        $.ajax({
            type:"POST",
            url:"../controller/php/insertvapro.php",
            data:datos
          }).done(function(respuesta){
              if (respuesta==0){
                   Swal.fire({
                  type: 'success',
                  text: 'Se agrego el articulo de forma correcta',
                  showConfirmButton: false,
                  timer: 1500
              });
              
              updatedvp();
              }else if (respuesta == 2) {
                  document.getElementById('dublivp').style.display=''
                  setTimeout(function(){
                      document.getElementById('dublivp').style.display='none';
                  }, 1000);
              //alert("datos repetidos");
              }else{
                  document.getElementById('errvp').style.display=''
                  setTimeout(function(){
                      document.getElementById('errvp').style.display='none';
                  }, 1000);
              }
          })
        }
      
}

function editarinsvp(valprd){
alert(valprd);
}

//LLAMADO DE DATOS
function cancelar() {
    alert("entra cancelar");
    let refe_1 = document.getElementById('vpfolio').value;
    let datos= 'refe_1=' + refe_1 + '&opcion=cancelar';
    $.ajax({
        type:"POST",
        url:"../controller/php/insertvapro.php",
        data:datos
      }).done(function(respuesta){
          if (respuesta==0){
               Swal.fire({
              type: 'success',
              text: 'Se cancelelo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          setTimeout("location.href = 'vale_produccion.php';", 1500);

          }else if (respuesta == 2) {
              document.getElementById('dublivp').style.display=''
              setTimeout(function(){
                  document.getElementById('dublivp').style.display='none';
              }, 1000);
          //alert("datos repetidos");
          }else{
              document.getElementById('errvp').style.display=''
              setTimeout(function(){
                  document.getElementById('errvp').style.display='none';
              }, 1000);
          }
      })
    
    
}
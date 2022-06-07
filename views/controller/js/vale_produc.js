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
        onFinished: function (event, currentIndex) {
            //alert("Form submitted.");
            let refe_1 = document.getElementById('vpfolio').value; 
            let fecha = document.getElementById('vpfecha').value; 
            let refe_2 = document.getElementById('vpdepsoli').value;
            let refe_3 = document.getElementById('vptipo').value;
            let proveedor_cliente = document.getElementById('vpdepentr').value; 
            if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' ||refe_2 == '' ) { 
                document.getElementById('vaciosvp').style.display=''
                setTimeout(function(){
                    document.getElementById('vaciosvp').style.display='none';
                }, 2000);
                  return;
            }else{
            Swal.fire({
                type: 'success',
                text: 'Se finaliza de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'vale_produccion.php';", 1500);
        }
        }
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
        cssClass: 'wizard wizard-style-2',
        labels: {
            cancel: "Cancelar",
            current: "current step:",
            pagination: "Pagination",
            finish: "Cerrar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        }
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
    $('#busccodimem').load('./select/buscarttras.php');
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
          html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+id_valepro+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' onclick='deletenewart("+id_valepro+");' data-toggle='modal' data-target='#modal-delearvpnew'>Eliminar</a>" + "</td></tr>";            
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
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+id_valepro+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart("+id_valepro+");'>Eliminar</a>" + "</td></tr>";            
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
        valprd=obj.data[U].id_kax;
        //alert(id_valepro);
        html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+valprd+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a href='' class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart("+valprd+");'>Eliminar</a>" + "</td></tr>";            
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
//FUNCIÓN QUE SIRVE PARA AGREGAR UN ARTICULO AL VALE DE PRODUCCIÓN 05062022
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
    let caracter = document.getElementById('vpcaracter').value;

    let datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&caracter=' + caracter + '&opcion=registrar';

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
        //ARTICULOS EXTRA--------------------------------------------------------
        $.ajax({
            url: '../controller/php/contrasforma.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            let res = obj.data;
            let x = 0;
            for (D = 0; D < res.length; D++) { 
                if (obj.data[D].id_articulo_final == codigo_1 ){
                    //SI APLICA CARTON
                    if (obj.data[D].carton == "APLICA"){
                        codigocart=obj.data[D].id_carton;
                        let datoscart= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocart=' + codigocart + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcarton';
                    //alert(datoscart);
                        $.ajax({
                            type:"POST",
                            url:"../controller/php/insertvapro.php",
                            data:datoscart
                        }).done(function(respuesta){
                            if (respuesta==0){
                                updatedvp();
                            }else if (respuesta == 2) {
                                document.getElementById('dublivp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('dublivp').style.display='none';
                                }, 1000);
                              //alert("datos repetidos");
                            }else{
                                /*document.getElementById('errvp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('errvp').style.display='none';
                                }, 1000);*/
                            }
                        })
                    }
                    //SI APLICA CARTONSILLO
                    if (obj.data[D].cartonsillo == "APLICA" ){
                        codigocartons=obj.data[D].id_cortonsillo;
                        let datoscasill= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocartons=' + codigocartons + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcartonsillo';
                        //alert(datoscasill);
                        $.ajax({
                            type:"POST",
                            url:"../controller/php/insertvapro.php",
                            data:datoscasill
                        }).done(function(respuesta){
                            if (respuesta==0){
                                updatedvp();
                            }else if (respuesta == 2) {
                                document.getElementById('dublivp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('dublivp').style.display='none';
                                }, 1000);
                              //alert("datos repetidos");
                            }else{
                               /*document.getElementById('errvp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('errvp').style.display='none';
                                }, 1000);*/
                            }
                        })
                    }
                    //SI APLICA CAPLE
                    if (obj.data[D].caple == "APLICA" ){
                        codigocaple=obj.data[D].id_caple;
                        let datoscaple= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigocaple=' + codigocaple + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regcaple';
                        //alert(datoscasill);
                        $.ajax({
                            type:"POST",
                            url:"../controller/php/insertvapro.php",
                            data:datoscaple
                        }).done(function(respuesta){
                            if (respuesta==0){
                                updatedvp();
                            }else if (respuesta == 2) {
                                document.getElementById('dublivp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('dublivp').style.display='none';
                                }, 1000);
                              //alert("datos repetidos");
                            }else{
                                /*document.getElementById('errvp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('errvp').style.display='none';
                                }, 1000);*/
                            }
                        })
                    }
                    //SI APLICA LISTON/CORDON
                    if (obj.data[D].liston_cordon == "APLICA" ){
                        codigolist=obj.data[D].id_cordliston;
                        let datoslist= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&codigolist=' + codigolist + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&opcion=regliston';
                        //alert(datoscasill);
                        $.ajax({
                            type:"POST",
                            url:"../controller/php/insertvapro.php",
                            data:datoslist
                        }).done(function(respuesta){
                            if (respuesta==0){
                                updatedvp();
                            }else if (respuesta == 2) {
                                document.getElementById('dublivp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('dublivp').style.display='none';
                                }, 1000);
                              //alert("datos repetidos");
                            }else{
                               /*document.getElementById('errvp').style.display='';
                                setTimeout(function(){
                                    document.getElementById('errvp').style.display='none';
                                }, 1000);*/
                            }
                        })
                     
                    }
                }
            }
        });
        
    }
    
}
//ABRIR EDITAR EXTENDIDO EN ALTA DE PRODUCCIÓN
function editarinsvp(valprd){
    //alert(valprd);
    document.getElementById('id_exedith').value=valprd;
    $.ajax({
        url: '../controller/php/convale_pro.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) { 
            if (obj.data[C].id_kax == valprd ){
                //alert("entro");
                document.getElementById('cdnewvpedith').value=obj.data[C].codigo_1;
                document.getElementById('vpednewtcantid').value=obj.data[C].salida;
                document.getElementById('vpobsaddnew').value=obj.data[C].observa;
                document.getElementById('posicionextnew').value=obj.data[C].tipo_ref;
            }
        }
   });
   //informacion del articulos
   $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith').value){
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

//LLAMADO DE DATOS
function cancelar() {
    //alert("entra cancelar");
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
//cambio de descripcion articulo indivual
function edithextnewvp(){
    //alert("eentraarticulo")
    let codivo = document.getElementById('vpcodetiqnew').value; 
    $.ajax({
        url: '../controller/php/conarticulos.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].artcodigo == document.getElementById('cdnewvpedith').value){
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

//cambio de descripcion articulo indivual
function addarinpro(){
    //alert("entro agregar vale de producción");
    let refe_1 = document.getElementById('vpfolio').value; 
    let fecha = document.getElementById('vpfecha').value; 
    let refe_2 = document.getElementById('vpdepsoli').value;
    let refe_3 = document.getElementById('vptipo').value;
    let proveedor_cliente = document.getElementById('vpdepentr').value; 
    let codigo_1 = document.getElementById('codindiv').value;
    let descripcion_1 = document.getElementById('vindescrip').value;
    let cantidad_real = document.getElementById('vincantid').value;
    let salida = document.getElementById('vincantid').value;
    let observa = document.getElementById('vinfbsertras').value;
    let ubicacion = document.getElementById('vindepar').value; 
    let tipo_ref = document.getElementById('psiciont').value;
    let datos= 'refe_1=' + refe_1 + '&fecha=' + fecha + '&refe_2=' + refe_2 + '&refe_3=' + refe_3 + '&proveedor_cliente=' + proveedor_cliente + '&codigo_1=' + codigo_1 + '&descripcion_1=' + descripcion_1 + '&cantidad_real=' + cantidad_real + '&salida=' + salida + '&observa=' + observa + '&ubicacion=' + ubicacion + '&tipo_ref=' + tipo_ref + '&opcion=registrarind';
    //alert(datos);
    if (refe_1 == '' || fecha == '' || refe_3 == '' || proveedor_cliente == '' || codigo_1 == '' || descripcion_1 == '' || cantidad_real == '' || tipo_ref == '' ) { 
        document.getElementById('edthvaincios1').style.display=''
        setTimeout(function(){
            document.getElementById('edthvaincios1').style.display='none';
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
              $("#modal-artinviprod").modal('hide');//ocultamos el modal
              codigo_1="";
              descripcion_1="";
              cantidad_real="";
              tipo_ref="0";
              observa="";
        }else if (respuesta == 2) {
            document.getElementById('edthvinbli1').style.display=''
            setTimeout(function(){
                document.getElementById('edthvinbli1').style.display='none';
            }, 1000);
              //alert("datos repetidos");
        }else{
            document.getElementById('edthvinperr1').style.display=''
            setTimeout(function(){
                document.getElementById('edthvinperr1').style.display='none';
            }, 1000);
        }
    })
    }
}
//funcion para ver la informacion de vale de producción
function valproduct(id_produc) {
    alert(id_produc);
    $("#detaproduccion").toggle(250); //Muestra contenedor de detalles
    $("#lista").toggle("fast"); //Oculta lista
    document.getElementById('vpfolio').value=id_produc;
    document.getElementById('folprod').innerHTML=id_produc;
    var autorizar = document.getElementById('btnvpautoriz');
    var liberar = document.getElementById('btnvpliberar');
    var surtir = document.getElementById('btnvpsurtir');
    var finalizado = document.getElementById('btnvpfinaliz');
    var editar = document.getElementById('openedivpinf');
    
    $.ajax({
        url: '../controller/php/infvale_produc.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (D = 0; D < res.length; D++) { 
            if (obj.data[D].refe_1 == id_produc){
                datos = 
                obj.data[D].fecha + '*' +
                obj.data[D].refe_2 + '*' +
                obj.data[D].refe_3 + '*' +
                obj.data[D].proveedor_cliente + '*' +
                obj.data[D].ubicacion + '*' +
                obj.data[D].caracter_vale + '*' +
                obj.data[D].id_person_creacion + '*' +
                obj.data[D].id_person_autor + '*' +
                obj.data[D].id_person_surtio + '*' +
                obj.data[D].id_person_final + '*' +
                obj.data[D].status + '*' +
                obj.data[D].fecha_surtido + '*' +
                obj.data[D].estado;    
                var o = datos.split("*");   
                $("#infvpdate").val(o[0]);
                $("#infvpdepat").val(o[1]);  
                $("#infvptipo").val(o[2]);
                $("#infvpsolicita").val(o[3]);
                $("#infvppedidos").val(o[4]);
                $("#infvpcaracter").val(o[5]);
                $("#infvpformula").val(o[6]);
                $("#infvpautoriza").val(o[7]);
                $("#infvpsutio").val(o[8]);
                $("#infvprecibio").val(o[9]);
                $("#infvpestatus").val(o[10]);
                $("#infvpdatesurt").val(o[11]);
                

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
                    editar.style.display= 'none'
                }else if (obj.data[D].status == 'FINALIZADO'){
                    liberar.style.display = '';
                    editar.style.display= 'none'
                }
            }
        }
    });
   
      //aqui-------------------------------------
      $.ajax({
        url: '../controller/php/convale_pro.php',
        type: 'POST'
      }).done(function(resp) {
        obj = JSON.parse(resp);
        let res = obj.data;
        let x = 0;
        html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="extendido" name="extendido" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
        for (U = 0; U < res.length; U++) {  
          if (obj.data[U].refe_1 ==  document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref =='EXTENDIDO'){
            x++;
            let id_valepro=obj.data[U].id_kax;
            html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+id_valepro+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' onclick='deletenewart("+id_valepro+");' data-toggle='modal' data-target='#modal-delearvpnew'>Eliminar</a>" + "</td></tr>";            
          }  
        }
        html += '</div></tbody></table></div></div>';
        $("#listextent").html(html);
        'use strict';
        $('#extendido').DataTable({
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
      html = '<div class="table-wrapper rounded table-responsive"><table style="width:100%" id="idetiquetas" name="idetiquetas" class="table display dataTable"><thead><tr><th><i class="fa fa-sort-numeric-asc"></i>ID</th><th><i></i>CODIGO</th><th><i></i>DESCRIPCIÓN</th><th><i></i>CANTIDAD</th><th><i></i>OBSERVACIONES</th><th><i></i>ACCIONES</th></tr></thead><tbody>';
      for (U = 0; U < res.length; U++) {  
        if (obj.data[U].refe_1 ==  document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref =='ETIQUETAS'){
          x++;
          let id_valepro=obj.data[U].id_kax;
          html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].salida + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+id_valepro+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart("+id_valepro+");'>Eliminar</a>" + "</td></tr>";            
      }  
      }
      html += '</div></tbody></table></div></div>';
      $("#listetiquetas").html(html);
      'use strict';
      $('#idetiquetas').DataTable({
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
        if (obj.data[U].refe_1 ==  document.getElementById('folprod').innerHTML && obj.data[U].tipo_ref =='PRODUCTO_TERMINADO'){
          x++;
          valprd=obj.data[U].id_kax;
          //alert(id_valepro);
          html += "<tr><td>" + obj.data[U].id_kax + "</td><td>" + obj.data[U].codigo_1 + "</td><td>" + obj.data[U].descripcion_1 + "</td><td>" + obj.data[U].entrada + "</td><td>" + obj.data[U].observa + "</td><td class='dropdown hidden-xs-down'>" + "<a data-toggle='dropdown' class='btn pd-y-3 tx-gray-500 hover-info'><i class='icon ion-more'></i></a><div class='dropdown-menu dropdown-menu-right pd-10'><nav class='nav nav-style-1 flex-column'><a onclick='editarinsvp("+valprd+");' class='nav-link' data-toggle='modal' data-target='#modal-edithvpextendido'>Editar</a><a href='' class='nav-link' data-toggle='modal' data-target='#modal-delearvpnew' onclick='deletenewart("+valprd+");'>Eliminar</a>" + "</td></tr>";            
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
  //FUNIÓN PARA LIBERAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN
  function editarextalta(){
  //alert("edit articulo infovalesds");
  document.getElementById('closedithext').style.display="";
  document.getElementById('openedithext').style.display="none";
  document.getElementById('saveedithext').style.display="";
  document.getElementById('cdnewvpedith').disabled= false;
  document.getElementById('vpednewtcantid').disabled= false;
  document.getElementById('posicionextnew').disabled= false;
  document.getElementById('vpobsaddnew').disabled= false;
  }
  //FUNIÓN PARA CERRAR LA EDICIÓN EN ARTICULOS EXTENDIDOS EN ALTA DE VALE DE PRODUCCIÓN
  function closeditextalta(){
    //alert("edit articulo infovalesds");
    document.getElementById('closedithext').style.display="none";
    document.getElementById('openedithext').style.display="";
    document.getElementById('saveedithext').style.display="none";
    document.getElementById('cdnewvpedith').disabled= true;
    document.getElementById('vpednewtcantid').disabled= true;
    document.getElementById('posicionextnew').disabled= true;
    document.getElementById('vpobsaddnew').disabled= true;
  }
  //FUNIÓN PARA GUARDAR LA EDICIÓN EN ARTICULOS MEMO ALTA TRASPASO 01052022
function saveedithnewvp(){
    //alert("entra guardar cambios valeproducción");
    let id_kax = document.getElementById('id_exedith').value;
    let codigo_1 = document.getElementById('cdnewvpedith').value;
    let descripcion_1 = document.getElementById('vpnewedithdes').value;
    let salida = document.getElementById('vpednewtcantid').value; 
    let tipo_ref = document.getElementById('posicionextnew').value; 
    let observa = document.getElementById('vpobsaddnew').value;
    
    if (tipo_ref=='EXTENDIDO'){
        let datos= 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew';
        //alert(datos);
        if (codigo_1 == '' || salida == ''||tipo_ref == '') { 
            document.getElementById('edithextnewlle').style.display='';
            setTimeout(function(){
              document.getElementById('edithextnewlle').style.display='none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500      
                });
                updatedvp();
                closeditextalta();
                $('#modal-edithvpextendido').modal('hide'); //cierra el modal
              }else if (respuesta == 2) {
                document.getElementById('edthdmminf').style.display='';
                setTimeout(function(){
                  document.getElementById('edthdmminf').style.display='none';
                }, 1000);
                //alert(respuesta);
                //alert("datos repetidos");
              }else{
                document.getElementById('erraetiqnew').style.display='';
                setTimeout(function(){
                  document.getElementById('erraetiqnew').style.display='none';
                }, 2000);
                alert(respuesta);
              }
            });
          }
    }
    if (tipo_ref=='ETIQUETAS'){
        let datos= 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateartnew';
    //alert(datos);
        if (codigo_1 == '' || salida == ''||tipo_ref == '') { 
            document.getElementById('edithextnewlle').style.display='';
            setTimeout(function(){
              document.getElementById('edithextnewlle').style.display='none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500      
                });
                updatedvp();
                closeditextalta();
                $('#modal-edithvpextendido').modal('hide'); //cierra el modal
               // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
              }else if (respuesta == 2) {
                document.getElementById('edthdmminf').style.display='';
                setTimeout(function(){
                  document.getElementById('edthdmminf').style.display='none';
                }, 1000);
                //alert(respuesta);
                //alert("datos repetidos");
              }else{
                document.getElementById('erraetiqnew').style.display='';
                setTimeout(function(){
                  document.getElementById('erraetiqnew').style.display='none';
                }, 2000);
                alert(respuesta);
              }
            });
          }
    }

    if (tipo_ref=='PRODUCTO_TERMINADO'){
        let datos= 'tipo_ref=' + tipo_ref + '&descripcion_1=' + descripcion_1 + '&salida=' + salida + '&observa=' + observa + '&id_kax=' + id_kax + '&codigo_1=' + codigo_1 + '&opcion=updateexten';
    //alert(datos);
        if (codigo_1 == '' || salida == ''||tipo_ref == '') { 
            document.getElementById('edithextnewlle').style.display='';
            setTimeout(function(){
              document.getElementById('edithextnewlle').style.display='none';
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
                    text: 'Se actualizo de forma correcta',
                    showConfirmButton: false,
                    timer: 1500      
                });
                updatedvp();
                closeditextalta();
                $('#modal-edithvpextendido').modal('hide'); //cierra el modal
               // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
              }else if (respuesta == 2) {
                document.getElementById('edthdmminf').style.display='';
                setTimeout(function(){
                  document.getElementById('edthdmminf').style.display='none';
                }, 1000);
                //alert(respuesta);
                //alert("datos repetidos");
              }else{
                document.getElementById('erraetiqnew').style.display='';
                setTimeout(function(){
                  document.getElementById('erraetiqnew').style.display='none';
                }, 2000);
                //alert(respuesta);
              }
            });
          }
    }
  }
//LLAMA LA INFORMACIÓN PARA ELIMINAR ARTICULO EN ALTA DE PRODUCCIÓN
function deletenewart(id_delete){
    //alert(id_delete);
    document.getElementById('id_exedith').value=id_delete;
    $.ajax({
        url: '../controller/php/convale_pro.php',
        type: 'POST'
    }).done(function(respuesta) {
        obj = JSON.parse(respuesta);
        var res = obj.data;
        var x = 0;
        for (C = 0; C < res.length; C++) { 
            if (obj.data[C].id_kax == id_delete ){
                //alert("entro");
                document.getElementById('deartvpnew').value=obj.data[C].codigo_1;
            }
        }
   })
}
//GUARDA LA ELIMINACION POR ARTICULO EN ALTA DE PRODUCCION
function savdelevpart(){
    let id_kardex= document.getElementById('id_exedith').value;
    let datos= 'id_kardex=' + id_kardex  + '&opcion=deleartnew';
    //alert(datos);
    $.ajax({
        type:"POST",
        url:"../controller/php/insertvapro.php",
        data:datos
    }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se elimino de forma correcta',
              showConfirmButton: false,
              timer: 1500      
          });
          updatedvp();
          $('#modal-delearvpnew').modal('hide'); //cierra el modal
         // $('#modal-editarmemoalta').modal('hide'); //cierra el modal
        }else{
          document.getElementById('delerarvpnew').style.display='';
          setTimeout(function(){
            document.getElementById('delerarvpnew').style.display='none';
          }, 2000);
          //alert(respuesta);
        }
    });
}
//LLAMA EL FOLIO DE VALE DE PRODUCCIÓN
function delevpro(){
    $("#example tr").on('click', function() {
        var id_vale = "";
        id_vale += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
        document.getElementById('devaproduc').value=id_vale;
        //alert(id_vale)
    }) 
}
//GUARDAR LA ELIMINACION DE VALE DE PRODUCCIÓN
function savedeprodu(){
    //alert("entro guardar eliminar");
    let folio= document.getElementById('devaproduc').value;
    let datos= 'folio=' + folio  + '&opcion=deletevale';
    //alert(datos);
    $.ajax({
        type:"POST",
        url:"../controller/php/insertvapro.php",
        data:datos
    }).done(function(respuesta){
        if (respuesta==0){
            Swal.fire({
              type: 'success',
              text: 'Se elimino de forma correcta',
              showConfirmButton: false,
              timer: 1500      
            });
            setTimeout("location.href = 'vale_produccion.php';", 1500);
        }else{
            document.getElementById('delerrvprv').style.display='';
            setTimeout(function(){
              document.getElementById('delerrvprv').style.display='none';
            }, 2000);
        }
    });
}
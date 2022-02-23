//Funciones para convertir miniscula en mayuscula
function mayus(e){ e.value=e.value.toUpperCase(); } 

//--------------------------------USUARIOS---------------------------------------------------------------------
//Funcion para habilitar los input de edición de usuarios
function editusuarios(){
    //alert("editusuarios");
    document.getElementById('openedius').style.display="none";
    document.getElementById('closeditus').style.display="";
    document.getElementById('edinom').disabled= false;
    document.getElementById('ediapell').disabled= false;
    document.getElementById('editcorre').disabled= false;
    document.getElementById('editusu1').disabled= false;
    document.getElementById('editcontra').disabled= false;
    document.getElementById('editprivi').disabled= false;
    document.getElementById('usuguardar').style.display="";
}

function closeusu(){
    //alert("cerrarusu");
        document.getElementById('openedius').style.display="";
        document.getElementById('closeditus').style.display="none";
        document.getElementById('edinom').disabled= true;
        document.getElementById('ediapell').disabled= true;
        document.getElementById('editcorre').disabled= true;
        document.getElementById('editusu1').disabled= true;
        document.getElementById('editcontra').disabled= true;
        document.getElementById('editprivi').disabled= true;
        document.getElementById('usuguardar').style.display="none";
}

//FUNCION PARA QUE TRAIGA LA INFOMACION DE LA PERSONA EN LISTA DE USUARIOS
function editar(){
    $("#datausuarios tr").on('click', function() {
        var id_persona = "";
        id_persona += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
        document.getElementById('id_per').value=id_persona
        $.ajax({
            url: '../controller/php/conusuarios.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (U = 0; U < res.length; U++) { 
                if (obj.data[U].id_per == id_persona){
                   // alert(id_persona);
                    datos = 
                    obj.data[U].usunom + '*' +
                    obj.data[U].usuapell + '*' +
                    obj.data[U].correo + '*' +
                    obj.data[U].usuario + '*' +
                    obj.data[U].password + '*' +
                    obj.data[U].privilegios + '*' +
                    obj.data[U].activo;    
                    var d = datos.split("*");   
                    $("#modal-editusu #edinom").val(d[0]);   
                    $("#modal-editusu #ediapell").val(d[1]);            
                    $("#modal-editusu #editcorre").val(d[2]);
                    $("#modal-editusu #editusu1").val(d[3]);
                    $("#modal-editusu #editcontra").val(d[4]);
                    $("#modal-editusu #editprivi").val(d[5]);
                }
            }
        });
    }) 
}
//FUNCION QUE GUARDA LA EDICIÓN DE USUARIOS
function saveusuedit(){
    var usunom = document.getElementById('edinom').value;
    var usuapell = document.getElementById('ediapell').value;
    var correo = document.getElementById('editcorre').value;
    var usuario = document.getElementById('editusu1').value;
    var password = document.getElementById('editcontra').value;
    var privilegios = document.getElementById('editprivi').value;
    var id_per= document.getElementById('id_per').value;
    var datos= 'usunom=' + usunom + '&usuapell=' + usuapell + '&correo=' + correo + '&usuario=' + usuario + '&password=' + password + '&privilegios=' + privilegios + '&id_per=' + id_per +'&opcion=actualizar';
    //alert(datos);

    if (document.getElementById('edinom').value == '' || document.getElementById('ediapell').value == '' || document.getElementById('editcorre').value == '' || document.getElementById('editusu1').value == '' || document.getElementById('editcontra').value == ''|| document.getElementById('editprivi').value == '') { 
        document.getElementById('edthvacios').style.display='';
        setTimeout(function(){
          document.getElementById('edthvacios').style.display='none';
        }, 2000);
          return;
      } else {
        $.ajax({
          type:"POST",
          url:"../controller/insertusu.php",
          data:datos
        }).done(function(respuesta){
          if (respuesta==0){
            Swal.fire({
                type: 'success',
                text: 'Se actualizo de forma correcta',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout("location.href = 'usuarios.php';", 1500);
          }else if (respuesta == 2) {
            document.getElementById('edthdubli').style.display='';
            setTimeout(function(){
              document.getElementById('edthdubli').style.display='none';
            }, 1000);
            //alert("datos repetidos");
          }else{
            document.getElementById('edtherr').style.display='';
            setTimeout(function(){
              document.getElementById('edtherr').style.display='none';
            }, 2000);
          }
        });

      }
}

//FUNCION QUE ELIMINAR A UN USUARIO
function deletusu(){
    $("#datausuarios tr").on('click', function() {
        var id_persona = "";
        id_persona += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
        document.getElementById('del_per').value=id_persona;
        //alert(id_persona)
        $.ajax({
            url: '../controller/php/conusuarios.php',
            type: 'POST'
        }).done(function(respuesta) {
            obj = JSON.parse(respuesta);
            var res = obj.data;
            var x = 0;
            for (D = 0; D < res.length; D++) { 
                if (obj.data[D].id_per == id_persona){
                   // alert(id_persona);
                    datos = 
                    obj.data[D].usunom + '*' +
                    obj.data[D].usuapell;    
                    var o = datos.split("*");   
                    $("#modal-deleteusu #deusu").val(o[0] + ' ' + o[1]);   

                }
            }
        });
    }) 
}

//FUNCION QUE GUARDA LA EDICIÓN DE USUARIOS
function savedelusu(){
  var del_per= document.getElementById('del_per').value;
  var persona= document.getElementById('deusu').value;
  var datos= 'del_per=' + del_per +'&persona=' + persona  + '&opcion=eliminar';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/insertusu.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'usuarios.php';", 1500);
      }else{
          document.getElementById('delerr').style.display='';
          setTimeout(function(){
            document.getElementById('delerr').style.display='none';
          }, 2500);
        }
    });
}

//--------------------------------ARTICULOS---------------------------------------------------------------------
//Funcion para habilitar los input de edición de articulos
function editart(){
  //alert("editarticulos");
  document.getElementById('openedart').style.display="none";
  document.getElementById('closeditar').style.display="";
  document.getElementById('edicod').disabled= false;
  document.getElementById('edides').disabled= false;
  document.getElementById('editubi').disabled= false;
  document.getElementById('edituni').disabled= false;
  document.getElementById('editgrup').disabled= false;
  document.getElementById('artguardar').style.display="";
}
//Funcion para deshabilitar los input de edición de articulos
function closedthart(){
  //alert("close edith articul");
  document.getElementById('openedart').style.display="";
  document.getElementById('closeditar').style.display="none";
  document.getElementById('edicod').disabled= true;
  document.getElementById('edides').disabled= true;
  document.getElementById('editubi').disabled= true;
  document.getElementById('edituni').disabled= true;
  document.getElementById('editgrup').disabled= true;
  document.getElementById('artguardar').style.display="none";
}
//Funcion que trae los datos al modal editar articulo
function artedith(){
  //alert("entra")
  $("#arttable tr").on('click', function() {
      var id_art = "";
      id_art += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('id_art').value=id_art;
      $.ajax({
          url: '../controller/php/conarticulos.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (A = 0; A < res.length; A++) { 
              if (obj.data[A].id_art == id_art){
                  datos = 
                  obj.data[A].artcodigo + '*' +
                  obj.data[A].artdescrip + '*' +
                  obj.data[A].artubicac + '*' +
                  obj.data[A].artunidad + '*' +
                  obj.data[A].artgrupo;    
                  var d = datos.split("*");   
                  $("#modal-editarticul #edicod").val(d[0]);   
                  $("#modal-editarticul #edides").val(d[1]);            
                  $("#modal-editarticul #editubi").val(d[2]);
                  $("#modal-editarticul #edituni").val(d[3]);
                  $("#modal-editarticul #editgrup").val(d[4]);
              }
          }
      });
  }) 
}
//Funcion que trae los datos al modal editar articulo
function savearedith(){
  var artcodigo = document.getElementById('edicod').value;
  var artdescrip = document.getElementById('edides').value;
  var artubicac = document.getElementById('editubi').value;
  var artunidad = document.getElementById('edituni').value;
  var artgrupo = document.getElementById('editgrup').value;
  var id_art= document.getElementById('id_art').value;
  var datos= 'artcodigo=' + artcodigo + '&artdescrip=' + artdescrip + '&artubicac=' + artubicac + '&artunidad=' + artunidad + '&artgrupo=' + artgrupo + '&id_art=' + id_art +'&opcion=actualizara';
  //alert(datos);

  if (document.getElementById('edicod').value == '' || document.getElementById('edides').value == '' || document.getElementById('editubi').value == '' || document.getElementById('edituni').value == '' || document.getElementById('editgrup').value == '') { 
      document.getElementById('edthvaciar').style.display='';
      setTimeout(function(){
        document.getElementById('edthvaciar').style.display='none';
      }, 2000);
        return;
    } else {
      $.ajax({
        type:"POST",
        url:"../controller/php/insertarticul.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          setTimeout("location.href = 'articulos.php';", 1500);
        }else if (respuesta == 2) {
          document.getElementById('edthdubli').style.display='';
          setTimeout(function(){
            document.getElementById('edthdubli').style.display='none';
          }, 1000);
          //alert("datos repetidos");
        }else{
          document.getElementById('edtherr').style.display='';
          setTimeout(function(){
            document.getElementById('edtherr').style.display='none';
          }, 2000);
        }
      });

    }
}
//FUNCION QUE TRAE LOS DATOS A  ELIMINAR A UN ARTICULO
function deletart(){
  $("#arttable tr").on('click', function() {
      var id_art = "";
      id_art += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('del_art').value=id_art;
      //alert(id_art);
      $.ajax({
          url: '../controller/php/conarticulos.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].id_art == id_art){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].artcodigo + '*' +
                  obj.data[D].artdescrip;    
                  var o = datos.split("*");   
                  $("#modal-deleteart #deart").val(o[0]);   

              }
          }
      });
  }) 
}

//FUNCION QUE GUARDA ELIMINAR ARTICULOS
function savedeart(){
var id_art= document.getElementById('del_art').value;
var codigo= document.getElementById('deart').value;
var datos= 'id_art=' + id_art + '&codigo=' + codigo + '&opcion=eliminar';
//alert(datos);
  $.ajax({
    type:"POST",
    url:"../controller/php/insertarticul.php",
    data:datos
  }).done(function(respuesta){
    if (respuesta==0){
      Swal.fire({
        type: 'success',
        text: 'SE ELIMINO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1500
      });
        setTimeout("location.href = 'articulos.php';", 1500);
    }else{
        document.getElementById('delerar').style.display='';
        setTimeout(function(){
          document.getElementById('delerar').style.display='none';
        }, 2500);
      }
  });
}

//--------------------------------CLIENTES---------------------------------------------------------------------
//Funcion para habilitar los input de edición de clientes
function editcli(){
  //alert("editarticulos");
  document.getElementById('openedicli').style.display="none";
  document.getElementById('closeditcli').style.display="";
  document.getElementById('edicocli').disabled= false;
  document.getElementById('edithnom').disabled= false;
  document.getElementById('editrfc').disabled= false;
  document.getElementById('editcorrc').disabled= false;
  document.getElementById('clieguardar').style.display="";
}
//Funcion para deshabilitar los input de edición de clientes
function closedthcli(){
  //alert("close edith articul");
  document.getElementById('openedicli').style.display="";
  document.getElementById('closeditcli').style.display="none";
  document.getElementById('edicocli').disabled= true;
  document.getElementById('edithnom').disabled= true;
  document.getElementById('editrfc').disabled= true;
  document.getElementById('editcorrc').disabled= true;
  document.getElementById('clieguardar').style.display="none";
}
//Funcion que trae los datos al modal editar cliente
function clienedith(){
  $("#datacliente tr").on('click', function() {
      var id_cliente  = "";
      id_cliente  += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('id_cli').value=id_cliente;
      $.ajax({
          url: '../controller/php/conclientes.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (C = 0; C < res.length; C++) { 
              if (obj.data[C].id_cliente == id_cliente ){
                  datos = 
                  obj.data[C].codigo_clie + '*' +
                  obj.data[C].nombre + '*' +
                  obj.data[C].rfc + '*' +
                  obj.data[C].email;    
                  var d = datos.split("*");   
                  $("#modal-editclient #edicocli").val(d[0]);   
                  $("#modal-editclient #edithnom").val(d[1]);            
                  $("#modal-editclient #editrfc").val(d[2]);
                  $("#modal-editclient #editcorrc").val(d[3]);
              }
          }
      });
  }) 
}
//Funcion que trae los guarda los datos actulizados de clientes
function savecliedith(){
  var codigo_clie = document.getElementById('edicocli').value;
  var nombre = document.getElementById('edithnom').value;
  var rfc = document.getElementById('editrfc').value;
  var email = document.getElementById('editcorrc').value;
  var id_cliente = document.getElementById('id_cli').value;
  var datos= 'codigo_clie=' + codigo_clie + '&nombre=' + nombre + '&rfc=' + rfc + '&email=' + email + '&id_cliente=' + id_cliente +'&opcion=actualizar';
  //alert(datos);

  if (document.getElementById('edicocli').value == '' || document.getElementById('edithnom').value == '' || document.getElementById('editrfc').value == '' || document.getElementById('editcorrc').value == '') { 
      document.getElementById('edthclivacios').style.display='';
      setTimeout(function(){
        document.getElementById('edthclivacios').style.display='none';
      }, 2000);
        return;
    } else {
      $.ajax({
        type:"POST",
        url:"../controller/php/insertclient.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          setTimeout("location.href = 'clientes.php';", 1500);
        }else if (respuesta == 2) {
          document.getElementById('edthdclibli').style.display='';
          setTimeout(function(){
            document.getElementById('edthdclibli').style.display='none';
          }, 1000);
          //alert("datos repetidos");
        }else{
          document.getElementById('edthclierr').style.display='';
          setTimeout(function(){
            document.getElementById('edthclierr').style.display='none';
          }, 2000);
        }
      });

    }
}
//FUNCION QUE TRAE LOS DATOS PARA ELIMINAR AL CLIENTE
function deletclient(){
  $("#datacliente tr").on('click', function() {
      var del_clie = "";
      del_clie += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('del_clie').value=del_clie;
      //alert(del_clie);
      $.ajax({
          url: '../controller/php/conclientes.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].id_cliente == del_clie){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].nombre;    
                  var o = datos.split("*");   
                  $("#modal-deletecli #decli").val(o[0]);   

              }
          }
      });
  }) 
}
//FUNCION QUE GUARDA ELIMINAR CLIENTE
function savedecli(){
  var id_cliente = document.getElementById('del_clie').value;
  //alert(id_cliente);
  var nombre= document.getElementById('decli').value;
  var datos= 'id_cliente=' + id_cliente + '&nombre=' + nombre + '&opcion=eliminar';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/php/insertclient.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'clientes.php';", 1500);
      }else{
          document.getElementById('delerrcli').style.display='';
          setTimeout(function(){
            document.getElementById('delerrcli').style.display='none';
          }, 2500);
        }
    });
  }
//--------------------------------PROVEEDORES---------------------------------------------------------------------
//Funcion para habilitar los input de edición de clientes
function editprov(){
  document.getElementById('openeditpro').style.display="none";
  document.getElementById('closeditpro').style.display="";
  document.getElementById('editcodigo_pro').disabled= false;
  document.getElementById('editcondi_pago').disabled= false;
  document.getElementById('editnom_pro').disabled= false;
  document.getElementById('edithdomi_fisc').disabled= false;
  document.getElementById('edtcont_1').disabled= false;
  document.getElementById('edthtel_c1').disabled= false;
  document.getElementById('edithtel_c2').disabled= false;
  document.getElementById('edithemail_c1').disabled= false;
  document.getElementById('edithemail_c2').disabled= false;
  document.getElementById('edithcont_2').disabled= false;
  document.getElementById('edithtel_c3').disabled= false;
  document.getElementById('edithtel_c4').disabled= false;
  document.getElementById('edithemail_c3').disabled= false;
  document.getElementById('edithemail_c4').disabled= false;
  document.getElementById('edithobser_prov').disabled= false;
  document.getElementById('provguardar').style.display="";
}
//Funcion para deshabilitar los input de edición de clientes
function closedthpro(){
  document.getElementById('openeditpro').style.display="";
  document.getElementById('closeditpro').style.display="none";
  document.getElementById('editcodigo_pro').disabled= true;
  document.getElementById('editcondi_pago').disabled= true;
  document.getElementById('editnom_pro').disabled= true;
  document.getElementById('edithdomi_fisc').disabled= true;
  document.getElementById('edtcont_1').disabled= true;
  document.getElementById('edthtel_c1').disabled= true;
  document.getElementById('edithtel_c2').disabled= true;
  document.getElementById('edithemail_c1').disabled= true;
  document.getElementById('edithemail_c2').disabled= true;
  document.getElementById('edithcont_2').disabled= true;
  document.getElementById('edithtel_c3').disabled= true;
  document.getElementById('edithtel_c4').disabled= true;
  document.getElementById('edithemail_c3').disabled= true;
  document.getElementById('edithemail_c4').disabled= true;
  document.getElementById('edithobser_prov').disabled= true;
  document.getElementById('clieguardar').style.display="none";
}
//Funcion que trae los datos al modal editar articulo
function proveedith(){
  //alert("entra EDITAR PROVEEDOR")
  $("#dataprove tr").on('click', function() {
      var id_prov = "";
      id_prov += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('id_prov').value=id_prov;
      $.ajax({
          url: '../controller/php/conproveedores.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (P = 0; P < res.length; P++) { 
              if (obj.data[P].id_prov == id_prov ){
                  datos = 
                  obj.data[P].codigo_pro + '*' +
                  obj.data[P].condi_pago + '*' +
                  obj.data[P].nom_pro + '*' +
                  obj.data[P].domi_fisc + '*' +
                  obj.data[P].cont_1 + '*' +
                  obj.data[P].tel_c1 + '*' +
                  obj.data[P].tel_c2 + '*' +
                  obj.data[P].email_c1 + '*' +
                  obj.data[P].email_c2 + '*' +
                  obj.data[P].cont_2 + '*' +
                  obj.data[P].tel_c3 + '*' +
                  obj.data[P].tel_c4 + '*' +
                  obj.data[P].email_c3 + '*' +
                  obj.data[P].email_c4 + '*' +
                  obj.data[P].obser_prov;    
                  var d = datos.split("*");   
                  $("#modal-editprov #editcodigo_pro").val(d[0]);   
                  $("#modal-editprov #editcondi_pago").val(d[1]);            
                  $("#modal-editprov #editnom_pro").val(d[2]);
                  $("#modal-editprov #edithdomi_fisc").val(d[3]);
                  $("#modal-editprov #edtcont_1").val(d[4]);
                  $("#modal-editprov #edthtel_c1").val(d[5]);
                  $("#modal-editprov #edithtel_c2").val(d[6]);
                  $("#modal-editprov #edithemail_c1").val(d[7]);
                  $("#modal-editprov #edithemail_c2").val(d[8]);
                  $("#modal-editprov #edithcont_2").val(d[9]);
                  $("#modal-editprov #edithtel_c3").val(d[10]);
                  $("#modal-editprov #edithtel_c4").val(d[11]);
                  $("#modal-editprov #edithemail_c3").val(d[12]);
                  $("#modal-editprov #edithemail_c4").val(d[13]);
                  $("#modal-editprov #edithobser_prov").val(d[14]);
              }
          }
      });
  }) 
}
//Funcion que trae los guarda los datos actualizados de proveedores
function saveprovedith(){
  var codigo_pro = document.getElementById('editcodigo_pro').value;
  var nom_pro = document.getElementById('editnom_pro').value;
  var domi_fisc = document.getElementById('edithdomi_fisc').value;
  var condi_pago = document.getElementById('editcondi_pago').value;
  var cont_1 = document.getElementById('edtcont_1').value;
  var tel_c1 = document.getElementById('edthtel_c1').value;
  var tel_c2 = document.getElementById('edithtel_c2').value;
  var email_c1 = document.getElementById('edithemail_c1').value;
  var email_c2 = document.getElementById('edithemail_c2').value;
  var cont_2 = document.getElementById('edithcont_2').value;
  var tel_c3 = document.getElementById('edithtel_c3').value;
  var tel_c4 = document.getElementById('edithtel_c4').value;
  var email_c3 = document.getElementById('edithemail_c3').value;
  var email_c4 = document.getElementById('edithemail_c4').value;
  var obser_prov = document.getElementById('edithobser_prov').value;
  var id_prov = document.getElementById('id_prov').value;

  var datos= 'codigo_pro=' + codigo_pro + '&nom_pro=' + nom_pro + '&domi_fisc=' + domi_fisc + '&condi_pago=' + condi_pago + '&cont_1=' + cont_1 + '&tel_c1=' + tel_c1 + '&tel_c2=' + tel_c2 + '&email_c1=' + email_c1 + '&email_c2=' + email_c2 + '&cont_2=' + cont_2 + '&tel_c3=' + tel_c3 + '&tel_c4=' + tel_c4 + '&email_c3=' + email_c3 + '&email_c4=' + email_c4 + '&obser_prov=' + obser_prov + '&id_prov=' + id_prov +'&opcion=actualizar';
  //alert(datos);

  if (document.getElementById('editcodigo_pro').value == '' || document.getElementById('editnom_pro').value == '' || document.getElementById('edithdomi_fisc').value == '' || document.getElementById('editcondi_pago').value == '' || document.getElementById('editcondi_pago').value == ''|| document.getElementById('edtcont_1').value == '' || document.getElementById('edthtel_c1').value == '') { 
      document.getElementById('edthprovacios').style.display='';
      setTimeout(function(){
        document.getElementById('edthprovacios').style.display='none';
      }, 2000);
        return;
    } else {
      $.ajax({
        type:"POST",
        url:"../controller/php/insertprove.php",
        data:datos
      }).done(function(respuesta){
        if (respuesta==0){
          Swal.fire({
              type: 'success',
              text: 'Se actualizo de forma correcta',
              showConfirmButton: false,
              timer: 1500
          });
          setTimeout("location.href = 'provedores.php';", 1500);
        }else if (respuesta == 2) {
          document.getElementById('edthprove').style.display='';
          setTimeout(function(){
            document.getElementById('edthprove').style.display='none';
          }, 1000);
          //alert("datos repetidos");
        }else{
          document.getElementById('edthproerr').style.display='';
          setTimeout(function(){
            document.getElementById('edthproerr').style.display='none';
          }, 2000);
        }
      });
    }
}
//FUNCION QUE TRAE LOS DATOS PARA ELIMINAR AL PROVEEDOR
function deletprov(){
  $("#dataprove tr").on('click', function() {
      var del_prov = "";
      del_prov += $(this).find('td:eq(0)').html(); //Toma el id de la persona 
      document.getElementById('del_prov').value=del_prov;
      //alert(del_prov);
      $.ajax({
          url: '../controller/php/conproveedores.php',
          type: 'POST'
      }).done(function(respuesta) {
          obj = JSON.parse(respuesta);
          var res = obj.data;
          var x = 0;
          for (D = 0; D < res.length; D++) { 
              if (obj.data[D].id_prov == del_prov ){
                 // alert(id_persona);
                  datos = 
                  obj.data[D].nom_pro;    
                  var o = datos.split("*");   
                  $("#modal-deleprov #deprov").val(o[0]);   
              }
          }
      });
  }) 
}
//FUNCION QUE GUARDA ELIMINAR PROVEEDOR
function savedeprov(){
  var id_prov = document.getElementById('del_prov').value;
  //alert(id_prov);
  var nom_pro= document.getElementById('deprov').value;
  var datos= 'id_prov=' + id_prov + '&nom_pro=' + nom_pro + '&opcion=eliminar';
  //alert(datos);
    $.ajax({
      type:"POST",
      url:"../controller/php/insertprove.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1500
        });
          setTimeout("location.href = 'provedores.php';", 1500);
      }else{
          document.getElementById('delerrprov').style.display='';
          setTimeout(function(){
            document.getElementById('delerrprov').style.display='none';
          }, 2500);
        }
    });
  }
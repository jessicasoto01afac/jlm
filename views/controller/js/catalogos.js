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
function artedith(id_art){
  //alert(id_art)
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
function deletart(id_art){
  
      document.getElementById('del_art').value=id_art;
      alert(id_art);
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
  document.getElementById('edithcont_3').disabled= false;
  document.getElementById('edithtel_c5').disabled= false;
  document.getElementById('edithtel_c6').disabled= false;
  document.getElementById('edithemail_c5').disabled= false;
  document.getElementById('edithemail_c6').disabled= false;
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
  document.getElementById('edithcont_3').disabled= true;
  document.getElementById('edithtel_c5').disabled= true;
  document.getElementById('edithtel_c6').disabled= true;
  document.getElementById('edithemail_c5').disabled= true;
  document.getElementById('edithemail_c6').disabled= true;
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
                  obj.data[P].cont_3 + '*' +
                  obj.data[P].tel_c5 + '*' +
                  obj.data[P].tel_c6 + '*' +
                  obj.data[P].email_c5 + '*' +
                  obj.data[P].email_c6 + '*' +
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
                  $("#modal-editprov #edithcont_3").val(d[14]);
                  $("#modal-editprov #edithtel_c5").val(d[15]);
                  $("#modal-editprov #edithtel_c6").val(d[16]);
                  $("#modal-editprov #edithemail_c5").val(d[17]);
                  $("#modal-editprov #edithemail_c6").val(d[18]);
                  $("#modal-editprov #edithobser_prov").val(d[19]);
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
 
  var cont_3 = document.getElementById('edithcont_3').value;
  var tel_c5 = document.getElementById('edithtel_c5').value;
  var tel_c6 = document.getElementById('edithtel_c6').value;
  var email_c5 = document.getElementById('edithemail_c5').value;
  var email_c6 = document.getElementById('edithemail_c6').value;
  
  var obser_prov = document.getElementById('edithobser_prov').value;
  var id_prov = document.getElementById('id_prov').value;

  var datos= 'codigo_pro=' + codigo_pro + '&nom_pro=' + nom_pro + '&domi_fisc=' + domi_fisc + '&condi_pago=' + condi_pago + '&cont_1=' + cont_1 + '&tel_c1=' + tel_c1 + '&tel_c2=' + tel_c2 + '&email_c1=' + email_c1 + '&email_c2=' + email_c2 + '&cont_2=' + cont_2 + '&tel_c3=' + tel_c3 + '&tel_c4=' + tel_c4 + '&email_c3=' + email_c3 + '&email_c4=' + email_c4 + '&cont_3=' + cont_3 + '&tel_c5=' + tel_c5 + '&tel_c6=' + tel_c6 + '&email_c5=' + email_c5 + '&email_c6=' + email_c6 + '&obser_prov=' + obser_prov + '&id_prov=' + id_prov +'&opcion=actualizar';
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

//--------------------------------TRANSFORMACIÓN---------------------------------------------------------------------
//Funcion para habilitar los input de edición de usuarios
function addtransform(){ //08052022 agregar
  //alert("entra transform");
  let id_articulo_final = document.getElementById('vppcodigo').value;
  let id_extendido = document.getElementById('vpcodigoext').value;
  let id_etiquetas = document.getElementById('vpcodigoetiq').value;
  let hojas = document.getElementById('artdescriphojas').value;
  let divicion = document.getElementById('division').value;
  let carton = document.getElementById('cartonapl').value;
  let id_carton = document.getElementById('codcarton').value;
  let div_carton = document.getElementById('descarton').value;
  let multi_carton = document.getElementById('multcarton').value;
  let cartonsillo = document.getElementById('cartaplic').value;
  let id_cortonsillo = document.getElementById('codcartonsillo').value;
  let div_cartonsillo = document.getElementById('descartonsillo').value;
  let multi_cartonsillo = document.getElementById('multcartonsillo').value;
  let caple = document.getElementById('capleaplic').value;
  let id_caple = document.getElementById('codcaple').value;
  let div_caple = document.getElementById('descaple').value;
  let multi_caple = document.getElementById('multcaple').value;
  let liston_cordon = document.getElementById('listonaplic').value;
  let id_cordliston = document.getElementById('codliston').value;
  let multi_liston = document.getElementById('multliston').value;
  //Comprobar si esta esta seleccionado
  if (carton=='NO APLICA'){
    document.getElementById('cartonapl').value='NO APLICA';
    id_carton=0;
    div_carton=0;
    multi_carton=0;
  }else if (cartonsillo=='NO APLICA'){
    document.getElementById('cartaplic').value='NO APLICA';
    id_cortonsillo=0;
    div_cartonsillo=0;
    multi_cartonsillo=0;
  }else if (caple=='NO APLICA'){
    document.getElementById('capleaplic').value='NO APLICA';
    id_caple=0;
    div_caple=0;
    multi_caple=0;
  }else if (liston_cordon=='NO APLICA'){
    document.getElementById('listonaplic').value='NO APLICA';
    id_cordliston=0;
    multi_liston=0;
  }else if (carton==='0'){
    document.getElementById('listonaplic').value='NO APLICA';
    id_cordliston=0;
    multi_liston=0;
  }else if (cartonsillo==='0'){
    document.getElementById('cartaplic').value='NO APLICA';
    id_cortonsillo=0;
    div_cartonsillo=0;
    multi_cartonsillo=0;
  }else if (caple==='0'){
    document.getElementById('capleaplic').value='NO APLICA';
    id_caple=0;
    div_caple=0;
    multi_caple=0;
  }else if (liston_cordon==='0'){
    document.getElementById('listonaplic').value='NO APLICA';
    id_cordliston=0;
    multi_liston=0;
  }

  let datos= 'id_articulo_final=' + id_articulo_final + '&id_extendido=' + id_extendido + '&id_etiquetas=' + id_etiquetas + '&hojas=' + hojas + '&divicion=' + divicion + '&carton=' + carton + '&id_carton=' + id_carton + '&div_carton=' + div_carton + '&multi_carton=' + multi_carton + '&cartonsillo=' + cartonsillo + '&id_cortonsillo=' + id_cortonsillo + '&div_cartonsillo=' + div_cartonsillo + '&multi_cartonsillo=' + multi_cartonsillo + '&caple=' + caple + '&id_caple=' + id_caple + '&div_caple=' + div_caple + '&multi_caple=' + multi_caple + '&liston_cordon=' + liston_cordon + '&id_cordliston=' + id_cordliston + '&multi_liston=' + multi_liston + '&opcion=registrar';
  alert(datos);

  if (id_articulo_final == '' || id_extendido == '' || id_etiquetas == '' || hojas == '' || divicion == '') {
    document.getElementById('vaciosartras').style.display=''
    setTimeout(function(){
    document.getElementById('vaciosartras').style.display='none';
  }, 1500);
    return;
  } else {
    $.ajax({
      type:"POST",
      url:"../controller/php/insertransf.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
              type: 'success',
              title: 'JLM INFORMA',
              text: 'LA TRANSFORMACIÓN SE AGREGO CORRECTAMENTE',
              showCloseButton: false,
              showCancelButton: true,
              focusConfirm: false,
              confirmButtonColor: "#1774D8",
              customClass: 'swal-wide',
              confirmButtonText: '<span style="color: white;"><a class="a-alert" href="newtrasn.php">¿Deseas agregar otro articulo?</a></span>',
              confirmButtonAriaLabel: 'Thumbs up, great!',
              cancelButtonText: '<a  class="a-alert" href="transformacion.php"><span style="color: white;">Cerrar</span></a>',
              cancelButtonAriaLabel: 'Thumbs down'
                  // timer: 2900
          });
      }else if (respuesta == 2) {
        document.getElementById('dubliartras').style.display=''
        setTimeout(function(){
        document.getElementById('dubliartras').style.display='none';
        }, 1000);
      }else{
        document.getElementById('errartras').style.display=''
        setTimeout(function(){
        document.getElementById('errartras').style.display='none';
        }, 2000);
      alert(respuesta);
      }
    });//FIN DE AJAX
  }
}

//FUNCION DONDE RECOLECTA LA INFORMACION DEL ARTICULO DE TRASFORMACION PARA EDITAR
function infolistrans(id_transform){
  //alert(id_transform);
  document.getElementById('id_arttras').value=id_transform
  $.ajax({
    url: '../controller/php/contrasforma.php',
    type: 'POST'
}).done(function(respuesta) {
    obj = JSON.parse(respuesta);
    let res = obj.data;
    let x = 0;
    for (D = 0; D < res.length; D++) { 
        if (obj.data[D].id_trans == id_transform ){
           // alert(id_persona);
            datos = 
            obj.data[D].id_articulo_final+ '*' +
            obj.data[D].id_extendido + '*' +
            obj.data[D].id_etiquetas + '*' +
            obj.data[D].hojas + '*' +
            obj.data[D].divicion + '*' +
            obj.data[D].id_carton + '*' +
            obj.data[D].div_carton + '*' +
            obj.data[D].multi_carton + '*' +
            obj.data[D].id_cortonsillo + '*' +
            obj.data[D].div_cartonsillo + '*' +
            obj.data[D].multi_cartonsillo + '*' +
            obj.data[D].id_caple + '*' +
            obj.data[D].div_caple + '*' +
            obj.data[D].multi_caple + '*' +
            obj.data[D].id_cordliston + '*' +
            obj.data[D].multi_liston;  
            let o = datos.split("*");   
            $("#modal-edithtrans #edithartfin").val(o[0]);
            $("#modal-edithtrans #edithartext").val(o[1]);
            $("#modal-edithtrans #editharetq").val(o[2]);
            $("#modal-edithtrans #edithojas").val(o[3]);  
            $("#modal-edithtrans #editdivision").val(o[4]);
            $("#modal-edithtrans #edthcarton").val(o[5]);
            $("#modal-edithtrans #eddivcarton").val(o[6]);
            $("#modal-edithtrans #multcartonedt").val(o[7]);
            $("#modal-edithtrans #edthcartonsillo").val(o[8]);
            $("#modal-edithtrans #eddivcartonsillo").val(o[9]);
            $("#modal-edithtrans #multcartonsilloedt").val(o[10]);
            $("#modal-edithtrans #edthcaplecod").val(o[11]);
            $("#modal-edithtrans #eddivcaple").val(o[12]);
            $("#modal-edithtrans #multcapleedt").val(o[13]);
            $("#modal-edithtrans #codlistonedt").val(o[14]);
            $("#modal-edithtrans #multlistonedt").val(o[15]);
            //CARTON
            if (obj.data[D].carton == "0" ){
              document.getElementById('cartonedt').value="NO APLICA";
            }else if (obj.data[D].carton == "NO APLICA"){
              document.getElementById('cartonedt').value="NO APLICA";
            }else if (obj.data[D].carton == "APLICA"){
              document.getElementById('cartonedt').value="APLICA";
            }
            //CARTONSILLO
            if (obj.data[D].cartonsillo == "0" ){
              document.getElementById('cartonsilledith').value="NO APLICA";
            }else if (obj.data[D].cartonsillo == "NO APLICA"){
              document.getElementById('cartonsilledith').value="NO APLICA";
            }else if (obj.data[D].cartonsillo == "APLICA"){
              document.getElementById('cartonsilledith').value="APLICA";
            }
            //CAPLE
            if (obj.data[D].caple == "0" ){
              document.getElementById('capleedith').value="NO APLICA";
            }else if (obj.data[D].caple == "NO APLICA"){
              document.getElementById('capleedith').value="NO APLICA";
            }else if (obj.data[D].caple == "APLICA"){
              document.getElementById('capleedith').value="APLICA";
            }
            //LISTON/CORDON
            if (obj.data[D].liston_cordon == "0" ){
              document.getElementById('listonaplicedt').value="NO APLICA";
            }else if (obj.data[D].liston_cordon == "NO APLICA"){
              document.getElementById('listonaplicedt').value="NO APLICA";
            }else if (obj.data[D].liston_cordon == "APLICA"){
              document.getElementById('listonaplicedt').value="APLICA";
            }
          }
      }
   });
}
//FUNCION DE EDITAR ARTICULO DE RASFORMACION
function editrasnf(){
  //alert("editusuarios");
  document.getElementById('openeditrasfo').style.display="none";
  document.getElementById('closetras').style.display="";
  document.getElementById('arsurvof').disabled= false;
  document.getElementById('editdivision').disabled= false;
  document.getElementById('edithojas').disabled= false;
  document.getElementById('edithartfin').disabled= false;
  document.getElementById('edithartext').disabled= false;
  document.getElementById('editharetq').disabled= false;
  document.getElementById('traeguardar').style.display="";
  //extra
  document.getElementById('cartonedt').disabled= false;
  document.getElementById('edthcarton').disabled= false;
  document.getElementById('eddivcarton').disabled= false;
  document.getElementById('multcartonedt').disabled= false;
  document.getElementById('cartonsilledith').disabled= false;
  document.getElementById('edthcartonsillo').disabled= false;
  document.getElementById('eddivcartonsillo').disabled= false;
  document.getElementById('multcartonsilloedt').disabled= false;
  document.getElementById('capleedith').disabled= false;
  document.getElementById('edthcaplecod').disabled= false;
  document.getElementById('eddivcaple').disabled= false;
  document.getElementById('multcapleedt').disabled= false;
  document.getElementById('listonaplicedt').disabled= false;
  document.getElementById('codlistonedt').disabled= false;
  document.getElementById('multlistonedt').disabled= false;

}
//FUNCION DE CERRAR EDICIÓN ARTICULO DE RASFORMACION
function closetrans(){
  //alert("cerrarusu");
  document.getElementById('openeditrasfo').style.display="";
  document.getElementById('closetras').style.display="none";
  document.getElementById('editdivision').disabled= true;
  document.getElementById('edithojas').disabled= true;
  document.getElementById('edithartfin').disabled= true;
  document.getElementById('edithartext').disabled= true;
  document.getElementById('editharetq').disabled= true;
  document.getElementById('traeguardar').style.display="none";
  //extra cartonsilloedith
  document.getElementById('cartonedt').disabled= true;
  document.getElementById('edthcarton').disabled= true;
  document.getElementById('eddivcarton').disabled= true;
  document.getElementById('multcartonedt').disabled= true;
  document.getElementById('cartonsilledith').disabled= true;
  document.getElementById('edthcartonsillo').disabled= true;
  document.getElementById('eddivcartonsillo').disabled= true;
  document.getElementById('multcartonsilloedt').disabled= true;
  document.getElementById('capleedith').disabled= true;
  document.getElementById('edthcaplecod').disabled= true;
  document.getElementById('eddivcaple').disabled= true;
  document.getElementById('multcapleedt').disabled= true;
  document.getElementById('listonaplicedt').disabled= true;
  document.getElementById('codlistonedt').disabled= true;
  document.getElementById('multlistonedt').disabled= true;
}
//FUNCION DE ELIMINAR ARTICULO DE TRANSFORMACION
function deletransf(transf){
  //alert(memos); 
  document.getElementById('detrasfor').value=transf;
  $("#transfomacion tr").on('click', function() {
    let articulo_termin = "";
    articulo_termin += $(this).find('td:eq(1)').html(); //Toma el id de la persona 
    document.getElementById('artras_dele').value=articulo_termin;
    //alert(id_persona)
  });
}
//FUNCIONQUE GUARDA LA ELIMINACION DE ARTICULO DE TRASFORMACIÓN
function savdeletransf(){
  let id_transformacion = document.getElementById('detrasfor').value;
  let datos= 'id_transformacion=' + id_transformacion + '&opcion=eliminar';
    $.ajax({
      type:"POST",
      url:"../controller/php/insertransf.php",
      data:datos
    }).done(function(respuesta){
      if (respuesta==0){
        Swal.fire({
          type: 'success',
          text: 'SE ELIMINO DE FORMA CORRECTA',
          showConfirmButton: false,
          timer: 1000
        });
        setTimeout("location.href = 'transformacion.php';", 1000);


      }else{
        document.getElementById('delerrartras').style.display=''
        setTimeout(function(){
        document.getElementById('delerrartras').style.display='none';
        }, 2000);
      alert(respuesta);
      }
    });//FIN DE AJAX
}

//FUNCIONQUE GUARDA LA EDICIÓN DE ARTICULO DE TRASFORMACIÓN
function savetraedit(){
  //alert("ENTRA GUARDAR EDICIÓN");
  let id_transformacion = document.getElementById('id_arttras').value;
  let id_articulo_final  = document.getElementById('edithartfin').value;
  let id_extendido = document.getElementById('edithartext').value;
  let id_etiquetas = document.getElementById('editharetq').value;
  let hojas = document.getElementById('edithojas').value;
  let divicion = document.getElementById('editdivision').value;
  let carton = document.getElementById('cartonedt').value;
  let id_carton = document.getElementById('edthcarton').value;
  let div_carton = document.getElementById('eddivcarton').value;
  let multi_carton = document.getElementById('multcartonedt').value;
  let cartonsillo = document.getElementById('cartonsilledith').value;
  let id_cortonsillo = document.getElementById('edthcartonsillo').value;
  let div_cartonsillo = document.getElementById('eddivcartonsillo').value;
  let multi_cartonsillo = document.getElementById('multcartonsilloedt').value;
  let caple = document.getElementById('capleedith').value;
  let id_caple = document.getElementById('edthcaplecod').value;
  let div_caple = document.getElementById('eddivcaple').value;
  let multi_caple = document.getElementById('multcapleedt').value;
  let liston_cordon = document.getElementById('listonaplicedt').value;
  let id_cordliston = document.getElementById('codlistonedt').value;
  let multi_liston = document.getElementById('multlistonedt').value;
  let datos= 'id_transformacion=' + id_transformacion + '&id_articulo_final=' + id_articulo_final  + '&id_extendido=' + id_extendido + '&id_etiquetas=' + id_etiquetas + '&hojas=' + hojas + '&divicion=' + divicion + '&carton=' + carton + '&id_carton=' + id_carton + '&div_carton=' + div_carton + '&multi_carton=' + multi_carton + '&cartonsillo=' + cartonsillo + '&id_cortonsillo=' + id_cortonsillo + '&div_cartonsillo=' + div_cartonsillo + '&multi_cartonsillo=' + multi_cartonsillo + '&caple=' + caple + '&id_caple=' + id_caple + '&div_caple=' + div_caple + '&multi_caple=' + multi_caple + '&liston_cordon=' + liston_cordon + '&id_cordliston=' + id_cordliston + '&multi_liston=' + multi_liston + '&opcion=actualizara';
//alert(datos);
  $.ajax({
    type:"POST",
    url:"../controller/php/insertransf.php",
    data:datos
  }).done(function(respuesta){
    if (respuesta==0){
      Swal.fire({
        type: 'success',
        text: 'SE ACTUALIZO DE FORMA CORRECTA',
        showConfirmButton: false,
        timer: 1000
      });
      setTimeout("location.href = 'transformacion.php';", 1000);
    }else{
      document.getElementById('delerrartras').style.display=''
      setTimeout(function(){
      document.getElementById('delerrartras').style.display='none';
      }, 2000);
    alert(respuesta);
    }
  });//FIN DE AJAX
}

function exportarusu(){

  con
}

function carton(){
  //alert("entro el vale");
  let tipo = document.getElementById("cartonapl").value;
  let codigocart = document.getElementById("carton");
  let descricarton = document.getElementById("cartondes");
  let multicarton = document.getElementById("cartonmilt");

  if (tipo == 'NO APLICA') {
      //alert(tipo);
      codigocart.style.display = 'none';
      codigocart.style.value = '0';
      descricarton.style.display = 'none';
      descricarton.style.value = 'No aplica';
      multicarton.style.display = 'none';
    
  }if (tipo == 'APLICA') {
    codigocart.style.display = '';
    descricarton.style.display = '';
    multicarton.style.display = '';

  }
}
function cartonsillo(){
  //alert("entro el vale");
  let tipo = document.getElementById("cartaplic").value;
  let codigocartonsillo = document.getElementById("cartonsillo");
  let multiplic = document.getElementById("cartonsillomilt");
  let multicarton = document.getElementById("cartonsillodes");
  if (tipo == 'NO APLICA') {
      //alert(tipo);
      codigocartonsillo.style.display = 'none';
      multicarton.style.display = 'none';
      multiplic.style.display = 'none';
  }if (tipo == 'APLICA') {
    codigocartonsillo.style.display = '';
    multiplic.style.display = '';
    multicarton.style.display = '';
  }
}
//funcion del Caple
function caple(){
  //alert("entro el vale");
  let tipo = document.getElementById("capleaplic").value;
  let codigocaple = document.getElementById("caple");
  let multiplic = document.getElementById("caplemilt");
  let multicaple = document.getElementById("capledes");
  if (tipo == 'NO APLICA') {
      //alert(tipo);
      codigocaple.style.display = 'none';
      codigocaple.style.value = '0';
      multicaple.style.display = 'none';
      multiplic.style.display = 'none';
  }if (tipo == 'APLICA') {
    codigocaple.style.display = '';
    multiplic.style.display = '';
    multicaple.style.display = '';
  }
}
//funcion del liston
function liston(){
  //alert("entro el vale");
  let tipo = document.getElementById("listonaplic").value;
  let codigocaple = document.getElementById("liston");
  let multiplic = document.getElementById("listonmilt");
  if (tipo == 'NO APLICA') {
      //alert(tipo);
      codigocaple.style.display = 'none';
      codigocaple.style.value = '0';
      multiplic.style.display = 'none';
  }if (tipo == 'APLICA') {
    codigocaple.style.display = '';
    multiplic.style.display = '';
  }
}

//FUNCIÓN QUE ACTIVA LOS ARTUCULOS EXTRA
function artextra(){
  //alert("entra articulo extra");
  let titulo = document.getElementById("xtra");
  let selecarton = document.getElementById("cartontex");
  let selecartonsillo = document.getElementById("cartonsitex");
  let selecaple = document.getElementById("caplearex");
  let seleliston = document.getElementById("listonarex");

  if ($('#artxtra').is(':checked') ) {
    //alert("seleccionado");
    titulo.style.display = '';
    selecarton.style.display = '';
    selecartonsillo.style.display = '';
    selecaple.style.display = '';
    seleliston.style.display = '';
  }else{
    //alert("no seleccionado");
    titulo.style.display = 'none';
    selecarton.style.display = 'none';
    selecartonsillo.style.display = 'none';
    selecaple.style.display = 'none';
    seleliston.style.display = 'none';
  }
}


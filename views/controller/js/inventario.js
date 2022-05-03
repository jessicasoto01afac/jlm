//FUNCION DONDE TRAE EL ID DEL CODIGO
function opende(id_alert){
alert(id_alert);

$.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
}).done(function(respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;
    for (D = 0; D < res.length; D++) { 
        if (obj.data[D].artcodigo == id_alert){
            datos = 
            obj.data[D].artcodigo + '*' +
            obj.data[D].artdescrip;    
            var o = datos.split("*");   
            //$("#noartdell").html(o[1]); 
            alert(obj.data[D].artdescrip);
        }
    }
});
}
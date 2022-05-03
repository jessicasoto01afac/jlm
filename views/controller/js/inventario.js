
function opende(id_alert){
    let codiid=id_alert;
    alert(codiid);
    $("#detalles").toggle(250); //Muestra contenedor de detalles
$("#inventario").toggle("fast");



$.ajax({
    url: '../controller/php/conarticulos.php',
    type: 'POST'
}).done(function(respuesta) {
    obj = JSON.parse(respuesta);
    let res = obj.data;
    let x = 0;
    for (D = 0; D < res.length; D++) { 
        if (obj.data[D].artcodigo == codiid){
            datos = 
            obj.data[D].artcodigo + '*' +
            obj.data[D].artdescrip;    
            let o = datos.split("*");   
            $("#noartdell").html(o[1]); 
            alert(obj.data[D].artdescrip);
           // document.getElementById('idartic').value=id_alert; 
        }
    }
});
}


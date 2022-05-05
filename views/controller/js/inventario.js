
function opende(id_artic){
//alert("entra");
    //alert(id_artic);
    $("#datalles").toggle(250); //Muestra contenedor de detalles
$("#inventarios").toggle("fast");
$.ajax({
    url: '../controller/php/condetallesart.php',
    type: 'POST'
}).done(function(respuesta) {
    obj = JSON.parse(respuesta);
    var res = obj.data;
    var x = 0;
    for (D = 0; D < res.length; D++) { 
        if (obj.data[D].artcodigo == id_artic){
            let suma = Number(obj.data[D].SUMA);
            let resta=Number (obj.data[D].RESTA);
            let inicio =Number(obj.data[D].stock_inicial);
            inventario=  inicio + (suma - resta);
            document.getElementById('existe').innerHTML=inventario;
            datos = 
            obj.data[D].artcodigo + '*' +
            obj.data[D].artdescrip + '*' +
            obj.data[D].stock_inicial + '*' +
            obj.data[D].RESTA + '*' +
            obj.data[D].SUMA;    
            var o = datos.split("*");   
            $("#idartic").val(o[0]);   
            $("#noartdell").html(o[1]);   
            $("#stockini").html(o[2]);
            //alert(obj.data[D].SUMA);
            alert(obj.data[D].stock_inicial);
        }
    }
});
}


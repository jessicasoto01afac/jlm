function adjuntarevi() {

    var paqueteDeDatos = new FormData();
    paqueteDeDatos.append('OjtAgra', $('#OjtAgra')[0].files[0]);
    paqueteDeDatos.append('ojtIdper', $('#ojtIdper').prop('value'));
    paqueteDeDatos.append('ojtdocadjunto', $('#ojtdocadjunto').prop('value'));
    paqueteDeDatos.append('ojtNemple', $('#ojtNemple').prop('value'));
    paqueteDeDatos.append('opcion', 'documento');
    $.ajax({
        url: '../php/docInpector.php',
        data: paqueteDeDatos,
        type: "POST",
        contentType: false,
        processData: false,
        success: function(r) {

            $('#nota').show();    

            if (r == 8) {
                $('#vaciojt').toggle('toggle');
                setTimeout(function() {
                    $('#vaciojt').toggle('toggle');
                }, 4000);

                $("#nota").hide();  

            } else if (r == 0) {
                $('#exitojt').toggle('toggle');
                setTimeout(function() {
                    $('#exitojt').toggle('toggle');
                }, 4000);
                $("#nota").hide();  
                consultardocIns(ojtIdper);

            } else if (r == 1) {
                $('#fallajt').toggle('toggle');
                setTimeout(function() {
                    $('#fallajt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            } else if (r == 2) {
                $('#errorjt').toggle('toggle');
                setTimeout(function() {
                    $('#errorjt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            } else if (r == 3) {
                $('#renomjt').toggle('toggle');
                setTimeout(function() {
                    $('#renomjt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            } else if (r == 4) {
                $('#fornjt').toggle('toggle');
                setTimeout(function() {
                    $('#fornjt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            } else if (r == 6) {
                $('#adjuntajt').toggle('toggle');
                setTimeout(function() {
                    $('#adjuntajt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            } else if (r == 7) {
                $('#repetidojt').toggle('toggle');
                setTimeout(function() {
                    $('#repetidojt').toggle('toggle');
                }, 4000);
                $("#nota").hide();                  
            }
        }
    });
}
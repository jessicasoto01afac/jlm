alert("entra validacion")
$('document').ready(function() {

    var nameregex = /^[A-Z0-9_\.\-\+\*\/,a-z,ñ,Ñ]+$/;

    $.validator.addMethod("validname", function(value, element) {
        return this.optional(element) || nameregex.test(value);
    });

    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    $.validator.addMethod("validemail", function(value, element) {
        return this.optional(element) || eregex.test(value);
    });

    $("#formtec").validate({

        rules: {
            tecn: {
                required: true,
                validname: false,
                minlength: 5
            },
            pass: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
        },
        messages: {

            tecn: {
                required: "Favor de ingresar usuario",
                validname: "Utilice formato solicitado",
                minlength: "Su usuario es demasiado corto"
            },
            pass: {
                required: "Favor de ingresar contraseña",
                minlength: "La contraseña tiene al menos 1 caracteres"
            },

        },
        errorPlacement: function(error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },



    });



});



function mayus(e) { e.value = e.value.toUpperCase(); }
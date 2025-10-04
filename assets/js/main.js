$(window).on('load', function() {
    setTimeout(function() {
        $(".loader").fadeOut("slow");
    }, 3000);
});
$(document).ready(function() {
    $("#usuarior").blur(function() {
        validarUser($("#usuarior").val());
    });
    $('#formLogin').submit(function(e) {
        e.preventDefault();
        var informacion = $('#formLogin').serialize();
        var metodo = $('#formLogin').attr('method');
        var peticion = $('#formLogin').attr('action');
        $.ajax({
            type: metodo,
            url: peticion,
            data: informacion,
            beforeSend: function() {
                $("#msj").html('<p class="text-center alert alert-info">Cargando...</p>');
            },
            error: function() {
                $("#msj").html('<p class="text-center alert alert-danger">Ha Ocurrido un Error</p>');
            },
            success: function(data) {
                $("#msj").html(data);

            }
        });
    });

    $('#formRegistro').submit(function(e) {
        e.preventDefault();
        var form = $('#formRegistro');
        var ready = false;
        if (form[0][0]['value'] != "" && form[0][1]['value'] != "" && form[0][2]['value'] != "" && form[0][3]['value'] != "" && form[0][4]['value'] != "") {
            ready = true;
        } else {
            ready = false;
            $("#msj").html('<p class="text-center alert alert-info">Hay algunos campos vacios</p>');
            e.preventDefault();
        }
        if (ready) {
            validarUser($("#usuarior").val());
            if (validarEmail(form[0][3]['value']) && validarEmail(form[0][4]['value'])) {
                if (form[0][3]['value'] === form[0][4]['value']) {
                    var informacion = $('#formRegistro').serialize();
                    var metodo = $('#formRegistro').attr('method');
                    var peticion = $('#formRegistro').attr('action');
                    $.ajax({
                        type: metodo,
                        url: peticion,
                        data: informacion,
                        beforeSend: function() {
                            $("#msj").html('<p class="text-center alert alert-info">Registrando...</p>');
                            $(".loader").removeAttr("style");
                        },
                        error: function() {
                            $("#msj").html('<p class="text-center alert alert-danger">Ha Ocurrido un Error</p>');
                            $(".loader").fadeOut("slow");
                        },
                        success: function(data) {
                            $("#msj").html(data);
                            $(".loader").fadeOut("slow");
                        }
                    });
                } else {
                    $("#msj").html('<p class="text-center alert alert-info">Email no coiciden!</p>');
                    form[0][3].focus();
                }
            } else {
                $("#msj").html('<p class="text-center alert alert-info">El email no tiene un formato valido!</p>');
                form[0][3].focus();
                e.preventDefault();
            }
        }
    });

    $("#form_rc").submit(function(e) {
        e.preventDefault();
        var datos = $("#form_rc").serialize();
        $.ajax({
            type: "POST",
            url: "?c=home&a=recuperar_clave",
            data: datos,
            beforeSend: function() {
                $("#rep_rc").html(
                    '<div class="alert alert-info text-center" > Validando Información...<br><img src="assets/img/pagoss.gif"></div>'
                );
            },
            error: function() {
                $("#rep_rc").html(
                    '<div class="alert alert-danger text-center" >Ha Ocurrido Un Error</div>'
                );
            },
            success: function(data) {
                $("#rep_rc").html(data);
            }
        });
        return false;
    });
});

/*registro */
function validarEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validarUser(id) {
    if (id != "") {
        $.ajax({
            type: "POST",
            url: "?c=home&a=validar_user",
            data: { id: id },
            beforeSend: function() {
                console.log("enviando");
            },
            error: function() {
                console.log("error");
            },
            success: function(data) {
                if (data === "-1") {
                    $("#res_usu").attr("class", "text-right text-success mb-3");
                    $("#res_usutxt").html("Usuario Disponible");
                    $("#usuarior").attr("class", "form-control correcto");
                    setTimeout(function() {
                        $("#res_usutxt").html("");
                    }, 3000);
                } else {
                    $("#res_usutxt").html("Usuario no Disponible");
                    $("#res_usu").attr("class", "text-right text-danger mb-3");
                    $("#usuarior").attr("class", "form-control incorrecto");
                    setTimeout(function() {
                        $("#res_usutxt").html("");
                    }, 3000);
                    return false;
                }
            }
        });
    } else {
        $("#usuarior").attr("class", "form-control incorrecto");
    }
}
/*registro */
/*data prueba*/

function dataprueba(key) {
    switch (key) {
        case 1:
            $("#nombre").val("JESUS");
            $("#usuarior").val("JESUS");
            $("#clave").val("JESUS");
            $("#email").val("jesus-indriago@hotmail.com");
            $("#emailc").val("jesus-indriago@hotmail.com");
            break;

        default:
            break;
    }
}

/*data prueba*/

/*funciones globales */
function soloNum(e) {
    tecla = document.all ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[z0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function decimal(e) {
    tecla = document.all ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    patron = /^[0-9.]+$/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

/*funciones globales */
$(document).ready(function() {
    cargarCuentas();
    loaderImportar();
    Movimientos();
});
 /*dashboard*/
/* Movimientos */
$("#form_cm").submit(function(e) {
    e.preventDefault();
    var informacion = $('#form_cm').serialize();
    var metodo = $('#form_cm').attr('method');
    var peticion = $('#form_cm').attr('action');
    $.ajax({
        type: metodo,
        url: peticion,
        data: informacion,
        beforeSend: function() {
            $("#res-de").html(loader(3));
            $('#res-de').attr('class', 'mostrard');
            $('#bdetalle').attr('class', 'ocultard');
            $('#fm').attr('class', 'ocultard');
        },
        error: function() {
            $("#res-de").html(loader(2));
        },
        success: function(data) {
            $("#res-de").html(data);
        }
    });
    return false;
});
$('#ver_movimiento').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type: 'post',
        url: '?c=app&a=ver_movimiento',
        data: 'id=' + rowid,
        beforeSend: function() {
            $("#res-de").html(loader(1));
        },
        error: function() {
            $("#res-de").html(loader(2));
        },
        success: function(data) {
            data = $.parseJSON(data);
            if (data.resp == -1) {
                $("#res-de").html(loader(2));
            } else {
                $('#btn-cm').removeAttr("disabled");
                $('#res-de').attr('class', 'ocultard');
                $('#bdetalle').attr('class', 'mostrard');
                $('#fm').attr('class', 'mostrard');
                $("#id").val(data.data[0].idmov);
                $("#dcuenta").val(data.data[0].cuentanumero);
                $("#dcategoria").val(data.data[0].titulo);
                $("#dnota").val(data.data[0].nota);
                $("#dreferencia").val(data.data[0].referencia);
                $("#dmonto").val(data.data[0].monto);
                $("#dfecha").val(data.data[0].fecha);
                $("#dbanco").val(data.data[0].razon_social);
                $("#ddescripcion").val(data.data[0].descrip);
                $('#dsubCategoria').empty().append(data.data[0].opciones);
                $("#dsubCategoria option[value=" + data.data[0].subcategorian + "]").attr("selected", true);

            }
        }
    });
});
$('#ver_movimiento').on('hide.bs.modal', function(e) {
    $('#bdetalle').attr('class', 'ocultard');
    $('#fm').attr('class', 'ocultard');
    $('#res-de').attr('class', 'mostrad');
    $('#btn-cm').attr('disabled', 'true');
});
var ccuenta = 0;

function cargarMovimentosxc(id) {
    ccuenta = id;
    $("#imovimietos").modal("show");
}

function cerrarMovimiento() {
    setTimeout(function() {
        $("#imovimietos").modal("hide");
    }, 3000);
}

function Movimientos() {

    $("#tbMovimientos").attr("class", "table table-striped table-bordered dt-responsive nowrap mostrar");
    $('#tbMovimientos').DataTable({
        destroy: true,
        dom: 'Bfrtip',
        language: {
            "decimal": "",
            "emptyTable": "No hay existe Movimientos Registrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Movimientos",
            "infoEmpty": "Mostrando 0 de 0 Total 0 Movimientos",
            "infoFiltered": "(Filtrado de _MAX_ total Movimientos)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Movimientos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados Movimientos encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": ">",
                "previous": "<"
            }
        },
        buttons: [{
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                className: 'btn btn-success text-center d-none',
                header: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5],
                    orthogonal: 'sort'
                },
                customizeData: function(data) {
                    for (var i = 0; i < data.body.length; i++) {
                        for (var j = 0; j < data.body[i].length; j++) {
                            data.body[i][j] = '\u200C' + data.body[i][j];
                        }
                    }
                }

            },
            {
                extend: 'csv',
                text: 'Exportar a csv',
                className: 'btn btn-warning text-center d-none',
                header: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                header: true,
                text: 'Exportar a pdf',
                className: 'btn btn-danger text-center d-none',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]

                }
            },
            {
                extend: 'print',
                header: true,
                text: 'Imprimir',
                className: 'btn btn-info text-center d-none',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]

                }
            },
        ],
        ajax: {
            type: "GET",
            dataType: "json",
            url: "index.php?c=app&a=dataTablaMovimiento"
        },
        columnDefs: [
            // { responsivePriority: 1, targets: 0 },
            // { responsivePriority: 10001, targets: 4 },
            // { responsivePriority: 2, targets: 5 }
        ],
        aoColumns: [{
                render: function(data, type, row) {
                    var fech = row.fecha.split(" ");
                    var fecha = fech[0]
                        .split("/")
                        .reverse()
                        .join("-");
                    return fecha;
                },
                className: "text-center"
            },
            { data: "cuenta", className: "text-center" },
            { data: "titulo", className: "d-none d-md-none d-lg-table-cell text-center" },
            { data: "referencia", className: "" },
            { data: "descripcion", className: "d-none d-md-none d-lg-table-cell text-left" },
            {
                render: function(data, type, row) {
                    return row.monto;
                },
                className: "text-right"
            },
            {
                render: function(data, type, row) {
                    return (
                        '<div class="btn-group" role="group" aria-label="Basic example"> <button class="btn  btn-sm" title="Detalle de la cuenta" data-toggle="modal" data-target="#ver_movimiento" data-id=' +
                        row.idmov +
                        '><i class="fa fa-eye mdb"></i></button>'
                    );
                },
                className: "text-center"
            }
        ],

        initComplete: function() {
            /*Exportacion de archivos*/
            var $buttons = $('.dt-buttons').hide();
            $('#excel').on('click', function() {
                var btnClass = this.id ?
                    '.buttons-' + this.id :
                    null;
                if (btnClass) $buttons.find(btnClass).click();
            })
            $('#csv').on('click', function() {
                var btnClass = this.id ?
                    '.buttons-' + this.id :
                    null;
                if (btnClass) $buttons.find(btnClass).click();
            })
            $('#pdf').on('click', function() {
                var btnClass = this.id ?
                    '.buttons-' + this.id :
                    null;
                if (btnClass) $buttons.find(btnClass).click();
            })
            $('#print').on('click', function() {
                var btnClass = this.id ?
                    '.buttons-' + this.id :
                    null;
                if (btnClass) $buttons.find(btnClass).click();
            })

            // $('#tbMovimientos').html(table.buttons().container());
        }

    });

}

function continuarCarga(b, f, c, n, nc, rc) {
    setTimeout(function() {
        $('#cargador').html(procesarCargar(3));
        $("#tib2").html("Banco: " + rc + " <br>Num: " + nc);
        $("#usuario").html("Usuario: <br>" + n);
        $('#i1').attr('src', 'assets/img/' + b + '.png');
        $.ajax({
            type: 'post',
            url: '?c=app&a=procesarCSV',
            data: 'cuenta=' + c + '&' + 'form=' + f,
            beforeSend: function() {
                $('#cuepo_impo').html(loader(3));
            },
            error: function() {
                $('#cuepo_impo').html(loader(2));
            },
            success: function(data) {
                $('#cuepo_impo').html(data);
            }
        });
    }, 2000);
}

function procesarCargar(key) {
    switch (key) {
        case 1:
            return '<div class="row"><div class="col-12 text-center"> <div class="spinner-border text-success text-center spinner" role="status"><span class="sr-only">Loading...</span></div><br><small class="envim">Indentificando Banco</small></div></div>';
        case 2:
            return '<div class="row"><div class="col-12 text-center"> <img src="assets/img/geekhack-logom.png" id="ib"   class="img-fluid imgcargador" alt=""><br><small class="bancoi" id="tib">Banco: Nombre codigo</small><br><small class="bancoi" id="fib">Banco: Nombre codigo</small></div></div>';
        case 3:
            return '<div class="row"><div class="col-4"> <img src="assets/img/geekhack-logom.png" id="i1"  class="img-fluid imgcargador" alt=""><br><small id="tib2">Banco: Mercantil 0001</small></div><div class="col-4 text-center"> <br><br><small class="envim" id="envi">Importando...</small></div><div class="col-4 text-right"> <img src="assets/img/geekhack-logom.png"  id="i2"   class="img-fluid imgcargador" alt=""><br><small id="usuario">Usuario: GEEKhack</small></div></div>';
        case 4:
            return '<div class="row"><div class="col-12 text-center"> <div class="spinner-border text-danger text-center spinner" role="status"><span class="sr-only">Loading...</span></div><br><small class="envim">Ha Ocurrido Un Error</small></div></div>';
        case 5:
            return '<div class="row"><div class="col-4"> <img src="assets/img/geekhack-logom.png" id="i13"  class="img-fluid imgcargador" alt=""><br><small id="tib3">Banco: Mercantil 0001</small></div><div class="col-4 text-center"> <br><br><small class="envim" id="envi3">Importando...</small></div><div class="col-4 text-right"> <img src="assets/img/geekhack-logom.png"    class="img-fluid imgcargador" alt=""><br><small id="usuario3">Usuario: GEEKhack</small></div></div>';

        default:
            console.log("ha ocurrido un error");
            break;
    }
}

function loaderImportar() {
    var t = 1;
    var l = 1;
    setInterval(() => {
        if (t === 1) {
            $('#i2').attr('class', 'img-fluid imgcargador');
            $('#i1').attr('class', 'img-fluid imgcargador imgcargadora');
            t = 2;
        } else {
            $('#i1').attr('class', 'img-fluid imgcargador');
            $('#i2').attr('class', 'img-fluid imgcargador imgcargadorv');
            t = 1;
        }
    }, 1000);
    setInterval(() => {
        if (l === 1) {
            $('#envi').attr('class', 'envim');
            l = 2;
        } else {
            $('#envi').attr('class', 'envi');
            l = 1;
        }
    }, 800);
}
$("#form_imp").on("submit", function(e) {
    e.preventDefault();
    $('#fim').attr('class', 'ocultard');
    $('#cuepo_impo').attr('class', 'ocultard');
    $('#cargador').attr('class', 'mostrad');
    var formData = new FormData(document.getElementById("form_imp"));
    $.ajax({
        type: "post",
        url: "?c=app&a=cargarCSVSubir",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $("#cargador").html(procesarCargar(1));
        },
        error: function() {
            $("#cargador").html(procesarCargar(4));
        },
        success: function(data) {
            $("#cuepo_impo").html("");
            $("#cargador").html(procesarCargar(2));
            $('#cuepo_impo').attr('class', 'mostrard');
            $("#cuepo_impo").html(data);
        }
    });
});

function activarBotonesCsv(id) {
    if (id.value == "0") {
        $("#inputc").attr("disabled", "true");
        $("#btn-im").attr("disabled", "true");
    } else {
        $("#btn-im").removeAttr("disabled");
        $("#inputc").removeAttr("disabled");
    }
}
$('#imovimietos').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('id');
    $.ajax({
        type: 'post',
        url: '?c=app&a=importar_csv',
        data: 'id=' + rowid,
        beforeSend: function() {
            $("#cuepo_impo").html(loader(1));
        },
        error: function() {
            $("#cuepo_impo").html(loader(2));
        },
        success: function(data) {
            $('#cuepo_impo').html(data);
            if (ccuenta != 0) {
                $("#cuenta option[value='" + ccuenta + "']").attr("selected", true);
                $("#inputc").attr("disabled", false);
                $("#btn-im").attr("disabled", false);
            }
        }
    });
});
$('#imovimietos').on('hide.bs.modal', function(e) {
    $('#cargador').attr('class', 'ocultard');
    $('#fim').attr('class', 'ocultard');
    $("#cuepo_impo").attr("class", "mostrard");
    $("#btn-im").attr("disabled", true);
    ccuenta = 0;
});
/* Movimientos */
/* productos */
function cuentainactiva() {
    $.bootstrapGrowl('No puede cargar Movimientos<br><span class="badge badge-pill badge-danger">Inactivo</span>', {
        type: 'info',
        delay: 3000,
    });
}

function cargarMovimentos(id) {
    window.location.href = "index.php?c=app&a=movimientos&idCuenta=" + id;
}

$('#formRegistroCuenta').submit(function(e) {
    e.preventDefault();
    var informacion = $('#formRegistroCuenta').serialize();
    var metodo = $('#formRegistroCuenta').attr('method');
    var peticion = $('#formRegistroCuenta').attr('action');
    $.ajax({
        type: metodo,
        url: peticion,
        data: informacion,
        beforeSend: function() {
            $('#cn').html(loader(3));
            $('#ftr').attr('class', 'ocultard');
        },
        error: function() {
            $('#cn').html(loader(2));
        },
        success: function(data) {
            $("#cn").html(data);
        }
    });
});
$("#formularioee").submit(function(e) {
    e.preventDefault();
    var datos = $("#formularioee").serialize();
    $.ajax({
        type: "POST",
        url: "?c=app&a=ModificarCuenta",
        data: datos,
        beforeSend: function() {
            $("#contenido2").html(loader(3));
        },
        error: function() {
            $("#contenido2").html(loader(2));
        },
        success: function(data) {
            $("#contenido2").html(data);
        }
    });
    return false;
});
$("#form_ad").submit(function(e) {
    e.preventDefault();
    var informacion = $('#form_ad').serialize();
    var metodo = $('#form_ad').attr('method');
    var peticion = $('#form_ad').attr('action');
    $.ajax({
        type: metodo,
        url: peticion,
        data: informacion,
        beforeSend: function() {
            $('#form_ad').attr('class', 'form_ad ocultard');
            $('#fi').attr('class', 'ocultard');
            $('#rep_ad').attr('class', 'col-md-12 col-sm-12 mostrard');
            $("#rep_ad").html(loader(3));
        },
        error: function() {
            $("#rep_ad").html(loader(2));
        },
        success: function(data) {
            $("#rep_ad").html(data);
        }
    });
    return false;
});
$('.ad_cuenta').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('idcuenta');
    $("#btn-adc").attr("disabled");
    $.ajax({
        type: 'post',
        url: '?c=app&a=diproductos',
        data: 'id=' + rowid,
        beforeSend: function() {
            $('#rep_ad').attr('class', 'col-md-12 col-sm-12 mostrard');
            $("#rep_ad").html(loader(1));
            $('#form_ad').attr('class', 'form_ad ocultard');
            $('#fi').attr('class', 'ocultard');
        },
        error: function() {
            $("#rep_ad").html(loader(2));
        },
        success: function(data) {
            data = $.parseJSON(data);
            if (data != -1) {
                $('#rep_ad').attr('class', 'col-md-12 col-sm-12 ocultard');
                $('#form_ad').attr('class', 'form_ad');
                $("#idCuentaa").val(data[0].id);
                $("#bancona").val(data[0].nombre);
                $("#numeroa").val(data[0].referencia);
                $("#fechaa").val(data[0].fecha_creacion);
                $("#estatus").val(data[0].estatus);
                $('#fi').attr('class', 'mostrard');
                $("#btn-adc").removeAttr("disabled");
            } else {
                $("#rep_ad").html(loader(2));
            }
        }
    });
});
$(document).on("keyup", "#montoCuenta", function() {
    if ($("#montoCuenta").val() != "") {
        $("#enviarFormulario").removeAttr("disabled");
    } else {
        $("#enviarFormulario").prop("disabled", true);
    }
});
$(document).on("keyup", "#montoCuentae", function() {
    if ($("#montoCuentae").val() != "") {
        $("#formularioe").removeAttr("disabled");
    }
});
$(document).on("keyup", "#numCuentae", function() {
    if ($("#numCuentae").val() != "") {
        $("#formularioe").removeAttr("disabled");
    }
});
$("#montoCuentae").on({
    "focus": function(event) {
        $(event.target).select();
    },
    "keyup": function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});
$("#form_ec").submit(function(e) {
    e.preventDefault();
    var informacion = $('#form_ec').serialize();
    var metodo = $('#form_ec').attr('method');
    var peticion = $('#form_ec').attr('action');
    $.ajax({
        type: metodo,
        url: peticion,
        data: informacion,
        beforeSend: function() {
            $('#form_ec').attr('class', 'form_ec ocultard');
            $('#mfe').attr('class', 'ocultard');
            $('#li').attr('class', 'col-md-12 col-sm-12 mostrard');
            $("#li").html(loader(3));
        },
        error: function() {
            $("#li").html(loader(2));
        },
        success: function(data) {
            $("#li").html(data);
        }
    });
    return false;
});
$('.eproducto').on('hide.bs.modal', function(e) {
    $('#form_ec').attr('class', 'form_ec ocultard');
    $('#mfe').attr('class', 'ocultard');
    $('#li').attr('class', 'col-md-12 col-sm-12 ocultard');
});
$('.nproducto').on('hide.bs.modal', function(e) {
    $('#ftr').attr('class', 'mostrard');
});
$('.eproducto').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('idcuenta');
    $("#btn-ec").attr("disabled");
    $.ajax({
        type: 'post',
        url: '?c=app&a=data_eliminar',
        data: 'id=' + rowid,
        beforeSend: function() {
            $('#li').attr('class', 'col-md-12 col-sm-12 mostrard');
            $('#mfe').attr('class', 'ocultar');
            $("#li").html(loader(1));
        },
        error: function() {
            $("#li").html(loader(2));
        },
        success: function(data) {
            data = $.parseJSON(data);
            if (data != -1) {
                $('#li').attr('class', 'col-md-12 col-sm-12 ocultard');
                $('#form_ec').attr('class', 'form_ec');
                $("#idCuenta").val(data[0].id);
                $("#bancon	").val(data[0].nombre);
                $("#numero").val(data[0].referencia);
                $("#fecha").val(data[0].fecha_creacion);
                $('#mfe').attr('class', 'mostrard');
                $("#btn-ec").removeAttr("disabled");
            } else {
                $("#li").html(loader(2));
            }
        }
    });
});
$('.editarCuenta').on('show.bs.modal', function(e) {
    var rowid = $(e.relatedTarget).data('idcuenta');
    $("#formularioe").prop("disabled", true);
    $.ajax({
        type: 'post',
        url: '?c=app&a=modificarProductos',
        data: 'id=' + rowid,
        beforeSend: function() {
            $("#contenido2").html(loader(1));
        },
        error: function() {
            $("#contenido2").html('<div class="alert alert-danger text-center">Ha ocurrido un error en el sistema</div>');
        },
        success: function(data) {
            RespEditarCuenta(data);
            $("#id").val(rowid);
            //$("#contenido2").html('');
        }
    });
});

function RespEditarCuenta(data) {
    data = JSON.parse(data);
    switch (data.resp) {
        case 1:
            $("#contenido2").html('');
            $("#contenido").css("display", "block");
            $("#tipoCuentaE").empty().append(data.p);
            $("#bancoe").empty().append(data.b);
            $("#divisae").empty().append(data.d);
            $("#numCuentae").val(data.n);
            $("#montoCuentae").val(data.s);
            var codigo = $("#bancoe option:selected").data('cod');
            var codigo2 = $("#divisae option:selected").data('cod');
            $("#codigoBe").val(codigo);
            $("#tce").html(codigo);
            //$("#tse").html(codigo2);
            var c = $("#tipoCuentaE option:selected").val();
            maskSelector(c);
            if (c === "3") {
                $('#tipoCuentaE option:not(:selected)').attr('disabled', true);
            } else {
                $("#tipoCuentaE option[value='3']").remove();
            }
            break;
        case -1:
            $("#contenido").css("display", "none");
            $("#contenido2").html(loader(2));
            break;
        case -2:
            $("#contenido").css("display", "none");
            $("#contenido2").html(loader(2));
            break;
        case -3:
            $("#contenido").css("display", "none");
            $("#contenido2").html(loader(2));
            break;
        default:
            console.log("no se que hacer");
            break;
    }
}

function maskSelector(codigo) {
    switch (codigo) {
        case "1":
            $('#numCuentae').attr('maxlength', 16);
            $('#numCuentae').attr('minlength', 16);
            break;
        case "2":
            $('#numCuentae').attr('maxlength', 16);
            $('#numCuentae').attr('minlength', 16);
            break;
        case "3":
            $('#numCuentae').attr('maxlength', 8);
            $('#numCuentae').attr('minlength', 8);
            break;
        case "4":
            $('#numCuentae').attr('maxlength', 8);
            $('#numCuentae').attr('minlength', 8);
            break;
    }

}

function cargarCuentas() {

    $("#tbProductos").attr("class", "table table-striped table-bordered dt-responsive nowrap mostrar");
    $('#tbProductos').DataTable({
        destroy: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay existe Productos Registrados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
            "infoEmpty": "Mostrando 0 de 0 Total 0 Productos",
            "infoFiltered": "(Filtrado de _MAX_ total Productos)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Productos",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados productos encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
        ajax: {
            type: "POST",
            dataType: "json",
            url: "index.php?c=app&a=cargarCuentas"
        },
        columns: [
            //{ data: "numero", className: "text-center"},
            { data: "referencia", className: "text-center" },
            { data: "nombrebanco", className: "text-left" },
            {
                render: function(data, type, row) {
                    if (row.retrazado == 2) {
                        return '<p>' + row.fechsaldo + '</p>';
                    } else {
                        return '<p style="color:red;">' + row.fechsaldo + '</p>';
                    }
                },
                className: "text-center"
            },
            {
                render: function(data, type, row) {
                    return row.saldo;
                },
                className: "text-right"
            },
            {
                render: function(data, type, row) {
                    if (row.estatu == 1) {
                        return '<span class="badge badge-pill badge-success">Activo</span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger">Inactivo</span>';
                    }
                },
                className: "d-none d-md-none d-lg-table-cell text-center"
            },
            {
                render: function(data, type, row) {
                    if (row.movimiento == 0) {
                        act = "";

                        if (row.estatu == 1) {
                            act = '<div class="btn-group" role="group" aria-label="Basic example"> <button class="btn mr-1" title="Editar" data-toggle="modal" data-target=".editarCuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-file-signature cd"></i></button><button class="btn mr-1" title="Inactivar" data-toggle="modal" data-target=".ad_cuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-lock mdr"></i></button><button class="btn" title="Cargar Movimientos" onclick="cargarMovimentos(' + row.idcuenta + ')"><i class="fas fa-upload mc"></i></button>';
                        } else {
                            act = '<div class="btn-group" role="group" aria-label="Basic example"> <button class="btn" title="Editar" disabled><i class="fas fa-file-signature cd"></i></button><button class="btn" title="Activar" data-toggle="modal" data-target=".ad_cuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-unlock add"></i></button><button class="btn" title="Cargar Movimientos"  disabled  ><i class="fas fa-upload mc"></i></button>';
                        }
                        act += '<button class="btn" title="Eliminar" data-toggle="modal" data-target=".eproducto" data-idCuenta="' +
                            row.idcuenta +
                            '"><i class="fas fa-trash-alt mdb"></i></button></div> ';

                        return act;
                    } else {
                        if (row.estatu == 1) {
                            act = '<div class="btn-group" role="group" aria-label="Basic example"> <button class="btn" title="Editar" data-toggle="modal" data-target=".editarCuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-file-signature cd"></i></button><button class="btn" title="Inactivar" data-toggle="modal" data-target=".ad_cuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-lock add"></i></button><button class="btn" title="Cargar Movimientos"  onclick="cargarMovimentos(' + row.idcuenta + ')"  ><i class="fas fa-upload mc"></i></button>';
                        } else {
                            act = '<div class="btn-group" role="group" aria-label="Basic example"> <button class="btn" title="Editar" disabled><i class="fas fa-file-signature cd"></i></button><button class="btn" title="Activar" data-toggle="modal" data-target=".ad_cuenta" data-idCuenta="' +
                                row.idcuenta +
                                '"><i class="fas fa-unlock mdr"></i></button><button class="btn" title="Cargar Movimientos" disabled ><i class="fas fa-upload mc"></i></button>';
                        }

                        act += '<button class="btn" title="Eliminar" disabled><i class="fas fa-trash-alt mdb"></i></button></div> ';
                        return act;
                    }
                },
                className: "text-center"
            }
        ],
        /*initComplete: function () {

        }*/
    });
}
$("#montoCuenta").on({
    "focus": function(event) {
        $(event.target).select();
        $("#enviarFormulario").removeAttr("disabled");
    },
    "keyup": function(event) {
        $(event.target).val(function(index, value) {
            return value.replace(/\D/g, "")
                .replace(/([0-9])([0-9]{2})$/, '$1,$2')
                .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
        });
    }
});

function bancosSelectEditar(id) {
    $("#formularioe").removeAttr("disabled");
    var data;
    var div = "#contenido2";
    var url = "index.php?c=app&a=consultarMaestrosD";
    var msj = "Consultando Divisa...";
    switch (id.value) {
        case "1":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
        case "2":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
        case "3":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
        case "4":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
        case "5":
            desabitarBotonesCuenta(2);
            data = "virtual";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
        case "7":
            desabitarBotonesCuenta(2);
            data = "virtual";
            peticionAjax(url, data, msj, div, "#divisae");
            break;
    }
}

function divisaSelectEditar() {
    $("#formularioe").removeAttr("disabled");
    var codigo = $("#bancoe option:selected").data('cod');
    var codigo2 = $("#divisae option:selected").data('cod');
    $("#numCuentae").removeAttr("disabled");
    $("#montoCuentae").removeAttr("disabled");
    $("#codigoBe").val(codigo);
    $("#tce").html(codigo);
    //$("#tse").html(codigo2);
}

function productosSelectEditar(id) {
    $("#formularioe").removeAttr("disabled");
    var data;
    var div = "#contenido2";
    var url = "index.php?c=app&a=consultarMaestros";
    var msj = "Consultando Bancos...";

    switch (id.value) {
        case "1":
            data = 1;
            peticionAjax(url, data, msj, div, "#bancoe");
            maskSelector(1);
            $('#numCuentae').val('');
            break;
        case "2":
            data = 1;
            peticionAjax(url, data, msj, div, "#bancoe");
            maskSelector(2);
            $('#numCuentae').val('');
            break;
        case "4":
            data = 1;
            peticionAjax(url, data, msj, div, "#bancoe");
            maskSelector(4);
            $('#numCuentae').val('');
            break;
        default:
            desabitarBotonesCuenta(1);
            break;
    }
}

function productosSelect(id) {
    var data;
    var div = "#cn";
    var url = "index.php?c=app&a=consultarMaestros";
    var msj = "Consultando Bancos...";
    switch (id.value) {
        case "1":
            data = 1;
            peticionAjax(url, data, msj, div, "#banco");
            desabitarBotonesCuenta(1);

            maskSelector2("1");
            break;
        case "2":
            data = 1;
            desabitarBotonesCuenta(1);
            peticionAjax(url, data, msj, div, "#banco");
            maskSelector2("2");
            break;
        case "3":
            data = 2;
            desabitarBotonesCuenta(1);
            peticionAjax(url, data, msj, div, "#banco");
            maskSelector2("3");
            break;
        case "4":
            data = 1;
            desabitarBotonesCuenta(1);
            peticionAjax(url, data, msj, div, "#banco");
            maskSelector2("4");
            break;
        default:
            desabitarBotonesCuenta(1);
            break;
    }
}

function peticionAjax(url, datos, msj, div, d) {
    $.ajax({
        type: "POST",
        url: url,
        data: { id: datos },
        beforeSend: function() {
            $(div).html(
                loader(1)
            );
        },
        error: function() {
            $(div).html(
                loader(2)
            );
        },
        success: function(data) {
            presentacionAjax(data, div, d);
        }
    });
}

function presentacionAjax(data, div, d) {
    switch (d) {
        case "#banco":
            if (data === -1) {
                $(div).html('<div class="alert alert-warning">No existe bancos Disponibles para este producto </div>');
            } else {
                $("#banco").removeAttr("disabled");
                $("#banco").empty().append(data);
                $(div).html('');
            }
            break;
        case "#bancoe":
            if (data === -1) {
                $(div).html('<div class="alert alert-warning">No existe bancos Disponibles para este producto </div>');
            } else {
                $("#bancoe").removeAttr("disabled");
                $("#bancoe").empty().append(data);
                $(div).html('');
            }
            break;
        case "#divisa":
            data = $.parseJSON(data);
            if (data.data === -1) {
                $(div).html('<div class="alert alert-warning">No existe divisas Disponibles Disponibles para este producto </div>');
            } else {
                $("#divisa").removeAttr("disabled");
                $("#divisa").empty().append(data.data);

                $(div).html('');
            }
            break;
        case "#divisae":
            data = $.parseJSON(data);
            if (data.data === -1) {
                $(div).html('<div class="alert alert-warning">No existe divisas Disponibles Disponibles para este producto </div>');
            } else {
                $("#divisae").removeAttr("disabled");
                $("#divisae").empty().append(data.data);

                $(div).html('');
            }
            break;

        default:
            console.log("Ha Ocurrido un Error");
            break;
    }

}

function desabitarBotonesCuenta(nivel) {
    if (nivel === 1) {
        $("#banco").attr('disabled', 'disabled');
        $("#divisa").attr('disabled', 'disabled');
        $("#numCuenta").attr('disabled', 'disabled');
        $("#numCuenta").val('');
        $("#montoCuenta").attr('disabled', 'disabled');
        $("#montoCuenta").val('');
        $("#tc").html("");
        //$("#ts").html("");
        $("#limpiarc").removeAttr("disabled");
    } else {
        $("#divisa").attr('disabled', 'disabled');
        $("#numCuenta").attr('disabled', 'disabled');
        $("#montoCuenta").attr('disabled', 'disabled');
        $("#numCuenta").val('');
        $("#montoCuenta").val('');
        $("#tc").html("");
        //	$("#ts").html("");
    }
}

function maskSelector2(codigo) {
    switch (codigo) {
        case "1":
            $('#numCuenta').attr('maxlength', 16);
            $('#numCuenta').attr('minlength', 16);
            break;
        case "2":
            $('#numCuenta').attr('maxlength', 16);
            $('#numCuenta').attr('minlength', 16);
            break;
        case "3":
            $('#numCuenta').attr('maxlength', 8);
            $('#numCuenta').attr('minlength', 8);
            break;
        case "4":
            $('#numCuenta').attr('maxlength', 8);
            $('#numCuenta').attr('minlength', 8);
            break;
    }

}

function bancosSelect(id) {
    var data;
    var div = "#cn";
    var url = "index.php?c=app&a=consultarMaestrosD";
    var msj = "Consultando Divisa...";
    var codigo = $("#banco option:selected").data('cod');
    switch (id.value) {
        case "1":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "2":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "3":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "4":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "5":
            desabitarBotonesCuenta(2);
            data = "virtual";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "7":
            desabitarBotonesCuenta(2);
            data = "virtual";
            peticionAjax(url, data, msj, div, "#divisa");
            break;
        case "8":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;

        case "6":
            desabitarBotonesCuenta(2);
            data = "fisica";
            peticionAjax(url, data, msj, div, "#divisa");
            break;

        default:
            desabitarBotonesCuenta(2);
            console.log("Formato de cuenta no valido");
            break;
    }
}

function divisaSelect() {
    var codigo = $("#banco option:selected").data('cod');
    var codigo2 = $("#divisa option:selected").data('cod');
    $("#numCuenta").removeAttr("disabled");
    $("#montoCuenta").removeAttr("disabled");
    $("#codigoB").val(codigo);
    $("#tc").html(codigo);
    //$("#ts").html(codigo2);
    var c = $("#tipoCuenta option:selected").val();
    if (c === "1") {
        $("#tc").css("display", "block");
    } else {
        $("#tc").css("display", "none");
    }
}

function LimpiarProductos() {
    cargarCuentas();
    setTimeout(function() {
        $(".nproducto").modal("hide");
        desabitarBotonesCuenta(1);
        $("#cn").html("");
        $("#formRegistroCuenta")[0].reset();
    }, 3000);

}

function LimpiarProductose() {
    cargarCuentas();
    setTimeout(function() {
        $(".editarCuenta").modal("hide");
        desabitarBotonesCuenta(1);
        $("#contenido2").html("");
        $("#contenido").css("display", "none")
        $("#formularioee")[0].reset();
    }, 3000);

}

/* productos */

/* Globales */
function loader(key) {
    switch (key) {
        case 1:
            return '<p>Consultando Información...</p><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
        case 2:
            return '<p>Ha ocurrido un error...</p><div class="progress"><div class="progress-bar progress-bar-striped  bg-danger" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
        case 3:
            return '<p>Procesando Acción...</p><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
        default:
    }
}

/* Globales */
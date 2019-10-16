$(document).ready(function () {
    var MascaraTelefones = function (val) {
        return val.replace(/\D/g, "").length === 11 ? "(00) 00000-0000" : "(00) 0000-00009";
    },
            spOptions = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(MascaraTelefones.apply({}, arguments), options);
                }
            };

    $(".telefone").mask(MascaraTelefones, spOptions);
});

function onkeypressEnter(event) {
    if ((window.event ? event.keyCode : event.which) === 13) {
        return true;
    } else {
        return false;
    }
}

function notificacao(tipo, texto) {
    //tipos = success || info || warning || error

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var titulo = "";

    if (tipo === "success") {
        titulo = "Sucesso";
    } else if (tipo === "info") {
        titulo = "Informações";
    } else if (tipo === "warning") {
        titulo = "Aviso";
    } else if (tipo === "error") {
        titulo = "Erro";
    }

    toastr[tipo](texto, titulo);
}

function modal_remover(url) {
    $("#modal_remover_botao").attr("href", url);
    $("#modal_remover_item").modal("show");
}
$(document).ready(function () {
    $('.login-bg').backstretch([
        "/global/img/login-1.jpg",
        "/global/img/login-2.jpg"
    ], {
        fade: 1500,
        duration: 5000
    });

    $("#form-login").submit(function (event) {
        event.preventDefault();

        if (validarFomularioLogin()) {
            $("#div-acoes").hide();
            $("#div-processando").show();

            $.ajax({
                url: "/usuarios/entrar",
                type: "post",
                data: $("#form-login").serialize(),
                success: function (response) {
                    if (response.sucesso) {
                        window.location = "/mod-configuracoes";
                    } else {
                        $("#div-processando").hide();
                        $("#div-acoes").show();
                        notificacao("warning", response.mensagem);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#div-processando").hide();
                    $("#div-acoes").show();
                    notificacao("error", "Erro ao efetuar login.");
                }
            });
        } else {
            notificacao("warning", "Informe seus dados de acesso.");
        }

        return false;
    });

    $("#form-redefinir").submit(function (event) {
        event.preventDefault();

        if ($("#email").val() !== "") {
            $("#div-acoes").hide();
            $("#div-processando").show();
            
            $.ajax({
                url: "/usuarios/senha/redefinir",
                type: "post",
                data: $("#form-redefinir").serialize(),
                success: function (response) {
                    if (response.sucesso) {
                        window.location.href = "/usuarios/entrar";
                    } else {
                        $("#div-processando").hide();
                        $("#div-acoes").show();
                        notificacao("warning", response.mensagem);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#div-processando").hide();
                    $("#div-acoes").show();
                    notificacao("error", "Erro ao solicitar redefinição de senha.");
                }
            });
        } else {
            notificacao("warning", "Informe seu email.");
        }
        
        return false;
    });

    $("#form-confirmar").submit(function (event) {
        event.preventDefault();

        if (validarFomularioLogin()) {
            $("#div-acoes").hide();
            $("#div-processando").show();
            
            $.ajax({
                url: "/usuarios/senha/redefinir/confirmar?token=" + $("#token").val(),
                type: "post",
                data: $("#form-confirmar").serialize(),
                success: function (response) {
                    if (response.sucesso) {
                        window.location.href = "/usuarios/entrar";
                    } else {
                        $("#div-processando").hide();
                        $("#div-acoes").show();
                        notificacao("warning", response.mensagem);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $("#div-processando").hide();
                    $("#div-acoes").show();
                    notificacao("error", "Erro ao redefinir senha.");
                }
            });
        }

        return false;
    });
});

function validarFomularioLogin() {
    var email = $("#email").val();
    var senha = $("#senha").val();
    var validacao = 0;

    if (email === "") {
        validacao++;
    }
    if (senha === "") {
        validacao++;
    }

    if (validacao === 0) {
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
        "positionClass": "toast-top-left",
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
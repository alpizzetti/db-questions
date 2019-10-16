function usuariosHistoricoAcessos(id, linha) {
    $("#" + linha + "_" + id + " a").hide();
    $("#" + linha + "_" + id + " img").show();

    $.ajax({
        url: "/mod-configuracoes/usuarios/localizarAcessos",
        type: "post",
        data: {
            id: id
        },
        success: function (data) {
            $("#" + linha + "_" + id + " img").hide();
            $("#" + linha + "_" + id + " a").show();

            if (data.sucesso) {
                $("#modal_acessos #conteudo").html(data.conteudo);
                $("#modal_acessos").modal("show");
            } else {
                notificacao("warning", "Não foi possível localizar os acessos.");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#" + linha + "_" + id + " img").hide();
            $("#" + linha + "_" + id + " a").show();
            notificacao("error", "Erro ao localizar os acessos.");
        }
    });
}

function unidadesHistoricoAcessos(id, linha) {
    $("#" + linha + "_" + id + " a").hide();
    $("#" + linha + "_" + id + " img").show();

    $.ajax({
        url: "/mod-configuracoes/unidades/localizarAcessos",
        type: "post",
        data: {
            id: id
        },
        success: function (data) {
            $("#" + linha + "_" + id + " img").hide();
            $("#" + linha + "_" + id + " a").show();

            if (data.sucesso) {
                $("#modal_acessos #conteudo").html(data.conteudo);
                $("#modal_acessos").modal("show");
            } else {
                notificacao("warning", "Não foi possível localizar os acessos.");
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $("#" + linha + "_" + id + " img").hide();
            $("#" + linha + "_" + id + " a").show();
            notificacao("error", "Erro ao localizar os acessos.");
        }
    });
}
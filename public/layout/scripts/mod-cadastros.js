function questoesImagensEnviar() {
    $("#btn_enviar_arquivo").attr("disabled", "");
    $("#div_porcentagem_imagens").show();

    $("#form_questoes").ajaxForm({
        uploadProgress: function (event, position, total, percentComplete) {
            $("#div_porcentagem_imagens #valor").attr("style", "width: " + percentComplete + "%");
            $("#div_porcentagem_imagens #valor").html(percentComplete + "%");
        },
        success: function (data) {
            $("#btn_enviar_arquivo").removeAttr("disabled");
            $("#div_porcentagem_imagens").hide();
            $("#div_porcentagem_imagens #valor").attr("style", "width: 0%");
            $("#div_porcentagem_imagens #valor").html("0%");

            if (data.sucesso === true) {
                $("#tabela_imagens").html(data.tabela_imagens);
                $("#imagens").val("");
                $("#item").val("");

                notificacao("success", "Enviado com sucesso.");
            } else {
                notificacao("warning", data.mensagem);
            }
        },
        error: function () {
            $("#btn_enviar_arquivo").removeAttr("disabled");
            $("#div_porcentagem_imagens").hide();
            $("#div_porcentagem_imagens #valor").attr("style", "width: 0%");
            $("#div_porcentagem_imagens #valor").html("0%");
            notificacao("error", "Erro ao enviar.");
        },
        dataType: "json",
        url: "/mod-cadastro/questoes/imagensEnviar"
    }).submit();
}

function questoesImagemRemover(id, modal) {
    if (modal === true) {
        $("#modal_remover_imagem #btn_remover").attr("onclick", "questoesImagemRemover('" + id + "', false);");
        $("#modal_remover_imagem").modal("show");
    } else {
        $("#modal_remover_imagem #acoes").hide();
        $("#modal_remover_imagem #carregando").show();

        $.ajax({
            url: "/mod-cadastro/questoes/imagensRemover",
            type: "post",
            data: {
                id: id
            },
            success: function (data) {
                $("#modal_remover_imagem #carregando").hide();
                $("#modal_remover_imagem #acoes").show();
                $("#modal_remover_imagem").modal("hide");

                if (data.sucesso) {
                    $("#tabela_imagens").html(data.tabela_imagens);
                    notificacao("success", "Removido com sucesso.");
                } else {
                    notificacao("warning", data.mensagem);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $("#modal_remover_imagem #carregando").hide();
                $("#modal_remover_imagem #acoes").show();
                notificacao("error", "Erro ao remover.");
            }
        });
    }
}
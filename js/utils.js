function log(message) {
    if (logEnabled && window.console && window.console.log) {
        console.log(message)
    }
}
$.fn.hasAttr = function(name) {
    return this.attr(name) !== undefined
};
function tratarValidationResult(validationResult, contexto) {
    removerTooltips();
    var contador = 0;
    $(".removeTooltip").tipsy("hide").attr("original-title", "").css("background-image", "none");
    if (validationResult != null) {
        $.each(validationResult, function(i, item) {
            adicionarTooltip(i, item);
            contador++
        })
    }
    var seletorContexto = contexto == null ? "" : contexto;
    if (contador > 0) {
        $(seletorContexto + " .box-result-validation").show();
        $(".removeTooltip:first").focus()
    } else {
        $(seletorContexto + " .box-result-validation").hide()
    }
    return contador
}
function removerTooltips() {
    $(".removeTooltip").tipsy("hide").attr("original-title", "").removeClass("removeTooltip")
}
function removerTooltipsEm(eContainer) {
    $(eContainer + " .removeTooltip").tipsy("hide").attr("original-title", "").removeClass("removeTooltip")
}
function adicionarTooltip(campo, mensagemDeErro) {
    if (!$("#" + campo).hasClass("removeTooltip")) {
        $("#" + campo).addClass("removeTooltip")
    }
    $("#" + campo).tipsy({trigger: "manual", html: "true", gravity: "n"});
    $("#" + campo).attr("original-title", mensagemDeErro);
    $("#" + campo).mouseover(function() {
        $(this).tipsy("show")
    }).mouseout(function() {
        $(this).tipsy("hide")
    })
}
var TooltipPosisition = {N: "N", NE: "NE", L: "L", SE: "SE", S: "S", SO: "SO", O: "O", NO: "NO"};
function aplicarTooltip(htmlID, mensagem, position) {
    var targetPos;
    var tooltipPos;
    var cornerPos;
    switch (position) {
        case TooltipPosisition.N:
            {
                targetPos = "topMiddle";
                tooltipPos = "bottomMiddle";
                break
            }
        case TooltipPosisition.NE:
            {
                targetPos = "topRight";
                tooltipPos = "bottomLeft";
                cornerPos = "bottomLeft";
                break
            }
        case TooltipPosisition.L:
            {
                targetPos = "rightMiddle";
                tooltipPos = "leftMiddle";
                cornerPos = "leftMiddle";
                break
            }
        case TooltipPosisition.SE:
            {
                targetPos = "bottomRight";
                tooltipPos = "topLeft";
                break
            }
        case TooltipPosisition.S:
            {
                targetPos = "bottomMiddle";
                tooltipPos = "topMiddle";
                break
            }
        case TooltipPosisition.SO:
            {
                targetPos = "bottomLeft";
                tooltipPos = "topRight";
                break
            }
        case TooltipPosisition.O:
            {
                targetPos = "leftMiddle";
                tooltipPos = "rightMiddle";
                break
            }
        case TooltipPosisition.NO:
            {
                targetPos = "topLeft";
                tooltipPos = "bottomRight";
                break
            }
    }
    htmlID = htmlID.charAt(0) == "#" ? htmlID : document.getElementById(htmlID);
    $(htmlID).qtip({content: mensagem, position: {corner: {target: targetPos, tooltip: tooltipPos}}, style: {name: "blue", tip: {corner: cornerPos, size: {x: 8, y: 8}}}, show: "mouseover", hide: "mouseout"})
}
function getDataObjectFromJSONEncoded(data) {
    data = decodeURIComponent(data);
    data = jQuery.parseJSON(data);
    return data
}
function emularClickAoPressioanrEnter(eventKey, elementoASerClicado) {
    if (eventKey == null || typeof eventKey == "undefined") {
        return
    }
    var keyCode;
    if (typeof window.event == "undefined") {
        if (eventKey.charCode == 0) {
            return
        }
        keyCode = eventKey.charCode
    } else {
        keyCode = window.event ? eventKey.which : eventKey.keyCode
    }
    if (keyCode == 13) {
        $(elementoASerClicado).click()
    }
}
function contador(segundos, toUpdate, onComplete) {
    var count = segundos;
    var counter = setInterval(function() {
        count--;
        if (count <= 0) {
            clearInterval(counter);
            onComplete();
            return
        }
        toUpdate.text(count)
    }, 1e3)
}
function limparFormulario(containerHTMLID) {
    $(containerHTMLID + " select").val(1);
    $(containerHTMLID + " .select2-container").select2("val", 1);
    $(containerHTMLID + " input").val("");
    $(containerHTMLID + " textarea").val("")
}
function formatarData(longDhEnvio) {
    var dhEnvio = new Date(longDhEnvio);
    var diferencaEmSegundos = ((new Date).getTime() - dhEnvio.getTime()) / 1e3;
    var diferencaEmDias = Math.floor(diferencaEmSegundos / 86400);
    var diaDhEnvio = dhEnvio.getUTCDate();
    var mesDhEnvio = dhEnvio.getMonth();
    var anoDhEnvio = dhEnvio.getFullYear();
    var horaDhEnvio = dhEnvio.getHours();
    var minutoDhEnvio = dhEnvio.getMinutes();
    var dhEnvioFormatada = (diaDhEnvio < 10 ? "0" + diaDhEnvio : diaDhEnvio) + "/" + (mesDhEnvio + 1 < 10 ? "0" + (mesDhEnvio + 1) : mesDhEnvio + 1) + "/" + anoDhEnvio;
    var horaMinutoFormatada = (horaDhEnvio < 10 ? "0" + horaDhEnvio : horaDhEnvio) + ":" + (minutoDhEnvio < 10 ? "0" + minutoDhEnvio : minutoDhEnvio);
    var resultado = dhEnvioFormatada + " Ã¡s " + horaMinutoFormatada;
    if (isNaN(diferencaEmDias) || diferencaEmDias < 0 || diferencaEmDias > 31) {
        return resultado
    }
    if (diferencaEmDias == 0) {
        if (diferencaEmSegundos < 60) {
            resultado = "quase agora"
        } else if (diferencaEmSegundos < 120) {
            resultado = "hÃ¡ um minuto atrÃ¡s"
        } else if (diferencaEmSegundos < 3600) {
            resultado = Math.floor(diferencaEmSegundos / 60) + " minutos atrÃ¡s"
        } else if (diferencaEmSegundos < 7200) {
            resultado = "1 hora atrÃ¡s"
        } else if (diferencaEmSegundos < 86400) {
            resultado = Math.floor(diferencaEmSegundos / 3600) + " horas atrÃ¡s"
        }
    } else if (diferencaEmDias == 1) {
        resultado = "ontem Ã¡s " + horaMinutoFormatada
    } else if (diferencaEmDias < 7) {
        resultado = diferencaEmDias + " dias atrÃ¡s Ã¡s " + horaMinutoFormatada
    }
    return resultado
}
function atualizarDatas() {
    log("Atualizando as datas...");
    $(".datetime").each(function(index, item) {
        var elmDateTime = $(item);
        var dhAtual = elmDateTime.text();
        var dateTimeInLong = elmDateTime.attr("cp-datetime");
        dateTimeInLong = parseInt(dateTimeInLong);
        var dhFormatada = formatarData(dateTimeInLong);
        if (dhFormatada != dhAtual) {
            elmDateTime.text(dhFormatada)
        }
    })
}
function isValidString(str) {
    if (str == null || str == "") {
        return false
    } else {
        return true
    }
}
function isValidNumber(number) {
    if (number == null || number == "" || number == 0) {
        return false
    } else {
        return true
    }
}
function gerarItensSeparadosPorVirgula(arrayItens, separador, attribute) {
    var resultado = "";
    separador = separador ? separador : "e";
    for (var i = 0; i < arrayItens.length; i++) {
        var pedacoFinalString;
        if (i + 2 == arrayItens.length) {
            pedacoFinalString = " " + separador + " "
        } else if (i + 1 == arrayItens.length) {
            pedacoFinalString = "."
        } else {
            pedacoFinalString = ", "
        }
        if (attribute) {
            resultado += arrayItens[i][attribute] + pedacoFinalString
        } else {
            resultado += arrayItens[i] + pedacoFinalString
        }
    }
    return resultado
}
function formatarValorParaDecimal(valor) {
    valor = valor.split(".").join("");
    valor = valor.split(",").join(".");
    return valor
}
function animarProgressBar(containerId) {
    $(containerId + " .ui-progress").each(function(index, item) {
        var porcentagem = $(item).attr("cp-progressbar");
        $(item).find(".ui-label").hide();
        $(item).css("width", "0%");
        setTimeout(function() {
            $(item).animateProgress(porcentagem, function() {
            })
        }, 100)
    })
}
function escapeHtml(str) {
    return new String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;")
}
function popUpEstaBloqueado() {
    var popUp = window.open("http://www.facebook.com/login.php", "", "", true);
    var result = false;
    if (popUp == null || typeof popUp == "undefined") {
        result = true
    } else {
        popUp.close();
        result = false
    }
    return result
}
function getParameterByName(url, name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(url);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "))
}
function removerAcentos(str) {
    str = str.split("Ã£").join("a");
    str = str.split("Ãƒ").join("A");
    str = str.split("Ãµ").join("o");
    str = str.split("Ã•").join("O");
    str = str.split("Ã§").join("c");
    str = str.split("Ã‡").join("C");
    str = str.split("Ã¡").join("a");
    str = str.split("Ã©").join("e");
    str = str.split("Ã­").join("i");
    str = str.split("Ã³").join("o");
    str = str.split("Ãº").join("u");
    str = str.split("Ã").join("A");
    str = str.split("Ã‰").join("E");
    str = str.split("Ã").join("I");
    str = str.split("Ã“").join("O");
    str = str.split("Ãš").join("U");
    str = str.split("Ãª").join("e");
    str = str.split("ÃŠ").join("E");
    str = str.split("Ã‚").join("A");
    str = str.split("Ã¢").join("a");
    str = str.split("Ã”").join("O");
    str = str.split("Ã´").join("o");
    str = str.split("Ã ").join("a");
    str = str.split("Ã€").join("A");
    str = str.split("Ã²").join("o");
    str = str.split("Ã’").join("O");
    str = str.trim();
    return str
}
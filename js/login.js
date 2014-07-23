var permitPropagation = false;
var redirect;
$(document).ready(function() {
    $(".btnLogin").click(function(e) {
        var isDisplayed = $(".box-deslogado-login").css("display") == "block" ? true : false;
        if (isDisplayed) {
            fecharBoxLogin()
        } else {
            abrirBoxLogin()
        }
        e.stopPropagation()
    });
    $("#email, #senha").keypress(function(eventPress) {
        emularClickAoPressioanrEnter(eventPress, "#btnEfetuarLogin")
    });
    $("body").click(function() {
        fecharBoxes()
    });
    $(".float-box").click(function(e) {
        if (permitPropagation) {
            permitPropagation = false;
            return
        }
        e.stopPropagation()
    });
    $("#btnEfetuarLogin").click(efetuarLogin)
});
function abrirBoxLogin() {
    $(".box-deslogado-login").show();
    $(".box-deslogado-login input:first").focus()
}
function fecharBoxLogin() {
    $(".box-deslogado-login").hide()
}
function fecharBoxes() {
    fecharBoxLogin()
}
function efetuarLogin() {
    //debugger;
    $("#btnEfetuarLogin").text("Validando os dados...");
    var efetuarLoginVO = new EfetuarLoginVO;
    var validationResult = efetuarLoginVO.validate();
    if (!validationResult) {
        $("#btnEfetuarLogin").text("Continuar");
        return
    }
    $("#btnEfetuarLogin").text("Continuar");
    $("#form_login").submit();
}


function EfetuarLoginVO() {
    this.email = $("#email").val();
    this.email_htmlid = $("#email").attr("id");
    this.senha = $("#senha").val();
    this.senha_htmlid = $("#senha").attr("id");
    this.keepLoggedIn = $("#mantenhaMeLogado").is(":checked")
}
EfetuarLoginVO.prototype.validate = function() {
    var validationResult = true;
    //removerTooltips();
    var reEmail = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (this.email == "") {
        validationResult = false;
        adicionarTooltip(this.email_htmlid, "Informe o email antes de prosseguir!")
    } else if (!reEmail.test(this.email)) {
        validationResult = false;
        adicionarTooltip(this.email_htmlid, "Informe um email válido!")
    }
    if (this.senha == "") {
        validationResult = false;
        adicionarTooltip(this.senha_htmlid, "Informe sua senha antes de prosseguir!")
    }
    if (!validationResult) {
        $(".float-box-login .box-result-validation").show();
        $(".removeTooltip:first").focus()
    } else {
        $(".float-box-login .box-result-validation").hide()
    }
    return validationResult
};


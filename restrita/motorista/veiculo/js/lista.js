$(document).ready(function(){
    try{
        alertMsg();
        $("#btnNovoRegistro").click(function(){navega('cadastro', '', 0)});
    }catch(erro){
        alert(erro.message);
    }
});

function confirmaExclusao(ID, nome){
    try {
        limpaAlert();
        $("#alertCadastro").html('Confirma a exclus&atilde;o do veículo <b>'+nome+'</b>?&nbsp;&nbsp;&nbsp;<a href="javascript:navega(\'\',\'EXCLUIR\','+ID+')">Sim</a> | <a href="javascript:limpaAlert()">N&atilde;o</a>');
        $("#alertCadastro").show();
} catch ( Erro ) {
        alert( Erro.message );
    }
}

function setAtivacao( id) {
    try {
        limpaAlert();
        imgAtiv = document.getElementById("imgBanner_"+id);
        if ( imgAtiv.src.indexOf("img_sinalVermelho") != -1 ) {
            imgAtiv.src = "img/img_sinalVerde.gif";
            flgAtivacao = "S";
        } else if ( imgAtiv.src.indexOf("img_sinalVerde") != -1 ) {
            imgAtiv.src = "img/img_sinalVermelho.gif";
            flgAtivacao = "N";
        }
        $.getJSON("mod/evento/setAtivacao.php",{
            id: id,
            indAtivacao: flgAtivacao,
            ajax: 'true'
        }, function(j){
            if(j == "ERRO"){
                if ( imgAtiv.src.indexOf("img_sinalVermelho") != -1 ) {
                    imgAtiv.src = "img/img_sinalVerde.gif";
                    flgAtivacao = "S";
                } else if ( imgAtiv.src.indexOf("img_sinalVerde") != -1 ) {
                    imgAtiv.src = "img/img_sinalVermelho.gif";
                    flgAtivacao = "N";
                }
                alert("Erro na ativação");
            }
        })
    } catch ( Erro ) {
        alert( Erro.message );
    }
}
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
        $("#alertCadastro").html('Confirma a exclus&atilde;o do veículo <b>'+nome+'</b>?&nbsp;&nbsp;&nbsp;<a href="javascript:excluir('+ID+')">Sim</a> | <a href="javascript:limpaAlert()">N&atilde;o</a>');
        $("#alertCadastro").show();
} catch ( Erro ) {
        alert( Erro.message );
    }
}

function excluir(ID){
    $("#ID").val(ID);
    $('#acao').val('EXCLUIR');
    $("#form").submit();
}

function editar(ID){
    $("#ID").val(ID);
    $("#target").val('cadastro');
    $("#form").submit();
}
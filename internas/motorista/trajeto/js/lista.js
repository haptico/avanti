$(document).ready(function(){
    try{
        alertMsg();
        $("#btnNovoRegistro").click(function(){navega('cadastro', '', 0)});
    }catch(erro){
        alert(erro.message);
    }
});

function excluir(ID){
    if(confirm("Confirma a exclusão desse registro?")){
        $("#ID").val(ID);
        $('#acao').val('EXCLUIR');
        $("#form").submit();
    }
}


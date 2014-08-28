$(document).ready(function(){
    try{
        $("#btnGravar").click(submeterCadastro);
        $("#btnVoltar").click(function() {navega("lista",'','')});
        alertMsg();
        $("#descricao").focus();
        $(".timepicker").each(function() {
            $(this).timepicker();
        });
    }catch(erro){
        alert(erro.message);
    }
});



var submeterCadastro = function(){
    if($("#id_veiculo").val()==''){
        alert("Indique um veículo a ser utilizado nesse trajeto");
        $("#id_veiculo").focus();
    }else if($("#id_bairro_origem").val()==''){
        alert("Indique o bairro de origem do trajeto");
        $("#id_bairro_origem").focus();
    }else if($("#id_bairro_destino").val()==''){
        alert("Indique o bairro de destino do trajeto");
        $("#id_bairro_destino").focus();
    }else if($("#hora_inicio").val()==''){
        alert("Defina o horário de início do trajeto");
        $("#hora_inicio").focus();
    }else if($("#hora_fim").val()==''){
        alert("Defina o horário estimado de fim do trajeto");
        $("#hora_fim").focus();
    }else if($("#preco_mensalista").val()==''){
        alert("Defina o preço a ser cobrado dos passageiros mensalistas");
        $("#preco_mensalista").focus();
    }else if($("#preco_avulso").val()==''){
        alert("Defina o preço a ser cobrado dos passageiros avulsos");
        $("#preco_avulso").focus();
    }else{
        $("#acao").val('GRAVAR');
        $("#form").submit();
    }
}


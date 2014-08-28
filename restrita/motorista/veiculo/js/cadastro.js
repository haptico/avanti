$(document).ready(function(){
    try{
        $("#btnGravar").click(submeterCadastro);
        $("#btnVoltar").click(function() {navega("lista",'','')});
        alertMsg();
        $("#id_tipo_veiculo").focus();
    }catch(erro){
        alert(erro.message);
    }
});



var submeterCadastro = function(){
    if($("#id_tipo_veiculo").val()==''){
        $("#alertCadastro").html("Indique o tipo do veículo");
        $("#alertCadastro").show();
        $("#id_tipo_veiculo").focus();
    }else if($("#placa").val()==''){
        $("#alertCadastro").html("Informe a placa do veículo");
        $("#alertCadastro").show();
        $("#placa").focus();
    }else if($("#vagas").val()==''){
        $("#alertCadastro").html("Informe a quantidade de vagas que o veículo suporta");
        $("#alertCadastro").show();
        $("#vagas").focus();
    }else{
        $("#acao").val('GRAVAR');
        $("#form").submit();
    }
}


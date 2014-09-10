$(document).ready(function(){
    try{
        $("#btnVoltar").click(function() {navega("lista",'','')});
        $("#btnNovaBusca").click(function(){navega('buscarTrajeto', '', 0)});
        
        alertMsg();
        carregaCidadesOrigem($('#origem_uf_UPDATE').val(),$('#origem_cidade_UPDATE').val());
        carregaBairrosOrigem($('#origem_cidade_UPDATE').val(),$('#origem_bairro_UPDATE').val());
        carregaCidadesDestino($('#destino_uf_UPDATE').val(),$('#destino_cidade_UPDATE').val());
        carregaBairrosDestino($('#destino_cidade_UPDATE').val(),$('#destino_bairro_UPDATE').val());
        
        $('#origem_uf').change(function(){carregaCidadesOrigem($('#origem_uf').val(),$('#origem_cidade').val());});
        $('#origem_cidade').change(function(){carregaBairrosOrigem($('#origem_cidade').val(),$('#origem_bairro').val());});
        $('#destino_uf').change(function(){carregaCidadesDestino($('#destino_uf').val(),$('#destino_cidade').val());});
        $('#destino_cidade').change(function(){carregaBairrosDestino($('#destino_cidade').val(),$('#destino_bairro').val());});
    }catch(erro){
        alert(erro.message);
    }
});

function carregaCidadesOrigem(estado,cidade){
    try {
        $.getJSON("restrita/ajax/comboCidade.php",{
            estado: estado,
            cidade: cidade,
            ajax: 'true'
        }, function(j){
            $('#origem_cidade').html(j);
        })
    } catch ( Erro ) {
        alert( Erro.message );
    }
}

function carregaBairrosOrigem(cidade, bairro){
    try {
        $.getJSON("restrita/ajax/comboBairro.php",{
            bairro: bairro,
            cidade: cidade,
            ajax: 'true'
        }, function(j){
            $('#origem_bairro').html(j);
        })
    } catch ( Erro ) {
        alert( Erro.message );
    }
}

function carregaCidadesDestino(estado,cidade){
    try {
        $.getJSON("restrita/ajax/comboCidade.php",{
            estado: estado,
            cidade: cidade,
            ajax: 'true'
        }, function(j){
            $('#destino_cidade').html(j);
        })
    } catch ( Erro ) {
        alert( Erro.message );
    }
}

function carregaBairrosDestino(cidade, bairro){
    try {
        $.getJSON("restrita/ajax/comboBairro.php",{
            bairro: bairro,
            cidade: cidade,
            ajax: 'true'
        }, function(j){
            $('#destino_bairro').html(j);
        })
    } catch ( Erro ) {
        alert( Erro.message );
    }
}
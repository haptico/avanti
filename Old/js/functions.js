documentall = document.all;

function AntiCache( argumento1 ){
    var historico = ["lixo"]  ;
    var qtde = argumento1.split("|");
    for ( linha in qtde  ) {
        var composicao = qtde[linha].split("=");
        historico[linha] = composicao[0]+"='"+eval(composicao[0])+"';";
        eval(composicao[0]+'='+composicao[1]+';' ) ;
    }
    document.form.submit();
    var qtde = argumento1.split("|");
    for ( linha in qtde  ) {
        var composicao = qtde[linha].split('=');
        //historico[linha] = "form."+composicao[0]+".value="+eval("form."+composicao[0]+".value")+";";
        eval( historico[linha]); //"form."+composicao[0]+".value= "+composicao[1] );
    }
}

function buscaGeral(){
    if($("#searchString").val() != ''){
        $("#acao2").val('buscaGeral');
        $("#strBusca").val($("#searchString").val());
        $("#form").submit();
    }
}

function navigation (opt, opt2) {
    $("#msg").val('');
    jQuery("#opt").val(opt);
    jQuery("#opt2").val(opt2);
    
    jQuery("#form").submit();
}

/**
 * fnc para limpar os filtros
 */
function changeRelatorio() {
//    $('input:hidden').each(function(){
//        $(this).val('');
//    });
    $('select').each(function(){
        if($(this).attr('id') != 'consulta' && $(this).attr('id') != 'id_relatorio_2'){
            $(this).val('');
        }
    });
    $('#opt').val('81');
    $('#id_visao').val('');
    $('#form').submit();
}

function changeConsultar() {
    $('#id_visao').val('');
    $('#form').submit();
}

function formatReal( integer ) {  
    var tmp = integer+'';  
    tmp = tmp.replace(/([0-9]{2})$/g, ",$1");  
    if( tmp.length > 6 )  
        tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");  
  
    return tmp;  
}

function reais(obj, event) {
    var whichCode = (window.Event) ? event.which : event.keyCode;
    /*
     *   Executa a formatação após o backspace nos navegadores !document.all
     */
    if (whichCode == 8 && !documentall) {
        /*
         *   Previne a ação padrão nos navegadores
         */
        if (event.preventDefault){ //standart browsers
            event.preventDefault();
        }else{ // internet explorer
            event.returnValue = false;
        }
        var valor = obj.value;
        var x = valor.substring(0,valor.length-1);
        obj.value= demaskvalue(x,true).formatCurrency();
        return false;
    }
    /*
     *   Executa o Formata Reais e faz o format currency novamente após o backspace
     */
    FormataReais(obj,'.',',',event);
    obj.value= obj.value;
} // end reais

function backspace(obj,event){
    /*
Essa função basicamente altera o  backspace nos input com máscara reais para os navegadores IE e opera.
O IE não detecta o keycode 8 no evento keypress, por isso, tratamos no keydown.
Como o opera suporta o infame document.all, tratamos dele na mesma parte do código.
*/

    var whichCode = (window.Event) ? event.which : event.keyCode;
    if (whichCode == 8 && documentall) {
        var valor = obj.value;
        var x = valor.substring(0,valor.length-1);
        var y = demaskvalue(x,true).formatCurrency();

        obj.value =""; //necessário para o opera
        obj.value += y;

        if (event.preventDefault){ //standart browsers
            event.preventDefault();
        }else{ // internet explorer
            event.returnValue = false;
        }
        return false;

    }// end if
}// end backspace

function popup_projetos(projeto_id ){
    var  ret =  window.open("detalhes_projeto.php?projetoid=" + projeto_id, "Detalhamento_de_Projeto_" + projeto_id,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

function popup_gps( id_gp ){
    var  ret =  window.open("detalhes_gp.php?idGP=" + id_gp, "Detalhamento_de_GP_" + id_gp,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_gls(id_gp, status, mes, projeto ){
    if (status=='Total'){
        status='';
    }
    var  ret =  window.open("detalhes_gl.php?id_visao=gl_detalhes&id_gp=" + id_gp + "&status_de_implant_multi=" + status + "&mes_realizado1=" + mes  , "Detalhamento_de_GL_" + projeto, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_gls2(id_gp, status, mes, projeto ){
    if (status=='Total'){
        status='';
    }
    var  ret =  window.open("detalhes_gl.php?id_visao=gl_detalhes&id_gp=" + id_gp + "&status_de_implant_multi2=" + status + "&mes_realizado1=" + mes  , "Detalhamento_de_GL_" + projeto, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_gl_detalhado(id_gl){
    var  ret =  window.open("detalhes_gl_detalhado.php?id_gl=" + id_gl, "Detalhes_do_GL_" + id_gl, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_gl_detalhado2(id_gl){
    var  ret =  window.open("../detalhes_gl_detalhado.php?id_gl=" + id_gl, "Detalhes_do_GL_" + id_gl, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupSwap(id_gl){
    var  ret =  window.open("modules/swap/detalheSwap.php?id_gl=" + id_gl, "Detalhes_do_GL_" + id_gl, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupGlSwap(id_gl){
    var  ret =  window.open("modules/swap/detalheGLSwap.php?id_gl=" + id_gl, "Detalhes_do_GL_" + id_gl, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_gls_historico(id_gp, id_lp, com_tim, data_arquivo, base, id_relatorio, segmento, rampup, status ){ //// detalhamento producao diaria
    if (status=='Total'){
        status='';
    }
    if (typeof rampup == "undefined"){
        rampup = '';
    }
    if (typeof segmento == "undefined"){
        segmento = '';
    }
    if (base=='bdni2'){
        tmp= "&data_parametro=" + data_arquivo ;
    } else {
        tmp= "&data_arquivo_date=" + data_arquivo ;
    }
    var  ret =  window.open("detalhes_gl_historico.php?opt=81&ok_relatorio=1&id_visao=gl_detalhes_historico&id_visao2=gl_detalhes_historico&cliente_tim="+com_tim+"&id_gp=" + id_gp + "&id_lp=" + id_lp + "&producao_diaria_status=" + status + tmp + "&base=" + base +"&id_relatorio=" +  id_relatorio +"&segmentos=" +  segmento +"&visualizar_GL=" +  rampup, "Drill_Down", "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

function popup_gls_historico2(id_gp, id_lp, com_tim, mes, id_relatorio, segmento, rampup, status ){ //// detalhamento producao diaria
    if (status=='Total'){
        status='';
    }
    if (typeof rampup == "undefined"){
        rampup = '';
    }
    if (typeof segmento == "undefined"){
        segmento = '';
    }
    var  ret =  window.open("detalhes_gl_historico2.php?opt=81&ok_relatorio=1&id_visao=gl_detalhes_historico&id_visao2=gl_detalhes_historico&cliente_tim="+com_tim+"&mes_conclusao="+mes+"&id_gp=" + id_gp + "&id_lp=" + id_lp + "&producao_diaria_status=" + status + "&id_relatorio=" +  id_relatorio +"&segmentos=" +  segmento +"&visualizar_GL=" +  rampup, "Drill_Down", "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

function popup_cliente(cliente) {
    var  ret =  window.open("detalhes_cliente.php?cliente=" + cliente, "Detalhes_do_Cliente","scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

//function visualizarDetalhes(entidade, ID) {
//    var params = "?entidade="+entidade;
//    if(ID != ''){
//        params += "&amp;ID="+ID;
//    }
//    window.open("visualizar_detalhes.php"+params, "Visualização","scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
//}

    function visualizarDetalhes(url){
        $("#pop_detalhes").load(url).dialog({
            height: 550,
            width:1000,
            modal: true,
            resizable: false,
            buttons: {"Fechar": function() {$( this ).dialog( "close" );}},
            close: function() {$( this ).html("");}
        });
    }

//------------------------------------------EVT----------------------------------------
function popup_evt_acesso(id_acesso ){
    var  ret =  window.open("evt.detalhes.acesso.php?id_acesso=" + id_acesso, "Detalhamento_do_Acesso_" + id_acesso,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

function popup_evt_projeto(projeto_id ){
    var  ret =  window.open("evt.detalhes.projeto.php?projetoid=" + projeto_id, "Detalhamento_de_Projeto_" + projeto_id,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_evt_OS(projeto_id ){
    var  ret =  window.open("evt.emitir.os.projeto.php?projetoid="+projeto_id, "Emitir_OS_do_Projeto_" + projeto_id,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popup_os_imprimir(os_id){
    var  ret =  window.open("html2pdf/interface.php?input_file=pages/form_os.php&os_id="+os_id,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
//window.location = "html2pdf/interface.php?input_file=pages/form_os.php&os_id="+os_id;
//window.location = "html2pdf_v4.03/interface.php?input_file=pages/form_os.php?os_id="+os_id;
}
function popupWfPosto(nome, barralateral, projeto, aging){
    window.open("./modules/swap/detalha_posto.php?nome="+nome+"&barralateral="+barralateral+"&projeto="+projeto+"&aging="+aging, "Detalhes_do_Posto_"+nome, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupWfPostoWF(nome, barralateral, projeto, aging){
    window.open("./popup/detalha_posto.php?nome="+nome+"&barralateral="+barralateral+"&projeto="+projeto+"&aging="+aging, "Detalhes_do_Posto_"+nome, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupWfPostoFT(nome, barralateral, projeto, aging, cliente, uf, unidade_medida){
    window.open("./popup/detalhePostosFT.php?nome="+nome+"&barralateral="+barralateral+"&projeto="+projeto+"&aging="+aging+"&cliente="+cliente+"&uf="+uf+"&unidade_medida="+unidade_medida, "Detalhes_do_Posto_"+nome, "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupListaSwap(projeto, status){
    window.open("./modules/swap/detalheListaSwap.php?projeto="+projeto+"&status="+status, "Detalhes_do_Posto", "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function popupWO(id){
    window.open("./modules/wo/wo.detalhe.php?ID="+id, "Detalhes_da_wo", "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}
function ltrim(str){
    return str.replace(/^\s+/, '');
}
function rtrim(str) {
    return str.replace(/\s+$/, '');
}
function alltrim(str) {
    return str.replace(/^\s+|\s+$/g, '');
}
function replaceAll(string, token, newtoken) {
    while (string.indexOf(token) != -1) {
        string = string.replace(token, newtoken);
    }
    return string;
}
function mais (id) {
    jQuery('#details-'+id).toggle();
    if(document.getElementById('details-'+id).style.display == 'none'){
        jQuery('#mais-'+id).removeClass('minus');
        jQuery('#mais-'+id).addClass('more');
    }else{
        jQuery('#mais-'+id).removeClass('more');
        jQuery('#mais-'+id).addClass('minus');
    }
}

function Display (id) {
    jQuery('#details-'+id).toggle();
    jQuery('#mais-'+id).toggleClass('minus', 'more');    
}

function exibeAnexos(id_, tipo_){
    $("#loading_anexo_"+tipo_).show();
    $("#div_anexos_"+tipo_).html('')
    var uniq = Number(new Date());
    $.getJSON("inc/ajaxLinksAnexos.php?k="+uniq,{
        id: id_,
        tipo: tipo_,
        ajax: 'true'
    }, function(j){
        $("#loading_anexo_"+tipo_).hide();
        $("#div_anexos_"+tipo_).html(j);
 
    });
}

function exibeAnexosFiber(id_){
    $("#loading_anexo_fiber").show();
    $("#div_anexos_fiber").html('')
    var uniq = Number(new Date());
    $.getJSON("inc/ajaxLinksAnexosFiber.php?k="+uniq,{
        id: id_,
        ajax: 'true'
    }, function(j){
        $("#loading_anexo_fiber").hide();
        $("#div_anexos_fiber").html(j);
    });
}

highlightFiltros = function(){
    if($(this).val() != '' && $(this).val() != '-1' && $(this).val() != 'N' && $(this).val() != '0' && $(this).attr('id') != 'btFiltrar'){
        $(this).css('background-color', '#E0EEFB');
    }
}
function excluirDocumentoAjax(id_){
    if(confirm("Confirma a exclusão de desse arquivo?")){
        var uniq = Number(new Date());
        $.getJSON("ajax/ajaxExcluirDocumento.php?k="+uniq,{
            id: id_,
            ajax: 'true'
        }, function(j){
            if(j=='OK'){
                $("#tr_doc_"+id_).remove();
            }else{
                $("#tr_doc_"+id_+" td").next().html("Erro");
            }

        });
    }
}

function popup_codTrail(codTrail){
    var  ret =  window.open("detalhes_codtrail.php?codTrail=" + codTrail, "Detalhamento do CodTrail" + codTrail,  "scrollbars=yes,status=yes,menubar=no,toolbar=no,resizable=yes,z-lock=yes,width=1024,top=0,left=0,height=768" );
}

function excluirDocumento(id_){
    try {
        if(confirm("Confima a exclusão desse arquivo?")){
        $.getJSON("ajax/ajaxExcluirDocumento.php",{
            id: id_,
            ajax: 'true'
        }, function(j){
            if(j == "OK"){
                $("#tr_doc_"+id_).remove();
            }else{
                alert("Ocorreu um erro ao excluir o documento.");
            }
        });
        }
    } catch ( Erro ) {
        alert( Erro.message );
    }
}
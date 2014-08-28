<?php
$arrTarget = array("lista","cadastro");
$ID = ($_POST['id_trajeto'] != '')?$_POST['id_trajeto']:0;
$target = $_POST['target'];
$acao = $_POST['acao'];
$msg = '';

//============ACOES============================
if($acao == 'GRAVAR'){
    $obj = TrajetoAction::loadBean($_POST);
    if(TrajetoAction::gravar($obj)){
        $msg = 'Trajeto salvo com sucesso';
        $retornoStatus = 'sucesso';
    }else{
        $retornoStatus = 'erro';
        $msg = 'Erro ao gravar trajeto';
        $target = 'cadastro';
    }
}
//==============FIM ACOES============================

//============CARREGA A VIEW============================
$target = (in_array($target, $arrTarget))?$target:'lista';
if($target == 'cadastro'){
    $data = TrajetoAction::getDataCadastro($ID);
}elseif($target == 'lista'){
    $data = TrajetoAction::getDataLista($_POST);
}

//========TRATA O TARGET E O DIRECIONAMENTO
echo '<input type="hidden" name="msg" id="msg" value="'.$msg.'" />';
echo '<input type="hidden" name="retornoStatus" id="retornoStatus" value="'.$retornoStatus.'" />';
$pathFile = str_replace('controller', $target, __FILE__);
if(is_file($pathFile)){
    require($pathFile);
}


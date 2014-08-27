<?php
$arrTarget = array('lista','cadastro');

$ID = ($_POST['ID'] != '')?$_POST['ID']:0;
$target = $_POST['target'];
$msg = '';

//============ACOES============================
if($acao == 'GRAVAR'){
    $obj = VeiculoAction::loadBean($_POST);
    if(is_null(VeiculoAction::gravar($obj))){
        $msg = 'Registro salvo com sucesso';
    }else{
        $msg = 'Erro ao gravar trajeto';
        $target = 'cadastro';
    }
}
//==============FIM ACOES============================

//============CARREGA A VIEW============================
$target = (in_array($target, $arrTarget))?$target:'lista';
if($target == 'cadastro'){
    $data = VeiculoAction::getDataCadastro($ID);
}elseif($target == 'lista'){
    //$data = VeiculoAction::getDataLista($_POST);
}

//========TRATA O TARGET E O DIRECIONAMENTO
echo '<input type="hidden" name="msg" id="msg" value="'.$msg.'" />';
$pathFile = str_replace('controller', $target, __FILE__);
if(is_file($pathFile)){
    require($pathFile);
}


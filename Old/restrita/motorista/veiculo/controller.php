<?php
$arrTarget = array('lista','cadastro');

$ID = ($_POST['id_veiculo'] != '')?$_POST['id_veiculo']:0;
$target = $_POST['target'];
$msg = '';
$acao = $_POST['acao'];

//============ACOES============================
if($acao == 'GRAVAR'){
    $obj = VeiculoAction::loadBean($_POST);
    if(VeiculoAction::gravar($obj)){
        $msg = 'Registro salvo com sucesso';
        $retornoStatus = 'sucesso';
    }else{
        $retornoStatus = 'erro';
        $msg = 'Erro ao gravar veículo';
        $target = 'cadastro';
    }
}elseif($acao == 'EXCLUIR'){
    if(VeiculoAction::excluir($ID)){
        $msg = 'Veículo excluído com sucesso';
        $retornoStatus = 'sucesso';
    }else{
        $retornoStatus = 'erro';
        $msg = 'Erro ao excluir veículo';
    }
}
//==============FIM ACOES============================

//============CARREGA A VIEW============================
$target = (in_array($target, $arrTarget))?$target:'lista';
if($target == 'cadastro'){
    $data = VeiculoAction::getDataCadastro($ID);
}elseif($target == 'lista'){
    $data = VeiculoAction::getDataLista($_POST);
}

//========TRATA O TARGET E O DIRECIONAMENTO
echo '<input type="hidden" name="msg" id="msg" value="'.$msg.'" />';
echo '<input type="hidden" id="retornoStatus" value="'.$retornoStatus.'" />';
$pathFile = str_replace('controller', $target, __FILE__);
if(is_file($pathFile)){
    require($pathFile);
}


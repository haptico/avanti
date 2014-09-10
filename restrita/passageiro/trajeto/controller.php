<?php
$arrTarget = array("meusTrajetos",'buscarTrajeto');
$ID = ($_POST['id_trajeto'] != '')?$_POST['id_trajeto']:0;
$target = $_POST['target'];
$acao = $_POST['acao'];
$msg = '';

//============ACOES============================

//==============FIM ACOES============================

//============CARREGA A VIEW============================
$target = (in_array($target, $arrTarget))?$target:'meusTrajetos';
if($target == 'meusTrajetos'){
    $data['mensalista'] = MensalistaAction::getDataLista($_POST);
    $data['avulso'] = MensalistaAction::getDataLista($_POST);
}elseif($target=='buscarTrajeto'){
    $data = TrajetoAction::getDataListaBusca($_POST);
}

//========TRATA O TARGET E O DIRECIONAMENTO
echo '<input type="hidden" name="msg" id="msg" value="'.$msg.'" />';
echo '<input type="hidden" name="retornoStatus" id="retornoStatus" value="'.$retornoStatus.'" />';
$pathFile = str_replace('controller', $target, __FILE__);
if(is_file($pathFile)){
    require($pathFile);
}


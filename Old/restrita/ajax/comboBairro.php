<?php
require('../../inc/init.inc.php');

$cidade = $_GET['cidade'];
$bairro = $_GET['bairro'];

if($cidade != ''){
    $retorno = BairroAction::getCombobox($bairro, $cidade);
}else{
    $retorno = "<option value=''>Selecione a cidade..</option>";
}

echo json_encode($retorno);
exit();
?>
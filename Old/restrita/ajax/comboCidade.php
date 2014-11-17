<?php
require('../../inc/init.inc.php');

$cidade = $_GET['cidade'];
$estado = $_GET['estado'];

if($estado != ''){
    $retorno = CidadeAction::getCombobox($cidade, $estado);
}else{
    $retorno = "<option value=''>Selecione o estado..</option>";
}

echo json_encode($retorno);
exit();
?>
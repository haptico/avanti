<?php
require('../../../inc/init.inc.php');

$ID = $_GET['id'];
$indAtivacao = $_GET['indAtivacao'];
$retorno = VeiculoAction::setAtivacao($ID, $indAtivacao);
if($retorno){
    echo "['OK']";
}else{
    echo "['ERRO']";
}
exit();
?>
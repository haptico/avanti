<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, "portuguese", "pt_BR.iso-8859-1");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('inc/init.inc.php');

$msg = '';
$pagina = 'login.php';
$usuLogado = UsuarioAction::isLogged();
if(!$usuLogado){
    //verifica login
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $usuario = UsuarioAction::doLogin($_POST['email'], $_POST['senha']);
        if (!($usuario)) {
            $msg = 'Usuário não encontrado';
        }else{
            $pagina = 'restrita/principal.php';
        }
    }
}else{
    $pagina = 'restrita/principal.php';
}

include($pagina);
?>

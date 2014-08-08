<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, "portuguese", "pt_BR.iso-8859-1");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('inc/init.inc.php');

$idAcesso = $_POST['pagina'];
$msg = '';
$interna = 'login.php';
$pastaUsuario = '';
$usuLogado = UsuarioAction::isLogged();
if(!$usuLogado){
    //verifica login
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $usuario = UsuarioAction::doLogin($_POST['email'], $_POST['senha']);
        if (!($usuario)) {
            $msg = 'Usuário não encontrado';
        }else{
            $interna = 'principal.php';
            //$pastaUsuario = ''; //carrega pasta do usuario de acordo com o perfil
        }
    }elseif($idAcesso > 0){
        $retAcesso = AcessoAction::exibeAcesso($idAcesso);
        if($retAcesso['EXIBE']){
            $interna = $retAcesso['ARQUIVO'];
        }else{
            echo $retAcesso['MSG'];
        }
    }
}else{
    $interna = 'principal.php';
    //$pastaUsuario = ''; //carrega pasta do usuario de acordo com o perfil
    if($idAcesso > 0){
        $retAcesso = AcessoAction::exibeAcesso($idAcesso);
        if($retAcesso['EXIBE']){
            $interna = $retAcesso['ARQUIVO'];
        }else{
            echo $retAcesso['MSG'];
        }
    }
}
include('internas/'.$pastaUsuario.$interna);
include('inc/footer.inc.php');
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, "portuguese", "pt_BR.iso-8859-1");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('inc/init.inc.php');

$idAcesso = $_POST['id_acesso'];
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
            $pastaUsuario = $_SESSION['PERFILUSERLOGADO_AVANTI'].'/';
            //$pastaUsuario = ''; //carrega pasta do usuario de acordo com o perfil
        }
//    }elseif($idAcesso > 0){
//        $retAcesso = AcessoAction::exibeAcesso($idAcesso);
//        if($retAcesso['EXIBE']){
//            $interna = $retAcesso['ARQUIVO'];
//        }else{
//            echo $retAcesso['MSG'];
//        }
    }
}else{
    $interna = 'principal.php';
    $pastaUsuario = $_SESSION['PERFILUSERLOGADO_AVANTI'].'/';
    if($idAcesso > 0){
        $retAcesso = AcessoAction::exibeAcesso($idAcesso);
        if($retAcesso['EXIBE']){
            $interna = $retAcesso['ARQUIVO'];
        }else{
            echo $retAcesso['MSG'];
        }
    }
}
if($pastaUsuario!=''){
    include('internas/'.$pastaUsuario.'/inc/header.inc.php');
    include('internas/'.$pastaUsuario.'/inc/body.inc.php');
}
include('internas/'.$pastaUsuario.$interna);
include('inc/footer.inc.php');
?>

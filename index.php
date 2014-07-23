<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, "portuguese", "pt_BR.iso-8859-1");
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include('inc/init.inc.php');

$usuLogado = UsuarioAction::isLogged();
if(!$usuLogado){
    //verifica login
    $email = '';
    $sneha = '';
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $usuario = UsuarioAction::doLogin($email, $senha);
        if (is_null($usuario)) {
            $msg = 'Usuário não encontrado';
        }
    }
    if (is_null($usuario)) {
        include('login.php');
    }else{
        include('principal.php');
    }
    exit();
}else{
    include('principal.php');
}
include('inc/footer.inc.php');
?>

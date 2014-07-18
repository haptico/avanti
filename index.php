<?php
$tempoIni = microtime(true);
$tempoBanco = 0.0;
$logDebug = false;  //true - Realiza o log de todas as atividades no banco //false - Desabilita o log

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL, "portuguese", "pt_BR.iso-8859-1");
error_reporting(E_ALL ^ E_NOTICE);
set_time_limit(300);

session_start();

extract($_GET, EXTR_OVERWRITE);
extract($_REQUEST, EXTR_OVERWRITE);
extract($_SERVER, EXTR_OVERWRITE);
extract($_FILES, EXTR_OVERWRITE);
extract($_POST, EXTR_OVERWRITE);
extract($_SESSION, EXTR_OVERWRITE);

// Luis melhorias no template /////////////////
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('CLASS', ROOT . "/class/");
//////////////////////////////////////////////

require_once("inc/init.inc.php");
require_once("inc/globais.inc.php");


//EFETUA LOGOFF==========================
if ($acao == "LOGOFF" && $_SESSION["id_usuario_logado"]) {
    if (is_null(UsuarioAction::doLogout())) {
        unset($_SESSION);
        session_destroy();
        $opt = "";
    }
}
//FIM EFETUA LOGOFF==========================
//EFETUA LOGIN==========================
if ($_POST["LOGIN"]) {
    $loggon = UsuarioAction::doLogin($_POST["login"], $_POST["senha"]);
    if ($loggon) {
        $user = unserialize($_SESSION["USERLOGADO"]);
        if ($user->getAtivo() == 0) {
            $msg = 'Usuário Bloqueado.';
        } else {
            $msg = UsuarioAction::verificarStatusUsuairo($user->getID());
            UsuarioAction::setLogado($user->getID(), "S");

            //by pls carrega o obj Usuario pasta class/
            $_SESSION["objeto_usuario_logado"] = serialize($user);

            $id_usuario_logado = $_SESSION["id_usuario_logado"] = $user->getID();
            //loga o login
            LogAction::gravarProcedimento($opt, "LOGIN");
            // Determinar o tempo de permanencia do usuário logado
            $_SESSION["ULTIMOACESSO"] = date("Y-n-j H:i:s");
        }
    } else {
        $msg = "Login/Senha Incorretos";
    }
}
//FIM EFETUA LOGIN==========================
//SE usuario logado, segue com a navegacao ==========================
if ($_SESSION["id_usuario_logado"]) {

    $dadosUsuarioLogado = unserialize($_SESSION["USERLOGADO"]);

    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60*60)) {
        // last request was more than 60 minutes ago
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        $userLogin = " update usuarios set logado = 0 where id_usuario = " . $dadosUsuarioLogado->getID();
        $qry->executa($userLogin);

        unset($_SESSION);
        require("login.php");
        exit();
    }
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

    if ($_POST["acao2"] == 'buscaGeral') {
        include("busca.geral.php");
    }

    $DESENVOLVEDOR = false;
    $users = $dadosUsuarioLogado->getUsuarioLogin();
    if ($users == 'pls' ||$users == 'paulista' || $users == 'yuri.santos' || $users == 'bnovak' || $users == 'bruno.rossetto' || $users == 'btw'  ) {

        $DESENVOLVEDOR = true;
    }
    if ($DESENVOLVEDOR) {
        if (isset($_POST['sup_departamento'])) {
            $dadosUsuarioLogado->setDepartamento($_POST['sup_departamento']);
            $nivel = $dadosUsuarioLogado->getDepartamento();
            $_SESSION['USERLOGADO'] = serialize($dadosUsuarioLogado);
        }
    }

    //variavel que loga a acao
    $LOG_ACAO = 'N/D';
    $LOG_QUERY = '';
    $LOG_EVENTO = Log::NAVEGACAO;
    $LOG_OBS = '';
    $LOG_TIPO_ACESSO = '';

    //grava log ao final da execucao:
    $GRAVA_LOG_GERAL = TRUE;

//    require('templates/bootstrap/index.php');
    require('principal.php');
} else {
    require("login.php");
}
//fecha a conexao depois de tudo(pls)...
if ($con instanceof bd) {
    $con->fechar();
}

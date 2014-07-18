<?
ini_set('SMTP', 'exccorp02.intelig23');
ini_set ( 'memory_limit', '1024M');

$versao_atual = "1.0";

if ( $_SERVER["SERVER_NAME"]  == 'localhost') $servidor_processador = 'integra-desenvolvimento';
elseif ( $_SERVER["SERVER_NAME"]  == '10.10.10.50') $servidor_processador = 'Produчуo';
else {// echo "servidor nуo encontrado: ". $_SERVER["SERVER_NAME"]; exit;
}

//$servidor_processador = 'Produчуo';
//$servidor_processador = 'CTTO-ACT';
//$servidor_processador = 'localhost';

if ($servidor_processador == 'integra-desenvolvimento') {
    define('ROOT_SITE','http://localhost:81/integra/');
    $user = "INTEGRA";
    $pass = "integra123";
    $servidor = "10.10.10.48";    
    $database = "XE";
    $porta = "1521";

    $servidor_processador = 'Integra - Base de desenvolvimentos'; // NOME DO SISTEMA
    $ORACLE_SID =  $database;

} elseif ($servidor_processador == 'Produчуo') {
    //root do site ROOT_SITE
    define('ROOT_SITE','http://10.10.10.50/integra/');
    $user = "INTEGRA";
    $pass = "integra123";
    $servidor = "10.10.10.50";    
    $database = "XE";
    $porta = "1521";

    $servidor_processador = 'BIT - Between Information Technology'; // NOME DO SISTEMA
    $ORACLE_SID =  $database;

}
elseif ($servidor_processador == 'CTTO-ACT') {
    if ( strpos($_SERVER["SERVER_NAME"], 'dcruscotto')  !== false){
        define('ROOT_SITE','http://dcruscotto.intelig23/');
    }elseif ( $_SERVER["SERVER_NAME"]  == 'localhost'){
        define('ROOT_SITE','http://localhost/cruscotto/');
    }
    $user = "DCRUSCOTTO";
    $pass = "B3733nDESENV";
    $servidor = "10.1.18.199";
    $database = "cttoprd";
    $porta = "1521";

    $userMysql = "cruscotoAdmin";
    $passMysql = "S0r41A704";
    $servidorMysql = "10.9.5.13";

    $servidor_processador = 'CTTO-Aceitaчуo'; // NOME DO SISTEMA
    $ORACLE_BASE = "D:\oracle";
    $ORACLE_SID =  $database;
    $ORACLE_NLS_TERRITORY="BRAZIL";
    $ORACLE_NLS_LANGUAGE="BRAZILIAN PORTUGUESE";

}
elseif ($servidor_processador == 'localhost') {
    define('ROOT_SITE','http://localhost/cruscotto/');
    
    $user = "CRUSCOTTO";
    $pass = "CRUSCOTTO";
    $servidor = "localhost";
    $database = "XE";
    $porta = "1521";

    $userMysql = "cruscotoAdmin";
    $passMysql = "S0r41A704";
    $servidorMysql = "10.9.5.13";

    $servidor_processador = 'LOCALHOST'; // NOME DO SISTEMA
    $ORACLE_BASE = "D:\oracle";
    $ORACLE_SID =  $database;
    $ORACLE_NLS_TERRITORY="BRAZIL";
    $ORACLE_NLS_LANGUAGE="BRAZILIAN PORTUGUESE";

}

//globais para acesso ao banco
$global_user = $user;
$global_pass = $pass;
$global_servidor = $servidor;
$global_database = $database;
$global_servidorMysql = $servidorMysql;
$global_userMysql = $userMysql;
$global_passMysql = $passMysql;

putenv("NLS_LANG=BRAZILIAN PORTUGUESE_BRAZIL.WE8ISO8859P1");
putenv("ORACLE_SID=$ORACLE_SID");

//$SYS_RAMPAP = array("0"=>"TODOS", "1"=>"RAMP UP - Implantaчуo", "RAMPUP-POSVENDA"=>"RAMP UP - POSVENDA");

?>
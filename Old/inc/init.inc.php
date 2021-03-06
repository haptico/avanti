<?php

//error_reporting(0);
//ini_set('display_errors', 0 );
function __autoload($classe) {
    //global $CLASSPATHS;//usando variavel global para nao criar o array a cada chamada...
    //quando for criado um novo 'pacote' na pasta class, ele deve ser mapeado no array $CLASSPATHS 
    $root = (!defined('ROOT'))?str_replace('\inc', '', dirname(__FILE__)):ROOT;
    $CLASSPATHS = array('', 'wf\\');
    
    foreach ($CLASSPATHS as $classpath) {
        $file = $root.'\class\\'.$classpath.$classe.'.class.php';
        if (is_file($file)) {
            include($file);
            return TRUE;
        }
    }
    return FALSE;
}

function loadPathClasses() {
    $dirClass = 'class';
    $ponteiro = opendir($dirClass);
    $arrDiscard = array('.', '..', '.svn');
    while ($nome_itens = readdir($ponteiro)) {
        if (!in_array($nome_itens, $arrDiscard)) {
            $subDir = $dirClass . '/' . $nome_itens;
            if (is_dir($subDir)) {
                $ponteiro2 = opendir($subDir);
                while ($nome_itens2 = readdir($ponteiro2)) {
                    if (!in_array($nome_itens2, $arrDiscard)) {
                        $itens[$nome_itens2] = $subDir.'/'.$nome_itens2;
                    }
                }
            } else {
                $itens[$nome_itens] = $dirClass.'/'.$nome_itens;
            }
        }
    }
    return $itens;
}

//function redirect($url) {
//    die("<script type='text/javascript' >self.location='$url'</script>");
//}

 function redirect($idBarraLateral) {
        global $SYS_GIF_CORRENTE, $SYS_BARRA_LATERAL_CORRENTE,$opt;
        $objNavigation = NavigationAction::Load($idBarraLateral);
        if (is_a($objNavigation, 'Navigation')) {
            //valida se o token informado � valido 
            $SYS_GIF_CORRENTE = Util::images($objNavigation->getGif());
            $SYS_BARRA_LATERAL_CORRENTE = $objNavigation->getNome();
            $opt = $idBarraLateral;
            if (is_file($objNavigation->getArquivo())) {
                include $objNavigation->getArquivo();
            } else {
                echo '<h1 class="alert">Página não encontrada</h1>';
            }
            require_once("rodape_geral.inc.php");
            exit();
        }
    }


?>
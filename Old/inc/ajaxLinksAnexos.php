<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting( E_ALL ^ E_NOTICE   );
session_start();
require_once 'globais.inc.php';
require_once 'init.inc.php';

$id = $_REQUEST["id"];
$tipo = $_REQUEST["tipo"];
$output = '';
$arrPath  = array(Documento::ACESSO => 'gl', Documento::TRAIL => 'trail' );
if(intval($id) > 0 && $tipo != ''){
    $docs= DocumentoAction::getLista($tipo, $id);
    if(count($docs)> 0){
        $output = "<ul>\n";
        foreach ($docs as $doc) {
            if(is_file('../files/'.$arrPath[$tipo].'/'.$doc->getPath())){
                $output .= <<<EOT
                    <li><a href="inc/download.php?arquivo=files/{$arrPath[$tipo]}/{$doc->getPath()}" >&bull;&nbsp;&nbsp;{$doc->getPath()}</a></li>
EOT;
            }
        }
        $output .= "</ul>\n";
    }else{
        $output = "<p style='padding:10px'><b>- Nenhum anexo -</b></p>";
    }
}else{
    $output = "ERRO. Não foi possível carregar os anexos";
}
echo json_encode($output);
exit();
?>
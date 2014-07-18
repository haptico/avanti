<?
$file = "../".$_GET["arquivo"];
if ($file!= '' && is_file($file)){
     header('Content-type: octet/stream');
     header('Content-disposition: attachment; filename="'.basename($file).'";');
     header('Content-Length: '.filesize($file));
     readfile($file);
     exit;
 }else{
     die('Falha ao obter o arquivo');
 }
?>
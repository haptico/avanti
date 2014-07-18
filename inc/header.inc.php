<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache, must-revalidate"/>
    <title><?= implode(" :: ", $titulo_pagina); unset($titulo_pagina); ?></title>
    <link rel="shortcut icon" href="img/icons/btw_icone.ico"  /> 
    <link rel="stylesheet" type="text/css" href="css/reset.css?<?=filemtime(ROOT.'/css/reset.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="css/text.css?<?=filemtime(ROOT.'/css/text.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/styles.css?<?=filemtime(ROOT.'/css/styles.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/template.css?<?=filemtime(ROOT.'/css/template.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/view.css?<?=filemtime(ROOT.'/css/view.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/form.css?<?=filemtime(ROOT.'/css/form.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/menu.css?<?=filemtime(ROOT.'/css/menu.css'); ?>" media="all" />
    <link rel="stylesheet" type="text/css" href="css/datagrid.css?<?=filemtime(ROOT.'/css/datagrid.css'); ?>" media="all" />
    <link type="text/css" href="css/redmond/jquery-ui-1.8.16.custom.css?<?=filemtime(ROOT.'/css/redmond/jquery-ui-1.8.16.custom.css'); ?>" rel="stylesheet" />
    
    <script type="text/javascript" src="js/jquery-1.4.2.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/view.js"></script>
    <script type="text/javascript" src="js/DD_roundies.js"></script>
    <script type="text/javascript" src="js/jquery.meio.mask.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
    <script type="text/javascript" src="js/util.js?<?=filemtime(ROOT.'/js/util.js'); ?>"></script>
    <script type="text/javascript" src="js/functions.js?<?=filemtime(ROOT.'/js/functions.js'); ?>"></script>
    <script type="text/javascript" src="js/ui/jquery-ui-1.8.16.custom.min.js"></script>
    <script type="text/javascript" src="js/ui/i18n/jquery.ui.datepicker-pt-BR.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#qm0").css('display', 'block');
            try {
                // Menu dropdown
                jQuery("#nav ul").css({display: "none"}); // Opera Fix
                jQuery("#nav li").hover(function(){
                    jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).slideDown(400);
                },function(){
                    jQuery(this).find('ul:first').css({visibility: "hidden"});
                });

                DD_roundies.addRule('.titles', '3px 3px 0px 0px', true);
                DD_roundies.addRule('.botao', '5px 5px 5px 5px', true);
                if($("#li_filtros :input")){
                    $("#li_filtros :input").each(highlightFiltros);
                }
            } catch(erro) {
                alert(erro.message);
            }
        });
    </script>
</head>